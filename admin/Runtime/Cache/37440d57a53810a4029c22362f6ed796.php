<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__PUBLIC__/admin/css/admin_style.css" type="text/css" rel="stylesheet" />
<script src="__PUBLIC__/admin/js/jquery-1.6.2.min.js"></script> 
<script src="__PUBLIC__/admin/js/prototype.lite.js" type="text/javascript"></script>
<script src="__PUBLIC__/admin/js/moo.fx.js" type="text/javascript"></script>
<script src="__PUBLIC__/admin/js/moo.fx.pack.js" type="text/javascript"></script>
<style type="text/css">
html{height:100%; overflow:hidden;}
body{height:100%; overflow:hidden;}
</style>
</head>	
<body>
<div class="left cl" style="height:100%;">
	<div class="s_bar r w150"> 
		<div class="s_line"></div>
		    <div id="container">
		    <?php foreach($Menu as $menu_1_name => $menu_2) { ?>

		    <!--一级-->
			    <div id="root_<?php echo ($menu_1_name); ?>" style="display:none;">
			    <!--二级-->
			     <?php foreach($menu_2 as $menu_2_name => $menu_3) { ?>
			      <h1 class="nav-type" id="clicke"><a href="javascript:void(0)" onclick=""><?php echo ($menu_2_name); ?></a></h1>
			      <div class="content">
			        <ul class="MM">
			        <?php $x =0; $y =0; foreach($menu_3 as $menu_3_name => $menu_3_url) { $y++; $x++; ?>
			          <li id="cClass_<?php echo ($y); ?>"><a href="<?php echo ($menu_3_url); ?>" target="mainFrame"><?php echo ($menu_3_name); ?></a></li>
			         <?php } ?>


			        </ul>
			      </div>
			     <?php } ?>
			     </div>
  			<?php } ?>




	<!--<div class="index_con_nav">


				<ul class="index_con_nav_list" id="list_2">
					<li> <a href="#" class="active_1" > 首页</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
					<li> <a href="#"> 家政员</a></li>
				</ul>





			</div>
-->





<script type="text/javascript">
var roots = jQuery('div[id^="root_"]');
roots.hide();
roots.eq(0).show();

var contents = document.getElementsByClassName('content');
var toggles = document.getElementsByClassName('nav-type');


var myAccordion = new fx.Accordion(
	toggles, contents, {opacity: true, duration: 400}
);
myAccordion.showThisHideOpen(contents[0]);





var _hash="";
setInterval(function(){
    var hash=location.hash;
	var rid='#root_'+hash.substring(1);
	if(hash.length>0 && jQuery(rid).length>0 && _hash != rid){
		roots.hide();
		jQuery(rid).show();
		myAccordion.showThisHideOpen(jQuery(rid).find('.content').get(0));
		_hash = rid;
	}

}, 200);
jQuery(function(){
	jQuery('#container li').bind('click', function(){if(jQuery(this).hasClass('this'))return;jQuery('#container li').removeClass('this'),jQuery(this).addClass('this')});
});
</script>

		</div>
	</div>
</div>
</body>
</html>
<script src="__PUBLIC__/index/js/index_1.js" type="text/javascript"></script>