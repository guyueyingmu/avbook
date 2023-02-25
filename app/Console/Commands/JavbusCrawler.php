<?php

namespace App\Console\Commands;

use GuzzleHttp\Psr7\Request;

class JavbusCrawler extends BaseCrawler
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avbook:javbus {--movieid=} {--magnetid=} {--moviemax=120} {--movie404=1} {--movie=} {--page=} {--magpage=} {--genre=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Javbus.com Crawler ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle_all_movie($moviemax = 300, $movie404 = 0)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();
        $this->sphost = $cf['javbushost'];
        $this->hosturl = "https://{$this->sphost}/";

        $start_type = 'movie';
        $cki = '__cfduid=abb34186a88cf87a8cf32e4dbbd6b06791472108187'.''.'; existmag=all; appad=off; cnadd5=off; PHPSESSID=b83l3o7d0ps34e14f3xxxx'.rand(1000, 9999);
        $headers = [
            'Host' => $this->sphost,
            'Accept-Encoding' => 'gzip, deflate',
            'Referer' => $this->hosturl,
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8',
            'Cookie' => $cki,
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);

        $r = $this->prepare_movie_rquests("https://{$this->sphost}/AVOP-404", $movie404);
        if ($r) {
            $this->start_spider($moviemax);
        }
    }

    public function handle_movie($movieid)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();

        $this->sphost = $cf['javbushost'];
        $this->hosturl = "https://{$this->sphost}/";

        $start_type = 'movie';
        $cki = '__cfduid=abb34186a88cf87a8cf32e4dbbd6b06791472108187'.''.'; existmag=all; appad=off; cnadd5=off; PHPSESSID=b83l3o7d0ps34e14f3xxxx'.rand(1000, 9999);
        $headers = [
            'Host' => $this->sphost,
            'Accept-Encoding' => 'gzip, deflate',
            'Referer' => $this->hosturl,
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8',
            'Cookie' => $cki,
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);

        $requrl = "https://{$this->sphost}/{$movieid}";
        $response = $this->spclient->get($requrl);
        $code = $response->getStatusCode();
        if ($code == 200) {
            $func_name = $this->func_get_info_name;
            $data = $this->$func_name($response);
            if (! empty($data)) {
                //var_dump($data);
                $this->database->insert($this->in_table_name, $data);
                $this->handle_magnet($data['gid']);
            } else {
            }
        } else {
            echo "$code";
            //$this->error( __METHOD__ .":[$requrl |====链接无效]") ;
            // die;
        }
    }

    public function handle_page($gid)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();
        $this->sphost = $cf['javbushost'];
        $this->hosturl = "https://{$this->sphost}/";

        $start_type = 'page';
        $cki = '__cfduid=abb34186a88cf87a8cf32e4dbbd6b06791472108187'.''.'; existmag=all; appad=off; cnadd5=off; PHPSESSID=b83l3o7d0ps34e14f3xxxx'.rand(1000, 9999);
        $headers = [
            'Host' => $this->sphost,
            'Accept-Encoding' => 'gzip, deflate',
            'Referer' => $this->hosturl,
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8',
            'Cookie' => $cki,
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);

        $r = $this->prepare_page_rquests("https://{$this->sphost}/page/1", 1);
        if ($r) {
            $this->start_spider(200);
        }
    }

    public function handle_all_page($pagenum = 10, $genre = '')
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();
        $this->sphost = $cf['javbushost'];
        $this->hosturl = "https://{$this->sphost}/";
        $start_type = 'page';
        $cki = '__cfduid=abb34186a88cf87a8cf32e4dbbd6b06791472108187'.''.'; existmag=mag; appad=off; cnadd5=off; PHPSESSID=b83l3o7d0ps34e14f3xxxx'.rand(1000, 9999);
        $headers = [
            'Host' => $this->sphost,
            'Accept-Encoding' => 'gzip, deflate',
            'Referer' => $this->hosturl,
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:42.0) Gecko/20100101 Firefox/42.0',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8',
            'Cookie' => $cki,
            'Connection' => 'keep-alive',
            'Cache-Control' => 'max-age=0',
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);
        $r = $this->prepare_page_rquests("https://{$this->sphost}/page/1", $pagenum, $genre);
        if ($r) {
            $this->start_spider(intval($this->option('moviemax')));
        }
    }

    public function handle_all_magnet($pagenum = 1)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();
        $this->sphost = $cf['javbushost'];
        $this->hosturl = "https://{$this->sphost}/";
        $start_type = 'magnet'; //director label  studio  series star magnet

        $headers = [
            'accept' => ' */*',
            'accept-encoding' => ' gzip, deflate',
            'accept-language' => ' zh-CN,zh;q=0.9,en;q=0.8',
            'cookie' => ' __cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1vb1',
            'referer' => ' '.$this->hosturl.'/SGA-128',
            'user-agent' => ' Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
            'x-requested-with' => ' XMLHttpRequest',
        ];
        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);
        $requrl = "{$this->hosturl}ajax/uncledatoolsbyajax.php?gid=39908097745&lang=zh&img=https://pics.javcdn.pw/cover/721a_b.jpg&uc=0&floor=695";

        $r = $this->prepare_mag_rquests($requrl, $pagenum);
        if ($r) {
            $this->start_spider(intval($this->option('moviemax')));
        }
    }

    public function handle_magnet($gid)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();

        $this->sphost = $cf['javbushost'];
        $this->hosturl = "https://{$this->sphost}/";

        $start_type = 'magnet';
        $headers = [
            'accept' => ' */*',
            'accept-encoding' => ' gzip, deflate',
            'accept-language' => ' zh-CN,zh;q=0.9,en;q=0.8',
            'cookie' => ' __cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1vb1',
            'referer' => ' '.$this->hosturl.'/SGA-128',
            'user-agent' => ' Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
            'x-requested-with' => ' XMLHttpRequest',
        ];
//        $r = $this->prepare_sprequests_update(1,1,1);
        $requrl = "{$this->hosturl}ajax/uncledatoolsbyajax.php?gid={$gid}&lang=zh&img=https://pics.javcdn.pw/cover/721a_b.jpg&uc=0&floor=695";

        $this->crawler_client_init($this->hosturl, $start_type, $this->table_prefix, $headers);
        $response = $this->spclient->get($requrl);
        $code = $response->getStatusCode();
        if ($code == 200) {
            $func_name = $this->func_get_info_name;
            $data = $this->$func_name($response, $gid);
            if (! empty($data)) {
                //var_dump($data);
                $this->database->insert($this->in_table_name, $data);
            } else {
            }
        } else {
            echo "error $code";
            //$this->error( __METHOD__ .":[$requrl |====链接无效]") ;
            // die;
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('movieid')) {
            $this->handle_movie($this->option('movieid'));

            return;
        }
        if ($this->option('magnetid')) {
            $this->handle_magnet($this->option('magnetid'));

            return;
        }
        if ($this->option('movie') == 1) {
            $movie404 = $this->option('movie404') * 1;
            $moviemax = $this->option('moviemax') * 1;
            $this->handle_all_movie($moviemax, $movie404);
        }
        if ($this->option('page') * 1 > 0) {
            $this->handle_all_page($this->option('page') * 1, $this->option('genre'));
        }
        if ($this->option('magpage') !== null) {
            $this->handle_all_magnet($this->option('magpage') * 1);
        }
        //php artisan avbook:javbus --movie=1 --page=10 --magpage=10 --movie404=1
    }

    public function update_ja_code_36($table_javbus, $table_avmoo)
    {
        $sql = "UPDATE  {$table_javbus} set avmoo_code_36 = REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(
REPLACE(movie_pic_cover,'cover/',''),'_b.jpg',''),
'https://pics.javbus.info/',''),
'https://pics.javcdn.pw/',''),
'https://images.javcdn.pw/',''),
'https://images.javbus.info/','') 

 where   avmoo_code_36 = '' and  movie_pic_cover like '%https://%' "; //更新 avmoo_code_36
        $this->database->query($sql);
        $data = $this->database->query(" SELECT *  from  {$table_javbus} WHERE movie_pic_cover not like '%https://%' and  avmoo_code_36  =''   ")->fetchAll(\PDO::FETCH_ASSOC);
        $arr = [];
        foreach ($data as $key => $val) {
            $arr[] = $val['movie_pic_cover'];
        }

        $d = $this->database->select($table_avmoo, ['code_36', 'movie_pic_cover'], [
            'movie_pic_cover' => $arr,
        ]);
        foreach ($d as $key => $val) {
            $this->database->query("update   {$table_javbus}  set  avmoo_code_36 = '{$val['code_36']}'   WHERE movie_pic_cover  = '{$val['movie_pic_cover']}'  ");
            echo "update avmoo_code_36 ::  $key  == {$val['code_36']}  == {$val['movie_pic_cover']}\n ";
        }
        $data = $this->database->query(" SELECT count(1) as avmoo_code_36_null_num  from  {$table_javbus} WHERE   avmoo_code_36  =''   ")->fetchAll(\PDO::FETCH_ASSOC);
        echo "avmoo_code_36_null_num : {$data[0]['avmoo_code_36_null_num']} \n";
    }

    public $sp_uri = '';

    public function check_hosturl($requrl)
    {
        $this->info("GET: $requrl  before sql");
        $response = $this->spclient->get($requrl);
        $code = $response->getStatusCode();
        if ($code == 200 || $code == 404) {
        } else {
            $this->error(__METHOD__.":[$requrl |====链接无效]");
            exit;
        }
        $type = $response->getHeader('content-type');
        $parsed = \GuzzleHttp\Psr7\parse_header($type);
        $this->spcharset = isset($parsed[0]['charset']) ? $parsed[0]['charset'] : 'UTF-8';
    }

    public function prepare_page_rquests($requrl, $pagenum = 10, $genre = '')
    {
        $this->sp_uri = 'https://'.$this->sphost.'/page/';
        if (! empty($genre)) {
            $this->sp_uri = 'https://'.$this->sphost.'/genre/'.$genre.'/';
        }
        $this->magnet_time = time();
        $this->check_hosturl($requrl);
        $this->arr_req_code_36 = [];
        for ($i = 1; $i < $pagenum + 1; $i++) {
            $this->arr_req_code_36[] = $i;
        }
        $total = count($this->arr_req_code_36);
        $this->info("{$this->start_type} 升级数量： $total");
        $requests = function ($total) {
            foreach ($this->arr_req_code_36 as $key => $item) {
                $uri = $this->sp_uri.$item;
                echo "[当前($key) 总数($total)| =($item)-|]";
                yield new Request('GET', $uri);
            }
        };
        $this->sprequests = $requests($total);

        return true;
    }

    public function prepare_movie_rquests($requrl, $remove404 = 0)
    {
        $this->info("GET: $requrl  before sql");
        $this->check_hosturl($requrl);
        $sql = 'select   DISTINCT(censored_id) from avbook_avmoo_movie ';
        $this->info($sql);
        $result_code_avmoo = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);

        $sql = 'select   DISTINCT(censored_id) from avbook_javbus_movie';
        $this->info($sql);
        $result_code_javbus = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
        $this->info('javbus 电影 数量：'.count($result_code_javbus));

        $sql = 'SELECT censored_id,COUNT(censored_id) as c FROM `avbook_avmoo_movie`  GROUP BY censored_id  HAVING c>1  ';
        $this->info($sql);
        $result_more = $this->database->query($sql)->fetchAll();
        $this->info('avmoo censored_id 重复电影数量：'.count($result_more));

        foreach ($result_more as $value) {
            // $result_code_javbus[] = $value[0];// 参考 NKD-004 ,重复从1开始 DWD-004
            for ($i = 0; $i < intval($value[1]); $i++) {
                $end = $i + 1;
                $result_code_avmoo[] = $value[0].'-'.$end;
            }
        }
        $this->info('avmoo 电影 数量：'.count($result_code_avmoo));
        $result_dif = array_diff($result_code_avmoo, $result_code_javbus);
//        $result_dif=array_udiff($result_code_avmoo,$result_code_javbus, 'strcasecmp');
        /*        <insert> [2 suc:NKD-002= =avbook_javbus_movie= movie] </insert>
                [get res:4]<insert> [4 suc:NKD-004= =avbook_javbus_movie= movie] </insert>
                [get res:5]<insert> [5 suc:NKD-006= =avbook_javbus_movie= movie] </insert>
                [get res:0]<insert> [0 suc:AB-004= =avbook_javbus_movie= movie] </insert>
                [get res:1]<insert> [1 suc:NKD-001= =avbook_javbus_movie= movie] </insert>
                [get res:6]<insert> [6 suc:NKD-007= =avbook_javbus_movie= movie] </insert>
                [get res:3]<insert> [3 suc:NKD-003= =avbook_javbus_movie= movie] </insert>*/

        if ($remove404 == 1) {
            $sql = "select  code_36 from avbook_crawler_404 where intable_name = '{$this->in_table_name}'  and checkdata = 1";
            $this->info($sql);
            $table_code_36_404 = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
            $result_dif = array_diff($result_dif, $table_code_36_404);
        }
        $this->arr_req_code_36 = array_values($result_dif);
        $total = count($this->arr_req_code_36);
        if ($total == 0) {
            $this->warn("{$this->start_type} 没有增量更新");

            return false;
        }
        $this->info("{$this->start_type} 升级数量： $total");
        $requests = function ($total) {
            foreach ($this->arr_req_code_36 as $key => $item) {
                $uri = 'https://'.$this->sphost.'/'.$item;
                echo "[当前($key) 总数($total)| =($item)-|]";
                yield new Request('GET', $uri);
            }
        };
        $this->sprequests = $requests($total);

        return true;
    }

    public function prepare_mag_rquests($requrl, $pagenum = 1)
    {
        $this->update_ja_code_36('avbook_javbus_movie', 'avbook_avmoo_movie');
        $this->check_hosturl($requrl);
        if ($pagenum == 0) {
//            $sql = "select   DISTINCT(gid)    from {$this->table_prefix}movie   where release_date > date_format(date_sub(now(),interval 1 year), '%Y-%m-%d')  ";
            $sql = "select   DISTINCT(gid)    from {$this->table_prefix}movie   ";
            $this->info($sql);
            $table_code_36 = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
            $this->arr_req_code_36 = array_values($table_code_36);
        } else {
            $slimit = '  ORDER BY t1.magnet_date desc LIMIT '.$pagenum * 30;
            $sql = "SELECT  t2.gid FROM avbook_avmoo_movie t1 LEFT JOIN  avbook_javbus_movie t2 on t1.code_36 = t2.avmoo_code_36  $slimit ";
            $this->info($sql);
            $table_code_36 = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
            $this->arr_req_code_36 = array_values($table_code_36);
        }
        $total = count($this->arr_req_code_36);
        if ($total == 0) {
            $this->warn("{$this->start_type} 没有增量更新");

            return false;
        }
        $this->info("{$this->start_type} 升级数量： $total");
        $requests = function ($total) {
            foreach ($this->arr_req_code_36 as $key => $item) {
                $uri = 'https://'.$this->sphost.'/ajax/uncledatoolsbyajax.php?gid='.$item.'&lang=zh&img=https://pics.javcdn.pw/cover/72z3_b.jpg&uc=0&floor=601';
                echo "[当前($key) 总数($total)| =($item)-|]";
                yield new Request('GET', $uri);
            }
        };

        $this->sprequests = $requests($total);

        return true;
    }

    public function get_info_en_star($response, $c_36 = '')
    {
        // echo '-------'.$content.'\n';

        // Log::info('-------'.$content.'\n');

        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>') === false) {
            echo '页面不完整';

            return null; //不完整
        }
        $arr_data = [];
//<a href="https://www.seedmm.us/en/star/81j">English</a>
        $s = '#<a href="'.$this->hosturl.'star/(.*?)">English</a>#'; // '#<a href="'.$this->hosturl.'star/(.*?)">中文</a>#';
        preg_match($s, $content, $out);
//        echo "$content";
//        var_dump($out);die;

        if (empty($out[1])) {
            return null;
        } else {
            $arr_data['code_36'] = $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'], 36, 10);
        }
        preg_match('#<span class="pb10">(.*?)</span>#', $content, $out);
        $arr_data['star_name'] = empty($out[1]) ? '' : $out[1];

        preg_match('#"https://pics.javcdn.pw/actress/(.*?)"#', $content, $out);
        $arr_data['star_pic'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>D.O.B: (.*?)</p>#', $content, $out);
        $arr_data['star_birthday'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>Age: (.*?)</p>#', $content, $out);
        $arr_data['star_age'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>Cup: (.*?)</p>#', $content, $out);
        $arr_data['star_cupsize'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>Height: (.*?)cm</p>#', $content, $out);
        $arr_data['star_height'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>Bust: (.*?)cm</p>#', $content, $out);
        $arr_data['star_bust'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>Waist: (.*?)cm</p>#', $content, $out);
        $arr_data['star_waist'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>Hips: (.*?)cm</p>#', $content, $out);
        $arr_data['star_hip'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>Hometown: (.*?)</p>#', $content, $out);
        $arr_data['hometown'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>Hobby: (.*?)</p>#', $content, $out);
        $arr_data['hobby'] = empty($out[1]) ? '' : $out[1];
//        var_dump($arr_data);die;

        return $arr_data;
    }

    public function get_info_star($response, $c_36 = '')
    {
        // echo '-------'.$content.'\n';

        // Log::info('-------'.$content.'\n');

        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>') === false) {
            echo '页面不完整';

            return null; //不完整
        }
        $arr_data = [];

        $s = '#<a href="'.$this->hosturl.'star/(.*?)">中文</a>#';
        preg_match($s, $content, $out);

        if (empty($out[1])) {
            return null;
        } else {
            $arr_data['code_36'] = $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'], 36, 10);
        }
        preg_match('#<span class="pb10">(.*?)</span>#', $content, $out);
        $arr_data['star_name'] = empty($out[1]) ? '' : $out[1];

        preg_match('#"https://pics.javcdn.pw/actress/(.*?)"#', $content, $out);
        $arr_data['star_pic'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>生日: (.*?)</p>#', $content, $out);
        $arr_data['star_birthday'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>年齡: (.*?)</p>#', $content, $out);
        $arr_data['star_age'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>罩杯: (.*?)</p>#', $content, $out);
        $arr_data['star_cupsize'] = empty($out[1]) ? '' : $out[1];
        preg_match('#身高: (.*?)cm</p>#', $content, $out);
        $arr_data['star_height'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>胸圍: (.*?)cm</p>#', $content, $out);
        $arr_data['star_bust'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>腰圍: (.*?)cm</p>#', $content, $out);
        $arr_data['star_waist'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>臀圍: (.*?)cm</p>#', $content, $out);
        $arr_data['star_hip'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>出生地: (.*?)</p>#', $content, $out);
        $arr_data['hometown'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>愛好: (.*?)</p>#', $content, $out);
        $arr_data['hobby'] = empty($out[1]) ? '' : $out[1];
        //var_dump($arr_data);die;

        return $arr_data;
    }

    public function get_info_series($response, $c_36 = '')
    {
        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>') === false) {
            echo '页面不完整';

            return null; //不完整
        }
        $arr_data = [];
        $s = '#<a href="'.$this->hosturl.'series/(.*?)">中文</a>#';

        preg_match($s, $content, $out);

        if (empty($out[1])) {
            return null;
        } else {
            $arr_data['code_36'] = $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'], 36, 10);
        }
        preg_match('#<title>(.*?) - 系列 - 影片</title>#', $content, $out);
        $arr_data['series_name'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;
    }

    public function get_info_studio($response, $c_36 = '')
    {
        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>') === false) {
            echo '页面不完整';

            return null; //不完整
        }
        $arr_data = [];
        $s = '#<a href="'.$this->hosturl.'studio/(.*?)">中文</a>#';
        // file_put_contents("tests/html/html_{$this->start_type}.html",$content);
        preg_match($s, $content, $out);
        //var_dump($out);

        if (empty($out[1])) {
            return null;
        } else {
            $arr_data['code_36'] = $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'], 36, 10);
        }
        preg_match('#<title>(.*?) - 製作商 - 影片</title>#', $content, $out);
        $arr_data[$this->start_type.'_name'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;
    }

    public function get_info_director($response, $c_36 = '')
    {
    }

    public function get_info_magnet($response, $c_36 = '')
    {
        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        $need_hd = '包含高清HD的磁力連結';
        $need_sub = '包含字幕的磁力連結';
        $mg_arr = [];
        preg_match_all('#<tr onmouseover="this.style.backgroundColor=[\s\S]*?滑鼠右鍵點擊並選擇【複製連結網址】" href="(.*?)">[\s]*?(.*?)</a>[\s]*?</td>[\s\S]*?【複製連結網址】" href="magnet[\s\S]*?">[\s]*?(.*?)</a>[\s]*?</td>[\s\S]*?【複製連結網址】" href="magnet[\s\S]*?xt=urn:btih:(.*?)&[\s\S]*?">[\s]*?(.*?)</a>[\s]*?</td>#', $content, $out);
        if (! empty($out[2])) {
            foreach ($out[2] as $key => $value) {
                $temp_arr = [];
                $have_hd = 0;
                $have_sub = 0;

                if (strpos($value, $need_hd)) {
                    $have_hd = 1;
                    $value = str_replace('<a class="btn btn-mini-new btn-primary disabled" title="包含高清HD的磁力連結">高清</a>', '', $value);
                }
                if (strpos($value, $need_sub)) {
                    $have_sub = 1;
                    $value = str_replace('<a class="btn btn-mini-new btn-warning disabled" title="包含字幕的磁力連結">字幕</a>', '', $value);
                }
                $temp_arr['gid'] = $c_36;
                $xt = trim($out[4][$key]);
                $temp_arr['magnet_xt'] = $xt;
                $temp_arr['magnet_name'] = trim($value);
                $temp_arr['magnet_type'] = trim($out[3][$key]);
                $temp_arr['magnet_date'] = trim($out[5][$key]);
                $temp_arr['have_hd'] = $have_hd;
                $temp_arr['have_sub'] = $have_sub;
//                $temp_arr =
                $mg_arr[] = $temp_arr;
            }
//            Magnet::insert($mg_arr);
//            $links = Magnet::where('gid',$request->gid)->orderBy('have_hd', 'desc')->orderBy('magnet_type', 'desc')->get();
        }
//        var_dump($mg_arr);
        return $mg_arr;

        //die;
    }

    public $magnet_time = 1;

    public function get_info_page($response, $c_36 = '')
    {
        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        $dom = new \DOMDocument();
        @$dom->loadHTML($content);
        $dom->normalize();
        $xpath = new \DOMXPath($dom);
        $nodeList = $xpath->query('//*[@class="photo-info"]');
        $need_hd = '包含高清HD的磁力連結';
        $need_sub = '包含字幕的磁力連結';
        $t_i = 0;
        foreach ($nodeList as $node) {
            $str_node = $dom->saveHTML($node);
            preg_match_all('#<date>(.*?)</date>#', $str_node, $outid);
            if (! empty($outid[1][0])) {
                $sadd = '';
                if (strpos($str_node, $need_hd)) {
                    $sadd .= ',have_hd=1';
                }
                if (strpos($str_node, $need_sub)) {
                    $sadd .= ',have_sub=1';
                }
                $t_i = $t_i + 1;
                $m_time = $this->magnet_time - ($c_36 * 30) - $t_i;
                $t = date('Y-m-d H:i:s', $m_time);
                $ssql = " update avbook_avmoo_movie set magnet_date = '$t', have_mg = 1 {$sadd}  where censored_id ='{$outid[1][0]}'";
                // echo $ssql .date("Y-m-d H:i:s",time())." \n";
                // echo $outid[1][0],"|";
                $this->database->query($ssql);
            }
        }
    }

    public function get_info_movie($response, $c_36 = '')
    {
        $original_body = (string) $response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        $arr_data = [];

        preg_match('#var gid = (.*?);#', $content, $out);
        $arr_data['gid'] = empty($out[1]) ? '' : $out[1]; ////'gid'
        preg_match('#<p><span class="header">識別碼:</span> <span style="color:\#CC0000;">(.*?)</span>#', $content, $out);
        $arr_data['censored_id'] = empty($out[1]) ? '' : $out[1]; ////'censored_id'

        $censored_id = $out[1];
        if (empty($out[1])) {
            return  null;
        }
        preg_match('#<h3>(.*?)</h3>#', $content, $out);
        $arr_data['movie_title'] = empty($out[1]) ? '' : trim(str_replace($censored_id, '', $out[1])); ////'movie_title'
        preg_match('#<a class="bigImage" href="(.*?)"><img src="#', $content, $out);
//        $find = array(
//            'https://pics.javbus.info/','https://pics.javcdn.pw/','https://images.javcdn.pw/',
//            'https://pics.dmm.co.jp/digital/',
//            'https://images.javbus.info/'
//        );
        //https://images.javbus.info/https://pics.dmm.co.jp/digital/   cover/3q9c_b.jpg
        //update `jav_javbus5_movienew` set movie_pic_cover = REPLACE(movie_pic_cover,'https://pics.javcdn.pw/','')  where movie_pic_cover like "%https://pics.javcdn.pw/%"

        $arr_data['movie_pic_cover'] = empty($out[1]) ? '' : str_replace('https://pics.dmm.co.jp/digital/video/', '', $out[1]); //'movie_pic_cover'

        preg_match('#<span class="header">發行日期:</span> (.*?)</p>#', $content, $out);
        $arr_data['release_date'] = empty($out[1]) ? '' : $out[1]; //'release_date'

        preg_match('#<p><span class="header">長度:</span> (.*?)</p>#', $content, $out);
        $arr_data['movie_length'] = empty($out[1]) ? '' : str_replace('分鐘', '', $out[1]); // 'movie_length'

        preg_match('#<p><span class="header">導演:</span> <a href="'.$this->hosturl.'director/(.*?)">#', $content, $out);
        $arr_data['Director'] = empty($out[1]) ? '' : $out[1]; //'Director'

        preg_match('#<p><span class="header">製作商:</span> <a href="'.$this->hosturl.'studio/(.*?)">#', $content, $out);
        $arr_data['Studio'] = empty($out[1]) ? '' : $out[1]; //'Studio'

        preg_match('#<p><span class="header">發行商:</span> <a href="'.$this->hosturl.'label/(.*?)">#', $content, $out);
        $arr_data['Label'] = empty($out[1]) ? '' : $out[1]; //'Label'

        preg_match_all('#<p><span class="header">系列:</span> <a href="'.$this->hosturl.'series/(.*?)">#', $content, $out);
        $arr_data['Series'] = empty($out[1]) ? '' : implode(',', $out[1]); //'Series'

        preg_match_all('#<span class="genre"><a href="'.$this->hosturl.'genre/(.*?)">#', $content, $out);
        $arr_data['Genre'] = empty($out[1]) ? '' : '['.implode('][', $out[1]).']'; //'Genre'
        preg_match_all('#<a href="'.$this->hosturl.'star/(.*?)"><img src=#', $content, $out);
        $arr_data['JAV_Idols'] = empty($out[1]) ? '' : '['.implode('][', $out[1]).']';
        preg_match_all('#<a class="sample-box" href="(.*?)"><div class="photo-frame">#', $content, $out);
        if (empty($out[1])) {
            preg_match_all('#<div class="photo-frame"><img src="(.*?)" title#', $content, $out);
            if (empty($out[1])) {
                $arr_data['sample_dmm'] = '0';
            } else {
                $arr_data['sample_dmm'] = str_replace('https://pics.dmm.co.jp/digital/video/', '', $out[1][0]).'|'.count($out[1]);
            }
        } else {
            $arr_data['sample_dmm'] = str_replace('https://pics.dmm.co.jp/digital/video/', '', $out[1][0]).'|'.count($out[1]);
        }
        preg_match_all('#class="movie-box" href="'.$this->hosturl.'(.*?)" style="display:inline-block; margin:5px;">#', $content, $out);
        $arr_data['Similar'] = empty($out[1]) ? '' : '['.implode('][', $out[1]).']'; //Similar

        return $arr_data;
    }
}
