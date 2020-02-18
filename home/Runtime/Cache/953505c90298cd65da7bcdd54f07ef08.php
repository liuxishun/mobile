<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/aj/wode/css/style.css">
	<script type='text/javascript'>
          var _vds = _vds || [];
          window._vds = _vds;
          (function(){
            _vds.push(['setAccountId', '87405247014f637f']);
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
    <script src="__PUBLIC__/aj/wode/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$('.top_choice li:last').css('borderRight',0);
			$('.choose_con>li:last a').css('borderRight',0);
			$('.choose_con>li').click(function(e) {
                $(this).addClass('current').siblings().removeClass('current');
            });
			$('.huiyuan_d1_s1:first').click(function(e) {
                $('.huiyuan_d2_ul li:lt(1)').show().siblings().hide();
            });	
			$('.huiyuan_d1 span:eq(2)').click(function(e) {
                $('.huiyuan_d2_ul li:lt(3)').show();
				$('.huiyuan_d2_ul li:gt(2)').hide();
            });
			$('.huiyuan_d1_s1:last').click(function(e) {
                $('.huiyuan_d2_ul li').show();
            });	
			$('.huiyuan_d1 span').click(function(e) {
				$('.huiyuan_p3 span').eq($(this).index()).addClass('cur').siblings().removeClass('cur');
            });		
			
		});

    </script>
    
</head>

<body style="background-color: #f1edea; " >
    <section class="section" >
        <div class="huiyuan">
        	<p class="huiyuan_p1"><img class="huiyuan_img"  src="<?php echo ($arr["headimgurl"]); ?>" onerror="this.src='__PUBLIC__/aj/wode/img/img4.jpg'"><img class="huiyuan_img2" src="__PUBLIC__/aj/wode/img/zx_03.png"></p>
            
            <P class="huiyuan_p2"><?php echo ($arr["nickname"]); ?>ID:<?php echo ($arr["id"]); ?></P>
        </div>
        <div class="huiyuan_d2">
        	<P class="huiyuan_d2_p1"><span>高级合伙人特权</span></P>
            <ul class="huiyuan_d2_ul">
            	<li style=" border-right:1px solid #d9d9d9;"><!-- <a href="__URL__/bantequan"></a> -->
                	<p class="huiyuan_d2_ul_p1"><img src="__PUBLIC__/aj/wode/img/gj_03.png"></p>
                    <P class="huiyuan_d2_ul_p2"><span></span><br>现金奖励</P>
                </li>
            	<li><a >
                	<p class="huiyuan_d2_ul_p1"><img src="__PUBLIC__/aj/wode/img/gj_06.png"></p>
                    <P class="huiyuan_d2_ul_p2"><span></span><br>爱家基金</P>
                </a></li>
            </ul>
        </div>
    </section>
</body>
</html>