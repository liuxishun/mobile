<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/wode/css/style.css">
    <style type="text/css">
    @font-face {
	font-family: "iconfont";
	src: url('/Public/ke/font/iconfont.eot');
	src: url('/Public/ke/font/iconfont.eot?#iefix') format('embedded-opentype'), /* IE6-IE8 */
	url('/Public/ke/font/iconfont.woff') format('woff'), /* chrome, firefox */
	url('/Public/ke/font/iconfont.ttf') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+*/
	url('/Public/ke/font/iconfont.svg#iconfont') format('svg');
	/* IE9*/
	/* iOS 4.1- */
}

.iconfont {
	font-family: "iconfont" !important;
	font-style: normal;
	-webkit-font-smoothing: antialiased;
	-webkit-text-stroke-width: 0.2px;
	-moz-osx-font-smoothing: grayscale;
}
    footer {
	position: fixed;
	bottom: 0;
	left: 0;
	z-index: 999;
	width: 640px;
	height: 106px;
	background-color: #fff;
	border-top: 1px solid #d8d8d9;
}

footer ul {
	width: 100%;
	height: 100%;
}

footer ul li {
	width: 33.3%;
	height: 100%;
	float: left;
	text-align: center;
	padding-top: 10px;
}

footer ul li > a {
	display: block;
	width: 100%;
	height: 100%;
	position: relative;
	color: #999999;
}
footer ul li > a div {
	width: 60px;
	height: 60px;
	border-radius: 50%;
	background-color:#fff;
	line-height: 60px;
	text-align: center;
	color: #fff;
	position: absolute;
	top: 0px;
	left: 50%;
	margin-left: -30px;
	border:2px solid #5651b6;
}
footer ul li > a i{ font-size:40px; display:block; color:#5651b6;}
footer ul li.fuli > a>i{ color:#F00; font-size:85px; margin-top:-50px;}
footer ul li > a span {
	display: block;
	padding-top: 65px;
	font-size: 20px;
	color:#564fb9;
}

footer ul li.current > a div{ }
footer ul li.current > a div i{ color:#fff;}
footer ul li.fuli > a > div{
	width: 90px;
	height: 90px;
	border-radius: 50%;
	line-height: 90px;
	top: -30px;
	margin-left: -45px;
	border:2px solid #ff1d38;
	
	
	}
footer ul li.fuli > a > div i{ color:#ff1d38; font-size:50px;}
footer ul li.fuli > a span{ color:#ff1d38; padding-top:60px;}
    
    </style>
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
    <script src="__PUBLIC__/ke/wode/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$('.top_choice li:last').css('borderRight',0);
			$('.choose_con>li:last a').css('borderRight',0);
			$('.choose_con>li').click(function(e) {
                $(this).addClass('current').siblings().removeClass('current');
            });
						
			
		});
		
		function dofor(){
			if(<?php echo ($ji); ?>){
				return true;
			}else{
				if (confirm("你不是班长，点击确定成为班长?")) {
					//location.href='__URL__/banbaoming?openid=<?php echo ($openid); ?>';
					$('.wodid').show();
					return false;
				}else {
					return false;
				}
			}
		}
		
		function add(){
			var name = $('#name').val();
			var phone = $('#phone').val();
			if(name == '' || phone == ''){
				alert('名称和电话不能为空');
				return false;
			}
			return true;
		}
    </script>
    
</head>

<body style="background-color: #f3f3f3; " >
    <section class="section" >
        <div class="monitor">
        	<img class="monitor_img" src="<?php echo ($arr["headimgurl"]); ?>" onerror="this.src='__PUBLIC__/ke/wode/img/img4.jpg'">
            <div class="monitor_d1">
            	<P class="monitor_d1_p1"><?php echo ($arr["nickname"]); ?>ID:<?php echo ($arr["id"]); ?></P>
            	<?php if($ji == 1 ): ?><P class="monitor_d1_p1"><img src="__PUBLIC__/ke/wode/img/hhr_03.png">普通合伙人</P>
                	<P class="monitor_d1_p1"><a href="__URL__/banhuiyuan?openid=<?php echo ($openid); ?>">查看合伙人特权</a></P>
				<?php else: ?>
					<P class="monitor_d1_p1" style="color:#8c8c8c;"><img src="__PUBLIC__/ke/wode/img/whhr.png">您还不是合伙人</P>
	                <P class="monitor_d1_p1"><a href="__URL__/banhuiyuan?openid=<?php echo ($openid); ?>">查看合伙人特权</a></P>
	                <P class="monitor_d1_pp"><a href="__URL__/banbaoming?openid=<?php echo ($openid); ?>" onclick="$('.wodid').show();return false;">成为合伙人</a></P><?php endif; ?>
                
            </div>	
        </div>
        <div class="monitor1">
        	<P class="monitor1_p1">您是由<span> <?php echo ($arr["ban"]); ?> </span>推荐</P>
            <P class="monitor1_p2">
            	<a href="__URL__/banfen2?openid=<?php echo ($openid); ?>" style=" border-right:2px solid #e8e8e8; ">
                	<span style=" color:#f472c8; text-align:center; width:40%; line-height:42px; ">我的粉丝<i style="font-style:normal; color: #f472c8; font-size:30px;"> <?php echo ($fencount); ?> </i>个<br><font style=" color:#555555;">销售额<i style="font-style:normal; font-size:24px;"> <?php echo $zjine?$zjine:0; ?> </i>元</font></span></a>
            	<a href="__URL__/bantixian?openid=<?php echo ($openid); ?>"><span style=" color:#f472c8;"><i style="font-style:normal;font-size:30px;"><?php echo $arr['jine']?$arr['jine']:0; ?></i> 元</span><br>我的奖励</a>
           		<!--  -->
            </P>
        </div>
        <ul class="monitor_ul">
        	<li><a href="__URL__/banma?openid=<?php echo ($openid); ?>" onclick="return dofor();"><img src="__PUBLIC__/ke/wode/img/h1.png">我的二维码</a></li>
        	<li><a href="__URL__/bantui"><img src="__PUBLIC__/ke/wode/img/h2.png">如何推广</a></li>
        	<!-- 
            <li><a href="#"><img src="__PUBLIC__/ke/wode/img/h3.png">推单赚钱</a></li>
             <li><a href="#"><img src="__PUBLIC__/ke/wode/img/h5.png">合伙人特权</a></li>
             -->
            <li><a href="tel:15811553601"><img src="__PUBLIC__/ke/wode/img/h4.png">联系客服</a></li>
            <li><a href="__URL__/msbm1?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/ke/wode/img/h5_ms.png">面授报名</a></li>
        </ul>
    </section>
<div class="wodid" style="display:none; position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.3); z-index:9999; ">   
    <div style="width:500px; margin:30% auto; padding:30px; background:#fff; border-radius:15px;">
    	<P style="font-size:26px; color:#999; line-height:50px; text-align:right;"><span class="weihu_span" onclick="javascript:$('.wodid').hide();">×</span></P>
        <form action="__URL__/baoming" method="post" onsubmit="return add()">
        	<input type="hidden" name="openid" value="<?php echo ($openid); ?>">
        	<p style="overflow:hidden; margin-bottom:20px; margin-top:10px;"><span style="font-size:26px; color:#565656; line-height:50px; width:150px; text-align:right; float:left;">姓名：</span><input type="text" id="name" name="name" style="height:50px; border:1px solid #d5d5d5; width:240px; float:left; padding-left:10px; font: 22px Arial;"></p>
        	<p style="overflow:hidden; margin-bottom:20px;"><span style="font-size:26px; color:#565656; line-height:50px;width:150px; text-align:right; float:left;">电话：</span><input type="text" id="phone" name="phone" style="height:50px; border:1px solid #d5d5d5; width:240px; float:left; padding-left:10px; font: 22px Arial;"></p>
        	<p style="overflow:hidden; margin-bottom:20px;"><span style="font-size:26px; color:#565656; line-height:50px;width:150px; text-align:right; float:left;">所在城市：</span><input type="text" name="dizhi" style="height:50px; border:1px solid #d5d5d5; width:240px; float:left; padding-left:10px; font: 22px Arial;"></p>
        	<input style=" margin-left:150px; color:#fff; font-size:26px; background:#606060; border:none; border-radius:13px; height:50px; line-height:50px; width:120px; margin-top:20px;" type="submit" value="提 交">
        </form>
    </div>
</div> 
	<footer>
        <ul>
            <li><a href="__URL__/jy_zhibo?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
             <li class="current">
            <!--60元课程福利
                <a href="__ROOT__/fuli/fuli.php?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe602;</i></div><span>福利</span></a>
             	中秋活动转盘抽奖__ROOT__/prize/index/index.php?openid=<?php echo ($openid); ?>
              -->
                <a href="__URL__/banzhang?openid=<?php echo ($openid); ?>"><div style="border:none;"><img style="width:100%;"alt="" src="/Public/ke/img/ban2.png"></div><span>班长</span></a>
              
            </li>
            <!-- 
            <li><a href="__ROOT__/index.php/ke/jiuye/openid/<?php echo ($openid); ?>"><div style="border:none;"><img style="width:100%;" alt="" src="/Public/ke/img/jiu1.png"></div><span>就业</span></a></li>
             -->
            <li><a href="__URL__/wode?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
            <div class="clear"></div>
        </ul>
    </footer>
</body>
</html>