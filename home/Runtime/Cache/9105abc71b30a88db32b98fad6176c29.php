<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/style.css">
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
require_once "Public/wx/jssdk.php"; $jssdk = new JSSDK("wxcd720e416bcaaa0d", "e5ebc693eeb62f3ab03253297a5a41e7"); $signPackage = $jssdk->GetSignPackage(); ?>
<script type="text/javascript">
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: ['hideOptionMenu'
		  // 所有要调用的 API 都要加到这个列表中
		]
	  });
	  wx.ready(function () {
		// 在这里调用 API
		//发送朋友
		wx.onMenuShareAppMessage({
			title: '', // 分享标题
			desc:'', // 分享描述
			link: '', // 分享链接
			imgUrl: '', // 分享图标
			type: 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			success: function () { 
				// 用户确认分享后执行的回调函数
				//alert("分享成功")
			},
			cancel: function () { 
				// 用户取消分享后执行的回调函数
			}
		});
		//朋友圈
		wx.onMenuShareTimeline({
			title: '', // 分享标题
			link: '', // 分享链接
			imgUrl: '', // 分享图标
			success: function () { 
				// 用户确认分享后执行的回调函数
				
			},
			cancel: function () { 
				// 用户取消分享后执行的回调函数
			}
		});
		//隐藏右上角菜单接口
		wx.hideOptionMenu();
		//显示右上角菜单接口
		//wx.showOptionMenu();
		//关闭当前网页窗口接口
		//wx.closeWindow();
		//批量隐藏功能按钮接口"menuItem:copyUrl",
		/*
		wx.hideMenuItems({
			menuList: [
				'menuItem:share:qq','menuItem:share:weiboApp','menuItem:favorite','menuItem:share:QZone',
				"menuItem:originPage","menuItem:readMode","menuItem:openWithQQBrowser","menuItem:openWithSafari","menuItem:share:email","menuItem:share:brand"
				
			] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
		});*/
		//隐藏所有非基础按钮接口
		wx.hideAllNonBaseMenuItem();
		
	  });
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
    <script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$('.top_choice li:last').css('borderRight',0);
			$('.choose_con>li:last a').css('borderRight',0);
			$('.choose_con>li').click(function(e) {
                $(this).addClass('current').siblings().removeClass('current');
            });
			
		});
		//图片错误替换
		function imgerror() {
			var img=event.srcElement; 
			img.src="http://file.mumway.com/"+img.src.replace("http://admin.mumway.com/","").replace(/\/\//g,'\/');
			img.onerror=null;// 控制不要一直跳动 
		}
    </script>
    
</head>

<body style="background-color: #f3f3f3;">
    <header id="header">
        <div id="choose">
        	<ul class="choose_con">
                <li class="current" style="width: 100%"><a href="#">在线课程</a></li>
            </ul>
        </div>
    </header>
	<div class="bgg"></div>
    <section class="section">
        <ul class="list-item">
        <?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
	                <a href="__URL__/quzhengxinxi/id/<?php echo ($li["id"]); ?>/openid/<?php echo ($openid); ?>" class="a">
	                    <img src="http://admin.mumway.com/<?php echo ($li["icon"]); ?>" onerror="imgerror()" class="img" />
	                    <div class="info">
	                        <h3><?php echo ($li["name"]); ?></h3>
	                        <p><?php echo ($li["content"]); ?></p>
	                        <span class="new-price"><s style="color: #a6a6a6;font-size: 20px;">￥399</s> ￥<?php echo ($li["price"]); ?>元</span>
	                        <span class="button"><?php echo ($li["see_mum"]); ?>人已购买</span>
	                    </div>
	                </a>
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