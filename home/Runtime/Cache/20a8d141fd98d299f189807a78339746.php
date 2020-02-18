<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">
    <meta content="yes" name="apple-mobile-web-app-capable">
    <meta content="black" name="apple-mobile-web-app-status-bar-style">
    <meta content="telephone=no" name="format-detection">
    <title>好孕妈妈</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/aj/css/LCalendar.min.css">
    <style> 
	table{border-collapse:collapse;border-spacing:0;border-left:1px solid #888;border-top:1px solid #888;background:#efefef;}
	th,td{border-right:1px solid #888;border-bottom:1px solid #888;padding:5px 15px;}
	th{font-weight:bold;background:#ccc;}
	input {
        width: 20%;
        height: 40px;
        font-size: 18px;
        border: 1px solid #b72f20;
        border-radius: 5px;
        margin: 20px 1%;
        padding: 5px;
    }
    body {
        font-family: Helvetica Neue, Helvetica, Arial, sans-serif;
        -webkit-text-size-adjust: 100%;
        -webkit-overflow-scrolling: touch;
        overflow-scrolling: touch;
    }
    button {
        width: 15%;
        height: 50px;
        font-size: 18px;
        border: 1px solid #b72f20;
        border-radius: 5px;
        margin: 20px 5% 0 5%;
        padding: 5px;
        background: red;
    }
	</style> 
	
	<script type='text/javascript'>
          var _vds = _vds || [];
          window._vds = _vds;
          (function(){
            _vds.push(['setAccountId', '87405247014f637f']);
            (function() {
              var vds = document.createElement('script');
              vds.type='text/javascript';
              vds.async = true;
              vds.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'dn-growing.qbox.me/vds.js';
              var s = document.getElementsByTagName('script')[0];
              s.parentNode.insertBefore(vds, s);
            })();
          })();
    </script>
    <script type="text/javascript">
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth / 640;
        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale + ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">')
            } else {
                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale + ' , target-densitydpi=device-dpi">')
            }
        } else {
            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">')
        }
    </script>
    
</head>

<body style="margin: 0px;">

<div style="display:;">
    时间：<input id="demo1" onmousedown="return false" type="text" readonly="" placeholder="日期选择特效" data-lcalendar="2016-05-11,2016-05-11" />
   ——<input id="demo2" type="text" onmousedown="return false" readonly="" placeholder="日期选择特效" data-lcalendar="2016-05-11,2016-05-11" />
    <button type="button" onclick="search()" >查询</button>
</div>
<table border="1">
	<thead>
		<tr>
			<th style="width:20%;">姓名</th>
			<th style="width:30%;">手机</th>
			<th style="width:20%;">消费金额</th>
			<th style="width:20%;">券金额</th>
			<th style="width:10%;">实际金额</th>
		</tr>
	</thead>
	<tbody>
	<?php if(is_array($list)): foreach($list as $key=>$li): ; $zjine += $li['jine'];?>
		<tr>
			<th><?php echo ($li["name"]); ?></th>
			<th><?php echo ($li["shouji"]); ?></th>
			<th><?php echo ($li['jine'] + $li['quane']); ?></th>
			<th><?php echo ($li["quane"]); ?></th>
			<th><?php echo ($li["jine"]); ?></th>
		</tr><?php endforeach; endif; ?>
	</tbody>
  
</table>
<h3>总金额：<?php echo ($zjine); ?>    总提成：<?php echo ($zjine*$ar['proportion']/100); ?></h3>
<script src="__PUBLIC__/aj/js/LCalendar.min.js"></script>
<script src="__PUBLIC__/aj/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
var proportion = "<?php echo ($ar['proportion']); ?>";//提成
function search(){
	var sdate = $('#demo1').val();
	var edate = $('#demo2').val();
	if(sdate == '') sdate ='2000-01-01 00:00:00';
	if(edate == '') edate ='2200-01-01 00:00:00';
	$.get('__URL__/report/openid/<?php echo ($arr["openid"]); ?>/sdate/'+sdate+'/edate/'+edate, function(data){
		console.log(data);
		data = eval(data);
		var ht = '';
		var zjine = 0;
		if(data instanceof Array){
			for(var i=0;i<data.length;i++){
				var li = data[i];
				zjine += Number(li.jine);
				
				ht += '<tr><th>'+li.name+'</th>';
				ht += '<th>'+li.shouji+'</th>';
				ht += '<th>'+(li.jine + li.quane)+'</th>';
				ht += '<th>'+li.quane+'</th>';
				ht += '<th>'+li.jine+'</th></tr>';
			}
		}
		
		$('tbody').html(ht);
		$('h3').html('总金额：'+zjine.toFixed(2)+'   总提成：'+(zjine*proportion/100).toFixed(2));
	});
}

var calendar1 = new LCalendar();
calendar1.init({
    'trigger': '#demo1', //标签id
    'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
    'minDate': '1900-1-1', //最小日期
    'maxDate': new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate() //最大日期
});
var calendar2 = new LCalendar();
calendar2.init({
    'trigger': '#demo2', //标签id
    'type': 'date', //date 调出日期选择 datetime 调出日期时间选择 time 调出时间选择 ym 调出年月选择,
    'minDate': '1900-1-1', //最小日期
    'maxDate': new Date().getFullYear() + '-' + (new Date().getMonth() + 1) + '-' + new Date().getDate() //最大日期
});
</script>
</body>
</html>