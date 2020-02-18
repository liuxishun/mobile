<?php if (!defined('THINK_PATH')) exit();?>
	<div  id="tihuan">
	
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
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>index_1</title>
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/index/css/index.css">

</head>
<body  class="body_1">
	


			<div >
				<ul class="index_con_nav_right_nav" id="list_3">
					<li> <a href="#"   class="<?php  if($id=='0') echo 'active_2';?>" onclick="rep(0)" >全部</a> </li>
					<li> <a href="#"     class="<?php  if($id=='1') echo 'active_2';?>"onclick="rep(1)">新人</a> </li>
                    <li> <a href="#"     class="<?php  if($id=='2') echo 'active_2';?>"onclick="rep(2)">培训</a> </li> 


                   <li> <a href="#"     class="<?php  if($id=='3') echo 'active_2';?>"onclick="rep(3)">待岗</a> </li> 
				   <li> <a href="#"    class="<?php  if($id=='4') echo 'active_2';?> "onclick="rep(4)">优先</a> </li> 

					<li> <a href="#"     class="<?php  if($id=='5') echo 'active_2';?>" onclick="rep(5)">在岗</a> </li> 
					<li> <a href="#"     class="<?php  if($id=='6') echo 'active_2';?>"onclick="rep(6)">休假</a> </li>
					<li> <a href="#"    class="<?php  if($id=='7') echo 'active_2';?> "onclick="rep(7)">转行</a> </li>
					<li> <a href="#"    class="<?php  if($id=='8') echo 'active_2';?> "onclick="rep(8)">失联</a> </li>
					<li> <a href="#"     class="<?php  if($id=='9') echo 'active_2';?>"onclick="rep(9)">黑名单</a> </li>
					

				</ul>
				
				<div class="clear"></div>
				  <script type="text/javascript">
			var searchURL='__ACTION__';
			var searchIDs="username|mobile|hwtype_id|xingji|minzu|minzu|diqu".split('|');
			</script>
				<form class="index_con_nav_right_nav_form_2" name="">
                     
			  
			    &nbsp;&nbsp;&nbsp;姓名:     <input  type="text" name="username" id="username" value="<?php echo ($para["username"]); ?>"  style="width:100px;height:23px">
                      &nbsp;&nbsp;&nbsp;&nbsp;手机:     <input  type="text"name="mobile" id="mobile" value="<?php echo ($para["mobile"]); ?>" style="width:100px;height:23px">


                  &nbsp;&nbsp;&nbsp;&nbsp;  类别:
					<select name="hwtype_id"  id='hwtype_id'class="" onchange="search()">
					 <option value="">请选择</option>
                    <?php
 $hwtypes = M('hwtype')->select(); ?>
                    <?php if(is_array($hwtypes)): foreach($hwtypes as $key=>$it): ?><option value="<?php echo ($it["id"]); ?>" <?php if($para['hwtype_id']==$it['id'])echo 'selected'; ?>><?php echo ($it["name"]); ?></option><?php endforeach; endif; ?>
					</select>

						  &nbsp;&nbsp;&nbsp;&nbsp;  星级:<select class="" id="xingji">
							 <?php $age1 = M('hwlevel')->select();?>
							<option value="">请选择</option>
							<?php if(is_array($age1)): foreach($age1 as $key=>$vv): ?><option value="<?php echo ($vv["id"]); ?>" <?php if($para['xingji']==$vv['id'])echo 'selected'; ?>> <?php echo ($vv["name"]); ?></option><?php endforeach; endif; ?>
						    </select>
             
						  民族:<select name="minzu" class="" id="minzu" >
						  <option value="">请选择</option>
						  <?php
 $db = M('houseworker'); $p=$db->group("minzu")->select(); ?>
				       <?php if(is_array($p)): foreach($p as $key=>$vvi): ?><option value="<?php echo ($vvi["minzu"]); ?>" <?php if($para['minzu']==$vvi['minzu'])echo 'selected'; ?>><?php echo ($vvi["minzu"]); ?></option><?php endforeach; endif; ?>
						</select>

							地区:
						<select name="diqu" class="" id="diqu">
						<?php $db=D('Area'); $arr=$db->select(); ?>
						<option value="">请选择</option>
						<?php if(is_array($arr)): foreach($arr as $key=>$po): ?><option value="<?php echo ($po["id"]); ?>"  <?php if($para['diqu']==$po['id'])echo 'selected'; ?>><?php echo ($po["areaname"]); ?></option><?php endforeach; endif; ?>
							
						</select>
		
				
             <input type="button" value="搜索" onclick="doSearch()" /> <input type="button" value="重置" onclick="doReset()" />
				</form>
				
            <div class="clear"></div>

				<form class="index_con_nav_right_nav_form_3">
				
					<input type="button" class="button_2" value="+添加" onclick="ale()">
			
					
					<p class="tiaoz">
						<span class="span_1">共 <span><?php echo ($pager["count"]); ?></span>个阿姨</span>
						<a href="__URL__/lists&pagesize=<?php echo $pager['pageSize'];?>&page=<?php echo $pager['currentPage']-1 ?>"><<</a>
						<span class="span_1"><?php echo $pager['currentPage'];?></span>/<apan><?php echo $pager['pageCount'] ?></span>
						<a href="__URL__/lists&pagesize=<?php echo $pager['pageSize'];?>&page=<?php echo $pager['currentPage']+1 ?>">下一页>></a>
					</p>
				</form> 

			


				<ul class="index_con_nav_right_Ti">

				<?php if(is_array($list)): foreach($list as $key=>$val): ?><li>
						<div>
							<div class="index_con_nav_right_Ti_left">
								<img src='<?php  if($val["pic"]=="") { echo "__PUBLIC__/index/images/abc_5.png"; }else { echo $val["pic"]; } ?>' style="width:73px;height:106px;">
						
							<p><?php echo ($val["id"]); ?></p>
								
							</div>
							<div class="index_con_nav_right_Ti_right">
								<h4><a href="__APP__/houseworker/xiangqing/id/<?php echo ($val["id"]); ?>"  ><?php echo ($val["title"]); ?></a></h4>
								<p>
                   <!--<?php echo ($val["minzu"]); ?>-->
                    <?php $age_data = D('Common')->getAgeDataFromDate($val['birthday']); echo $age_data['age']? $age_data['age'].'岁' : ''; ?>
                    <?php echo ($age_data["shuxiang"]); ?>
                    <?php echo ($age_data["xingzuo"]); ?></p>
								<a href="#" class="a_1"><img src="__PUBLIC__/index/images/zbcss01.png"><?php echo ($val["mobile"]); ?></a><br/>
								<span class="span_1" ><?php echo M('hwlevel')->where(array('id'=>$val['hwlevel_id']))->getField('name'); ?></span>  
								<span class="span_2"></span><br/>
									<span>&nbsp;</span><br/>
								<p><?php echo $val['area_ids']? D('admin://Area')->getAreanames($val['area_ids']) : ''; ?></p>

					            <a href="__URL__/edit/id/<?php echo ($val["id"]); ?>/tabid/1/listurl/<?php echo base64_encode(urlencode(__SELF__)); ?>">图片</a>|
								<a href="__URL__/edit/id/<?php echo ($val["id"]); ?>/listurl/<?php echo base64_encode(urlencode(__SELF__)); ?>">编辑</a>|
								<a href="__URL__/del/id/<?php echo ($val["id"]); ?>/listurl/<?php echo base64_encode(urlencode(__SELF__)); ?>" class="link-del">删除</a>
						
							</div>
						</div>
					</li><?php endforeach; endif; ?>





					
					<div class="clear"></div>
				</ul>
			







				
			</div>
			<div class="clear"></div>

		
	
	
		
	
<div class="index_option">
		
		<center>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php
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

</center>


	</div>
	<div class=" index_footer">
	<p>北京icp备09018459 京公网备 11010502011199</p>
	<p>Copyright  © 2012-2015 北京嘉乐家政服务有限公司 版权所有</p>
		
	</div>


	<script type="text/javascript" src="__PUBLIC__/index/js/index_1.js"></script>
	
</body>
</html>

<script type="text/javascript">




function   ale(){
	
	location.href="__APP__/houseworker/add";


	

}

function  rep(p)
{
	

$.ajax(
	{
	url:"__APP__/houseworker/lists",
	type:'get',
	data:{'id':p},
	success:function(e)
	{
	$("#tihuan").html(e);
	}
	
	
	
	
	})

	
}






</script>
	</div>