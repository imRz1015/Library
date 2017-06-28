//解决弹窗显示后网页还能滑动的问题
//弹窗显示后调用allow()方法禁用滑动，隐藏时调用ban()开启滑动
//TANGiMING
var preHandler = function(e) {
				e.preventDefault();
			}
function allow(){
	document.addEventListener('touchmove',preHandler, false);
}
function ban(){
	document.removeEventListener('touchmove', preHandler, false);
}
