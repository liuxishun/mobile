<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
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
        
        function add(){
        	var phone = document.getElementById('phone').value;
        	if(!(/^1[3-9]\d{9}$/.test(phone))){ 
                alert("手机号码有误，请重填");  
                return false; 
            }
        	return true; 
        }
    </script>
    <style type="text/css">
    	/*页面*/
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
			-moz-box-sizing: border-box;
			-webkit-box-sizing: border-box;
			font-family: "Microsoft YaHei";
		}
		
		body {
			font-family: "Microsoft YaHei";
		}
		.yemian{ text-align:center; font-size:30px; color:#565656; line-height:50px; padding:80px 50px;}
		.yemian span{ color:#ff1547; font-size:40px;}
		
		.yemian_form{ padding:0 50px 0;}
		.yemian_p1{ width:100%; margin-bottom:30px; background:#e2e2e2; border-radius:9px; height:80px; padding:10px 0;}
		.yemian_s1{ width:120px; border-right:1px solid #cacaca; display:inline-block; height:60px; float:left; text-align:center; color:#565656; line-height:60px; font-size:28px; }
		.yemian_p1 input{ width:410px; border:none; outline:none; height:60px; line-height:60px; padding-left:20px; background:#e2e2e2; font-size:26px; color:#565656;font-family:"微软雅黑";}
		.yemian_p3{ width:100%; padding:20px 0 0;}
		.yemian_input1{ width:100%; border:none; background:#5651b7; border-radius:9px; height:80px; line-height:80px; font-size:26px; color:#fff; }
		.yemian_input2{ width:45%; border:none; background:#b0b0b0; border-radius:9px; height:80px; line-height:80px; font-size:26px; color:#808080;}

    </style>
</head>

<body style="background-color: #fff;">
    <section class="section section1">
    	<P class="yemian"><span>*</span>绑定手机号码</P>
        <form class="yemian_form" action="__SELF__" method="post" onsubmit="return add()">
			<input type="hidden" name="openid" value="<?php echo ($openid); ?>">
            <P class="yemian_p1"><span class="yemian_s1">姓名</span><input type="text" id="name" name="name" value="<?php echo ($arr["name"]); ?>" placeholder="请输入姓名" ></P>
            <P class="yemian_p1"><span class="yemian_s1">手机号</span><input type="text" id="phone" name="phone" value="<?php echo ($arr["phone"]); ?>" placeholder="请输入手机号" ></P>
            <P class="yemian_p3"><input style="-webkit-appearance: none;" class="yemian_input1" type="submit" value="确定"><!--<input class="yemian_input2" type="submit" value="取消">--></P>
		</form>
    </section>
    
</body>
</html>