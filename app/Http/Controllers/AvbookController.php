<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Avbooks;
use App\Models\Movies;
use App\Models\Javbus;
use App\Models\Actresses;
class AvbookController extends Controller
{
    public function index(Request $request)
    {
        $where_map = ['hd' => 'have_hd',
            'sub' => 'have_sub',
            'file' => 'have_file',
            'Series' => 'Series',
            'Label' => 'Label',
            'Studio' => 'Studio',
            'director' => 'director','wanted' => 'wanted'
        ];
        $table_key = ['movie_title','movie_pic_cover','censored_id',
            'have_file','have_mg','have_sub','have_hd','owned','favorite','wanted','watched',
            'Genre','code_36','release_date'];
        $title = '';
        $orderby = "magnet_date";
        $where_books = [];
        $page_info = [];

        foreach ($request->all() as $key => $value) {
            if(isset($where_map[$key])){
                $where_books[]=[$where_map[$key],$value];
            }
            $page_info[$key] = $value;
        }
        if($request->mg=='1'){
            $where_books[] =['have_mg','1'];
        }elseif($request->mg==='0'){
            $orderby = 'code_10';
        }
        if($request->ltitle){
            $request->ltitle = array_unique($request->ltitle);
            $title = implode('-',$request->ltitle);
        }
//        var_dump($request->owned);die;
        if($request->owned=='1'){
            $where_books[] =['owned','1'];
            $page_info['ltitle'] = array_diff($page_info['ltitle'], ["未拥有"]);
        }elseif ($request->owned === '0'){
            //var_dump($page_info['ltitle']);die;
            $page_info['ltitle'] = array_diff($page_info['ltitle'], ["已拥有"]);
            $where_books[] =['owned','0'];
        }
        if($request->favorite=='1'){
            $where_books[] =['favorite','>','0'];;
        }


        if($request->notfile){
            $where_books[] =['have_file','!=',$request->notfile];
        }
        if($request->notSeries=='_'){
            $where_books[] =['Series','!=',''];
        }
        if($request->gc){
            $request->gc = array_unique($request->gc);
            foreach ($request->gc as $genrecode) {
                $where_books[] =['Genre','like','%['.$genrecode.']%'];
            }
        }
        if($request->strgc){
            $arr_gc = explode('-',$request->strgc);
            foreach ($arr_gc as $genrecode) {
                $where_books[] =['Genre','like','%['.$genrecode.']%'];
            }
        }

        if($request->notgc){
            $request->notgc = array_unique($request->notgc);
            foreach ($request->notgc as $genrecode) {
                $where_books[] =['Genre','not like','%['.$genrecode.']%'];
            }
        }
        if($request->st){
            $where_books[] =['JAV_Idols','like','%['.$request->st.']%'];
            $data['res_star']=Actresses::where('code_36',$request->st)->first();;
        }
        if($request->st0){
            $where_books[] =['JAV_Idols','['.$request->st0.']'];
        }
        if($request->orderby){
            $orderby = $request->orderby;
        }
        $idkeyk= [];
        if($request->search){

            preg_match_all('/([a-zA-Z]{2,6})[-|_|\s]{0,3}([0-9]{3,4})(.*?)/', $request->search,$out);
            foreach ($out[1] as $key => $value) {
                $idkeyk[strtoupper($out[1][$key]).'-'.$out[2][$key]]=1;//."({$out[0][$key]})"
            }
            if (empty($idkeyk)) {
                $where_books[] =['movie_title','like','%'.$request->search.'%'];
            }else{
                $idkeyk=array_keys($idkeyk);
            }
        }

        if(!empty($where_books)){
            $Avbooks = Avbooks::select($table_key)->where($where_books)->orderBy($orderby, 'desc')->orderBy('code_10', 'desc')->paginate(config('avbook.cen_per_page'));
            //return $Avbooks;
        }else{
            if(empty($idkeyk)){
                $Avbooks = Avbooks::select($table_key)->orderBy($orderby, 'desc')->orderBy('code_10', 'desc')->paginate(config('avbook.cen_per_page'));
            }else{
                $Avbooks = Avbooks::select($table_key)->whereIn('censored_id', $idkeyk)->orderBy('code_10', 'desc')->paginate(config('avbook.cen_per_page'));
                if ($Avbooks->count()==1){
                    Header("Location: ".url('/movie?censored_id='.$Avbooks->first()->censored_id));
                }
            }
        }

        $data['list']= $Avbooks;
        $data['title']= $title;
        $data['filter']= config('avbook.filter');
        $data['page_info']= $page_info;
        return view('layout_censored',$data );
    }


    public function movie(Request $request)
    {
        $censored_id = $request->censored_id;
        $censored_id = str_replace(" ",'',$censored_id);
        if($request->checkid){
            $request->checkid   = str_replace(" ",'',$request->checkid);
            if(strpos($request->checkid,'-')===false){
                preg_match('#(\d{1,5})#', $request->checkid, $out);
                if(isset($out[1])){
                    $censored_id = str_replace($out[1],'',$request->checkid)."-".$out[1];
                    Header("Location: ".url('/movie?censored_id='.$censored_id));
                    die;
                }
            }
            $censored_id = $request->checkid;
        }
        preg_match('#(\d{1,5})#', $censored_id, $outnum);
        if(isset($outnum[1])){
            $censored_id_num = $outnum[1];
            $data['last_censored_id'] = str_replace($censored_id_num,''.sprintf('%03s', $censored_id_num+1),$censored_id);
            $data['next_censored_id'] = str_replace($censored_id_num,''.sprintf('%03s', $censored_id_num-1),$censored_id);
        }

        if($request->id){
            $movie_info= Movies::where('code_36',$request->id)->first();
        }else{
            $movie_info= Movies::where('censored_id',$censored_id)->orderBy('code_10', 'desc')->first();
        }
        if (empty($movie_info)) {
            die($censored_id  ."==not find <a href = '/movie?censored_id={$data['last_censored_id']}'><=== </a> || <a href = '/movie?censored_id={$data['next_censored_id']}'>===> </a>");
        }
        if($movie_info['visited']<254){
            $movie_info['visited']=$movie_info['visited'] +1;
            $t_update = ['visited'=>$movie_info['visited']];
            Avbooks::where('code_36',$movie_info['code_36'])->update($t_update);

        }
        $find=array('[',']');
        $movie_info['JAV_Idols'] = str_replace($find, '',str_replace('][', ',', $movie_info['JAV_Idols']));
        $arr_star = explode(',', $movie_info['JAV_Idols']);
        $idols_info = Actresses::whereIn('code_36', $arr_star)->get();

        $movie_info['Genre'] = str_replace($find, '',str_replace('][', ',', $movie_info['Genre']));
        $arr_genre_code =explode(',', $movie_info['Genre']) ;
        $genre_info = DB::table('jav_avmoo_genre_name')
            ->whereIn('genre_code', $arr_genre_code)->get();

        $avbus = Javbus::where('avmoo_code_36',$movie_info['code_36'])->orWhere('censored_id',$movie_info['censored_id'])->first();

        $res_more= [ ];
        if (!empty($avbus->Similar)) {
            $Similar= explode(',', str_replace($find, '',str_replace('][', ',',$avbus->Similar)));
            $res_more =Avbooks::whereIn('censored_id', $Similar)->get();
        }
        $genre_config=['4m'=>'主观视角','8'=>'眼镜' ];
        // [['class="btn-warning ',''],['4m'=>'主观视角','8'=>'眼镜','84m'=>'完全主观' ]];//自定义添加类别

        $data['res_star'] = json_decode(json_encode($idols_info),true); ;//$user->toArray();
        $data['res_genre'] = json_decode(json_encode($genre_info),true);
        $data['genre_config'] = $genre_config;
        $data['res_more'] = $res_more;
        $data['movie_info'] = $movie_info;
        $data['avbus'] = $avbus ;
        $data['url_config'] = \App\Tools\CrawlerUpdate::get_crawler_config() ;
        $data['pagenext'] = '';

        return view('layout_movie', $data);

    }
    public function genre(Request $request)
    {
        return view('layout_genre');
    }
    public function actresses(Request $request)
    {
        $data['actresses']= Actresses::orderBy('file_num', 'desc')->paginate(30);
        return view('actresses',$data);
    }

}
