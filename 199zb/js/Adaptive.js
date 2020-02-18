/***********自适应代码*************/
var phoneWidth = parseInt(window.screen.width);
var phoneScale = phoneWidth / 750;
var ua = navigator.userAgent;
if (/Android (\d+\.\d+)/.test(ua) ) {
	var version = parseFloat(RegExp.$1);
	if (version > 2.3) {
		document.write('<meta name="viewport" content="width=750, initial-scale= ' + phoneScale + ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">')
	} else {
		document.write('<meta name="viewport" content="width=750, initial-scale= ' + phoneScale + ' , target-densitydpi=device-dpi">')
	}
} else {
	document.write('<meta name="viewport" content="width=750, user-scalable=no, target-densitydpi=device-dpi">')
}



/***********抓取代码*************/
// var _vds = _vds || [];
// window._vds = _vds;

// (function(){
// 	_vds.push(['setAccountId', '87405247014f637f']);
// 	(function() {
// 		var vds = document.createElement('script');
// 		vds.type='text/javascript';
// 		vds.async = true;
// 		vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';
// 		var s = document.getElementsByTagName('script')[0];
// 		s.parentNode.insertBefore(vds, s);
// 	})();

// })();

