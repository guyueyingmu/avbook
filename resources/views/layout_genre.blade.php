@extends('layout')
@section('navbar_right')
@section('title', '有码类别')
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
            <a href="/genre#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-filter" style="font-size:12px;"></span> <span class="hidden-md hidden-sm">多選類別</span> <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
                <li class="mypointer" id="showgr_single"><a><span class="glyphicon glyphicon-filter"></span>單選類別</a></li>
            </ul>
        </li>
    </ul>


@endsection

@section('content')

    <div class="container-fluid pt10">

        <style type="text/css">
            @media screen and (max-width: 1490px) {
                .ad-table {display:none;}
            }
            @media screen and (min-width: 1490px) {
                .ad-list {display:none;}
            }
        </style>

        {{--<table class="ad-table">--}}
        {{--<tbody><tr>--}}
        {{--<td><a href="https://www.77167w.com:2885/?a=403381" target="_blank" rel="nofollow"><img src="avbook/znj_xyc_728x90_1.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="http://103.214.164.35/javbus.htm" target="_blank" rel="nofollow"><img src="avbook/ylg728x90_1.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="http://sb99z.net/?Intr=25360117" target="_blank" rel="nofollow"><img src="avbook/hg728x90_10.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="http://pu.p99998888.com:888/297603.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_30.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><script data-cfasync="false" async="" src="https://adserver.juicyads.com/js/jads.js"></script><ins id="708048" data-width="728" data-height="90"></ins><script type="text/javascript" data-cfasync="false" async="">(adsbyjuicy = window.adsbyjuicy || []).push({"adzone":708048});</script></td>--}}
        {{--<td><a href="http://www.7003666.com:8859/?aff=646884" target="_blank" rel="nofollow"><img src="avbook/hg728x90_3.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="http://www.7711888888.com:1188/4387.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_41.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="http://hg.g77775555.com:888/720698.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_43.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="http://yin.5562666.com:8080/5566.html" target="_blank" rel="nofollow"><img src="avbook/yh728x90_13.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="https://48855268.com/javbus.html" target="_blank" rel="nofollow"><img src="avbook/c89_728x90_8.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="https://58qp365.com/?c=U9LVB" target="_blank" rel="nofollow"><img src="avbook/c89_728x90_9.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="http://dj.q77777777.com:901/1782268.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_38.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="http://ky.g66667777.com:8001/JBWEC.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_44.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="https://617c93.com/vote_topic_5072490.do" target="_blank" rel="nofollow"><img src="avbook/c89_728x90_7.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="https://www.99006v.com:3369/?a=234461" target="_blank" rel="nofollow"><img src="avbook/znj_xyc_728x90_2.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="http://www.142904.com/javb.html" target="_blank" rel="nofollow"><img src="avbook/ylg728x90_2.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="http://www.20171444.com:8888/Register/?a=15771866" target="_blank" rel="nofollow"><img src="avbook/mw728x90_42.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="http://bcbm.bcbm66666.com:890/bs18.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_35.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}
        {{--<tr>--}}
        {{--<td><a href="http://hao.6955000.com:2020/7078.html" target="_blank" rel="nofollow"><img src="avbook/yh728x90_14.gif" width="728" height="90"></a></td>--}}
        {{--<td><a href="https://www.724c51.com/vote_topic_42431.do" target="_blank" rel="nofollow"><img src="avbook/c63_728x90_7.gif" width="728" height="90"></a></td>--}}
        {{--</tr>--}}

        {{--</tbody></table>--}}


        {{--<div class="ad-list">--}}
        {{--<div class="pb10 text-center bn728-93"><a href="https://www.77167w.com:2885/?a=403381" target="_blank" rel="nofollow"><img src="avbook/znj_xyc_728x90_1.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://103.214.164.35/javbus.htm" target="_blank" rel="nofollow"><img src="avbook/ylg728x90_1.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://sb99z.net/?Intr=25360117" target="_blank" rel="nofollow"><img src="avbook/hg728x90_10.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://pu.p99998888.com:888/297603.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_30.gif" width="728" height="90"></a></div> <div class="hidden-xs text-center"><script data-cfasync="false" async="" src="https://adserver.juicyads.com/js/jads.js"></script><ins id="708048" data-width="728" data-height="90"></ins><script type="text/javascript" data-cfasync="false" async="">(adsbyjuicy = window.adsbyjuicy || []).push({"adzone":708048});</script></div> <div class="pb10 text-center bn728-93"><a href="http://www.7003666.com:8859/?aff=646884" target="_blank" rel="nofollow"><img src="avbook/hg728x90_3.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://www.7711888888.com:1188/4387.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_41.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://hg.g77775555.com:888/720698.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_43.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://yin.5562666.com:8080/5566.html" target="_blank" rel="nofollow"><img src="avbook/yh728x90_13.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="https://48855268.com/javbus.html" target="_blank" rel="nofollow"><img src="avbook/c89_728x90_8.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="https://58qp365.com/?c=U9LVB" target="_blank" rel="nofollow"><img src="avbook/c89_728x90_9.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://dj.q77777777.com:901/1782268.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_38.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://ky.g66667777.com:8001/JBWEC.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_44.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="https://617c93.com/vote_topic_5072490.do" target="_blank" rel="nofollow"><img src="avbook/c89_728x90_7.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="https://www.99006v.com:3369/?a=234461" target="_blank" rel="nofollow"><img src="avbook/znj_xyc_728x90_2.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://www.142904.com/javb.html" target="_blank" rel="nofollow"><img src="avbook/ylg728x90_2.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://www.20171444.com:8888/Register/?a=15771866" target="_blank" rel="nofollow"><img src="avbook/mw728x90_42.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://bcbm.bcbm66666.com:890/bs18.html" target="_blank" rel="nofollow"><img src="avbook/mw728x90_35.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="http://hao.6955000.com:2020/7078.html" target="_blank" rel="nofollow"><img src="avbook/yh728x90_14.gif" width="728" height="90"></a></div> <div class="pb10 text-center bn728-93"><a href="https://www.724c51.com/vote_topic_42431.do" target="_blank" rel="nofollow"><img src="avbook/c63_728x90_7.gif" width="728" height="90"></a></div></div>--}}

        {{--<div class="alert alert-info alert-dismissable alert-common" style="position:relative">--}}
        {{--<button type="button" class="close" style="position:absolute; right:8px; top:3px;" data-dismiss="alert" onclick="javascript:$.cookie(&quot;cnadd10&quot;, &quot;off&quot;,{expires: 365,path: &quot;/&quot;})">×</button>--}}
        {{--<div class="row">--}}
        {{--<div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>永久域名：</strong><a href="https://www.javbus.com/" target="_blank">https://www.javbus.com</a></div>--}}
        {{--<div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.busjav.us/" rel="nofollow">https://www.busjav.us</a></div><div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://www.dmmbus.us/" rel="nofollow">https://www.dmmbus.us</a></div><div class="col-xs-12 col-md-6 col-lg-3 text-center"><strong>防屏蔽地址：</strong><a href="https://127.0.0.1/" rel="nofollow">https://127.0.0.1</a></div>--}}
        {{--</div>--}}
        {{--</div>--}}



        <h4>主題</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="62"> 折磨</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5g"> 嘔吐</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="59"> 觸手</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="57"> 蠻橫嬌羞</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="52"> 處男</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4y"> 正太控</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4r"> 出軌</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4e"> 瘙癢</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4d"> 運動</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4a"> 女同接吻</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="49"> 性感的</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="44"> 美容院</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="41"> 處女</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="40"> 爛醉如泥的</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3x"> 殘忍畫面</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3w"> 妄想</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3v"> 惡作劇</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3t"> 學校作品</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3r"> 粗暴</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3g"> 通姦</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3e"> 姐妹</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3d"> 雙性人</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3c"> 跳舞</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3b"> 性奴</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="37"> 倒追</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="35"> 性騷擾</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2y"> 其他</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2x"> 戀腿癖</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2v"> 偷窥</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2t"> 花癡</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2r"> 男同性恋</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2e"> 情侶</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2d"> 戀乳癖</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="20"> 亂倫</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1y"> 其他戀物癖</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1u"> 偶像藝人</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1i"> 野外・露出</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1e"> 獵豔</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1d"> 女同性戀</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="11"> 企畫</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6h"> 10枚組</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5l"> 性感的</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5p"> 性感的</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="61"> 科幻</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6i"> 女優ベスト・総集編</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6j"> 温泉</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6k"> M男</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6l"> 原作コラボ</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6n"> 16時間以上作品</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6o"> デカチン・巨根</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6p"> ファン感謝・訪問</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6q"> 動画</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6r"> 巨尻</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6s"> ハーレム</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6t"> 日焼け</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6u"> 早漏</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6v"> キス・接吻</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6w"> 汗だく</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="77"> スマホ専用縦動画</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7d"> Vシネマ</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7c"> Don Cipote's choice</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7f"> アニメ</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7g"> アクション</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7h"> イメージビデオ（男性）</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7i"> 孕ませ</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7j"> ボーイズラブ</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7t"> ビッチ</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7u"> 特典あり（AVベースボール）</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7v"> コミック雑誌</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7w"> 時間停止</label></a>
        </div>

        <h4>角色</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5w"> 黑幫成員</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5k"> 童年朋友</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5i"> 公主</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5f"> 亞洲女演員</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="58"> 伴侶</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4s"> 講師</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4l"> 婆婆</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4h"> 格鬥家</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3o"> 女檢察官</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="39"> 明星臉</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="38"> 女主人、女老板</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="34"> 模特兒</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="32"> 秘書</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="30"> 美少女</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2z"> 新娘、年輕妻子</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2w"> 姐姐</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2q"> 格鬥家</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2o"> 車掌小姐</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2f"> 寡婦</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2b"> 千金小姐</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2a"> 白人</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="29"> 已婚婦女</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="27"> 女醫生</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="26"> 各種職業</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="23"> 妓女</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="21"> 賽車女郎</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1x"> 女大學生</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1v"> 展場女孩</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1n"> 女教師</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1k"> 母親</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1c"> 家教</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="17"> 护士</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="10"> 蕩婦</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="z"> 黑人演員</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="p"> 女生</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="c"> 女主播</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="b"> 高中女生</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7"> 服務生</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5r"> 魔法少女</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="65"> 學生（其他）</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="64"> 動畫人物</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6c"> 遊戲的真人版</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6f"> 超級女英雄</label></a>
        </div>

        <h4>服裝</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5v"> 角色扮演</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5u"> 制服</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5h"> 女戰士</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5c"> 及膝襪</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5b"> 娃娃</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="56"> 女忍者</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="55"> 女裝人妖</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="50"> 內衣</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4z"> 猥褻穿著</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4p"> 兔女郎</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4n"> 貓耳女</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4k"> 女祭司</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4i"> 泡泡襪</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3i"> 制服</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3a"> 緊身衣</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2s"> 裸體圍裙</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2m"> 迷你裙警察</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2l"> 空中小姐</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="28"> 連褲襪</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1w"> 身體意識</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="18"> OL</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="12"> 和服・喪服</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="y"> 體育服</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="v"> 內衣</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="m"> 水手服</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="l"> 學校泳裝</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="k"> 旗袍</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="j"> 女傭</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="i"> 迷你裙</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="a"> 校服</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="9"> 泳裝</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="8"> 眼鏡</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1"> 角色扮演</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6b"> 哥德蘿莉</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5x"> 和服・浴衣</label></a>
        </div>

        <h4>體型</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5d"> 超乳</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4x"> 肌肉</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3n"> 乳房</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3k"> 嬌小的</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2k"> 屁股</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2i"> 高</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2g"> 變性者</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="22"> 無毛</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1t"> 胖女人</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1f"> 苗條</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="15"> 孕婦</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="13"> 成熟的女人</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="w"> 蘿莉塔</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="t"> 貧乳・微乳</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="e"> 巨乳</label></a>
        </div>

        <h4>行為</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4w"> 顏面騎乘</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4t"> 食糞</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4j"> 足交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="47"> 母乳</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="46"> 手指插入</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="45"> 按摩</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="42"> 女上位</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3q"> 舔陰</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3l"> 拳交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3f"> 深喉</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2h"> 69</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="24"> 淫語</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1z"> 潮吹</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1s"> 乳交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1r"> 排便</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1p"> 飲尿</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1o"> 口交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1j"> 濫交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="19"> 放尿</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="x"> 打手槍</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="u"> 吞精</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="r"> 肛交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="n"> 顏射</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="h"> 自慰</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5"> 顏射</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4"> 中出</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6m"> 肛内中出</label></a>
        </div>

        <h4>玩法</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="51"> 立即口交</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4f"> 女優按摩棒</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4c"> 子宮頸</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4b"> 催眠</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3z"> 乳液</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3y"> 羞恥</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3s"> 凌辱</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3p"> 拘束</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3m"> 輪姦</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3h"> 插入異物</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="36"> 鴨嘴</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2u"> 灌腸</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="25"> 監禁</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1q"> 紧缚</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1m"> 強姦</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1l"> 藥物</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1h"> 汽車性愛</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1b"> SM</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1a"> 糞便</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="14"> 玩具</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="q"> 跳蛋</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="d"> 緊縛</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6"> 按摩棒</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3"> 多P</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5m"> 性愛</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5y"> 假陽具</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="63"> 逆強姦</label></a>
        </div>

        <h4>類別</h4>
        <div class="row genre-box">

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="60"> 合作作品</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5z"> 恐怖</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5t"> 給女性觀眾</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5s"> 教學</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5q"> DMM專屬</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5o"> R-15</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5n"> R-18</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5j"> 戲劇</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5e"> 3D</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="5a"> 特效</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="54"> 故事集</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="53"> 限時降價</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4v"> 複刻版</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4u"> 戲劇</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4q"> 戀愛</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4o"> 高畫質</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4m"> 主觀視角</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="48"> 介紹影片</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="43"> 4小時以上作品</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3u"> 薄馬賽克</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="3j"> 經典</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="33"> 首次亮相</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="31"> 數位馬賽克</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2p"> 投稿</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2n"> 纪录片</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2c"> 國外進口</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="1g"> 第一人稱攝影</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="16"> 業餘</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="s"> 局部特寫</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="o"> 獨立製作</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="g"> DMM獨家</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="f"> 單體作品</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2"> 合集</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="hd"> 高清</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="sub"> 字幕</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="2j"> 天堂TV</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="4g"> DVD多士爐</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="66"> AV OPEN 2014 スーパーヘビー</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="69"> AV OPEN 2014 ヘビー級</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="6a"> AV OPEN 2014 ミドル級</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="70"> AV OPEN 2015 マニア/フェチ部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="71"> AV OPEN 2015 熟女部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="72"> AV OPEN 2015 企画部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="73"> AV OPEN 2015 乙女部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="74"> AV OPEN 2015 素人部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="75"> AV OPEN 2015 SM/ハード部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="76"> AV OPEN 2015 女優部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7k"> AVOPEN2016人妻・熟女部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7l"> AVOPEN2016企画部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7m"> AVOPEN2016ハード部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7n"> AVOPEN2016マニア・フェチ部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7o"> AVOPEN2016乙女部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7p"> AVOPEN2016女優部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7q"> AVOPEN2016ドラマ・ドキュメンタリー部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7r"> AVOPEN2016素人部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7s"> AVOPEN2016バラエティ部門</label></a>

            <a class="col-lg-2 col-md-2 col-sm-3 col-xs-6 text-center"><label><input type="checkbox" name="gr_sel" value="7x"> VR専用</label></a>
        </div>
        <button type="button" class="btn btn-danger btn-block btn-genre" onclick="genres_sel()">提交</button>

    </div>

    <script>
        $("#showgr_single,#cellshowgr_single").click(function(){
            $.cookie("existisgenres", "gr_single",{expires:365,path:'/'});
            location.reload()
        });

        $("#showgr_multi,#cellshowgr_multi").click(function(){
            $.cookie("existisgenres", "gr_multi",{expires:365,path:'/'});
            location.reload()
        });

        function genres_sel(){
            var curGenres = "";
            var curGenrestitle = "";
            $("input[name='gr_sel']:checkbox").each(function () { if($(this).is(":checked")){ curGenres += $(this).val() + "-";curGenrestitle += $(this).parent().html().replace(new RegExp($(this).prop("outerHTML"),'g'),"") + "-"; } });
            if (curGenres != "") {
                curGenres = curGenres.substring(0, curGenres.length - 1);
                window.location.href="/censored?strgc="+curGenres +"&ltitle[]=类别:" +curGenrestitle;
            }
            else {
                return;
            }

        }
    </script>

    <link rel="stylesheet" type="text/css" href="{{ asset('avbook/genre.css') }}">

@endsection