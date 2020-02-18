<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }

.bug_block { width:516px; height:400px; padding:150px 0px 0px; margin:0 auto; }
.bug_outside { width:510px; height:220px; padding:1px; background:#CCCCCC; border:2px solid #f5f5f5; }
.bug_inside { width:504px; height:134px; border:3px solid #FFFFFF; border-bottom:none; background:#dfedfa; padding:50px 0px 0px 0px; }
.bug_inside img { margin:0px 20px 0px 40px; float:left; }
.bug_inside p { font-size:14px; color:#666666; float:left; line-height:28px; margin-top:8px; }
.bug_inside h1{ color:#FF0000; line-height:28px; font-size:16px;}
.bug_inside h1.ok{color:green;}
.bug_insides { border:3px solid #FFFFFF; border-top:none; background:#cde4fa; padding-top:9px; text-align:right; height:21px; }
.bug_insides a { padding-right:20px; }

</style>
</head>
<body>


<div class="bug_block"><div class="bug_outside">
    <div class="bug_inside">
        <?php if(isset($message)): ?><img src="__PUBLIC__/common/images/blog_ok.jpg" width="67" height="67">
        <div class="pic-r">
            <h1 class="ok"><?php echo($message); ?></h1>
            <p>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></p>
        </div>
        <?php else: ?>
        <img src="__PUBLIC__/common/images/blog_bug.jpg" width="67" height="67">
        <div class="pic-r">
            <h1 class="error"><?php echo($error); ?></h1>
            <p>页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></p>
        </div><?php endif; ?>
    </div>
    <div class="bug_insides">
        <!--<a class="blue" href="javascript:history.go(-1);">返回上一页</a>
        <a class="grayfont" href="#">首页</a>-->
    </div>
</div></div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>

</body>
</html>