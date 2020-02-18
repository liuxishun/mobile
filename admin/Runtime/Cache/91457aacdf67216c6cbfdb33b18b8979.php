<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title></title>
<?php $include = array('easyui', 'filespace'); ?>
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
<script type="text/javascript" src="__PUBLIC__/laydate/laydate.js"></script>
</head>
<body>
<div class='right'>
	<div class="w810 l">
	<div class="add_tit cl">
			<span class="l">位置：<a href="__APP__/Index/right">管理平台</a><b>评论添加</b></span>
		</div>
		<div class="con_box">
		<form action="__SELF__" method='post' id='form'>
			<table class="add_table" id='table'>
				    <tr>
						<th>雇主名称：</th>
						<td><input type="text" name="info[boss]" class="add_input" value="<?php echo ($arr["boss"]); ?>"/></td>
					</tr>

                    <tr>
						<th>服务时间：</th>
						<td><input type="text" name="info[work_time]" class="add_input" value="<?php echo ($arr["work_time"]); ?>"/></td>
					</tr>

                <tr>
				<th>选择阿姨</th>
				<td>
                <?php if($arr['id']>0 || $_GET['h_id']){ ?>
				<?php echo M('houseworker')->where(array('id'=>$arr['h_id']? $arr['h_id']:$_GET['h_id'] ))->getField('title'); ?>
                <input type="hidden" name="info[h_id]" class="add_input" value="<?php echo $arr['h_id']? $arr['h_id']:$_GET['h_id']; ?>"/>
				<?php }else{ ?>
                <select name='info[h_id]'>
				<option value=''>--请选择--</option>
				<?php foreach($list as $val){?>
				<option value='<?php echo $val['id'];?>' <?php if($val['id']==$_GET['h_id'])echo 'selected'; ?>><?php echo $val['title'];?></option>
                </select>
                <?php } ?>
                <?php } ?>
				</td>
				</tr>
				<tr>
						<th>婴儿护理：</th>
						<td>
						<select name='info[yehuli]'>
						<option value=''>--请选择--</option>
						<option value='1' <?php if($arr['yehuli']==1)echo 'selected'; ?>>1颗星</option>
						<option value='2' <?php if($arr['yehuli']==2)echo 'selected'; ?>>2颗星</option>
						<option value='3' <?php if($arr['yehuli']==3)echo 'selected'; ?>>3颗星</option>
						<option value='4' <?php if($arr['yehuli']==4)echo 'selected'; ?>>4颗星</option>
						<option value='5' <?php if($arr['yehuli']==5)echo 'selected'; ?>>5颗星</option>
						</select>
						</td>
				</tr>
				<tr>
						<th>产妇护理：</th>
						<td>
						<select name='info[chhuli]'>
						<option value=''>--请选择--</option>
						<option value='1' <?php if($arr['chhuli']==1)echo 'selected'; ?>>1颗星</option>
						<option value='2' <?php if($arr['chhuli']==2)echo 'selected'; ?>>2颗星</option>
						<option value='3' <?php if($arr['chhuli']==3)echo 'selected'; ?>>3颗星</option>
						<option value='4' <?php if($arr['chhuli']==4)echo 'selected'; ?>>4颗星</option>
						<option value='5' <?php if($arr['chhuli']==5)echo 'selected'; ?>>5颗星</option>
						</select>
						</td>
				</tr>
				<tr>
						<th>与家人相处：</th>
						<td>
						<select name='info[jrxiangchu]'>
						<option value=''>--请选择--</option>
						<option value='1' <?php if($arr['jrxiangchu']==1)echo 'selected'; ?>>1颗星</option>
						<option value='2' <?php if($arr['jrxiangchu']==2)echo 'selected'; ?>>2颗星</option>
						<option value='3' <?php if($arr['jrxiangchu']==3)echo 'selected'; ?>>3颗星</option>
						<option value='4' <?php if($arr['jrxiangchu']==4)echo 'selected'; ?>>4颗星</option>
						<option value='5' <?php if($arr['jrxiangchu']==5)echo 'selected'; ?>>5颗星</option>
						</select>
						</td>
				</tr>
				<tr>
						<th>月子餐口味：</th>
						<td>
						<select name='info[yzckouwei]'>
						<option value=''>--请选择--</option>
						<option value='1' <?php if($arr['yzckouwei']==1)echo 'selected'; ?>>1颗星</option>
						<option value='2' <?php if($arr['yzckouwei']==2)echo 'selected'; ?>>2颗星</option>
						<option value='3' <?php if($arr['yzckouwei']==3)echo 'selected'; ?>>3颗星</option>
						<option value='4' <?php if($arr['yzckouwei']==4)echo 'selected'; ?>>4颗星</option>
						<option value='5' <?php if($arr['yzckouwei']==5)echo 'selected'; ?>>5颗星</option>
						</select>
						</td>
				</tr>
				<tr>
				<th>评论内容：</th>
				<td>
				 <textarea id="editor_1" class="txts" name="info[dianping]"><?php echo ($arr["dianping"]); ?></textarea>
<?php $editor_id = 'editor_1'; ?>
<script src="__PUBLIC__/editor/kindeditor.js"></script>
<script src="__PUBLIC__/editor/lang/zh_CN.js"></script>
<script>
	KindEditor.ready(function(K){
	K.create('#<?php echo $editor_id; ?>', {
	uploadJson: '__APP__/index/upload_json',
	fileManagerJson: '__APP__/index/file_manager_json',
    extraFileUploadParams:{"PHPSESSID":'<?php echo session_id(); ?>'},
	allowFileManager: true,
	afterBlur: function(){this.sync();}
});
});
</script>
				</td>
				</tr>
				
				<tr>
				<th>图片集：</th>
				<td>
				<input type="hidden" id="ctl_pics" name="info[pics]" class="add_input" value="<?php echo implode('|', $pics); ?>" />

<input type="hidden" id="upic">
<a href="javascript:;" onclick="myfilespace({dirName:'houseworker',clickFn:'#upic', extraFileUploadParams:{width:800, height:800, forcecut:0}})">浏览</a>

<div id="show_pics" style="padding:5px 0;line-height:1.5;"></div>

<script type="text/javascript">
picsManage.init('ctl_pics', 'upic', 'show_pics', false, 'pic');
</script>
				</td>
				</tr>
				<tr>
						<th></th>
						<td>
						    <input type="hidden" name="id" value="<?php echo ($arr["id"]); ?>"/>
							<input type="submit" class="add_yes" value=''/>
							<a href="__URL__/index" class="add_no"></a>
						</td>
				</tr>
			</table>
			</form>
		</div>
	</div>
</div>

</body>
</html>