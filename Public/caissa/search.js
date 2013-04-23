// 按照关键字搜索产品
function Search() {
    var obj = document.getElementById("input_bg");
    var SearchContext = obj.value.replace(/(^\s*)|(\s*$)/g, "");
    if (SearchContext.length == 0) {
        alert("搜索内容不能为空");
        obj.value = "";
        return false;
    }
    else if (SearchContext.length > 30) {
        alert("搜索内容必须小于30个字");
        return false;
    }
    else {
		// stat code
		_gaq.push(['_trackEvent', 'Search', 'Search_Head', SearchContext]);
        window.location.href = "http://s.caissa.com.cn/" + SearchContext;
	}
}


$("#input_bg").click(function (e) {
    var s = $("#input_bg").val().replace(/^\s+|\s+$/g, "");
    if (s == "") {
        $("#input_bg").addClass("inputtxt_show");
        $(".hot_search").show();
    }
});


function HideArea() {
    //$(".hot_search").hide();
    setTimeout("document.getElementById('div_hotSearch').style.display='none'", 300 );

}

function ss() {
    alert("33");
}

jQuery(document).ready(function () {
    jQuery("#input_bg").autocomplete(
  'http://s.caissa.com.cn/Search/Find',
  {
      max: 15,
      scroll: true,
      //  dataType: "json",
      //  jsonp: "jsonpcallback",

      //格式化选项,由于WebService返回的数据是JSON格式,现在要转成HTML以TABLE形式显示
      formatItem: function (row, i, max) {
          var obj = row;
          var item = "<table id='auto" + i + "' style='width:100%;'>";
          item += "<tr>";
          item += "<td align='left'>" + obj.value + "</td>";
          item += "<td align='right' style='color:green;'>" + obj.num + "</td>";
          item += "</tr>";
          item += "</table>";
          return item;
      },

      //格式化结果,当选中时返回具体的值
      formatResult: function (row, i, max) {
          var obj = row;
          return obj.value;
      }
  });
});



  function HrefThis(dest) {
            //alert(dest);
            if (dest == "大众型") {
                window.location.href = "http://group.caissa.com.cn/common/";
            }
            else if (dest == "大众型") {
                window.location.href = "http://group.caissa.com.cn/special/";
            }
            else if (dest == "豪华型") {
                window.location.href = "http://group.caissa.com.cn/luxurious/";
            }
            else {
                window.location.href = "http://s.caissa.com.cn/" + dest;
            }
        }

