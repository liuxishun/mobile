function readCookie(n)
{
  n += "=";
  var result = "";
  if (document.cookie.length > -1) {
    var star = document.cookie.indexOf(n);            
    while(star>0&&(document.cookie.charAt(star-1)!=" "&&document.cookie.charAt(star-1)!=";")){               
      star = document.cookie.indexOf(n,star+1);
    }           
    if (star>-1){               
      end = document.cookie.indexOf(";", star);
      end = end == -1 ? document.cookie.length: end;
      result = unescape(document.cookie.substring(star + n.length, end));
    }
  }
  return result;
}
function writeCookie(name, value, hours)
{
  var expire = "";
  if(hours != null)
  {
    expire = new Date((new Date()).getTime() + hours * 3600000);
    expire = "; expires=" + expire.toGMTString();
  } 
  document.cookie = name + "=" + escape(value) + expire + ";path=/";
}

var Msgbox={
tpl:'<div id="@id" class="msgbox"><div class="msgbox-inner"><div class="mb-hd"><span class="t">温馨提示</span><a href="javascript:;" data-act="close" class="close">X</a></div><div class="mb-bd">@msg</div><div class="mb-ft">@btn<a href="javascript:;" data-act="close" class="mb-btn mb-btn-grade">取消</a></div></div></div>',
show:function(opt){
    opt && typeof(opt)=='string' && (opt={msg:opt}); 
	opt.mask!==false&&Mask.show();
	var id=opt.id||'msgbox',b=$('#'+id),m=opt.msg||' ', btn=opt.btn||' ';
	b.length==0&&($('body').append(this.tpl.replace('@id', id).replace('@msg', m).replace('@btn', btn)),b=$('#'+id), $(b).find('[data-act="close"]').bind('click', function(){Msgbox.hide(id)}));
	b.find('.mb-bd').html(), b.show();
},
hide:function(id){
    id? $('#'+id).hide() : $('.msgbox').hide();
	Mask.hide();
}
}
var Mask={
tpl:'<div class="mask"></div>',
show:function(){
    var b=$('.mask');
	b.length==0&&($('body').append(this.tpl), b=$('.mask'));
	b.show();
},
hide:function(){$('.mask').hide()}
}
var Systip={
t:null,
tpl:'<div class="systip"><div class="systip-inner">@msg</div></div>',
show:function(opt){
    opt && typeof(opt)=='string' && (opt={msg:opt}); 
	var b=$('.systip'), msg=opt.msg||' ', t=opt.t||1200;
	b.length==0&&($('body').append(this.tpl.replace('@msg', msg)), b=$('.systip'));
	b.find('.systip-inner').html(msg), b.show().removeClass('st-hide');
	this.t&&clearTimeout(this.t), this.t=setTimeout(function(){Systip.hide()}, t);
},
hide:function(){$('.systip').addClass('st-hide'), this.te&&clearTimeout(this.te), this.te=setTimeout(function(){$('.systip').hide()}, 1000);}
}

function SetFocus(elem) {
	var v=elem.value;
	elem.value='',elem.focus(),elem.value=v;
}
function toCmt(cid, precon){
    var f=$('#form_cmt'),txts=f.find('[name="content"]');
	f.find('[name="parentid"]').val(cid),txts.val(precon),SetFocus(txts.get(0));
}

//ajax-page half-ajax
function loadAjaxPage(obj, url, fn){
    obj=$(obj).parent();
    var page=obj.attr('data-page')*1+1, id='#'+obj.attr('data-ajax-plist');
    if(obj.attr('s'))return;
    !url&&(url=obj.attr('data-url-tpl').replace('@page', page));
	obj.attr('s', 1).css('opacity', 0.6), obj.find('a').hide(), obj.find('span').css('display','block');
    $.get(url, function(d){
		page>0&&page%5==0&&$(id).html(''), $(id).append($(d).find(id).html());
		$(d).find('.load-more-page').length==0 && obj.hide();
        obj.attr('data-page', page);
        obj.attr('s', '').css('opacity', 1), obj.find('a').css('display','block'), obj.find('span').hide();
        !!fn&&fn();
        //$('html, body').animate({'scrollTop':$(id).position().top}, 200);
	});
}

//更新购物车数字提示
function updateCartTip(qty){
	var obj=$('#cart_num');
	if(!obj.length)return;
	if(qty){
		obj.show().html(qty>9? '9+' : qty);
		return;
	}
	$.get(obj.attr('data-url'), function(d){
		d.data&&d.data.qty_count? obj.show().html(d.data.qty_count>9? '9+' : d.data.qty_count) : obj.hide();
	})
}

//提交订单前的检查
function check(obj,opt){
	var lis=$(obj).find("li"), sel_lbl=opt&&opt.lbl||'span';
	for(var i=0, len=lis.length;i<len;i++){
		var li=lis.eq(i);
		if(!0){
			var jqt=li.find(':text, textarea'),
			    jqo=li.find('input[type="radio"]'),
			    jqs=li.find('select'),
			    lbl=getLabel(li.find(sel_lbl).text());
			if(jqt.length>0 && (trim(jqt), jqt.val().length==0)){
				Systip.show('请输入'+lbl);
				jqt.eq(0).focus();
				return false;
			}else if(li.attr('ct')=='mobile' && jqt.length>0 && !(/^1[358][0-9]{9}$/).test(jqt.val())){
				Systip.show('请输入有效的手机号');
				jqt.focus();
				jqt.select();
				return false;
			}else if(li.attr('ct')=='email' && jqt.length>0 && !(/^[-_A-Za-z0-9]+@([_A-Za-z0-9]+\.)+[A-Za-z0-9]{2,3}$/).test(jqt.val())){
				Systip.show('请输入有效的邮箱');
				jqt.focus();
				jqt.select();
				return false;
			}else if(li.attr('ct')=='tel' && jqt.length>0 &&
					 !((/^[0-9]{3,4}$/).test(jqt.eq(0).val()) && (/^[0-9]{7,8}$/).test(jqt.eq(1).val())) ){
				Systip.show('请输入有效的电话号码');
				var tidx=0;
				if((/^[0-9]{3,4}$/).test(jqt.eq(0).val())){tidx=1;}
				jqt.eq(tidx).focus();
				jqt.eq(tidx).select();
				return false;
			}
			if(jqo.length>0 && jqo.filter(":checked").length==0){
				Systip.show('请选择'+lbl);
				jqo.eq(0).focus();
				return false;
			}
			if(jqs.length>0 && !checkSel(jqs)){
				Systip.show('请选择'+lbl);
				jqs.eq(0).focus();
				return false;
			}
		}
	}
    return true;
}
function getLabel(str){
	return str.replace('：','').replace(/[\s\*\:]/g,'');
}

function trim(jqs){
	jqs.each(function(){$(this).val($.trim($(this).val()));});
}

$(function(){
	$('[data-ajax="cmt"]').bind('click', function(){
		if($(this).attr('s'))return;
		var that=this, n, f=$(this).parents('form').eq(0);
		if(f.find('textarea').val().length==0){
		    Systip.show('请输入评论内容'), f.find('textarea').focus();
			return;
		}
		$(this).attr('s', 1).css('opacity', 0.5), $.post($(this).attr('data-url'), f.serialize(), function(d){
		    d.status? (Systip.show('评论成功'), f.find('textarea').val(''), location.reload()) : Systip.show(d.info||'评论失败');
			$(that).attr('s', '').css('opacity', 1);
		}, 'json');
		return false;
	});

	$('[data-ajax-plist] a').bind('click', function(){loadAjaxPage(this);return false;});

	updateCartTip();
});