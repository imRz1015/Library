var Tanchuang = function(params){
	this.cover = '<div id="tc_cover" style="width:100%;height:100%;position:fixed;background-color: rgba(0,0,0,0.7);z-index:1000;"></div>';
	this.chuangtistart = '<div id="tc_chuangti" style="text-align:center;width:75%;position:fixed;left:12.5%;top:50%;opacity:0;background-color:#fff;z-index:1001;border-radius:5px;">';
	this.chuangtiend = '</div>';
	this.title = '<div style="display:inline-block;background:url(img/tishi.png) no-repeat left;background-size:1.05rem 1rem;color:#ff4b33;font-size:0.9rem;padding:0.75rem 0 0.75rem 1.325rem">'+(params.title||'提示')+'</div>';
	this.content = '<div style="text-align:left;padding:0 0.325rem;font-size:0.75rem;color:#4d4d4d;">'+(params.content||'')+'</div>';
	this.getBtns = function(btns){
		if(btns.length>0 && btns.length<3){
			var width = (100/btns.length).toFixed(2);
			var rets = "";
			var colors = new Array("#ff6600","#ff944c");
			for(var l in btns){
				rets += ('<div id="btn-'+l+'" style="display:inline-block;margin-top:0.75rem;width:'+width+'%;padding:0.5rem 0;background-color:'+colors[l]+';font-size:0.85rem;border-radius:0px 0px '+(l==btns.length-1?'5':'0')+'px '+(l==0?'5':'0')+'px;color:#fff;">'+btns[l].title+'</div>');
			}
			return rets;
		}else{
			return '<div style="display:inline-block;margin-top:0.75rem;width:100%;padding:0.5rem 0;background-color:#ff6600;font-size:0.85rem;border-radius:0px 0px 5px 5px;color:#fff;">确定</div>';
		}
	};
	this.buttons = this.getBtns(params.buttons);
	this.getDOM = function(){
		return this.cover + this.chuangtistart + this.title + this.content + this.buttons + this.chuangtiend;
	}
	this.bindcallback = function(speed){
		for(var l in params.buttons){
			if(typeof params.buttons[l].callback === "function"){
				$("#btn-"+l).click(params.buttons[l].callback);
			}else{
				$("#btn-"+l).click(function(){
					$("#tc_cover").animate({opacity:0},speed||200,function(){$(this).hide();})
					$("#tc_chuangti").animate({opacity:0},speed||200,function(){$(this).hide();})
				});
			}
		}
	}
	this.show = function(speed){
		$("#tc_cover").remove();
		$("#tc_chuangti").remove();
		$("body").prepend(this.getDOM());
		this.bindcallback(speed);
		$("#tc_chuangti").css("margin-top","-"+($("#tc_chuangti").height()/2).toFixed(0)+"px");
		$("#tc_chuangti").animate({opacity:1},speed||200);
	}
}