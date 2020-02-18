<?php if (!defined('THINK_PATH')) exit();?>               <div class="date-pick">
                    <div class="hd">
                        <a href="<?php if($page>0){echo U('Member/getWorkerDates', array('cid'=>$cid, 'page'=>$page-1));}else{echo 'javascript:;';} ?>" class="ajax arr <?php if($page==0)echo 'dis'; ?>">&lt;</a>
                        <?php if(is_array($list)): foreach($list as $k=>$val): ?><a href="javascript:;" class="hitem"><?php echo ($k); ?></a><?php endforeach; endif; ?>
                        <a href="<?php echo U('Member/getWorkerDates', array('cid'=>$cid, 'page'=>$page+1)); ?>" class="ajax arr">&gt;</a>
                    </div>
                    <?php if(is_array($list)): foreach($list as $k=>$val): ?><div class="bd" style="display:none;">
                        <?php
 foreach($val as $kk=>$sval){ ?>
                        <span><a href="javvascritp:;" data-val="<?php echo ($sval["date"]); ?>" class="<?php if($sval['s'])echo 'dis'; ?>"><?php echo $kk; ?></a></span>
                        <?php
 } ?>
                    </div><?php endforeach; endif; ?>
                </div>
<script>
$('.date-pick .hd .hitem').each(function(i){$(this).attr('idx', i)}).unbind('click').bind('click', function(){
    $('.date-pick .hd .hitem').removeClass('cur');
    $(this).addClass('cur');
    $('.date-pick .bd').hide().eq($(this).attr('idx')).show();
}).eq(0).addClass('cur');
$('.date-pick .bd').eq(0).show();
$('.date-pick .bd a').unbind('click').bind('click', function(){
    if($(this).hasClass('dis'))return false;
    $('#plan_date').html($(this).data('val'));
    $('[name="plan_date"]').val($(this).data('val'));
    $('.date-pick').hide();
});
typeof(G_DP)=='undefined'&&($('.date-pick').hide(), G_DP=1)
</script>