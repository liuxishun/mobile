$(function() {
	scroll("scrollLeft");
})
function scroll(id){
	var oUl = document.getElementById(id);
	var oli = oUl.getElementsByTagName("li");
	oUl.innerHTML += oUl.innerHTML;
	var width = oli[0].offsetWidth;
	oUl.style.width = oli.length * width + (oli.length - 1) * 11 + "px";
	var iSpeed = -10;
	var timer = null;

	function fnMove() {
		if (oUl.offsetLeft < -oUl.offsetWidth / 2) {
			oUl.style.left = 0;
		} else if (oUl.offsetLeft > 0) {
			oUl.style.left = -oUl.offsetWidth / 2 + 'px';
		}
		oUl.style.left = oUl.offsetLeft + iSpeed + 'px';
	}
	timer = setInterval(fnMove, 100);
}
