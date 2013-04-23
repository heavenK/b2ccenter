$(document).ready(function() {
    var len = $(".sign_focus li").length;
    var index = 0;
    var adTimer;
    $(".sign_focus li").mouseover(function() {
        index = $(".sign_focus li").index(this);
        showImg(index);
    }).eq(0).mouseover();
    $('.focus_photo').hover(function() {
        clearInterval(adTimer);
    }, function() {
        adTimer = setInterval(function() {
            showImg(index)
            index++;
            if (index == len) { index = 0; }
        }, 6000);
    }).trigger("mouseleave");
})
function showImg(index){
		$(".focus_photo div").eq(index).fadeIn("slow").siblings().hide();
		$(".focus_Signed_couise .pro_Signed_index").eq(index).show().siblings().hide();
		$(".sign_focus li").removeClass("curr").eq(index).addClass("curr");
}
function nTabs(thisObj, Num, ahref, aurl) {
    if (thisObj.className == "active") return;

    $(thisObj).parent().find("li").attr("class", "normal");
    $(thisObj).attr("class", "active");

    var tabObj = thisObj.parentNode.id;

    $("div[id^='" + tabObj + "_Content']").hide();
    $("#" + tabObj + "_Content" + Num).show();
}

$(function(){
		var index=0; 
		var len=$(".focus_Signed_Photo>div").length; 
		$(".focus_left").click(function(){
			if(index==0)
			{ 
			index=len;
			}
			index--;
			switchImg(index);
		})
		$(".focus_right").click(function(){
			index++;
			if(index==len)
			{ 
			index=0;
			}
			switchImg(index);
		})
})
function switchImg(index)
{
	$(".focus_Signed_Photo div").eq(index).show().siblings().hide();
}


