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
			<span class="l">位置：<a href="__APP__/Index/right">管理平台</a><b>会员列表</b></span>
		</div>
		<div class="web_tit">
		    <script type="text/javascript">
			var searchURL='__ACTION__';
			var searchIDs="truename|mobile|export|mum_type".split('|');
			</script>
            <input type="hidden" id="export" value="" >
			姓名：<input type="text" id="truename" value="<?php echo ($para["truename"]); ?>" size="8" >
            手机号：<input type="text" id="mobile" value="<?php echo ($para["mobile"]); ?>" size="8" >
            用户类型：<select id="mum_type">
            	<option value=""></option>
            	<?php  $mum_types = explode('|', "孕妇|宝妈|无"); ?>
            	<?php foreach ($mum_types as $v): ?>
            		<option value="<?php echo ($v); ?>" <?php if($para['mum_type']==$v)echo 'selected'; ?>><?php echo ($v); ?></option>
            	<?php endforeach ?>
            </select>
            <!--  地区：
             <div id="sel_area" style="display:inline;">
                <input type="hidden" id="area_id" name="info[area_ids]" />
             </div> -->
			<input type="button" value="搜索" onclick="doSearch()" />
            <!--<input type="button" value="导出" onclick="$('#export').val(1);doSearch()" />-->
            <input type="button" value="重置" onclick="doReset()" />
		</div>
<script>
$(function(){
    renderSels('<?php echo $para['area_id'] ?>', {id:'sel_area', name:'info[area_ids]', url:'__APP__/ajax/getAreacode&id=', lbls:'请选择,请选择'}, 0);
});
</script>
		

        <div class="con_box">
        <form action="__URL__/del" method="POST" id="sub">
        <table  class="list_table">
          <tr>
			<th width="40">&nbsp;</th>
			<th width="80">编号</th>
            <th width="80">手机</th>
            <th>姓名</th>
            <!--<th width="80">余额</th>-->
            <th>用户类型</th>
            <th>类型数据</th>
            <th width="150">状态</th>
			<th width="180">添加时间</th>
            <th width="200">基本操作</th>
          </tr>

          <?php if(is_array($list)): foreach($list as $key=>$val): ?><tr>
					<td><input type="checkbox" name="checkboxes[]" value="<?php echo ($val["id"]); ?>" ></td>
					<td><?php echo ($val["id"]); ?></td>
                    <td><?php echo ($val["mobile"]); ?></td>
					<td class="td_left">
					<?php  echo $val['truename']; ?>
					</td>
                    <!--<td><?php echo ($val["account"]); ?></td>-->
                    <td>
                    	<?php echo ($val["mum_type"]); ?>
                    </td>
                    <td class="td_left">
                    	<?php if ($val['mum_type']=='孕妇'){ ?>
                    	预产期：<?php echo ($val["pre_born"]); ?>
                    	<?php }else if($val['mum_type']=='宝妈'){ ?>
                    	宝宝生日：<?php echo ($val["baby_birth"]); ?> <?php echo ($val["baby_sex"]); ?>
                    	<?php } ?>
                    </td>
					<td>
						<script>showRW({api:'__URL__/is_normal/id/<?php echo $val['id']; ?>/is_normal/', v:'<?php echo $val['status']; ?>', vs:[1, 0]})</script>
					</td>
					<td><?php echo date('Y-m-d H:i:s', $val['addtime']); ?></td>
					<td>
						<a href="__URL__/edit/id/<?php echo ($val["id"]); ?>/listurl/<?php echo base64_encode(urlencode(__SELF__)); ?>">编辑</a> |
						<a href="__URL__/del/id/<?php echo ($val["id"]); ?>/listurl/<?php echo base64_encode(urlencode(__SELF__)); ?>" class="link-del">删除</a>
					</td>
				</tr><?php endforeach; endif; ?>
          </table>
		  <div class="mt_10 pl_10"><label><input type="checkbox" name="checkbox" onclick='checkAll(this)'/> 全选</label> &nbsp; <input type="button" onclick="delall(this)"  value="删除选中"></div>

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

          </form>
 </div>

</div>
</div>      
</body>
</html>