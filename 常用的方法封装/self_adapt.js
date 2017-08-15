/******************************************
*引用此js可根据页面宽度自动计算rem的基础值*
*默认基础值：width=320,font-size:20px;   
*PC页面改为var clientWidth=window.screen.width(用户屏幕分辨率宽度)**
******************************************/

(function (doc, win) {
	var docEl = doc.documentElement,
	resizeEvt = 'orientationchange' in window ? 'orientationchange' : 'resize',
	recalc = function () {
		var clientWidth = docEl.clientWidth;
		if (!clientWidth) return;
		docEl.style.fontSize = 20 * (clientWidth / 320) + 'px';
	};

	if (!doc.addEventListener) return;
	win.addEventListener(resizeEvt, recalc, false);
	doc.addEventListener('DOMContentLoaded', recalc, false);
})(document, window);
