﻿<?php
/**
 * 月嫂管理微信入口
 */
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
	}else
	{
		//echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$dd = $jsApi->get_access_token($code);
		$dd = $jsApi->get_user_info($dd['access_token'],$dd['openid']);
		//存数据
		$conn=mysqlConnect();
		$search = mysql_query("select * from user_weixin where openid = '{$dd['openid']}'",$conn);
		$search = mysql_fetch_row($search);
		if(!$search){
			$sql = "INSERT user_weixin (openid,nickname,sex,language,city,province,country,headimgurl,number,unionid) VALUES ('{$dd['openid']}','{$dd['nickname']}',{$dd['sex']},'{$dd['language']}','{$dd['city']}','{$dd['province']}','{$dd['country']}','{$dd['headimgurl']}',0,'{$dd['unionid']}')";
			mysql_query($sql,$conn); //执行
		}else{
			//$sql ="update user_weixin set nickname = '{$dd['nickname']}',sex = {$dd['sex']},language = '{$dd['language']}',city = '{$dd['city']}',province = '{$dd['province']}',country = '{$dd['country']}',headimgurl = '{$dd['headimgurl']}',number = number+1 where id = $search[0]"; //SQL语句
			//$sql ="update user_weixin set nickname = '{$dd['nickname']}',sex = {$dd['sex']},language = '{$dd['language']}',city = '{$dd['city']}',province = '{$dd['province']}',country = '{$dd['country']}',headimgurl = '{$dd['headimgurl']}',unionid = '{$dd['unionid']}' where id = $search[0]"; //SQL语句
			//mysql_query($sql,$conn);
		}
		mysql_close();
        $url = 'http://'.$_SERVER['HTTP_HOST'];
		$state=$url.$_GET['state'].'/openid/'.$dd['openid'];
		Header("Location:$state");
		die;
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