<?php
/**
 * 母婴护理管理微信入口
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
		$conn=mysqlConnect('newadmin');
		$search = mysql_query("select * from mumway_herlive_wechat where openid = '{$dd['openid']}'",$conn);
		$search = mysql_fetch_row($search);
		$time = time();
		if(!$search){
			$sql = "INSERT mumway_herlive_wechat (openid,nickname,sex,language,city,province,country,headimgurl,unionid,createtime,updatetime,type) VALUES ('{$dd['openid']}','{$dd['nickname']}',{$dd['sex']},'{$dd['language']}','{$dd['city']}','{$dd['province']}','{$dd['country']}','{$dd['headimgurl']}','{$dd['unionid']}',$time,$time,2)";
			mysql_query($sql,$conn); //执行
		}else{
			//$sql ="update newadmin.mumway_herlive_wechat set nickname = '{$dd['nickname']}',sex = {$dd['sex']},language = '{$dd['language']}',city = '{$dd['city']}',province = '{$dd['province']}',country = '{$dd['country']}',headimgurl = '{$dd['headimgurl']}',unionid = '{$dd['unionid']}',updatetime = $time where id = $search[0]"; //SQL语句
			//mysql_query($sql,$conn);
		}
		$state=$_GET['state'].'/openid/'.$dd['openid'];
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