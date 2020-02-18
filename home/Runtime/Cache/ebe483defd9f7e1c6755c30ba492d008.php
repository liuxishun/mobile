<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>好孕妈妈</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/css/quan.css">
        <!-------------------百度统计------------------------->
		<script type='text/javascript'>
      var _vds = _vds || [];
      window._vds = _vds;
      (function(){
        _vds.push(['setAccountId', 'b7af4d25c353148d']);
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
  <script type='text/javascript' src='https://assets.growingio.com/sdk/wx/vds-wx-plugin.js'></script>

    <!-------------------百度统计------------------------->	
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
    <script src="__PUBLIC__/ke/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			
		});

    </script>
</head>

<body style="background-color: #f3f3f3;">
    <section class="section section1">
        <ul class="yhq">
        <?php if(is_array($list)): foreach($list as $key=>$li): ?><li>
            	<?php if($pd["ul"] != null): ?><a href="__URL__/zhifu?<?php echo ($pd["ul"]); ?>=<?php echo ($pd["kcid"]); ?>&qid=<?php echo ($li["id"]); ?>&openid=<?php echo ($pd["openid"]); ?>">
               	<?php else: ?>
               		<a href="javascript:;"><?php endif; ?>
            	<?php if($li["qtype"] == 0): ?><div class="yhq_d3">
               		<P class="yhp_d1_p2">元课程券</P>
               		
                    <span class="yhp_d1_s1"><?php echo ($li["jine"]); ?></span>
                </div>
                <P class="yhp_d1_p3" style="text-align:center; font-size:26px; line-height:50px; background:#fff; color:#565656; padding:0; margin-right:4px;"><?php echo ($li["shu"]); ?>张</P>
                <?php elseif($li["id"] == 4): ?>
                <img alt="" src="/Public/ke/img/9quan.jpg" style="width: 100%;height: 202px;">
                <P class="yhp_d1_p3" style="text-align:center; font-size:26px; line-height:50px; background:#fff; color:#565656; padding:0; margin-right:4px;"><?php echo ($li["shu"]); ?>张</P>
               	<?php else: ?>
               	<div class="yhq_d2">
               		<P class="yhp_d1_p2">元直播券</P>
               		
                    <span class="yhp_d1_s1"><?php echo ($li["jine"]); ?></span>
                </div>
                <P class="yhp_d1_p3" style="text-align:center; font-size:26px; line-height:50px; background:#fff; color:#565656; padding:0; margin-right:4px;"><?php echo ($li["shu"]); ?>张</P><?php endif; ?>
            	</a>
            </li><?php endforeach; endif; ?>
        
        </ul>
    </section>
</body>
</html>