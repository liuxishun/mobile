<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
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
			$('.choose_con>li:last a').css('borderRight',0);
			$('.choose_con>li').click(function(e) {
	               $(this).addClass('current').siblings().removeClass('current');
	           });
			
		});
	
    </script>
    
</head>

<body style="background-color: #f3f3f3;">
    <!--<header id="header" class="header1">
        <div id="top1">
        	<input  class="icon" type="button" onclick="javascript:history.back(-1)">
            <P class="title_s">我的课程</P>
        </div>        
		<div id="choose">
        	<ul class="choose_con">
            	<li class="current"><a href="#">在学课程</a></li>
                <li><a href="#">学习轨迹</a></li>
                <li><a href="#">缓存课程</a></li>
            </ul>
        </div>        
        
        
    </header>-->
    <section class="section" style="margin-bottom:190px; top:10px;">
    	<?php if(empty($list)): ?><P style="font-size:26px; text-align:center; line-height:80px; color:#666;">您当前没有学习信息</P><?php endif; ?>
        <ul class="list-item">
        	<?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
            	<a href="__URL__/quzheng1/id/<?php echo ($li["id"]); ?>/openid/<?php echo ($openid); ?>" class="a">
                    <img src="http://my.mumway.com/<?php echo ($li["tpic"]); ?>" class="img" />
                    <div class="info">
                        <h3><?php echo ($li["title"]); ?></h3>
                        <p><?php echo ($li["target"]); ?></p>
                        <p class="course"><?php echo ($li["utime"]); ?></p>
                    </div>
                </a>
            </li><?php endforeach; endif; ?>
            
        </ul>
        
    </section>
    
</body>
</html>