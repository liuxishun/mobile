<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>服务项目</title>
	<meta name="format-detection" content="telephone=no" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport" />
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/weixin/css/public.css">
	<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/weixin/css/style.css">
  <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
 
  	<link rel="stylesheet" type="text/css" href="__PUBLIC__/static/weixin/css/css/main.css">
	<script src="/Public/static/weixin/js/js/jquery.min.js"></script>
  <script src="/Public/static/weixin/js/js/hammer.min.js"></script>
   <script src="/Public/static/weixin/js/js/hammer.jquery.min.js"></script>
  <script src="/Public/static/weixin/js/js/itemslide.min.js"></script>
  <script src="/Public/static/weixin/js/js/sliding.js"></script>
</head>
<style>
.scrollor {
    width: 500%;
	transition: 0.5s;
	-moz-transition: 0.5s;
	-webkit-transition: 0.5s;
	-o-transition: 0.5s;
}
.scrollor ul{ width:20%; float:left; display:block; min-height:100px; }
.clear{ clear:both; }
.content{ overflow:hidden;  margin-top:40px;}




</style>


<nav class="nav">
		<ul class="nabUl" id="nabUl">
                    <?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><li class="<?php echo ($v["id"]); ?>" Index="<?php echo ($key); ?>"><a href="#"><?php echo ($v["name"]); ?></a></li><?php endforeach; endif; ?>
		</ul>
  
	</nav>
	<body class="bodyback">


  <div class="content">
<div class="scrollor">
<?php if(is_array($typeinfo)): foreach($typeinfo as $key=>$v): ?><ul class="Df_list" id="shows">
    <?php if($key == 0): ; echo ($shows); ; endif; ?>	
	</ul><?php endforeach; endif; ?> 

  </div>
</div>

	<script src="__PUBLIC__/static/weixin/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript">
        $("#nabUl li:first").find("a").addClass("active");
		$(".content").css("width",$(window).width()+"px");
		$(".scrollor ul").css("width",$(window).width()+"px");
		var ulNum=$(".scrollor ul").lenght;
		var ulIndex=0;
        
            $("#nabUl li").live("click",function(){
                $("#nabUl li a").removeClass("active");
                $(this).find("a").addClass("active");
				var id = $(this).attr('class');
				ulIndex=$(this).attr("index");
					$(".scrollor").css({"transform":"translateX(-"+(20*ulIndex)+"%)"});
                $.post("http://m.mumway.com/index.php/Index/post_show",{id:id,index:ulIndex},function(data){
                     $(".Df_list").eq(data.index).html(data.content);
					    dangqian=$(".Df_list").eq(data.index).height();
						$(".content").css("height",dangqian+"px");
                });
            });
        
        $("#shows li").each(function(){
          $(this).click(function(){
               var url = $(this).attr('class');   
               location.href = url ;
          });
        });
		$(".Df_list li").live("click",function(){
			project=$(this).find(".Word").find("a").text();
			Url=$(this).find("a.Aimg").attr("href");
			$.post("http://m.mumway.com/index.php/Index/ajax_post_article_title",{project:project},function(data){
				if(data==1){
				location.href=Url;	
					}
				});
			return false;
			});
	</script>
</body>
</html>