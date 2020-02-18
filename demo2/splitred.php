<?php 
header("Content-type: text/html; charset=utf-8");
/**
 * http://m.mumway.com/demo2/splitred.php
 * 活动领取裂变红包
 */

include_once("WxPayPub/db.config.php");
include_once("WxPayPub/WxRed.php");

if(!$_GET['openid']){
	$ul = 'http://'.$_SERVER['HTTP_HOST'];
	$url = $ul.'/wxys/toa.php?url='.$ul.$_SERVER['REQUEST_URI'];
	Header("Location: $url");
}

$openid = $_GET['openid']; //接收红包的用户的微信OpenId
$unionid = $_GET['unionid']; //
$hb = new WxRed();//实例化
$hb->newhb($openid, 100); //新建一个10元的红包，第二参数单位是 分，注意取值范围 1-200元,发红包必须大于1元
//以下若干项可选操作，不指定则使用class脚本顶部的预设值
$hb->setNickName("好孕妈妈有限公司");//红包商户名称
$hb->setSendName("好孕妈妈");//红包派发者名称
$hb->setWishing("恭喜您获得521活动任务1的奖金");//类容祝福语
$hb->setActName("学员学习奖励金");//活动名称
$hb->setRemark("学员学习奖励金");//备注
//发送红包
if(!$hb->sendGroup()){ //发送错误
	echo $hb->err();
}else{
	echo 1;
}


die;

$conn=ConfigDb::mysqlConnect();
//查询是否满足领取要求
$search = mysql_query("select state from user_weixin_active where unionid = '$unionid' and state=1",$conn);
$search = mysql_fetch_row($search);

if($search){
	//查询是否领取
	$se = mysql_query("select unionid from user_weixin_active_log where unionid = '$unionid'",$conn);
	$se = mysql_fetch_row($se);
	if($se){
		echo 2;//已领取
		die;
	}
	$hb = new WxRed();//实例化
	$hb->newhb($openid, 2100); //新建一个10元的红包，第二参数单位是 分，注意取值范围 1-200元,发红包必须大于1元
	//以下若干项可选操作，不指定则使用class脚本顶部的预设值
	$hb->setNickName("好孕妈妈有限公司");//红包商户名称
	$hb->setSendName("好孕妈妈");//红包派发者名称
	$hb->setWishing("恭喜您获得521活动任务1的奖金");//类容祝福语
	$hb->setActName("学员学习奖励金");//活动名称
	$hb->setRemark("学员学习奖励金");//备注
	//发送红包
	if(!$hb->send()){ //发送错误
		echo $hb->err();
	}else{
		$tm = date('Y-m-d H:i:s');
		$sql = "INSERT user_weixin_active_log (openid, unionid, money, addtime) VALUES ('$openid', '$unionid', 21, '$tm')";
		mysql_query($sql,$conn);
		echo 1;
	}
	
}else{
	echo 0;
	die;
	
}



?>