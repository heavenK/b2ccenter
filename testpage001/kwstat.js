function kwStat(para) {
    $.getJSON("http://ws.caissa.com.cn/passport.ashx?action=getinfo&callback=?", function(data) {
        var refurl = encodeURIComponent(document.referrer);
		var scn = window.screen.width + "*" + window.screen.height;
        //alert(refurl);
        var curUrl = document.URL
        if (typeof (para) == 'undefined') {
            para = "&user=1";
        }
        var url = "http://www.caissa.com.cn/web/KeywordStat.ashx?ref=" + escape(refurl) + "&url=" + escape(curUrl) + "&uid=" + data.uid + "&screen=" + scn + "&t=" + (Math.random() * 100000) + para;
        //alert(url);
        if (typeof ($("#jsStat")[0]) != 'undefined') {
            $("#jsStat").remove();
        }
        var ga = document.createElement('script');
        ga.id = "jsStat";
        ga.type = 'text/javascript';
        ga.defer = true;
        ga.src = url;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(ga, s);
    })
}
$(function() {
    if (typeof (getUserKw) == 'undefined' && typeof($("#jsStat")[0]) == 'undefined') {
        kwStat();
    }
})


