
$(document).ready(function(){if($('.reTop > a').length){$('.reTop > a').get(0).addEventListener('click',function(){$(this).addClass('on');var _this=this;setTimeout(function(){$(_this).removeClass('on');},500);window.scrollTo(0,0);});}});function toggleMore(){var openmore=$(this);if(openmore.hasClass("zkclosed")){$("#closedmenu").show();openmore.removeClass("zkclosed");openmore.addClass("zkopened");}else{$("#closedmenu").hide();openmore.removeClass("zkopened");openmore.addClass("zkclosed");}}
function getDocOffsetTop(element){if(element==null){return null;}
var offsetTop=element.offsetTop;while(element=element.offsetParent){offsetTop+=element.offsetTop;}
return offsetTop;}
function fadeIn(){}
fadeIn.prototype={timer:10,init:function(fadeId){this.fadeId=$("."+fadeId);},heigher:function(){_this=this;curheight=parseInt(this.fadeId.css("height"));this.fadeId.css("height",curheight+10+"px");if(curheight>90){this.fadeId.css("height","111px");clearInterval(timeID)
return;}
var timeID=setTimeout("_this.heigher()",this.timer);},smaller:function(){_this=this;curheight=parseInt(this.fadeId.css("height"));this.fadeId.css("height",curheight-10+"px");if(curheight<20){this.fadeId.hide()
clearInterval(timeID)
return;}
var timeID=setTimeout("_this.smaller()",this.timer);}}
function generateNavHTML(){var navHTML='<ul>'
for(var i in NAVMORE){if(i=="all")
navHTML+='<li class="all"><a href="'+NAVMORE[i].url+'">'
+NAVMORE[i].cn+'</a></li>'
else
navHTML+='<li><a href="'+NAVMORE[i].url+'">'+NAVMORE[i].cn
+'</a></li>'}
navHTML+='</ul>'
return navHTML;}
Function.prototype.bind=function(){var self=this;var arg=Array.prototype.slice.call(arguments,1);return function(){self.apply(self,arg);}}
Array.prototype.del=function(n){if(n<0)
return this;else
return this.slice(0,n).concat(this.slice(n+1,this.length));}
function lazyLoading(){}
lazyLoading.prototype={init:function(options){this.container=document.getElementById(options.container);this.threshold=options.threshold?options.threshold:0;this.counter=0;_self=this;this.containerHeight=window.screen.availHeight;addEventListener("scroll",function(){_self.doscroll()},false);var elements=document.getElementsByTagName("img");this.elements=Array.prototype.slice.call(elements);this.callback=options.callback?options.callback+"()":null;},doscroll:function(){var _this=this;var i=0;while(i<_this.elements.length){curObj=_this.elements[i];if(curObj.getAttribute("loaded")==null&&curObj.getAttribute("original")!=null){if(_this.abovethefold(curObj)){i++;}else if(_this.belowthefold(curObj)){_this.loadImg(curObj,i);this.elements=this.elements.del(i);}else{i++;if(_this.counter++>0){return false;}}}else{_this.elements=_this.elements.del(i);}}
eval(_this.callback);},loadImg:function(element,i){var curSrc=element.getAttribute("original");element.src=curSrc;element.setAttribute("loaded","1");if(element.complete){element.removeAttribute("original");}else{element.onload=function(){element.removeAttribute("original");}}
element.onerror=function(){}},abovethefold:function(element){var curScrollTop=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0;var fold=curScrollTop;var elementTop=getDocOffsetTop(element);return fold>=elementTop;},belowthefold:function(element){var curScrollTop=window.pageYOffset||document.documentElement.scrollTop||document.body.scrollTop||0;var fold=curScrollTop+this.containerHeight;var elementTop=getDocOffsetTop(element);return fold>=elementTop-this.threshold;}}
function slide(){var _currentX=0;var slideNum=0;var self=this;this.init=function(g_touch){this.inContainer=$("#"+g_touch.swapId);slideNum=g_touch.slideNum;if(g_touch.itemWidth)
this.slideWidth=g_touch.itemWidth;else
this.slideWidth=parseInt(this.inContainer.css("width"))/slideNum;if(g_touch.marginValue)
this.addV=g_touch.marginValue;else
this.addV=0;this._currentX=0;this.viewIndex=0;this.currClick=0;this.pageSlot=0;this.duration=g_touch.duration;this.carousel=true;if(g_touch.callBackFunc=="")
this.callback=null;else
this.callback=g_touch.callBackFunc+"()";this.isCycle=g_touch.isCycle;this.isDoclick=g_touch.isDoclick;this.imglist=g_touch.imglist;this.tempImagList=[];this.callBackDoclick=null;if(this.isDoclick){if(g_touch.callBackDoclick!=""||typeof(g_touch.callBackDoclick)!="undefined")
this.callBackDoclick=g_touch.callBackDoclick+"()";}
this.preloadArr=new Array();if(this.imglist){for(var i=0;i<slideNum;i++){if(i==0){this.preloadArr.push(true);}else
this.preloadArr.push(false);}}
this.inContainer.css("-webkit-transition-timing-function","ease-out");this.inContainer.css("-webkit-transform","translate3d(0,0,0)");this.inContainer.css("-webkit-transition-property","-webkit-transform");this.inContainer.css("-webkit-transition-delay",0);if(slideNum<3){this.carousel=false;this.isCycle=false;}
if(this.isCycle){this.arrangePages()}
if(this.isDoclick)
this.inContainer.get(0).addEventListener("click",self.doClick,false);this.inContainer.get(0).addEventListener("touchstart",function(){self.touchStart()},false);this.inContainer.get(0).addEventListener("touchmove",function(){self.touchMove()},false);this.inContainer.get(0).addEventListener("touchend",function(){self.touchEnd()},false);this.inContainer.get(0).addEventListener("webkitTransitionEnd",function(){if(self.isCycle){self.arrangePages();}},false);};this.nextPage=function(){this.preLoadImg(1,this.viewIndex);if(this.carousel){if(this.viewIndex==slideNum-1){if(this.isCycle)
this.setPage(0,this.pageSlot+1)}else{this.setPage(this.viewIndex+1,this.pageSlot+1)}}else{this.setPage(Math.min(this.viewIndex+1,slideNum-1))}
this.slideAction(this.pageSlot,this.duration);}
this.prevPage=function(){this.preLoadImg(2,this.viewIndex);if(this.viewIndex==0){if(this.isCycle)
this.setPage(slideNum-1,this.pageSlot-1)}else{this.setPage(this.viewIndex-1,this.pageSlot-1)}
this.slideAction(this.pageSlot,this.duration);}
this.setPage=function(pageNum,a){this.viewIndex=pageNum;this.pageSlot=a!=null?a:this.viewIndex
eval(this.callback);}
this.slideAction=function(d,t){if(d==0){if(!this.isCycle)
a=0
else
a=this.addV}else
a=-d*this.slideWidth+this.addV;var duration=!t?"0":t
this.cssTranslation(a,t);};this.cssTranslation=function(a,t){if(this._currentX==a&&this.isCycle){this.arrangePages();return}
this.setTranslation(a);this.inContainer.css("webkitTransform",'translate3d('+a
+'px,0px,0px)');this.inContainer.css("-webkitTransitionDuration",t)}
this.setChildTranslation=function(b,a){if(b._currentX==a){return}
b._currentX=a;b.css("webkitTransform",'translate3d('+a+'px,0px,0px)')};this.setTranslation=function(v){this._currentX=v;};this.arrangePages=function(){if(this.carousel){var d=this.getTranslation();if(this.viewIndex==0)
d=d-this.addV;var h=this.slideWidth,b=slideNum,l=-1*Math.floor(d/h),f=(b+(l%b))%b,i=h*b,c=-1*Math.ceil(d/i),e=Math.ceil((b-1)/2),g=Math.floor((b-1)/2),a,k;carouselBufferLimit=4;if(carouselBufferLimit>0){e=Math.min(e,carouselBufferLimit);g=Math.min(g,carouselBufferLimit)}
k=i*c;this.setChildTranslation(this.inContainer.find("li").eq(f),k);while(e>0){a=(f+e)%b;k=a<f?i*(c+1):i*c;this.setChildTranslation(this.inContainer.find("li").eq(a),k);--e}
while(g>0){a=(b+(f-g))%b;k=a>f?i*(c-1):i*c;this.setChildTranslation(this.inContainer.find("li").eq(a),k);--g}}};this.getTranslation=function(){return this._currentX;}
this.touchStart=function(){this.isMoving=false;var currTouch=event.touches[0];this.currX=currTouch.screenX;this.currY=currTouch.screenY;this.currDeltaX=this.getTranslation();this.DeltaX=0;var _self=self;if(this.isCycle)
self.arrangePages();this.preLoadImg(0,self.viewIndex);};this.touchMove=function(){var b=event.touches[0].screenX;this.DeltaX=b-this.currX;this.DeltaY=event.touches[0].screenY-this.currY;if(!this.isMoving){this.doScrollX=Math.abs(this.DeltaX)>Math.abs(this.DeltaY);this.isMoving=true;if(this.doScrollX){event.preventDefault();}}else{if(this.doScrollX){var curScrollX=parseInt(this.currDeltaX)
+parseInt(this.DeltaX);this.cssTranslation(curScrollX,"0s")
event.preventDefault();}}};this.touchEnd=function(){var moveX=this.DeltaX;if(this.isMoving){if(self.isDoclick)
self.inContainer.get(0).removeEventListener("click",self.doClick,false);if(this.doScrollX){if(moveX>10){self.prevPage();}else if(moveX<-10){self.nextPage();}else{self.slideAction(this.pageSlot,"0s");}}else{self.slideAction(this.pageSlot,"0s");}}else{if(self.isDoclick){self.doClick();}}
self.inContainer.get(0).removeEventListener("touchmove",function(){_self.touchMove()},false);self.inContainer.get(0).removeEventListener("touchend",function(){_self.touchEnd()},false);};this.doClick=function(){eval(self.callBackDoclick);}
this.gotoItemByIndex=function(index){this.preLoadImg(0,index);this.setPage(index);this.slideAction(this.pageSlot,"0s");};this.preLoadImg=function(type,index){if(this.imglist){var loadIds=[];var start=0;var end=0;if(this.isCycle&&type==0){start=index-2;end=index+2;if(start<0){start=slideNum+start;}
if(end>slideNum){end=end-slideNum;}}else if((!this.isCycle&&type==0)||type==1){start=index;end=index+2;if(end>slideNum){end=end-slideNum;}}else{start=index-2;end=index
if(start<0){start=slideNum+start;}}
if(end<start){for(var id=0;id<=end;id++){preloadIndex=id;if(preloadIndex>0&&preloadIndex<slideNum&&!this.preloadArr[preloadIndex]){if(this.imglist[preloadIndex]!=null){var curl=this.imglist[preloadIndex].url;var tempImg=new Image();tempImg.index=preloadIndex;tempImg.curl=curl;tempImg.src=curl;tempImg.onload=function(){if(self.inContainer.find("i").length>1){self.inContainer.find("i").eq(this.index).css("background-image","url("+this.curl+")");self.inContainer.find("i").eq(this.index).elements[0].className='img loaded';}
self.inContainer.find(".topic_img").eq(this.index).attr("src",this.curl);self.preloadArr[this.index]=true;}
tempImg.onerror=function(){if(self.inContainer.find("i").length>1){self.inContainer.find("i").eq(this.index).css("background-image","url("+staticPath
+"/images/loaderrpic.png"+")");self.inContainer.find("i").eq(this.index).elements[0].className='img loaded';}
self.inContainer.find(".topic_img").eq(this.index).attr("src",staticPath
+"/images/loaderrpic.png");self.preloadArr[this.index]=false;}}}}
for(var id=start;id<slideNum;id++){preloadIndex=id;if(preloadIndex>0&&preloadIndex<slideNum&&!this.preloadArr[preloadIndex]){if(this.imglist[preloadIndex]!=null){var curl=this.imglist[preloadIndex].url;var tempImg=new Image();tempImg.index=preloadIndex;tempImg.curl=curl;tempImg.src=curl;tempImg.onload=function(){if(self.inContainer.find("i").length>1){self.inContainer.find("i").eq(this.index).css("background-image","url("+this.curl+")");self.inContainer.find("i").eq(this.index).elements[0].className='img loaded';}
self.inContainer.find(".topic_img").eq(this.index).attr("src",this.curl);self.preloadArr[this.index]=true;}
tempImg.onerror=function(){if(self.inContainer.find("i").length>1){self.inContainer.find("i").eq(this.index).css("background-image","url("+staticPath
+"/images/loaderrpic.png"+")");self.inContainer.find("i").eq(this.index).elements[0].className='img loaded';}
self.inContainer.find(".topic_img").eq(this.index).attr("src",staticPath
+"/images/loaderrpic.png");self.preloadArr[this.index]=false;}}}}}else{for(var id=start;id<=end;id++){preloadIndex=id;if(preloadIndex>0&&preloadIndex<slideNum&&!this.preloadArr[preloadIndex]){if(this.imglist[preloadIndex]!=null){var curl=this.imglist[preloadIndex].url;var tempImg=new Image();tempImg.index=preloadIndex;tempImg.curl=curl;tempImg.src=curl;tempImg.onload=function(){if(self.inContainer.find("i").length>1){self.inContainer.find("i").eq(this.index).css("background-image","url("+this.curl+")");self.inContainer.find("i").eq(this.index).elements[0].className='img loaded';}
self.inContainer.find(".topic_img").eq(this.index).attr("src",this.curl);self.preloadArr[this.index]=true;}
tempImg.onerror=function(){if(self.inContainer.find("i").length>1){self.inContainer.find("i").eq(this.index).css("background-image","url("+staticPath
+"/images/loaderrpic.png"+")");self.inContainer.find("i").eq(this.index).elements[0].className='img loaded';}
self.inContainer.find(".topic_img").eq(this.index).attr("src",staticPath
+"/images/loaderrpic.png");self.preloadArr[this.index]=false;}}}}}}}}
function addDskTip(){var tipObj=$("#addDskTip");if(!tipObj.length||navigator.userAgent.indexOf("iPhone")<0||!jUtil.browser().safari)
return;if(localStorage){var bmc=parseInt(localStorage.getItem("bookmarkCount"));var bms=localStorage.getItem("bookmarkShowCount");if((bmc&&bmc>=1)||(bms&&parseInt(bms)>=3)){$("#addDskTip").hide();g_app.isDskHidden=true;return;}
var height=230;if(Math.abs(window.orientation)==90){height=100;}
$("#tipimg").attr("src",staticPath+"/images/bg_shuqian.png");tipObj.css("top",height+"px");tipObj.show();var currBookmarkShowCount=bms!=null?parseInt(bms)+1:1;window.localStorage.setItem("bookmarkShowCount",currBookmarkShowCount);}else{return;}
addEventListener("scroll",function(){if(g_app.isDskHidden){return;}else{$("#addDskTip").hide();g_app.isDskHidden=true;}},false);tipObj.get(0).addEventListener("click",function(){if(localStorage){var currBookmarkCount=localStorage.getItem("bookmarkCount");currBookmarkCount=currBookmarkCount!=null?parseInt(currBookmarkCount)+1:1;try{window.localStorage.setItem("bookmarkCount",currBookmarkCount);$("#addDskTip").hide();g_app.isDskHidden=true;}catch(e){$("#addDskTip").hide();g_app.isDskHidden=true;}}},false);}
function H$(i){return document.getElementById(i)}
function H$$(c,p){return p.getElementsByTagName(c)}
function scrollShow(){};scrollShow.prototype={init:function(o){this.id=o.id;this.at=o.auto?o.auto:1;this.o=0;this.pos();},pos:function(){this.o=0;var el=H$(this.id);var li=H$$('li',el),l=li.length;this.offsetH=li[l-1].offsetHeight-12;var cl=li[l-1].cloneNode(true);this.insertLi=cl;cl.style.opacity=0;cl.style.filter='alpha(opacity=0)';cl.style.height=0;el.insertBefore(cl,el.firstChild);this.anim();},anim:function(){var _this=this;this.__t=0;this.__a=setInterval(function(){_this.animH()},20);},animH:function(){var _this=this;if(this.offsetH-this.__t<2){this.insertLi.style.height=this.offsetH+'px';clearInterval(this.__a);var list=H$$('li',H$(this.id));H$(this.id).removeChild(list[list.length-1]);setTimeout(function(){_this.animO()},500);}else{this.__t=this.__t+2;this.insertLi.style.height=this.__t+'px';}},animO:function(){var _this=this;this.__c=setInterval(function(){_this.animOO()},20);},animOO:function(){this.o+=2;if(this.o==100){clearInterval(this.__c);H$$('li',H$(this.id))[0].style.opacity=1;H$$('li',H$(this.id))[0].style.filter='alpha(opacity=100)';this.auto();}else{H$$('li',H$(this.id))[0].style.opacity=this.o/100;H$$('li',H$(this.id))[0].style.filter='alpha(opacity='+this.o
+')';}},auto:function(){var _this=this;this._autoT=setTimeout(function(){_this.pos()},this.at*1000);},clearTimer:function(){clearInterval(this.__c);clearInterval(this.__a);clearTimeout(this._autoT);}}
var getXY=function(el){var d=document,bd=d.body,r={t:0,l:0},ua=navigator.userAgent.toLowerCase(),isStrict=d.compatMode=="CSS1Compat",isGecko=/gecko/.test(ua),add=function(t,l){r.l+=l,r.t+=t},p=el;if(el&&el!=bd){if(el.getBoundingClientRect){var b=el.getBoundingClientRect();add(b.top
+Math.max(d.body.scrollTop,d.documentElement.scrollTop),b.left
+Math.max(d.body.scrollLeft,d.documentElement.scrollLeft));isStrict?add(-d.documentElement.clientTop,-d.documentElement.clientLeft):add(-1,-1)}else{var dv=d.defaultView;while(p){add(p.offsetTop,p.offsetLeft);var computStyle=dv.getComputedStyle(p,null);if(isGecko){var bl=parseInt(computStyle.getPropertyValue('border-left-width'),10)||0,bt=parseInt(computStyle.getPropertyValue('border-top-width'),10)||0;add(bt,bl);if(p!=el&&computStyle.getPropertyValue('overflow')!='visible')
add(bt,bl);}
p=p.offsetParent;}
p=el.parentNode;while(p&&p!=bd){add(-p.scrollTop,-p.scrollLeft);p=p.parentNode;}}}
return r;}