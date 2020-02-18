<?php
/*
 *  获取公众号授权  获取信息
 * */

include_once("Wechat.php");
//使用jsapi接口
$jsApi = new Wechat();
//=========步骤1：网页授权获取用户openid============
//通过code获得openid
if (!isset($_GET['code']))
{
    //触发微信返回code码
    //$url = $jsApi->get_snsapi_base_url('http://m.mumway.com/tcall.php','');
    $ul = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $url = $jsApi->get_snsapi_userinfo_url($ul,$_GET["url"]);
    Header("Location: $url");
}else{
    $list = array();
    $code = $_GET['code'];
    $dd = $jsApi->get_access_token($code);
    $dd = $jsApi->get_user_info($dd['access_token'],$dd['openid']);

    $conn=mysqlConnect('newadmin');
    $search = mysql_query("select * from mumway_wechat_user where open_id = '{$dd['openid']}'",$conn);
    $search = mysql_fetch_assoc($search);
    if(!$search){
        $sql = "INSERT mumway_wechat_user (open_id,user_name,sex,city,province,country,avatar_url,union_id) VALUES ('{$dd['openid']}','{$dd['nickname']}',{$dd['sex']},'{$dd['city']}','{$dd['province']}','{$dd['country']}','{$dd['headimgurl']}','{$dd['unionid']}')";
        mysql_query($sql,$conn); //执行
        $list['openid'] = $dd['openid'];
        $list['phone'] = '';
        $list['id_card'] = '';
    }else{
        //待补充
        $list['openid'] = $search['open_id'];
        $list['phone'] = ($search['phone'] == 0) ? '' : $search['phone'];

        //查询身份证号码
        if(!empty( $list['phone'])){
            $sqlA = "select * from mumway_houseworker_main where phone = '{$search['phone']}' ";
            $search_main = mysql_query($sqlA,$conn);
            $search_main = mysql_fetch_assoc($search_main);
            $list['id_card'] = empty($search_main['id_card']) ? '' : $search_main['id_card'];
        }else{
            $list['id_card'] = '';
        }

    }
    mysql_close();

    $data['code'] = 1;
    $data['msg'] = '成功';
    $data['data'] = $list;
    die(json_encode($data));
}

?>


<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>好孕妈妈</title>
</head>
<body>
</body>
</html>
