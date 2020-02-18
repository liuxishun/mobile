
var randNum = Math.round(Math.random()*1);
randNum = 0;
		if(randNum){
			pwidth = 640;
		}else{
			pwidth = 750;
		}
		$(function(){
		//$("body").load("px.html");
			if(randNum){
				//$("body").load("px.html");
			}else{
				//$("body").load("pxbj.html");
			}
		});

/***********自适应代码*************/
var phoneWidth = parseInt(window.screen.width);
var phoneScale = phoneWidth / pwidth;
var ua = navigator.userAgent;
if (/Android (\d+\.\d+)/.test(ua) ) {
	var version = parseFloat(RegExp.$1);
	if (version > 2.3) {
		document.write('<meta name="viewport" content="width=' + pwidth + ', initial-scale= ' + phoneScale + ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">')
	} else {
		document.write('<meta name="viewport" content="width=' + pwidth + ', initial-scale= ' + phoneScale + ' , target-densitydpi=device-dpi">')
	}
} else {
	document.write('<meta name="viewport" content="width=' + pwidth + ', user-scalable=no, target-densitydpi=device-dpi">')
}


