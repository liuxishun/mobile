<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/toup/css/style2.css">
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<?php
if(!$par['openid']){ $ul = 'http://m.mumway.com/yuesao/ystp/wxtp.php?type=index'; Header("Location: $ul");die; } require_once "Public/wx/jssdk.php"; $jssdk = new JSSDK("wxcd720e416bcaaa0d", "e5ebc693eeb62f3ab03253297a5a41e7"); $signPackage = $jssdk->GetSignPackage(); ?>
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
			title: '测一测:你值多少钱？当月嫂/育儿嫂拿多少钱月薪', // 分享标题
			desc:'做试卷测水平，看一看你值多少月薪。完成《521科学月嫂育儿嫂挑战》奖521元', // 分享描述
			link: 'www.baidu.com/open/js/jweixin-1', // 分享链接
			imgUrl: 'http://m.mumway.com/Public/ke/images/fenx.png', // 分享图标
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
<script src="__PUBLIC__/ke/toup/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
    $(function(){
		$('.rule').click(function(e) {
            $('.xx').show();
        });
		$('.cuo1').click(function(e) {
            $('.xx').hide();
        });
		$('.cuo').click(function(e) {
            $('.tankuang1').hide();
        });
		$('.cuo').click(function(e) {
            $('.hongbao').hide();
        });
		$('.ale1_d_p5 span').click(function(e) {
            $('.xx').hide();
        });
		$('.zk_li').click(function(e) {
			var lis=$(this).siblings('div');
			toufen(lis,$(this).attr('beg'),10);
			if(lis.css('display')=='none'){
				lis.slideDown();
				$(this).parents().siblings().find('.jian').hide();
				$(this).find('.zk').html('合上').css('background','url(__PUBLIC__/ke/toup/img/pai_09.png) no-repeat center 65px');
				$(this).parents().siblings().find('.zk').html('展开').css('background','url(__PUBLIC__/ke/toup/img/xia_03.png) no-repeat center 65px');
			}else{
				lis.hide();
				$(this).find('.zk').html('展开').css('background','url(__PUBLIC__/ke/toup/img/xia_03.png) no-repeat center 65px');
			}
		});
    });

   	//投票
   	function toup(wo,op,nm){
   		var ul = '__URL__/touadd/openid/<?php echo ($par["openid"]); ?>/topenid/'+op;
   		$.get(ul,function(e){
   			if(e.err == 1){
   				$("#ale_11").text("您是第"+e.con+"位爱"+nm+"的人");
   				$(".tankuang1").eq(0).show();
   				$(wo).html('已投票');
   				wo.onclick = null;
   			}else{
   				$(".tankuang1").eq(1).show();
   			}
   			//alert(JSON.stringify(e));
   		})
   	}
   	//投票
   	function toufen(d,beg,ct){
   		var div = $(d).html();
   		if(div==null || div.length == 0){ //针对ie
   			var ul = '__URL__/toufen/beg/'+beg+'/ct/'+ct;
   	   		$.get(ul,function(e){
   	   			$(d).append(e);
   	   		})
   		}
   		
   	}
   	$(function(){
   		//是否首次进入
   		if("<?php echo ($_SESSION['panxx']); ?>" == 1){
   			//$(".tankuang1").eq(2).show();
   		}
   	});
   </script>
    
</head>

<body style=" background:#fff; width:100%; " >
<section>
<form action="__SELF__" method="get">
	<P class="phb_p1"><input class="phb_i2" type="text" name="title" placeholder="搜索：姓名 编号 ">
	<input type="hidden" name="openid" value="<?php echo ($par['openid']); ?>">
	<input class="phb_i1" type="submit" value=""></P>
</form>
	<div class="first">
    	<ul class="sj">
        	<li>
            	<p class="sj_img"><span class="sj_img_sp"><img src="<?php echo ($list3[1]["headimgurl"]); ?>"></span></p>
                <P class="sj_tit"><?php echo ($list3[1]["id"]); ?>号-<?php echo ($list3[1]["name"]); ?></P>
                <P class="sj_tit">当前得票：<?php echo ($list3[1]["number"]); ?>票</P>
            </li>
            <li class="one">
            	<p class="sj_img"><span class="sj_img_sp"><img src="<?php echo ($list3[0]["headimgurl"]); ?>"></span></p>
                <P class="sj_tit"><?php echo ($list3[0]["id"]); ?>号-<?php echo ($list3[0]["name"]); ?></P>
                <P class="sj_tit">当前得票：<?php echo ($list3[0]["number"]); ?>票</P>
                <img class="one_img" src="__PUBLIC__/ke/toup/img/one_03.png">
            </li>
            <li>
            	<p class="sj_img"><span class="sj_img_sp"><img src="<?php echo ($list3[2]["headimgurl"]); ?>"></span></p>
                <P class="sj_tit"><?php echo ($list3[2]["id"]); ?>号-<?php echo ($list3[2]["name"]); ?></P>
                <P class="sj_tit">当前得票：<?php echo ($list3[2]["number"]); ?>票</P>
            </li>
        </ul>
        <P class="rule">活动规则</P>
    </div>
    
    
    <div class="hongbao" style="display: none; background:rgba(0,0,0,0.3); position:fixed; top:0; left:0; right:0; bottom:0; z-index:100;">
		<div class="ale_d" style=" height:auto;">
	    	<P style=" text-align:center;"><img style=" width:100%; height:auto;" class="" src="__PUBLIC__/ke/toup/<?php echo ($list[0]['ma']); ?>"></P>
	        <span class="cuo" style="color:#000; font-size:36px;">x</span>
	    </div>
	</div>
	
	
    <ul class="phb_ul">
    <?php if(is_array($list)): foreach($list as $key=>$li): ?><li class="now">
        	<span class="phb_ul_s1"><?php echo ($li["pai"]); ?></span>
            <img class="phb_ul_img" src="<?php echo ($li["headimgurl"]); ?>">
            <div class="phb_ul_d">
            	<P class="phb_ul_d_p1"><span><?php echo ($li["id"]); ?>号—<?php echo ($li["name"]); ?></span><span>当前得票：<?php echo ($li["number"]); ?></span></P>
            </div>
            <?php if($li['ma']): ?><a class="phb_ul_a" href="javascipt:0;" onclick="javascipt:$('.hongbao').show();">领红包</a><?php endif; ?>
            <!-- 
            <?php if($li['tou'] == 1): ?><a class="phb_ul_a" href="javascipt:0;">已投票</a>
            <?php else: ?>
            <a class="phb_ul_a" href="javascipt:0;" onclick="toup(this,'<?php echo ($li["openid"]); ?>','<?php echo ($li["name"]); ?>')">投票</a><?php endif; ?>
             -->
        </li><?php endforeach; endif; ?>
    </ul>
    
    <?php if(is_array($lists)): foreach($lists as $key=>$li): ?><ul class="phb_ul">
    	<li class="zk_li" beg="<?php echo ($li["pai"]); ?>">
        	<span class="phb_ul_s1"><?php echo ($li["pai"]); ?></span>
            <img class="phb_ul_img" src="<?php echo ($li["headimgurl"]); ?>">
            <div class="phb_ul_d">
            	<P class="phb_ul_d_p1"><span><?php echo ($li["id"]); ?>号—<?php echo ($li["name"]); ?></span><span>当前得票：<?php echo ($li["number"]); ?></span></P>
            </div>
            <!-- 
            <?php if($li['tou'] == 1): ?><a class="phb_ul_a" href="javascipt:0;">已投票</a>
            <?php else: ?>
            <a class="phb_ul_a" href="javascipt:0;" onclick="toup(this,'<?php echo ($li["openid"]); ?>','<?php echo ($li["name"]); ?>')">投票</a><?php endif; ?>
             -->
            <span class="zk">展开</span>
        </li>
        <div class="jian"></div>
    </ul><?php endforeach; endif; ?>
    <!-- 
    <ul class="phb_ul">
    	<li class="zk_li">
        	<span class="phb_ul_s1">1</span>
            <img class="phb_ul_img" src="<?php echo ($li["headimgurl"]); ?>">
            <div class="phb_ul_d">
            	<P class="phb_ul_d_p1"><span><?php echo ($li["id"]); ?>号—<?php echo ($li["name"]); ?></span><span>当前得票：<?php echo ($li["number"]); ?></span></P>
            </div>
            <?php if($li['tou'] == 1): ?><a class="phb_ul_a" href="javascipt:0;">已投票</a>
            <?php else: ?>
            <a class="phb_ul_a" href="javascipt:0;" onclick="toup(this,'<?php echo ($li["openid"]); ?>','<?php echo ($li["name"]); ?>')">投票</a><?php endif; ?>
            <span class="zk">展开</span>
        </li>
        <div class="jian">
            <li>
                <span class="phb_ul_s1">1</span>
                <img class="phb_ul_img" src="img/pai_05.png">
                <div class="phb_ul_d">
                    <P class="phb_ul_d_p1"><span>3068号—李大傻</span><span>当前得票：75707</span></P>
                </div>
                <a class="phb_ul_a" href="#">投票</a>
            </li>
        </div>
    </ul>
     -->
</section>
<!------------------活动规则---------------------------->
<div class="ale1 xx">
	<P class="gz1_p">活动规则</P>
	<div class="ale1_d">
        <P class="ale1_d_p1"><span>888</span>元现金红包得主：</P>
        <P class="ale1_d_p2">1-10名</P>
        <P class="ale1_d_p1"><span>188</span>元现金红包得主：</P>
        <P class="ale1_d_p2">51-55、151-155、251-255、351-355</P>
        <P class="ale1_d_p1"><span>88</span>元现金红包得主：</P>
        <P class="ale1_d_p2">101-110、201-210、301-310、401-410</P>
        <P class="ale1_d_p3">另<span>430</span>名随机金额为：188、88、12</P>
        <P class="ale1_d_p4">*提示：每人两张选票，限投一人</P>
        <P class="ale1_d_p5"><span>知道了</span></P>
        <img class="cuo1" src="__PUBLIC__/ke/toup/img/gz_04.png">
    </div>
</div>
<!------------------投票成功---------------------------->
<div class="tankuang1" >
	<div class="ale_d">
    	<img class="ale_d_img" src="__PUBLIC__/ke/toup/img/ale.png">
        <P class="ale_d_p1">投票成功</P>
        <P class="ale_d_p2" id="ale_11">您是第***位爱***的人</P>
        <P class="ale_d_p6">感谢您对她的爱</P>
        <P class="ale_d_p6">祝福您在2017年天天有爱</P>
        <P class="ale_d_p9"><a href="http://m.mumway.com/yuesao/ystp/bm.php">我也想参加</a></P>
        <span class="cuo"></span>
    </div>
</div>
<!------------------投票失败---------------------------->
<div class="tankuang1">
	<div class="ale_d">
    	<img class="ale_d_img" src="__PUBLIC__/ke/toup/img/ale.png">
        <P class="ale_d_p1">投票失败</P>
        <P class="ale_d_p2">很抱歉，您未能投票成功</P>
        <P class="ale_d_p7">您的票数已用完不能投票了</P>
        <P class="ale_d_p7">感谢您对她的爱</P>
        <P class="ale_d_p7">祝福您在2017年天天有爱</P>
        <span class="cuo"></span>
    </div>
</div>
<!------------------消息提醒---------------------------->
<div class="tankuang1">
	<div class="ale_d">
    	<img class="ale_d_img" src="__PUBLIC__/ke/toup/img/ale.png">
        <P class="ale_d_p1">消息提醒</P>
        <P class="ale_d_p8">您收到<?php echo ($par["con"]); ?>位好友的爱</P>
        <P class="ale_d_p7">离前100名差<?php echo ($par["conp"]); ?>张选票</P>
        <span class="cuo"></span>
    </div>
</div>
</body>
</html>