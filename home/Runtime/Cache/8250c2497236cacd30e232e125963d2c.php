<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
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
    <section class="section" style="margin-bottom:190px; top:10px;">
    	<?php if(empty($list)): ?><P style="font-size:26px; text-align:center; line-height:80px; color:#666;">您当前没有学习信息</P><?php endif; ?>
        <ul class="list-item">
        	<?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
               <a href="__URL__/quzhengxinxi/id/<?php echo ($li["id"]); ?>/openid/<?php echo ($openid); ?>" class="a">
                  <img src="http://my.mumway.com/<?php echo ($li["tpic"]); ?>" class="img" />
                  <div class="info">
                       <h3><?php echo ($li["title"]); ?></h3>
                       <p><?php echo ($li["target"]); ?></p>
                       <span class="new-price"><?php echo ($li['utime']); ?></span>
                  </div>
                </a>
	         </li><?php endforeach; endif; ?>
        </ul>
        
    </section>
        <footer>
        <ul>
            <li><a href="__URL__/quzheng?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
            <li class="current"><a href="__URL__/wode?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
        </ul>
    </footer>
</body>
    <script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$('.choose_con>li:last a').css('borderRight',0);
			$('.choose_con>li').click(function(e) {
	               $(this).addClass('current').siblings().removeClass('current');
	           });
		});
	
    </script>
</html>