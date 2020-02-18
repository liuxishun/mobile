<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />
	<title>好孕妈妈</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/jinxiu.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/broad.css">
	<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
	<script src="https://cdn.bootcss.com/clipboard.js/2.0.4/clipboard.js"></script>

	<?php
 require_once "Public/wx/jssdk.php"; $jssdk = new JSSDK("wxcd720e416bcaaa0d", "e5ebc693eeb62f3ab03253297a5a41e7"); $signPackage = $jssdk->GetSignPackage(); ?>
	<script type="text/javascript">
		//分享当前连接替换自己openid，防止别人使用该openid
		// var link = location.href.replace("openid", "opens");
		var link = "http://m.mumway.com/index.php/class/quzhengxinxi/id/<?php echo ($pd["id"]); ?>";

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



		.list_ul2 li{
			background-image: none;
		}
		.tline{
			height: 80px;
		}
		.words{
			width: 100%;
			border-radius: 6px;
			padding:8px;
			background-color: #f1f1f1;
			font-size: 24px;
			line-height: 30px;
			color: #666;

		}
		.words img{
			width: 100%;
			margin: 8px 0;
		}
		.fiexCn2,
		.fiexCn{
			position: fixed;
			top:0;
			left: 0;
			right: 0;
			bottom: 0;
			background-color: rgba(0,0,0,0.6);
			padding-top:200px;
			z-index: 9999;
			display: none;
		}
		.fiexCn .contentf{
			width:500px ;
			padding: 30px 20px;
			border-radius: 10px;
			margin:0 auto;
			background-color: #fff;
			position: relative;

		}
		.fiexCn .tit{
			font-size: 30px;
			text-align: center;
			color: #333;
			font-weight: bold;
		}
		.fiexCn .decs{
			font-size: 28px;
			text-align: center;
			color: #666;
			margin:10px 0;

		}

		.fiexCn .wornd{
			margin-top: 10px;
			background-color: #f1f1f1;
			padding: 18px;
			font-size: 26px;
			line-height: 30px;
			color: #666;
			word-wrap:break-word;
			width: 100%;
			height: 200px;
		}
		.fiexCn .btn{
			width: 240px;
			height: 60px;
			line-height: 60px;
			margin: 20px auto 0;
			font-size: 26px;
			text-align: center;
			border: 1px solid #e1e1e1;
			border-radius: 4px;
		}

		.fiexCn .btnCn{
			width: 100%;
			border-top:1px solid #e1e1e1;
			height: 70px;
			position: absolute;
			bottom:0;
			left: 0;
			right: 0;
		}
		.fiexCn .btnCn span{
			width: 50%;
			display: block;
			float: left;
			text-align: center;
			line-height: 69px;
			color: #666;
			font-size: 24px;

		}
		.fiexCn .btnCn span.confirm{
			
			border-left: 1px solid #e1e1e1;
		}

		.nogoumai{
			text-align: center;
			line-height: 300px;
			font-size: 26px;
			color: #666;
			display: none;
		}

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
				<li class="current">简介</li>
				<li>章节</li>
				<li>资料</li>
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
							<?php if(is_array($tt["video"])): foreach($tt["video"] as $key=>$t): ; if(($t["jine"] == 0)): ?><li>
										<a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a>
										<a class="list_ul_a2" href="__URL__/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/vid/<?php echo ($t["id"]); ?>/openid/<?php echo ($openid); ?>" style="color: red;">试看</a>

									</li>
									<?php else: ?>
									<?php if(($t["notShikan"] == 1)): ?><li>
											<a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a>

											<a class="list_ul_a2 shareS" style="width: 50px;height: 80px">
												<svg t="1581410987817" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1959" width="26" height="26"><path d="M204.8 409.6a51.2 51.2 0 0 0-51.2 51.2v409.6a51.2 51.2 0 0 0 51.2 51.2h614.4a51.2 51.2 0 0 0 51.2-51.2V460.8a51.2 51.2 0 0 0-51.2-51.2H204.8z m0-51.2h614.4a102.4 102.4 0 0 1 102.4 102.4v409.6a102.4 102.4 0 0 1-102.4 102.4H204.8a102.4 102.4 0 0 1-102.4-102.4V460.8a102.4 102.4 0 0 1 102.4-102.4z" p-id="1960"></path><path d="M409.6 588.8h256a25.6 25.6 0 1 0 0-51.2H409.6a25.6 25.6 0 1 0 0 51.2zM768 358.4V307.2A256 256 0 0 0 256 307.2v51.2h512z m-256-358.4a307.2 307.2 0 0 1 307.2 307.2v102.4H204.8V307.2a307.2 307.2 0 0 1 307.2-307.2z" p-id="1961"></path></svg>
											</a>

										</li>

										<?php else: ?>
										<li>
											<a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a>
											<?php if(($t["check"] == 0)): ?><a class="list_ul_a2" href="__URL__/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/vid/<?php echo ($t["id"]); ?>/openid/<?php echo ($openid); ?>">播放</a>
											<?php else: ?>
												<a class="list_ul_a2" href="__URL__/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/vid/<?php echo ($t["id"]); ?>/openid/<?php echo ($openid); ?>"  style="color:purple">播放</a><?php endif; ?>
										</li><?php endif; ; endif; ; endforeach; endif; ?>
						</ul>
					</div><?php endforeach; endif; ?>
			</div>

			<!---------------------------------------资料-------------------------------------------->

			<div class="zhibo_tab1">

				<div class="nogoumai">您未购买此课程，无法查看课程资料</div>
				<div class="list yigoumaiziliao">
					<?php if(is_array($pd["classList"])): foreach($pd["classList"] as $key=>$tt): ?><P class="list_p1"><?php echo ($tt["title"]); ?></P>
						<ul class="list_ul list_ul2">
							<?php if(is_array($tt["video"])): foreach($tt["video"] as $key=>$t): ?><li>
									<div class="tline">
										<a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a><a class="list_ul_a2 open">查看</a>

									</div>
									<div class="words">
										<?php echo ($t["jianjie"]); ?>
									</div>
								</li><?php endforeach; endif; ?>
						</ul><?php endforeach; endif; ?>
					<!--<P class="list_p1">第一章</P>-->
					<!--<ul class="list_ul list_ul2">-->


						<!--<li>-->
							<!--<div class="tline">-->
								<!--<a class="list_ul_a1" href="javascript:;">课程名称11111</a><a class="list_ul_a2 open">展开</a>-->

								<!--</div>-->
								<!--<div class="words">-->
									<!--<p>123123123asjkbdabsdhadhjasgda安徽大大大家打算大家啊大概阿萨德碍事打的</p>-->
									<!--<img src="http://t8.baidu.com/it/u=1484500186,1503043093&fm=79&app=86&f=JPEG?w=1280&h=853">-->
									<!--</div>-->
									<!--</li>-->

									<!--</ul>-->
								</div>
							</div>

						</div>
					</section>


					<!----------------------分享弹框------------------------------>

					<div class="fiexCn fiexCn1">
						<div class="contentf">
							<div class="tit">分享链接已生成</div>
							<textarea readonly class="wornd" id="wornd">收到好孕分享的【1231231231】课程，快去一起试学吧！http://wewewe.wewe.wewe</textarea>
							<div class="btn clipboardBtn" data-clipboard-target="#wornd" data-clipboard-action="copy" onclick="">点击复制</div>
						</div>
					</div>

					<div class="fiexCn fiexCn2">
						<div class="contentf" style="padding: 30px 20px 90px;">
							<?php if($pd["sumber"] == 0): ?><div class="tit">您还没有邀请姐妹</div>
								<div class="decs s">邀请<span style="color: #F54ABC;"><?php echo ($pd["number"]); ?></span>个姐妹即可免费学习此课程</div>

								<?php else: ?>
								<div class="tit">您已邀请<span style="color: #F54ABC;"><?php echo ($pd["sumber"]); ?></span>个姐妹</div>
								<div class="decs s">再邀请<span style="color: #F54ABC;"><?php echo ($pd["number"]); ?></span>个姐妹即可免费学习此课程</div><?php endif; ?>

							<div class="imglist" style="width: 100%; padding:10px 0; text-align: center;"></div>
							<div class="decs s" style="color: #ccc; font-size: 24px;"><span style="color: #F54ABC;">*</span>被邀请人绑定手机后即视为邀请成功</div>

							<div class="btnCn">
								<span class="close confirmClose" style="color: #666;">取消</span>
								<span class="confirm goShear" style="color: #5651B6;">立即邀请</span>
							</div>
						</div>
					</div>
					<div class="fiexCn fiexCn3">
						<div class="contentf" style="padding: 30px 20px 90px;">
							<div class="tit">复制成功</div>
							<div class="btnCn">
								<span class="confirm confirmClose" style="width: 100%">确定</span>
							</div>
						</div>
					</div>
					<div class="fiexCn fiexCn4">
						<div class="contentf" style="padding: 30px 20px 90px;">
							<div class="tit">恭喜您</div>
							<div class="decs">已成功邀请<span style="color: #F54ABC;"><?php echo ($pd["sumber"]); ?></span>个姐妹，快去学习吧！</div>
							<div class="imglist2" style="width: 100%; padding:10px 0; text-align: center;"></div>
							<div class="btnCn">
								<span class="close confirmClose" style="color: #666;">取消</span>
								<span class="confirm confirmClose" style="color:#5651B6">开始学习</span>
							</div>
						</div>
					</div>
					<!----------------------考试弹框------------------------------>
					<div class="assignment2_out">
						<div class="assignment2_d4">
							<P class="assignment1_p1">在线考证</P>
							<P class="assignment2_p22">考试科目：<?php echo ($pd["title"]); ?><br>考试标准：60分钟，50题<br>合格标准：满分100分，85分及格</P>
							<P class="assignment2_p4"><a class="assignment2_p4_a1" onclick="$('.assignment2_out').hide();">取消</a><a class="assignment2_p4_a2" href="__URL__/dati/cid/<?php echo ($pd["id"]); ?>/openid/<?php echo ($openid); ?>">开始考试</a></P>
						</div>
					</div>



					<footer class="broadcast_foot">

						<P class="broadcast_foot_p1 broadcast_foot_p11" style="display: none;">
							<?php if(($pd["type"] == '取证课程')): ; if($pd["BOUGHT"] == 1): ?><a style="width:20%;" href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
									<a style="width:20%;" class="share3">
										<svg t="1581413402033" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2712" width="20" height="20"><path d="M799.7 639.3c-50.6 0-95.2 24-124.5 60.7L377.8 521.5c3.7-13.5 6.3-27.4 6.3-42.1 0-14.7-2.6-28.6-6.3-42.1L675.2 259c29.3 36.7 73.9 60.7 124.5 60.7 88.3 0 159.8-71.6 159.8-159.8C959.5 71.6 887.9 0 799.7 0S639.9 71.6 639.9 159.8c0 14.7 2.6 28.6 6.3 42.1L348.8 380.3c-29.3-36.7-73.9-60.7-124.5-60.7-88.3 0-159.8 71.6-159.8 159.8 0 88.3 71.6 159.8 159.8 159.8 50.6 0 95.2-24 124.5-60.7L646.2 757c-3.7 13.5-6.3 27.4-6.3 42.1 0 88.3 71.6 159.8 159.8 159.8s159.8-71.6 159.8-159.8c0-88.3-71.6-159.8-159.8-159.8z m0-575.4c52.9 0 95.9 43 95.9 95.9s-43 95.9-95.9 95.9-95.9-43-95.9-95.9 43-95.9 95.9-95.9zM224.3 575.4c-52.9 0-95.9-43-95.9-95.9s43-95.9 95.9-95.9 95.9 43 95.9 95.9-43 95.9-95.9 95.9zM799.7 895c-52.9 0-95.9-43-95.9-95.9 0-52.9 43-95.9 95.9-95.9s95.9 43 95.9 95.9c0 52.9-43 95.9-95.9 95.9z" p-id="2713"></path></svg>
										<br>分享
									</a>
									<a style="width:20%;" id="istest"><img src="/Public/ke/img/btn_kaozh.png"><br>在线考试</a>
									<a class="zhifu" style="width:40%;background:#5651b7; color:#fff; line-height:70px;">开始学习</a>
									<?php else: ?>
									<a href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
									<a class="zhifu" class="BOUGHT_0" style="background:#5651b7; padding:10px 0; color:#fff; font-size:30px;">
										<i style="font-style:normal; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i>
										<br>
										立即抢购
									</a><?php endif; ?>
								<?php else: ?>
								<a href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
								<?php if($pd["BOUGHT"] == 1): ?><a class="zhifu" style="background:#5651b7; color:#fff; line-height:70px;">开始学习</a>
									<?php else: ?>
									<a class="zhifu" style="background:#5651b7; padding:10px 0; color:#fff; font-size:30px;"><i style="font-style:normal; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i><br>立即抢购</a><?php endif; ; endif; ?>
						</P>
						<P class="broadcast_foot_p1 broadcast_foot_p12" style="display: none;">
							<?php if(($pd["type"] == '取证课程')): ; if($pd["BOUGHT"] == 1): ?><a class="share3 BOUGHT_1" style="line-height:70px;">
										分享
									</a>
									<a class="zhifu BOUGHT_1" style="background:#5651b7; color:#fff; line-height:70px;">开始学习</a>
									<?php else: ?>
									<a class="shareNum BOUGHT_0" >
										分享给<?php echo ($pd["invitemincount"]); ?>个姐妹<br>免费学习
									</a>
									<a class="BOUGHT_0 zhifu" style="background:#5651b7; padding:10px 0; color:#fff; font-size:30px;">
										<i style="font-style:normal; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i>
										<br>
										立即抢购
									</a><?php endif; ?>
								<?php else: ?>

								<?php if($pd["BOUGHT"] == 1): ?><a class="share3 BOUGHT_1" style="line-height:70px;">
										分享
									</a>
									<a class="zhifu BOUGHT_1" style="background:#5651b7; color:#fff; line-height:70px;">开始学习</a>
									<?php else: ?>
									<a class="shareNum BOUGHT_0" >
										分享给<?php echo ($pd["invitemincount"]); ?>个姐妹<br>免费学习
									</a>
									<a class="BOUGHT_0 zhifu" style="background:#5651b7; padding:10px 0; color:#fff; font-size:30px;">
										<i style="font-style:normal; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i>
										<br>
										立即抢购
									</a><?php endif; ; endif; ?>
						</P>

					</footer>





				</body>
				<script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
				<script type="text/javascript">

					var BOUGHT = <?php echo ($pd["BOUGHT"]); ?>;
					var imgUrl = '<?php echo ($pd["imgUrl"]); ?>';
					var invitemincount = <?php echo ($pd["invitemincount"]); ?>;
					var adminId = <?php echo ($adminId); ?>;
					var Ynum = <?php echo ($pd["sumber"]); ?>;
					var isSuccess = <?php echo ($pd["is_success"]); ?>;


					$(function(){

						//判断 是否 显示分享成功
						if (isSuccess) {
							$('.fiexCn4').show()
						}


						if (invitemincount == 0) {
							$('.broadcast_foot_p11').show()
						}else{
							$('.broadcast_foot_p12').show()
							let yimg = ''
							if (imgUrl) {
								yimg = imgUrl.split(',').map(item=>(`<img  style="width: 80px;height: 80px; margin:0 4px; border-radius:50%; display: inline-block;" src="${item}" alt="${item}">`)).join() 

							}

							let nimg = new Array((parseInt(invitemincount)-parseInt(Ynum)) || 0).join(',').split(',').map(item=>('<div style="width: 80px;height: 80px; margin:0 4px; border-radius:50%; display: inline-block;font-size:30px;color:#ccc; line-height: 78px;text-align: center; background-color: #F3F3F3;">?</div>')).join('')
							
							$('.imglist').html( yimg+nimg)
							$('.imglist2').html(yimg)

						}




		// 判断是否购买课程
		if (BOUGHT) {
			$('.yigoumaiziliao').show();
			$('.nogoumai').hide();
		}else{
			$('.yigoumaiziliao').hide();
			$('.nogoumai').show();

		}


		// 资料展开事件

		$('.list_ul2').on('click', '.open', function(event) {
			if ($(this).text() == '查看') {
				$(this).parents('li').css({height:'auto'})
				$(this).text('收起')
			}else{
				$(this).parents('li').css({height:'80px'})
				$(this).text('查看')
			}
		});

		// 分享事件



		$('.shareS').click(function(event) {
			/* Act on the event */
			shareNum(2)
		});

		$('.shareNum').click(function(event) {
			/* Act on the event */
			$('.fiexCn2').show()

		});
		$('.share3').click(function(event) {
			/* Act on the event */
			shareNum(3)
		});

		$('.noShear').click(function(event) {
			/* Act on the event */
			$('.fiexCn2').hide()

		});

		$('.goShear').click(function(event) {
			/* Act on the event */
			$('.fiexCn2').hide()

			shareNum(1)
		});
		$('.confirmClose').click(function(event) {
			$('.fiexCn2').hide()
			/* Act on the event */
			$('.fiexCn3').hide()
			$('.fiexCn4').hide()

		});


		function shareNum(num){
			if(invitemincount == 0){
				if(BOUGHT){
					var links = "http://m.mumway.com/index.php/class/quzhengxinxi/id/<?php echo ($pd["id"]); ?>";
				}else{
					alert("您没有购买此视频!");
					return;
				}
			}else{
				//邀请活动的链接
				if(adminId){
					var links = "http://m.mumway.com/index.php/class/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/inviteId/<?php echo ($openid); ?>/adminId/<?php echo ($adminId); ?>";
				}else{
					var links = "http://m.mumway.com/index.php/class/quzhengxinxi/id/<?php echo ($pd["id"]); ?>/inviteId/<?php echo ($openid); ?>";
				}
			}

			let shareText =  '收到好孕分享的【'+$('.broadcast_s1').text()+'】课程，快去一起试学吧！'+ links

			$('.fiexCn1').find('.wornd').text(shareText)
			$('.fiexCn1').show()
		}


		$('.contentf').click(function(event) {
			/* Act on the event */
			event.stopPropagation()
		});

		// 复制
		console.log($('.clipboardBtn'))
		$('.clipboardBtn').click(function(){
			$('#wornd').select();
			document.execCommand("Copy")
			$('.fiexCn1').hide()
			$('.clipboardBtn').text('复制成功')
			$('.fiexCn3').show()

		})
		//var clipboardN = new ClipboardJS('.clipboardBtn');
		//console.log(clipboardN)
		//clipboardN.on('success', function(e){
		//  console.log(e);
		//$('.clipboardBtn').text('复制成功')
		//alert('复制成功,快去分享给朋友吧！')
		//});
		//clipboardN.on('error', function(e){
		//  $('.clipboardBtn').text('复制失败')

		//});

		//阻止冒泡
		$('.contentf').click(function(event) {
			/* Act on the event */
			event.stopPropagation()
		});
		$('.fiexCn1').click(function(event) {
			/* Act on the event */
			$('.fiexCn1').hide();
			event.stopPropagation()

		});






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
		$(".zhifu").click(function(e) {
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
				if('<?php echo ($pd["isNum"]); ?>' == 1){
					$('.assignment2_out').show();
				}else{
					alert("今日3次考试次数已用完，\n复习一下明天您一定可以通过");
				}
			}else{
				alert("您还没有学完课程，快去学习吧！");
			}
		});

	});

</script>
</html>