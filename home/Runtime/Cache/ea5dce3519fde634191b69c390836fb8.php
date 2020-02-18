<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/index_sgmm.css">
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
				<li><span>手机号码：</span><input id="mobile" name="" type="text" class="reg-inp"></li>
				<li><span>验证码：</span><input id="sms_code" name="" type="text" class="reg-inp reg-inp02" placeholder="请输入验证码"><a class="hqyzm" href="javascript:void(0)" onClick="getCode(this)">获取验证码</a></li>
				<li><span>密码：</span><input id="password" name="" type="text" class="reg-inp"></li>
				<li><p><img src="__PUBLIC__/home/images/tytk-tb.png" width="14" height="14" border="0" />我同意<a href="#">《服务条款》</a>中所有内容</p><em>已注册？<a href="javascript:void(0)" onClick="window.history.back();">马上登录</a></em></li>
				<li><input name="" type="button" onClick="reg()" value="下一步" class="reg-but"></li>
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
		url:"<?php echo U('getMobilecode');?>",
		type:"POST",
		dataType:"json",
		data:{
			mobile:$("#mobile").val(),
		},
		success:function(data, textStatus, jqXHR){
				if(data.status==1){
                                   
					alert("验证码已经发送，注意查收");
                                        obj.attr('sec', 61);
                                        showCodeTime(obj);
				}else{
                                   
					alert(data.info);
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
function reg(){
	$.ajax({
		url:"<?php echo U('register');?>",
		type:"POST",
		dataType:"json",
		data:{
			mobile:$("#mobile").val(),
			sms_code:$("#sms_code").val(),
			password:$("#password").val(),
			},
		success:function(data, textStatus, jqXHR){
				if(data.status==1){
					alert("注册成功！");
                    location.href="/index.php/yymm/login";
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


<script language="javascript" src="http://dct.zoosnet.net/JS/LsJS.aspx?siteid=DCT20072801&float=1&lng=cn"></script>
</body>
</html>