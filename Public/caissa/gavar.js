var _gaq = _gaq || [];
var gaqCompanyId=0;
var gaqCompanyName='';
var gaqCitys = new Array();
gaqCitys[178] = "北京";
gaqCitys[179] = "上海";
gaqCitys[180] = "广州";
gaqCitys[181] = "大连";
gaqCitys[182] = "哈尔滨";
gaqCitys[183] = "长春";
gaqCitys[184] = "天津";
gaqCitys[185] = "石家庄";
gaqCitys[186] = "廊坊";
gaqCitys[187] = "唐山";
gaqCitys[188] = "沈阳";
gaqCitys[189] = "成都";
if (typeof(companyId) == "undefined") {
    if ($.cookie("WebSiteCompanyInfo") != null) {
        gaqCompanyId = $.cookie("WebSiteCompanyInfo")
    } else {
        gaqCompanyId = 178;
    }
}else{
  gaqCompanyId=companyId;	
}
gaqCompanyName=gaqCitys[gaqCompanyId]+'分站';
_gaq.push(
		['_setAccount', 'UA-24072116-1'],
		['_setDomainName', 'caissa.com.cn'],
		['_addIgnoredRef', 'caissa.com.cn'], 
		['_addOrganic', 'm.baidu', 'word'],
		['_addOrganic', 'wap.baidu', 'word'],
		['_addOrganic', 'baidu.mobi', 'word'],
		['_addOrganic', 'news.baidu', 'word'],
		['_addOrganic', 'opendata.baidu', 'wd'],
		['_addOrganic', 'post.baidu', 'kw'],
		['_addOrganic', 'mp3.baidu', 'song'],
		['_addOrganic', 'box.zhangmen.baidu', 'word'],
		['_addOrganic', 'image.baidu', 'word'],
		['_addOrganic', 'top.baidu', 'w'],
		['_addOrganic', 'baidu', 'word'],
		['_addOrganic', 'baidu', 'kw'],
		['_addOrganic', 'news.google', 'q'],
		['_addOrganic', 'image.soso', 'w'],
		['_addOrganic', 'wenwen.soso', 'sp'],
		['_addOrganic', 'wenwen.soso', 'w'],
		['_addOrganic', 'soso', 'w'],
		['_addOrganic', 'bing', 'q'],
		['_addOrganic', '3721', 'name'],
		['_addOrganic', '114', 'kw'],
		['_addOrganic', 'youdao', 'q'],
		['_addOrganic', 'vnet', 'kw'],
		['_addOrganic', 'so.360', 'q'],
		['_addOrganic', 'news.sogou', 'query'],
		['_addOrganic', 'mp3.sogou', 'query'],
		['_addOrganic', 'pic.sogou', 'query'],
		['_addOrganic', 'blogsearch.sogou', 'query'],
		['_addOrganic', 'sogou', 'query'],
		['_setCustomVar',1,'分站',gaqCompanyName,2],
		['_trackPageview']);




