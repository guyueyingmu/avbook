<?php

namespace App\Console\Commands;


class AvmooCrawler extends BaseCrawler
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avbook:avmoo {--max=30} {--remove404=1} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Avmoo.com Crawler';

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
        //
        $movie404 = $this->option('remove404')*1;
        $moviemax = $this->option('max')*1;

        $cf =\App\Tools\CrawlerUpdate::get_crawler_config();

        $this->sphost = $cf['avmoohost'];
        $this->hosturl = "https://{$this->sphost}/cn/";

        $hosturl = $this->hosturl;
        $table_prefix = "avbook_avmoo_";
        $funcname = '';
//        $funcname = 'get_info_en_star';
        $headers = [
            'Host'=>$this->sphost,
            'Accept-Encoding'=>'gzip, deflate',
            'Referer'=>$this->hosturl,
            'User-Agent' => 'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',
//            'User-Agent' => 'Mozilla/5.0 (en-us) AppleWebKit/525.13 (KHTML, like Gecko; Google Web Preview) Version/3.1 Safari/525.13',
//            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.81 Safari/537.36',
            'Accept'     => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language'      => 'zh-CN,zh;',
//            "Connection" =>"keep-alive",
            "Cache-Control" =>"max-age=0",
//            'Cookie' =>'__cfduid=d419cd947fa86af7b8ace1caf598485611556282341; _ga=GA1.2.1134019080.1556282339; _gid=GA1.2.1274232198.1556282339; AD_adst_j_POPUNDER=2; AD_exoc_j_M_728x90=1; AD_javu_j_P_728x90=10; AD_enterTime=1556461071; AD_exoc_j_L_728x90=1; AD_clic_j_POPUNDER=2; AD_exoc_j_POPUNDER=2; AD_juic_j_L_728x90=3; AD_juic_j_M_728x90=3; AD_wav_j_P_728x90=23'

        ];


        $arr_type = ['movie', 'star' ,'director', 'label',  'studio',  'series' ] ;

        foreach ($arr_type as $start_type) {
            $this->crawler_client_init($hosturl,$start_type,$table_prefix,$headers,$funcname);
            $r = $this->prepare_sprequests_update($movie404,1,1);
            if($r){
                $this->start_spider($moviemax);
            }
        }
        //php artisan avbook:avmoo --max=2
    }

    public function get_info_movie($response,$c_36='')
    {

        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();
        preg_match('#<li><a href="'.$this->hosturl.$this->start_type.'/'.'(.*?)">简体中文</a></li>#', $content, $out);

        $c_36 =  empty($out[1]) ? '' : $out[1];
        $arr_data['code_36'] = $c_36;////'code_36'
        preg_match('#<p><span class="header">识别码:</span> <span style="color:\#CC0000;">(.*?)</span></p>#', $content, $out);

        if (empty($out[1])) {
            return  null;
        }
        $arr_data['censored_id'] =  $out[1];
        $codeid=$out[1];
        preg_match('#<h3>(.*?)</h3>#', $content, $out);
        $arr_data['movie_title'] = empty($out[1]) ? '' : trim(str_replace($codeid, '', $out[1]));////'movie_title'
        preg_match('#<a class="bigImage" href="(.*?)"#', $content, $out);
        $arr_data['movie_pic_cover'] = empty($out[1]) ? '' : str_replace('https://jp.netcdn.space/digital/video/', '',$out[1]);//'movie_pic_cover'

        preg_match('#<p><span class="header">发行时间:</span> (.*?)</p>#', $content, $out);
        $arr_data['release_date'] = empty($out[1]) ? date("Y-m-d"): $out[1];//'release_date'

        preg_match('#<p><span class="header">长度:</span> (.*?)分钟</p>#', $content, $out);
        $arr_data['movie_length'] = empty($out[1]) ? '' : $out[1];// 'movie_length'

        preg_match('#<p><span class="header">导演:</span> <a href="'.$this->hosturl.'director/(.*?)">#', $content, $out);
        $arr_data['Director'] = empty($out[1]) ? '' : $out[1];//'Director'

        preg_match('#<a href="'.$this->hosturl.'studio/(.*?)">#', $content, $out);
        $arr_data['Studio'] = empty($out[1]) ? '' : $out[1];//'Studio'

        preg_match('#<a href="'.$this->hosturl.'label/(.*?)">#', $content, $out);
        $arr_data['Label'] = empty($out[1]) ? '' : $out[1];//'Label'

        preg_match_all('#<a href="'.$this->hosturl.'series/(.*?)">#', $content, $out);
        $arr_data['Series'] = empty($out[1]) ? '' : implode(',',$out[1]);//'Series'

        preg_match_all('#<a href="'.$this->hosturl.'genre/(.*?)">#', $content, $out);
        $arr_data['Genre'] = empty($out[1]) ? '' : '['.implode('][',$out[1]).']';//'Genre'

        preg_match_all('#href="'.$this->hosturl.'star/(.*?)">#', $content, $out);
        $arr_data['JAV_Idols'] = empty($out[1]) ? '' : '['.implode('][',$out[1]).']';//'JAV_Idols'

        preg_match_all('#<a class="sample-box" href="(.*?)"#', $content, $out);
        if (empty($out[1])) {
            $arr_data['sample_dmm']= '0';
        }else{
            $arr_data['sample_dmm'] =count($out[1]);// str_replace('https://jp.netcdn.space/digital/', '', implode('|',$out[1]));
        }

        $arr_data['code_10'] =  base_convert($c_36,36,10);

        return $arr_data;

    }
    public function get_info_en_star($response,$c_36='')
    {
        // echo '-------'.$content.'\n';

        // Log::info('-------'.$content.'\n');

        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();

        $s = '#<a href="'.$this->hosturl.'star/(.*?)">English</a>#';
        //preg_match('#<a href="https://avmoo.xyz/cn/star/(.*?)">简体中文</a>#', $content, $out);
        preg_match($s, $content, $out);
//        var_dump($out);die;
        $arr_data['code_36'] = empty($out[1]) ? '' : $out[1];
        if(!empty($arr_data['code_36'])){
            $arr_data['code_10'] = base_convert($arr_data['code_36'],36,10);
        }else{
            return null;
        }
        preg_match('#<span class="pb-10">(.*?)</span>#', $content, $out);
        $arr_data['star_name'] = empty($out[1]) ? '' : $out[1];
//var_dump($arr_data);die;

//
//        preg_match('#"https://jp.netcdn.space/mono/actjpgs/(.*?)"#', $content, $out);//https://jp.netcdn.space/mono/actjpgs/yosizawa_akiho.jpg
//        $arr_data['star_pic'] = empty($out[1]) ? '' : $out[1];
//
//
//        preg_match('#<p>生日: (.*?)</p>#', $content, $out);
//        $arr_data['star_birthday'] = empty($out[1]) ? '' : $out[1];
//
//        preg_match('#<p>年龄: (.*?)</p>#', $content, $out);
//        $arr_data['star_age'] = empty($out[1]) ? '' : $out[1];
//
//
//        preg_match('#罩杯: (.*?)</p>#', $content, $out);
//        $arr_data['star_cupsize'] = empty($out[1]) ? '' : $out[1];
//        preg_match('#<p>身高: (.*?)cm</p>#', $content, $out);
//        $arr_data['star_height'] = empty($out[1]) ? '' : $out[1];
//
//        preg_match('#<p>胸围: (.*?)cm</p>#', $content, $out);
//        $arr_data['star_bust'] = empty($out[1]) ? '' : $out[1];
//        preg_match('#<p>腰围: (.*?)cm</p>#', $content, $out);
//        $arr_data['star_waist'] = empty($out[1]) ? '' : $out[1];
//        preg_match('#<p>臀围: (.*?)cm</p>#', $content, $out);
//        $arr_data['star_hip'] = empty($out[1]) ? '' : $out[1];
//
//        preg_match('#<p>出生地: (.*?)</p>#', $content, $out);
//        $arr_data['hometown'] = empty($out[1]) ? '' : $out[1];
//        preg_match('#<p>爱好: (.*?)</p>#', $content, $out);
//        $arr_data['hobby'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;

    }
    public function get_info_star($response,$c_36='')
    {
        // echo '-------'.$content.'\n';

        // Log::info('-------'.$content.'\n');

        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();

        $s = '#<a href="'.$this->hosturl.'star/(.*?)">简体中文</a>#';
        //preg_match('#<a href="https://avmoo.xyz/cn/star/(.*?)">简体中文</a>#', $content, $out);
        preg_match($s, $content, $out);
        $arr_data['code_36'] = empty($out[1]) ? '' : $out[1];
        if(!empty($arr_data['code_36'])){
            $arr_data['code_10'] = base_convert($arr_data['code_36'],36,10);
        }else{
            return null;
        }
        preg_match('#<span class="pb-10">(.*?)</span>#', $content, $out);
        $arr_data['star_name'] = empty($out[1]) ? '' : $out[1];
        preg_match('#"https://jp.netcdn.space/mono/actjpgs/(.*?)"#', $content, $out);//https://jp.netcdn.space/mono/actjpgs/yosizawa_akiho.jpg
        $arr_data['star_pic'] = empty($out[1]) ? '' : $out[1];


        preg_match('#<p>生日: (.*?)</p>#', $content, $out);
        $arr_data['star_birthday'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>年龄: (.*?)</p>#', $content, $out);
        $arr_data['star_age'] = empty($out[1]) ? '' : $out[1];


        preg_match('#罩杯: (.*?)</p>#', $content, $out);
        $arr_data['star_cupsize'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>身高: (.*?)cm</p>#', $content, $out);
        $arr_data['star_height'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>胸围: (.*?)cm</p>#', $content, $out);
        $arr_data['star_bust'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>腰围: (.*?)cm</p>#', $content, $out);
        $arr_data['star_waist'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>臀围: (.*?)cm</p>#', $content, $out);
        $arr_data['star_hip'] = empty($out[1]) ? '' : $out[1];

        preg_match('#<p>出生地: (.*?)</p>#', $content, $out);
        $arr_data['hometown'] = empty($out[1]) ? '' : $out[1];
        preg_match('#<p>爱好: (.*?)</p>#', $content, $out);
        $arr_data['hobby'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;

    }
    public function get_info_series($response,$c_36=''){
        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();
        $s = '#<a href="'.$this->hosturl.'series/(.*?)">简体中文</a>#';

        preg_match($s, $content, $out);
        if(empty($out[1])){
            return null ;
        }else{
            $arr_data['code_36'] =  $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'],36,10);
        }
        preg_match('#<title>(.*?) - 系列 - 影片 - AVMOO</title>#', $content, $out);
        $arr_data['series_name'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;

    }
    public function get_info_studio($response,$c_36=''){
        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();
        $s = '#<a href="'.$this->hosturl.'studio/(.*?)">简体中文</a>#';
        //file_put_contents("tests/html/html_{$this->start_type}.html",$content);
        preg_match($s, $content, $out);
        //var_dump($out);


        if(empty($out[1])){
            return null ;
        }else{
            $arr_data['code_36'] =  $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'],36,10);
        }
        preg_match('#<title>(.*?) - 制作商 - 影片 - AVMOO</title>#', $content, $out);
        $arr_data[$this->start_type.'_name'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;

    }
    public function get_info_director($response,$c_36=''){
        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);
        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();
        $s = '#<a href="'.$this->spbase_url.'(.*?)">简体中文</a>#';
        //file_put_contents("tests/html/ahtml_{$this->start_type}.html",$content);
        preg_match($s, $content, $out);
        if(empty($out[1])){
            return null ;
        }else{
            $arr_data['code_36'] =  $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'],36,10);
        }
        preg_match('#<title>(.*?) - 导演 - 影片 - AVMOO</title>#', $content, $out);
        $arr_data[$this->start_type.'_name'] = empty($out[1]) ? '' : $out[1];

        return $arr_data;

    }
    public function get_info_label($response,$c_36=''){

        $original_body = (string)$response->getBody();
        $content = mb_convert_encoding($original_body, 'UTF-8', $this->spcharset);

        if (strpos($content, '</html>')===false) {
            echo "页面不完整";
            return null ;//不完整
        }
        $arr_data = array();
        $s = '#<a href="'.$this->spbase_url.'(.*?)">简体中文</a>#';
        preg_match($s, $content, $out);
        if(empty($out[1])){
            return null ;
        }else{
            $arr_data['code_36'] =  $out[1];
            $arr_data['code_10'] = base_convert($arr_data['code_36'],36,10);
        }
        preg_match('#<title>(.*?) - 发行商 - 影片 - AVMOO</title>#', $content, $out);
        $arr_data[$this->start_type.'_name'] = empty($out[1]) ? '' : $out[1];
//        var_dump($arr_data);die;
        return $arr_data;

    }
}
