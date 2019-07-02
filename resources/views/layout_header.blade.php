<link rel="apple-touch-icon" href="avbook/apple-touch-icon.png">
<link rel="shortcut Icon" href="avbook/favicon.ico">
<link rel="bookmark" href="avbook/favicon.ico">
<link href="{{ asset('avbook/blurmask.css') }}" rel="stylesheet">
<nav class="navbar navbar-default navbar-fixed-top top-bar" style="z-index:2">
    <div class="container-fluid">
        <div class="navbar-header mh50">
            <a href="/">
                <img class="hidden-xs" height="50" alt="JavBus" src="{{ asset('avbook/logo.png') }}"
                     style="height:40px; margin-top:5px;">
                <img class="visible-xs-inline" height="50" alt="JavBus" src="{{ asset('avbook/logo.png') }}">
            </a>

            <div class="btn-group pull-right visible-xs-inline" role="group" style="margin:8px 8px 0 0;">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-expanded="false">
                    <span class="glyphicon glyphicon-globe"></span> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    {{--<li><a href=" ">English</a></li>--}}
                </ul>
            </div>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <div class="navbar-form navbar-left fullsearch-form">
                <div class="input-group">
                    <input id="search-input" type="text" class="form-control" placeholder="搜尋 識別碼, 影片, 演員">
                    <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" onclick="searchs('search-input')">搜尋</button>
                    </span>
                </div>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href='{{url("/censored?mg=1")}}'>有碼</a></li>
                {{--<li><a href="/uncensored">無碼</a></li>--}}
                {{--<li class="hidden-md hidden-sm"><a href="https://www.javbus.xyz/">歐美</a></li>--}}
                {{--<li><a href="JavaScript:;" onclick="setall('4m');">allz</a></li>--}}
                {{--<li><a href="JavaScript:;" onclick="setall('8');">yj</a></li>--}}


                <li class="dropdown hidden-sm">
                    <a href="/CHN-120#" class="dropdown-toggle" data-toggle="dropdown"
                       data-hover="dropdown" role="button" aria-expanded="false">類別 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/genre">有碼類別</a></li>
                        {{--<li><a href="/uncensored/genre">無碼類別</a></li>--}}
                    </ul>
                </li>
                <li class="dropdown hidden-sm">
                    <a href="/CHN-120#" class="dropdown-toggle" data-toggle="dropdown"
                       data-hover="dropdown" role="button" aria-expanded="false">女優 <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/actresses">有碼女優</a></li>
                        {{--<li><a href="/uncensored/actresses">無碼女優</a></li>--}}
                    </ul>
                </li>
                <li class="dropdown"><a href="/" class="dropdown-toggle" data-toggle="dropdown"
                                        data-hover="dropdown" role="button" aria-expanded="false"><span
                                class="glyphicon glyphicon-menu-hamburger"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        {{--<li class="visible-md-block visible-sm-block"><a href="https://www.javbus.xyz/">歐美</a></li>--}}
                        {{--<li class="visible-sm-block"><a href="/genre">有碼類別</a></li>--}}
                        {{--<li class="visible-sm-block"><a href="/uncensored/genre">無碼類別</a></li>--}}
                        {{--<li class="visible-sm-block"><a href="/actresses">有碼女優</a></li>--}}
                        {{--<li class="visible-sm-block"><a href="/uncensored/actresses">無碼女優</a></li>--}}

                        <li><a href='{{url("/censored?hd=1")}}'>高清</a></li>
                        <li><a href='{{url("/censored?sub=1")}}'>字幕</a></li>
                        <li><a href='{{url("/javlib")}}'>javlibrary 高评价</a></li>

                    </ul>
                </li>
                <li  ><a href='{{url("/censored?owned=1&ltitle[]=已拥有")}}'> <span class="glyphicon glyphicon-folder-close" style =" color: #3e8f3e;"> </span><span class="hidden-md hidden-sm"> 已拥有</span>   </a></li>
                <li  ><a href='{{url("/censored?favorite=1&ltitle[]=收藏夹")}}'><span   title="已收藏" class="glyphicon glyphicon-heart" style =" font-size: 16px; color: #fde16d;-webkit-text-stroke: 1px #777;
    text-shadow: 1px 1px #999;"> </span><span class="hidden-md hidden-sm"> 收藏夹</span>   </a></li>
                <li  ><a href='{{url("/censored?sub=1&ltitle[]=字幕")}}'>  <span title="包含字幕的磁力連結"  class="glyphicon glyphicon-subtitles" style ="font-size: 16px; color: #eb9316;"> </span><span class="hidden-md hidden-sm"> 字幕</span>   </a></li>

            </ul>

            @yield('navbar_right')

        </div>
        <!--/.nav-collapse -->
    </div>
</nav>


<script>
    //var censored_ids= [];
    function ajaxaddallgc(s) {  //HuiFang.Funtishi("请输入名字。");return;

        var t = "../ajaxaddgc/?Genre=" + s + "&code_36=" + code_36;
        $.ajax({
            url: t,
            type: "GET",
            data: {censored_ids: $("#username").val(), content: $("#content").val()},
            success: function (ree) {
                ShowMsg(ree);
                //AlertMY('-------');
                //window.location.href
                //location.href=location.href;
                //$("#magnet-table").append(e)--
            }
        });
    };

    function setall(str) {
        var code_36s = [];
        $(".code_36").each(function () {

            // console.log($(this).text());
            code_36s.push($(this).text());
        });
        console.log(code_36s);
//return
        var t = "../ajaxaddallgc/?Genre=" + str;
        $.ajax({
            url: t,
            type: "GET",
            data: {'code_36s': code_36s},
            success: function (ree) {
                ShowMsg(ree);
                //AlertMY('-------');
                //window.location.href
                //location.href=location.href;
                //$("#magnet-table").append(e)--
            }
        });

    }
</script>
<script>

    //tip是提示信息，type:'success'是成功信息，'danger'是失败信息,'info'是普通信息
    function ShowTip(tip, type) {

        /* var $tip = $('#tip');
        if ($tip.length == 0) {
            $tip = $('<span id="tip" style="font-weight:bold;position:absolute;top:50%;left: 50%;z-index:9999"></span>');
            $('body').append($tip);
        }
        $('#tip').attr('top',document.body.scrollTop+(window.screen.availHeight/2)-150 +"px");
        $tip.stop(true).attr('class', 'alert alert-' + type).text(tip).css('margin-left', -$tip.outerWidth() / 2).fadeIn(500).delay(2000).fadeOut(500);
         */
        // alert(tip)
        $('#addmsg').html(tip);
        $('#add-loading').show();
        setTimeout(function () {
            $('#add-loading').hide();
        }, 2000);

    }

    function ShowMsg(msg) {

        ShowTip(msg, 'info');
    }

    function ShowSuccess(msg) {
        ShowTip(msg, 'success');
    }

    function ShowFailure(msg) {
        ShowTip(msg, 'danger');
    }

    function ShowWarn(msg, $focus, clear) {
        ShowTip(msg, 'warning');
        if ($focus) $focus.focus();
        if (clear) $focus.val('');
        return false;
    }
</script>
