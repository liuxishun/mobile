<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
if(!$_GET['openid']){ $ul = 'http://m.mumway.com/toa.php?url=http://m.mumway.com/index.php/ke/hb2'; Header("Location: $ul");die; } require_once "Public/wx/jssdk.php"; $jssdk = new JSSDK("wxcd720e416bcaaa0d", "e5ebc693eeb62f3ab03253297a5a41e7"); $signPackage = $jssdk->GetSignPackage(); ?>
<script type="text/javascript">
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: ['onMenuShareAppMessage','hideMenuItems'
		  // 所有要调用的 API 都要加到这个列表中
		]
	  });
	  wx.ready(function () {
		// 在这里调用 API
		//发送朋友
		wx.onMenuShareAppMessage({
			title: '<?php echo ($arr["nickname"]); ?>喊你领百万红包啦！', // 分享标题
			desc:'何必费力扫福字，月嫂了不起送百万元红包，呼朋唤友排队领，全场消费不设限！', // 分享描述
			link: 'http://m.mumway.com/index.php/ke/hb1?openid=<?php echo ($arr["openid"]); ?>', // 分享链接
			imgUrl: '<?php echo ($arr["headimgurl"]); ?>', // 分享图标
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
		//批量隐藏功能按钮接口
		wx.hideMenuItems({
			menuList: [
				"menuItem:copyUrl","menuItem:share:timeline",
				'menuItem:share:qq','menuItem:share:weiboApp','menuItem:favorite','menuItem:share:QZone',
				"menuItem:originPage","menuItem:readMode","menuItem:openWithQQBrowser","menuItem:openWithSafari","menuItem:share:email","menuItem:share:brand"
				
			] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
		});
		
	  });
</script>
<script src="__PUBLIC__/ke/wode/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
    $(function(){
        var H = $(window).height();
        $("body").height(H);
		$('.container_p3 img').click(function(e) {
            $('.ale').show();
        });
		$('.close11 img').click(function(e) {
            $('.ale').hide();
        });
    })

</script>
<style type="text/css">
body,div,p,input,h1,h2,h3,h4,ul,li,ol,dl,dd,dt,a,img,button{ padding:0; margin:0; border:0; list-style:none;}

body{width:640px; height:100%; overflow:hidden; background-size:cover; font-family:"微软雅黑"; }
input[type="submit"],input[type="reset"],input[type="button"],button { -webkit-appearance: none; }

::-webkit-input-placeholder { /* WebKit browsers */
　　color:#999;
　　}
　　:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
　　color:#999;
　　}
　　::-moz-placeholder { /* Mozilla Firefox 19+ */
　　color:#999;
　　}
　　:-ms-input-placeholder { /* Internet Explorer 10+ */
　　color:#999;
　　}
	.container_p3{ text-align:center; margin-top:804px;}
</style>
</head>
<body style="background:#e50112 url(__PUBLIC__/ke/wode/images/her_02.png) no-repeat top center;">
<div class="container">
    <P class="container_p3"><a href="javascript:$('.tishi').show();"><img src="__PUBLIC__/ke/wode/images/an_04.png"></a></P>
<div>
<div class="tishi" style="position:fixed; background:rgba(0,0,0,0.8); top:0; left:0; right:0; bottom:0; z-index:9999;display: none;">
    	<P class="tishi_p" style=" text-align:right; padding-right:30px;"><img src="__PUBLIC__/ke/wode/images/tishi1.png"></P>
    </div>
</body>
</html>