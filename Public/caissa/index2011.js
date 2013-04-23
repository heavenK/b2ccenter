var _c = _h = 0;
$(document).ready(function () {
    $('#focusnum > li').mouseover(function(){
        var i = $(this).attr('alt') - 1;
        clearInterval(_h);
        _c = i;
        change(i);       
    })
	$('#focustxt > li').click(function(){
        var i = $(this).attr('alt') - 1;
        clearInterval(_h);
        _c = i;
        change(i);       
    })
	$("#focustxt > li").hover(function(){clearInterval(_h)}, function(){play()});
    $("#focusimg img").hover(function(){clearInterval(_h)}, function(){play()});
    play();
})
function play()
{
    _h = setInterval("auto()", 6000);
}
function change(i)
{
    $('#focusnum > li').removeClass('current').eq(i).addClass('current').blur();
	$('#focustxt > li').css('display','none').eq(i).css('display','block').blur();
    $("#focusimg img").fadeOut('slow').eq(i).fadeIn('slow');
}
function auto()
{   
    var l=$('#focusnum > li').size();
    _c = _c > l-2 ? 0 : _c + 1;
    change(_c);
}


$(function () {
	$('#changetxt span').soChange({
		thumbObj:'#changetxt em',
		thumbNowClass:'show',
		slideTime:0,
		autoChange: false,
		clickFalse:false
	});

});
$(document).ready(function() {
	$("#changeimg").jCarouselLite({ btnNext: ".changeDiv .next", btnPrev: ".changeDiv .last", auto:0, scroll: 1, visible: 1, speed: 1000 });
}); 

$(document).ready(function() {
   $("#left_menu1,#submenu_show1").mousemove(function(e){
	  $("#submenu_show1").show();
	  $("#left_menu1").addClass("leftmenushow");
   });
   $("#left_menu1,#submenu_show1").mouseleave(function(e){
	  $("#submenu_show1").hide();
	  $("#left_menu1").removeClass("leftmenushow");
   });
   $("#left_menu2,#submenu_show2").mouseover(function(e){
	  $("#submenu_show2").show();
	  $("#left_menu2").addClass("leftmenushow");
   });
   $("#left_menu2,#submenu_show2").mouseout(function(e){
	  $("#submenu_show2").hide();
	  $("#left_menu2").removeClass("leftmenushow");
   });
   $("#left_menu3,#submenu_show3").mousemove(function(e){
	  $("#submenu_show3").show();
	  $("#left_menu3").addClass("leftmenushow");
   });
   $("#left_menu3,#submenu_show3").mouseleave(function(e){
	  $("#submenu_show3").hide();
	  $("#left_menu3").removeClass("leftmenushow");
   });
   $("#left_menu4,#submenu_show4").mousemove(function(e){
	  $("#submenu_show4").show();
	  $("#left_menu4").addClass("leftmenushow");
   });
   $("#left_menu4,#submenu_show4").mouseleave(function(e){
	  $("#submenu_show4").hide();
	  $("#left_menu4").removeClass("leftmenushow");
   });
   $("#left_menu5,#submenu_show5").mousemove(function(e){
	  $("#submenu_show5").show();
	  $("#left_menu5").addClass("leftmenushow");
   });
   $("#left_menu5,#submenu_show5").mouseleave(function(e){
	  $("#submenu_show5").hide();
	  $("#left_menu5").removeClass("leftmenushow");
   });

   $(".submenu_show a.close").click(function(e){
	  $(".submenu_show").hide();
	  $("a.leftmenu").removeClass("leftmenushow");
   });
 });

$(document).ready(function() {
   $("#header a.Help,#header .help_show").mouseover(function(e){
	  $("#header .help_show").show();
          $(".help_tips").hide();
   });
   $(".help_tips").mouseover(function(e){
          $(this).hide();
   });
   $("#header a.Help,#header .help_show").mouseout(function(e){
	  $("#header .help_show").hide();
   });
   $("#area1 a.area,#area1 .area_show").mousemove(function(e){
	  $("#area1 .area_show").show();

   });
   $("#area1 a.area,#area1 .area_show").mouseleave(function(e){
	  $("#area1 .area_show").hide();

   });
   $("#area2 a.area,#area2 .area_show").mousemove(function(e){
	  $("#area2 .area_show").show();

   });
   $("#area2 a.area,#area2 .area_show").mouseleave(function(e){
	  $("#area2 .area_show").hide();
   });
   $("#area3 a.area,#area3 .area_show").mousemove(function(e){
	  $("#area3 .area_show").show();

   });
   $("#area3 a.area,#area3 .area_show").mouseleave(function(e){
	  $("#area3 .area_show").hide();

   });
   $("#input_bg").click(function(e){
	  $("#input_bg").addClass("inputtxt_show");
   });
 })


/*新闻滚动*/
$(function(){
        var $this = $(".con_News ul");
		var scrollTimer;
		$this.hover(function(){
			  clearInterval(scrollTimer);
		 },function(){
		   scrollTimer = setInterval(function(){
						 scrollNews( $this );
					}, 2000);
		}).trigger("mouseleave");
});
$(function(){
        var $this = $("#indexmember ul");
		var scrollTimer;
		$this.hover(function(){
			  clearInterval(scrollTimer);
		 },function(){
		   scrollTimer = setInterval(function(){
						 scrollNews( $this );
					}, 3000);
		}).trigger("mouseleave");
});
function scrollNews(obj){
   var $self = obj; 
   var lineHeight = $self.find("li:first").height(); 
   $self.animate({ "marginTop" : -lineHeight +"px" }, 600, function(){
         $self.css({marginTop:0}).find("li:first").appendTo($self);
   })
}

//加入收藏夹 
function addBookmark()
{
var url= location.href;
var title= document.title;
if (window.sidebar)
{ 
window.sidebar.addPanel(title, url,""); 
} 
else if( document.all )
{
window.external.AddFavorite( url, title);
} 
else if( window.opera && window.print )
{
return true;
}
}