<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>好孕妈妈</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/jinxiu.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/broad.css">
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
if(!$_GET['openid']){ $ul = 'http://m.mumway.com/zhibo.php?id='.$_GET['id']; Header("Location: $ul");die; } require_once "Public/wx/jssdk.php"; $jssdk = new JSSDK("wxcd720e416bcaaa0d", "e5ebc693eeb62f3ab03253297a5a41e7"); $signPackage = $jssdk->GetSignPackage(); ?>
<script type="text/javascript">
	wx.config({
		debug: false,
		appId: '<?php echo $signPackage["appId"];?>',
		timestamp: <?php echo $signPackage["timestamp"];?>,
		nonceStr: '<?php echo $signPackage["nonceStr"];?>',
		signature: '<?php echo $signPackage["signature"];?>',
		jsApiList: ['onMenuShareAppMessage','onMenuShareTimeline','hideMenuItems'
		  // 所有要调用的 API 都要加到这个列表中
		]
	  });
	  wx.ready(function () {
		// 在这里调用 API
		//发送朋友
		wx.onMenuShareAppMessage({
			title: '<?php echo ($shipin["fen_title"]); ?>', // 分享标题
			desc:'<?php echo ($shipin["fen_desc"]); ?>', // 分享描述
			link: 'http://m.mumway.com/zhibo.php?id=<?php echo ($shipin["id"]); ?>', // 分享链接
			imgUrl: 'http://m.mumway.com/<?php echo ($shipin["fen_pic"]); ?>', // 分享图标
			type: 'link', // 分享类型,music、video或link，不填默认为link
			dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
			success: function () { 
				// 用户确认分享后执行的回调函数
				//zhifupro(1);
				//alert("分享成功")
			},
			cancel: function () { 
				// 用户取消分享后执行的回调函数
			}
		});
		//朋友圈
		wx.onMenuShareTimeline({
			title: '<?php echo ($shipin["fen_title"]); ?>', // 分享标题
			link: 'http://m.mumway.com/zhibo.php?id=<?php echo ($shipin["id"]); ?>', // 分享链接
			imgUrl: 'http://my.mumway.com/<?php echo ($shipin["fen_pic"]); ?>', // 分享图标
			success: function () { 
				// 用户确认分享后执行的回调函数
				//zhifupro(1);
				
			},
			cancel: function () { 
				// 用户取消分享后执行的回调函数
			}
		});
		//隐藏右上角菜单接口
		//wx.hideOptionMenu();
		//显示右上角菜单接口
		//wx.showOptionMenu();
		//关闭当前网页窗口接口
		//wx.closeWindow();
		//批量隐藏功能按钮接口"menuItem:copyUrl",
		
		wx.hideMenuItems({
			menuList: [
				'menuItem:share:qq','menuItem:share:weiboApp','menuItem:favorite','menuItem:share:QZone',
				"menuItem:originPage","menuItem:readMode","menuItem:openWithQQBrowser","menuItem:openWithSafari","menuItem:share:email","menuItem:share:brand"
				
			] // 要隐藏的菜单项，只能隐藏“传播类”和“保护类”按钮，所有menu项见附录3
		});
		//批量显示功能按钮接口
		/*
		wx.showMenuItems({
			menuList: [ "menuItem:share:appMessage","menuItem:share:timeline"] // 要显示的菜单项，所有menu项见附录3
		});*/
		//隐藏所有非基础按钮接口
		//wx.hideAllNonBaseMenuItem();
		//显示所有功能按钮接口
		//wx.showAllNonBaseMenuItem();
		
	  });
</script>
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
	#holder{ text-align:center;  font-size:30px; color:#fff;}
	#holder span{ margin:0 3px; font-size:26px; line-height:100px;}
	#holder .shi{ padding:10px 15px; background:rgba(0,0,0,0.4); border-radius:9px; border:1px solid #999; font-size:40px;}

</style>
	<script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript">
    	$(function(){
	    	var time2="<?php $end_time=strtotime($shipin["start_time"]); echo date("Y/m/d H:i:s",$end_time);?>";
	        //var time2="2016/08/05 18:38:00";
	        var dr1 = new Date(time2);
	        var dr=new Date();
	        var n=parseInt((dr1 - dr)/1000);
	        tick(n);
        });
        function tick(n) {
			if(n<=0){
				clearInterval(tick())
				//$("#bf_button").show();
				$(".down_time").hide();
				return;
				checkZhibo();
			}
            var tian_show=parseInt(n/86400);  <!--天数-->
            if(tian_show < 10) tian_show = "0"+tian_show;
            var tian=n%86400;  <!--天数余数-->
            var shi_show=parseInt(tian/3600); <!--小时-->
            if(shi_show < 10) shi_show = "0"+shi_show;
            var shi=tian%3600; <!--小时余数-->
            var fen_show=parseInt(shi/60);<!--分数-->
            if(fen_show < 10) fen_show = "0"+fen_show;
            var fen=shi%60;<!--分数余数-->
            //var fen=shi%1000
            //var miao_show1=fen%1000;
            var miao_show=parseInt(fen/1);<!--秒数-->
            //var miao1=shi/60;
            if(miao_show < 10) miao_show = "0"+miao_show;
            var str="<span class='shi' id='tian'>" +tian_show+"</span>" +"<span>天</span>" +"<span class='shi' id='shi'>" +shi_show+"</span>"+"<span>小时</span>"+"<span class='shi'  id='fen'>"+fen_show+"</span>"+"<span>分</span>"+"<span class='shi' id='miao'>"+miao_show+"</span>"+"<span>秒</span>";
            n--;
            document.getElementById("holder").innerHTML = str;
            setTimeout("tick("+n+")", 1000);
			var shi=$("#shi").html();
			var fen=$("#fen").html();
			var miao=$("#miao").html();
			var tian=$("#tian").html();
        }
    </script>

<script type="text/javascript">
$(function(){
	$('.broadcast_ul li:last').css('borderBottom','none');
	$('#wrapper').css('margin','none');
	$('object').attr('object-fit','fill');
	$('object').attr('object-position','top');
	$('.vedio1_p2 span').click(function(e) {
		$(this).addClass('current').siblings().removeClass('current')
		$('.vedio_con1').eq($(this).index()).addClass('current').siblings().removeClass('current')
		//链式编程及针对类的特殊化简 方法3
	});
	$('.follow_a1').click(function(e) {
		$('.ewm').show();
	});
	$('.ewm').click(function(e) {
		$('.ewm').hide();
	});
	$('.follow_i1').click(function(e) {
		$('.follow').hide();
	});
	
	$('.synopsis li').click(function(e) {
		$(this).addClass('current').siblings().removeClass('current')
		$('.zhibo_tab1').eq($(this).index()).addClass('current').siblings().removeClass('current')
		//链式编程及针对类的特殊化简 方法3
		var oo = $(this).index();
		if(oo == 1){
			$('.broadcast_foot_p').hide(); 
			$('.input_shuru').show();
		}else{
			$('.broadcast_foot_p').show(); 
			$('.input_shuru').hide();
		}
		
	});
	
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

})
</script>

</head>
<body style="background-color: #f3f3f3; margin:0; ">
<section class="section" style="top:0; margin-bottom:120px;">
<div class="zhibo11">
    <div class="broadcast" id="myimg" style="height:auto;">
        <img id="bofangImg" src="/<?php echo ($shipin["pic"]); ?>" onerror="javascript:this.src='http://my.mumway.com/<?php echo ($shipin["pic"]); ?>';" style="height:320px;">
        <img id="bf_button" style="width:130px; height:130px; position:absolute; left:50%; top:100px; margin-left:-65px;" src="__PUBLIC__/ke/img/bo.png" onClick="checkZhibo()">
        <div class="down_time" style="width:100%;height:320px; background:rgba(0,0,0,0.7); position:absolute; top:0; left:0; z-index:997; ">
            <P style=" font-size:24px; color:#fff; margin-bottom:15px; text-align:center; margin-top:110px;">距开播还有</P>
            <p id="holder" ></p>
        </div>
        <iframe style="display:none; margin-left:-8px; margin-top:-8px; " id="iframeZhibo" name="iframeZhibo" src="<?php echo ($shipin["url"]); ?>" width="656px" height="350px" frameborder="0" scrolling="no" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
        <P class="broadcast_p1">公告：
        <marquee id="gg" scrollamount=8  style="width:82%; font-size:28px; color:#fff; float:right;"> 
			<?php echo ($gglist["gonggao"]); ?>
		</marquee></P>
    </div>
</div>
<div class="zhibo_tab">
    <ul class="synopsis">
        <li style="width:50%;" class="current">简介</li>
        <li style="width:50%;" >问答</li>
    </ul>
    
    <div class="zhibo_tab1 current">
        <div class="broadcast_p2" style="padding-bottom:15px;">
            <p class="broadcast_s1"><?php echo ($shipin["title"]); ?></p>
            <P class="broadcast_s2">已有<span><?php echo 3000+$jishuqi;?></span>个同学学过</P>
            <P class="broadcast_s3">
            <?php if(is_array($wlist)): foreach($wlist as $key=>$w): ?><img src="<?php echo ($w["headimgurl"]); ?>"><?php endforeach; endif; ?>
            </P>
        </div>
        <div class="zhibo_tab_d1 ">
        	<P class="zhibo_tab_p1">导师简介</P>
        	<?php echo ($shipin["teacher"]); ?>
        </div>
        <div class="zhibo_tab_d1 ">
        	<P class="zhibo_tab_p1">课程介绍</P>
        	<?php echo ($shipin["jianjie"]); ?>
        </div>
    </div>
    
    <div class="zhibo_tab1">
        <ul class="broadcast_ul" style="  margin-top:0;" id="plUL">
        <!-- 
            <li>
                <img src="http://wx.qlogo.cn/mmopen/o5D1CH9jRUqpbXCDln81whdNic7BLpxKgrTUxpEYUAebNsAfpQqGBOXDyZePVicEMTiaaFqTs5IIUic9z7h5wf3ceQ/0">
                <div class="broadcast_ul_d1">
                    <P class="broadcast_ul_d1_p1"><span class="broadcast_ul_d1_p1_s1">白朋飞</span><span class="broadcast_ul_d1_p1_s2">2016-07-26 17:57:26</span></P>
                    <div class="qp">
                        <img class="qp_img" src="__PUBLIC__/ke/img/qp2.png">
                        <P class="broadcast_ul_d1_p2">期待</P>
                    </div>
                </div>
            </li>
            <li class="li1">
                <img src="http://wx.qlogo.cn/mmopen/SJJF45S9lVdp78ub4ZIibD6cIr4S3liaIMibO1uiaxHMvvdNFBIpJIyiaN22zbtPiaWoqF9Ddy7yDmj1Rg8ne8wUmMde1uTVibZNuFk/0">
                <div class="broadcast_ul_d1">
                    <P class="broadcast_ul_d1_p1"><span class="broadcast_ul_d1_p1_s1">孙学艳</span><span class="broadcast_ul_d1_p1_s2">2016-07-26 15:33:53</span></P>
                    <div class="qp">
                        <img class="qp_img" src="__PUBLIC__/ke/img/qp3.png">
                        <P class="broadcast_ul_d1_p2">我喜欢这种类型的直播</P>
                    </div>
                </div>
            </li>
            <li class="li2">
                <img src="http://wx.qlogo.cn/mmopen/SJJF45S9lVegbRXZGglw7TU4qajJ5DAQaUbqSXwpA0NFiaxl2XmjxqicaUDzapd8FHHwOlc4mYLTXkvJTokzW6ZmDrKLIzCPE6/0">
                <div class="broadcast_ul_d1">
                    <P class="broadcast_ul_d1_p1"><span class="broadcast_ul_d1_p1_s1">刘伟</span><span class="broadcast_ul_d1_p1_s2">2016-07-25 09:50:28</span></P>
                    <div class="qp">
                        <img class="qp_img" src="__PUBLIC__/ke/img/qp1.png">
                        <P class="broadcast_ul_d1_p2">请在这里留言</P>
                    </div>
                </div>
            </li> -->
        </ul>
    </div>
    
        
    </div>
</section>
<footer class="broadcast_foot">
    <!--<P class="broadcast_foot_p"><a href="tel:15101682551">课程咨询</a><span><i class="i1"><?php echo ($shipin["money"]); ?>元</i><i class="i2"></i></span><input type="submit" onclick="checkZhibo()" value="立即抢购"></P>-->
    <P class="broadcast_foot_p"><a style="background:none; color:#565656; font-size:22px; line-height:40px; padding-top:12px;" href="tel:15101682551"><img src="/Public/ke/img/dianhua11.png"><br>电话咨询</a><a style="background:none; color:#565656; font-size:22px; line-height:40px; padding-top:12px;" href="http://dct.zoosnet.net/LR/Chatpre.aspx?id=DCT20072801&lng=cn" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a><a style="background:#5651b7; width:40%; padding:10px 0; line-height:38px;"  onclick="checkZhibo()"><i class="i2" style="font-style:normal; color:#fff; font-size:26px;"><?php echo ($shipin['money']-$shipin['money_you']); ?>元</i><br>立即抢购</a></P>
    
    
    
    <P class="input_shuru" style="width:100%; height:100%; background:#dddddd; padding:15px 10px;display: none;">
    	<input style="width:76%; height:100%; background:#fff; border:1px solid #b0b0b0; border-radius:9px; font-family:Microsoft YaHei; font-size:26px; color:#666; padding-left:10px;" type="text" id="contents" placeholder="请输入您评论的信息">
    	<input class="broadcast_foot_inp" style="width: 22%; float: right; padding: 0;border:1px solid #b0b0b0; border-radius:9px; font-family:Microsoft YaHei; height:100%; background:#fff; font-size:26px; color:#666; " type="button" value="发布" onclick="send()">
    </P>

</footer>
	<P class="follow" style="z-index:9900;"><span class="follow_s1">关注月嫂了不起，更多精彩直播</span><i class="follow_i1">×</i><a class="follow_a1" href="#">加关注</a></P>
	<div class="ewm" style=" display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.6); z-index:9990;"><img style="width:450px; height:370px; margin:90px 0 0 120px;" src="/Public/zhibo/img/ewm.png"></div>

   <!-- 分享  <P class="dhzx" style="position:fixed; right:0; top:200px; z-index:9999;"><a href="tel:15001328927"><img style="width:68px; height:210px;" src="/Public/ke/img/zixun2.png" ></a></P> -->
     <!-------------------------------------支付------------------------------------------------------->
	 <form action="http://m.mumway.com/demo2/pingfu.php" method="post" onsubmit="return zhifupro()" >
		<input type="hidden" name="qid" value="0"/>
		<!-- 支付必传参数：jine、name、zhi、did、zhiurl -->
		<?php if(in_array($openid,array('olwOsjvawl8HIxfkQUTeGRwC-d8U','olwOsjpX93Gg7BtHdGEa78adxP0s'))): ?><input type="hidden" name="jine" value="0.01"/>
       	<?php else: ?>
       	<input type="hidden" name="jine" value="<?Php echo $quan['jine']?9.9-$quan['jine']:9.9;?>"/><?php endif; ?>
		
		<input type="hidden" name="name" value="直播">
		<input type="hidden" name="zhi" value="zhibo">
		<input type="hidden" name="token" value="<?php echo ($openid); ?>">
		<input type="hidden" id="did" name="did">
		<input type="hidden" id="zhiurl" name="zhiurl" value="http://m.mumway.com/index.php/ke/zhibo1/openid/<?php echo ($openid); ?>/id/<?php echo ($shipin["id"]); ?>">
		<input type="hidden" id="kcid" name="kcid" value="<?php echo ($shipin["id"]); ?>">
		
	    <div class="pay_out" style=" position:fixed; display:none; top:0; left:0; bottom:0; right:0; background:rgba(0,0,0,0.3); z-index:9999;">
	    	<div class="alert1" style=" width:550px; background:#fff; margin:30% auto 0; padding:20px 35px 40px;">
	        	<P class="alert_p1" style="text-align:right; padding-bottom:20px;"><span style="font-size:24px; color:#fff; background:rgba(0,0,0,0.5); display:inline-block; width:30px; height:30px; border-radius:50%; text-align:center; line-height:30px;" onclick="javascript:$('.pay_out').hide();">×</span></P>
	            <P style=" font-size:28px; color:#000; line-height:54px;  font-weight:bold;">课程名称：<?php echo ($shipin["title"]); ?></P>
	            <P style=" line-height:38px; font-size:24px; color:#717272; padding-top:8px;"><span style="">原价<i style=" font-style:normal;text-decoration:line-through;">30元</i></span>&nbsp;&nbsp;|&nbsp;&nbsp;8月特惠价优惠 只需<i style="color:#ff9416; font-style:normal; font-size:28px; padding:0 5px;">9.9</i>元</P>
	            <div style="margin:30px 0 20px; border-bottom:1px solid #b8b8b8;  border-top:1px solid #b8b8b8; padding:15px 0; overflow:hidden;">
	            	<p style="line-height:50px; font-size:26px; color:#000; overflow:hidden;"><span style="float:left;">优惠券</span><span style="float:right;"><i style="font-style:normal; font-size:22px; padding-right:10px;  color:#c3c3c3;"><?php echo $quan['jine']?'使用优惠券'.$quan['jine']:'暂无可用优惠券';?></i> ></span></p>
	            </div>
	            <div style="overflow:hidden; padding-bottom:40px;">
	            	<p style="line-height:60px; font-size:26px; color:#000; overflow:hidden;"><span style="float:left;">课程金额：</span><span style="float:right; color:#ff9416;">30.0元</span></p>
	            	<p style="line-height:60px; font-size:26px; color:#000; overflow:hidden;"><span style="float:left;">立减：</span><span style="float:right; color:#ff9416;">-20.1元</span></p>
	            	<p style="line-height:60px; font-size:26px; color:#000; overflow:hidden;"><span style="float:left;">实付金额：</span><span style="float:right; color:#ff9416;"><?Php echo $quan['jine']?9.9-$quan['jine']:9.9;?>元</span></p>
	            </div>
	            <P style="text-align:center;"><input style=" width:350px; height:54px; line-height:54px; background:#19cd32; font-size:26px; color:#fff; border:1px solid #048d03; border-radius:9px;" type="submit" value="微信支付"></P>	
	        </div>
	    </div>
     </form>

</body>
<script type="text/javascript">
	function checkZhibo(){
		//判断是否可以直播
		if(<?php echo ($playpay); ?>){
			$("#bofangImg").hide();
			$("#bf_button").hide();
			$("#iframeZhibo").show();
		}else{
			$('.pay_out').show();
		}
	}
	//公告
	setInterval("gonggao()",60000);
	function gonggao(){
		var id=<?php echo ($shipin["id"]); ?>;
		 $.ajax({
			url:"__URL__/ggajax",
			type:"post",
			data:{"id":id},
			success:function(msg){
				$("#gg").html(msg);
			}
		})
	}
	//评论
	setInterval("xiao()",5000);
	//setTimeout("xiao()",1000);
	function xiao(){
		var url = '__URL__/getpinglun/urlid/<?php echo ($shipin["id"]); ?>/openid/<?php echo ($openid); ?>';
		$.get(url,function(dd){
			$('.broadcast_ul').html(dd);
		});
	}
	//发送评论
	function send(){
		var dt = {};
		dt.openid = '<?php echo ($openid); ?>';
		dt.urlid = '<?php echo ($shipin["id"]); ?>';
		dt.h_id = 0;
		dt.contents = $('#contents').val();
		var cont = $('#contents').val();
		if (cont.replace(/(^\s*)|(\s*$)/g,"")==""){
		    alert('输入为空，或都是空格');
		}else{
			var url = '__URL__/pinglun';
			$.post(url,dt,function(dd){
				$('#contents').val('');
	    		if(!dd){
	    			alert("发送失败！");
	    		}
	    	});
		}
	}
	//生成订单
	function zhifupro(state){
		var flag=false;
		if(state==1){
			$("[name=jine]").val(0);//分享成功之后修改状态，免费播放
		}
		var paycontent=$("[name=name]").val();
		var money=$("[name=jine]").val();
		var token=$("[name=token]").val();
		var kcid=$("[name=kcid]").val();
		$.ajax({
			url:"__URL__/zbdingdan",
			data:{"paycontent":paycontent,
				"money":money,
				"token":token,
				"kcid":kcid,
				"state":state,
				"qid":'<?php echo $quan['qid'];?>',
				"quanid":'<?php echo $quan['quanid'];?>',
				"quane":'<?php echo $quan['jine'];?>'
			},
			type:"post",
			async:false,
			success:function(msg){
				var o=eval("("+msg+")");
				if(o.success==100){
					$("#did").val(o.did);
					flag=true;
				}else if(o.success==1){
					location.href="__URL__/zhibo1/openid/<?php echo ($openid); ?>/id/"+kcid;
					flag=false;
				}else{
					alert("系统错误，请联系管理员");
					flag=false;
				}
			}
		})
		return flag; 
	}
</script>
</html>