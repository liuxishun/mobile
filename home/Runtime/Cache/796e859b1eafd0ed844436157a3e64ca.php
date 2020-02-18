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
    <script type="text/javascript">
		$(function(){
			$('.top_choice li:last').css('borderRight',0);
			$('.choose_con>li:last a').css('borderRight',0);
			
		});

    </script>
    
</head>

<body style="background-color: #f3f3f3;">
    <header id="header">
        <div id="choose">
        	<ul class="choose_con">
                <li><a href="__URL__/quzheng/openid/<?php echo ($openid); ?>">在线考证</a></li>
                <li class="current"><a href="__URL__/mianshou/openid/<?php echo ($openid); ?>">面授特训</a></li>
            </ul>
        </div>
    </header>
    <section class="section">
        <ul class="face_to_face">
        	<?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
                <a href="__URL__/mianshouxinxi/id/<?php echo ($li["SCID"]); ?>/openid/<?php echo ($openid); ?>" class="a">
                    <h3><?php echo ($li["SCNAME"]); ?></h3>
					<p class="face_to_face_p1"><?php echo ($li["SCDETAIL"]); ?></p>
                    <P class="face_to_face_p2">
                    <?php if(is_array($li["SCPICS"])): foreach($li["SCPICS"] as $key=>$ll): ?><img src="http://my.mumway.com/<?php echo ($ll["PIC"]); ?>" onerror="this.src='__PUBLIC__/ke/img/logoimg.png'"><?php endforeach; endif; ?>
                    </P>
                </a>
                <P class="face_to_face_p3"><a class="face_to_face_p3_a1" href="http://m.mumway.com/pxy/indexyf.html?yf">我想了解下</a><a class="face_to_face_p3_a2" href="__URL__/ditu?LNG=<?php echo ($li["LNG"]); ?>&LAT=<?php echo ($li["LAT"]); ?>">到这里去</a></P>

            </li><?php endforeach; endif; ?>
        </ul>
    </section>
	<footer>
        <ul>
            <li class="current"><a href="__URL__/quzheng?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
            <li><a href="__URL__/wode?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
            <div class="clear"></div>
        </ul>
    </footer>
</body>
</html>