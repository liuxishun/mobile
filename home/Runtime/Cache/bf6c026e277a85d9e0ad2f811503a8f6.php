<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>好孕妈妈</title>
    <link rel="stylesheet" type="text/css" href="__PUBLIC__/ke/dati/css/style.css">
    <script type="text/javascript">
        var phoneWidth = parseInt(window.screen.width);
        var phoneScale = phoneWidth / 640;
        var ua = navigator.userAgent;
        if (/Android (\d+\.\d+)/.test(ua)) {
            var version = parseFloat(RegExp.$1);
            if (version > 2.3) {
                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale +
                    ' ,minimum-scale = ' + phoneScale + ', maximum-scale = ' + phoneScale +
                    ', target-densitydpi=device-dpi">')
            } else {
                document.write('<meta name="viewport" content="width=640, initial-scale= ' + phoneScale +
                    ' , target-densitydpi=device-dpi">')
            }
        } else {
            document.write('<meta name="viewport" content="width=640, user-scalable=no, target-densitydpi=device-dpi">')
        }
    </script>
    <link rel="stylesheet" href="style.css">

</head>

<body style="background:#f5f5f5 url(__PUBLIC__/ke/dati/img/exam_08.png) no-repeat center 300px; height:100%;">
<section class="section">
    <?php if(is_array($list)): foreach($list as $k=>$li): ?><div class="answer" id="k<?php echo ($k); ?>" style="display: none;">
            <P class="type_p1"><span><?php echo $li['type']==1 ? '单选题' : '多选题';?></span></P>
            <div class="dati">
                <P class="dati_p1"><?php echo ($k+1); ?>：<?php echo ($li["title"]); ?></P>
                <div class="dati_d1" data-answer="<?php echo ($li["answer"]); ?>">
                    <?php if(is_array($li[daan])): foreach($li[daan] as $key=>$da): ?><P class="dati_p2"><label><input type="<?php echo $li['type']==1 ? 'radio' : 'checkbox';?>"
                                                         name="v<?php echo ($k); ?>" value="<?php echo ($da["val"]); ?>"
                                                         data-lab="<?php echo ($da["lab"]); ?>"><i><?php echo ($da["lab"]); ?></i><span><?php echo ($da["con"]); ?></span></label></P><?php endforeach; endif; ?>
                </div>
            </div>
        </div><?php endforeach; endif; ?>
</section>
<!----------------------底部------------------------------>
<footer class="exam_foot">
    <P class="exam_foot_p1"><a onclick="forQuestions(-1)">上一题</a><a onclick="forQuestions(1)">下一题</a></P>
    <div class="exam_foot_d1">
        <a class="exam_foot_d1_a1" onclick="add()">交卷</a>
        <a class="exam_foot_d1_a2 jidui" onclick="datika()">0</a>
        <a class="exam_foot_d1_a3 jicuo" onclick="datika()">0</a>
        <a class="exam_foot_d1_a4" onclick="datika()"><i class="yida">0</i>/<?php echo ($count); ?></a>
    </div>
</footer>

<!----------------------题目查看------------------------------>
<div class="topic_out">
    <div class="topic_out1">
        <div class="topic_out2"></div>
        <div class="topic">
            <div class="exam_foot_d1">
                <a class="exam_foot_d1_a1" onclick="add()">交卷</a>
                <a class="exam_foot_d1_a2 jidui" onclick="datika()">0</a>
                <a class="exam_foot_d1_a3 jicuo" onclick="datika()">0</a>
                <a class="exam_foot_d1_a4" onclick="datika()"><i class="yida">0</i>/<?php echo ($count); ?></a>
            </div>
            <div class="topic_d1">
                <!-- <a class="dui" href="javascrpt:;">1</a><a class="cuo" href="javascrpt:;">2</a><a href="#">100</a> -->
            </div>
        </div>
    </div>
</div>
<!----------------------交卷弹框------------------------------>
<div class="assignment1_out">
    <div class="assignment2_d4" style="display: block;">
        <P class="assignment1_p1">温馨提示</P>
        <P class="assignment2_p22">您已回答了<span class="yida">0</span>道题（共<span><?php echo ($count); ?></span>题）<br>考试得 <span
                class="defen">0</span> 分 <br>绿色为正确，红色为错误，白色为未答</P>
        <div class="assignment2_res">
            <h4 class="assignment2_res_t">我的成绩单</h4>
            <p class="assignment2_res_cont">

            </p>

        </div>
        <P class="assignment2_p4"><a class="assignment2_p4_a1" href="__URL__/quzheng?openid=<?php echo ($openid); ?>">继续学习</a><a
                class="assignment2_p4_a2" id="is_ceshi" href="__SELF__">再测一次</a></P>
        <P class="assignment2_p41"><a
                href="https://www.sobot.com/chat/h5/index.html?sysNum=8b78fa06c8d349ce8556b8d7d4cc01cc">申请认证</a></P>
    </div>
</div>

<!----------------------中途交卷弹框------------------------------>
<div class="assignment2_out">
    <div class="assignment2_d4">
        <P class="assignment1_p1">温馨提示</P>
        <P class="assignment2_p22">您已回答了<span class="yida">0</span>道题（共<span><?php echo ($count); ?></span>题），<br>考试得分<span
                class="defen">0</span>，确定交卷吗？</P>
        <P class="assignment2_p4"><a class="assignment2_p4_a1"
                                     href="javascript:$('.assignment2_out').hide();">继续答题</a><a class="assignment2_p4_a2"
                                                                                                onclick="addsub();">交卷</a></P>
    </div>
</div>

</body>
<script src="__PUBLIC__/ke/dati/js/jquery-1.8.2.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".jidui,.jicuo").hide();
        $('.exam_foot_p1 a:first').css('borderRight', '1px solid #fff');
        $('.exam_foot_p1 a:last').css('borderLeft', '1px solid #fff');
        $('.exam_foot_d1_a2').click(function (e) {
            $('.topic_out').show();
        });
        $('.exam_foot_d1_a3').click(function (e) {
            $('.topic_out').show();
        });
        $('.exam_foot_d1_a4').click(function (e) {
            $('.topic_out').show();
        });
        $('.topic_out2').click(function (e) {
            $('.topic_out').hide();
        });
        $('.assignment2_p3_a').click(function (e) {
            $('.assignment2_out').hide();
        });
        $('#is_ceshi').click(function (e) {
            if('<?php echo ($isNum); ?>' != 1){
                alert("今日3次考试次数已用完，\n复习一下明天您一定可以通过");
                $(this).attr('href','javascript:;');
            }
        })

        //选择答案按钮
        $('.dati_p2 input').click(function (e) {
            var dom = $(this).next();
            if ($(this).attr("type") == 'radio') {
                //单选题
                $(this).parents(".dati_d1").find("label").each(function () {
                    $(this).find("i").removeClass('dati_p2_i1').html($(this).find("input").data(
                        'lab'));
                });
                dom.addClass('dati_p2_i1').html('√');
            } else {
                //多选题
                if ($(this).prop('checked')) {
                    dom.addClass('dati_p2_i1').html('√');
                } else {
                    dom.removeClass('dati_p2_i1').html($(this).data('lab'))
                }
            }


            /*

            if(dom.hasClass('dati_p2_i1') || dom.hasClass('dati_p2_i2')){
                dom.removeClass('dati_p2_i1 dati_p2_i2').html($(this).data('lab'));
            }else{

                var daan = $(this).parents(".dati_d1").data("answer");
                daan = daan.split(";")
                if(daan.includes($(this).val())){
                    dom.addClass('dati_p2_i1').html('√');
                }else{
                    dom.addClass('dati_p2_i2').html('X');
                }
            }
            */
        });
    });

    var index = 0; //当前题号
    $('#k0').show(); //默认显示第一题
    var count = <?php echo ($count); ?>; //总题数
    var jidui = 0; //计数做对的题
    var jicuo = 0; //计数做错的题
    var questionsArray = Array(count).fill(null).map((_, h) => 0); //初始化题目数组，存每题是否答对，答错
    function ches() {
        var an = []; //判断是否做对
        var daan = $("[name=v" + index + "]").parents(".dati_d1").data("answer");
        $("[name=v" + index + "]:checked").each(function () {
            an.push($(this).val());
        });
        //判断是否答题
        if (an.length != 0) {
            //答对值为1，答错值为-1
            questionsArray[index] = (daan == an.join(';') ? 1 : -1);
            /*
            //显示正确答案
            $("[name="+index+"]").each(function(){
                daan = daan.split(";")
                if(daan.includes($(this).val())){
                    $(this).next().addClass('dati_p2_i1').html('√');
                }
            });
            */
        }
        var ht = ''; //答题卡数据
        jidui = 0; //计数做对的题
        jicuo = 0; //计数做错的题
        for (var i in questionsArray) {
            var qid = parseInt(i) + 1;
            if (questionsArray[i] == 1) {
                //ht += '<a class="dui" onclick="timu('+i+')">'+qid+'</a>';
                ht += '<a class="cuo" onclick="timu(' + i + ')">' + qid + '</a>';
                jidui++; //累加对
            } else if (questionsArray[i] == -1) {
                ht += '<a class="cuo" onclick="timu(' + i + ')">' + qid + '</a>';
                jicuo++; //累加错
            } else {
                //未答
                ht += '<a onclick="timu(' + i + ')">' + qid + '</a>';
            }
        }


        $('.topic_d1').html(ht); //更新答题卡
        $('.jidui').text(jidui); //答对数
        $('.jicuo').text(jicuo); //答错数
        $('.yida').text(jidui + jicuo); //已答题数
    }

    //获取试题，val值为int数字，上一题值为-1、下一题值为1
    function forQuestions(val) {
        ches();
        if (val < 0 && index == 0) {
            index = 0;
            alert('已经是第一道题！');
            return false;
        } else if (val > 0 && index == (count - 1)) {
            index = count - 1;
            alert('已经是最后一道题,是否交卷！');
            return false;
        }
        $('.answer').hide();
        index = index + val;
        $('#k' + index).show();
    }
    //显示答题卡
    function datika() {
        ches();
        $('.topic_out').show();
    }
    //答题卡选择题目
    function timu(v) {
        index = v;
        $('.topic_out,.answer').hide();
        $('#k' + v).show();
    }
    //提交试卷
    function add(v) {
        ches();
        var fen = 100; //总分100
        var fenz = parseInt(100 / count);
        if (jidui != count) {
            fen = jidui * fenz;
        }
        if (jidui == 0) {
            fen = 0;
        }
        $('.defen').text(fen);
        //判断是否答完
        if (count > (jidui + jicuo)) {
            $('.assignment2_out').show();
        } else {
            addsub();
        }

    }

    function renderResult($outer, arr) {
        var classSuc = 'success';
        var classErr = 'error';
        var curClass = '';
        var item = '';
        var result = '';
        for (var i = 0, len = arr.length; i < len; i++) {
            item = +arr[i];
            if (item === -1) { // error
                curClass = classErr;
            } else if (item === 1) { // success
                curClass = classSuc;
            } else {
                curClass = '';
            }
            result += '<span class="assignment2_res_n ' + curClass + '">' + (i + 1) + '</span>'
        }
        $outer.html(result);
    }
    //提交考试分数
    function addsub() {
        if (confirm("你确定提交吗？")) {

            //考试结果预览
            renderResult($('.assignment2_res_cont'), questionsArray);

            var fen = $(".defen").eq(0).text();
            var ul = '__URL__/datiadd/cid/<?php echo ($cid); ?>/fen/' + fen + '/openid/<?php echo ($openid); ?>/cname/<?php echo ($cname); ?>';
            $.get(ul, function (dt) {
                if (dt == 0) {
                    alert("提交失败！");
                } else {
                    $('.assignment2_out').hide();
                    if (parseInt(fen) > 85) {
                        $('.assignment1_out .assignment2_p4').hide();
                        $('.assignment1_out,.assignment2_p41').show();
                    } else {
                        $('.assignment2_p41').hide();
                        $('.assignment1_out,.assignment1_out .assignment2_p4').show();
                    }
                }
            });
        }
    }
</script>

</html>