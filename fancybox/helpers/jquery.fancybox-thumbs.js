/*!
* Thumbnail helper for fancyBox
* version: 1.0.7 (Mon, 01 Oct 2012)
* @requires fancyBox v2.0 or later
* Usage:
*	$(".fancybox").fancybox({
*	helpers:{
*		thumbs:{
*			width:50,
*			height:50
*		}
*	}
*	});
*/
!function(a){var b=a.fancybox;b.helpers.thumbs={defaults:{width:50,height:50,position:"bottom",source:function(b){var c;return b.element&&(c=a(b.element).find("img").attr("src")),!c&&"image"===b.type&&b.href&&(c=b.href),c}},wrap:null,list:null,width:0,init:function(b,c){var e,d=this,f=b.width,g=b.height,h=b.source;e="";for(var i=0;i<c.group.length;i++)e+='<li><a style="width:'+f+"px;height:"+g+'px;" href="javascript:jQuery.fancybox.jumpto('+i+');"></a></li>';this.wrap=a('<div id="fancybox-thumbs"></div>').addClass(b.position).appendTo("body"),this.list=a("<ul>"+e+"</ul>").appendTo(this.wrap),a.each(c.group,function(b){var e=h(c.group[b]);e&&a("<img />").load(function(){var h,i,j,c=this.width,e=this.height;d.list&&c&&e&&(h=c/f,i=e/g,j=d.list.children().eq(b).find("a"),h>=1&&i>=1&&(h>i?(c=Math.floor(c/i),e=g):(c=f,e=Math.floor(e/h))),a(this).css({width:c,height:e,top:Math.floor(g/2-e/2),left:Math.floor(f/2-c/2)}),j.width(f).height(g),a(this).hide().appendTo(j).fadeIn(300))}).attr("src",e)}),this.width=this.list.children().eq(0).outerWidth(!0),this.list.width(this.width*(c.group.length+1)).css("left",Math.floor(.5*a(window).width()-(c.index*this.width+.5*this.width)))},beforeLoad:function(a,b){return b.group.length<2?void(b.helpers.thumbs=!1):void(b.margin["top"===a.position?0:2]+=a.height+15)},afterShow:function(a,b){this.list?this.onUpdate(a,b):this.init(a,b),this.list.children().removeClass("active").eq(b.index).addClass("active")},onUpdate:function(b,c){this.list&&this.list.stop(!0).animate({left:Math.floor(.5*a(window).width()-(c.index*this.width+.5*this.width))},150)},beforeClose:function(){this.wrap&&this.wrap.remove(),this.wrap=null,this.list=null,this.width=0}}}(jQuery);