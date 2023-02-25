@extends('layout')
@section('title', ($title?$title:"AvBook 影片資料庫 - 磁力連結分享").' -  第'.($_GET['page'] ?? 1).'页')
@section('navbar_right')

    <ul class="nav navbar-nav navbar-right">
        <li class="">
            <?php $mg = isset($_GET['mg'])?$_GET['mg']:'0'; $config_mg = ['0'=>['glyphicon-magnet','已有磁力','1'],'1'=>['glyphicon-film','全部影片','0']];
            $t_get = $_GET;
            $t_get['page']=1;
            $t_get['mg']=$config_mg[$mg][2];
            $t_get['ltitle'][]=$config_mg[$mg][1];
            $t_get['ltitle'] = array_diff($t_get['ltitle'], [$config_mg[abs($mg-1)][1]]);
            ?>
            <a title = "当前显示：{{$config_mg[!$mg][1]}} 点击切换到：{{$config_mg[$mg][1]}}" href="{{action([\App\Http\Controllers\AvbookController::class, 'index'], $t_get)}}" class="" data-toggle="" data-hover="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon {{$config_mg[$mg][0]}}" style="font-size:12px;"></span><span class="hidden-md hidden-sm">{{$config_mg[$mg][1]}}</span>  </a>

        </li>
        <li class="">
            <?php $mg = isset($_GET['owned']) ?$_GET['owned']:'0'; $config_mg = ['0'=>['glyphicon-folder-close','已拥有','1'],'1'=>['glyphicon-folder-open','未拥有','0']];
            $t_get = $_GET;
            $t_get['page']=1;
            $t_get['owned']=$config_mg[$mg][2];
            $t_get['ltitle'][]=$config_mg[$mg][1];
            $t_get['ltitle'] = array_diff($t_get['ltitle'], [$config_mg[abs($mg-1)][1]]);
            ?>
            <a  title = "当结果筛选：{{$config_mg[$mg][1]}}"  href="{{action([\App\Http\Controllers\AvbookController::class, 'index'], $t_get)}}"
                class="" data-toggle="" data-hover="dropdown" role="button" aria-expanded="false">
                <span class="glyphicon {{$config_mg[$mg][0]}}" style="font-size:12px;"></span> <span class="hidden-md hidden-sm">{{$config_mg[$mg][1]}}</span>  </a>

        </li>
    </ul>


    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button"
               aria-expanded="false">
                <span class="glyphicon glyphicon-th-list" style="font-size:12px;"></span>
                <span class="hidden-md hidden-sm">当前结果筛选</span>
                <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                @foreach ($filter as $key=>$val)

                    <?php $t_get = $_GET;$t_get['page']=1;$tf = explode('=',$key);$t_get[$tf[0]]=$tf[1];$t_get['ltitle[]']=$val;  ?>
                    <li id="cellshowall"> <a href="{{action([\App\Http\Controllers\AvbookController::class, 'index'], $t_get)}}" t="{{url()->full()}}&page=1&{{$key}}&ltitle[]={{$val}}"  target="_blank">
                            <span class="glyphicon glyphicon-film"> </span>{{" ".$val}}</a></li>
                @endforeach

            </ul>
        </li>
    </ul>
@endsection

@section('content')
    <script src="avbook/focus.js"></script>
    <link rel="stylesheet" type="text/css" href="avbook/main.css">
    <script src="avbook/jquery.masonry.min.js"></script>

    <div class="container-fluid">
        <div class="row">
            <!--
        <table class="ad-table">
            <tbody>
            <tr>
                <td><iframe src="avbook/iframe.html" width="728" height="90" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" style="padding-top:3px;"></iframe></td>
                <td><a href="http://www.sbav18.com/?Intr=25360117" target="_blank" rel="nofollow"><img src="avbook/hg728x90_3.gif" width="728" height="90"></a></td>
            </tr>
            <tr>
                <td><a href="http://222ylg.com/?Agent=javbus" target="_blank" rel="nofollow"><img src="avbook/ylg4.gif"></a></td>
                <td><a href="http://www.1495013.com/?Agent=ad0092" target="_blank" rel="nofollow"><img src="avbook/pj728x90_1.gif"></a></td>
            </tr>

        </tbody></table>

        <div class="ad-list">
        <div class="hidden-xs pt10 text-center"><iframe src="avbook/iframe(1).html" width="728" height="90" scrolling="no" marginwidth="0" marginheight="0" frameborder="0" style="padding-top:3px;"></iframe></div> <div class="pt10 text-center bn728-93"><a href="http://www.sbav18.com/?Intr=25360117" target="_blank" rel="nofollow"><img src="avbook/hg728x90_3.gif" width="728" height="90"></a></div> <div class="pt10 text-center bn728-93"><a href="http://222ylg.com/?Agent=javbus" target="_blank" rel="nofollow"><img src="avbook/ylg4.gif"></a></div> <div class="pt10 text-center bn728-93"><a href="http://www.1495013.com/?Agent=ad0092" target="_blank" rel="nofollow"><img src="avbook/pj728x90_1.gif"></a></div> <div class="pt10 text-center bn728-93"><a href="http://vns800600.net/?aff=646908" target="_blank" rel="nofollow"><img src="avbook/hg728x90_4.gif"></a></div> <div class="pt10 text-center bn728-93"><a href="http://www.kxmav2.com/?aff=646884" target="_blank" rel="nofollow"><img src="avbook/hg728x90_2.gif" width="728" height="90"></a></div>  </div>
                        -->
            <!--
            <div class="alert alert-info alert-dismissable alert-common" style="position:relative">
                <button type="button" class="close" style="position:absolute; right:8px; top:3px;"
            data-dismiss="alert"
            onclick='javascript:$.cookie("cnadd5", "off",{expires: 365,path: "/"})'>×</button>
                <div class="row">
                    <div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址發布頁：</strong><a href="https://announce.javbus8.com/website.php" target="_blank">https://announce.javbus8.com/website.php</a></div>
            <div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.javbus5.com/" rel="nofollow">https://www.javbus5.com</a></div><div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.javbus2.com/" rel="nofollow">https://www.javbus2.com</a></div><div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.javbus3.com/" rel="nofollow">https://www.javbus3.com</a></div>
                </div>
            </div>

            -->
            <div id="waterfall" class="masonry" style="position: relative; height: 2173px; width: 1309px;">

                <?php if (!empty($res_star)): ?>
                <div class="item masonry-brick" style="position: absolute; top: 0px; left: 0px;">
                    <div class="avatar-box">
                        <div class="photo-frame">
                            <img class="star_pic"
                                 src="https://jp.netcdn.space/mono/actjpgs/<?php echo $res_star['star_pic'] ?>"
                                 title="<?php echo $res_star['star_name'] ?>">
                        </div>
                        <div class="photo-info">
                            <span class="pb10"><?php echo $res_star['star_name'] ?></span>
                            <p>生日: {{$res_star['star_birthday']}}</p>
                            <p>年龄: <?php echo $res_star['star_age'] ?></p>
                            <p>身高: <?php echo $res_star['star_height'] ?>cm</p>
                            <p>罩杯: <?php echo $res_star['star_cupsize'] ?></p>
                            <p>胸围: <?php echo $res_star['star_bust'] ?>cm</p>
                            <p>腰围: <?php echo $res_star['star_waist'] ?>cm</p>
                            <p>臀围: <?php echo $res_star['star_hip'] ?>cm</p>
                            <p>出生地: <?php echo $res_star['hometown'] ?></p>
                            <p>爱好: <?php echo $res_star['hobby'] ?></p>
                            <p>
                                <a href="censored?st0=<?php echo $res_star['code_36'] ?>"
                                   target="_blank" style="color:#CC0000;">独自演出作品</a></p>
                            <p><a href="https://avso.pw/cn/search/<?php echo $res_star['code_36'] ?>"
                                  target="_blank" style="color:#CC0000;"> </a></p>


                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <?php
                $b = 2;
                if ($b == 1) {
                    $picurl = 'https://jp.netcdn.space/digital/video/';
                } elseif ($b == 2) {
                    $picurl = "https://pics.dmm.co.jp/digital/video/";
                    //$picurl ="";
                } ?>
                    <?php foreach ($list as $movie_info): ?>
                    <div class="item masonry-brick" style="position: absolute; top: 0px; left: 0px;">
                        <a class="movie-box"  target="_blank"  href = '{{url("/movie?censored_id={$movie_info['censored_id']}&id={$movie_info['code_36']}") }}'>
                            <div class="photo-frame">
                                <img class='blur0 imgjumpnull'
                                     src="<?php echo $picurl . str_replace('pl.jpg', 'ps.jpg', $movie_info['movie_pic_cover']) ?>"
                                     data="index.php/jav/javsg/<?php echo $movie_info['censored_id'] ?>&id=<?php echo $movie_info['code_36'] ?>"
                                     title="<?php echo $movie_info['movie_title'] ?>">
                                <!--   onerror="this.src='avbook/deft.jpg'" -->
                            </div>
                            <div class="photo-info">
						<span title="<?php echo $movie_info['movie_title'];//'owned','favorite','wanted','watched', ?>">

						 <?php echo mb_substr(str_replace($movie_info['censored_id'], '', $movie_info['movie_title']), 0, 20) ?> <br>
						<div class="item-tag">
                            @include('itemtag', ['movie_info' => $movie_info])
                        </div>
                            <date><?php echo $movie_info['censored_id'] ?></date>
                            <date class=" btncp2<?php echo $movie_info['censored_id'] ?>"><?php echo $movie_info['release_date'] ?></date></span>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
    <script language="JavaScript">
        (function ($) {
            $('#waterfall').masonry({
                itemSelector: ".item",
                isAnimated: false,
                isFitWidth: true
            });
            //alert()

        })(jQuery);
    </script>
    <div class="text-center hidden-xs">
        {!! $list->appends($page_info)->links() !!} <br>
        总数：{!! $list->total()!!} <br><br>
    </div>
    <script>
        $('.pagination').addClass('pagination-lg');
        $("[rel='next']").html('下一页');
        $("[rel='prev']").html('上一页');
    </script>

@endsection