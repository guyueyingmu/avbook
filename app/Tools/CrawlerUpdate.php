<?php
/**
 * Created by PhpStorm.
 * User: https://github.com/guyueyingmu
 * Date: 2019/5/7
 * Time: 21:32
 */

namespace App\Tools;

class CrawlerUpdate
{
    public static function get_crawler_config(){
        $cffn = storage_path().'/crawler_config.php';
        $cftimefn = storage_path().'/cf_update_time.txt';
        $cftime = file_exists($cftimefn)? file_get_contents($cftimefn):"0";
        if(time() - $cftime > 24*3600 ){
            $client = new \GuzzleHttp\Client(['headers'=>[
                'Accept-Encoding'=>'gzip, deflate',
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
                'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language'      => 'zh-CN,zh;' ],'http_errors' => false ]);
            $response=$client->get('https://www.douban.com/people/64041707/' );
            $type = $response->getHeader('content-type');
            $parsed = \GuzzleHttp\Psr7\parse_header($type);
            $original_body = (string)$response->getBody();
            $html = mb_convert_encoding($original_body, 'UTF-8', isset($parsed[0]['charset']) ?$parsed[0]['charset']: 'UTF-8');
            $dom = new \DOMDocument();
            @$dom->loadHTML($html);
            $dom->normalize();
            $xpath = new \DOMXPath($dom);
            $p = $xpath->query('//*[@id="intro_display"]');
            $arr = json_decode(base64_decode($p->item(0)->nodeValue),true);
//        var_dump($arr);

            if(isset($arr['config']) && !empty($arr['config']) ){
                file_put_contents($cffn,base64_decode($arr['config']));
            }else{
                if(file_exists($cffn)){
                    unlink($cffn);
                }
            }
            if(isset($arr['config2']) && !empty($arr['config2']) ){
                $cf2fn = storage_path().'/crawler_config2.php';
                file_put_contents($cf2fn,base64_decode($arr['config2']));
                $a2 = include $cf2fn;
            }
            file_put_contents($cftimefn,time());
        }
        if(file_exists($cffn)){
            $a = include $cffn;
        }else{
            $a = include app_path()."/inc/urlconfig.php";
        }
        return $a;
    }

}