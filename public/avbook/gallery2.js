$(document).ready(function() {
    if ($.cookie("starinfo") == "glyphicon glyphicon-minus") {
        $("#star-div").show();
    }
    $('.star-show').click(function() {
        $("#star-toggle").toggleClass("glyphicon-minus glyphicon-plus");
        $("#star-div").slideToggle();
        $.cookie("starinfo", $("#star-toggle").attr("class"), {
            expires: 365,
            path: '/'
        });
    });
    $('#star-hide').click(function() {
        $("#star-toggle").toggleClass("glyphicon-minus glyphicon-plus");
        $("#star-div").slideToggle();
        $.cookie("starinfo", $("#star-toggle").attr("class"), {
            expires: 365,
            path: '/'
        });
    });
    $('#mag-submit-show').click(function() {
        $("#mag-submit-toggle").toggleClass("glyphicon-minus glyphicon-plus");
        $("#mag-submit").slideToggle();
    });
    $('#mag-submit-hide').click(function() {
        $("#mag-submit-toggle").attr("class", "glyphicon glyphicon-plus");
        $("#mag-submit").slideToggle();
    });
});
$('#urad1').hover(function() {
    $('.left-urad1').stop().animate({
        width: '55px'
    },
    300)
},
function() {
    $('.left-urad1').stop().animate({
        width: '-0'
    },
    300)
});
$('#urad2').hover(function() {
    $('.left-urad2').stop().animate({
        width: '55px'
    },
    300)
},
function() {
    $('.left-urad2').stop().animate({
        width: '-0'
    },
    300)
});
function hoverdiv(e, starhover) {
    var left = e.clientX + "px";
    var top = e.clientY + "px";
    $("#" + starhover).css('left', left);
    $("#" + starhover).css('top', top);
    $("#" + starhover).css('position', 'fixed');
    $("#" + starhover).toggle();
    return false;
}
function checktxt2() {
    var appendedInput = $("#appendedInputButton").val();
    var e = "../ajax/toolsbyajax.php?gid=" + gid + "&lang=" + lang + "&uc=" + uc + "&ai=" + appendedInput + "&floor=" + Math.floor(Math.random() * 1e3 + 1);
    $.ajax({
        url: e,
        type: "GET",
        success: function(e) {
            $("#magneturlpost").html(e)
        }
    });
}
function uncledatoolsbyajax(){
	var t = "../uncledatoolsbyajaxlw/"  ;
    $.ajax({
        url: t,
        type: "GET",
        success: function(e) {
            $("#magnet-table").append(e)
        }
    });
}

$(function() {
	uncledatoolsbyajax()
})