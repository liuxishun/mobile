<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php if($no_style!=1){ ?>
<link href="__PUBLIC__/admin/css/admin_style.css" type="text/css" rel="stylesheet" />
<?php } ?>
<script src="__PUBLIC__/admin/js/jquery-1.6.2.min.js"></script>
<script src="__PUBLIC__/admin/js/main.js?t=20151002"></script>
<script>
var PUBLIC = '__PUBLIC__';
var CFG_CACHE_URL = '__APP__/index/cache';
</script>
<title><?php $_title='';echo $page_title? $page_title : ($page_sub_title? $page_sub_title . '-' . $_title : $_title); ?></title>

<?php if(in_array('filespace', $include) || in_array('artDialog', $include)){ ?>
<script type="text/javascript" src="__PUBLIC__/artDialog/artDialog.js?skin=default"></script>
<script type="text/javascript" src="__PUBLIC__/artDialog/plugins/iframeTools.js"></script>
<?php } ?>

<?php if(in_array('filespace', $include)){ ?>
<script type="text/javascript" src="__PUBLIC__/filespace/filespace.js"></script>
<script>
function myfilespace(opt){
    $.extend(opt, {fileManagerJson:'__APP__/index/file_manager_json',uploadJson:'__APP__/index/upload_json',extraFileUploadParams:$.extend(opt.extraFileUploadParams||{}, {"PHPSESSID":'<?php echo session_id(); ?>'}),folderManagerJson:'__APP__/index/folder_manager_json',pluginsPath:'__PUBLIC__/filespace'});
    return filespace(opt);
}
</script>
<?php } ?>

<?php if(in_array('colorpicker', $include)){ ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/colorpicker/colorpicker.css" />
<script type="text/javascript" src="__PUBLIC__/colorpicker/colorpicker.js"></script>
<?php } ?>

<?php if(in_array('template', $include)) { ?>
<script type="text/javascript" src="__PUBLIC__/template/template-simple.js"></script>
<?php } ?>

<?php if(in_array('easyui', $include)) { ?>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/default/easyui.css" />
<link rel="stylesheet" type="text/css" href="__PUBLIC__/easyui/themes/icon.css" />
<script type="text/javascript" src="__PUBLIC__/easyui/jquery.easyui.min.js"></script>
<style>
.fm{margin:0;padding:10px 30px;}
.ftitle{font-size:14px;font-weight:bold;padding:5px 0;margin-bottom:10px;border-bottom:1px solid #ccc;}
.fitem{margin-bottom:5px;}
.fitem label{display:inline-block;width:80px;vertical-align:top;}
.fitem input[type=text]{min-width:150px;border:1px solid #d9d9d9;}
.fitem textarea{min-width:150px;min-height:50px;border:1px solid #d9d9d9;}
</style>
<?php } ?>

</head>
<body>
<div class="right">
	<div class="w810 l">
		<div class="add_tit cl">
			<span class="l">位置：<a href="__APP__/Index/right">管理平台</a><b>用户权限组修改</b></span>
		</div>

        <div class="con_box">
			<form method="post" action="__SELF__" id="form" name="form">
				<table  class="add_table">
					<tr>
						<th>用户名：</th>
						<td><?php echo ($username); ?></td>
					</tr>
					<tr>
						<th>角&nbsp;&nbsp;色：</th>
						<td>
						    <select name="role_id">
								<option value="">请选择</option>
								<?php if(is_array($rlist)): foreach($rlist as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($val['check_role'])echo 'selected'; ?>><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
							</select>
						</td>
					</tr>
					<tr>
						<th></th>
						<td>
							<input type="hidden" name="id" value="<?php echo ($userid); ?>" />
							<input type="hidden" name="listurl" value="<?php echo ($listurl); ?>"/>
							<input type="submit" value="" class="add_yes">
							<a href="__URL__/lists" class="add_no"></a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
</body>
</html>