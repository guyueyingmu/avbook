   var blurimg=0;
   var blurimgclass='blur';
  // $(".hh3").addClass("blur");
   if(blurimg){
	   $("img").addClass("blur");
	   $("h3").addClass("blur");
	   $(".hidden-xs").removeClass("blur");
	   $(".star_pic").removeClass("blur");
	   $(".bigImagesrc").addClass("blur6");
	   
	   $('.screencap').click(function(){ 
		   	if(blurimg){
		       	
		      } 
		   }) 
	   $('#sample-waterfall').click(function(){
	   	if(blurimg){
	       	$(".mfp-img ").addClass("blur10");
	           }
	    $('.mfp-arrow ').click(function(){ 
			   	if(blurimg){
			       	$(".mfp-img ").addClass("blur10");
			      } 
			   }) 
	   })
	   
	   
	   var mybr=myBrowser();
	   if ("Chrome" == mybr||"FF" == mybr ) { 
	   
	   		}else{
	   			$("html").html("不支持该类型浏览器,因为本人懒得做各种浏览器的css适配,请使用最新版谷歌浏览器或者火狐浏览器.关注微信公众号:guyueyingmu 获取新版本");
	   		}
	   
   }
   
  
   function myBrowser(){
	    var userAgent = navigator.userAgent; //取得浏览器的userAgent字符串 
	    var isOpera = userAgent.indexOf("Opera") > -1;
	    if (isOpera) {
	        return "Opera"
	    }; //判断是否Opera浏览器
	    if (userAgent.indexOf("Firefox") > -1) {
	        return "FF";
	    } //判断是否Firefox浏览器
	    if (userAgent.indexOf("Chrome") > -1){
	    	return "Chrome";
	    }
	    if (userAgent.indexOf("Safari") > -1) {
	        return "Safari";
	    } //判断是否Safari浏览器
	    if (userAgent.indexOf("compatible") > -1 && userAgent.indexOf("MSIE") > -1 && !isOpera) {
	        return "IE";
	    }; //判断是否IE浏览器
	}
   
    