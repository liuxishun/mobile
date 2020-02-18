<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-cn">
<head>
<title></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

    body,div,p,input,h1,h2,h3,h4,ul,li,ol,dl,dd,dt,a,img,button{ padding:0; margin:0; border:0; list-style:none;}

    body{width:640px; height:100%; overflow:hidden; background-size:cover; font-family:"宋体";}
    input[type="submit"],input[type="reset"],input[type="button"],button { -webkit-appearance: none; }
    
    ::-webkit-input-placeholder { /* WebKit browsers */
    　　color:#999;
    　　}
    　　:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    　　color:#999;
    　　}
    　　::-moz-placeholder { /* Mozilla Firefox 19+ */
    　　color:#999;
    　　}
    　　:-ms-input-placeholder { /* Internet Explorer 10+ */
    　　color:#999;
    　　}
    
</style>
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
        var H = $(window).height();
        $("body").height(H);
		$(".container").height(H);
    })

</script>
</head>
<body style="background:#000;">
<div class="container" style="width:640px; overflow:hidden; position:relative; top:50%; margin-top:-234px; height:469px;" >
	<img src="/<?php echo ($ul); ?>" style="width:100%; position:absolute; left:0; top:0;">
    <P style="text-align:right; font-size:18px; color:#000; position:absolute; width:90px; top:193px; left:75px;"></P>
</div>

</body>
</html>