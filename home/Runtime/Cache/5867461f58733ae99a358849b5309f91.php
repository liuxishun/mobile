<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/style.css">
        <!-------------------百度统计------------------------->
	<script type='text/javascript'>
      var _vds = _vds || [];
      window._vds = _vds;
      (function(){
        _vds.push(['setAccountId', 'b7af4d25c353148d']);
        (function() {
          var vds = document.createElement('script');
          vds.type='text/javascript';
          vds.async = true;
          vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';
          var s = document.getElementsByTagName('script')[0];
          s.parentNode.insertBefore(vds, s);
        })();
      })();
  </script>
  <script type='text/javascript' src='https://assets.growingio.com/sdk/wx/vds-wx-plugin.js'></script>

    <!-------------------百度统计------------------------->	
	<script type="text/javascript" src="http://api.map.baidu.com/api?key=32ce28edca8ac5443b5d8d0a9ff91d00&v=1.1&services=true" ></script>
	<script type="text/javascript" src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript">
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth / 640;
        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua) ) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale + ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">')
            } else {
                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale + ' , target-densitydpi=device-dpi">')
            }
        } else {
            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">')
        }
        if (window.navigator.geolocation) { 
	        var options = { 
	            enableHighAccuracy: true, 
	        }; 
	         window.navigator.geolocation.getCurrentPosition(handleSuccess, handleError, options); 
		 } else { 
             alert("浏览器不支持html5来获取地理位置信息"); 
         }
        function handleSuccess(position){ 
            // 获取到当前位置经纬度  本例中是chrome浏览器取到的是google地图中的经纬度 
            var lng = position.coords.longitude; 
            var lat = position.coords.latitude; 
			var point = new BMap.Point(lng,lat);
			var gc = new BMap.Geocoder(); 
			gc.getLocation(point, function(rs) {
				var addComp = rs.addressComponents;
				if(boll)location.href='fuwu/goIndex?address='+addComp.city;
				//var mapAddress = addComp.province+addComp.city + addComp.district + addComp.street + addComp.streetNumber;
			}); 

        } 
        
        function handleError(error){ 
        
        } 
        
    </script>
    
</head>
<body style="background-color: #f3f3f3;">
	
</body>
</html>