<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title></title>
<link rel="stylesheet" type="text/css" href="/Public/my/css/main.css">
<link rel="stylesheet" type="text/css" href="/Public/my/css/style.css">
<!---------------------------抓取------------------------------------------------->
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
<!---------------------------适配------------------------------------------------->
<script type="text/javascript">
    var phoneWidth = parseInt(window.screen.width);
    var phoneScale = phoneWidth / 750;
    var ua = navigator.userAgent;
    if (/Android (\d+\.\d+)/.test(ua)) {
        var version = parseFloat(RegExp.$1);
        if (version > 2.3) {
            document.write('<meta name="viewport" content="width=750, initial-scale= ' + phoneScale + ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale + ', target-densitydpi=device-dpi">')
        } else {
            document.write('<meta name="viewport" content="width=750, initial-scale= ' + phoneScale + ' , target-densitydpi=device-dpi">')
        }
    } else {
        document.write('<meta name="viewport" content="width=750, user-scalable=no, target-densitydpi=device-dpi">')
    }
</script>
</head>

<body style="background-color:#f9f9f9;">
<header>
    <a class="sub_site" href="javascript:void(0);" onclick="javascript:history.back(-1)"><i class="iconfont"> &lt; </i></a>
    <a class="sub_tit" href="javascript:void(0);">快速报价</a>
</header>
<section class="section">
	<div class="write_ban">
    	<img class="write_ban_img" src="/Public/my/images/tianxie_02.png">
    </div>
    <div class="write_con">
        <form>
            <P class="write_con_p1">已为<span>15498位</span>妈妈进行报价并匹配最佳月嫂、育儿嫂</P>
            <P class="write_con_p2">
				<select class="write_con_sel" name="address" id="address">
					<option value="北京">北京</option>
					<option value="青岛">青岛</option>
					<option value="天津">天津</option>
					<option value="广州">广州</option>
					<option value="深圳">深圳</option>
					<option value="太原">太原</option>
					<option value="长沙">长沙</option>
					<option value="福州">福州</option>
					<option value="武汉">武汉</option>
					<option value="成都">成都</option>
				</select>
			</P>
			<P class="write_con_p2">
				<select class="write_con_sel" name="type" id="type">
					<option value="1">月嫂</option>
					<option value="2">育儿嫂</option>
				</select>
			</P>
            <P class="write_con_p2" style="display: none;">
				<span>我的预产期是</span>
				<input type="text" placeholder="2017年6月18日" class="write_con_inp" name="picktime1" id="picktime1" readonly>
			</P>
            <P class="write_con_p3">你期望的月嫂/育儿类型</P>
            <ul class="write_con_ul">
            	<li style="opacity: 1;"><label>
                	<p class="write_con_ul_p1">高级月嫂/育儿嫂</p>
                    <P class="write_con_ul_p2">专业培训，踏实用心</P>
                    <input type="radio" name="dang" value="高级月嫂/育儿嫂" checked>
                </label></li>
                <li><label>
                	<p class="write_con_ul_p1">五星月嫂/育儿嫂</p>
                    <P class="write_con_ul_p2">护理过20-30个宝宝</P>
                    <input type="radio" name="dang" value="五星级月嫂/育儿嫂">
                </label></li>
                <li><label>
                	<p class="write_con_ul_p1">金牌月嫂/育儿嫂</p>
                    <P class="write_con_ul_p2">精英认证，100%好评</P>
                    <input type="radio" name="dang" value="金牌月嫂/育儿嫂">
                </label></li>
                <li><label>
                	<p class="write_con_ul_p1">明星月嫂/育儿嫂</p>
                    <P class="write_con_ul_p2">医学背景，高端之选</P>
                    <input type="radio" name="dang" value="明星月嫂/育儿嫂">
                </label></li>
            </ul>
            <P class="write_con_p4"><input type="text" placeholder="请填写您的真实号码, 以便为您匹配优秀阿姨" name="shouji" id="shouji"></P>
            <P class="write_con_p5"><span>*</span> 您的信息将严格保密，请放心填写</P>
            <P class="write_con_p6"><input type="button" value="获取报价，免费获得育儿宝典" onclick="xiayibu()"></P>
        </form>    
    </div>
	<p id="company" style="color:#b1b1b1; margin-top:0px;line-height: 100px;text-align: center;font-size: 24px;">北京好孕妈妈教育咨询有限公司</p>
</section>
<!--<footer>
	<ul>
		<li><a  href="javascript:void(0);" onclick="javascript:history.back(-1)"><i class="iconfont"></i><span>首页</span></a></li>
        <li><a class="cur" href="http://oa.mumway.cn/guanli2.php?s=/my/yuyue"><i class="iconfont"></i><span>月嫂/育儿嫂</span></a></li>
		<li><a href="tel:4000098566"><div><i class="iconfont"></i></div></a></li>
        <li><a href="javascript:void(0);" onclick="javascript:history.back(-1)"><i class="iconfont"></i><span>知识答疑</span></a></li>
		<li><a href="http://dct.zoosnet.net/lr/chatpre.aspx?id=dct20072801&amp;lng=cn&amp;r=&amp;rf1=&amp;rf2=&amp;p=http%3A//cs.mumway.com%3A8080/fuwu/goIndex%3Faddress%3D%25E5%258C%2597%25E4%25BA%25AC&amp;cid=1492756926282429178717&amp;sid=1492756926282429178717"><i class="iconfont"></i><span>在线咨询</span></a></li>
		<div class="clear"></div>
	</ul>
</footer>-->
<!-----------------时间------------------------------>
<link rel="stylesheet" href="/Public/my/css/zepto.mdatetimer.css">
<script src="/Public/my/js/zepto.js"></script>
<script src="/Public/my/js/zepto.mdatetimer.js"></script>

<script type="text/javascript">
	function xiayibu(){
		var shouji=$("#shouji").val();
		if(shouji==""){
			alert("手机号不能为空！");
			return false;
		}
		if (!$("#shouji").val().match(/^1(3|4|5|7|8)\d{9}$/)) { 
			alert("手机号码格式不正确！"); 
			return false; 
		} 
		var objrct = {};
		objrct.type = $('select[name="type"]').val();//1是月嫂2是育儿嫂
		objrct.address = $("#address").val();//地址
		objrct.shouji = shouji;//手机
		objrct.guanzhu = $("input[name='dang']:checked").val();//关注
		//objrct.experience = $('select[name="experience"]').val();//阿姨经验
		//objrct.certificate = $('select[name="certificate"]').val();//工作证书
		//objrct.code = $('input[name="code"]').val();
		objrct.riqi = $("#picktime1").val();//日期
		objrct.xinxi = '快速报价';//详情
   		objrct.biaoshi = $.cookie('pushname')!= undefined?$.cookie('pushname'):'无';
   		var tp = $.cookie('pushurl')!= undefined?$.cookie('pushurl'):'无';
   		objrct.biaoshitp = tp+'提交页面:'+location.href;
		
		$.ajax({
			url:"http://oa.mumway.cn/index.php?s=/ax/serviceOffer",
			data: objrct,
			type:"post",
			success:function(msg){
				if(msg==2){
					alert("不可重复申请。")
				}else if(msg==1){
					alert("为了给您更精准的报价，我们的母婴顾问会第一时间为您查询阿姨资料，并提供人工报价！感谢您的信任！")
				}else{
					alert("申请失败。")
				}
			}
		})
	}
	
	var config = {
		mode : 1, //时间选择器模式：1：年月日，2：年月日时分（24小时），3：年月日时分（12小时），4：年月日时分秒。默认：1
		format : 1, //时间格式化方式：1：2015年06月10日 17时30分46秒，2：2015-05-10  17:30:46。默认：2
		years : [2017, 2018, 2019, 2020, 2021], //年份数组
		nowbtn : false, //是否显示现在按钮
		onOk : function(){
			//alert('OK');
		},  //点击确定时添加额外的执行函数 默认null
		onCancel : function(){
			//alert('A');
		},
	};
	$('#picktime1').mdatetimer(config);
	
	$(function(){
		$(".write_con_ul li").click(function(e) {
            $(this).css('opacity',1);
			$(this).siblings().css('opacity',0.5);
        });
	})
</script>
<script src="http://bjm.mumway.com/static/js/jquery-1.8.2.min.js"></script>
<script src="http://bjm.mumway.com/static/js/jquery.cookie.js"></script>
<script src="http://bjm.mumway.com/static/js/promote.js"></script>

</body>
</html>