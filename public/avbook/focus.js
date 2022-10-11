$(function(){ 
	var inputEl = $("#search-input"),defVal = inputEl.val(); 
	inputEl.bind({
		focus: function() { 
			var _this = $(this); 
			if (_this.val() == info){ 
				defVal = _this.val();
				_this.val('');
			} 
		}, 
		blur: function() { 
			var _this = $(this); 
			if (_this.val() == ''){
				_this.val(defVal); 
			} 
		} 
	}); 
});
$(document).ready(function(){ 
	$("#search-input").keydown(function(e){
		var e = e || event,
		keycode = e.which || e.keyCode;
		if (keycode==13) {
			searchs('search-input');
		}
	});
	$("#search-input-mobile").keydown(function(e){
		var e = e || event,
		keycode = e.which || e.keyCode;
		if (keycode==13) {
			searchs('search-input-mobile');
		}
	});
	var prevpage=$("#pre").attr("href");
	var nextpage=$("#next").attr("href");
	$("body").keydown(function(event){
		if(!$("#search-input").is(":focus")){
			if(event.keyCode==37 && prevpage!=undefined ) location=prevpage;
			if(event.keyCode==39 && nextpage!=undefined ) location=nextpage;
		}
	}); 
});

$("#showmag,#cellshowmag").click(function(){
	$.cookie("existmag", "mag",{expires:365,path:'/'}); 
	location.reload() 
});

$("#showall,#cellshowall").click(function(){
	$.cookie("existmag", "all",{expires:365,path:'/'}); 
	location.reload() 
});
$("#showonline").click(function(){
	$.cookie("existmag", "online",{expires:365,path:'/'}); 
	location.reload() 
});

 

