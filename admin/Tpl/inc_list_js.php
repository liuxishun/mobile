<script type="text/javascript">
function SelectAll(obj){
	var bl_select = obj.checked;
	var objs = document.getElementsByName("checkboxes[]");	
	for(var i=0;i< objs.length; i++){
		objs[i].checked = bl_select;
	}
}
//?action=deleteAll&id=
function DeleteAll(){
	var objs = document.getElementsByName("checkboxes[]");
	var ids = "";
	for(var i=0;i< objs.length; i++){
		if(objs[i].checked){
			ids += objs[i].value + ","
		}	
	}
	if(ids!="")	{
		ids = ids.substr(0, ids.length-1);
		return confirm("确认要删除所选记录吗？");
	}else{
		alert("请选择需要删除的数据！");
		return false;
	}
	
}

function doSearch(){
    var baseurl=searchURL;
	var ids=searchIDs;
	var paras='';	
	for(var i=0;i<ids.length;i++){
	    if($('#'+ids[i]).val()){
			paras+='&'+ids[i]+'='+encodeURIComponent($('#'+ids[i]).val());
		}
	}
	location.href=baseurl+paras;
}
function doReset(){
	var ids=searchIDs;
	for(var i=0;i<ids.length;i++){
	    if($('#'+ids[i]).get(0).type=='select-one'){
			$('#'+ids[i]).get(0).selectedIndex=0;
		}else{
		    $('#'+ids[i]).val('');
		}
	}
}
</script>