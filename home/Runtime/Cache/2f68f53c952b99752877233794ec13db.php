<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>好孕妈妈</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/zhibo.css">
	<script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
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
	<script type="text/javascript">
		$(function(){
			$('.top_choice li:last').css('borderRight',0);
			$('.choose_con>li:last a').css('borderRight',0);
		});
		
    </script>
</head>
<body style="background-color: #f3f3f3;">
	<div class="weihu" style="display:none; position:fixed; top:25%; left:50%; width:400px; z-index:9999; margin-left:-200px; padding:30px; background:#fff; border-radius:15px;">
    	<P style="font-size:26px; color:#999; line-height:50px; text-align:right;"><span class="weihu_span" onclick="javascript:$('.weihu').hide();">×</span></P>
        <P style="font-size:30px; color:red; line-height:50px; text-align:center;">服务器正在维护当中...<br>敬请谅解</P>
    </div>
	<header id="header">
        <div id="choose">
        	<ul class="choose_con">
            	<li class="current"><a href="__ROOT__/index.php/ke/jy_zhibo/openid/<?php echo ($openid); ?>">技能进阶</a></li>
                <li><a href="__ROOT__/index.php/ke/quzheng/openid/<?php echo ($openid); ?>">在线考证</a></li>
                <li><a href="__ROOT__/index.php/ke/mianshou/openid/<?php echo ($openid); ?>">面授特训</a></li>
            </ul>
        </div>
    </header>	
    
    <section class="section">
    	<ul class="live">
    		<!-- 
        	<li>
        		<a href="">
				<img src="http://my.mumway.com/pic">
				<div class="live_d1">
				<P class="live_p1"><span class="live_p1_s1"></span>类型<span class="live_p1_s2">专用直播间</span></P>
				<P class="live_p2"><span>主题：</span>标题</P>
				<P class="live_p3"><span class="live_p3_s1">2017-10-10 13:00 - 15:00</span></P>
				</div>
            	</a>
			</li>
			 -->
			
        </ul>
        <script type="text/javascript">
	        var page = 0;//分页
	        toufen();
	    	//投票
	    	function toufen(){
	    		var ul = '__URL__/jy_zhibo/page/'+page;
	    		$.get(ul,function(e){
	    			$(".live").append(e);
	    		});
	    		page++;
	    	}
        </script>
        <P id="geng" style="font-size:26px; text-align:center; line-height:80px; color:#666;" onclick="toufen()">点击查看更多</P>
    </section>
	<footer>
        <ul>
            <li class="current"><a href="__URL__/jy_zhibo?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
            <li><a href="__ROOT__/index.php/ke/wode/openid/<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
            <div class="clear"></div>
        </ul>
    </footer>
   <!--  <P class="dhzx" style="position:fixed; right:0; top:200px; z-index:9999;"><a href="tel:15001328927"><img style="width:68px; height:210px;" src="/Public/ke/img/zixun2.png" ></a></P> -->
</body>
</html>