<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>月嫂列表</title>
<link type="text/css" rel="stylesheet" href="__PUBLIC__/home/css/style.css">
    <script src="__PUBLIC__/mobile/js/jquery-2.1.0.min.js"></script>
<script src="__PUBLIC__/mobile/js/main.js"></script>
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



		<div class="wid-1200">
			<div class="mian-left qupadding">
				<!--YANG 开始左边内容 -->
				<div class="clear"></div>
				<div class="index_20_xiaoNav">
				<p>
					当前位置：首页 > 月嫂 > <span> 月嫂列表</span>
				</p>
			</div>
				<div class="index_20_banner">
					<img src="__PUBLIC__/home/images/index_2001.png">
				</div>
				<div class="index_20_xuan">
					<!--ul class="index_20_xuanlist" id="yuchanqi">

						<span>预产期：</span><!--da zhi chan qi>
			<div class="sx-jj">
				<div class="sxay-dzcq">
                                        <input type="text" id="date" style="border:0 none;outline:0 none;float:left;text-align:right;padding:5px 10px;width:100px; color:gray;line-height:30px;" placeholder="选择日期" />
				</div>
			</div>	                         
						<div class="clear"></div>
					</ul-->
                                    
                                    
					<ul class="index_20_xuanlist" id="agefanwei">
						<span>年龄范围：</span>
						<li><a href="javascript:;" class="active20" value='0'>不限</a></li>
						<li><a href="javascript:;" value='1'> 25-35 &nbsp;&nbsp;&nbsp;&nbsp;</a></li>
						<li><a href="javascript:;" value='2'> 35-45 &nbsp;&nbsp;&nbsp;&nbsp;</a></li>
						<li><a href="javascript:;" value='3'> 45-55 </a></li>
						
						<div class="clear"></div>
					</ul>
	
					<ul class="index_20_xuanlist" id="yuesaotype">
						<span>期望月嫂类型：</span>
						<li><a href="javascript:;" class="active20" value="0">不限</a></li>
						<?php if(is_array($tags)): foreach($tags as $key=>$val): ?><li><a href="javascript:;" value="<?php echo ($val["name"]); ?>"><?php echo ($val["name"]); ?></a></li><?php endforeach; endif; ?>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="index_20_botton">
					<!--ul class="index_20_bottonlist">
						<li class="borderleft"><a href="#" class="active21">全部</a></li>
						<li><a href="#">默认</a></li>
						<li><a href="#">最新</a></li>
						<li><a href="#">薪资</a></li>
						<div class="clear"></div>
					</ul>
					<p class="index_20_bottonpp">
						共有 <span><?php echo ($count); ?></span> 位月嫂     <span>1</span>/<i>6</i>
						<a href="#"><</a>
						<a href="#">></a>
					</p-->
					<div class="clear"></div>
				</div>
				<ul class="index_20_conlist">
                                     <?php  $level_srcs = array('0'=>$_root.'Public/mobile/images/level_1.png', '1'=>$_root.'Public/mobile/images/level_1.png', '2'=>$_root.'Public/mobile/images/level_1.png', '3'=>$_root.'Public/mobile/images/level_3.png', '4'=>$_root.'Public/mobile/images/level_4.png', '5'=>$_root.'Public/mobile/images/level_5.png', '6'=>$_root.'Public/mobile/images/level_6.png', '7'=>$_root.'Public/mobile/images/level_7.png', ); ?>
                                    <?php if(is_array($list)): foreach($list as $key=>$val): ?><li>
						<div class="index_20_conlistimg">
							<a href="__URL__/detail?id=<?php echo ($val["id"]); ?>">
								<img src="<?php echo ($val["pic"]); ?>">
							</a>
							<div>
								<img src="<?php echo $level_srcs[$val['level_num']>7? 7 : $val['level_num']]; ?>">
							</div>
						</div>
						<div class="index_20_conlistword">
							<h2><a href="__URL__/detail?id=<?php echo ($val["id"]); ?>"> <?php echo ($val["title"]); ?></a>  <span>会员价:￥<em><?php echo ($val["price"]); ?></em>元/月</span></h2>
							<ul class="index_20_conlistwordlist">
								<li>籍贯： <span><?php echo ($val["area_ids_nam"]); ?> </span></li>
								<li>年龄： <span><?php echo ($val["age"]); ?> </span></li>
								<li>经验： <span><?php echo ($val["experence_year"]); ?> </span></li>
								<li>生肖： <span><?php echo ($val["shuxiang"]); ?> </span></li>
								<li>星座： <span><?php echo ($val["xingzuo"]); ?> </span></li>
							
								<div class="clear"></div>
								
							</ul>
                                                        <?php
 $cmt_row = M('pingjia')->where(array('h_id'=>$val['id']))->order('id DESC')->find(); ?>
							<p><span> [ 顾问评价]：</span><?php echo substring($cmt_row['dianping'], 50); ?><!--a href="#">[更多]</a></p-->
							
						</div>
						<div class="clear"></div>
					</li><?php endforeach; endif; ?>
				</ul>
				<div class="index_20_fenye">
					<ul class="index_20_fenyelist" style='width:475px;'>
						<?php echo ($page); ?>
					</ul>
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
               <script type="text/javascript">
  
       $(function(){
           
         
           $("#agefanwei li a").each(function(){
               $(this).click(function(){
                   $("#agefanwei li a").removeClass("active20");
                   $(this).addClass("active20");
                   //获取当前月
                     var curemonth = remonth();
                   //获取当前年龄
                   var agevaluea = $(this).attr('value');
                   //获取当前类型
                   var typevalua= typecure() ;
                   //执行请求
                   requestdata(curemonth,agevaluea,typevalua);
               });
           });
           

           $("#yuesaotype li a").each(function(){
               $(this).click(function(){
                   $("#yuesaotype li a").removeClass("active20");
                   $(this).addClass("active20");
                     //获取当前月
                     var curemonthy = remonth();
                   //获取当前年龄
                   var agevaluey = agecure() ;
                   //获取当前类型
                   var typevaluey= $(this).attr("value") ;
                   //执行请求
                   requestdata(curemonthy,agevaluey,typevaluey);
               });
           });
           
           //获取当前年龄
           function agecure(){
               var agevalue = '' ;
                   $("#agefanwei li a").each(function(){
                        agevalue = $(this).attr('class');
                        if(agevalue === 'active20'){
                            ageresult = $(this).attr('value');
                        }
                   });
                   return ageresult  ;
           };
           //获取当前类型
           function typecure(){
               var typevalue = '' ;
                   $("#yuesaotype li a").each(function(){
                        typevalue = $(this).attr('class');
                        if(typevalue === 'active20'){
                            ageresults = $(this).attr('value');
                        }
                   });
                   return ageresults  ;
           };
           //获取当前月
           function remonth(){
               var monthvasg = '' ;
               monthvasg = $("#date").attr('value');
               return monthvasg ;
           }
           
           function requestdata(curemonth,agedata,typedata){
               //alert(curemonth);
               if(curemonth == ''){
                   alert('请选择您的预产期');
               }else{
                  var url = "/index.php/yymm/yuyue/month/"+curemonth+"/age/"+agedata+"/type/"+typedata ;
               window.location.href=url ; 
               }  
           }
       });
        </script>
  <?php
 if($_GET['type']){ ?>
    <script type="text/javascript">
      $("#yuesaotype li a").each(function(){
          var va  = $(this).attr('value');
          var vas = "<?php echo $_GET['type'] ;?>" ;
         if(va == vas){
             $("#yuesaotype li a").removeClass("active20");
             $(this).addClass('active20') ;
         }
      });
   </script>

  <?php
 } if($_GET['age']){ ?>
    <script type="text/javascript">
      $("#agefanwei li a").each(function(){
          var vad  = $(this).attr('value');
          var vasd = "<?php echo $_GET['age'] ;?>" ;
         if(vad == vasd){
             $("#agefanwei li a").removeClass("active20");
             $(this).addClass('active20') ;
  
         }
      });
   </script>

  <?php
 } if($_GET['month']){ ?>
   <script type="text/javascript">
       var monthinfo = "<?php echo $_GET['month'] ;?>";
       
    $("#date").attr('value',monthinfo);
   </script>

<?php }?>
                                                
<link rel="stylesheet" href="http://lib.sinaapp.com/js/jquery-ui/1.9.2/themes/smoothness/jquery-ui.css" type="text/css"/>
<script type="text/javascript" src="http://lib.sinaapp.com/js/jquery-ui/1.9.2/jquery-ui.min.js"></script>
<script>
<?php $y = date('Y'); ?>
$(function(){
    $('#date').datepicker({
        yearRange: "<?php echo ($y-100); ?>:<?php echo ($y); ?>",
        duration: '', 
        dateFormat: 'yy-mm-dd',
        regional:'zh-CN',
        //changeMonth: true,
        //changeYear: true
    }).change(function() {
    })
});
</script>
</body>
</html>