<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="css/index.css" rel="stylesheet">
<title>客户登录</title>

<script src="/daima/Public/static/js/jquery-1.8.0.js"></script>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
<script src="__PUBLIC__/mobile/js/jquery-2.1.0.min.js"></script>
<script src="__PUBLIC__/mobile/js/main.js"></script>
<script type="text/javascript" src="__PUBLIC__/index/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery-ui/1.8.9/jquery-ui.min.js"></script>
<script src="/Public/static/js/jquery-1.8.0.js"></script>


</head>
	<style>
	*{ margin:0px; padding:0px; font-family: "Microsoft YaHei" }
    .all{
	width:100%;
	margin-left:auto;
	margin-right:auto;
}
.fo{
	
	border-top:2rem;}


.fo li{
  list-style:none;
	folat:left;
	text-align:center;
	font-size:3rem;
}
     .Df_list {
	    width: 100%;
    margin-top: 10px;
    border-top: 1px solid #d5d5d5;
  	background-color: #fff;
    position: relative;
}   

.me{
	margin-left:18px;
	
}
.show{
ss
}
.my{
	margin-left:0rem;
    color:#fff;
	font-size:3rem;
}

.span{
	color: #f00;
	font-size: 24px;
}
li{
	margin-top:10px;
	}
	#er{
	  margin-right:4rem;
		}
		#rt{
			margin-right:8.99rem;}
			#ty{
				margin-right:-1rem;}
				
#tu{
	margin-right:8.75rem}
	#yu{
		margin-right:1px;}
		#ti{
			margin-right:1px;}
			.clear{ clear:both; }
			.inputLable{ width:22%;float:left; font-size:18px; font-weight:600; height:60px; line-height:60px; color:#666; display:block; text-align:right; padding-right:3%}
			.input{width:73%; border-radius:8px;font-size:3rem; float:left; border:solid 1px #CCC; height:60px; font-size:18px;}
			    </style>
<body>
<div class="all">

  <h2 style=" height:60px; line-height:60px; text-align:center; font-size:16px; color:#666;">请填写详细的联系人信息，方便我们及时到达</h2>
<div class="fo">
  <form action="__URL__/addtijiao" method="post">
  <input type="hidden" value="" name="money" />
<ul class="Df_list">
<li><span class="inputLable">姓名:</span><input type="text"  id="name" name="name" class="name input"  placeholder='如：张先生,王小姐' onblur="doblur()"><br>
<span id="sname" class="span clear">
</span>
</li>
<li id="phone"><span class="inputLable">手机号:</span><input type="text" name="phone" class="phone input" id="phoneNumber" placeholder='如：13800000000' onblur="brblur()"><br>
<span id="sphone" class="span"></span>
</li>
<li id="project"><span class="inputLable">服务项目:</span><input type="text" name="project" class="project input" value="<?php echo ($title); ?>" placeholder=''><br>
</li>
<li id="address"><span class="inputLable">服务地址:</span><input type="text" name="phone" class="address input" placeholder='如：朝阳区北苑路170号凯旋城'><br>
</li>
<li id="number"><span class="inputLable">门牌号:</span><input type="text" name="number" class="number input" placeholder='如：xx小区xx号楼601'><br>
</li>
<li id="date"><span class="inputLable">服务时间:</span><input type="text" name="time" class="date input" ><br>
</li>

<li><input type="submit" value="提交" id="sub" style="width:80%; height:45px; border-radius:10px; border:none; background:#dc8efc; color:#fff; font-size:16px;"></li>

</ul>
</form>
</div>
</div>
</body>
</html>
<script>
$(function(){
	$("#sub").click(function(){
		var at = $("#bmdate input").val();
		
		var inputObj={};
		inputObj.name=$("#name").val();
		inputObj.phone=$("#phone input").val();
		inputObj.project=$("#project input").val();
		inputObj.number=$("#number input").val();
		inputObj.date=$("#date input").val();
		inputObj.riqi=$("#riqi input").val();
		inputObj.address=$("#address input").val();
		subName=subDoblur();
		subPhone=subBrblur();
		if(!subName||!subPhone){
			return false;
			}
		$.post("__URL__/addUser",inputObj,function(data){
			if(data==0){
				//$this->success("添加成功客服会联系您!",U('www.baidu.com'));
				alert("添加成功客服会联系您!");
				 window.location.href="http://m.mumway.com/demo/js_api_call.php/";
				}else{
				alert("添加失败!");	
					}
                });
		 return false;
		});
	})
function doblur() {
	var name=document.getElementById('name').value;
	var reg=new RegExp('^[\u4E00-\u9FFF]+$');
	if(reg.test(name)==false) {
		document.getElementById('sname').innerHTML='姓名请输入中文';
	}else{
		document.getElementById('sname').innerHTML='';
		}
}
function subDoblur() {
	var name=document.getElementById('name').value;
	var reg=new RegExp('^[\u4E00-\u9FFF]+$');
	if(reg.test(name)==false) {
		alert('请输入姓名!');
		return false;
	}
	return true;
}	
function brblur() {
	var phoneNumber=document.getElementById('phoneNumber').value;
	var reg=new RegExp('^1[3|4|5|8][0-9]{9}$');
	if(!reg.test(phoneNumber)) {
		document.getElementById('sphone').innerHTML='请输入正确的手机号';
	}else{
		document.getElementById('sphone').innerHTML='';
		}
}
function subBrblur() {
	var phoneNumber=document.getElementById('phoneNumber').value;
	var reg=new RegExp('^1[3|4|5|8][0-9]{9}$');
	if(!reg.test(phoneNumber)) {
		alert('请输入手机号码!');
		return false;
	}
	return true;
}	
</script>