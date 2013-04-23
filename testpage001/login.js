/*
* 用于弹出层 注册、登录
*
*/

var success_method = "";
function judge(method) {
    success_method = method;
	url = 'http://www.myerpcenter.com/index.php?s=/Server/getinfo';
	jQuery.getJSON(url +"&jsoncallback=?", function(data){  
		   if (data.uid > 0) {
			   //已登录
			   eval(method);
		   } else {
			   //显示  注册登录浮层
			   showlogregisdiv();
		   }
    });
	
		 
		 
}

function showlogregisdiv() {
    var div = $("#logregisdiv");
    if (div.length == 0) {
        div = $('<div class="logregisdiv" id="logregisdiv"></div>');
        $('body').append(div);

        var text = '<div class="Pop1"><div class="Pop_title1"><span class="Pop_xx"><a href="javascript:closeDiv(\'logregisdiv\');">关闭</a></span></div>'
                    + '<div class="Pop_Content2">此预订方式将无法享受<br>凯撒会员相关优惠<a href="javascript:caissa_directorder()" class="Direct_booking">直接预订</a></div>'
                    + '<div class="zcdl_right"><table cellspacing="0" cellpadding="0" border="0" width="236" id="zcdl_bt2">'
                    + '<tr><td width="57">用户名：</td><td width="179"><input type="text" class="zcdl_x" id="loginName" name="loginName"></td></tr><tr><td>密&nbsp;&nbsp;&nbsp;&nbsp;码：</td>'
                    + '<td><input type="password" class="zcdl_x" id="loginPass" name="loginPass"></td></tr>'
                    + '</table><div style="margin:0 10px;"><div class="zcdl_right_an"><a href="javascript:caissa_login()">登录</a></div><em></em></div>'
                    + '<div class="zcdl_an"><a href="http://xxxxxxxxxx" target="_blank">注册</a></div></div></div>';

        div.html(text);
    }
    $("#loginPass").bind(($.browser.opera ? "keypress" : "keydown"), function(event) { if (event.keyCode == 13) caissa_login(); });
	//stat code
    _gaq.push(['_trackPageview','/virtual/loginorregist']);
    floatDiv("logregisdiv");
}


function caissa_directorder() {
    eval(success_method);
    _gaq.push(['_trackEvent', 'Register_Login', 'button','btn_direct_bookings']);
}

function caissa_login() {
    var email = $("#loginName").val();
    var psw = $("#loginPass").val();
    if (email == null || email == "") {
        alert("请输入用户名!");
        return;
    }
    if (psw == null || psw == "") {
        alert("请输入密码!");
        return;
    }

    $(".zcdl_right_an a").addClass("no");
    $(".zcdl_right_an a").attr("href", "javascript:void()");

    $.getJSON("http://bbs.caissa.com.cn/member.php?mod=logging&action=api_login&username=" + email + "&password=" + psw + "&callback=?",
         function(data) {
             if (data.uid > 0) {
                 if (typeof (__ozfac2) != 'undefined') {
                     //99click
                     __ozfac2("username=" + data.username + "&email=" + data.email, "#login");
                 }
                 eval(success_method);
             } else {
                 alert("登录失败:请确保用户名密码正确！");
                 $(".zcdl_right_an a").removeClass("no");
                 $(".zcdl_right_an a").attr("href", "javascript:caissa_login()");
             }
         });
   _gaq.push(['_trackEvent', 'Register_Login', 'button','btn_Login']);
}

//浮层
function floatDiv(showDivId) {
    var bg = $("#mybg");
    if (bg.length == 0) {
        bg = $("<div class='layerbg' id ='mybg'></div>");
        $('body').append(bg);
    }
    bg.height(Math.max(document.body.scrollHeight, document.documentElement.scrollHeight));
    bg.show();
    centerDiv($("#" + showDivId));
}

function closeDiv(hidDivId) {
    $("#" + hidDivId).hide();
    $("#mybg").hide();
    document.body.style.overflow = "auto";
}

function centerDiv(obj) {
    $(obj).show();
    center(obj);
    $(window).scroll(function() {
        center(obj);
    });
    $(window).resize(function() {
        center(obj);
    });
}
function center(obj) {
    var windowWidth = document.documentElement.clientWidth;
    var windowHeight = document.documentElement.clientHeight;
    var popupHeight = $(obj).height();
    var popupWidth = $(obj).width();
    $(obj).css({
        "position": "absolute",
        "top": (windowHeight - popupHeight) / 2 + $(document).scrollTop(),
        "left": (windowWidth - popupWidth) / 2
    });
}