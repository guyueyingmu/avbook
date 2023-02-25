<?php

namespace App\Console\Commands;

use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;

class JavlibraryCrawler extends BaseCrawler
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avbook:javlib {--genre} {--movie} {--maxpage=0}  ';

    //maxpage = 1 只爬取每个分类的第一页 ， 默认0全部
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'javlib.com Crawler ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('genre')) {
            $this->handle_genre();
        }
        if ($this->option('movie')) {
            $this->handle_movie();
        }
        //php artisan avbook:javlib --genre --movie
    }

    public $max_concurrency = 16;

    public function handle_genre()
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();

        $this->sphost = $cf['javlibhost'];
        $this->hosturl = "http://{$this->sphost}/";

        $start_type = 'gern';
        $headers = [
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8',
            'Cache-Control' => 'max-age=0',
            'Connection' => 'keep-alive',
            'Cookie' => '__cfduid=de58b540550437dded9edf806e15e97921558631740; timezone=-480; over18=18; __qca=P0-1061630505-1558631744517; Hm_lvt_bfc6c23974fbad0bbfed25f88a973fb0=1558632657; Hm_lpvt_bfc6c23974fbad0bbfed25f88a973fb0=1558632681',
            'Host' => $this->sphost,
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
            //            'User-Agent'=>'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)'
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);

        $client = new \GuzzleHttp\Client(['headers' => $headers, 'http_errors' => false]);

        $response = $client->get($this->hosturl.'cn/genres.php');
        $type = $response->getHeader('content-type');
        $parsed = \GuzzleHttp\Psr7\parse_header($type);
        $original_body = (string) $response->getBody();
        $this->spcharset = isset($parsed[0]['charset']) ? $parsed[0]['charset'] : 'UTF-8';
        $html = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        preg_match_all('#vl_genre.php\?g=(.*?)">(.*?)</a>#', $html, $out);
//        var_dump($out);die;
        $data = [];
        $this->arr_req_rejected = [];
        foreach ($out[1] as $key => $value) {
            $value = trim($value);
            if (! empty($value)) {
                $this->arr_req_rejected[] = $value;
                $temp_arr = [];
                $temp_arr['genre_code'] = $value;
                $temp_arr['genre_dsce'] = $out[2][$key];
                $temp_arr['code_10'] = base_convert($value, 36, 10);
                array_push($data, $temp_arr);
            }
        }
        $this->database->insert('avbook_javlib_genre', $data);

        //获取每个分类的最后一页
        while (1) {
            if (! empty($this->arr_req_rejected)) {
                $this->arr_req_code_36 = $this->arr_req_rejected;
                $this->arr_req_rejected = [];
            } else {
                break;
            }
            $total = count($this->arr_req_code_36);
            $requests = function ($total) {
                foreach ($this->arr_req_code_36 as $key => $item) {
                    $uri = 'http://'.$this->sphost.'/cn/vl_genre.php?list&mode=2&page=1&g='.$item;
                    echo "[当前($key) 总数($total)| =($item)-|]";
                    yield new Request('GET', $uri, ['verify' => false]);
                }
            };
            $this->sprequests = $requests($total);
            $pool = new Pool($this->spclient, $this->sprequests, [
                'concurrency' => $this->max_concurrency,
                'options' => ['timeout' => 6],
                'fulfilled' => function ($response, $index) {
                    echo "[get res:$index]";
                    $c36 = isset($this->arr_req_code_36[$index]) ? $this->arr_req_code_36[$index] : '2';

                    $original_body = (string) $response->getBody();
                    $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);

                    if (strpos($content, '</html>') === false) {
                        $this->arr_req_rejected[] = $c36;
                        $this->warn("$c36 页面不完整");

                        return;
                    }
                    preg_match('#<a class="page last" href=".*?&page=(.*?)"#', $content, $out);
                    $pnum = ! empty($out[1]) ? $out[1] : '1';

                    $sql = "update  `avbook_javlib_genre` set  old_page_num = page_num, page_num = $pnum   where genre_code = '{$c36}' ";
                    echo "$sql \n";
                    $this->database->query($sql);
                },
                'rejected' => function ($reason, $index) {
                    $c36 = isset($this->arr_req_code_36[$index]) ? $this->arr_req_code_36[$index] : '1';
                    $this->arr_req_rejected[] = $c36;
                    $this->error("[$index = $c36 = rejected]");
                },
            ]);
            $promise = $pool->promise();
            $promise->wait();
            echo '=======================================';
        }
        $this->arr_requrl = [];
        $sql = 'SELECT  * from avbook_javlib_genre ';
        $table_genre = $this->database->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        $mpage = intval($this->option('maxpage'));

        foreach ($table_genre as $gen) {
            if ($mpage > 0) {
                $pnum = $gen['page_num'] - $gen['old_page_num'] + 1;
                echo "$pnum \n";
                if ($pnum < $mpage) {
                    $pnum = $gen['page_num'] > $mpage ? $mpage : $gen['page_num'];
                }
            } else {
                $pnum = $gen['page_num'];
            }
            while ($pnum > 0) {
                $uri = $pnum.'&g='.$gen['genre_code'];
                $this->arr_requrl[] = $uri;
                $pnum = $pnum - 1;
            }
        }
        //获取每个分类页面的 vid
        $this->arr_req_rejected = $this->arr_requrl;
        while (1) {
            if (! empty($this->arr_req_rejected)) {
                $this->arr_requrl = $this->arr_req_rejected;
                $this->arr_req_rejected = [];
            } else {
                break;
            }
            $total = count($this->arr_requrl);
            $requests = function ($total) {
                foreach ($this->arr_requrl as $key => $item) {
                    $uri = 'http://'.$this->sphost.'/cn/vl_genre.php?list&mode=2&page='.$item;
                    echo "[当前($key) 总数($total)| =($item)-|] \n";
                    yield new Request('GET', $uri);
                }
            };
            $this->sprequests = $requests($total);
            $pool = new Pool($this->spclient, $this->sprequests, [
                'concurrency' => $this->max_concurrency,
                'options' => ['timeout' => 18],
                'fulfilled' => function ($response, $index) {
                    $code = $response->getStatusCode();
                    $c36 = $this->arr_requrl[$index];
                    echo "[ code $code  $index = $c36]";
                    if ($code == 200) {
                        $original_body = (string) $response->getBody();
                        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
                        if (strpos($content, '</html>') === false) {
                            $this->arr_req_rejected[] = $c36;
                            $this->warn("$c36 页面不完整");
                        }
                        preg_match_all('#<div class="video" id="vid_(.*?)">#', $content, $out);

                        $data = [];
                        foreach ($out[1] as $key => $value) {
                            $temp_arr = [];
                            $temp_arr['vid'] = trim($value);
                            if (! empty($temp_arr['vid'])) {
                                $data[] = $temp_arr;
                            }
                        }
                        $this->database->insert('avbook_javlib_vid', $data);
                    } else {
                        $this->arr_req_rejected[] = $c36;
                    }
                },
                'rejected' => function ($reason, $index) {
                    $c36 = isset($this->arr_requrl[$index]) ? $this->arr_requrl[$index] : '2';
                    $this->arr_req_rejected[] = $c36;
                    $this->error("[$index = $c36 = rejected]");
                },
            ]);
            $promise = $pool->promise();
            $promise->wait();
            echo '=======================================';
        }
    }

    public $arr_requrl;

    public $arr_req_rejected;

    public function handle_movie($moviemax = 128)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();

        $this->sphost = $cf['javlibhost'];
        $this->hosturl = "http://{$this->sphost}/";

        $start_type = 'movie';
        $headers = [
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8',
            'Cache-Control' => 'max-age=0',
            'Connection' => 'keep-alive',
            'Cookie' => '__cfduid=de58b540550437dded9edf806e15e97921558631740; timezone=-480; over18=18; __qca=P0-1061630505-1558631744517; Hm_lvt_bfc6c23974fbad0bbfed25f88a973fb0=1558632657; Hm_lpvt_bfc6c23974fbad0bbfed25f88a973fb0=1558632681',
            'Host' => $this->sphost,
            'Upgrade-Insecure-Requests' => '1',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);
        $sql = 'select vid from avbook_javlib_vid ';
        $this->info($sql);
        $table_vid = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
        $this->info(count($table_vid));
        $sql = 'select code_36 from avbook_javlib_movie ';
        $this->info($sql);
        $table_code_36 = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
        $this->info(count($table_code_36));
        $this->arr_req_rejected = array_diff($table_vid, $table_code_36);
        while (1) {
            if (! empty($this->arr_req_rejected)) {
                $this->arr_req_code_36 = array_values($this->arr_req_rejected);
                $this->arr_req_rejected = [];
            } else {
                break;
            }
            $total = count($this->arr_req_code_36);
            if ($total == 1 && $this->arr_req_code_36[0] == '') {
                $this->info(" 数量： $total");
                break;
            }
            $this->info("{$this->start_type} 升级数量： $total");

            $requests = function ($total) {
                foreach ($this->arr_req_code_36 as $key => $item) {
                    $uri = 'http://'.$this->sphost.'/cn/?v='.$item;
                    echo "[当前($key) 总数($total)| =($item)-|]";
                    yield new Request('GET', $uri);
                }
            };
            $this->sprequests = $requests($total);
            $pool = new Pool($this->spclient, $this->sprequests, [
                'concurrency' => 64,
                'options' => ['timeout' => 18],
                'fulfilled' => function ($response, $index) {
                    $code = $response->getStatusCode();
                    $c36 = $this->arr_req_code_36[$index];
                    if ($code == 200) {
                        echo "[get res:$index  $c36 ]\n";
                        $d = $this->get_info_movie($response, $c36);
                        if (empty($d)) {
                            if (! empty($c36)) {
                                $this->arr_req_rejected[] = $c36;
                            }
                        } else {
                            $this->database->insert('avbook_javlib_movie', $d);
                        }
                    } else {
                        $this->arr_req_rejected[] = $c36;
                    }
                },
                'rejected' => function ($reason, $index) {
                    $c36 = isset($this->arr_req_code_36[$index]) ? $this->arr_req_code_36[$index] : '2';
                    $this->arr_req_rejected[] = $c36;
                    $this->error("[$index = $c36 = rejected]");
                },
            ]);
            $promise = $pool->promise();
            $promise->wait();
            echo '=======================================';
        }
    }

    public function get_info_movie($response, $c_36 = '')
    {
        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);

        if (strpos($content, '</html>') === false) {
            echo '页面不完整';

            return null; //不完整
        }
        $arr_data = [];
        $arr_data['code_36'] = $c_36; ////'gid'
        $arr_data['code_10'] = base_convert($c_36, 36, 10);
        $code_36 = $c_36;
        //$arr_data[] =  substr(base_convert($out[1],36,10), 4);
        preg_match('#<td class="header">识别码:</td>[\s]*?<td class="text">(.*?)</td>#', $content, $out);
        $censored_id = empty($out[1]) ? '' : $out[1]; ////'censored_id'
        $arr_data['censored_id'] = $censored_id;
        preg_match('#<title>(.*?) - JAVLibrary</title>#', $content, $out);
        $arr_data['movie_title'] = empty($out[1]) ? '' : trim(str_replace($censored_id, '', $out[1])); ////'movie_title'
        preg_match('#id="video_jacket_img" src="(.*?)"#', $content, $out);
        $arr_data['movie_pic_cover'] = empty($out[1]) ? '' : str_replace(['http://pics.dmm.co.jp/mono/movie/adult/', '//pics.dmm.co.jp/mono/movie/adult/'], '', $out[1]); //'movie_pic_cover'//替换 域名  http://pics.dmm.co.jp/

        preg_match('#<td class="header">发行日期:</td>[\s]*?<td class="text">(.*?)</td>#', $content, $out);
        $arr_data['release_date'] = empty($out[1]) ? '' : $out[1]; //'release_date'

        preg_match('#<td class="header">长度:</td>[\s]*?<td><span class="text">(.*?)</span> 分钟</td>#', $content, $out);
        $arr_data['movie_length'] = empty($out[1]) ? '' : $out[1]; // 'movie_length'

        preg_match('#href="vl_director.php\?d=(.*?)"#', $content, $out);
        $arr_data['Director'] = empty($out[1]) ? '' : $out[1]; //'Director'

        preg_match('#href="vl_maker.php\?m=(.*?)"#', $content, $out);
        $arr_data['Studio'] = empty($out[1]) ? '' : $out[1]; //'Studio'

        preg_match('#href="vl_label.php\?l=(.*?)"#', $content, $out);
        $arr_data['Label'] = empty($out[1]) ? '' : $out[1]; //'Label'

        preg_match('#<span class="score">\((.*?)\)</span>#', $content, $out);
        $arr_data['score'] = empty($out[1]) ? '' : (floatval($out[1])); //'score'
        preg_match_all('#href="vl_genre.php\?g=(.*?)"#', $content, $out);
        $arr_data['Genre'] = empty($out[1]) ? '' : '['.implode('][', $out[1]).']'; //'Genre'
        preg_match_all('#href="vl_star.php\?s=(.*?)"#', $content, $out);
        //  $arr_data[] = empty($out[1]) ? '' : implode('[]',$out[1]);
        $arr_data['JAV_Idols'] = empty($out[1]) ? '' : '['.implode('][', $out[1]).']'; //'JAV_Idols'
        $s = '<a href="userswanted.php\?v='.$code_36.'">(.*?)</a>';
        preg_match("#$s#", $content, $out);
        $arr_data['userswanted'] = empty($out[1]) ? '' : $out[1]; //'Director'
        preg_match('#href="userswatched.php\?v='.$code_36.'">(.*?)</a>#', $content, $out);
        $arr_data['userswatched'] = empty($out[1]) ? '' : $out[1]; //'Director'
        preg_match('#href="usersowned.php\?v='.$code_36.'">(.*?)</a>#', $content, $out);
        $arr_data['usersowned'] = empty($out[1]) ? '' : $out[1]; //'Director'
        $arr_data['comments'] = strpos($content, '<em>空的列表</em>') === false ? 1 : 0;

        return $arr_data;
    }
}
