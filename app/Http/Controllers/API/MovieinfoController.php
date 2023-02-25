<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Avbooks;
use App\Models\Magnet;
use Illuminate\Http\Request;

class MovieinfoController extends Controller
{
    public function change_state(Request $request)
    {
        if (empty($request->code_36 || $request->statekey)) {
            $res['code'] = 0;
            $res['msg'] = 'code_36 needed';

            return $res;
        }
        $request->statevalue = intval($request->statevalue);
        if ($request->statevalue == 0) {
            // $request->statevalue = null;
        }
        $data = [$request->statekey => $request->statevalue]; //!生产环境应过滤字段 but...
        if ($request->statekey == 'owned' && $request->statevalue == 1) {
            //  $data = array( $request->statekey => $request->statevalue,'have_file'=> 3 );
        }

        $r = Avbooks::where('code_36', $request->code_36)->update($data);

        $res['code'] = $request->statevalue > 0 ? 1 : 0;
        $res['msg'] = "{$request->statekey} 更新成功：".$r;

        return $res;
    }

    public function magnetlinks(Request $request)
    {
        $cf = \App\Tools\CrawlerUpdate::get_crawler_config();

        if (! $request->gid) {
            \Artisan::call("avbook:javbus  --movieid={$request->censored_id}");

            return '<script type="text/javascript"> //location.href = location.href;</script>';
        }
        $links = Magnet::where('gid', $request->gid)->orderBy('magnet_date', 'desc')->orderBy('have_hd', 'desc')->orderBy('magnet_type', 'desc')->get();
        if ($links->isEmpty()) {
            \Artisan::call("avbook:javbus  --magnetid={$request->gid}");
            $links = Magnet::where('gid', $request->gid)->orderBy('magnet_date', 'desc')->orderBy('have_hd', 'desc')->orderBy('magnet_type', 'desc')->get();
        }
        $data['res_mg'] = $links;

        return  view('magnetlinks', $data);
    }

    public function magnetlinks2(Request $request)
    {
        if (! $request->gid) {
            return 'gid is null ';
        }

//        $ch = $this->set_javbus5_curl_mg($request->gid);
//        $tmp_result = curl_exec($ch);
        ////        iconv(  "UTF-8" ,"GBK", $tmp_result);
        ////        echo "  ggg";
        ////        $tmp_result = mb_convert_encoding($tmp_result, 'GBK', 'utf-8');
//        echo $tmp_result;die;

        $client = new \GuzzleHttp\Client();

//        $response = $client->request('GET', 'https://www.baidu.com/',[
//            'headers'=> [
//                'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.106 Safari/537.36',
//                'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8',
//                'Accept-Language' => 'zh-CN,zh;q=0.9,en;q=0.8,sm;q=0.7',
//                'Accept-Encoding' => 'gzip'
//            ],
//            'decode_content' => true,// 解密gzip
//            'connect_timeout' => 10
//        ]);

        $response = $client->request('GET', 'https://www.busjav.us/ajax/uncledatoolsbyajax.php?gid='.$request->gid.'&lang=zh&img=https://pics.javcdn.pw/cover/72z3_b.jpg&uc=0&floor=601', [
            'headers' => [
                'accept' => ' */*',
                'accept-encoding' => ' gzip, deflate',
                'accept-language' => ' zh-CN,zh;q=0.9,en;q=0.8',
                'cookie' => ' __cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1vb1',
                'referer' => ' https://www.seedmm.us/SGA-127',
                'user-agent' => ' Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
                'x-requested-with' => ' XMLHttpRequest',
            ],
            'decode_content' => true,
        ]);

        // print_r($response);

        // 转换成页面使用的编码,默认为UTF-8,否则乱码！
        $type = $response->getHeader('content-type');
        $parsed = \GuzzleHttp\Psr7\parse_header($type);
        $original_body = (string) $response->getBody();
        $utf8_body = mb_convert_encoding($original_body, 'UTF-8', isset($parsed[0]['charset']) ? $parsed[0]['charset'] : 'UTF-8');

//        print_r($utf8_body);
        echo $utf8_body;
        exit;

        $response = $client->request('GET', 'https://www.seedmm.us/ajax/uncledatoolsbyajax.php?gid=40016044296&lang=zh&img=https://pics.javcdn.pw/cover/72qp_b.jpg&uc=0&floor=528', [
            'headers' => [
                'accept' => ' */*',
                'accept-encoding' => ' gzip, deflate',
                'accept-language' => ' zh-CN,zh;q=0.9,en;q=0.8',
                'cookie' => ' __cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1vb1',
                'referer' => ' https://www.seedmm.us/SGA-127',
                'user-agent' => ' Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
                'x-requested-with' => ' XMLHttpRequest',
            ],
            'decode_content' => true,
        ]);
        $response = $response->getBody()->getContents();
        print_r($response);
        exit;
        exit;
//        $links = Magnet::where('gid',$request->gid)->orderBy('have_hd', 'desc')->orderBy('magnet_type', 'desc')->get();
//        $links->isEmpty()
        if (1) {
            $need_hd = '包含高清HD的磁力連結';
            $need_sub = '包含字幕的磁力連結';
            $mg_arr = [];
            $ch = $this->set_javbus5_curl_mg($request->gid);
            $tmp_result = curl_exec($ch);
            echo '<pre> ggg';
            echo $tmp_result;
            exit;
            preg_match_all('#<tr onmouseover="this.style.backgroundColor=[\s\S]*?滑鼠右鍵點擊並選擇【複製連結網址】" href="(.*?)">[\s]*?(.*?)</a>[\s]*?</td>[\s\S]*?【複製連結網址】" href="magnet[\s\S]*?">[\s]*?(.*?)</a>[\s]*?</td>[\s\S]*?【複製連結網址】" href="magnet[\s\S]*?xt=urn:btih:(.*?)&[\s\S]*?">[\s]*?(.*?)</a>[\s]*?</td>#', $tmp_result, $out);
            if (! empty($out[2])) {
                $isup = true;
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
                    $temp_arr['gid'] = $request->gid;
                    $xt = trim($out[4][$key]);
                    $temp_arr['magnet_xt'] = $xt;
                    $temp_arr['magnet_name'] = trim($value);
                    $temp_arr['magnet_type'] = trim($out[3][$key]);
                    $temp_arr['magnet_date'] = trim($out[5][$key]);
                    $temp_arr['have_hd'] = $have_hd;
                    $temp_arr['have_sub'] = $have_sub;
                    array_push($mg_arr, $temp_arr);
                }
                Magnet::insert($mg_arr);
                $links = Magnet::where('gid', $request->gid)->orderBy('have_hd', 'desc')->orderBy('magnet_type', 'desc')->get();
            }
        }
        $data['res_mg'] = $links;
        $data['res_mgbtso'] = [];

        return  view('magnetlinks', $data);
    }

    public function change_genre(Request $request)
    {
        if (empty($request->code_36 || $request->Genre)) {
            return 'code_36 needed';
        }
        $movie_info = Avbooks::where('code_36', $request->code_36)->first();
        $find = ['[', ']'];
        $str = str_replace($find, '', str_replace('][', ',', $movie_info['Genre']));
        $arr = explode(',', $str);
        $res = [];

        if (! in_array($request->Genre, $arr)) {
            $tempstr = '';
            if ('84m' == $request->Genre && (! in_array('4m', $arr))) {
                $tempstr = '[4m]';
            }
            $data = ['Genre' => $movie_info['Genre'].'['.$request->Genre.']'.$tempstr];
            Avbooks::where('code_36', $request->code_36)->update($data);
            $res['code'] = 1;
            $res['msg'] = '添加成功';
        } else {
            $data = ['Genre' => str_replace('['.$request->Genre.']', '', $movie_info['Genre'])];
            Avbooks::where('code_36', $request->code_36)->update($data);
            $res['code'] = 2;
            $res['msg'] = '删除成功';
        }

        return $res;
        //return view('layout_genre');
    }

    public function change_genre_all(Request $request)
    {
        $where_books[] = ['Genre', 'like', '%['.$request->Genre.']%'];

        $movie_infos = Avbooks::where($where_books)->get();
//        return $movie_infos;
        $find = ['[', ']'];
        $res = [];
        foreach ($movie_infos as $movie_info) {
            $str = str_replace($find, '', str_replace('][', ',', $movie_info['Genre']));
            $arr = explode(',', $str);

            if (! in_array($request->Genre, $arr)) {
//                $data = array( 'Genre' =>  $movie_info['Genre'].'['.$request->Genre .']' );
//                Avbooks::where('code_36',$movie_info['code_36'] )->update($data);
//                $res['code']=1;
//                $res['msg'] = "添加成功";
            } else {
                $data = ['Genre' => str_replace('['.$request->Genre.']', '', $movie_info['Genre'])];
                Avbooks::where('code_36', $movie_info['code_36'])->update($data);
                $res['code'] = 2;
                $res['msg'] = '删除成功';
            }
        }

        return $res;
        //return view('layout_genre');
    }

    public function save_blogjav_img(Request $request)
    {
        if (empty($request->censored_id) || empty($request->imgurl)) {
            return 'censored_id needed';
        }
        $data = ['blogjav_img' => $request->imgurl]; //!生产环境应过滤字段 but...
        $r = Avbooks::where('censored_id', $request->censored_id)->update($data);

        $res['code'] = 1;
        $res['msg'] = '更新成功：'.$r;

        return $res;
    }

    private function set_javbus5_curl_mg($f_code)
    {
        $bushost = 'www.busjav.us';
        $url = 'https://www.seedmm.us/ajax/uncledatoolsbyajax.php?gid=40016044296&lang=zh&img=https://pics.javcdn.pw/cover/72qp_b.jpg&uc=0&floor=528';

        $ch = curl_init();
        $cki = '__cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1x'.rand(1000, 9999);
        $cki = '__cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1vb1';
        // 设置浏览器的特定header
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'accept: */*',
            'accept-encoding: gzip, deflate, br',
            'accept-language: zh-CN,zh;q=0.9,en;q=0.8',
            'cookie: __cfduid=d81cc88b23e9028e96a7163ab877395191555602526; starinfo=glyphicon%20glyphicon-plus; existisgenres=gr_single; existmag=mag; 4fJN_2132_saltkey=Gj4yHsTs; 4fJN_2132_lastvisit=1555681998; PHPSESSID=qm0du428o07jr3ujljfd3t1vb1',
            'referer: https://www.seedmm.us/SGA-127',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
            'x-requested-with: XMLHttpRequest',
        ]);
//        curl_setopt($ch, CURLOPT_COOKIE, $cki);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36');
        // 在HTTP请求头中"Referer: "的内容。
//        curl_setopt($ch, CURLOPT_REFERER, $bushost);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate, br');
//        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 302redirect
        // 针对https的设置
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        // $html = curl_exec($ch);
        return $ch;
    }
}
