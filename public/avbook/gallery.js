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
function checktxt() {
    var appendedInput = $("#appendedInputButton").val();
    var e = "../uncledatoolsbyajax_newmg?gid=" + gid   ;
    $.ajax({
        url: e,
        data: {mgurl : appendedInput},
        type: "GET",
        success: function(e) {
            window.location.href =window.location.href ;
           // $("#magneturlpost").html(e)
        }
    });
}
function uncledatoolsbyajax(){
	var t = "../uncledatoolsbyajax/" +gid +"/"  ;
    $.ajax({
        url: t,
        type: "GET",
        success: function(e) {
            $("#magnet-table").append(e)
        }
    });
}

function uncledatoolsbyajax_nr(){
    var t = "../uncledatoolsbyajax_nr/" +gid +"/"+ gidmg  ;
    $.ajax({
        url: t,
        type: "GET",
        success: function(e) {
            $("#magnet-table2").append(e)
        }
    });
}
