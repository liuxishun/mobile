<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台系统首页</title>
</head>
<frameset rows="109,*" cols="*" frameborder="no"  border="0" framespacing="0">
  <frame src="__APP__/Index/top" id="topFrame" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset cols="160,7,*"  frameborder="no" border="0" framespacing="0" id="frame-body">
    <frame src="__APP__/Index/left" id="menu-frame" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
	<frame src="__APP__/Index/drag" id="drag-frame" name="drag" frameborder="no" scrolling="no">
    <frame src="__APP__/Index/right" id="main-frame" name="mainFrame" title="mainFrame" />

  </frameset>
  <frame src="__APP__/Index/foot" id="footFrame" name="footFrame" scrolling="No" noresize="noresize" id="footFrame" title="footFrame" />
</frameset>
<noframes><body>
</body></noframes>

</html>