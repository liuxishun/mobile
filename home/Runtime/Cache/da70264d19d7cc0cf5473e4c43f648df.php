<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>好孕妈妈</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/style.css">
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
</head>

<body style="background-color: #f3f3f3;">
    <div id="divhidd" class="alert" style=" z-index:9999; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5);<?php if($display){ }else{echo 'display:none;';} ?>">
    	<div class="kuang" style="width:450px; margin:350px auto 0; background:#fff; padding:20px; border-radius:11px;">
        	<P class="close11" style="font-size:26px; text-align:right; color:#000;"><span onclick="javascript:location.href='__URL__/mianshou/openid/<?php echo ($openid); ?>'">×</span></P>
            <P style="font-size:28px; text-align:center; color:#fe3e3e; line-height:60px; border-bottom:1px solid #dbdbdb;">提示信息</P>
            <P style="font-size:28px; text-align:center; color:#565656; line-height:60px; "><?php echo ($text); ?></P>
        </div>
    
    </div>
    
    <section class="section section1" style="margin-bottom:200px;">
        <div class="vedio">
        	<img src="http://my.mumway.com/<?php echo ($arr["SCPIC"]); ?>" onerror="this.src='__PUBLIC__/ke/img/banner2.png'">
        </div>
        <div class="sem1">
        	<h3 class="sem1_h3"><?php echo ($arr["SCNAME"]); ?></h3>
            <p class="sem1_p1">时间：<?php echo ($arr["SCTIME"]); ?></p>
            <a class="sem1_a" href="javascript:;">报名中</a>
        </div>
        <div class="sem2">
        	<P><span class="sem2_s1">地点：</span><span class="sem2_s2"><?php echo ($arr["SCPOSITION"]); ?></span></P>
        </div>
        <div class="sem3">
        	<h3>详情介绍</h3>
            <P><?php echo ($arr["SCDETAIL"]); ?></P>
        
        </div>        
    </section>
    <footer class="vedio_foot">
    	<form action="http://admin.mumway.com/active/faceteaching/" method="post">
    		<input type="hidden" name="SCID" value="<?php echo ($arr["SCID"]); ?>"/>
    		<input type="hidden" name="SCTIME" value="<?php echo ($arr["SCTIME"]); ?>"/>
			<input type="hidden" name="openid" value="<?php echo ($openid); ?>"/>
    		<input class="vedio_but" type="submit" value="马上报名">
    	</form>
    </footer>
</body>
</html>