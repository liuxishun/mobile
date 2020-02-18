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
<script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
	var BOUGHT = <?php echo ($pd["BOUGHT"]); ?>;
	$(function(){
		$('.vedio1_p2 span').click(function(e) {
			$(this).addClass('current').siblings().removeClass('current')
			$('.vedio_con1').eq($(this).index()).addClass('current').siblings().removeClass('current')
			//链式编程及针对类的特殊化简 方法3
		});
		if(BOUGHT){
			//$('.broadcast_foot_p').hide();//隐藏支付按扭
		}
	});
	var ccpay = null;
	function voido(){
		var cc = $('video').get(0);
		if(cc){
			cc.poster = '';
		    //cc.width=640;
		    //cc.height=420;
		    //cc.videoWidth=640;
		    //cc.videoHeight=420;
			//cc.hide();
			clearInterval(ccpay);
		}
	}
	function pay(){
		if(BOUGHT){
			var vod = '<?php echo ($pd["vurl"]); ?>';
			if(vod.indexOf("live.ceecloud.cn") < 0){
				var dom = document.getElementById("myimg");
				var sc = document.createElement("script");
				sc.setAttribute("type","text/javascript");
				sc.setAttribute("src","<?php echo ($pd["vurl"]); ?>&width=640&height=480");
				document.getElementById("myimg").innerHTML="";
				dom.appendChild(sc);
				//ccpay = setInterval("voido()",1000);
			}else{
				document.getElementById("myimg").innerHTML="<iframe style='margin-left:-8px; margin-top:-8px;' width='656px' height='366px' id='iframeZhibo' name='iframeZhibo' src='<?php echo ($pd["vurl"]); ?>' frameborder='0' scrolling='no' webkitallowfullscreen='' mozallowfullscreen='' allowfullscreen=''></iframe>";
			}
			//添加一条用户学习轨迹视频的记录
			var ul = 'http://my.mumway.com/api/user/saveUserVideo?USER_ID=<?php echo ($openid); ?>&VIDEO_ID=<?php echo ($pd["vid"]); ?>';
			$.get(ul,function(data){});
		}else{
			alert("您没有购买此视频!");
		}
		
	}
</script>
<script type="text/javascript">
$(function(){
	$('.broadcast_ul li:last').css('borderBottom','none');
	$('#wrapper').css('margin','none');
	$('object').attr('object-fit','fill');
	$('object').attr('object-position','top');
	$('.synopsis li').click(function(e) {
		$(this).addClass('current').siblings().removeClass('current')
		$('.zhibo_tab1').eq($(this).index()).addClass('current').siblings().removeClass('current')
		//链式编程及针对类的特殊化简 方法3
		/*
		var oo = $(this).index();
		if(oo == 1){
			$('.broadcast_foot_p').hide(); 
			$('.input_shuru').show();
		}else{
			$('.broadcast_foot_p').show(); 
			$('.input_shuru').hide();
		}*/
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
</head>

<body style="background-color: #f3f3f3; margin:0; ">
<section class="section" style="top:0; margin-bottom:120px;">
<div class="zhibo11">
    <div class="broadcast" id="myimg" style="height:auto;">
        <img src="http://my.mumway.com/<?php echo ($pd["pic"]); ?>" style="height:320px;">
        <img style="width:130px; height:130px; position:absolute; left:50%; top:100px; margin-left:-65px;" src="__PUBLIC__/ke/img/bo.png" onClick="pay()">
        <iframe style="display:none; margin-left:-8px; margin-top:-8px; " id="iframeZhibo" name="iframeZhibo" src="" width="656px" height="336px" frameborder="0" scrolling="no" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen=""></iframe>
        <P style="display:none;" class="broadcast_p1">公告：</P>
    </div>
</div>
<div class="zhibo_tab">
    <ul class="synopsis">
        <li class="current" style="width:50%;" >简介</li>
        <li style="width:50%;" >章节</li>
        <!-- 
        <li>问答</li>
        <li style="width:33.3%;" >考试</li>
         -->
    </ul>
    
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
    
    <!-- 
    <div class="zhibo_tab1">
        <ul class="broadcast_ul" style="  margin-top:0;" id="plUL">
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
            </li> 
        </ul>
    </div>
    -->
    <div class="zhibo_tab1">
        <?php if(is_array($pd["classList"])): foreach($pd["classList"] as $key=>$tt): ?><div class="list">
            	<P class="list_p1"><?php echo ($tt["title"]); ?></P>
                <ul class="list_ul">
                <?php if(is_array($tt["video"])): foreach($tt["video"] as $key=>$t): ?><li><a class="list_ul_a1" href="javascript:;"><?php echo ($t["title"]); ?></a><a class="list_ul_a2" href="__URL__/quzheng1/id/<?php echo ($pd["id"]); ?>/vid/<?php echo ($t["id"]); ?>/openid/<?php echo ($openid); ?>" >播放</a></li><?php endforeach; endif; ?>
                </ul>
            </div><?php endforeach; endif; ?>
     </div>
    
    <!---------------------------------------考试-------------------------------------------->
    <div class="zhibo_tab1">
    	<P class="jia_ks_p1">请根据您的学习情况</P>
        <P class="jia_ks_p2">选择练习还是考试</P>
        <ul class="jia_ks_ul">
        	<li><a href="__URL__/dati/cid/<?php echo ($pd["id"]); ?>/type/2/openid/<?php echo ($openid); ?>" onclick="return dati()">
            	<P class="jia_ks_ul_p1"><span><img src="/Public/ke/img/gai_icon_06.png"></span></P>
            	<P class="jia_ks_ul_p2">练习</P>
            </a></li>
            <li><a class="jia_ks_ul_a" href="__URL__/dati/cid/<?php echo ($pd["id"]); ?>/type/1/openid/<?php echo ($openid); ?>" onclick="return dati()">
            	<P class="jia_ks_ul_p1 jia_ks_ul_p3"><span><img src="/Public/ke/img/gai_icon_03.png"></span></P>
            	<P class="jia_ks_ul_p2" style="color:#5651b7;">考试</P>
            </a></li>
        </ul>
    </div> 
      
	       
    </div>
</section>
<footer class="broadcast_foot">
    <P class="broadcast_foot_p">
    <a style="background:none; color:#565656; font-size:22px; line-height:40px; padding-top:12px;" href="tel:13426127857"><img src="/Public/ke/img/dianhua11.png"><br>电话咨询</a>
    <a style="background:none; color:#565656; font-size:22px; line-height:40px; padding-top:12px;" href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc" target="_blank"><img src="/Public/ke/img/zaixian11.png"><br>在线咨询</a>
    <a style="background:#5651b7; width:40%; padding:10px 0; line-height:38px;" onclick="javascript:location.href='__URL__/zhifu?classid=<?php echo ($pd["id"]); ?>&openid=<?php echo ($openid); ?>'"><i class="i2" style="font-style:normal; color:#fff; font-size:26px;"><?php echo ($pd["jine"]); ?>元</i><br>立即抢购</a>
    </P>
    <!-- <P class="input_shuru" style="width:100%; height:100%; background:#dddddd; padding:15px 10px;display: none;">
    	<input style="width:76%; height:100%; background:#fff; border:1px solid #b0b0b0; border-radius:9px; font-family:Microsoft YaHei; font-size:26px; color:#666; padding-left:10px;" type="text" id="contents" placeholder="请输入您评论的信息">
    	<input class="broadcast_foot_inp" style="width: 22%; float: right; padding: 0;border:1px solid #b0b0b0; border-radius:9px; font-family:Microsoft YaHei; height:100%; background:#fff; font-size:26px; color:#666; " type="button" value="发布" onclick="send()">
    </P> -->

</footer>
    <!--<P class="dhzx" style="position:fixed; right:0; top:200px; z-index:9999;"><a href="tel:15001328927"><img style="width:68px; height:210px;" src="http://m.mumway.com/Public/ke/img/zixun2.png" ></a></P>-->
	<!---------------在线客服---------------------->
	<!--<script type="text/javascript" src="http://cs.ecqun.com/?id=1900065" charset="utf-8"></script>-->
    <!---------------在线客服---------------------->

</body>
<script type="text/javascript">
function dati(){
	if(BOUGHT){
		
	}else{
		alert("您没有购买此视频!");
		return false;
	}
}

	//setInterval("xiao()",5000);
	//setTimeout("xiao()",1000);
	function xiao(){
		var url = '__URL__/getpinglun/urlid/<?php echo ($pd["id"]); ?>/openid/<?php echo ($openid); ?>/tm/'+new Date().getTime();
		$.get(url,function(dd){
			$('.broadcast_ul').html(dd);
		});
	}
	function send(){
		var dt = {};
		dt.openid = '<?php echo ($openid); ?>';
		dt.urlid = '<?php echo ($pd["id"]); ?>';
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

</script>
</html>