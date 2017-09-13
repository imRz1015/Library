/*========================================================
	汤启民 17/8/14
	注：需要图片loading.gif
	用法：1.打开新页面弹出加载动画，直到页面加载完成：直接引入loading.js即可;
		  2.需要动画再次显示时，调用showLoading("show")即可;
		  使用完成后调用showLoading("hide")来关闭动画;
*/
//在页面未加载完毕之前显示的loading Html自定义内容
(function loading() {
	var _LoadingHtml = "<div id='loadingBox' style='position:fixed;z-index:999;left:0;top:0;height: 100%;width:100%;background-color:#fff;display: flex;display: -webkit-flex;justify-content:center; -webkit-justify-content: center;align-items: center; -webkit-align-items: center;'> <img src = 'loading.gif' style='width:55%;'/></div>";
	document.write(_LoadingHtml);
	window.onload = completeLoading;

	function completeLoading() {
		setTimeout(function() {
			var loadingMask = document.getElementById('loadingBox');
			loadingMask.style.display = "none";
		}, 1000)
	}
})();
//两种状态  show ,hide
function showLoading(flag) {
	var loadingMask = document.getElementById("loadingBox");
	if(flag==="show") {
		//显示加载状态
		loadingMask.style.display ="-webkit-flex";
	}else{
		//关闭动画
		setTimeout(function() {
			loadingMask.style.display = "none";
		}, 500)
	};
}