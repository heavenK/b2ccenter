$(function(){   
   getTravelByEntityId();
});
function getTravelByEntityId(){
	  var html="";
	  if(document.URL.indexOf("s.caissa.com.cn")>-1){
		   url='http://ws.caissa.com.cn/other/bbs.ashx?getschtravel=' + escape($("#txtResearch").val()); 
	  }else{
		 url='http://ws.caissa.com.cn/other/bbs.ashx?getlinetravel=' + _lineid ;  
	  }
	  $.getJSON(url + "&r="+(new Date())+"&callback=?", function(data) {
        if (data.status == 1 && data.travelList.length>0) {
			for (var i = 0; i < data.travelList.length; i++) {
			  html+="<li>";
              html+="<div class=\"strategy_box_img\"><img src=\""+(data.imgList.length<1 || data.imgList[i].url==""  ? "/share/i/tvldef.jpg" : data.imgList[i].url)+"\" width=\"189\" height=\"107\" /></div>";
              html+="<p> <span class=\"fr\">"+data.travelList[i].date+"</span> <a  target=\"_blank\" href=\" "+data.travelList[i].url+"\"> <b>[ "+data.travelList[i].typename+"]</b> "+data.travelList[i].title+" </a> <br>";
              html+="关键词："+data.travelList[i].keyword+" <br>"+data.travelList[i].content+"<br>";
              html+="<span>浏览数（"+data.travelList[i].viewnum+"）  赞（"+data.travelList[i].ding+"）</span></p>";
              html+="<div class=\"headpic\"><img src=\""+data.travelList[i].face+"\" width=\"48\" height=\"48\" /><br><a target=\"_blank\" href=\""+data.travelList[i].faceurl+"\">"+data.travelList[i].username+"</a> </div>";
              html+="</li>";
            }
			$("#travel ul").html(html);
			$("#travel").show();
			$(".stroke_main_title a").attr("href",data.dmsurl);
        }
    });
}
