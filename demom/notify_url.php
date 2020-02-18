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
	require_once "WxPayPub/db.config.php";
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
	$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");
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
			$log_->log_result($log_name,"【支付成功】:\n");
			$did = $notify->data["attach"];
			$conn=ConfigDb::mysqlConnect();
			$search = mysql_query("select fuwu,shouji,jine,quane,shijian from s_dingdan where id = $did and zhifu = 0",$conn);
			$search = mysql_fetch_row($search);
			if($search){
				mysql_query("update s_dingdan set zhifu = 1 where id = $did",$conn); //修改支付状态
				$ser = mysql_query("select title,id from t_service where id = {$search[0]}",$conn);
				$ser = mysql_fetch_row($ser);
				
				//$msg = "用户{$search[1]}，在{$search[5]}定制了（{$search[1]}）服务，请及时跟进。";
				$msg = "客户{$search[1]}预约（{$ser[0]}）服务时间：{$search[4]}";
				ConfigDb::yuanMsg("18519738756,17710760430", $msg);//发给客服
				//99元尊享—产前指导1次    qid=6
				if($search[0] == 30 && $search[2] == 9.9){
					$sql ="update s_youhui_us set shu = shu-1 where qid=6 and shouji = $search[1]"; //SQL语句
					mysql_query($sql,$conn); //查询
				}
				//99元尊享—盆底肌修复1次   qid=8
				if($search[0] == 15 && $search[2] == 9.9){
					$sql ="update s_youhui_us set shu = shu-1 where qid=8 and shouji = $search[1]"; //SQL语句
					mysql_query($sql,$conn); //查询
				}
				//50元优惠券 qid=11
				if($search[3] == 50){
					$sql ="update s_youhui_us set shu = shu-1 where qid=11 and shouji = $search[1]"; //SQL语句
					mysql_query($sql,$conn); //查询
				}
			}
			mysql_close();
		}
	}
?>