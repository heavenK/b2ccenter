/*
* 用于弹出层 注册、登录
*
*/

var success_method = "";
function judge(method) {
    success_method = method;
    //判断用户是否已登录
    $.getJSON("http://ws.caissa.com.cn/passport.ashx?action=getinfo&callback=?",
		 function(data) {
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
                    + '<div class="zcdl_an"><a href="http://my.caissa.com.cn/register.aspx" onclick="caissa_register()" target="_blank">注册</a></div></div></div>';

        div.html(text);
    }
    //$("#regCode").bind(($.browser.opera ? "keypress" : "keydown"), function(event) { if (event.keyCode == 13) caissa_register(); });
    $("#loginPass").bind(($.browser.opera ? "keypress" : "keydown"), function(event) { if (event.keyCode == 13) caissa_login(); });
	//stat code
    _gaq.push(['_trackPageview','/virtual/loginorregist']);
    floatDiv("logregisdiv");
}

function caissa_register() {
   _gaq.push(['_trackEvent', 'Register_Login', 'button','btn_Register']);
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

/*
function caissa_register() {
var ret = regLoginNameValid();
var ret1 = ret;
ret = regEmailValid();if (!ret) ret1 = ret;
ret = regPassValid(); if (!ret) ret1 = ret;
ret = regConfirmPass(); if (!ret) ret1 = ret;
ret = regCodeValid(); if (!ret) ret1 = ret;
if (!ret1) return;
if (!$("#agree")[0].checked) {
alert("请阅读并同意凯撒旅游网服务条款"); return;
}

$(".zcdl_an a").addClass("no");
$(".zcdl_an a").attr("href", "javascript:void()");
$.getJSON("http://ws.caissa.com.cn/user.ashx?userregis=1&name=" + encodeURI($("#regName").val()) + "&email=" + $("#regEmail").val() + "&psw=" + $("#regpwd").val() + "&code=" + $("#regCode").val() + "&callback=?",
function(data) {
if (data.status == 0) {
				  
if(typeof( __ozfac2)!='undefined'){
//99click
__ozfac2("username=" + $("#regName").val() + "&email=" + $("#regEmail").val(), "#register");
}
$.getJSON("http://bbs.caissa.com.cn/member.php?mod=logging&action=api_login&username=" + $("#regEmail").val() + "&password=" + $("#regpwd").val() + "&callback=?",
function(data) {
if (data.uid > 0) {
if(typeof( __ozfac2)!='undefined'){
//99click
__ozfac2("username=" + data.username + "&email=" + data.email, "#login");
}
eval(success_method);
} else {
alert("注册成功，登录失败！");
}
});
} else {
alert("注册失败:" + data.msg);
$(".zcdl_an a").removeClass("no");
$(".zcdl_an a").attr("href", "javascript:caissa_register()");
}
});
}

function chgregcode() {
$("#regcodeimg").attr("src", "http://ws.caissa.com.cn/RandomCode.aspx?codename=Reg&t=" + (new Date()));
}

function regLoginNameValid() {
var par =/^[\u4e00-\u9fa5a-zA-Z0-9_]{2,15}$/;
var mail = $.trim($("#regName").val());
if (mail == '' || !par.test(mail)) {
$("#zcdl_bt tr:first  td:last").html("只可包含数字,字母,汉字和下划线（4-14个字符）");
return false;
}

$.getJSON("http://ws.caissa.com.cn/user.ashx?JudgeUserName=" + encodeURI(mail) + "&t=" + Math.random() + "&callback=?",
function(data) {
if (data.count > 0)//存在相同用户名
{
$("#zcdl_bt tr:first  td:last").html("用户名已存在");
return false;
}
else {
$("#zcdl_bt tr:first  td:last").html("");
}
}
);
return true;
}


function regEmailValid() {
var par = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
var mail = $.trim($("#regEmail").val());
if (mail == '' || !par.test(mail)) {
$("#zcdl_bt tr:eq(1)  td:last").html("Email 格式有误");
return false;
}

$.getJSON("http://ws.caissa.com.cn/user.ashx?JudgeEmail=" + encodeURI(mail) + "&t=" + Math.random() + "&callback=?",
function(data) {
if (data.count >0 )//存在相同邮箱
{
$("#zcdl_bt tr:eq(1)  td:last").html("邮箱已被注册");
return false;
}
else {
$("#zcdl_bt tr:eq(1)  td:last").html("");
}
}
);
return true;
}


function regPassValid() {
var i = $.trim($("#regpwd").val());
if (i == "") {
$("#zcdl_bt tr:eq(2)  td:last").html("不可为空");
return false;
}
else if (i.length < 6) {
$("#zcdl_bt tr:eq(2)  td:last").html("密码至少6位");
return false;
}
else {
$("#zcdl_bt tr:eq(2)  td:last").html("");
return true;
}    
}


function regConfirmPass() {
if (!regPassValid()) return false;

var i = $.trim($("#regpwd").val());
var i2 = $.trim($("#regpwd2").val());
if (i == i2) {
$("#zcdl_bt tr:eq(3)  td:last").html("");
return true;
}
else {
$("#zcdl_bt tr:eq(2)  td:last").html("密码不一致");
return false;
}
}


function regCodeValid() {
if ($.trim($("#regCode").val()).length < 4) {
$("#zcdl_bt tr:eq(4)  td:last").html("验证码输入有误");
return false;
}

$.getJSON("http://ws.caissa.com.cn/user.ashx?getcode=Reg&callback=?",
function(data) {
if (data.code.toLowerCase() != $.trim($("#regCode").val()).toLowerCase()) {
$("#zcdl_bt tr:eq(4)  td:last").html("验证码输入有误");
}
else {
$("#zcdl_bt tr:eq(4)  td:last").html("");
return;
}
});
return true;
}
*/

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