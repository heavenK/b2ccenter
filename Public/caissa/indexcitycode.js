function getSiteCityCode(id){
	 var  code="";
	 switch(id){
		case 178 :
		   code="bj";
		   break;
		case 179 :
		   code="sh";
		   break;  
		case 180 :
		   code="gz";
		   break;  
		case 181 :
		   code="dl";
		   break;  
		case 182 :
		   code="heb";
		   break;  
		case 183 :
		   code="cc";
		   break;  
		case 184 :
		   code="tj";
		   break;  
		case 185 :
		   code="sjz";
		   break;  
		case 186 :
		   code="lf";
		   break;  
		case 187 :
		   code="ts";
		   break;  
		case 188 :
		   code="sy";
		   break;  
		case 189 :
		   code="cd";
		   break; 
    }
	return  code;
}

function changeCityCode() {
	
	if(typeof($.cookie)=='undefined') return false; 
	
    if (typeof(companyId) == "undefined") {
        if ($.cookie("WebSiteCompanyInfo") != null) {
            companyId = $.cookie("WebSiteCompanyInfo")
        } else {
            companyId = 178;
        }
    }
	//if($("a[id^='departuremenu']").size()>0){
		//首页 99click 增加name属性
		var code=getSiteCityCode(companyId);
		$("a[name^='__AD_BJ_shouye_']").each(function(){
		   var 	name=$(this).attr("name");									  
		   $(this).attr("name",name.replace("_BJ_","_"+code+"_"));											  
		});
		$("a[name^='__AD_BJ_group_']").each(function(){
		   var 	name=$(this).attr("name");									  
		   $(this).attr("name",name.replace("_BJ_","_"+code+"_"));											  
		});
	//}
}


changeCityCode();