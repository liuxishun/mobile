<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/aj/wode/css/style.css">
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
    <script src="__PUBLIC__/aj/wode/js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
		$(function(){
			$('.radio').click(function(e) {
                $(this).find('i').css('border','8px solid #009AFF ');
				$(this).siblings().find('i').css('border','2px solid #666 ');
            });
			$('.checkbox .choice-description').click(function(e) {
                $(this).siblings().find('i').toggleClass('i1');
            });
			$('.checkbox i').click(function(e) {
                $(this).toggleClass('i1');
            });
						
			
		});

    </script>
    
</head>

<body style="background-color: #fff;">
    <section class="section" style=" margin-top:0;">
    	<P class="bm"><img src="__PUBLIC__/aj/wode/img/ban.jpg"></P>
		<h1 class="bm_p1">月嫂了不起合伙人报名申请</h1>
        <P class="bm_p2">你是<span>热心肠</span>的月嫂/育儿嫂，<br>会因为帮助姐妹感到快乐；<br>你是<span>爱学习</span>的月嫂/育儿嫂，<br>为掌握科学知识感到自豪；<br>那就赶快来吧。</P>
        <form method="post" action="__SELF__" id="testForm">
        <input type="hidden" name="openid" value="<?php echo ($openid); ?>">
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4"> 姓名：<span>（请填写2-20个字符）</span></label>        
            </div>
            <div class="bm_d1_d2">
                <input type="text" name="name" id="entry_field_4">
            </div>
        </div>
     	<div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4"> 年龄：<span>（请填写2个字符）</span></label>        
            </div>
            <div class="bm_d1_d2">
                <input type="number" value="0" name="age" id="entry_field_4">
            </div>
        </div>
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4">你的微信号：</label>        
            </div>
            <div class="bm_d1_d2">
                <input type="text" name="weixin" id="entry_field_4">
            </div>
        </div>
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4">电话：</label>        
            </div>
            <div class="bm_d1_d2">
                <input type="text" name="phone" id="entry_field_4">
            </div>
        </div>
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4">所在城市：</label>        
            </div>
            <div class="bm_d1_d2">
                <input type="text" name="dizhi" id="entry_field_4">
            </div>
        </div>
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4">你从事月嫂/育儿嫂工作年份 </label>        
            </div>
			<div class="bm_d1_d3">
                <label class="radio ">
                  <div class="radio-button-wrapper"><input type="radio" value="入行1年了" name="nianxian"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    入行1年了
                  </div>
                </label>
                <label class="radio ">
                  <div class="radio-button-wrapper"><input type="radio" value="还不到3年" name="nianxian"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    还不到3年
                  </div>
                </label>
                <label class="radio ">
                  <div class="radio-button-wrapper"><input type="radio" value="超过3年了" name="nianxian"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    超过3年了
                  </div>
                </label>
                <label class="radio "  style="border-bottom:0;">
                  <div class="radio-button-wrapper"><input type="radio" value="超过5年了" name="nianxian"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    超过5年了
                  </div>
                </label>
			</div>

        </div>
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab1" for="entry_field_4">你有哪些证书？ </label>        
            </div>
			<div class="bm_d1_d3">
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="高级母婴护理师" name="zhengshu[]" class="field-transformed"><i></i></div>
                  <div class="choice-description">
                    高级母婴护理师
                  </div>
                </label>
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="高级育婴师" name="zhengshu[]"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    高级育婴师
                  </div>
                </label>
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="高级早教师" name="zhengshu[]"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    高级早教师
                  </div>
                </label>
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="高级催乳师" name="zhengshu[]"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                   高级催乳师
                  </div>
                </label>
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="小儿推拿师" name="zhengshu[]"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                   小儿推拿师
                  </div>
                </label>
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="精英母婴护理师" name="zhengshu[]"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                   精英母婴护理师
                  </div>
                </label>
                <label class="checkbox ">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="精英早教师" name="zhengshu[]"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                   精英早教师
                  </div>
                </label>
                <label class="checkbox " style="border-bottom:0;">
                  <div class="radio-button-wrapper radio-button-wrapper1"><input type="checkbox" value="" name="zheng"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                   其它
                  </div>
                </label>
                <span class="bm_s1">
                	<input type="text" name="zhengshu1" >
                </span>
			</div>

        </div>
        <div class="bm_d1">
            <div class="bm_d1_d1">
                <label class="bm_d1_d1_lab" for="entry_field_4">你从事月嫂/育儿嫂工作带过宝宝数 </label>        
            </div>
			<div class="bm_d1_d3">
                <label class="radio ">
                  <div class="radio-button-wrapper"><input type="radio" value="不到10个" name="baoshu"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    不到10个
                  </div>
                </label>
                <label class="radio ">
                  <div class="radio-button-wrapper"><input type="radio" value="11个到50个" name="baoshu"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    11个到50个
                  </div>
                </label>
                <label class="radio " style="border-bottom:0;">
                  <div class="radio-button-wrapper"><input type="radio" value="多到数不清了" name="baoshu"><i class="selected-icon"></i></div>
                  <div class="choice-description">
                    多到数不清了
                  </div>
                </label>
			</div>

        </div>
     
     	</form> 
        <P class="bm_p3"><input type="submit" value="提交" onclick="javascript:$('#testForm').submit();"></P> 
    </section>
</body>
</html>