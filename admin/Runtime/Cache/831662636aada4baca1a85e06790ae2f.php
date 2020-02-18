<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__PUBLIC__/admin/css/admin_style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="__PUBLIC__/admin/js/jquery-1.6.2.min.js"></script>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/index.css">
</head>
<script type="text/javascript">
	$(document).ready(function(){
		counts.switchChannel('sys');
	});
	
var counts = {
	current_channel:null,
	switchChannel:function(channel){
		if(counts.current_channel==channel){
			return false;
		}
		$('#channel_'+counts.current_channel).removeClass('this');
		$('#channel_'+channel).addClass('this');
		counts.current_channel=channel;
	}	
}
</script>
<body class="body_1">
<!--<div class="top">
<div class="rightbg">
<div class="header leftbg">-->

     <!-- <div class="cl">
        <div></div>
        <div class="time l"><?php echo date("Y",time());?>年<?php echo date("m",time());?>月<?php echo date("d",time());?>日 礼拜<?php $weekarray=array("日","一","二","三","四","五","六"); echo $weekarray[date("w",time())];?></div>
        <div class="login l">登录名：<span><?php echo ($admin["username"]); ?></span>高级管理员</div>
        <div class="gl_mes l">
          <span class="gl_01"><a href="__ROOT__/index.php" target="_blank">网站首页</a></span> 
          <span class="gl_03"><a href="__APP__/Public/logout/" target="_parent">注销</a></span> 
        </div>
      </div>
      <div class="nav cl" >
      <?php if(is_array($Channel)): $i = 0; $__LIST__ = $Channel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="__URL__/left#<?php echo ($key); ?>" target="leftFrame" id="channel_<?php echo ($key); ?>"  onclick="counts.switchChannel('<?php echo ($key); ?>');" <?php if($key == 'sys'): ?>class="this"<?php endif; ?> ><?php echo ($vo); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
      </div> -->
	 

<div class="header_nva">
		<img src="__PUBLIC__/index/images/abc_02.png">
		<ul class="header_nva_list" id="list_1">
           <?php if(is_array($Channel)): $i = 0; $__LIST__ = $Channel;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="__URL__/left#<?php echo ($key); ?>" target="leftFrame" id="channel_<?php echo ($key); ?>" class="<?php if($key=='sys') echo 'active_3'; ?>" onclick="counts.switchChannel('<?php echo ($key); ?>');"><?php echo ($vo); ?></a> </li><?php endforeach; endif; else: echo "" ;endif; ?>
			  
<!--<?php print_r($Channel);?>-->
		</ul >
		<ul class="header_nva_list2">
			<li>你好，<span><?php echo ($admin["username"]); ?></span></li>
			<li><a href="#">企业邮箱</a><span>(200)</span>|</li>
			<li><a href="#">免费注册</a>|</li>
			<li><a href="__APP__/Public/logout/">退出</a></li>
		</ul>
	</div>

   <!-- </div>
	
    </div>
</div> -->



	
	
		
	<script type="text/javascript" src="__PUBLIC__/index/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/index/js/index_1.js"></script>
</body>
</html>