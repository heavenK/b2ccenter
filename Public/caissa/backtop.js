$(document).ready(function() {
   var client_width=document.documentElement.clientWidth;
   var client_height=document.documentElement.clientHeight;
   var content_width=$("#footer").width();
   var width=parseInt(client_width-content_width)/2-23;
   var compare_height=document.getElementById("backheader").offsetHeight;
   var height=parseInt(client_height-compare_height)/2;
   $("#backheader").css({
   "top":height,
   "right": width
   })
   $(window).scroll(function() {    // 页面发生scroll事件时触发   
            var bodyTop = 0;   
            if (typeof window.pageYOffset != 'undefined') {   
                bodyTop = window.pageYOffset;   
            } else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {   
                bodyTop = document.documentElement.scrollTop;   
            }   
            else if (typeof document.body != 'undefined') {   
                bodyTop = document.body.scrollTop;   
            }
			if(bodyTop>0)
			{$("#backheader").show();}
			else{$("#backheader").hide();}   
            $("#backheader").animate({top : height+bodyTop},0);      
        }); 
   
})