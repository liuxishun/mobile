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
	width: 25%;
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

footer ul li.current > a div{}
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
        <!--百度统计-->
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

    <!--百度统计-->	

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
			
			$('.choose_con>li a').click(function(e) {
				  $('.bgg').show();
          $(this).siblings('ul').show();
				  $(this).parent('li').siblings().children('ul').hide();
          $('body').height($(window).height());
          $('body').css('overflow-y','hidden');
          $('body').css('position','fixed');
          

      });
			$('.bgg').mouseup(function(e) {
				  $('.bgg').hide();
          $('.choose_con ul').hide();
          $('body').css('overflow-y','visible');
          $('body').css('position','static');
          
      });
			$('.choose_con ul li').click(function(e) {
				$(this).parent('ul').siblings('a').html($(this).html());
				$('.bgg').hide();
        $('.choose_con ul').hide();
        $('body').css('position','static');
        $('body').css('overflow-y','visible');
			});
			
		});

    </script>
    
</head>

<body style="background-color: #f3f3f3; " >
<div style="position:fixed; top:0; left:0; background:rgba(0,0,0,0.3);z-index:9999; bottom:0; right:0;display: none;">
	<div class="weihu" style="width:400px;margin:25% auto 0; padding:30px; background:#fff; border-radius:15px;">
        <P style="font-size:30px; color:red; line-height:50px; text-align:center;">正在努力开发...<br>敬请等待</P>
    </div>
</div>
	<header id="header">
        <div id="choose">
        	<ul class="choose_con">
                <li>
                	<a class="sel">全北京</a>
                	<ul>
                    	<li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>">不限</a></li>
                    	<?php if(is_array($shiqu)): foreach($shiqu as $key=>$li): ?><li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/gz_city/<?php echo ($li["id"]); ?>"><?php echo ($li["name"]); ?></a></li><?php endforeach; endif; ?>
                    </ul>
                
                </li>
                <li>
                	<a class="sel">薪资</a>
                	<ul>
                    	<li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>">不限</a></li>
                    	<?php if(is_array($gongzi)): foreach($gongzi as $key=>$li): ?><li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/gz_payfee/<?php echo ($li["id"]); ?>"><?php echo ($li["payfee"]); ?></a></li><?php endforeach; endif; ?>
                  </ul>
                
                </li>
                <li>
                	<a class="sel">工作经验</a>
                	<ul>
                    	<li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>">不限</a></li>
                    	<li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/刚学完">刚学完</a></li>
                    	<li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/1年">1年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/2年">2年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/3年">3年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/4-5年">4-5年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/6年">6年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/7-8年">7-8年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/9年">9年</a></li>
                      <li><a href="__URL__/jiuye/openid/<?php echo ($openid); ?>/exprience/10年以上">10年以上</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
	<div class="bgg"></div>
    <section class="section" >
        <ul class="job_item">
        <?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
                 <a class="a">
                     <div class="job_info">
                         <p><img src="http://m2.mumway.com/<?php echo ($li["pic"]); ?>" class="job_img" /></p>
                         <P><?php echo ($li["username"]); ?></P>
                     </div>
                     
                     <div class="job_info1">
                         <h3><?php echo ($li["gz_comment"]); ?></h3>
                         <span class="new-price"><?php echo ($li["payfee"]); ?>元/月</span>
                         <p class="job_ul_p"><span>已有<?php echo ($li["count"]); ?>人接单</span> | <span><?php echo ($li["updatetime"]); ?></span></p>
                         <span class="job_button">月嫂单</span>
                     </div>
                 </a>
                 <P class="face_to_face_p3 job_p3"><a class="face_to_face_p3_a1" href="tel:<?php echo ($li["phone"]); ?>">电话咨询</a><a class="face_to_face_p3_a2" href="__URL__/jianli/openid/<?php echo ($openid); ?>/gid/<?php echo ($li["id"]); ?>">我要接单</a></P>
             </li><?php endforeach; endif; ?>
        </ul>
        <P id="geng" style="font-size:26px; text-align:center; line-height:80px; color:#666;" onclick="toufen()">点击查看更多</P>
        <script type="text/javascript">
	        var beg = 0;//分页
	    	function toufen(){
	    		beg++;
	    		var ul = '__URL__/jiuye/beg/'+beg+'/openid/<?php echo ($openid); ?>/gz_city/<?php echo ($par["gz_city"]); ?>/gz_payfee/<?php echo ($par["gz_payfee"]); ?>/exprience/<?php echo ($par["exprience"]); ?>';
	    		$.get(ul,function(e){
	    			$(".job_item").append(e);
	    		})
	    	}
        </script>
    </section>
    	<footer>
        <ul>
            <li><a href="__URL__/quzheng?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe601;</i></div><span>学习</span></a></li>
             <li>
            <!--60元课程福利
                <a href="__ROOT__/fuli/fuli.php?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe602;</i></div><span>福利</span></a>
             	中秋活动转盘抽奖__ROOT__/prize/index/index.php?openid=<?php echo ($openid); ?>
              -->
                <a href="__URL__/banzhang?openid=<?php echo ($openid); ?>"><div style="border:none;"><img style="width:100%;"alt="" src="/Public/ke/img/ban1.png"></div><span>班长</span></a>
              
            </li>
            <li class="current"><a href="__ROOT__/index.php/ke/jiuye/openid/<?php echo ($openid); ?>"><div style="border:none;"><img style="width:100%;" alt="" src="/Public/ke/img/jiu2.png"></div><span>就业</span></a></li>
            
            <li><a href="__URL__/wode?openid=<?php echo ($openid); ?>"><div><i class="iconfont">&#xe600;</i></div><span>我的</span></a></li>
            <div class="clear"></div>
        </ul>
    </footer>
</body>
</html>