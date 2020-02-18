<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html> 
 <html> 
     <head> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>好孕妈妈</title> 
		<script src="http://api.map.baidu.com/api?v=1.3" type="text/javascript"></script>
        <script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
        <script type="text/javascript">
	        var phoneWidth = parseInt(window.screen.width);
	        var phoneScale = phoneWidth / 640;
	        var ua = navigator.userAgent;
	        if (/Android (\d+\.\d+)/.test(ua)) {
	            var version = parseFloat(RegExp.$1);
	            if (version > 2.3) {
	                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale + ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">')
	            } else {
	                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale + ' , target-densitydpi=device-dpi">')
	            }
	        } else {
	            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">')
	        }
	    </script>
        <style type="text/css"> 
			*{ 
				height: 100%; //设置高度，不然会显示不出来 
			} 
		</style>
    </head>
     <body>
     	<div id="map"></div>
     </body>
     <script type="text/javascript">
	  	 // 调用百度地图api显示 
		 var map = new BMap.Map("map");
		 map.addControl(new BMap.NavigationControl()); //放大按钮
		 map.addControl(new BMap.ScaleControl()); //极速版
		 map.addControl(new BMap.OverviewMapControl()); 
		 var point = new BMap.Point(<?php echo ($arr["LNG"]); ?>,<?php echo ($arr["LAT"]); ?>);
		 map.centerAndZoom(point,15);
		 map.enableScrollWheelZoom(true);// 允许鼠标滑轮放大缩小
		 map.addOverlay(new BMap.Marker(point));// 显示坐标点
    </script>
 </html>