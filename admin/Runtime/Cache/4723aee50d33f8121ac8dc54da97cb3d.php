<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php $include=array('filespace'); ?>
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
<script src="/Public/editor/kindeditor.js"></script>
<script src="/Public/editor/lang/zh_CN.js"></script>
</head>

<body>
<div class="right">
	<div class="w810 l">
		<div class="add_tit cl">
			<span class="l">位置：<a href="__APP__/Index/right">管理平台</a><b>服务编辑</b></span>
		</div>

        <div class="con_box">
			<form method="post" action="__SELF__" id="form" name="form">
				<table class="add_table">
					<tr>
						<th>标题：</th>
						<td><input type="text" name="info[title]" class="add_input" value="<?php echo ($arr["title"]); ?>"/></td>
					</tr>
					<tr>
						<th>服务类别：</th>
						<td>
                            <select name="info[fwtype]">
                                <option value="0">请选择</option>
								<option value="1" <?php if(1==$arr['fwtype']) echo 'selected'; ?>>催乳泌乳</option>
								<option value="2" <?php if(2==$arr['fwtype']) echo 'selected'; ?>>护士入户</option>
								<option value="3" <?php if(3==$arr['fwtype']) echo 'selected'; ?>>产后修复</option>
                            </select>
                        </td>
					</tr>
					<tr>
						<th>类别：</th>
						<td>
                            <select name="info[typeid]">
                                <option value="">请选择类别</option>
								<?php if(is_array($tlist)): foreach($tlist as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($val['id']==$arr['typeid']) echo 'selected'; ?>><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </td>
					</tr>

					<tr>
						<th>阿姨类型：</th>
						<td>
                            <select name="info[hwtype_id]">
                                <option value="">请选择类别</option>
								<?php
 $hwtypes = M('hwtype')->select(); ?>
                                <?php if(is_array($hwtypes)): foreach($hwtypes as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($val['id']==$arr['hwtype_id'])echo 'selected'; ?>><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
                            </select>
                        </td>
					</tr>

                    <tr>
						<th>列表图标：</th>
						<td><input type="text" name="info[pic]" class="add_input" data-preview="1" value="<?php echo ($arr["pic"]); ?>"/> <a href="javascript:;" onclick="myfilespace({dirName:'service',clickFn:'info[pic]', extraFileUploadParams:{width:100, height:100, forcecut:0}})">浏览</a></td>
					</tr>
                    
                    <tr>
						<th>列表描述：</th>
						<td><textarea class="txts" name="info[desc]"><?php echo ($arr["desc"]); ?></textarea></td>
					</tr>

					<!--tr>
						<th>价格描述：</th>
						<td><input type="text" name="info[price_desc]" class="add_input" value="<?php echo ($arr["price_desc"]); ?>"/></td>
					</tr-->
					<tr>
						<th>市场价：</th>
						<td><input type="text" name="info[market_price]" class="add_input" value="<?php echo ($arr["market_price"]); ?>"/> （整数）</td>
					</tr>
                                       <tr>
						<th>价格：</th>
						<td><input type="text" name="info[price_desc]" class="add_input" value="<?php echo ($arr["price_desc"]); ?>"/> （整数）</td>
					</tr>
                                       <tr>
						<th>时长：</th>
						<td><input type="text" name="info[lange]" class="add_input" value="<?php echo ($arr["lange"]); ?>"/> （整数/分）</td>
					</tr>
                                       <tr>
						<th>促销：</th>
						<td><input type="text" name="info[cuxiao]" class="add_input" value="<?php echo ($arr["cuxiao"]); ?>"/> （内容实例:买10送2）</td>
					</tr>
					<tr>
						<th>关注数：</th>
						<td><input type="text" name="info[follow_num]" class="add_input" value="<?php echo ($arr["follow_num"]); ?>"/></td>
					</tr>
					<tr>
						<th>评论数：</th>
						<td><input type="text" name="info[review_num]" class="add_input" value="<?php echo ($arr["review_num"]); ?>"/></td>
					</tr>

					<tr>
						<th>详情图片介绍：</th>
						<td><input type="text" name="info[pic2]" class="add_input" data-preview="1" value="<?php echo ($arr["pic2"]); ?>"/> <a href="javascript:;" onclick="myfilespace({dirName:'service_info',clickFn:'info[pic2]', extraFileUploadParams:{width:800, height:600, forcecut:0}})">浏览</a></td>
					</tr>
					<tr>
						<th>标题描述：</th>
						<td><input type="text" name="info[title_info]" class="add_input" value="<?php echo ($arr["title_info"]); ?>"/></td>
					</tr>
					<tr>
						<th>适用人群：</th>
						<td>
							<textarea class="txts" name="info[info_suitfor]"><?php echo ($arr["info_suitfor"]); ?></textarea>
						</td>
					</tr>
					<tr>
						<th>项目介绍：</th>
						<td>
							<textarea class="txts" name="info[info_prj]"><?php echo ($arr["info_prj"]); ?></textarea>
						</td>
					</tr>
					<tr>
						<th>调理步骤：</th>
						<td>
							<textarea class="txts" name="info[info_step]"><?php echo ($arr["info_step"]); ?></textarea>
						</td>
					</tr>
                                        <tr>
						<th>内容介绍：</th>		
                                                <td>
                                                    <ul id="zhuijia">
                                                        <?php if($newArr == true): ; if(is_array($newArr)): foreach($newArr as $key=>$vo): ?><li style="margin-top: 20px;">
                                                            <input type='text' name='info[content][]' value="<?php echo ($vo["0"]); ?>" style="width:300px;margin-bottom: 5px;"/>&nbsp;&nbsp;<button class="btn17">添加</button>&nbsp;&nbsp;<button class="cl1">移除</button>&nbsp;
                                                            <textarea class="editor_1" name="info[content][]"><?php echo ($vo["1"]); ?></textarea>
                                                             </li>
															 <script type="text/javascript">
															     KindEditor.ready(function(K){
																	K.create('.editor_1', {
																	uploadJson: '__APP__/index/upload_json',
																	fileManagerJson: '__APP__/index/file_manager_json',
																	extraFileUploadParams:{"PHPSESSID":'<?php echo session_id(); ?>'},
																	allowFileManager: true,
																	afterBlur: function(){this.sync();}
																	  });
																});
															 </script><?php endforeach; endif; ?>
                                                        <?php else: ?>
                                                        <li>
                                                            <input type='text' name='info[content][]' style="width:300px;margin-bottom: 5px;"/>&nbsp;&nbsp;<button class="btn17">添加</button>&nbsp;
                                                            <textarea class="editor_1" name="info[content][]"></textarea>
                                                        </li>
														<script type="text/javascript">
															     KindEditor.ready(function(K){
																	K.create('.editor_1', {
																	uploadJson: '__APP__/index/upload_json',
																	fileManagerJson: '__APP__/index/file_manager_json',
																	extraFileUploadParams:{"PHPSESSID":'<?php echo session_id(); ?>'},
																	allowFileManager: true,
																	afterBlur: function(){this.sync();}
																	  });
																});
															 </script><?php endif; ?>
                                                    </ul>
                                                 </td>
					</tr>
                                                <?php $editor_id = 'editor_1'; ?>
                                                             
					<tr>
						<th>排序：</th>
						<td><input type="text" name="info[sort]" class="add_input" value="<?php echo $arr['sort'].''!==''? $arr['sort']:50; ?>"/></td>
					</tr>
					<tr>
						<th>置顶：</th>
						<td><label><input type="radio" name="info[is_top]" value="1" <?php if($arr['is_top']==1) echo 'checked'; ?> />是</label> &nbsp; <label><input type="radio" name="info[is_top]" value="0" <?php if($arr['is_top']!=1) echo 'checked'; ?> />否</label></td>
					</tr>
					<tr>
						<th>是否显示：</th>
						<td><label><input type="radio" name="info[is_display]" value="1" <?php if($arr['is_display'].''!==0) echo 'checked'; ?> />是</label> &nbsp; <label><input type="radio" name="info[is_display]" value="0" <?php if($arr['is_display'].''=='0') echo 'checked'; ?> />否</label></td>
					</tr>

					<tr>
						<th></th>
						<td>
							<input type="hidden" name="id" value="<?php echo ($arr["id"]); ?>"/>
							<input type="hidden" name="listurl" value="<?php echo ($listurl); ?>"/>
							<a href="javascript:;" onclick="document.form.submit();"class="add_yes"></a>
							<a href="__URL__/lists" class="add_no"></a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
    KindEditor.ready(function(K){
        K.create('.<?php echo $editor_id; ?>', {
        uploadJson: '__APP__/index/upload_json',
        fileManagerJson: '__APP__/index/file_manager_json',
        extraFileUploadParams:{"PHPSESSID":'<?php echo session_id(); ?>'},
        allowFileManager: true,
        afterBlur: function(){this.sync();}
          });
    });
	$(".btn17").click(function(){
		$("#zhuijia").append("<li style='margin-top:20px'><input type='text' name='info[content][]' style=\"width:300px;margin-bottom: 5px;\"/>&nbsp;&nbsp;<button class=\"cl1\">移除</button>&nbsp; <textarea class=\"editor_1\" name=\"info[content][]\"><?php echo ($arr["content"]); ?></textarea></li>");
		KindEditor.ready(function(K){
			K.create('.<?php echo $editor_id; ?>', {
			uploadJson: '__APP__/index/upload_json',
			fileManagerJson: '__APP__/index/file_manager_json',
			extraFileUploadParams:{"PHPSESSID":'<?php echo session_id(); ?>'},
			allowFileManager: true,
			afterBlur: function(){this.sync();}
			  });
		});
		$(".cl1").each(function(){
			 $(this).click(function(){
				 $(this).parent().remove();
			 });
			return false;
		});
		return false;
	});
   
</script>
</body>

</html>