<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>月嫂详情</title>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
<script src="__PUBLIC__/mobile/js/jquery-2.1.0.min.js"></script>
<script src="__PUBLIC__/mobile/js/main.js"></script>
</head>

<body>
<style>
.date-pick{padding:10px 0;}
.date-pick .hd{background-color:#FFF;clear:both;display:-webkit-box;padding:8px 0;border:1px solid #d1d1d1;border-radius:7px;}
.date-pick .hd a{display:block;border-right:1px solid #e3e3e3;-webkit-box-flex:1;text-align:center;color:#ccc;}
.date-pick .hd a.dis{color:#CCC;}
.date-pick .hd a.cur{color:#000;}
.date-pick .hd a:last-of-type{border-right:0 none;}
.date-pick .hd a.arr{line-height:36px;}
.date-pick .bd{overflow:hidden;zoom:1;border-top:1px solid #F3ADBB;border-left:1px solid #F3ADBB;margin-top:5px;}
.date-pick .bd span{background-color:#FDF2F4;width:25%;float:left;}
.date-pick .bd span a{display:block;text-align:center;line-height:32px;border-right:1px solid #F3ADBB;border-bottom:1px solid #F3ADBB;}
.date-pick .bd span a.dis{background-color:#f1f1f1;}
</style>
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
						<li><a href="#" class="a1">首页</a></li>
						<li><a href="#">了解三个妈妈</a></li>
						<li><a href="#">优惠活动</a></li>
						<li><a href="#">媒体报道</a></li>
						<li><a href="#">母婴护理学院</a></li>
						<li><a href="#">品牌加盟</a></li>
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
						当前位置：首页 > 月嫂 ><span> 月嫂详情</span>
					</p>
				</div>
				<div class="index_20_banner">
					<img src="__PUBLIC__/home/images/2015082601.png">
				</div>
				<div class="yang15082601">
					<h2>您选择的阿姨是</h2>
                                        <?php if(is_array($list)): foreach($list as $key=>$val): ?><a href="javascript:void(0)">
						<img src="<?php echo ($_root); ; echo ($val["pic"]); ?>">
						<p><?php echo ($val["title"]); ?></p>
					</a><?php endforeach; endif; ?>
					<div class="clear"></div>
				</div>
                                <!-- 表单开始--->
                                
                                
                                
				<form id="form" class="yang15082602conN4">
                                <input type="hidden" name="hw_ids" value="<?php echo implode(',', $ids); ?>" />   
                                    
					    <div class="yang15082601  yang15082602">
						<h2>您选择的时间是<?php echo implode(',', $ids); ?></h2>
						<div class="yang15082602con">
                                                   <div class="yy-list-sj">
                                                            <a href="javascript:;" onClick="$('.date-pick').show();">
                                                            <img src="__PUBLIC__/mobile/images/yuyue-tb01.png" width="15" height="16" border="0" />
                                                            请选择预约时间
                                                            <font id="plan_date"></font><input name="plan_date" value="" type="hidden" />
                                                            </a>
                                                   </div>
                                                   <style>
                                                        .date-pick{padding:10px 0;}
                                                        .date-pick .hd{background-color:#FFF;clear:both;display:-webkit-box;padding:8px 0;border:1px solid #d1d1d1;border-radius:7px;}
                                                        .date-pick .hd a{display:block;border-right:1px solid #e3e3e3;-webkit-box-flex:1;text-align:center;color:#ccc;}
                                                        .date-pick .hd a.dis{color:#CCC;}
                                                        .date-pick .hd a.cur{color:#000;}
                                                        .date-pick .hd a:last-of-type{border-right:0 none;}
                                                        .date-pick .hd a.arr{line-height:36px;}
                                                        .date-pick .bd{overflow:hidden;zoom:1;border-top:1px solid #F3ADBB;border-left:1px solid #F3ADBB;margin-top:5px;}
                                                        .date-pick .bd span{background-color:#FDF2F4;width:25%;float:left;}
                                                        .date-pick .bd span a{display:block;text-align:center;line-height:32px;border-right:1px solid #F3ADBB;border-bottom:1px solid #F3ADBB;}
                                                        .date-pick .bd span a.dis{background-color:#f1f1f1;}
                                                  </style>
                                                  <div id="box_date_pick"></div>
                                                  <script>
                                                        ajaxPageBox('box_date_pick', '<?php echo U('getWorkerDates', array('cid'=>$data['id'])); ?>')
                                                  </script>
						
						
						</div>
						<div style="height:50px;"></div>
						<h2 class="img02">您选择的面试方式是</h2>
                                                
                                                
                                                
						<div class="yang15082602conN3">
							<!--a href="#">到店面试</a>
							<a class="img2" href="#">到店面试</a>
							<a class="img3" href="#">到店面试</a--> 
                                                        <select name="meet_type" style="width:300px;height:30px;border-radius: 6px;">
                                                            <option value="">请选择面试方式</option>
                                                            <option value="到店面试">到店面试</option>
                                                            <option value="上门面试">上门面试</option>
                                                            <option value="视频面试">视频面试</option>
                                                         </select>
						</div>
                                                
                                                
                                                
						<div style="height:30px;"></div>
						<h2 class="img03">您预留的信息是</h2>
							<ul>
								<li id="demo"><label></label><input type="text" name="username" value="<?php echo ($user["truename"]); ?>" placeholder="姓名:"></li>
								<li class="img02"><label></label><input type="text" name="tel"  value="<?php echo ($user["mobile"]); ?>" placeholder="电话:"></li>
								<li class="img03"><label></label><input type="text" name="address" placeholder="地址:"></li>
								<li class="img03"><label></label><input type="text" name="street" placeholder="门牌号:"></li>
								<li class="img04"><label></label><input type="text" name="memo" placeholder="备注:"></li>
							</ul>
							<a href="javascript:void(0)" onClick="post()" style="  display: block;margin: 50px auto 0;line-height: 50px;width: 285px;height: 50px;background-color: #773b8f;text-align: center;font-size: 20px;color: #fff;border-radius: 10px;">预约面试</a>
						 </form>
					<div class="clear"></div>
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
				<div class="mian_right_top1">
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
				<div class="index_9_rightT3">
					<h3 style="font-weight:normal;">常见问题</h3>
					<p>什么是好孕妈妈会员</p>
					<p>加入会员有什么好处</p>
				</div>
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
	


</div>

	
        <script>
ajaxPageBox('box_date_pick', '<?php echo U('getWorkerDates', array('cid'=>$data['id'])); ?>')
</script>
<script>
function post(){
    if($('[name="plan_date"]').val().length==0){
        alert('请选择预约时间');$('[name="plan_date"]').focus();
        return false;
    }
    if($('[name="meet_type"]').val().length==0){
        alert('请选择面试方式');$('[name="meet_type"]').focus();
        return false;
    }
    if($('[name="username"]').val().length==0){
        alert('请输入联系人');$('[name="username"]').focus();
        return false;
    }
    if($('[name="tel"]').val().length==0){
        alert('请输入联系电话');$('[name="tel"]').focus();
        return false;
    }
    if($('[name="address"]').val().length==0){
        alert('请输入服务地址');$('[name="address"]').focus();
        return false;
    }
    if($('[name="street"]').val().length==0){
        alert('请输入街道');$('[name="street"]').focus();
        return false;
    }
    
    $.post('__SELF__', $('#form').serialize(), function(d){
        d.status==1? (alert('预约成功'), location.href='<?php echo U('yulist'); ?>') : (alert(d.info||'提交失败'));
    }, 'json');
}
</script>

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
<script type="text/javascript" src="__PUBLIC__/home/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/home/js/demo_1.js"></script>
</body>
</html>