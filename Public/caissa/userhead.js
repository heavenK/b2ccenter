_ozuid = "0"; //此处需要贵公司技术传值
if ($.cookie("caissauser_uid") != null)  _ozuid=$.cookie("caissauser_uid");
$(document).ready(function () {
    var charset = "";
    if (document.URL.indexOf("s.caissa.com.cn") > -1) {
        charset = 'utf-8';
    }

    if ($(".top_nav1 .fr").size() > 0) {
        $(".top_nav1 .fr a").each(function () { if ($(this).text() == "登录") $(this).attr("href", "http://my.caissa.com.cn/login.aspx?returnurl=" + document.URL)        });
    }

    $.getJSON("http://ws.caissa.com.cn/passport.ashx?action=getinfo&charset=" + charset + "&callback=?", function (data) {
        if (data.uid > 0) {
            if ($(".top_nav1 .fr").size() > 0) {
                $(".top_nav1 .fr a").each(function () { if ($(this).text() == "登录" || $(this).text() == "注册") $(this).hide(); });
                $(".top_nav1 .fr").find("span:eq(1)").html(data.username + ',您好！ <a href="javascript:loginout()" style="margin-right:0">退出</a>');
            } else {
                $(".nav1 a").each(function () { if ($(this).text() == "登录" || $(this).text() == "注册") $(this).hide(); });
                $(".nav1 em[class=m20]").html(data.username + ',您好！ <a href="javascript:loginout()" style="margin-right:0">退出</a>');
            }
        }
    })
	
   //help drop box
   $("#help,#helptext").hover(function(e){
	  $("#helptext").show();
   },function(e){
	  $("#helptext").hide();
   });
    //my caissa drop box
   $("#order,#ordertext").hover(function(e){
	  $("#ordertext").show();
   },function(e){
	  $("#ordertext").hide();
   });
   //subweb drop box
   $("#area,#areatext").hover(function(e){
	  $("#areatext").show();
   },function(e){
	  $("#areatext").hide();
   });
})

function loginout() {
    $.getJSON("http://bbs.caissa.com.cn/member.php?mod=logging&action=api_logout&callback=?", function(data) {
        if (data.status == 1) {
			if($(".top_nav1 .fr").size()>0){
               $(".top_nav1 .fr").find("span:eq(1)").html('');
               $(".top_nav1 .fr a").each(function() { if ($(this).text() == "登录" || $(this).text() == "注册") $(this).show(); });
			}else{
			   $(".nav1 em[class=m20]").html('欢迎来到凯撒旅游网！');
               $(".nav1 a").each(function() { if ($(this).text() == "登录" || $(this).text() == "注册") $(this).show(); });
			}
        }
    })
}