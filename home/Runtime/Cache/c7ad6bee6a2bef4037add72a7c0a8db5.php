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
    <script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$(".my2 p:last").css('borderBottom',0);
		})
    </script>
    
</head>

<body style="background-color: #f3f3f3;">
    <section class="section section1" style="margin-bottom:190px;">
    	<div class="my1">
    		<a href="javascript:;">
        	<p class="my1_p1">
        	<img src="<?php echo ($arr["headimgurl"]); ?>" onerror="this.src='__PUBLIC__/ke/img/qf.png'">
        	</p>
            <P class="my1_p2"><?php echo ($arr["nickname"]); ?></P>
        	</a>
        </div>
        <div class="my2">
        	<P class="my2_p1"><a href="__URL__/wodexuexi?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/1.png"><span>我的学习</span></a></P>
        	<P class="my2_p1"><a href="__URL__/bangshouji?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/3.png"><span>绑定手机</span></a></P>
            <P class="my2_p1"><a href="__URL__/fankui?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/6.png"><span>意见反馈</span></a></P>
        </div>
    </section>
    <footer>
        <ul>
            <li><a href="__URL__/quzheng?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
            <li class="current"><a href="__URL__/wode?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
            <div class="clear"></div>
        </ul>
    </footer>
</body>
</html>