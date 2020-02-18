<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php $include = array('easyui'); ?>
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

        
<div class="easyui-panel" data-options="fit:true,border:false" style="padding:10px;">
    <table id="tt"></table> 
</div>

<div id="toolbar">
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="add()" data-options="iconCls:'icon-add',plain:true">添加</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="edit()" data-options="iconCls:'icon-edit',plain:true">编辑</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="del()" data-options="iconCls:'icon-remove',plain:true">删除</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" onclick="location.reload()" data-options="iconCls:'icon-reload',plain:true">刷新</a>
</div>

<div id="dlg" class="easyui-dialog" style="width:400px;padding:10px 20px" data-options="closed:true,buttons:'#dlg-buttons',modal:true">
    <form id="fm" class="fm" method="post" novalidate>
        <div class="ftitle"></div>
        <input type="hidden" name="parent_id" value="0" />
        <div class="fitem">
            <label>区域名称:</label>
            <input name="areaname" type="text" class="easyui-validatebox" data-options="required:true">
        </div>
        <!--
        <div class="fitem">
            <label>电话区号:</label>
            <input name="areacode" type="text" class="easyui-validatebox" data-options="required:true">
        </div>
        <div class="fitem">
            <label>国家代码:</label>
            <input name="country_code" id="country_code" type="text" class="easyui-validatebox" data-options="required:true">
        </div>
        <div class="fitem">
            <label>首字母:</label>
            <input name="first_char" type="text" class="easyui-validatebox" onkeyup="this.value=this.value.toUpperCase();" data-options="required:true">
        </div>
        -->
        
        <div class="fitem">
            <label>排序:</label>
            <input name="sortrank" type="text" class="easyui-validatebox">
        </div>
        <div class="fitem">
            <label>是否启用:</label>
            <input name="is_display" type="checkbox" value="1" class="easyui-validatebox">
        </div>
        
    </form>
</div>
<div id="dlg-buttons">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="save()">保存</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')">取消</a>
</div>

<script>
$('#tt').treegrid({
    title:"区域管理",
    fit:true,
    rownumbers:true,
    url:'__URL__/getdata',
    idField:'id',
    treeField:'areaname',
    toolbar:'#toolbar',
    columns:[[
        {title:'ID',field:'id',width:60},
        {title:'区域名称',field:'areaname',width:200},
        {title:'区域代表',field:'seller',width:100,align:'right'},
        {title:'排序',field:'sortrank',width:100,align:'right'},
        {title:'是否启用',field:'is_display',width:150,align:'right', formatter:formatDisplay}
    ]],
    onClickRow:function(r){var row = $('#tt').treegrid('getSelected');row==r&&$('[node-id='+row.id+']').attr('s')?($('#tt').treegrid('unselect', row.id), $('[node-id='+row.id+']').attr('s', '')):($('[node-id]').attr('s',''),$('[node-id='+row.id+']').attr('s', 1))},
    onDblClickRow:function(row){$('#tt').treegrid('select', row.id), $('[node-id='+row.id+']').attr('s', 1),edit();},
});

function formatDisplay(value, row, index){
    return genRWimg({api:'__URL__/is_display/id/'+row.id+'/is_display/', v:value, vs:[1, 0],link:false})
}

var url;
function add(){
    var row = $('#tt').treegrid('getSelected');
    $('#dlg').dialog('open').dialog('setTitle','添加');
    $('#fm').form('clear'), $('#fm .ftitle').html(row?'添加到所选项目':'添加顶级项目'), $('#fm [name=parent_id]').val(row? row.id : 0), 
    $('#fm [name=sortrank]').val(50), $('#fm [name=is_display]').attr('checked', 'checked'), $('#fm [name=is_auto_update]').attr('checked', 'checked');
    if(row){
        
    }else{
        
    }
    url = '__URL__/add';
}
function edit(){
    var row = $('#tt').treegrid('getSelected');
    if (row){
        $('#dlg').dialog('open').dialog('setTitle','编辑');
        $('#fm').form('load',row), $('#fm .ftitle').html('编辑所选项目');
        if(row.parent_id>0){
            
        }else{
            
        }
        url = '__URL__/edit&id='+row.id;
    }
}
function save(){
    $('#fm').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if (result.status){
                $('#dlg').dialog('close');
                $('#tt').treegrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.info||'系统出现错误'
                });
            }
        }
    });
}
function del(){
    var row = $('#tt').treegrid('getSelected');
    if (row){
        $.messager.confirm('Confirm','确定要删除所选项吗？',function(r){
            if (r){
                $.post('__URL__/del', {id:row.id},function(result){
                    if (result.status){
                        $('#tt').treegrid('reload');
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.info
                        });
                    }
                },'json');
            }
        });
    }
}
</script>

</body>
</html>