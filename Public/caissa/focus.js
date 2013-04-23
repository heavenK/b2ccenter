(function ($) {
$.fn.soChange = function (o) {return  new $sG(this, o);};var settings = {thumbObj:null,botPrev:null,botNext:null,thumbNowClass:'show',thumbOverEvent:true,slideTime:800,autoChange:true,clickFalse:true,overStop:true,changeTime:3000,delayTime:300};

 $.soChangeLong = function(e, o) {
    this.options = $.extend({}, settings, o || {});
	var _self = $(e);
	var set = this.options;
	var thumbObj;
	var size = _self.size();
	var nowIndex = 0;
	var index;
	var startRun;
	var delayRun;
	_self.hide();
	_self.eq(0).show();
function fadeAB () {
	if (nowIndex != index) {
		if (set.thumbObj!=null) {
		$(set.thumbObj).removeClass(set.thumbNowClass).eq(index).addClass(set.thumbNowClass);}
		if (set.slideTime <= 0) {
			_self.eq(nowIndex).hide();
			_self.eq(index).show();	
		}else{
			_self.eq(nowIndex).fadeOut(set.slideTime);
			_self.eq(index).fadeIn(set.slideTime);
		}
		nowIndex = index;
		if (set.autoChange==true) {
		clearInterval(startRun);
		startRun = setInterval(runNext,set.changeTime);}
		}
}
function runNext() {
	index =  (nowIndex+1)%size;
	fadeAB();
}
	if (set.thumbObj!=null) {
	thumbObj = $(set.thumbObj);
	thumbObj.removeClass(set.thumbNowClass).eq(0).addClass(set.thumbNowClass);

		thumbObj.click(function () {
			index = thumbObj.index($(this));
			fadeAB();
			if (set.clickFalse == true) {
				return false;
			}
		});
		if (set.thumbOverEvent == true) {
		thumbObj.mouseenter(function () {
			index = thumbObj.index($(this));
			delayRun = setTimeout(fadeAB,set.delayTime);
		});
		thumbObj.mouseleave(function () {
			clearTimeout(delayRun);
		});
		}
	}
	if (set.botNext!=null) {
		$(set.botNext).click(function () {
			if(_self.queue().length<1){
			runNext();}
			return false;
		});
	}
	if (set.botPrev!=null) {
		$(set.botPrev).click(function () {
			if(_self.queue().length<1){
			index = (nowIndex+size-1)%size;
			fadeAB();}
			return false;
	});
	}
	if (set.autoChange==true) {
	startRun = setInterval(runNext,set.changeTime);
	if (set.overStop == true) {
		_self.mouseenter(function () {
			clearInterval(startRun);
			
		});
		_self.mouseleave(function () {
			startRun = setInterval(runNext,set.changeTime);
		});
		}
	}

}

var $sG = $.soChangeLong;

})(jQuery);

(function(a){a.fn.jCarouselLite=function(b){b=a.extend({btnPrev:null,btnNext:null,btnGo:null,mouseWheel:false,auto:null,speed:200,easing:null,vertical:false,circular:true,visible:3,start:0,scroll:1,beforeStart:null,afterEnd:null},b||{});return this.each(function(){var n=false,m=b.vertical?"top":"left",p=b.vertical?"height":"width",k=a(this),i=a("ul",k),o=a("li",i),t=o.size(),e=b.visible;if(b.circular){i.prepend(o.slice(t-e-1+1).clone()).append(o.slice(0,e).clone());b.start+=e}var h=a("li",i),g=h.size(),f=b.start;k.css("visibility","visible");h.css({overflow:"hidden","float":b.vertical?"none":"left"});i.css({margin:"0",padding:"0",position:"relative","list-style-type":"none","z-index":"1"});k.css({overflow:"hidden",position:"relative","z-index":"2",left:"0px"});var j=b.vertical?c(h):d(h),s=j*g,r=j*e;h.css({width:h.width(),height:h.height()});i.css(p,s+"px").css(m,-(f*j));k.css(p,r+"px");b.btnPrev&&a(b.btnPrev).click(function(){return l(f-b.scroll)});b.btnNext&&a(b.btnNext).click(function(){return l(f+b.scroll)});b.btnGo&&a.each(b.btnGo,function(c,d){a(d).click(function(){return l(b.circular?b.visible+c:c)})});b.mouseWheel&&k.mousewheel&&k.mousewheel(function(c,a){return a>0?l(f-b.scroll):l(f+b.scroll)});b.auto&&setInterval(function(){l(f+b.scroll)},b.auto+b.speed);function q(){return h.slice(f).slice(0,e)}function l(c){if(!n){b.beforeStart&&b.beforeStart.call(this,q());if(b.circular)if(c<=b.start-e-1){i.css(m,-((g-e*2)*j)+"px");f=c==b.start-e-1?g-e*2-1:g-e*2-b.scroll}else if(c>=g-e+1){i.css(m,-(e*j)+"px");f=c==g-e+1?e+1:e+b.scroll}else f=c;else if(c<0||c>g-e)return;else f=c;n=true;i.animate(m=="left"?{left:-(f*j)}:{top:-(f*j)},b.speed,b.easing,function(){b.afterEnd&&b.afterEnd.call(this,q());n=false});if(!b.circular){a(b.btnPrev+","+b.btnNext).removeClass("disabled");a(f-b.scroll<0&&b.btnPrev||f+b.scroll>g-e&&b.btnNext||[]).addClass("disabled")}}return false}})};function b(c,b){return parseInt(a.css(c[0],b))||0}function d(a){return a[0].offsetWidth+b(a,"marginLeft")+b(a,"marginRight")}function c(a){return a[0].offsetHeight+b(a,"marginTop")+b(a,"marginBottom")}})(jQuery)