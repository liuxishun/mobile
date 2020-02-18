<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo ($info['title']); ?></title>
	<meta name="format-detection" content="telephone=no" />
	<!--meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" /-->
        <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/weixin/css/public.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/weixin/css/style.css">
        <style>
            #shows > img{
                width:100%;
            }
            .D2_Qlis{
                padding:0px;
            }
            .D2_Qlis >li >.woed {
                padding: 0px;
         }
        </style>
</head>
<body class="bodyback">
	<div class="D2_header">
		<img src="http://m.mumway.com/<?php echo ($info['pic2']); ?>">
      
		<div class="word">
			<h3><?php echo ($info['title']); ?></h3>
			<p><?php echo ($info['lange']); ?>分</p>
			<a class="fenxiang" href="#">分享</a>
		</div>
		<div class="jiage">
			<span class="span01">￥<?php echo ($info['price_desc']); ?></span>
			<span class="span02">冰点价</span>
			<span class="span03">院线价：￥<?php echo ($info['market_price']); ?></span>
		</div>
	</div>
	<!--div class="D2_Youhui">
		<h3>优惠项目</h3>
		<ul>
			<li>
				<span class="span01">赠</span>
				<span class="span02"><?php echo ($info['cuxiao']); ?></span>
				<span class="span03 backimg01"></span>
				<div class="clear"></div>
			</li>
		</ul>
	</div-->

	<ul class="D2_Qlis" style="margin-bottom:50px;">
            <?php $t = 1 ; ?>
            <?php if(is_array($newArr)): foreach($newArr as $key=>$v): ?><li>
			<div class="head"><span><?php echo $t++ ; ?></span><h3><?php echo ($v["0"]); ?></h3></div>
			<div class="woed" id="shows" style="width:100%;">
				<?php echo ($v["1"]); ?>
			</div>
		</li><?php endforeach; endif; ?>
	</ul>
	<div class="D2_lianxi" style="position:fixed;bottom: 0px;left:0px;padding-top:0px;margin-bottom: 10px;">
		<a href="tel:4000098566"> <em>电话预约</em><br/><span>400-009-8566</span></a>
                <?php $title = $info['title']; ?>
                <a class="rig" href="<?php echo U('Service/pages',array('title'=>$title));?>"><em>在线支付</em> <br/><span>online Reservation</span></a>
		<div class="clear"></div>
	</div>
</body>
</html>
<script language="javascript" src="http://dct.zoosnet.net/JS/LsJS.aspx?siteid=DCT20072801&float=1&lng=cn"></script>