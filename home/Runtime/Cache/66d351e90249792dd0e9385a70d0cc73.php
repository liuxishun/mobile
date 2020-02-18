<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>月嫂详情-<?php echo ($row["title"]); ?></title>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
</head>
<body>
<div class="box">

	<!--head-->
	<div class="box-head">
		<div class="wid-1200">
		
			<div class="head-le"><a href="#"><img src="__PUBLIC__/home/images/logo.png" width="340" height="114" border="0" /></a></div>
			<div class="haad-ri">
				<div class="head-ri-zc">
					<span>
						<a href="/index.php/yymm/register">注册</a> | <a href="/index.php/yymm/login">登录</a>
					</span>
				</div>
				<div class="head-ri-nav">
					<ul>
						<li><a href="http://www.mumway.com/" class="a1">首页</a></li>
						<li><a href="http://www.mumway.com/aboutmum/">了解三个妈妈</a></li>
						<li><a href="http://www.mumway.com/ysshow/">服务项目</a></li>
						<li><a href="http://www.mumway.com/ysshow/">活动咨询</a></li>
						<li><a href="http://www.mumway.com/peixun/">专业培训</a></li>
						<li><a href="http://www.mumway.com/zhuangjia/">专家团队</a></li>
                                                <li><a href="http://www.mumway.com/aboutmum/contact.html">联系我们</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--main-->
		<!-- 左边内容 -->
	
	<div class="box-main">
			<div class="wid-1200">
			<div class="mian-left qupadding">
				<!--YANG 开始左边内容 -->
				<div class="index_20_xiaoNav">
					<p>
						当前位置：首页 > <a href='http://m.mumway.com/index.php/yymm/' style='color:black;'>月嫂</a> > 月嫂详情 ><span> <?php echo ($row["title"]); ?></span>
					</p>
				</div>
				<div class="index_20_banner">
					<img src="__PUBLIC__/home/images/index_2101.png">
				</div>
				<div class="index_21_Conhead">
					<div class="index_21_Conheadimg">
						<img src="<?php echo ($row["pic"]); ?>">
					</div>
					<div class="index_21_ConheadWord">
						<h2><?php echo ($row["title"]); ?><span>（好孕妈妈认证） </span></h2>
						<h3>会员价：
							
						<span><?php echo ($hwin[0]['price']); ?>元/月</span> 市场价：<span class="shanxu"><?php echo ($hwin[0][old_price]); ?>元/月</span>  
							
						</h3>
						<ul class="index_21_ConheadWordlist">
							<li>年龄：<span><?php echo ($row["age"]); ?></span></li>
							<li>属相：<span><?php echo ($row["shuxiang"]); ?></span></li>
							<li>星座：<span><?php echo ($row["xingzuo"]); ?></span></li>
							<li>籍贯：<span><?php echo ($row["dizhi"]); ?></span></li>
							<li>民族：<span><?php echo ($row["minzu"]); ?></span></li>
							<li>工作年限：<span><?php echo ($row["experence_year_yuesao"]); ?></span></li>
							<div class="clear"></div>
							
						</ul>
						<h4>照顾宝宝数：<span><?php echo ($row["experence_baby_yuying"]); ?></span> </h4>
						<ul class="index_21_ConheadWordlist2">
							<span>评分：</span>
                                                        <?php  if($pic_num == '1'){ echo "<li></li>"; }elseif($pic_num == '2'){ echo "<li></li><li></li>"; }elseif($pic_num == '3'){ echo "<li></li><li></li><li></li>"; }elseif($pic_num == '4'){ echo "<li></li><li></li><li></li><li></li>"; }elseif($pic_num == '5'){ echo "<li></li><li></li><li></li><li></li><li></li>"; } ?>
							
							<b> <?php echo ($pic_num); ?>.0</b>
							<div class="clear"></div>
						</ul> 
						<div class="index_21_ConheadWordbotton">
							<a class="a21" href="javascript:void(0)" id="jiaru" onClick="addAppointmentCart()">感兴趣</a>       
               
							<a class="a22" id="cart_item_num" data-num="<?php echo ($cart_item_num); ?>"  href="<?php echo U('yulist'); ?>" >感兴趣阿姨<?php echo $nums<=0? '' : '('. $nums .')'; ?></a>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<div class="index_20_botton" style="padding-bottom:0px;padding-left:0px;padding-top:20px;">
					<!--ul class="index_21_bottonlist">
						<li class="borderleft"><a href="#" class="active21">技能考核认证</a></li>
						<li><a href="#">资质证书</a></li>
						<li><a href="#">妈妈点评</a></li>
						<div class="clear"></div>
					</ul-->
					<div class="clear"></div>
					
				</div>
				<div class="index_20_top3">
                                    
                                                        <h2>技能考核认证</h2>
					<div class="index_20_top3con">
						<div class="index_20_top3conn">
                                                    <?php if(is_array($row["paras"])): foreach($row["paras"] as $key=>$para): ?><ul class="index_20_top3conlist backgruond border_left21">
								<h2><?php echo ($para["skill_group"]); ?></h2>
                                                                <?php if(is_array($para["skill_vals"])): foreach($para["skill_vals"] as $key=>$val): ?><li><?php echo ($val["n"]); ?></li><?php endforeach; endif; ?> 
								<div class="clear"></div>
                                                               
							</ul><?php endforeach; endif; ?>
							<div class="clear"></div>
						</div>
					</div>
	
					<h2 class="backing02">资质证书</h2>
	
					<div class="index_20_top4con">
						<ul class="index_20_top4conlist">
                                                    <?php if($row['page_pics']){ ?>
                                                    <?php if(is_array($row["page_pics"])): foreach($row["page_pics"] as $key=>$val): ?><li>
								<div class="index_20_top4conlistimg index_20_top4conlistimg2">
									<img src="<?php echo ($val["img"]); ?> " <?php if($val['img_n']=='身份证'){echo 'data-tip="身份证已认证"';} ?> border='0'/>
								</div>
								<p><?php echo ($val["img_n"]); ?></p>
							</li><?php endforeach; endif; ?>
                                                      <?php } ?>
							<div class="clear"></div>
						</ul>
					</div>
	
					<h2 class="backing03">妈妈点评</h2>
                                        <?php if(is_array($pinhjia)): foreach($pinhjia as $key=>$pj): ?><div class="index_20_top5con" >
						<div class="index_20_top5conN1">
							<div class="index_20_top5conN1_left">
								<p>雇主：<?php echo ($pj["boss"]); ?></p>
								<p>服务时间：<?php echo ($pj["work_time"]); ?></p>
							</div>
	
							<div class="index_20_top5conN1_right">
								<!--h2>月嫂楷模，对宝宝有爱心</h2-->
								<ul class="index_20_top5conN1_rightlist">
									<span>婴儿护理 </span>
                                                                        <?php
 huli($pj['yehuli']); ?>
									<div class="clear"></div>
								</ul>
                                                                <ul class="index_20_top5conN1_rightlist">
									<span>产妇护理 </span>
                                                                        <?php
 huli($pj['chhuli']); ?>
									<div class="clear"></div>
								</ul>
                                                                <ul class="index_20_top5conN1_rightlist">
									<span>与家人相处 </span>
                                                                        <?php
 huli($pj['jrxiangchu']); ?>
									<div class="clear"></div>
								</ul>
                                                                <ul class="index_20_top5conN1_rightlist">
									<span>月子餐口味</span>
                                                                        <?php
 huli($pj['yzckouwei']); ?>
									<div class="clear"></div>
								</ul>
	
								<div class="clear"></div>
                                                                <div height='100px;'>&nbsp;<br/></div>
								<?php echo ($pj["dianping"]); ?>
								<div class="index_20_top5conN1_rightimgjiao"></div>
							</div>
						</div>
					</div><?php endforeach; endif; ?>
				</div>
				<div class="index_20_top6con">
					<div class="index_20_top6con_01">
						<h2>我们的承诺</h2>
						<img src="__PUBLIC__/home/images/index_2111.png">
						<ul>
							<li>公司资质审核</li>
							<li>公正第三方</li>
							<li>阿姨身份验证</li>
							<li>真实点评反馈</li>
							<div class="clear"></div>
						</ul>
	
					</div>
	
					<div class="index_20_top6con_02">
						<h2>您可享受</h2>
						<img src="__PUBLIC__/home/images/index_2112.png">
						<ul>
							<li>免费预约面试</li>
							<li>免费咨询热线</li>
							<div class="clear"></div>
						</ul>
					</div>
	
					<div class="index_20_top6con_03">
						<h2>如何预约面试</h2>
						<p>选定您满意的月嫂，直接拔打4000-800-661电话有我们的客服中心为您安排面试，或者点击预约面试按钮，留下您的联系方式和相关需要信息，客服中心会第一时间处理。</p>
	
					</div>
					
					
				</div>
 			</div>
                            
			<div class="main-right">
				<!--tian xie yu yue-->
				<!--div class="mian_right_top1">
					<a href="#">在线预约月嫂</a>
					<a href="#">QQ在线咨询</a>
				</div>
				<!--fu wu chen nuo-->
				<div class="right-fwcn">
					<div class="fwcn-top" style="border-bottom:none;">
						<span>服务承诺</span>
					</div>
					<div class="fwcn-cont">
						<div class="fwcn-mian">
							<span>免</span>
							<p>免费上家庭财产险，服务人员意外<br />
							险，百万承保。</p>
						</div>
						<div class="fwcn-pei">
							<span>赔</span>
							<p>母婴护理师送上户后，突然翘单，赔<br />
							付1000元。</p>
						</div>
						<div class="fwcn-tui">
							<span>退</span>
							<p>您提前预定的母婴护理师，若取消服<br />
								务，无需理由和证明，可于约定服务<br />
								时间前一周申请签单退款。</p>
						</div>
					</div>
				</div>
				<div class="clear"></div>
				<div class="qingcu"></div>
				<!--div class="index_9_rightT3">
					<h3 style="font-weight:normal;">常见问题</h3>
					<p>什么是好孕妈妈会员</p>
					<p>加入会员有什么好处</p>
				</div-->
				<div class="mian_right_top714">
					<h2>联系我们</h2>
					<h3>400-009-8566</h3>
					<h4>010-59273398</h4>
					<img src="__PUBLIC__/home/images/index_1406.jpg">
				</div>
				<!--er wei ma-->
				<div class="right-fwcn right-ewm">
					<img src="__PUBLIC__/home/images/erweima.png" width="268" height="175" border="0" />
				</div>
			</div>
		</div>
	</div>
                
	<!--footer-->
	<div class="box-footer">
		<div class="footer-ul">
			<div class="wid-1200">
				<a href="#">about us </a>
				<a href="#">好孕优势</a>
				<a href="#">月子服务</a>
				<a href="#">育婴导航</a>
				<a href="#">孕育服务</a>
				<a href="#">会员俱乐部</a>
				<a href="#">联系我们</a>
				<a href="#">服务员找工作</a>
			</div>
		</div>
		<div class="footer-p">
			<div class="wid-1200">
			电话：400-009-8566或010-59273398<br />
			公司地址：北京市朝阳区亚运村北苑路170号凯旋城D座403--405室<br />
			Copyright2013-2015 MUMWAY Corporation,ALLRights Reserved    京ICP备12034681-2 京公网备11010802009854号
			</div>	
		</div>
	</div>	
</div>

	<script type="text/javascript" src="__PUBLIC__/home/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="__PUBLIC__/home/js/demo_1.js"></script>

<script>
$(function(){
    ajaxPageBox('boss_cmts', '__URL__/hwcmts/h_id/<?php echo ($row["id"]); ?>');
});
</script>
<script type="text/javascript">
function addAppointmentCart(){
	var userid="<?php echo $userid;?>";
	if(userid==''){
            window.location.href="__URL__/login?url="+encodeURIComponent(location.href);
        return;
	}
	$.ajax({
                //url:"<?php echo U('Member/addAppointmentCart'); ?>",
		url:"<?php echo U('Yymm/addAppointmentCart'); ?>",
		type:"POST",
		dataType:"json",
		data:{
			hw_id:"<?php echo $row['id'];?>"	
		},
		success:function(data, textStatus, jqXHR){
            
          if(data.status === 1){
				alert(data.info||'添加成功');
                      location.reload();
                             $('#cart_item_num').html('预约列表('+($('#cart_item_num').data('num')*1+1)+')');
			}else{
				alert(data.info);
			}
		},
		error:function(XMLHttpRequest,errorInfo,exception){
			//alert(errorInfo);
		}
	});
}
</script>
        <script language="javascript" src="http://dct.zoosnet.net/JS/LsJS.aspx?siteid=DCT20072801&float=1&lng=cn"></script>
<script>
$(function(){
    ajaxPageBox('boss_cmts', '__URL__/hwcmts/h_id/<?php echo ($row["id"]); ?>');
})
</script>
<?php
 function huli($hulizhi){ if($hulizhi == '1'){ echo "<li></li>"; }elseif($hulizhi == '2'){ echo "<li></li><li></li>"; }elseif($hulizhi == '3'){ echo "<li></li><li></li><li></li>"; }elseif($hulizhi == '4'){ echo "<li></li><li></li><li></li><li></li>"; }elseif($hulizhi == '5'){ echo "<li></li><li></li><li></li><li></li><li></li>"; } } ?>
</body>
</html>