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
			jsApiList: ['hideMenuItems','onMenuShareAppMessage','onMenuShareTimeline'
			  // 所有要调用的 API 都要加到这个列表中
			]
		  });
		  wx.ready(function () {
			//分享当前连接替换自己openid，防止别人使用该openid
			  var link = location.href.replace("openid", "opens");
			// 在这里调用 API
			var mess = {
					// title: '好孕妈妈在线考证直降600元！', // 分享标题
					title: '好孕妈妈在线考证抢购中！', // 分享标题
					desc: '早学习早就业，早拿证早涨薪！您与身边高工资的姐妹就差这一点！', // 分享描述
					link: 'http://m.mumway.com/index.php/kec/quzheng', // 分享链接
					imgUrl: 'http://m.mumway.com/20190319161833.png', // 分享图标
					type: 'link', // 分享类型,music、video或link，不填默认为link
					dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
					success: function () { 
						// 用户确认分享后执行的回调函数
					},
					cancel: function () { 
						// 用户取消分享后执行的回调函数
					}
				}
			//发送朋友
			wx.onMenuShareAppMessage(mess);
			//朋友圈
			wx.onMenuShareTimeline(mess);
			//批量隐藏功能按钮接口
			wx.hideMenuItems({
				menuList: [
					'menuItem:share:qq','menuItem:share:weiboApp','menuItem:favorite','menuItem:share:QZone',
					"menuItem:originPage","menuItem:readMode","menuItem:openWithQQBrowser","menuItem:copyUrl",
					"menuItem:openWithSafari","menuItem:share:email","menuItem:share:brand"
				] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
			});
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
    </script>
    
</head>

<body style="background-color: #f3f3f3;">
    <header id="header">
        <div id="choose">
        	<ul class="choose_con">
                <li class="current"><a href="__URL__/quzheng/openid/<?php echo ($openid); ?>">在线考证</a></li>
                <li><a href="__URL__/mianshou/openid/<?php echo ($openid); ?>">面授特训</a></li>
            </ul>
        </div>
    </header>

	<div class="bgg"></div>
    <section class="section">
        <ul class="list-item">
        	<?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
	             <a href="__URL__/quzhengxinxi/id/<?php echo ($li["id"]); ?>/openid/<?php echo ($openid); ?>" class="a">
	                  <img src="http://my.mumway.com/<?php echo ($li["tpic"]); ?>" class="img" />
	                  <div class="info">
	                       <h3><?php echo ($li["title"]); ?></h3>
	                       <p><?php echo ($li["target"]); ?></p>
	                       <span class="new-price"><s style="color: #a6a6a6;font-size: 20px;">￥<?php echo ($li["jiage"]); ?></s> ￥<?php echo ($li["jine"]); ?>元</span>
	                       <span class="button"><?php echo ($li["cishu"]); ?>人已购买</span>
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