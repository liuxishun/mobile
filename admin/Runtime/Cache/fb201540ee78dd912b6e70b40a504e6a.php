<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>网站管理后台</title>
<link href="__PUBLIC__/admin/css/admin_style.css" type="text/css" rel="stylesheet" />
<script language="javascript" type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.6.2.min.js"></script>
</head>
<script>
window.onload = function (){
	document.getElementById('username').focus();
}
if(location!=top.location){top.location=location;}
</script>
<body style="background-color:#1462ad;">
<div class="all_login">
  <div class="login_box">
    <div class="con_box">
      <h2>欢迎登录管理平台</h2>
      <form action="" method="post" id="myform" onsubmit="return checklogin();" style="padding:0px;">
	      <table class="login" style="margin-left: 70px; margin-top: 30px;">
	        <tr>
	         <td><b>用户名：</b></td>
	          <td><input class="login_put" type="text" name="username" id="username" value="<?php echo $username; ?>" /></td>
	        </tr> 
	        <tr>
	         <td><b>密码：</b></td>
	         <td><input class="login_put" type="password" name="password" id="password" /></td>
	        </tr>
	        <tr>
	         <td><b>验证码：</b></td>
	         <td><input type="text" name="verify" id="verify" class="login_put1" autocomplete="off" style="width:80px;"/>
	          <img src="__APP__/Public/verify" width="62" height="21" align="absmiddle" id="verifyImg" onclick="fleshVerify(this)" title="点击刷新验证码"/></td>
	        </tr>
	       </table>
	       <input type="submit" class="login_but" name="submit" value=""/>
	  </form>
	  <script type="text/javascript">
		function fleshVerify(obj)
		{
			$("#verifyImg").attr('src',"__APP__/Public/verify/random="+Math.random());
		}
		function checklogin(){
			var user_name = $.trim($("#username").val());
			if( user_name == '' || user_name.length <= 0){
				alert('用户名不能为空');
				return false;
			}
		  	
		  	var password = $.trim($("#password").val());
			if(password =='' || password.length==0){
				alert("密码不能为空");
				return false;
			}
		}
	  </script>
    </div>
  </div>
</div>
</body>
</html>