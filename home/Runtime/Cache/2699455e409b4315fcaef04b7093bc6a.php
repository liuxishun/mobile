<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
    <style type="text/css">
    	body,div,p,input,h1,h2,h3,h4,ul,li,ol,dl,dd,dt,a,img,button{ padding:0; margin:0; border:0; list-style:none;}
		body{ margin:0 auto;color:#626262; font-size:14px; font-family:Arial,"微软雅黑";}
		a{ color:#626262; text-decoration:none;  font-family:Arial,"微软雅黑";}
		/*支付*/
		.open{ background:#fff; border-bottom:1px solid #e8e8e8; padding:20px; border-top:1px solid #e8e8e8; overflow:hidden;}
		.open img{ width:220px; height:165px; float:left; }
		.open h3{ float:right;	text-overflow: ellipsis; overflow: hidden; font-size: 26px; line-height:36px; color: #565656;font-weight: normal; height:72px; width:360px; float:right; margin-top:10px;}
		.open1{ margin-top:10px; background:#fff; border-bottom:1px solid #e8e8e8; border-top:1px solid #e8e8e8; padding:20px; position:relative;}
		.open1 p{  font-size: 26px; line-height:50px; color: #565656;}
		.open1 .open1_p1{ font-size:22px; color:#999;}
		.open1 p span{ float:right;}
		.open1 .open1_p3{ position:absolute; bottom:-2px; right:20px; width:42px; height:22px ; overflow:hidden; line-height:24px;}
		.open1 .open1_p3 img{ width:100%; height:100%;}
		
		.open2{background:#fff; padding:0 20px; border-bottom:1px solid #e8e8e8;}
		.open2_p3{ line-height:80px;  font-size: 26px; color: #565656;}
		.open2_p3 span{ color:#f771ca; float:right;}
		
		.open3{ margin-top:10px; background:#fff;  border-top:1px solid #e8e8e8; overflow:hidden;}
		.open3 a{ font-size: 26px; line-height:80px; height:80px; color: #565656; padding:0 20px; width:100%; box-sizing:border-box; display:block; border-bottom:1px solid #e8e8e8; }
		.open3 a span{ float:left;}
		.open3 a i{ height:80px; display:inline-block; background:url(/Public/ke/img/xx_sp_16.png) no-repeat right center; float:right; font-style:normal; padding-right:35px;}
		.open_p{ padding:0 20px; margin-top:30px;}
		.open_but{ border:none; background:#5651b7; border-radius:9px; line-height:70px; font-size:26px; color:#fff; width:100%; line-height:70px; outline:none;}
    	input{ -webkit-appearance: none;}
    </style>
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
		wx.hideOptionMenu();//隐藏右上角菜单接口
		//wx.showOptionMenu();//显示右上角菜单接口
		//wx.closeWindow();//关闭当前网页窗口接口
		wx.hideAllNonBaseMenuItem();//隐藏所有非基础按钮接口
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
</head>

<body style="background-color: #f3f3f3;">
    <section class="section section1">
        <div class="open">
        	<img src="http://admin.mumway.com/<?php echo ($pd["icon"]); ?>">
            <h3><?php echo ($pd["name"]); ?></h3>
        </div>
        <!-- 
		<div class="open3">
        	<a href="__URL__/quan?openid=<?php echo ($openid); ?>&ul=<?php echo ($pd["ul"]); ?>&kcid=<?php echo ($pd["id"]); ?>"><span>使用优惠券</span><i></i></a>
        </div>
         -->
        <div class="open1">
        <!-- 
        	<P class="open1_p1">商品总价：<span>￥<?php echo ($pd["qjine"]); ?></span></P>
            <P class="open1_p1">优惠金额：<span>-￥<?php echo ($pd["quane"]); ?></span></P>
        -->
        	<P class="open1_p2">订单总价：<span>￥<?php echo (floatval($pd["price"])); ?></span></P>
            <P class="open1_p3"><img src="__PUBLIC__/ke/img/xx.jpg"></P>
            
        </div>
        <div class="open2">
        	<P class="open2_p3">实付款：<span><strong>￥<?php echo (floatval($pd["price"])); ?></strong></span></P>
        </div>
        <div class="open3">
            <a href="javascript:;"><span>支付方式</span><i>微信支付</i></a>
        </div>
        <form action="__URL__/dingdan" method="post" onsubmit="return submit()">
	       	<input type="hidden" name="id" value="<?php echo ($pd["id"]); ?>">
        	<input type="hidden" name="openid" value="<?php echo ($openid); ?>">
        	<input type="hidden" name="course_type" value="<?php echo ($type); ?>">
        	<p class="open_p"><input class="open_but" type="submit" value="开通并支付"></p>
        </form>
    </section>
</body>
    <script type="text/javascript">
		function submit(){
			
			return true;
		}

    </script>
</html>