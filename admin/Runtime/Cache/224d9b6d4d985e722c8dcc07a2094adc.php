<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>添加页面</title>

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

	<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/index.css">
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-ui/1.8.9/themes/sunny/jquery-ui.css" type="text/css"/>
<script type="text/javascript" src="__PUBLIC__/index/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery-ui/1.8.9/jquery-ui.min.js"></script>

</head>
<body class="left cl" >
			<div class="index_con_nav_right">
				<ul class="tab-hd" id="list_f">
					<li class="activeF">   
					<a class="tab-hd-item <?php if($_GET['tabid']==0)echo 'tab-hd-item-cur'; ?>" href="#tab_0">基本资料</a></li>
					<li>   <a class="tab-hd-item <?php if($_GET['tabid']==8)echo 'tab-hd-item-cur'; ?>" href="#tab_8">详细信息</a></li>
					<li><a class="tab-hd-item <?php if($_GET['tabid']==1)echo 'tab-hd-item-cur'; ?>" href="#tab_1">证件照片</a></li>
					<li> <a class="tab-hd-item <?php if($_GET['tabid']==2)echo 'tab-hd-item-cur'; ?>" href="#tab_2">工作照片</a></li>
					<li><a class="tab-hd-item <?php if($_GET['tabid']==3)echo 'tab-hd-item-cur'; ?>" href="#tab_3">阿姨故事</a></li>
					<li>  <a class="tab-hd-item <?php if($_GET['tabid']==4)echo 'tab-hd-item-cur'; ?>" href="#tab_4">空档期</a></li>
						<li>  <a class="tab-hd-item <?php if($_GET['tabid']==5)echo 'tab-hd-item-cur'; ?>" href="#tab_5">身份认证</a></li>
						<li>   <a class="tab-hd-item <?php if($_GET['tabid']==6)echo 'tab-hd-item-cur'; ?>" href="#tab_6">客户评价</a> </li>
						<li>   <a class="tab-hd-item <?php if($_GET['tabid']==7)echo 'tab-hd-item-cur'; ?>" href="#tab_7">状态</a></li>
						
					<div class="clear"></div>
				</ul>
<iframe name="upload_iframe" id="upload_iframe" style="display:none" src=""></iframe>			
<div class="clear"></div>
		
<form class="index_2_form"     method="post" action="__SELF__" id="form" name="form" enctype="multipart/form-data"  target="upload_iframe">
					<div class="tab-item" id="tab_0" style="display:none;">
					<h2>资料完善<span>标记为<i>*</i>为必填项目</span></h2>
					<ul class="index_2_form_list">
						<li>
							<i>*</i>
							<span>姓名：</span>
							<input type="text" name="info[title]" class="add_input" value="<?php echo ($arr["title"]); ?>"/>
						</li>
						<li>
							<i>*</i>
							<span>属性类别：</span>
							<select name="info[hwtype_id]" class="selectB" id="tid">
							  <option value="">请选择</option>
                                <?php
 $hwtypes = M('hwtype')->select(); ?>
                                <?php if(is_array($hwtypes)): foreach($hwtypes as $key=>$val): ?><option value="<?php echo ($val["id"]); ?>" <?php if($val['id']==$arr['hwtype_id'])echo 'selected'; ?>><?php echo ($val["name"]); ?></option><?php endforeach; endif; ?>
							</select>
							 <a href="javascript:;" onclick="update_hwlevel_sel();">更新星级下拉列表</a>
							 <script>
								function update_hwlevel_sel(){
									var ctl_t=$('#tid');
									if(ctl_t.val().length==0){
										alert('请先选择类别');
										$('#tid').eq(0).focus();
										return;
									}
									$.get('__APP__/ajax/getHwlevels&id='+ctl_t.val(), function(d){
										if(d.data && d.data.length>0){
											var html='';
											html = renderOptions('', d.data);
											$('.hwlevel-sel').html('<select class="slt-input  " data-name="info[hwlevel_id]">'+html+'</select>');
										}
									}, 'json')
								}
								</script>
						</li>
							<li>
							<i>*</i>
							<span>星级：</span>
							<?php echo M('hwlevel')->where(array('id'=>$arr['hwlevel_id']))->getField('name'); ?>
                            <input type="hidden" name="info[hwlevel_id]" value="<?php echo ($arr["hwlevel_id"]); ?>" />
                        	
                            <select class="hwlevel-sel selectB" name="info[hwlevel_id]"></select>
                            
						</li>
						<li>						
							<i>*</i>
							<span>已有标签：</span>
							</li>
							<li>

							  <?php
 $u_tags = D('Houseworker')->getTagsByUid($arr['id'],$arr['hwtype_id']); $u_tag_ids = array(); foreach($u_tags as $tag){ $u_tag_ids[] = $tag['id']; } $tags = D('Houseworker')->getTagsByUid('',$arr['hwtype_id']); ?>
							<?php $p=1;?>
                            <?php if(is_array($tags)): foreach($tags as $key=>$tag): ?><label ><input class="qwe" type="checkbox" name="tag_ids[]" value="<?php echo ($tag["id"]); ?>" <?php if(in_array($tag['id'], $u_tag_ids)) echo 'checked'; ?> /><?php echo ($tag["name"]); ?></label> &nbsp;&nbsp;
						<?php  if($tag['id']!="") { if($p%5==0 && $p!=0) { echo "<br/>"; } $p++; } ; endforeach; endif; ?>
							</li>					
						<li>
							<i>*</i>
							<span>民族：</span>
							<select name="cars" class="selectA">
								 <?php
 $mz_arr = explode('|','汉族|壮族|满族|回族|苗族|维吾尔族|土家族|彝族|蒙古族|藏族|布依族|侗族|瑶族|朝鲜族|白族|哈尼族|哈萨克族|黎族|傣族|畲族|傈僳族|仡佬族|东乡族|高山族|拉祜族|水族|佤族|纳西族|羌族|土族|仫佬族|锡伯族|柯尔克孜族|达斡尔族|景颇族|毛南族|撒拉族|塔吉克族|阿昌族|普米族|鄂温克族|怒族|京族|基诺族|德昂族|保安族|俄罗斯族|裕固族|乌兹别克族|门巴族|鄂伦春族|独龙族|塔塔尔族|赫哲族|珞巴族|布朗族|其它'); ?>
                            <?php if(is_array($mz_arr)): foreach($mz_arr as $key=>$val): ?><option value="<?php echo ($val); ?>" <?php if($val==$arr['minzu'])echo 'selected'; ?>><?php echo ($val); ?></option><?php endforeach; endif; ?>
							</select>
						</li>
                   <li>
							<i>*</i>
							<span>手机号码：</span>
							<input type="text" name="info[mobile]" class=" " value="<?php echo ($arr["mobile"]); ?>"/>
						</li>
						<li>
							<i>*</i>
							<span>现居住地址：</span>
							<div id="sel_are" style="display:inline;  height:30px;" class="selectB">
                        <input type="hidden" id="area_id" name="area_id[]" value="<?php echo ($arr["area_id"]); ?>" />
                       </div>（可只选省份）


						<script>
						$(function(){
							renderSels('<?php echo $arr['area_id'] ?>', {id:'sel_are', name:'area_id[]', url:'__APP__/ajax/getAreacode&id=', lbls:'请选择,请选择'}, 0);
						});
						</script> 
						</li>
						<li>
							<i></i>
							<span></span>
						
						</li>
						<li>
							<i>*</i>
							<span>出生日期：</span>
							<input type="text" name="info[birthday]" class="add_input" value="<?php echo ($arr["birthday"]); ?>"/>
						</li>

						<li>
							<i>*</i>
							<span>视频截图：</span>
							  <input type="text" name="info[vpic]" class="add_input" data-preview="1" value="<?php echo ($arr["vpic"]); ?>" /> <a href="javascript:;" onclick="myfilespace({dirName:'vpic',clickFn:'info[vpic]', extraFileUploadParams:{width:600, height:600, forcecut:0}})">浏览</a>
						</li>

						<li>
							<i>*</i>
							<span>射频地址：</span>
							<input type="text" name="info[vsrc]" class="add_input" value="<?php echo ($arr["vsrc"]); ?>"/>
						</li>

						<li>
							<i>*</i>
							<span>工作经验：</span>
							<input type="text" name="info[experence_year]" class="add_input" value="<?php echo ($arr["experence_year"]); ?>"/> 年
						</li>

						<li>
							<i>*</i>
							<span>照顾宝宝数：</span>
							<input type="text" name="info[care_num]" class="add_input" value="<?php echo ($arr["care_num"]); ?>"/> 个
						</li>

						<li>
							<i>*</i>
							<span>阿姨简介：</span>
							 <textarea class="txts" name="info[selfintr]"><?php echo ($arr["selfintr"]); ?></textarea>
						</li>

						<li>
							<i>*</i>
							<span>是否显示：</span>
						<input type="radio" name="info[is_display]" value="1" class="inputB" <?php if($arr['is_display'].''!=='0') echo 'checked'; ?> />是&nbsp; <input type="radio" name="info[is_display]" value="0" class="inputB" <?php if($arr['is_display']==='0') echo 'checked'; ?>  />否
						</li>

						<li>
							<i>*</i>
							<span>经度：</span>
							<input id="J_lng" type="text" name="info[lng]" class="add_input" value="<?php echo ($arr["lng"]); ?>"/> 
						</li>
						<li>
							<i>*</i>
							<span>纬度：</span>
							<input id="J_lat" type="text" name="info[lat]" class="add_input" value="<?php echo ($arr["lat"]); ?>"/> <a href="javascript:;" onclick="var artLoc=art.dialog.open('__APP__/index/getlnglat', {id:'mini_loc', title: '选择经纬度', width:650, height:450, lock:true});">选择经纬度</a>
						</li>
<script>
function setLngLat(lng, lat){
	$('#J_lng').val(lng||'');
	$('#J_lat').val(lat||'');
}
function closeArt(){
	art.dialog.list['mini_loc'].close();
}
</script>						

						<li>
							<i>*</i>
							<span>排序：</span>
							<input type="text" name="info[sort]" class="add_input" value="<?php echo $arr['sort'].''!==''? $arr['sort'] : 50; ?>"/>
						</li>

						<li>
							<i>*</i>
							<span>是否置顶：</span>

							<input type="radio" name="info[is_top]" value="1" class="inputB" <?php if($arr['is_top']==1) echo 'checked'; ?> />是 &nbsp; <input type="radio" name="info[is_top]" value="0" class="inputB"<?php if($arr['is_top']!=1) echo 'checked'; ?> />否

						</li>
						
						<li>
							<i>*</i>
							<span>来源:</span>
						      <select  name="resourse[]" class="selectB"  onchange="gaibian()" id="sel">					      
							  <option  value="58同城">58同城							    
							  <option  value="赶集网">赶集网							    
							  <option  value="400电话">400电话							    
							  <option  value="阿姨推荐">阿姨推荐							    
							  <option  value="内部推荐">内部推荐
							   <option  value="微信公众号">微信公众号
							   <option  value="QQ群推荐">QQ群推荐
							  <option  value="APP客户端">APP客户端
							   <option  value="百度搜索">百度搜索
							   <option  value="其他">其他
							  </select>  
                              <input type="text" name="resourse[]" class="add_input" id="gaibian1" value="<?php echo ($arr["experence_year"]); ?>" style="display:none"/>
						</li>
					<script>
					function  gaibian(){

						sta=$("#sel").val();
						if(sta=="其他")
						{
							$("#gaibian1").show();
						}else
						{
							$("#gaibian1").hide();
						}
					}
					</script>
					</ul>
               </div>
<div class="clear"></div>
 <div class="tab-item" id="tab_1" style="display:none;">  
                <table class="add_table">
                    <tr>
						<th>头像：</th>
						<td>
                            <input type="text" name="info[pic]" class="add_input" data-preview="1" value="<?php echo ($arr["pic"]); ?>" /> <a href="javascript:;" onclick="myfilespace({dirName:'face',clickFn:'info[pic]', extraFileUploadParams:{width:170, height:200, forcecut:1}})">浏览</a>
<input name="file" type="file" data-action="__URL__/swfupload/callback/uploadSuccess/folder/face/width/170/height/200/forcecut/1" onclick="uploadfile(this)" style="width:60px;overflow:hidden;margin:0 8px;" />


<div id="upload_tip" style="display:none;color:red;">上传中，请稍候...</div>
<script>
function auto_upload(obj, fn){
    obj=$(obj);
    var ext, form=obj.parents('form').eq(0);
    obj.val()&&(ext=obj.val().substr(-3).toLowerCase(), 'gif|jpg|png'.split('|').indexOf(ext)>-1? (!!fn&&fn(), navigator.userAgent.toLowerCase().indexOf('chrom')>-1?form.trigger('submit') : form.submit()) : Systip.show('请选择gif、jpg或png格式的图片'))
}
function uploadfile(obj){
    obj=$(obj);
    var fctl=obj, form=fctl.parents('form').eq(0);
    form.find('[type=file]').attr('name', 'file');
    fctl.attr('name', 'Filedata').val('');
    fctl.unbind().bind('change', function(){auto_upload(this, function(){$('#upload_tip').show()})});
    form.attr('action', obj.attr('data-action'));
}
function uploadSuccess(obj){
    $('[name="Filedata"]').val('');
    obj.status? ($('#upload_tip').hide(), $('[name="info[pic]"]').val(obj.data[0]['savename']).trigger('blur')) : ($('#upload_tip').hide(),alert(obj.info));
}
</script>

                        </td>
					</tr>
                    <tr>
						<th>证书图集：</th>
						<td>
							
                            <?php
 $hwpapers = M('hwpaper')->select(); $t_paper_ids = $arr['level_page_pics']? explode(',', $arr['level_page_pics']) : array(); $paper_ids = array(); foreach($t_paper_ids as $k=>$pitem){ $kk = explode('|', $pitem); $paper_ids[$kk[0]] = $kk[1]; } $i = 0; ?>
                            <?php if(is_array($hwpapers)): foreach($hwpapers as $key=>$val): ; $i++; ?>
                                <div>
								
                                    <label><input type="checkbox" name="level_page_pics[]" class="chk_<?php echo ($i); ?>" value="<?php echo ($val["id"]); ?>" <?php if(array_key_exists($val['id'], $paper_ids))echo 'checked'; ?> /> <span style="display:inline-block;min-width:100px;"><?php echo ($val["name"]); ?></span>


                                    <?php if($val['pic']){ ?><img src="<?php echo ($val["pic"]); ?>" style="height:50px;"><?php }?>
                                    
                                    <input type="text" id="lpic<?php echo ($i); ?>"  name="level_page_pic_<?php echo ($val["id"]); ?>" class="add_input" style="width:120px;" data-preview="1" value="<?php echo $paper_ids[$val['id']]; ?>" /> <a href="javascript:;" onclick="myfilespace({dirName:'level_page',clickFn:'level_page_pic_<?php echo $val['id']; ?>', extraFileUploadParams:{width:800, height:800, forcecut:0}})">浏览</a>
                                    </label>

<input name="file" type="file" data-action="__URL__/swfupload/callback/uploadSuccess<?php echo $i; ?>/folder/level_page/width/800/height/800/forcecut/0" onclick="uploadfile<?php echo $i; ?>(this)" style="width:60px;overflow:hidden;margin:0 8px;" />


<div id="upload_tip<?php echo $i; ?>" style="display:none;color:red;">上传中，请稍候...</div>
<script>
function auto_upload<?php echo $i; ?>(obj, fn){
    obj=$(obj);
    var ext, form=obj.parents('form').eq(0);
    obj.val()&&(ext=obj.val().substr(-3).toLowerCase(), 'gif|jpg|png'.split('|').indexOf(ext)>-1? (!!fn&&fn(), navigator.userAgent.toLowerCase().indexOf('chrom')>-1?form.trigger('submit') : form.submit()) : Systip.show('请选择gif、jpg或png格式的图片'))
}
function uploadfile<?php echo $i; ?>(obj){
    obj=$(obj);
    var fctl=obj, form=fctl.parents('form').eq(0);
    form.find('[type=file]').attr('name', 'file');
    fctl.attr('name', 'Filedata').val('');
    fctl.unbind().bind('change', function(){auto_upload<?php echo $i; ?>(this, function(){$('#upload_tip<?php echo $i; ?>').show()})});
    form.attr('action', obj.attr('data-action'));
}
function uploadSuccess<?php echo $i; ?>(obj){
    $('[name="Filedata"]').val('');
    obj.status? ($('#upload_tip<?php echo $i; ?>').hide(), $('#lpic<?php echo $i; ?>').val(obj.data[0]['savename']).trigger('blur'), $('.chk_<?php echo $i; ?>').attr('checked',true)) : ($('#upload_tip').hide(),alert(obj.info));
}
</script>
                                </div><?php endforeach; endif; ?>
   
                        </td>
                            
                             
                        </td>
					</tr>
                </table>
                </div>
	</div>
<div class="clear"></div>
<div class="tab-item" id="tab_2" style="display:none;">
                <table class="add_table">
 <tr>
						<th>工作图集：</th>
						<td>
<input type="hidden" id="ctl_pics" name="info[pics]" class="add_input" value="<?php echo ($arr["pics"]); ?>" />

<input type="hidden" id="upic">
<a href="javascript:;" onclick="myfilespace({dirName:'houseworker',clickFn:'#upic', extraFileUploadParams:{width:640, height:480, forcecut:1}})">浏览</a>

<div id="show_pics" style="padding:5px 0;line-height:1.5;"></div>

<script type="text/javascript">
picsManage.init('ctl_pics', 'upic', 'show_pics', false, 'pic');
</script>

                        </td>
					</tr>
				</table>
				</div>

				<div class="clear"></div>
				
				<div class="tab-item" id="tab_3" style="display:none;">
                <table class="add_table">
              
 					<tr>
						<th>阿姨故事：</th>
						<td>
                        <textarea id="editor_1" class="txts"  name="info[story]" style="width:600px;"><?php echo ($arr["story"]); ?></textarea>
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
				</table>
				</div>
				<div class="clear"></div>
					<div class="tab-item" id="tab_4" style="display:none;">
				<input type='hidden' name='info[start_kongdang]'  value='<?php echo ($arr["start_kongdang"]); ?>'/>
				<input type='hidden' name='info[end_kongdang]' value='<?php echo ($arr["end_kongdang"]); ?>'/>
                <table class="add_table" id='kdtable'>
                <tr>
                <th></th>
                <td><input type='button' value='增加空档期' id='addkd'/><br/></td>
                </tr>
					<?php $start_kongdang=explode(',',$arr['start_kongdang']); $end_kongdang=explode(',',$arr['end_kongdang']); for($i=0;$i<count($start_kongdang);$i++){ ?>	
					<tr>
					<th>空档期：</th>
					<td>
					<input type='text' name='start_kongdang' class='add_input' value='<?php echo $start_kongdang[$i]?>'/>&nbsp;至&nbsp;
					<input type='text' name='end_kongdang' class='add_input' value='<?php echo $end_kongdang[$i]?>'/>&nbsp;<a href='javascript:void(0)' onclick='deleteKd(this)'>删除</a>
					</td>
					</tr>
					<?php } ?>
				</table>
				</div>
				<div class="clear"></div>
				<div class="tab-item" id="tab_5" style="display:none;">
                <table class="add_table">
						<!-- <tr>
						<th>手机：</th>
						<td>
						<input type='text' class='add_input' name='info[mobile]' value='<?php echo ($arr["mobile"]); ?>'/>
						</td>
						</tr> -->
						<tr>
						<th>QQ：</th>
						<td>
						<input type='text' class='add_input' name='info[qq]' value='<?php echo ($arr["qq"]); ?>'/>
						</td>
						</tr>
						<tr>
						<th>微信：</th>
						<td>
						<input type='text' class='add_input' name='info[weixin]' value='<?php echo ($arr["weixin"]); ?>'/>
						</td>
						</tr>
						<tr>
						<th>家庭住址：</th>
						<td>
						<input type='text' class='add_input' name='info[address_num]' value='<?php echo ($arr["address_num"]); ?>'/>
						</td>
						</tr>
						<tr>
						<th>身份证号：</th>
						<td>
						<input type='text' class='add_input' name='info[idcard]' value='<?php echo ($arr["idcard"]); ?>'/>
						</td>
						</tr>
						<tr>
						<th>身份证地址：</th>
						<td>
						   <div id="sel_area" style="display:inline;wdith:;  height:30px;" class="selectB">
                          <input type="hidden" id="area_ids" name="info[area_ids]" value="<?php echo ($arr["area_ids"]); ?>" />
                            </div>（可只选省份）
							<script>
							$(function(){
								renderSels('<?php echo $arr['area_ids'] ?>', {id:'sel_area', name:'info[area_ids]', url:'__APP__/ajax/getAreacode&id=', lbls:'请选择,请选择'}, 0);
							});
							</script> 
						</td>
						</tr>
				</table>
				</div>
				<div class="clear"></div>
				<div class="tab-item" id="tab_6" style="display:none;">

                <div class="con_box">
        <table  class="list_table">
          <tr>
			<th width="50">编号</th>
            <th width="100">婴儿护理</th>
            <th width="100">产妇护理</th>
            <th width="100">与家人相处</th>
			<th width="100">月子餐口味</th>
			<th width="100">评论时间</th>
            <th width="150">基本操作</th>
          </tr>
          <?php if(is_array($list)): $k = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($k % 2 );++$k;?><tr>
					<td><?php echo ($k); ?></td>
                          <!--<td><?php echo ($val["account"]); ?></td>-->
                    <td><?php echo ($val["yehuli"]); ?>颗星</td>
					<td>
						<?php echo ($val["chhuli"]); ?>颗星
					</td>
					<td><?php echo ($val["jrxiangchu"]); ?>颗星</td>
					<td><?php echo ($val["yzckouwei"]); ?>颗星</td>
					<td><?php echo ($val["addtime"]); ?></td>
					<td>
						<a href="__URL__/more/id/<?php echo ($val["id"]); ?>">查看更多</a>
						<!--  <a href="__URL__/delete/id/<?php echo ($val["id"]); ?>">删除</a>-->
					</td>
				</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				  </table>
		<div class="pagefy mt_10 cl">
		<?php
 $Xpage_baseurl = fixurl(array('page', 'pagesize'), __SELF__). '&pagesize=' . $pager['pageSize'].'&'; ?>
		
共有 <?php echo $pager['count'] ?> 个记录 <?php echo $pager['currentPage'] ?>/<?php echo $pager['pageCount'] ?>(<?php echo $pager['pageSize'] ?>)页 

<?php if ($pager['currentPage'] == 1): ?>
<font style="color:#888;">[首页]</font>
<?php else: ?>
<a href="<?php echo $Xpage_baseurl ?>&page=1">[首页]</a>
<?php endif; ?>

<?php if ($pager['currentPage']-1<1): ?>
<font style="color:#888;">[上页]</font>
<?php else: ?>
<a href="<?php echo $Xpage_baseurl ?>&page=<?php echo $pager['currentPage']-1 ?>">[上页]</a>
<?php endif; ?>

&nbsp;<font style="color:red;">[<?php echo $pager['currentPage'] ?>]</font>&nbsp;

<?php if ($pager['currentPage'] == $pager['pageCount']): ?>
<font style="color:#888;">[下页]</font>
<?php else: ?>
<a href="<?php echo $Xpage_baseurl ?>&page=<?php echo $pager['currentPage']+1 ?>">[下页]</a>
<?php endif; ?>

<?php if ($pager['pageCount'] == $pager['currentPage']): ?>
<font style="color:#888;">[尾页]</font>
<?php else: ?>
<a href="<?php echo $Xpage_baseurl ?>&page=<?php echo $pager['pageCount'] ?>">[尾页]</a>
<?php endif; ?>

<input type=text id="_PGNumber" class="iptA" size="3" value="<?php echo $pager['currentPage'] ?>" onmouseover="this.focus();this.select()" name="PGNumber" /> 
每页<input type=text id="_PGSize" class="iptA" size="3" value="<?php echo $pager['pageSize'] ?>" onmouseover="this.focus();this.select()" name="PGSize" />条
<input type="button" id="button1" name="button1" class="btnA" style="border:1px solid #BABABA; padding-left:4; padding-right:4; padding-top:1; padding-bottom:1; background-color:#F5F5F5" value=" GO " onclick="if(document.getElementById('_PGNumber').value>0 && document.getElementById('_PGNumber').value<='<?php echo $pager['pageCount'] ?>'*1){window.location='<?php echo $Xpage_baseurl ?>&page='+document.getElementById('_PGNumber').value+'&pagesize='+document.getElementById('_PGSize').value}" onmouseover="this.focus()" onfocus="this.blur()" />

		</div>
		 </div>
		</div>		
		<input  type="hidden"   name='id'  value="<?php echo ($arrr["id"]); ?>">
		  <div class="tab-item" id="tab_7" style="display:none;margin-left:100px"  >
				<div  style="height:50px"></div>              
				<ul class="index_2_form_list">
						<li>
							<i>*</i>
							<span>状态：</span>
							<input style="width:20px;height:10px;" type="radio" name="info[status]" value="1" class="inputB"  <?php  if($arr['status']=="" || $arr['status']==1) echo "checked" ?>/>新人&nbsp;
							 <input style="width:20px;height:10px;" type="radio" name="info[status]" value="2" class="inputB"  <?php  if( $arr['status']==2) echo "checked" ?> />培训&nbsp;
							 <input style="width:20px;height:10px;" type="radio" name="info[status]" value="3" class="inputB" <?php  if( $arr['status']==3) echo "checked" ?> />待岗&nbsp;
							<input  style="width:20px;height:10px;" type="radio" name="info[status]" value="4" class="inputB" <?php  if($arr['status']==4) echo "checked" ?> />优先&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="info[status]" value="5" class="inputB" <?php  if($arr['status']==5) echo "checked" ?> />在岗&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="info[status]" value="6" class="inputB"  <?php  if($arr['status']==6) echo "checked" ?>/>休假&nbsp;
                            <input style="width:20px;height:10px;" type="radio" name="info[status]" value="7" class="inputB" <?php  if( $arr['status']==7) echo "checked" ?> />转行&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="info[status]" value="8" class="inputB" <?php  if($arr['status']==8) echo "checked" ?> />失联&nbsp;
							<input  style="width:20px;height:10px;" type="radio" name="info[status]" value="9" class="inputB" <?php  if($arr['status']==9) echo "checked" ?> />黑名单&nbsp;
						</li>
						</ul>
					<div  style="height:500px"></div>
				</div>
                  <div class="clean"></div>
		               <div class="tab-item" id="tab_8"  style="margin-left:100px" >
                      <ul class="index_2_form_list">
						<li>
							<i>*</i>
							<span>婚姻状况：</span>
							<input style="width:20px;height:10px;" type="radio" name="arr[marriage]" value="1"  />已婚&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[marriage]" value="2"    />未婚&nbsp;
							 <input style="width:20px;height:10px;" type="radio" name="arr[marriage]" value="3"  />离异&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[marriage]" value="4"  />丧偶&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[marriage]" value="5"   />保密&nbsp;
						</li>
						<li>
							<i>*</i>
							<span>政治面貌：</span>
						<input style="width:20px;height:10px;" type="radio" name="arr[political]" value="1" />群众&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[political]" value="2"  />中共党员&nbsp;
							 <input style="width:20px;height:10px;" type="radio" name="arr[political]" value="3"  />共青团员&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[political]" value="4" >民主党&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[political]" value="5"  />其他&nbsp;	
						</li>
						<li>
							<i>*</i>
							<span>宗教信仰：</span>
						<input  style="width:20px;height:10px;" type="radio" name="arr[religious]" value="1"  />无&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[religious]" value="2"   />佛教&nbsp;
							 <input style="width:20px;height:10px;" type="radio" name="arr[religious]" value="3"   />伊斯兰教&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[religious]" value="4"   />基督教&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[religious]" value="5"  />其他&nbsp;	
						</li>
						<li>
							<i>*</i>
							<span>身高：</span>
						  <input type='text' class='add_input79' name='arr[height]' value='<?php echo ($arr["address_num"]); ?>'/>厘米	
						</li>
						<li>
							<i>*</i>
							<span>体重：</span>
							<input type='text' class='add_input79' name='arr[weight]' value='<?php echo ($arr["address_num"]); ?>'/>斤	
						</li>
						<li>
							<i>*</i>
							<span>血型：</span>
					        <input style="width:20px;height:10px;" type="radio" name="arr[blood_type]" value="1"/>未知&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[blood_type]" value="2"/>A&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[blood_type]" value="3" />AB&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[blood_type]" value="4" />B&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[blood_type]" value="5"/>O&nbsp;		
						</li>
						<li>
							<i>*</i>
							<span>学历：</span>
				            <input style="width:20px;height:10px;" type="radio" name="arr[school_type]" value="1"/>初中&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[school_type]" value="2" />大专&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[school_type]" value="3" />本科&nbsp;
							<input style="width:20px;height:10px;" type="radio" name="arr[school_type]" value="4" />博士&nbsp;	
						</li>
	                   <li>
							<i></i>
							<span>其他信息：</span>
						</li>
						<li>
							<i>*</i>
							<span>入会日期：</span>
				             <input type="text" name="arr[membership]" class="add_input79" value="<?php echo ($arr["birthday"]); ?>"/>	
						</li>
						<li>
							<i>*</i>
							<span>最近体检日期：</span>
				            <input type="text" name="arr[medical]" class="add_input79" value="<?php echo ($arr["birthday"]); ?>"/>	
						</li>
						<li>
							<i>*</i>
							<span>会员有效期：</span>
			                <input type="text" name="arr[effective]" class="add_input79" value="<?php echo ($arr["birthday"]); ?>"/>		
						</li>
						</ul>		 
					<div class="height02"></div>
				</div>
				<div class="index_2_form_botton">
						<input type="submit" placeholder="确认" value="确认"  onclick="submitForm()">
						<a href="#">取消</a>
					</div>
			
			</div>
			<div class="clear"></div>
		</div>	</form>
	<div class=" index_footer">
	<p>北京icp备09018459 京公网备 11010502011199</p>
	<p>Copyright  © 2012-2015 北京嘉乐家政服务有限公司 版权所有</p>		
	</div>
</body>
</html>
	<script type="text/javascript" src="__PUBLIC__/index/js/index_1.js"></script>
<script>
<?php $y=date('Y'); ?>
$(function(){
	$('[name="info[birthday]"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
	//入会日期
	$('[name="info[membership]"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
	//最近体检日期
	$('[name="info[medical]"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
	//会员有效期
	$('[name="info[effective]"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});

	$('[name="start_kongdang"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
	$('[name="end_kongdang"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
});
$('#tid').change(function(){
	var val=$(this).children('option:selected').val();
	var td=$('#tags');
	td.html('');
	$.ajax({
		type:'POST',
		dataType:'json',
		data:{
			id:val,
		},
		url:'__URL__/getTagsByUid',
		success:function(data, textStatus, jqXHR){
			if(data!=null){
				for(var i=0;i<data.length;i++){
					td.append("<label><input type='checkbox' name='tag_ids[]' value='"+data[i].id+"'/>"+data[i].name+"&nbsp;</label>");
				}
			}
		},
		error:function(XMLHttpRequest,errorInfo,exception){
			alert(errorInfo);
		}
	});
});
$("#addkd").click(function(){
	$('#kdtable').append("<tr>"+
			"<th>空档期：</th>"+
				"<td>"+
				"<input type='text'  name='start_kongdang' class='add_input' />&nbsp;至&nbsp;"+
				"<input type='text' name='end_kongdang' class='add_input'/>"+
				"&nbsp;<a href='javascript:void(0)' onclick='deleteKd(this)'>删除</a></td>"+
			"</tr>");
	$('[name="start_kongdang"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
	$('[name="end_kongdang"]').datepicker({
		yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
		dateFormat: 'yy-mm-dd',
		regional:'zh-CN',
        changeMonth: true,
        //changeYear: true
	}).change(function() {
	});
});
function deleteKd(a){
	var table=document.getElementById('kdtable');
	table.deleteRow(a.parentNode.parentNode.rowIndex);
}
function submitForm(){
	$('form').attr('action', '__SELF__');
	$('form').attr('target', '');
    //$('[type=file]').val('');
    var start_kongdangs=document.getElementsByName('info[start_kongdang]');
	var end_kongdangs=document.getElementsByName('info[end_kongdang]');
	var start_kongdang=document.getElementsByName('start_kongdang');
	var end_kongdang=document.getElementsByName('end_kongdang');
	var start='',end='';
	for(var i=0;i<start_kongdang.length;i++){
		if(start_kongdang[i].value==''){
			alert('空档开始日期不能为空！');
			return;
		}
		start+=start_kongdang[i].value+',';
	}
	if(start!=''){
		start=start.substring(0,start.length-1);
	}
	for(var i=0;i<end_kongdang.length;i++){
		if(end_kongdang[i].value==''){
			alert('空档结束日期不能为空！');
			return;
		}
		end+=end_kongdang[i].value+',';
	}
	if(end!=''){
		end=end.substring(0,end.length-1);
	}
	start_kongdangs[0].value=start;
	end_kongdangs[0].value=end;
	document.form.submit();
}
</script>