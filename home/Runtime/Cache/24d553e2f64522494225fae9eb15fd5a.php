<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
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
				<li><span>手机号码:</span><input id="mobile" name="" type="text" class="reg-inp" placeholder="请输入手机号" ></li>
				<li><span>密码：</span><input id="password" name="" type="text" class="reg-inp" placeholder="请输入密码" ></li>
				<li>&nbsp;</li>
                                <li><p><a href="<?php echo U('getpwd')?>" style="color:#666;margin-left:15px;">忘记密码？</a></p><em>还不是会员？<a href="<?php echo U('register');?>">立即注册</a></em></li>
				<li><input onClick="login()" name="" type="button" value="马上登录" class="reg-but"></li>
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
function login(){
	$.ajax({
		type:"POST",
		url:"<?php echo U('login') ;?>",
		data:{
			mobile:$("#mobile").val(),
			password:$("#password").val(),
            autologin:1,
		},
		dataType:"json",
		success:function(data, textStatus, jqXHR){
			var ok_url='<?php echo ($url); ?>';
            if(data.status==1){
				location.href="/index.php/yymm/yuyue";
			}else{
				alert(data.info);
			}
		},
		error:function(XMLHttpRequest,errorInfo,exception){
			alert(errorInfo);
		}
	});
}
</script>

</body>
</html>