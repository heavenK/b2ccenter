/*
 分站公用js
*/

$(document).ready(function() {
    
});

//分子公司ID-Name对照表
var sitecitys = new Array();
sitecitys[178] = "北京";
sitecitys[179] = "上海";
sitecitys[180] = "广州";
sitecitys[181] = "大连";
sitecitys[182] = "哈尔滨";
sitecitys[183] = "长春";
sitecitys[184] = "天津";
sitecitys[185] = "石家庄";
sitecitys[186] = "廊坊";
sitecitys[187] = "唐山";
sitecitys[188] = "沈阳";
sitecitys[189] = "成都";

//用Cookie保存分子公司ID
function SaveCookie(companyId) {
    $.cookie("WebSiteCompanyInfo", companyId, { expires: 1, path: '/', domain: 'caissa.com.cn' });
}

function ShowPage() {
    if (typeof(companyId) == "undefined" || companyId<1) {
        if ($.cookie("WebSiteCompanyInfo") != null) {
            companyId = $.cookie("WebSiteCompanyInfo")
        } else {
            companyId = 178;
        }
    }
    
    $("#top" + companyId).addClass("cur");
    $(".city_name").text(sitecitys[companyId] + "站");
    $(".choice").text("更多城市");
	
	//新版首页
	if($("#area").size()>0){
	  $("#area").text(sitecitys[companyId] +"分站");
	}
	if($("a[id^='departuremenu']").size()>0){
		$("a[id^='departuremenu']").text(sitecitys[companyId] +"出发");
	}
    SaveCookie(companyId);
	getSearchTagContent(companyId);
	getFooterKeywordTagContent(companyId);
}

function getSearchTagContent(iCompanyId){
	var charset="gb2312";
    if (document.URL.indexOf("s.caissa.com.cn") > -1) {
        charset = 'utf-8';
    }
	$.getJSON("http://ws.caissa.com.cn/other/SubWeb.ashx?search="+iCompanyId+"&charset="+charset+"&r="+(new Date())+"&callback=?", function(data) {
        if (data.status == 1 && data.content.length>0) {
			$("#hot_keywords_tag").html(data.content);
        }
    });	
}

function getFooterKeywordTagContent(iCompanyId){
	var charset="gb2312";
    if (document.URL.indexOf("s.caissa.com.cn") > -1) {
        charset = 'utf-8';
    }
	$.getJSON("http://ws.caissa.com.cn/other/SubWeb.ashx?footerkeyword="+iCompanyId+"&charset="+charset+"&r="+(new Date())+"&callback=?", function(data) {
        if (data.status == 1 && data.content.length>0) {
			$(".bottom_q_nav").html(data.content);
        }
    });	
}

