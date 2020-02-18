<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>修改密码</title>
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
<script src="__PUBLIC__/mobile/js/jquery-2.1.0.min.js"></script>
<script src="__PUBLIC__/mobile/js/main.js"></script>
</head>
<body class="reg-bg">
	

	<!--head-->
	<div class="reg-head">
		<div class="wid-1200">
			<div class="head-le"><a href="#"><img src="__PUBLIC__/home/images/logo.png" width="340" height="114" border="0" /></a></div>
		</div>
	</div>


	<!--main-->



	


	<div class="reg-main">
		
		
		<div class="reg-div">
			<ul>
				<li><span>手机号码：</span><input id="mobile" type="text" placeholder="请输入手机号"  class="reg-inp"></li>
				<li><span>验证码：</span><input id="sms_code" type="text" placeholder="请输入验证码" class="reg-inp reg-inp02"><a class="hqyzm" href="javascript:void(0)" onClick="getCode(this)">获取验证码</a></li>
				<li><span>密码：</span><input id="password" type="password" placeholder="请输入密码" class="reg-inp"></li>
				<li><em>已想起来?<a href="javascript:void(0)" onClick="window.history.back();">马上登录</a></em></li>
				<li><input name="" type="button" onClick="post(this)" value="重设密码" class="reg-but"></li>
			</ul>
		</div>
		
		
	</div>
<!--footer-->
	<div class="box-footer">
		<div class="footer-ul">
			<div class="wid-1200">
				<a href="#">about us </a>
				<a href="#">好孕优势</a>
				<a href="#">月子服务</a>
				<a href="#">育婴导航</a>
				<a href="#">孕育服务</a>
				<a href="#">会员俱乐部</a>
				<a href="#">联系我们</a>
				<a href="#">服务员找工作</a>
			</div>
		</div>
		<div class="footer-p">
			<div class="wid-1200">
			电话：400-009-8566或010-59273398<br />
			公司地址：北京市朝阳区亚运村北苑路170号凯旋城D座403--405室<br />
			Copyright2013-2015 MUMWAY Corporation,ALLRights Reserved    京ICP备12034681-2 京公网备11010802009854号
			</div>	
		</div>
	</div>	
</div>



	<script type="text/javascript" src="__PUBLIC__/home/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/home/js/demo_1.js"></script>
<script type="text/javascript">
function getCode(obj){
	obj=$(obj);
    if(obj.attr('s')||obj.attr('sec'))return false;
    obj.attr('s', 1).css('opacity', 0.6);
    $.ajax({
		url:"__URL__/getPwdMobilecode",
		type:"POST",
		dataType:"json",
		data:{
			mobile:$("#mobile").val(),
		},
		success:function(data, textStatus, jqXHR){
				if(data.status==1){
					Systip.show("验证码已经发送，注意查收");
                    obj.attr('sec', 61);
                    showCodeTime(obj);
				}else{
					Systip.show(data.info);
				}
                obj.attr('s', '').css('opacity', 1);
			},
		error:function(XMLHttpRequest,errorInfo,exception){
				alert(errorInfo);
                obj.attr('s', '').css('opacity', 1);
			}
	});
}
function showCodeTime(obj){
    obj=$(obj);
    var s=obj.attr('sec');
    if(s>0){
        s = s-1;
        s = s==0? '' : s;
        obj.attr('sec', s)
        if(s){
            obj.addClass('btn-dis').html('获取验证码('+s+')');
        }else{
            obj.removeClass('btn-dis').html('获取验证码');
        }
        setTimeout(function(){showCodeTime(obj)}, 1000);
    }
}
function post(obj){
	obj=$(obj);
    if(obj.attr('s')||obj.attr('sec'))return false;
    obj.attr('s', 1).css('opacity', 0.6);
    $.ajax({
		url:"__SELF__",
		type:"POST",
		dataType:"json",
		data:{
			mobile:$("#mobile").val(),
			sms_code:$("#sms_code").val(),
			password:$("#password").val(),
			},
		success:function(data, textStatus, jqXHR){
				if(data.status==1){
					Systip.show("修改成功！");
                    setTimeout(function(){location.href='<?php echo U('login'); ?>';}, 1200);
				}else{
					Systip.show(data.info);
				}
                obj.attr('s', '').css('opacity', 1);
			},
		error:function(XMLHttpRequest,errorInfo,exception){
				alert(errorInfo);
                obj.attr('s', '').css('opacity', 1);
			}
	});
}
</script>


<script language="javascript" src="http://dct.zoosnet.net/JS/LsJS.aspx?siteid=DCT20072801&float=1&lng=cn"></script>
</body>
</html>