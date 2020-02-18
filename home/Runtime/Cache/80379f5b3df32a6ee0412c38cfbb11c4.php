<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/aj/wode/css/style.css">
	<script type='text/javascript'>
          var _vds = _vds || [];
          window._vds = _vds;
          (function(){
            _vds.push(['setAccountId', '87405247014f637f']);
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
    <script src="__PUBLIC__/aj/wode/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$('.top_choice li:last').css('borderRight',0);
			$('.fun_ul li:last').css('borderBottom',0);
			
			$(".wdfs_ul1").each(function(){
				$(this).find('li').last().css('borderBottom',0);		
			})
			
		});
		function add(){
			var jine = $('#jine').val();
			var tjine = $('#tjine').val();
			if(jine <= 0){
				alert('请输入金额！');
				return false;
			}
			if(tjine < jine){
				alert('当前输入金额大于可提现金额！');
				return false;
			}
			var dt = {};
			dt.jine = jine;
			dt.openid = $('#openid').val();
			$.post('http://m.mumway.com/demoaj/qiecall.php',dt,function(rt){
				rt = eval("("+rt+")");
				if(rt.return_code == 'SUCCESS'){
					alert('提现成功！');
					location.reload();
				}else{
					alert('提现失败！');
				}
				
			});
			return false;
		}
    </script>
    
</head>

<body style="background-color: #f3f3f3;">
    <section class="section">
    	<div class="ktx">
            <div class="ktx_d1">
            	<P class="ktx_d1_p1"><span><i><?php echo ($arr["djine"]); ?></i> 元</span><br>待转入提现金额</P>
                <div class="ktx_d1_d">
                	<p class="ktx_d1_d_p1"><img class="ktx_d1_d_img"  src="<?php echo ($arr["headimgurl"]); ?>" onerror="this.src='__PUBLIC__/aj/wode/img/img4.jpg'"></p>
                    <P class="ktx_d1_d_p"><?php echo ($arr["nickname"]); ?><span> ID:<?php echo ($arr["id"]); ?></span></P>
                    <img class="ktx_d1_d_img1" src="__PUBLIC__/aj/wode/img/ktx.png">
                </div>
                <p class="ktx_d1_p1"><span><i><?php echo ($arr["jine"]); ?></i> 元</span><br>可提现金额</p>
            </div>
            <form action="" method="post" onsubmit="return add()" style="display:none;">
            	<input type="hidden" id="openid" name="openid" value="<?php echo ($openid); ?>">
            	<input type="hidden" id="tjine" name="tjine" value="<?php echo ($arr["jine"]); ?>">
        	 	<P class="Withdrawals_p1">
        	 	<input class="Withdrawals_p1_i1" type="number" id="jine" name="jine" placeholder="请输入提现金额">
        	 	<input type="submit" value="提现" class="Withdrawals_p1_i2">
        	 	</P>
        	</form>
        </div>
		<P class="wdfs">本月</P>
        <ul class="wdfs_ul1">
        	<?php if(is_array($tixian)): foreach($tixian as $key=>$li): ?><li><a href="javascript:;">
        	<?php
 $weekarray=array("周日","周一","周二","周三","周四","周五","周六"); $zhou = date("w", strtotime($li['addtime'])); $zhou = $weekarray[$zhou]; $yueri = date("m-d", strtotime($li['addtime'])); ?>
            	<p class="wdfs_ul1_p1"><span><?php echo ($zhou); ?></span><br><?php echo ($yueri); ?></p>
                
                <div class="wdfs_ul1_d">
                	<P class="wdfs_ul1_d_p1">+<?php echo ($li["jine"]); ?></P>
                    <p class="wdfs_ul1_d_p2">您的提现已到账</p>
                </div>
                <p class="wdfs_ul1_p2"><img src="__PUBLIC__/aj/wode/img/ktx_01.png"></p>
            </a></li><?php endforeach; endif; ?>
        	<!-- 
        	<li><a href="#">
            	<p class="wdfs_ul1_p1"><span>周三</span><br>09-07</p>
                
                <div class="wdfs_ul1_d">
                	<P class="wdfs_ul1_d_p1">+1680</P>
                    <p class="wdfs_ul1_d_p2">您的提现已到账</p>
                </div>
                <p class="wdfs_ul1_p2"><img src="__PUBLIC__/aj/wode/img/ktx_01.png"></p>
            </a></li>
            <li><a href="#">
            	<p class="wdfs_ul1_p1"><span>周三</span><br>09-07</p>
                
                <div class="wdfs_ul1_d">
                	<P class="wdfs_ul1_d_p1">-1680</P>
                    <p class="wdfs_ul1_d_p2">您的提现申请已提交请耐心等候</p>
                </div>
                <p class="wdfs_ul1_p2"><img src="__PUBLIC__/aj/wode/img/ktx_02.png"></p>
            </a></li>
            <li><a href="#">
            	<p class="wdfs_ul1_p1"><span>周三</span><br>09-07</p>
                
                <div class="wdfs_ul1_d">
                	<P class="wdfs_ul1_d_p1">+1680</P>
                    <p class="wdfs_ul1_d_p2">您的粉丝 刘伟 消费100元</p>
                </div>
                <p class="wdfs_ul1_p2"><img src="__PUBLIC__/aj/wode/img/ktx_03.png"></p>
            </a></li>
             -->
        </ul>
    </section>
</body>
</html>