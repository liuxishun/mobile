<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/aj/wode/css/style.css">
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
    .hb1_p1{ overflow:hidden; margin-bottom:18px;}
	.hb1_p1 span{ float:left; text-align:right; width:113px; font-size:22px; color:#373737; line-height:62px; padding-right:13px;}
	.hb1_p1 input{ float:left; width:350px; height:62px; border:2px solid #e2e2e2; border-radius:7px; background:#f8f8f8; line-height:58px; padding-left:10px; font-size:22px; color:#373737;}
    </style>
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
			$('.choose_con>li:last a').css('borderRight',0);
			$('.choose_con>li').click(function(e) {
                $(this).addClass('current').siblings().removeClass('current');
            });
						
			
		});
		
		function dofor(){
			if(<?php echo ($ji); ?>){
				return true;
			}else{
				alert("你还不是合伙人");
				return false;
				/*
				if (confirm("你不是合伙人，点击确定成为合伙人?")) {
					$('.haibao1').show();
					return false;
				}else {
					return false;
				}*/
			}
		}
		
		function add(){
			var name = $('#name').val();
			var phone = $('#phone').val();
			var dizhi = $('#dizhi').val();
			if(name == ''){
				alert('名称不能为空');
				return false;
			}
			if(!(/^1[34578]\d{9}$/.test(phone))){ 
			    alert("手机号码有误，请重填");  
			    return false;
			}
			if(dizhi == ''){
				alert('所在城市不能为空');
				return false;
			}
			var dt={};
			dt.name = name;
			dt.phone = phone;
			dt.dizhi = dizhi;
			dt.openid = $('#openid').val();;
			
			$.post('__URL__/baoming',dt,function(e){
				if(e == 1){
					$('.haibao').show();
					$('.haibao1').hide();
				}else{
					alert('提交失败');
				}
			});
			return false;
		}
    </script>
    
</head>

<body style="background-color: #f3f3f3; " >
    <section class="section" >
        <div class="monitor">
        	<img class="monitor_img" src="<?php echo ($arr["headimgurl"]); ?>" onerror="this.src='__PUBLIC__/aj/wode/img/img4.jpg'">
            <div class="monitor_d1">
            	<P class="monitor_d1_p1"><?php echo ($arr["nickname"]); ?>ID:<?php echo ($arr["id"]); ?></P>
            	<?php if($ji == 1 ): ?><P class="monitor_d1_p1"><img src="__PUBLIC__/aj/wode/img/hhr_03.png">普通合伙人</P>
                	<P class="monitor_d1_p1"><a href="__URL__/banhuiyuan?openid=<?php echo ($openid); ?>">查看合伙人特权</a></P>
				<?php else: ?>
					<P class="monitor_d1_p1" style="color:#8c8c8c;"><img src="__PUBLIC__/aj/wode/img/whhr.png">您还不是合伙人</P>
	                <P class="monitor_d1_p1"><a href="__URL__/banhuiyuan?openid=<?php echo ($openid); ?>">查看合伙人特权</a></P>
	                <P class="monitor_d1_pp" style="display:none;"><a href="__URL__/banbaoming?openid=<?php echo ($openid); ?>" onclick="$('.haibao1').show();return false;">成为合伙人</a></P><?php endif; ?>
                
            </div>	
        </div>
        <div class="monitor1">
        	<P class="monitor1_p1">您是由<span> <?php echo ($arr["ban"]); ?> </span>推荐</P>
            <P class="monitor1_p2">
            	<a href="__URL__/banfen3?openid=<?php echo ($openid); ?>" style=" border-right:2px solid #e8e8e8; ">
                	<span style=" color:#555555; text-align:center; width:40%; line-height:42px; ">我的粉丝<i style="font-style:normal; color: #f23030; font-size:30px;"> <?php echo ($fencount?$fencount:0); ?> </i>个<br><font style=" color:#555555;display:none;">销售额<i style="font-style:normal; font-size:24px;"> <?php echo ($zjine?$zjine:0); ?> </i>元</font></span>
                </a>
            	<a href="__URL__/bantixian?openid=<?php echo ($openid); ?>"><span style="color:#f23030;display:none;">
            		<i style="font-style:normal;font-size:30px;"><?php echo $arr['jine']?$arr['jine']:0; ?></i> 元</span>我的奖励
            	</a>
            </P>
        </div>
        <ul class="monitor_ul">
        	<li><a href="__URL__/banma?openid=<?php echo ($openid); ?>" onclick="return dofor()"><img src="__PUBLIC__/aj/wode/img/h1.png">我的二维码</a></li>
        	<li><a href="__URL__/report?openid=<?php echo ($openid); ?>"><img src="__PUBLIC__/aj/wode/img/h5.png">提成查询</a></li>
        	<!-- 
        	<li><a href="__URL__/bantui"><img src="__PUBLIC__/aj/wode/img/h2.png">如何推广</a></li>
            <li><a href="#"><img src="__PUBLIC__/aj/wode/img/h3.png">推单赚钱</a></li>
             <li><a href="#"><img src="__PUBLIC__/aj/wode/img/h5.png">合伙人特权</a></li>
             -->
            <li><a href="tel:13621102708"><img src="__PUBLIC__/aj/wode/img/h4.png">联系客服</a></li>
           
        </ul>
    </section>
<!-- 注册成为合伙人 
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
-->
<!-------------------------海报1------------------------------------------>
<div class="haibao" style=" position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.3); z-index:9999; display:none; ">   
    <div style="width:572px; margin:10% auto 0; height:906px; background:url(__PUBLIC__/aj/wode/img/bz_03.png) no-repeat; position:relative; ">
    	<P style=" padding:25px; text-align:right;"><span class="weihu_span" onclick="javascript:$('.haibao').hide();"><img src="__PUBLIC__/aj/wode/img/cha_03.png"></span></P>
        <P style="width:100%; text-align:center; position:absolute; bottom:40px; left:0;"><a href="http://m.ijiaguanjia.com/huod/tgewm?openid=<?php echo ($openid); ?>" style="width:450px; height:96px; line-height:96px; display:inline-block; font-size:36px; color:#d2b490; text-align:center; font-weight:bold; background:#d93d4f; border-radius:9px;">体验爱家大使</a></P>
    </div>
</div>
<!-------------------------海报2------------------------------------------>
<div class="haibao1" style=" position:fixed; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.3); z-index:9999; display:none; ">   
    <div style="width:572px; margin:10% auto 0; height:906px; background:#f5f1e5 url(__PUBLIC__/aj/wode/img/bz2_11.png) no-repeat left bottom; border-radius:12px; position:relative; ">
    	<P style=" padding:25px; text-align:right;"><span class="weihu_span" onclick="javascript:$('.haibao1').hide();"><img src="__PUBLIC__/aj/wode/img/bz1_03.png"></span></P>
        <P style="text-align:center; margin:10px 0 30px;"><img src="__PUBLIC__/aj/wode/img/bz1_07.png"></P>
        <P style="text-align:center; font-size:22px; color:#373737; line-height:36px;">登录您的账号，生成并分享您的专属海报<br>每位朋友识别二维码关注爱家管家公众号</P>
        <P style=" font-size:22px; color:#d93d4f; text-align:center; margin-bottom:10px;">您即可获得<span style="font-size:32px;">  ¥1 现金红包</span></P>
    	<P style=" font-size:22px; color:#373737; text-align:center;  line-height:36px;">购买并激活任意保洁服务您还将从获得   <span style="color:#d93d4f;">一份爱家奖金<br>推荐越多，福利越多！</span></P>
        <form action="__URL__/baoming" method="post" onsubmit="return add()">
        	<input type="hidden" id="openid" name="openid" value="<?php echo ($openid); ?>">
        	<div style=" width:463px; margin:30px auto; overflow:hidden;">
            	<P class="hb1_p1"><span>姓名</span><input type="text" id="name" name="name" placeholder="例：张先生、王小姐"></P>
                <P class="hb1_p1"><span>手机号码</span><input type="text" id="phone" name="phone" placeholder="例：13800000000"></P>
                <P class="hb1_p1"><span>所在城市</span><input type="text" id="dizhi" name="dizhi" placeholder="例：北京市"></P>
        		<input type="submit" value="生成专属海报" style="width:463px; height:62px; line-height:62px; display:inline-block; font-size:26px; color:#fff; border:none; background:#d93d4f; border-radius:9px; margin-top:22px;">
            </div>
        </form>
    </div>
</div>

</body>
</html>