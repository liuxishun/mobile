<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/style.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/my.css">
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
</head>

<body style="background-color: #f3f3f3;">
    <section class="section section1" style="margin-bottom:190px;">
    	<form action="__URL__/fankui" method="post">
    	<div class="view">
    		<input type="hidden" name="openid" value="<?php echo ($openid); ?>"/>
        	<textarea id="content" name="content" placeholder="请描述你的问题"></textarea>
            <input type="submit" value="提交">
        </div>
    	</form>
    </section>
</body>
</html>