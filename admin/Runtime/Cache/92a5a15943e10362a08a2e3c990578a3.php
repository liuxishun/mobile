<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="__PUBLIC__/admin/css/admin_style.css" type="text/css" rel="stylesheet" />
</head>

<body>

<div class="add_tit cl">
    <span class="l">位置：<a href="">管理平台</a><b>系统消息</b></span>
</div>


<div class="right">
<div class="w810 l">

        <div class="con_box">
          <table class="i_mes_table">
            <?php if(is_array($server_info)): foreach($server_info as $key=>$vo): ?><tr>
              <th scope="col"><?php echo ($key); ?></th><td><?php echo ($vo); ?></td>
            </tr><?php endforeach; endif; ?>										
          </table>

        </div>
      </div>
</div>      
</body>
</html>