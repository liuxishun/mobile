<?php
/**
 * 通用通知接口demo--好孕妈妈母婴护理服务支付
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/

	include_once("log_.php");
	include_once("WxPayPub/WxPayPubHelper.php");
	include_once("WxPayPub/db.config.php");
    //使用通用通知接口
	$notify = new Notify_pub();
	//存储微信的回调
	$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
	// echo $xml;
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
	$log_name="notify_url.log";//log文件路径
	//$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");
	if($notify->checkSign() == TRUE)
	{
		if ($notify->data["return_code"] == "FAIL") {
			//此处应该更新一下订单状态，商户自行增删操作
			$log_->log_result($log_name,"【通信出错】:\n");
		}
		elseif($notify->data["result_code"] == "FAIL"){
			//此处应该更新一下订单状态，商户自行增删操作
			$log_->log_result($log_name,"【业务出错】:\n");
		}
		else{
			//此处应该更新一下订单状态，商户自行增删操作
			//$log_->log_result($log_name,"【支付成功】:\n");
			$arr = $notify->data["attach"];
			$time_end = $notify->data["time_end"];
			$arr = explode('*', $arr);
			$tm = date('Y-m-d H:i:s',time());
			$conn=ConfigDb::mysqlConnect();
			$search = mysql_query("select * from t_fukuan where time_end='$time_end'",$conn);
			$search = mysql_fetch_row($search);
			if(!$search){
				if(count($arr) > 4){
					$sql = "INSERT t_fukuan (name,phone,jine,addtime,time_end,openid,nickname) VALUES ('$arr[0]','$arr[1]',$arr[2],'$tm','$time_end','$arr[4]','$arr[5]')";
				}else{
					$sql = "INSERT t_fukuan (name,phone,jine,addtime,time_end,region) VALUES ('$arr[0]','$arr[1]',$arr[2],'$tm','$time_end','$arr[3]')";
				}
				mysql_query($sql,$conn);
			}
			mysql_close();
		}
	}
?>