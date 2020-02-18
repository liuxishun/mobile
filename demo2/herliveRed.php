<?php 
header("Content-type: text/html; charset=utf-8");
/**
 * 21活动领取红包
 */

include_once("WxPayPub/db.config.php");
include_once("WxPayPub/WxRed.php");
$openid = $_GET['openid']; //接收红包的用户的微信OpenId
$conn=ConfigDb::mysqlConnect();
//查询是否满足领取要求
$search = mysql_query("select id,amount,state from newadmin.mumway_herlive_integral where openid = '$openid' and integral > 3 and amount > 0 and type='奖金'",$conn);
$search = mysql_fetch_row($search);
if($search){
	if($search[2] == '否'){
		$hb = new WxRed();//实例化
		$hb->newhb($openid, ($search[1]*100)+1); //新建一个10元的红包，第二参数单位是 分，注意取值范围 1-200元,发红包必须大于1元
		//以下若干项可选操作，不指定则使用class脚本顶部的预设值
		$hb->setNickName("好孕妈妈有限公司");//红包商户名称
		$hb->setSendName("好孕妈妈");//红包派发者名称
		$hb->setWishing("好孕妈妈奖励给您的红包");//类容祝福语
		$hb->setActName("好孕妈妈奖励红包");//活动名称
		$hb->setRemark("好孕妈妈奖励红包");//备注
		//发送红包
		if(!$hb->send()){ //发送错误
			echo $hb->err();die;
		}else{
			$tm = time();
			$sql = "update newadmin.mumway_herlive_integral set state='是',updatetime= $tm where id = {$search[0]}";
			mysql_query($sql,$conn);
			echo 0;die;
		}
	}else{
		echo 1;die;
	}
	
	
}else{
	echo 2;die;
	
}



?>