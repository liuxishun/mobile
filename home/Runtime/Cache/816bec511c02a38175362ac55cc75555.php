<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/style.css">
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/my.css">
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
<!-- 
    <header id="header1">
        <div id="top1">
            <P class="title_s">我的</P>
            <a href="#" class="collect news_but"></a>
        </div>        
    </header> -->
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
        	<!--
        	<P class="my2_p1"><a href="ke/shenbao"><img src="__PUBLIC__/ke/img/my/5.png"><span>证书申报</span></a></P>
        	<P class="my2_p1"><a href="ke/xuefen"><img src="__PUBLIC__/ke/img/my/3.png"><span>学分排行</span></a></P>
        	<P class="my2_p1"><a href="ke/xiangce"><img src="__PUBLIC__/ke/img/my/4.png"><span>工作相册</span></a></P>
        	<P class="my2_p1"><a href="__URL__/wodequan?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/5.png"><span>我的优惠</span></a></P>
        	-->
        	<P class="my2_p1"><a href="__URL__/wodexuexi?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/1.png"><span>我的学习</span></a></P>
        	<P class="my2_p1"><a href="__URL__/banguser?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/3.png"><span>绑定手机</span></a></P>
            <P class="my2_p1"><a href="__URL__/fankui?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/img/my/6.png"><span>意见反馈</span></a></P>
        </div>
    </section>
    <footer>
        <ul>
            <li><a href="__URL__/quzheng?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
            <!--
            <li>
                60元课程福利<a href="__ROOT__/fuli/fuli.php?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe602;</i></div><span>福利</span></a>
             	中秋活动转盘抽奖__ROOT__/prize/index/index.php?openid=<?php echo ($openid); ?>
                <a href="__URL__/banzhang?openid=<?php echo ($openid); ?>"><div style="border:none;"><img style="width:100%;"alt="" src="/Public/ke/img/ban1.png"></div><span>班长</span></a>
            </li>
            <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>"><div style="border:none;"><img style="width:100%;" alt="" src="/Public/ke/img/jiu1.png"></div><span>就业</span></a></li>
            -->
            <li class="current"><a href="__URL__/wode?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
            <div class="clear"></div>
        </ul>
    </footer>
    
</body>
</html>