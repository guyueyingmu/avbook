<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link href="{{ asset('avbook/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('avbook/bootstrap-theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('avbook/magnific-popup.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('avbook/base.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('avbook/nav.overlay.css') }}">

    <script src="{{ asset('avbook/jquery.min.js') }}"></script>
    <script src="{{ asset('avbook/bootstrap.min.js') }}"></script>
    <script src="{{ asset('avbook/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('avbook/jquery.cookie.min.js') }}"></script>
    <script src="{{ asset('avbook/base.js') }}"></script>
    <script src="{{ asset('avbook/bootstrap-hover-dropdown.js') }}"></script>
    <style type="text/css">
        @media screen and (max-width: 1490px) {
            .ad-table {
                display: none;
            }
        }

        @media screen and (min-width: 1490px) {
            .ad-list {
                display: none;
            }
        }

        @media screen and (max-width: 767px) {
            .navbar-default {
                background-color: #ff9900;
                background-image: none;
            }
        }
    </style>
</head>


<body>


<script language="JavaScript">
    var mod = 0;
    var lang = 'zh';
    var info = '搜尋 識別碼, 影片, 演員';

    function searchs(obj) {
        var searchinput = $("#" + obj);
        if (searchinput.val() == '') {
            $('#magnet-url-post').trigger("click");
            return false;
        }
        else {
            $('#search-loading').show();
            window.location.href = "/censored?&search=" + encodeURIComponent($.trim(searchinput.val()));
            //window.location.href="/search/"+encodeURIComponent($.trim(searchinput.val()));
        }
    }

    $(function () {
        // var url ='/ajax/search-modal.php?floor='+Math.floor(Math.random()*1000+1)+'&lang='+lang;
        // $.ajax({url: url,type: 'GET',success: function(msg){
        //         $("#searchModal").append(msg);
        //     }});
    });
</script>




<div id="search-loading">
    <table class="search-loading-box" border="0" cellpadding="0" cellspacing="0">
        <tbody>
        <tr>
            <td align="center">
                <table height="80" width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tbody>
                    <tr>
                        <td height="40" align="center">
                            <div class="search-loading-text">搜尋中...</div>
                        </td>
                    </tr>
                    <tr>
                        <td height="40" align="center">
                            <img src="{{ asset('avbook/search_loading.gif') }}" border="0">
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<!-- Modal Search -->
<div id="searchModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a href="/#searchModal" class="hide" data-toggle="modal">
                    <button class="btn" id="magnet-url-post" type="button"></button>
                </a>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">請輸入搜尋內容！</h4>
            </div>
            <div class="modal-body">
                <p>您沒有輸入搜尋內容，請輸入您要搜尋的內容！</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@include('layout_header')


<div class="row visible-xs-inline footer-bar">
    <div class="col-xs-3 text-center">
        <a id="menu" class="btn btn-default trigger-overlay"><span class="glyphicon glyphicon-align-justify"></span></a>
    </div>
    <div class="col-xs-3 text-center">
    </div>
    <div class="col-xs-3 text-center">
    </div>
    <div class="col-xs-3 text-center">
        <a id="back" class="btn btn-default" href="javascript:window.history.back()"><span
                    class="glyphicon glyphicon-share-alt flipx"></span></a>
    </div>
</div>
<script src="{{ asset('avbook/focus.js') }}"></script>

@yield('content')


<footer class="footer hidden-xs" style="display: none;">
    <div class="container-fluid">
        <p><a href="/doc/terms">Terms</a> / <a
                    href="/doc/privacy">Privacy</a> / <a href="/doc/usc">2257</a>

             /  <script type="text/javascript" src="https://s96.cnzz.com/z_stat.php?id=1277368229&web_id=1277368229"></script>

            / <a href="http://www.rtalabel.org/" target="_blank" rel="external nofollow">RTA</a> / <a
                    href="javascript:bootstr(1);" r="">廣告投放</a> / <a href="javascript:bootstr(2);">聯絡我們</a> / <a
                    href="/website.php" target="_blank">防屏蔽地址發布頁</a><br><a
                    href="/CHN-120#formModal" id="adscontact" data-toggle="modal"></a>
            Copyright © 2013 JavBus. All Rights Reserved. All other trademarks and copyrights are the property of their
            respective holders. The reviews and comments expressed at or through this website are the opinions of the
            individual author and do not reflect the opinions or views of JavBus. JavBus is not responsible for the
            accuracy of any of the information supplied here.</p>
    </div>
</footer>
<div class="visible-xs-block footer-bar-placeholder"></div>

<script language="javascript">
    function bootstr(type) {
        ads = "廣告投放";
        contact = "聯絡我們";
        translate = "翻譯";
        $("#adstype").val(type);
        if (type == 1) {
            $("#contactModalLab").html(ads);
            $("#qqskype").show();
            $("#transinfo").hide();
            $("#translanguage").hide();
            $("#mailcontent").show();
        } else if (type == 2) {
            $("#contactModalLab").html(contact);
            $("#qqskype").show();
            $("#transinfo").hide();
            $("#translanguage").hide();
            $("#mailcontent").show();
        } else if (type == 3) {
            $("#contactModalLab").html(translate);
            $("#qqskype").hide();
            $("#transinfo").show();
            $("#translanguage").show();
            $("#mailcontent").hide();
        }
        $("#adscontact").trigger("click");
        getverifycode();
    };

    function getverifycode() {
        $('#verify').attr("src", "/post/verify?" + Math.random() * 10000);
    };

    function IsMail(mail) {
        var remail = /^([a-zA-Z0-9_-])+(\.)?([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/;
        return (remail.test(mail));
    };

    function checkform() {
        var post = true;
        if ($("#verifycode").val().length != 5) {
            alert("驗證碼輸入錯誤!")
            $("#verifycode").focus();
            post = false;
        }
        if ($("#contact").val().length > 255) {
            alert("聯繫方式字數過多!")
            $("#contact").focus();
            post = false;
        }

        if (!IsMail($("#mail").val())) {
            alert("請輸入正確的電郵地址!")
            $("#mail").focus();
            post = false;
        }

        if ($("#intention").val().length > 25500) {
            alert("投放意向字數過多!")
            $("#intention").focus();
            post = false;
        }

        if ($("#trans").val().length > 255) {
            alert("Too many words in your language textbox!")
            $("#intention").focus();
            post = false;
        }
        if (post == true) {
            $("#modalclose").trigger("click");
            $("#postform").attr("action", "/post/contact");
            $("#postform").submit();
        }
        return post;
    };


</script>


<!-- Modal Forms -->
<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="modalclose" type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="contactModalLab">聯絡我們</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" name="postform" method="post" id="postform" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group" id="qqskype">
                            <label class="col-sm-4 control-label" for="contact">QQ / Skype</label>
                            <div class="col-sm-6">
                                <input id="contact" name="contact" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="mail">Email</label>
                            <div class="col-sm-6">
                                <input id="mail" name="mail" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="translanguage">
                            <label class="col-sm-4 control-label" for="trans">Your Language</label>
                            <div class="col-sm-6">
                                <input id="trans" name="trans" type="text" placeholder="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group" id="mailcontent">
                            <label class="col-sm-4 control-label" for="intention" id="inten-trans">內容</label>
                            <div class="col-sm-6">
                                <textarea id="intention" name="intention" rows="9" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="verify">驗證碼</label>
                            <div class="col-sm-6">
                                <input type="text" id="verifycode" name="verifycode" style="width:50px">
                                <img id="verify" src="" style="cursor: pointer; vertical-align:middle;"
                                     onclick="getverifycode()">
                            </div>
                        </div>
                        <input type="hidden" id="adstype" name="adstype" value="1">
                    </fieldset>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" button="" class="btn btn-primary" onclick="checkform()">送出</button>
                <button type="button" button="" class="btn btn-default" data-dismiss="modal">關閉</button>
            </div>
        </div>
    </div>
</div>


<!-- ////////////////////////////////////////////////// -->
<div class="overlay overlay-contentscale">
    <div class="row">
        <div class="col-xs-12 text-center ptb20">
            <div class="input-group col-xs-offset-2 col-xs-8">
                <input id="search-input-mobile" type="text" class="form-control" placeholder="搜尋 識別碼, 影片, 演員">
                <span class="input-group-btn">
                      <button class="btn btn-default" type="submit"
                              onclick="searchs(&#39;search-input-mobile&#39;)">搜尋</button>
                      </span>
            </div>
        </div>
        <div class="col-xs-6 text-center"><a href="/">有碼</a></div>
        <div class="col-xs-6 text-center"><a href="/uncensored">無碼</a></div>
        <div class="col-xs-6 text-center"><a href="/genre">有碼類別</a></div>
        <div class="col-xs-6 text-center"><a href="/uncensored/genre">無碼類別</a></div>
        <div class="col-xs-6 text-center"><a href="/actresses">有碼女優</a></div>
        <div class="col-xs-6 text-center"><a href="/uncensored/actresses">無碼女優</a></div>
        <div class="col-xs-6 text-center"><a href="/">歐美</a></div>
        <div class="col-xs-6 text-center"><a href="/forum/">論壇</a></div>

        <div class="col-xs-12 text-center overlay-close">
            <i class="glyphicon glyphicon-remove"></i>
        </div>
    </div>
</div>
<script src="{{ asset('avbook/nav.overlay.js') }}"></script>
<!-- Statistics START (aync) -->

<!-- Statistics END 


<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3517660,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>


-->
@yield('endscript')

<script async="" src="{{ asset('avbook/mask.js') }}"></script>

</body>
</html>