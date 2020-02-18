<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>感兴趣阿姨-列表</title>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
<script src="__PUBLIC__/mobile/js/jquery-2.1.0.min.js"></script>
<script src="__PUBLIC__/mobile/js/main.js"></script>

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
 <?php  $level_srcs = array('0'=>$_root.'Public/mobile/images/level_1.png', '1'=>$_root.'Public/mobile/images/level_1.png', '2'=>$_root.'Public/mobile/images/level_1.png', '3'=>$_root.'Public/mobile/images/level_3.png', '4'=>$_root.'Public/mobile/images/level_4.png', '5'=>$_root.'Public/mobile/images/level_5.png', '6'=>$_root.'Public/mobile/images/level_6.png', '7'=>$_root.'Public/mobile/images/level_7.png', ); ?>
<style>
.tab-hd{display:-webkit-box;margin:10px;}
.tab-hd a{display:block;-webkit-box-flex:1;text-align:center;color:#ff526b;border:1px solid #ff526b;padding:5px 0;}
.tab-hd a:nth-of-type(1){border-radius:5px 0 0 5px;}
.tab-hd a:last-of-type{border-radius:0 5px 5px 0;}
.tab-hd a.cur{color:#FFF;background-color:#ff526b;}

.tab-item{display:none;}
.tab-item.cur{display:block;}
</style>
         

<style>
.check{width:23px;height:23px;line-height:23px;display:inline-block;background-color:#bbb;border-radius:12px;text-align:center;float:right;}
.sxay-list-check .check{background-color:#ff526b;}
.check:before{content:'√';font-size:12px;color:#FFF;}
</style>

		<div class="wid-1200">
			<div class="mian-left qupadding">
				<!--YANG 开始左边内容 -->
				<div class="clear"></div>
				<div class="index_20_xiaoNav">
				<p>
					当前位置：首页 > 月嫂 ><span> 月嫂详情</span>
				</p>
			</div>
				<div class="index_20_banner">
					<img src="__PUBLIC__/home/images/index_2001_02.png">
				</div>
                                	<?php $i=0; ?>
                            <?php if(is_array($types)): foreach($types as $k=>$ty): ?><div class="tab-item <?php if($i==0)echo 'cur'; ?>">
				<ul class="index_20_conlist gxq-leftbg" id="addclass">     
                         
                                       <?php if(is_array($list)): foreach($list as $key=>$val): ?><li data-type="<?php echo ($k); ?>" data-id="<?php echo ($val["id"]); ?>" onClick="checkHw(this)">
						<div class="index_20_conlistimg">
							 <a href="javascript:;">
								  <img src="<?php echo ($val["pic"]); ?>" width="75" height="90" border="0" />
							</a>
							<div>
								<em>
                                                            <img src="<?php echo $level_srcs[$val['level_num']>7? 7 : $val['level_num']]; ?>" width="30" height="30" border="0" />
                                                            </em>
							</div>
						</div>
						<div class="index_20_conlistword">
							<h2><a href="javascript:;"><?php echo ($val["title"]); ?></a> <span>会员价：<i><?php echo ($val["price"]); ?>元/月</i></span> </h2>
							<ul class="index_20_conlistwordlist padtop30">
								<li>籍贯： <span><?php echo ($val["area_ids_nam"]); ?> </span></li>
								<li>年龄： <span><?php echo ($val["age"]); ?> </span></li>
								<li>经验： <span><?php echo ($val["experence_year"]); ?> </span></li>
								<li>属性： <span><?php echo ($val["shuxiang"]); ?> </span></li>
								<li>星座： <span><?php echo ($val["xingzuo"]); ?> </span></li>
                                                                <li><a class="ajax-link" href="<?php echo U('Member/removeCartItem', 'id='.$val['id']); ?>">删除</a></li>
								<div class="clear"></div>
							</ul>
							
						</div>
						<div class="clear"></div>
					</li><?php endforeach; endif; ?>
		</div>
            <?php $i++; ; endforeach; endif; ?>		
	
	
					
					
					<li>
						
						<div class="gxq-yywz">
							<p>您可以选择3位月嫂/婴儿嫂 进行面试<br />
若需要更多，请提交预约后，母婴顾问联系您时，可告知需求为您协调</p>
<span></span>
						</div>
						<div class="qxq-yy-but">
                                                    
							<a href="javascript:;" class="gxq-yyms-but" onClick="addP(this)">预约面试</a>
							<a href="<?php echo U('yymm/index'); ?>" class="gxq-jxxz-but" >继续选择</a>
						</div>
						<div class="clear"></div>
					</li>
	
				</ul>	
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
$('.ajax-link').live('click', function(){
    if(confirm('确定删除吗？')){
      $.get($(this).attr('href'), function(d){
          d.status==1? (location.reload()) : (Systip.show(d.info||'删除失败'));
        }, 'json')
    }
    return false;
});
function showTab(idx){
    $('.tab-hd a').removeClass('cur').eq(idx).addClass('cur');
    $('.tab-item').removeClass('cur').eq(idx).addClass('cur');
}
var G_T='',G_IDS=[];
function checkHw(obj){
    obj=$(obj);
    if(G_T!='' && obj.data('type')!=G_T){
        Systip.show('不能同时选择不同类型阿姨 进行面试');
        return false;
    }
    var idx=G_IDS.indexOf(obj.data('id'));
    if(idx!=-1){
        obj.removeClass('sxay-list-check');
        G_IDS.splice(idx, 1);
        G_IDS.length==0 && (G_T='')
        return false;
    }
    if(G_IDS.length==3){
        Systip.show('选择的阿姨不能超过3个');
         $("#addclass > li").each(function(){
               $(this).click(function(){
                  // $("#yuesaotype li a").removeClass("active20");
                   $(this).removeClass("bor-col");  
                   $(this).removeClass("active20");
               });
           });
        return false;
    }
    obj.addClass('sxay-list-check');
    G_T = obj.data('type');
    G_IDS.push(obj.data('id'));
}
function addP(obj){
    if(G_IDS.length==0){
        Systip.show('请选择需要预约的阿姨');
        return false;
    }
    location.href='<?php echo U('addAppointment', 'ids=0'); ?>'+G_IDS.join(',');
}
   $("#addclass > li").each(function(){
               $(this).click(function(){
                  // $("#yuesaotype li a").removeClass("active20");
                   $(this).toggleClass("bor-col");    
               });
           });
</script>



</body>
</html>