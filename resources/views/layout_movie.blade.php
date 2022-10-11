@extends('layout')
@section('title', $movie_info['censored_id'].$movie_info['movie_title'])
@section('content')
<link rel="stylesheet" type="text/css" href="avbook/movie.css">
<link rel="stylesheet" type="text/css" href="avbook/movie-box.css">
<link rel="stylesheet" href="avbook/star-rating.min.css" media="all" type="text/css"/>

<script src="avbook/star-rating.min.js" type="text/javascript"></script>
{{--<script src="avbook/themes/zh.js" type="text/javascript"></script>--}}
{{--<link rel="stylesheet" href="avbook/themes/krajee-fa/theme.css" media="all" type="text/css"/>--}}
{{--<script src="avbook/themes/krajee-fa/theme.js" type="text/javascript"></script>--}}

<link rel="stylesheet" href="avbook/font-awesome.min.css">
<script>
    var censored_id = "{{$movie_info['censored_id']}}";
    var gid = "{{$avbus->gid ??  ''}}";
    var code_36 = "<?php echo $movie_info['code_36'] ?>";
    var uc = 0;
    var img = 'https://pics.javbus.info/cover/5r2i_b.jpg';
</script>

<style type="text/css">
    #add-loading {
        position: fixed;
        width: 200px;
        height: 100px;
        z-index: 1000;
        left: 50%;
        top: 50%;
        margin-left: -100px;
        margin-top: -100px;
        opacity: 0.95;
        display: none;
    }
</style>

<div id="add-loading">
    <table class="search-loading-box" border="0" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td align="center">
                <table height="80" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td height="40" align="center">
                            <div class="search-loading-text" id='addmsg'>s...</div>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" align="center">
                            <img src="avbook/search_loading.gif" border="0">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>


<div class="container">
    <?php
    $b=1;
    if(isset($_GET['picurl'])){

    }
    if ($b==1) {
        $picurl ='https://jp.netcdn.space/digital/video/';
    }elseif ($b==2){
        $picurl ="https://pics.dmm.co.jp/digital/video/";
        //$picurl ="";
    } ?>
    {{--<h3 >


    </h3>--}}
        @include('itemtag', ['movie_info' => $movie_info])
        <?php $sh = '';if ($movie_info['owned'] == 1){ $sh = '<a class="btn btn-mini-new btn-danger disabled  "  >已拥有</a>'; }  echo $sh .mb_substr( $movie_info['movie_title'], 0, 70) ?>
    <div class="row movie"><!-- https://pics.javbus.info/sample/5rvz_11.jpg   https://jp.netcdn.space/ https://pics.dmm.co.jp/digital/video/ipz00865/ipz00865jp-12.jpg-->
        <div class="col-md-9 screencap">
            <a class="bigImage" href="<?php echo $picurl.$movie_info['movie_pic_cover'] ?>" >
                <img class = "bigImagesrc" src="<?php echo $picurl.$movie_info['movie_pic_cover'] ?>"

                ></a>
            <!-- onerror="this.src='avbook/cheshen.jpg'"

<a title="上一个识别码 {{$last_censored_id}}" href="movie?censored_id={{$last_censored_id}}"><span class="glyphicon glyphicon-chevron-left"></span>=== </a><a
                title="下一个识别码 {{$next_censored_id}}" href="movie?censored_id={{$next_censored_id}}"> ===<span  style = "height:20px" class="glyphicon glyphicon-chevron-right" ></span></a>

            <span title="收藏" value="" class="mypointer favicon" style="color:#777; font-size: 18px;"><span class="glyphicon glyphicon-heart-empty"></span></span>
            -->
        </div>
        <div class="col-md-3 info">

            <p><span class="header">识别码:</span><a href="{{url()->full()}}"><span style="color:#CC0000;"><?php echo $movie_info['censored_id'] ?></span></a>

            </p>
            <p>
                <a title="上一个识别码 {{$last_censored_id}}" href="movie?censored_id={{$last_censored_id}}"><span class="glyphicon glyphicon-chevron-left"></span>上一页 |</a><a
                        title="下一个识别码 {{$next_censored_id}}" href="movie?censored_id={{$next_censored_id}}"> 下一页<span  style = "height:20px" class="glyphicon glyphicon-chevron-right" ></span></a> <a  href = '' title="//游标分页 wait to do " > </a>
                &nbsp;&nbsp;&nbsp;<a id = "a_img" class='blogjavimg' href = ''  ></a>
            </p>
            <p>
                <a></a>
            </p>

            <p><span class="header">磁力搜索:</span><a target="_blank"  href="{{$url_config['btsourl']}}<?php echo $movie_info['censored_id'] ?>"> <span style="color:#CC0000;"><?php echo $movie_info['censored_id'] ?></span></a></p>

            <p><span class="header">javbus:</span><a target="_blank"  href="https://{{$url_config['javbushost']}}/<?php echo $movie_info['censored_id'] ?>"> <span style="color:#CC0000;"><?php echo $movie_info['censored_id'] ?></span></a></p>


            <p><span class="header">avmoo:</span><a target="_blank"  href="https://{{$url_config['avmoohost']}}/cn/movie/<?php echo $movie_info['code_36'] ?>"> <span style="color:#CC0000;"><?php echo $movie_info['censored_id'] ?></span></a></p>

            <p><span class="header">javlibrary:</span>
                <a target="_blank"  href="http://{{$url_config['javlibhost']}}/cn/<?php echo ( $movie_info['javlib']['code_36'] ? '?v='.$movie_info['javlib']['code_36'] : 'vl_searchbyid.php?keyword='.$movie_info['censored_id']) ?>"> <span style=" "><?php echo $movie_info['censored_id'] ."({$movie_info['javlib']['usersowned']})({$movie_info['javlib']['userswanted']})({$movie_info['javlib']['userswatched']})" ?></span></a></p>

            <!--   //cc3001.dmm.co.jp/litevideo/freepv/o/ofj/ofje00070/ofje00070_dmb_w.mp4
            //cc3001.dmm.co.jp/litevideo/freepv/n/n_1/n_1010gihhd067/n_1010gihhd067_dmb_w.mp4
http://www.q30x.com/cn/vl_searchbyid.php?keyword=ABS-231
-->
            <p><span class="header">预告片:</span>


                <a target="_blank"  href="https://cc3001.dmm.co.jp/litevideo/freepv/<?php
                $pic_video = $movie_info['movie_pic_cover'];
                if( is_numeric(substr($pic_video,0,1))){// 118abp00108/118abp00108pl.jpg
                    $pic_video = substr($pic_video,0,strpos($pic_video,'/'));
                    $idx = strpos($pic_video,'00');
                    $pic_video =substr($pic_video,0,$idx).substr($pic_video,$idx+2,strlen($pic_video)-$idx-2) ;
                    $pic_video = "$pic_video/{$pic_video}pl.jpg";
                }
                $pic_video = substr($pic_video,0,1)."/".substr($pic_video,0,3)."/".str_replace('pl.jpg','_dmb_w.mp4',$pic_video);
                echo  $pic_video ?>"> <span  ><?php
                        echo str_replace('_dmb_w.mp4','',basename($pic_video))    ?></span></a>

                <a target="_blank"  href="https://cc3001.dmm.co.jp/litevideo/freepv/<?php
                $pic_video = $movie_info['javlib']['movie_pic_cover'];
                $pic_video = substr($pic_video,0,1)."/".substr($pic_video,0,3)."/".str_replace('pl.jpg','_dmb_w.mp4',$pic_video);
                echo  $pic_video ?>"> <span  ><?php
                        echo str_replace('_dmb_w.mp4','',basename($pic_video))    ?></span></a>
            </p>


            @if ($movie_info['release_date'])
                <span class="header">发行时间:</span><?php echo $movie_info['release_date'] ?>
            @endif
                @if ( $movie_info['movie_length'])
                    <span class="header">长度:</span><?php echo $movie_info['movie_length'] ?>分钟</p>
                @endif
            </p>
            @if ($movie_info['Director'])
                <p><span class="header">导演:</span> <a href="censored?director=<?php echo $movie_info['Director'] ?>"><?php echo $movie_info['director_name']['director_name'] ?></a></p>
            @endif

            @if ($movie_info['Studio'])
                <p><span class="header">制作商: </span><a href="censored?Studio=<?php echo $movie_info['Studio'] ?>"><?php echo $movie_info['studio_name']['studio_name'] ?></a></p>
            @endif
            @if ($movie_info['Label'])
                <p><span class="header">发行商: </span><a href="censored?Label=<?php echo $movie_info['Label'] ?>"><?php echo $movie_info['label_name']['label_name'] ?></a></p>
            @endif

            @if ($movie_info['Series'])
                <style>
                    .sphfont{
                        color:#ff9918;
                    }
                </style>
                <p><span class="header sphfont "  >系列:</span><a target="_blank" href="censored?Series=<?php echo $movie_info['Series'] ?>"><?php echo $movie_info['series_name']['series_name'] ?></a></p>
            @endif

            <p>
                <span class="header">类别: </span>
                <?php $genre_map =[];//unset($genre_config[$val['genre_code']]); ?>

                    <?php  foreach($res_genre as $key=>$val): ?>
                    <span class="genre"><a datagenre= "{{$val['genre_code']}}"  href="censored?gc[]=<?php echo $val['genre_code'] ?>&mg=1&ltitle[]={{$val['genre_dsce']}}"><?php echo $val['genre_dsce'] ?></a></span>
                    <?php  $genre_map[$val['genre_code'].'_'] = 1; ?>
                    <?php endforeach; ?>
            </p>
            <p>
                <span class="header">修改类别:</span>
                <?php  foreach($genre_config as $key=>$val): ?>
                    <a class="btn btn-mini-new   <?php if(isset($genre_map[$key.'_'])){
                        echo 'btn-warning" title = "删除类别：'.$val." $key" ;
                    }else{
                        echo 'btn-default" title = "添加类别：'.$val." $key" ;
                    }; ?>"

                       onclick="change_genre(this,'{{$key}}')" >{{$val}}</a>
                <?php endforeach; ?>

            </p>

            <p>
                <input type="text" class="kv-fa-heart rating-loading" value="{{$movie_info['favorite']}}" data-size="xs" title="评分">
            </p>

            <p>
                <span class="header">修改状态:</span>
                <?php $state_config =['wanted'=>['想要的','(没有资源 有资源无法下载)'],'watched'=>['已看过',''],'owned'=>['已拥有',''] ]; foreach($state_config as $key=>$val): ?>
                <a class="btn btn-mini-new btncl-{{$key}}  <?php
                        //没有高清资源 有高清资源无法下载

                if($movie_info[$key]>0){

                    echo 'btn-success" title = "删除状态：'.$val[0]." $key ".$val[1] ;

                }else{
                    echo 'btn-default" title = "添加状态：'.$val[0]." $key " .$val[1] ;
                };
                $newstate = !$movie_info[$key];
                ?>"

                   onclick="change_state('{{$key}}','{{$newstate}}',this)" >{{$val[0]}}</a>
                <?php endforeach; ?>

                <a class="btn btn-mini-new btn-default" title = "清除访问记录 {{$movie_info['visited']}} "
                   onclick="change_state('visited','0');$(this).html(0);" >{{$movie_info['visited']}}</a>

            </p>


            <p class="star-show">
                <span class="header" style="cursor: pointer;">演員</span>:
                <span id="star-toggle" class="glyphicon glyphicon-plus" style="cursor: pointer;"></span>
            </p>

            <ul>


                <?php  foreach($res_star as $key=>$val): ?>
                <div id="star_<?php echo $val['code_36'] ?>" class="star-box star-box-common star-box-up idol-box" style="left: 1047px; top: 326px; position: fixed; display: none;">
                    <li>
                        <a href="censored?st=<?php echo $val['code_36'] ?>"><img dsrc="https://jp.netcdn.space/mono/actjpgs/<?php echo $val['star_pic'] ?>"
                                                                                      src = 'https://pics.javcdn.pw/actress/{{$val['code_36']}}_a.jpg' title=""></a>
                        <div class="star-name"><a href="censored?st=<?php echo $val['code_36'] ?>&mg=1&ltitle[]={{$val['star_name']}}" title="<?php echo $val['star_name'] ?>"><?php echo $val['star_name'] ?></a></div>

                    </li>
                </div>
                <?php endforeach; ?>

                 <?php  if(count($res_star)<1):?>
                    暫無出演者資訊
                <?php endif; ?>
            </ul>

            <p>
                <?php  foreach($res_star as $key=>$val): ?>
                <span class="genre" onmouseover="hoverdiv(event,'star_<?php echo $val['code_36'] ?>')" onmouseout="hoverdiv(event,'star_<?php echo $val['code_36'] ?>')">
					<a href="censored?st=<?php echo $val['code_36'] ?>&mg=1&ltitle[]={{$val['star_name']}}"><?php echo $val['star_name'] ?></a>
				</span>
                <?php endforeach; ?>
            </p>



        </div>
    </div>

    {{--<h4>樣品圖像</h4>--}}


    <div id="sample-waterfall">
        <?php
        // var_dump(strrpos('digital', $movie_info['sample_dmm']));die;
//        if (strrpos($movie_info['sample_dmm'],'digital')!==false) {
//            $movie_info['sample_dmm'] = str_replace('digital/', '',  $movie_info['sample_dmm']);
//            $movie_info['sample_dmm'] = str_replace('-', 'jp-',  $movie_info['sample_dmm']);
//
//        }
        $heade=str_replace('digital/', '', str_replace('pl.jpg', '', $movie_info['movie_pic_cover']));
        $m= '';
        if ($movie_info['sample_dmm']==0) {
            for ($i = 0; $i < 21; $i++) {
                $a=$heade.'jp-'.$i.'.jpg';
                $m =$m."|".$a;
            }
        }elseif(strlen($movie_info['sample_dmm']) < 10 ){
            for ($i = 1; $i < intval($movie_info['sample_dmm'])+1; $i++) {
                $a=$heade.'jp-'.$i.'.jpg';
                $m =$m."|".$a;
            }
        }
        $movie_info['sample_dmm']=$m ?$m :$movie_info['sample_dmm'] ;

        $arr = explode('|', $movie_info['sample_dmm']);

        foreach($arr as $key=>$val): ?>
        <?php  if($val):?>
        <a class="sample-box" href="<?php echo $picurl.$val ?>" title="<?php echo $movie_info['movie_title'] ?> - 样品图像 -- 1">
            <div class="photo-frame">
                <img  class="sample-img-load"  src="<?php echo $picurl.str_replace('jp-', '-', $val)?>"

                >
            </div>

        </a>
        <?php endif; ?>
        <?php endforeach; ?>
    </div>

            <a title="上一个识别码 {{$last_censored_id}}" href="movie?censored_id={{$last_censored_id}}"><span class="glyphicon glyphicon-chevron-left"></span> </a><a
                    title="下一个识别码 {{$next_censored_id}}" href="movie?censored_id={{$next_censored_id}}"> <span  style = "height:20px" class="glyphicon glyphicon-chevron-right" ></span></a>
            <?php $sh = '';if ($movie_info['have_file'] == 3){ $sh = '<span style="color:red;">[已有文件]</span>'; }  echo $sh .$movie_info['censored_id'].' '.  $movie_info['movie_title']  ?>



<script type="text/javascript">
    var n=0;
// function check_remove(obj) {  // onload  ="check_remove(this)"  onerror="this.src='avbook/defts.jpg'"
//     if (obj.width==66 && obj.height==90){
//         $(obj).remove();
//     }
// }
    //console.log( this.width+'=='+this.height);

    $(function () {
        $(".sample-img-load").each(function() {
            //console.log(n++);
            var img = $(this);
            img.load(function () {
                // img.attr("isLoad", "true");
                // console.log(img.height());
                if(img.width()==66 ){
                    //img.remove();
                }
                //console.log( img.width+'ee=='+img.height);
            });
            img.error(function() {
               // console.log(6);
                //可以选择替换图片
            });
        });
    });
</script>
        <h4 id="mag-submit-show" style="cursor: pointer;">磁力連結投稿 <span id="mag-submit-toggle" class="glyphicon glyphicon-plus"></span><?php  if( $movie_info['owned']==1 || $movie_info['have_file']==3 ||$movie_info['have_file']==1):?>
            <a class="btn btn-mini-new btn-danger disabled  "  >已拥有</a>
            <?php  endif;?>

            <?php  if( $movie_info['have_file']!=0):?>
            <a class="btn btn-mini-new btn-primary disabled  "  ><?php echo $movie_info['have_file']?></a>
            <?php  endif;?>

        </h4>
        <div id="mag-submit" class="movie" style="padding:30px 20px 30px 5px;">
            <div id="mag-submit-hide" class="close" style="margin:-25px -13px 0 0;">×</div>
            <div class="col-md-11 col-xs-10">
                <div class="input-group">
                    <div class="input-group-addon">magnet地址:</div>
                    <input type="text" class="form-control" id="appendedInputButton">
                </div>
            </div>
            <button type="button" class="btn btn-default col-md-1 col-xs-2" onclick="checktxt()" data-toggle="modal" data-target="#magneturlpost">分享</button>
        </div>
        <!-- Magnet Verify Modal -->
        <div id="magneturlpost" class="modal fade" tabindex="-1" role="dialog"></div>
        <div class="movie" style="padding:12px; margin-top:15px">
            <table id="magnet-table" class="table table-condensed table-striped table-hover" style="margin-bottom:0;">
                <tbody><tr style="font-weight:bold;">
                    <td>磁力名稱 <span class="glyphicon glyphicon-magnet"></span></td>
                    <td style="text-align:center;white-space:nowrap">檔案大小</td>
                    <td style="text-align:center;white-space:nowrap">分享日期</td>
                </tr>
                </tbody>
            </table>
            <div id="movie-loading" style="display: none;">
                <table width="120" border="0" cellpadding="5" cellspacing="0">
                    <tbody>
                    <tr>
                        <td align="center">
                            <font class="ajax-text"><img src="avbook/movie_loading.gif" border="0"></font>
                        </td>
                        <td align="center">
                            <font class="ajax-text">讀取中...</font>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <table id="magnet-table2" class="table table-condensed table-striped table-hover" style="margin-bottom:0;">

            </table>
        </div>

        <div class="row ptb30">
            <div class="col-xs-6 text-center">
                <a href="" class="btn btn-lg btn-primary btn-block" target="_blank" rel="nofollow"><span class="glyphicon glyphicon-play"></span> 在線播放</a>
            </div>
            <div class="col-xs-6 text-center">
                <a href="" class="btn btn-lg btn-warning btn-block" target="_blank" rel="nofollow"><span class="glyphicon glyphicon-save"></span> 下載觀看</a>
            </div>
        </div>


        <div id="star-div">
            <h4 id="star-hide" style="cursor: pointer;">演員 <span class="glyphicon glyphicon-minus"></span></h4>
            <div id="avatar-waterfall">
                <?php  foreach($res_star as $key=>$val): ?>
                <a class="avatar-box" href="censored?st=<?php echo $val['code_36'] ?>">
                    <div class="photo-frame">
                        <img src="<?php echo str_replace("/digital/video",'',$picurl).'/mono/actjpgs/'.$val['star_pic'] ?>"  dsrc = 'https://pics.javcdn.pw/actress/{{$val['code_36']}}_a.jpg'  title="">
                    </div>
                    <span><?php echo $val['star_name'] ?></span>
                </a>
                <?php endforeach; ?>

            </div>

        </div>


        <div class="clearfix"></div>


        <h4>同類影片</h4>
        <div id="related-waterfall" class="mb20">

            <?php  foreach($res_more as $key=>$val): ?>
            <a  title="<?php echo $val['movie_title'] ?>"  class="movie-box" href="/movie?censored_id=<?php echo $val['censored_id'] ?>&id=<?php echo $val['code_36'] ?>" style="display:inline-block; margin:5px;">
                <div class="photo-frame">
                    <img src="<?php echo $picurl.str_replace('pl.jpg', 'ps.jpg', $val['movie_pic_cover'] )?>"
                    >
                </div>
                <div class="photo-info" style="height:36px; overflow:hidden; text-align:center;">
                    <span><?php echo $val['censored_id'] ?></span> @include('itemtag', ['movie_info' => $val])
                </div>
            </a>


            <?php endforeach; ?>



        </div>

        <div class="col-md-3 info i4444">
            <br><br>
        </div>
        <div id="related-waterfall2" class="mb20">



        </div>

        <script>

            function change_genre(obj,s){
                var t = "/api/change_genre?Genre="+s+"&code_36="+code_36  ;
                var obj = $(obj);
                $.ajax({
                    url: t,
                    type: "GET",
                    success: function(res) {
                        ShowMsg(res.msg);
                        if(res.code==1){
                            obj.removeClass('btn-default')
                            obj.addClass('btn-warning')
                        }else{
                            obj.removeClass('btn-warning')
                            obj.addClass('btn-default')
                            // $("a[datagenre='"+s+"']").remove()
                        }
                       // location.reload()
                    }
                });
            };
            function change_state(key,value,objs){
                var t = "/api/change_state?statekey="+key+"&statevalue="+value  +"&code_36="+code_36  ;
                var obj = $(objs);
                $.ajax({
                    url: t,
                    type: "GET",
                    success: function(res) {
                         ShowMsg(res.msg);
                        if (!objs)
                            return
                        //location.reload()
                        if(res.code==0){
                            obj.removeClass('btn-success')
                            obj.addClass('btn-default')
                        }else{
                            obj.removeClass('btn-default')
                            obj.addClass('btn-success')
                        }

                    }
                });
            };

            (function($){
                $('.bigImage').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    closeBtnInside: false,
                    fixedContentPos: true,
                    mainClass: 'mfp-no-margins mfp-with-zoom',
                    image: {
                        verticalFit: true,
                        titleSrc: function(item) {
                            return 'fg';
                        }
                    },
                    zoom: {
                        enabled: true,
                        duration: 300
                    }
                });
                var config ={
                    delegate: 'a',
                    type: 'image',
                    closeOnContentClick: false,
                    closeBtnInside: false,
                    mainClass: 'mfp-with-zoom mfp-img-mobile ',
                    image: {
                        verticalFit: true,
                        titleSrc: function(item) {
                            return '<?php  echo $movie_info['movie_title']  ?>';
                        }
                    },
                    gallery: {
                        enabled: true
                    },
                    zoom: {
                        enabled: true,
                        duration: 300,
                        opener: function(element) {
                            return element.find('img');
                        }
                    }

                }

                $('#sample-waterfall').magnificPopup(config);
            })(jQuery);

            // console.log(blurimg);



            $(function() {
                //var t = "../ajax/uncledatoolsbyajax.php?gid=" + gid + "&lang=" + lang + "&img=" + img + "&uc=" + uc + "&floor=" + Math.floor(Math.random() * 1e3 + 1);
                var t = '/api/magnetlinks?gid='+gid +'&censored_id=' +censored_id ;
                $.ajax({
                    url: t,
                    type: "GET",
                    success: function(e) {
                        //alert()
                        $("#magnet-table").append(e);
                      //  $('#mag-submit-show').click();
                    }
                });

                $('.kv-fa-heart').rating({
                    // showClear: false,
                    clearButtonTitle:"",
                    clearCaption:'',
                    min: 0, max: 10, step: 1, size: "xl", stars: "5",
                    starCaptionClasses: function(val) {
                        if (val == 0) {
                            return 'label label-default badge-default';
                        }else if (val < 3) {
                            return 'label label-default badge-default';
                        }else if (val < 5) {
                            return 'label label-warning badge-warning';
                        }else if (val < 7) {
                            return 'label label-info badge-info';
                        }else if (val < 9) {
                            return 'label label-primary badge-primary';
                        }else {
                            return 'label label-success badge-success';
                        }
                    },
                    showCaptionAsTitle: false,
                    clearButton: '<span class="header" style = "color: #333">收藏评分: <i  title = "点击取消收藏" class="glyphicon glyphicon-minus-sign"></i></span>',
                    // showCaption: false,
                    defaultCaption: '{rating} hh',
                    starCaptions: function (rating) {
                        return rating;
                    },
                    theme: 'krajee-fa',
                    filledStar: '<i class="fa fa-heart"></i>',
                    emptyStar: '<i class="fa fa-heart-o"></i>'
                });

                $('.kv-fa-heart').on('rating:change', function(event, value, caption) {
                    console.log(value);
                    console.log(caption);
                    change_state('favorite',value)
                });
                $('.kv-fa-heart').on('rating:clear', function(event) {
                    change_state('favorite','0');
                });
            })
//<span class="glyphicon glyphicon-heart"></span>
            var heartstate = true;

            function resetheartstate(obj,state) {
                if(state){
                    obj.html('<span class="glyphicon glyphicon-heart"></span>');
                }else{
                    obj.html('<span class="glyphicon glyphicon-heart-empty"></span>');
                }
                return !heartstate
            }

            $(".info .mypointer").click(function(){
                var obj = $(this);
                var code = obj.attr('value');
                var token = $("#token").val();
                var e = "../ajax/addfavorite.php?code=" + encodeURIComponent(code) + "&token=" + encodeURIComponent(token) + "&floor=" + Math.floor(Math.random() * 1e3 + 1);

                heartstate = resetheartstate(obj,heartstate)
                // $.ajax({
                //     url: e,
                //     type: "POST",
                //     //dataType: "json",
                //     cache:false,
                //     success: function (json) {
                //         //obj.html(json);
                //         ajaxobj=eval("("+json+")");
                //         if(ajaxobj.act=='err'){
                //             alert('收藏次數達上限，請稍候再試');
                //         }else{
                //             obj.html(ajaxobj.act);
                //             obj.attr('value',ajaxobj.code);
                //             obj.attr('title',ajaxobj.title);
                //             $("#token").val(ajaxobj.token);
                //         }
                //     }
                // });
            });

            $(".glyphicon-heart-empty").hover(function () {
                $(this).removeClass('glyphicon-heart-empty');
                $(this).addClass('glyphicon-heart');
            }, function () {
                $(this).removeClass('glyphicon-heart');
                $(this).addClass('glyphicon-heart-empty');
            });
            $(".glyphicon-heart").hover(function () {
                $(this).removeClass('glyphicon-heart');
                $(this).addClass('glyphicon-heart-empty');
            }, function () {
                $(this).removeClass('glyphicon-heart-empty');
                $(this).addClass('glyphicon-heart');
            });

        </script>
</div>

<script src="avbook/gallery.js"></script>

@endsection