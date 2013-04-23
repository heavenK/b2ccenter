/**
 *使用方法:
 *页面底部引用js: <script type="text/javascript" src="http://www.caissa.com.cn/share/j/qqservice.js"></script>
 *(一):右侧滚动=><script>initUIDisplay();</script>
 *(二):页面嵌入=>页面要显示位置嵌入<div class="qq_online"></div>
 */


/////////////////////////开始执行//////////



var Qqlist="1349724346:2533248887:2366350112:1357883155";//北京
var CD_Qqlist="363246778:2857633259";//成都分站
var GZ_Qqlist="2815891047:2859671036";//广州分站
var SH_Qqlist="2571486167:2353947971";//上海分站
var QqlistArray;

//北京分站
var qq_region=178;

//初始化

QQ_Init();



function QQ_Init()
{
withjQuery(function ($) {
if (typeof(companyId) == "undefined" || companyId<1) {
if ($.cookie("WebSiteCompanyInfo") != null) {
     qq_region = $.cookie("WebSiteCompanyInfo");//取得地域
	} 
	}else{
	qq_region=companyId;
	}

var qq_domain="bj";
switch(parseInt(qq_region))
{
case 178: //北京
	QqlistArray=Qqlist.split(":"); 
	break;
case 189: //成都
	qq_domain="cd";
	if(Verification(qq_domain))
	{
		QqlistArray=eval(qq_domain.toUpperCase()+"_Qqlist").split(":");
		
	}else
	{
		QqlistArray=Qqlist.split(":");
	}
	break;
case 180://广州
	qq_domain="gz";
	if(Verification(qq_domain))
	{
		QqlistArray=eval(qq_domain.toUpperCase()+"_Qqlist").split(":");
	}else
	{
		QqlistArray=Qqlist.split(":");
	}
	break;
	case 179://上海
	qq_domain="sh";
	if(Verification(qq_domain))
	{
		QqlistArray=eval(qq_domain.toUpperCase()+"_Qqlist").split(":");
	}else
	{
		QqlistArray=Qqlist.split(":");
	}
	break;
default:
    QqlistArray=Qqlist.split(":"); //默认北京
   break;
}


});
}


/////////////////////////结束执行//////////

/**
 *验证条件
 */
function Verification(qq_domain)
{
var url=document.location.href;
    if(url=="http://"+qq_domain+".caissa.com.cn/" ||url=="http://group.caissa.com.cn/"||url=="http://sale.caissa.com.cn/"||url=="http://group.caissa.com.cn/"+qq_domain+"-europe/"||url=="http://group.caissa.com.cn/"+qq_domain+"-asian/"||url=="http://group.caissa.com.cn/"+qq_domain+"-america/"||url=="http://group.caissa.com.cn/"+qq_domain+"-oceanian/"||url=="http://group.caissa.com.cn/"+qq_domain+"-african/"||url=="http://group.caissa.com.cn/"+qq_domain+"-common/"||url=="http://group.caissa.com.cn/"+qq_domain+"-special/"||url=="http://group.caissa.com.cn/"+qq_domain+"-tourism/"||url=="http://group.caissa.com.cn/"+qq_domain+"-theme/"||url=="http://group.caissa.com.cn/"+qq_domain+"-vacation/"||url=="http://group.caissa.com.cn/"+qq_domain+"-youlun/"||url=="http://www.caissa.com.cn/"||(document.location.href.match(/.shtml/)==".shtml" &&$(".Location").html().match(/自由行/)!="自由行"))
	{return true;}
	else
	{return false;}
}
   /*
	*unicode转码
	*/
  
    function uniencode(text)
    {
    text = escape(text.toString()).replace(/\+/g, "%2B");
    var matches = text.match(/(%([0-9A-F]{2}))/gi);
    if (matches)
    {
    for (var matchid = 0; matchid < matches.length; matchid++)
    {
    var code = matches[matchid].substring(1,3);
    if (parseInt(code, 16) >= 128)
    {
    text = text.replace(matches[matchid], '%u00' + code);
    }
    }
    }
    text = text.replace('%25', '%u0025');
    return text;
    }

  
function withjQuery(callback, safe) {
    if (typeof (jQuery) == "undefined") {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "http://s.caissa.com.cn/Scripts/jquery-1.4.1.min.js";

        if (safe) {
            var cb = document.createElement("script");
            cb.type = "text/javascript";
            cb.textContent = "jQuery.noConflict();(" + callback.toString() + ")(jQuery);";
            script.addEventListener('load', function () {
                document.head.appendChild(cb);
            });
        }
        else {
            var dollar = undefined;
            if (typeof ($) != "undefined") dollar = $;
            script.addEventListener('load', function () {
                jQuery.noConflict();
                $ = dollar;
                callback(jQuery);
            });
        }
        document.head.appendChild(script);
    } else {
        callback(jQuery);
    }
};

withjQuery(function ($) {
//加载jquery后的页面初始化处理

/* var url=document.location.href;
var host=location.hostname.split(".")[0];
if(url=="http://www.caissa.com.cn/"||url=="http://group.caissa.com.cn/"||host=="sh"||host=="gz"||host=="cd"||host=="sy"||host=="heb"||host=="tj"||host=="dl"||host=="cc"||host=="ts"||host=="lf"||host=="sjz")
{
	if ($.cookie("WebSiteCompanyInfo") != null) {
qq_region = $.cookie("WebSiteCompanyInfo");
	} 
}
if(qq_region==178)
{
	isHide=false;
} */


});

//QQ-GATC检测代码
function Qq_top_Online_track(i,j)
{
	_gaq.push(['_trackEvent', 'qq', 'online_top_service',i+'-'+j]);
	}
	
function Qq_side_Online_track(i,j)
{
	_gaq.push(['_trackEvent', 'qq', 'online_side_service',i+'-'+j]);
	}

//参团游嵌入显示

function init_Group_Qq_Online()
{
if(QqlistArray==undefined||QqlistArray==null)
return;

withjQuery(function ($) {
  var qq_content=$(".qq_online");
if($.trim(qq_content.html())==""||$.trim(qq_content.html())==null)
{

 var result=[];
 result.push('<div class="qq_online">');
 result.push('在线咨询：');
 for(var i=0;i<QqlistArray.length;i++)
 { 
	result.push('<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+QqlistArray[i]+'&site=qq&menu=yes" onclick="Qq_top_Online_track(QqlistArray[i],i)"><img border="0" src="http://wpa.qq.com/pa?p=2:'+QqlistArray[i]+':41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>');
 }
 //http://wpa.qq.com/pa?p=2:'+QqlistArray[i]+':41
 result.push('</div><div class="hr_10"></div>');
$(".couise_place_title").next().after(result.join(""));

}});
}

//自由行嵌入显示

function init_Package_Qq_Online()
{
if(QqlistArray==undefined||QqlistArray==null)
return;
withjQuery(function ($) {
  var qq_content=$(".qq_online");
if($.trim(qq_content.html())==""||$.trim(qq_content.html())==null)
{

 var result=[];
 result.push('<div class="qq_online">');
 result.push('在线咨询：');
 for(var i=0;i<QqlistArray.length;i++)
 { 
	result.push('<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+QqlistArray[i]+'&site=qq&menu=yes" onclick="Qq_top_Online_track(QqlistArray[i],i)"><img border="0" src="http://wpa.qq.com/pa?p=2:'+QqlistArray[i]+':41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>');
 }
 result.push('</div><div class="hr_10"></div>');
$(".free_focus_content").before(result.join(""));

}});
}




//#region UI 界面

function initUIDisplay() {
	//injectStyle();// ie无法显示,于是添加到了style.css中了 

	if(document.location.href.match(/.shtml/)!=".shtml")
	{
	//去掉详情页的右侧浮动客服
	injectDom();
	}
	
}

/**
 * 将使用的样式加入到当前页面中
 */
function injectStyle() {
var s=document.createElement("style");
s.type="text/css";
s.textContent='.qq_online {float:right; margin-top:-23px; font-weight:bold; color:#000; font-size:12px; margin-right:44px;}\
.qq_online img{margin-right:10px;vertical-align:bottom}\
.qq_service .qq_expand_collapse {background: url("http://www.caissa.com.cn/share/i/online/kf_online.gif") no-repeat scroll -24px 0 transparent;\
	cursor: pointer;\
    float: right;\
    height: 100px;\
    width: 24px;\
}\
.qq_service .qq_collapse {\
    background-position: 0 0;\
}\
.qq_service .index_qq_online{ width:141px;float: left; border:1px #61523b solid; background:url(http://www.caissa.com.cn/share/i/online/qq_time.gif) bottom no-repeat #fff; padding:10px;  font-size:12px; padding-bottom:70px; color:#806e56}\
.qq_service .index_qq_online p{ height:30px; display:block; margin-top:8px; margin-bottom:8px;}\
.qq_service .index_qq_online img{ vertical-align:bottom;}';
document.getElementsByTagName('head')[0].appendChild(s);
}

/**
 *将dom加入到当前页面
 */
 function injectDom(){
 if(QqlistArray==undefined||QqlistArray==null)
return;
 var html=[];
 html.push('<div class="qq_service" style="z-index: 1000;width:24px;">');
 html.push('	<div class="index_qq_online" style="display: none;">');
 html.push('	</div>');
 html.push('	<div class="qq_expand_collapse"> </div>');
 html.push('</div>');
document.write(html.join(""));
 
withjQuery(function ($) {
//侧边对比条幅：开始
var qqclient_width = document.documentElement.clientWidth;
var qqclient_height = document.documentElement.clientHeight;
var qqcontent_width = $("#main").width();
var qqwidth = $("#main").width()==1000?($("#main").offset().left-13):($("#main").offset().left-23); //parseInt(qqclient_width - qqcontent_width) / 2 - 13;
var qqheight = parseInt(qqclient_height) / 2;

/* var url=document.location.href;
if(url=="http://www.caissa.com.cn/")
{
qqheight+=150;
} */

if(qqheight<$("#main").offset().top)
	{
	qqheight=$("#main").offset().top;
	}
$(".qq_service").css({
    "position": "absolute",
    "top": qqheight,
    "right": qqwidth
})
//展开关闭
$(".qq_expand_collapse").toggle(function () {

var qq_content=$(".index_qq_online");
if($.trim(qq_content.html())==""||$.trim(qq_content.html())==null)
{

 var result=[];
 for(var i=0;i<QqlistArray.length;i++)
 { 
 
	
	result.push('<p>旅游顾问'+(i+1)+'：<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin='+QqlistArray[i]+'&site=qq&menu=yes" onclick="Qq_side_Online_track(QqlistArray[i],i)"><img border="0" src="http://wpa.qq.com/pa?p=2:'+QqlistArray[i]+':41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></p>');
	
  
 }
qq_content.html(result.join(""));
 
}
        
    $(this).addClass("qq_collapse").prev().show().end().parent().css("width", "187px");
    
}, function () {
    $(this).removeClass("qq_collapse").prev().hide().end().parent().css("width", "24px");
})
//侧边对比条幅：结束
//var qqindex=0;
//var qqscroll=1;
$(window).bind("scroll resize",function () {    // 页面发生scroll事件时触发   
    var bodyTop = 0;
    if (typeof window.pageYOffset != 'undefined') {
        bodyTop = window.pageYOffset;
    } else if (typeof document.compatMode != 'undefined' && document.compatMode != 'BackCompat') {
        bodyTop = document.documentElement.scrollTop;
    }
    else if (typeof document.body != 'undefined') {
        bodyTop = document.body.scrollTop;
    }
	//if($(window).scrollTop()>0&&qqscroll==1)
	//{qqscroll++;
	//$(".qq_service").animate({
       //"right": $("#main").offset().left-13 //parseInt(document.documentElement.clientWidth- $("#main").width()) / 2 - 13
     //})
	//}
/* if(url=="http://www.caissa.com.cn/")
{
if(qqindex==1)
{
qqheight-=150;
qqindex++;
}
} */
    //$(".qq_service").stop(true,false).delay(200).animate({ top: qqheight + bodyTop }, "slow");
	var qq_top=qqheight + bodyTop;
	
	if(qq_top<$("#main").offset().top)
	{
	qq_top=$("#main").offset().top;
	//qqindex++;
	}else 
	{
	qqheight=parseInt(qqclient_height) / 2;
	qq_top=qqheight + bodyTop;	
	}
	if(qq_top+100>$(".footerbg").offset().top)
	{
		qq_top=$(".footerbg").offset().top-100;
	}
	$(".qq_service").animate({ top:qq_top ,right:$("#main").width()==1000?($("#main").offset().left-13):($("#main").offset().left-23)  }, 0);
});
})
 }
 //#endregion
 
 
 function unsafeInvoke(callback) {
	/// <summary>非沙箱模式下的回调</summary>
	var cb = document.createElement("script");
	cb.type = "text/javascript";
	cb.textContent = buildCallback(callback);
	document.head.appendChild(cb);
}
function buildCallback(callback) {
	var content = "";
	content += "window.__cb=" + buildObjectJavascriptCode(callback) + ";\r\n\
	if(typeof(jQuery)!='undefined')window.__cb();\r\n\
	else{\
		var script=document.createElement('script');\r\nscript.src='https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js';\r\n\
		script.type='text/javascript';\r\n\
		script.addEventListener('load', window.__cb);\r\n\
		document.head.appendChild(script);\r\n\
	}";

	return content;
}

function buildObjectJavascriptCode(object) {
	/// <summary>将指定的Javascript对象编译为脚本</summary>
	if (!object) return null;

	var t = typeof (object);
	if (t == "string") {
		return "\"" + object.replace(/(\r|\n|\\)/gi, function (a, b) {
			switch (b) {
				case "\r":
					return "\\r";
				case "\n":
					return "\\n";
				case "\\":
					return "\\\\";
			}
		}) + "\"";
	}
	if (t != "object") return object + "";

	var code = [];
	for (var i in object) {
		var obj = object[i];
		var objType = typeof (obj);

		if ((objType == "object" || objType == "string") && obj) {
			code.push(i + ":" + buildObjectJavascriptCode(obj));
		} else {
			code.push(i + ":" + obj);
		}
	}

	return "{" + code.join(",") + "}";
}