<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
<title>好孕妈妈</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/jinxiu.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/broad.css">
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
		//隐藏所有非基础按钮接口
		wx.hideAllNonBaseMenuItem();
		
	  });
</script>
<style>
	.yh2{ position:fixed; z-index:9999; background:rgba(0,0,0,0.5); top:0; left:0; right:0; bottom:0;}
	.yh2_d{ width:498px; margin:15% auto 0; overflow:hidden; position:relative;}
	.yh2_d_img{ width:498px; height:467px;}
	.yh2_d_d{ width:498px; height:346px; background:url(img/z5_05.png) no-repeat center; overflow:hidden;}
	.yh2_d_d_p1{ text-align:center; padding-top:55px;}
	.yh2_d_d_p1 img{ width:385px; height:70px; }
	.yh2_d_d_p2{ font-size:28px; color:#464646; line-height:60px; text-align:center; padding-top:40px;}
	.yh2_d_d_p3{ font-size:28px; color:#464646; line-height:40px; text-align:center; }
	.yh2_p{ position:absolute; right:15px; top:20px; width:25px; height:22px; }		
	.zhibo_tab_d1 img{ width:100%;}
	.list_ul_a22 {float: right;}
	
	.jia_ks_p1{text-align:center; font-size:36px; color:#292828; padding:70px 0 30px;}
	.jia_ks_p2{text-align:center; font-size:30px; color:#404040; line-height:40px;}
	.jia_ks_ul{ padding:70px 20px 0; overflow:hidden;}
	.jia_ks_ul li{ width:50%; float:left;}
	.jia_ks_ul li a{ width:100%; height:100%; display:inline-block;}
	.jia_ks_ul_p1{ display:inline-block; width:160px; height:160px; background:#ffedf4; margin:0 70px; border-radius:50%; }
	.jia_ks_ul_p3{ background:#e4e2fa;}
	.jia_ks_ul_p1 span{ display:inline-block; width:110px; height:110px; border-radius:50%; margin:25px; background:#d35286; text-align:center;}
	.jia_ks_ul_p3 span{ background:#5651b7;}
	.jia_ks_ul_p1 span img{ padding-top:30px;}
	.jia_ks_ul_p2{ font-size:24px; color:#e4b3c7; line-height:80px; text-align:center;}
</style>
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

<body style="background-color: #f3f3f3; margin:0; ">
<section class="section" style="top:0; margin-bottom:120px;">
<div class="zhibo11">
    <div class="broadcast" id="myimg" style="height:auto;">
        <img src="//admin.mumway.com/<?php echo ($pd["pic"]); ?>" style="height:320px;">
        <img style="width:130px; height:130px; position:absolute; left:50%; top:100px; margin-left:-65px;" src="__PUBLIC__/ke/img/bo.png" onClick="pay()">
    </div>
    <div class="broadcast" id="myvidoe" style="height:auto;display:none;"></div>
</div>
<div class="zhibo_tab">
    <ul class="synopsis">
        <li class="current" style="width:100%;">标题</li>
    </ul>
    <div class="zhibo_tab1 current">
        <div class="broadcast_p2" style="padding-bottom:15px;">
            <p class="broadcast_s1"><?php echo ($pd["title"]); ?></p>
        </div>
        <!-- 
        <div class="zhibo_tab_d1 ">
        	<P class="zhibo_tab_p1">导师简介</P>
        	<?php if(is_array($pd["teachers"])): foreach($pd["teachers"] as $key=>$t): ?><h4><?php echo ($t["name"]); ?></h4>
        	<?php echo (nl2br($t["intro"])); ; endforeach; endif; ?>
        </div>
         -->
        <div class="zhibo_tab_d1 ">
        	<P class="zhibo_tab_p1">课程介绍</P>
        	<?php echo (nl2br($pd["introduction"])); ?>
        </div>
    </div>
    
</div>
</section>
<!-- 
<footer class="broadcast_foot">
    <P class="broadcast_foot_p">
    <a style="background:none; color:#565656; font-size:22px; line-height:40px; padding-top:12px;" href="tel:18614078479"><img src="/Public/ke/img/dianhua11.png"><br>电话咨询</a>
    <a style="background:none; color:#565656; font-size:22px; line-height:40px; padding-top:12px;" href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
    <a style="background:#5651b7; width:40%; padding:10px 0; line-height:38px;" href="__URL__/zhifu/cid/<?php echo ($pd["id"]); ?>/openid/<?php echo ($openid); ?>"><i class="i2" style="font-style:normal; color:#fff; font-size:26px;"><?php echo ($pd["price"]); ?>元/专辑</i><br>立即抢购</a>
    </P>
</footer>
 -->
</body>
<script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	var BOUGHT = <?php echo ($pd["BOUGHT"]); ?>;
	function pay(){
		if(BOUGHT){
			$("#myimg").hide();
			$("#myvidoe").show();
		}else{
			alert("您没有购买此视频!");
		}
	}
	
	$(function(){
		//加载视频
		if(BOUGHT){
			var video = '<?php echo ($pd["url"]); ?>';
			if(video.indexOf("live.ceecloud.cn") > -1){
				//云见直播
				document.getElementById("myvidoe").innerHTML="<iframe style='margin-left:-8px; margin-top:-8px;' width='656px' height='366px' id='iframeZhibo' name='iframeZhibo' src='<?php echo ($pd["url"]); ?>' frameborder='0' scrolling='no' webkitallowfullscreen='' mozallowfullscreen='' allowfullscreen=''></iframe>";
			}else if(video.indexOf("bokecc.com") > -1){
				//CC视频
				var dom = document.getElementById("myvidoe");
				var sc = document.createElement("script");
				sc.setAttribute("type", "text/javascript");
				sc.setAttribute("src", video.replace('height=480', 'height=320'));
				dom.innerHTML="";
				dom.appendChild(sc);
			}else{
				//资源播放
				document.getElementById("myvidoe").innerHTML='<video src="<?php echo ($pd["url"]); ?>" controls="controls" height="320px" width="640px">您的浏览器不支持播放</video>';
			}
		}
		if(location.href.indexOf("/vid/") > -1){
			$('.synopsis li').eq(1).addClass('current').siblings().removeClass('current')
			$('.zhibo_tab1').eq(1).addClass('current').siblings().removeClass('current')
		}
		$('.synopsis li').click(function(e) {
			$(this).addClass('current').siblings().removeClass('current')
			$('.zhibo_tab1').eq($(this).index()).addClass('current').siblings().removeClass('current')
		});
		$('.broadcast_ul li:last').css('borderBottom','none');
		$('#wrapper').css('margin','none');
		$('object').attr('object-fit','fill');
		$('object').attr('object-position','top');
		
		function ismobile(test){
			var u = navigator.userAgent, app = navigator.appVersion;
			if(/AppleWebKit.*Mobile/i.test(navigator.userAgent) || (/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/.test(navigator.userAgent))){
			 	if(window.location.href.indexOf("?mobile")<0){
				  	try{
				   		if(/iPhone|mac|iPod|iPad/i.test(navigator.userAgent)){
							return '0';
					    }else{
							return '1';
					    }
				     }catch(e){}
				 }
			}
			
		};
		var pla=ismobile(0);
		if(pla==0){
			$('#contents').bind('focus',function(){  
				$('.broadcast_foot').css('position','static');  
				$('section').css('marginBottom','0');
			}).bind('blur',function(){  
				$('.broadcast_foot').css({'position':'fixed','bottom':'0'});  
				$('section').css('marginBottom','120px');
				$('body').scrollTop(0,100);
			});
		}
	
	});
	//答题
	function dati(){
		if(BOUGHT){
			
		}else{
			alert("您没有购买此视频!");
			return false;
		}
	}

</script>
</html>