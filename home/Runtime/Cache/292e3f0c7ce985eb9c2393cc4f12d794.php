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
				desc: '早学习早就业，早拿证早涨薪！ 您与身边高工资的姐妹就差这一点！', // 分享描述
				link: link, // 分享链接
				imgUrl: 'http://my.mumway.com/<?php echo ($pd["tpic"]); ?>', // 分享图标
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
	.broadcast_foot_p1 a{ float:left; font-size:22px; color:#565656; line-height:40px; padding-top:12px; text-align:center; width:50%; height:96px; border-right:1px solid #d6d6d6; }
</style>
<style type="text/css">
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

<style type="text/css">
	.assignment1_p1{ font-size:26px; text-align:center; color:#373737; line-height:74px; border-bottom:1px solid #b2b2b2;}
	.assignment2_out{ position:fixed; top:0; left:0; bottom:0; right:0; z-index:30; background:rgba(0,0,0,0.4); display:none;  }
  	.assignment2_d4{ width:480px; background:#f8f8f8; border-radius:11px; overflow:hidden; margin:40% auto 0;}
  	.assignment2_p22{ font-size:26px; text-align:left; color:#b2b2b2; line-height:40px; padding:30px 40px; }
	.assignment2_p4{ overflow:hidden; text-align:center;}
	.assignment2_p4 a{ display:inline-block; width:50%; font-size:24px; line-height:80px; border:1px solid #b2b2b2; text-align:center;}
	.assignment2_p4_a1{ color:#5b5b5b;}
	.assignment2_p4_a2{ color:#34316e;}
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
    <div class="broadcast" id="myvidoe" style="height:320px;">
        <img src="http://my.mumway.com/<?php echo ($pd["pic"]); ?>" style="height:320px;">
    </div>
</div>
<div class="zhibo_tab">
    <ul class="synopsis">
        <li class="current" style="width:50%;" >简介</li>
        <li style="width:50%;" >章节</li>
    </ul>
    
    <!---------------------------------------简介-------------------------------------------->
    <div class="zhibo_tab1 current">
        <div class="broadcast_p2" style="padding-bottom:15px;">
            <p class="broadcast_s1"><?php echo ($pd["title"]); ?></p>
            <P class="broadcast_s2">已有<span><?php echo ($pd["cishu"]); ?></span>个同学学过</P>
            <P class="broadcast_s3">
            <?php if(is_array($pd["wlist"])): foreach($pd["wlist"] as $key=>$w): ?><img src="<?php echo ($w["headimgurl"]); ?>"><?php endforeach; endif; ?>
            </P>
        </div>
        <div class="zhibo_tab_d1 ">
        	<P class="zhibo_tab_p1">导师简介</P>
        	<?php echo ($pd["teacher"]); ?>
        </div>
        <div class="zhibo_tab_d1 ">
        	<P class="zhibo_tab_p1">课程介绍</P>
        	<?php echo ($pd["content"]); ?>
        </div>
    </div>
    <!---------------------------------------章节-------------------------------------------->
    <div class="zhibo_tab1">
        <?php if(is_array($pd["classList"])): foreach($pd["classList"] as $key=>$tt): ?><div class="list">
            	<P class="list_p1"><?php echo ($tt["title"]); ?></P>
                <ul class="list_ul">
                <?php if(is_array($tt["video"])): foreach($tt["video"] as $key=>$t): ; if(($t["jine"] == 0)): ?><li><a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a><a class="list_ul_a2" href="__URL__/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/vid/<?php echo ($t["id"]); ?>/openid/<?php echo ($openid); ?>" style="color: red;">试看</a></li>
	                <?php else: ?> 
	                    <li><a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a><a class="list_ul_a2" href="__URL__/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/vid/<?php echo ($t["id"]); ?>/openid/<?php echo ($openid); ?>" >播放</a></li><?php endif; ; endforeach; endif; ?>
                </ul>
            </div><?php endforeach; endif; ?>
     </div>
    
</div>
</section>

<!----------------------考试弹框------------------------------>
<div class="assignment2_out">
	<div class="assignment2_d4">
    	<P class="assignment1_p1">在线考证</P>
        <P class="assignment2_p22">考试科目：<?php echo ($pd["title"]); ?><br>考试标准：30分钟，30题<br>合格标准：满分100分，85分及格</P>
        <P class="assignment2_p4"><a class="assignment2_p4_a1" onclick="$('.assignment2_out').hide();">取消</a><a class="assignment2_p4_a2" href="__URL__/dati/cid/<?php echo ($pd["id"]); ?>/openid/<?php echo ($openid); ?>">开始考试</a></P>
    </div>
</div>

<footer class="broadcast_foot">
<P class="broadcast_foot_p1">
<?php if(($pd["type"] == '取证课程')): ; if($pd["BOUGHT"] == 1): ?><a style="width:33.3%;" href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
	    <a style="width:33.3%;" id="istest"><img src="/Public/ke/img/btn_kaozh.png"><br>在线考试</a>
	    <a id="zhifu" style="width:33.3%;background:#5651b7; color:#fff; line-height:70px;">开始学习</a>
    <?php else: ?>  
    	<a href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
    	<a id="zhifu" style="background:#5651b7; padding:10px 0; color:#fff; font-size:30px;"><i style="font-style:normal; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i><br>立即抢购</a><?php endif; ?>
<?php else: ?>    
    <a href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
    <?php if($pd["BOUGHT"] == 1): ?><a id="zhifu" style="background:#5651b7; color:#fff; line-height:70px;">开始学习</a>
    <?php else: ?>  
    	<a id="zhifu" style="background:#5651b7; padding:10px 0; color:#fff; font-size:30px;"><i style="font-style:normal; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i><br>立即抢购</a><?php endif; ; endif; ?>
</P>
</footer>

</body>
<script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	var BOUGHT = <?php echo ($pd["BOUGHT"]); ?>;
	$(function(){
		//判断浏览器
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
		//判断是否显示视频列表
		if(location.href.indexOf("/vid/") > -1){
			$('.synopsis li').eq(1).addClass('current').siblings().removeClass('current')
			$('.zhibo_tab1').eq(1).addClass('current').siblings().removeClass('current')
		}
		$('.vedio1_p2 span').click(function(e) {
			$(this).addClass('current').siblings().removeClass('current')
			$('.vedio_con1').eq($(this).index()).addClass('current').siblings().removeClass('current')
		});
		$('.broadcast_ul li:last').css('borderBottom','none');
		$('#wrapper').css('margin','none');
		$('object').attr('object-fit','fill');
		$('object').attr('object-position','top');
		$('.synopsis li').click(function(e) {
			$(this).addClass('current').siblings().removeClass('current')
			$('.zhibo_tab1').eq($(this).index()).addClass('current').siblings().removeClass('current')
		});
		$("#zhifu").click(function(e) {
			if(BOUGHT){
				$('.synopsis li').eq(1).addClass('current').siblings().removeClass('current')
				$('.zhibo_tab1').eq(1).addClass('current').siblings().removeClass('current')
			}else{
				location.href="__URL__/zhifu?classid=<?php echo ($pd["id"]); ?>&openid=<?php echo ($openid); ?>";
			}
		});
		//加载视频
		if(BOUGHT && location.href.indexOf("/vid/") > -1){
			var vod = '<?php echo ($pd["vurl"]); ?>';
			if(vod.indexOf("live.ceecloud.cn") < 0){
				//cc视频
				var dom = document.getElementById("myvidoe");
				var sc = document.createElement("script");
				sc.setAttribute("type","text/javascript");
				sc.setAttribute("src",vod+"&width=640&height=320");
				dom.innerHTML="";
				dom.appendChild(sc);
			}else{
				//云见直播
				document.getElementById("myvidoe").innerHTML="<iframe style='margin-left:-8px; margin-top:-8px;' width='656px' height='366px' src='<?php echo ($pd["vurl"]); ?>' frameborder='0' scrolling='no' webkitallowfullscreen='' mozallowfullscreen='' allowfullscreen=''></iframe>";
			}
		}else{
			//播放按钮，如果没有购买就显示播放按钮
			if(location.href.indexOf("/vid/") > -1){
				$("#myvidoe").append('<img id="payBut" style="width:130px; height:130px; position:absolute; left:50%; top:100px; margin-left:-65px;" src="__PUBLIC__/ke/img/bo.png">');
			}
		}
		//播放按钮
		$('#payBut').click(function(e) {
			if(BOUGHT){
				$("#myvidoe").show();
			}else{
				alert("您没有购买此视频!");
			}
		});
		//在线考试按钮
		$("#istest").click(function(e) {
			if('<?php echo ($pd["istest"]); ?>' == 1){
				$('.assignment2_out').show();
			}else{
				alert("您还没有学完课程，快去学习吧！");
			}
		});
		
	});
	
</script>
</html>