<?php
/**
 * 通用通知接口demo--次卡购买
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/
	include_once("log_.php");
	include_once("WxPayPub/WxPayPubHelper.php");
	require_once "WxPayPub/db.config.php";
    //使用通用通知接口
	$notify = new Notify_pub();

	//存储微信的回调
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];	
	$notify->saveData($xml);
	
	//验证签名，并回应微信。
	//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
	//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
	//尽可能提高通知的成功率，但微信不保证通知最终能成功。
	if($notify->checkSign() == FALSE){
		$notify->setReturnParameter("return_code","FAIL");//返回状态码
		$notify->setReturnParameter("return_msg","签名失败");//返回信息
	}else{
		$notify->setReturnParameter("return_code","SUCCESS");//设置返回码
	}
	$returnXml = $notify->returnXml();
	echo $returnXml;
	
	//==商户根据实际情况设置相应的处理流程，此处仅作举例=======
	
	//以log文件形式记录回调信息
	$log_ = new Log_();
	$log_name="cika_url.log";//log文件路径
	//$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");

	if($notify->checkSign() == TRUE)
	{
		if ($notify->data["return_code"] == "FAIL") {
			//此处应该更新一下订单状态，商户自行增删操作
			//$log_->log_result($log_name,"【通信出错】:\n");
		}
		elseif($notify->data["result_code"] == "FAIL"){
			//此处应该更新一下订单状态，商户自行增删操作
			//$log_->log_result($log_name,"【业务出错】:\n");
		}
		else{
			//此处应该更新一下订单状态，商户自行增删操作
			//$log_->log_result($log_name,"【支付成功】:\n");
			$arr = $notify->data["attach"];
			$arr = explode('-', $arr);
			$conn=mysql_connect(ConfigDb::KUURL,ConfigDb::USERNAME,ConfigDb::PASSWORK);
			mysql_query("set names 'utf8'");
			mysql_select_db(ConfigDb::KUNAME);
			$search = mysql_query("select id,userid from dingdan where id = $arr[1]",$conn);
			$search = mysql_fetch_row($search);
			if($search){
				$openid = $search[1];
				$sql ="update dingdan set state = 1 where id = $search[0]";
				mysql_query($sql,$conn);
				$search = mysql_query("select id,shu from youhui_us where qid = 4 and openid = '{$openid}'",$conn);
				$search = mysql_fetch_row($search);
				if($search){
					$sql ="update youhui_us set shu = shu+$arr[0] where id = $search[0]";
					mysql_query($sql,$conn);
				}else{
					$tm = date('Y-m-d H:i:s',time());
					$sql = "INSERT youhui_us (openid,qid,shu,addtime) VALUES ('{$openid}',4,$arr[0],'$tm')";
					mysql_query($sql,$conn);
				}
			}
			mysql_close();
		}

	}
?>