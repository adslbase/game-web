function glaxSlider(o) {
	this.id =o.id;
	this.at =o.auto?o.auto:3;
	this.tagName =o.tagName;
	this.o=0;
	this.__b=null;
	this.signal=true;
	this.pos();
	this.init();
}
glaxSlider.prototype={
	constructor:glaxSlider,
	$:function(o){
		return document.getElementById(o);
	},
	get:function(child,parent){
		return parent.getElementsByTagName(child);
	},
	init:function(){
		var self=this,
			elem=this.$(this.id);
		elem.onmouseover =function(){
			self.signal=false;
			clearInterval(self.__b);
		};
		elem.onmouseout=function(){
			self.signal=true;
			self.auto();
		};		
	},
	pos:function(){
		if(this.signal){
			clearInterval(this.__b);
			this.o=0;
			var elem =this.elem=this.$(this.id), 
				 list =this.get(this.tagName,elem), 
				 len =list.length,			 
				 lastNode=list[len-1],
				 top=lastNode.offsetHeight,
				 cloneNode=lastNode.cloneNode(true),
				 _style=cloneNode.style;
			_style.opacity=0; 
			_style.filter='alpha(opacity=0)';
			elem.insertBefore(cloneNode,elem.firstChild);
			elem.style.top=-top+'px';
			this.anim();
		}
	},
	anim:function () {
		var _this =this;
		this.__a =setInterval(function(){_this.animH();},20);
	},
	animH:function () {
		var _t=parseInt(this.elem.style.top),_this=this;
		if (_t>=-1) {
			clearInterval(this.__a);
			this.elem.style.top=0;
			var list=this.get(this.tagName,this.elem);
			this.elem.removeChild(list[list.length-1]);
			this.__c=setInterval(function(){
				_this.animO();
			},20);
		}else {
			var __t=Math.abs(_t)-Math.ceil(Math.abs(_t)*.07);
			this.elem.style.top = -__t+'px';
		}
	},
	animO:function () {
		var _style=this.get(this.tagName,this.elem)[0].style;
		this.o+=2;
		if (this.o==100) {
			clearInterval(this.__c);
			_style.opacity = 1;
			_style.filter ='alpha(opacity=100)';
			this.auto();
		}else {
			_style.opacity=this.o/100;
			_style.filter='alpha(opacity='+this.o+')';
		}
	},
	auto:function () {
		var _this=this;
		clearInterval(this.__b);
		this.__b=setInterval(function(){
			_this.pos();
		}, this.at*1000);
	}
}
setTimeout(function(){
	var b=new glaxSlider({
		id:'glaxSlider',
		tagName:"dd",
		len:3
	});	
},1000);