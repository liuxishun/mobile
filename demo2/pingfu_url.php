<?php
/**
 * 通用通知接口demo
 * ====================================================
 * 支付完成后，微信会把相关支付和用户信息发送到商户设定的通知URL，
 * 商户接收回调信息后，根据需要设定相应的处理流程。
 * 
 * 这里举例使用log文件形式记录回调信息。
*/
	include_once("log_.php");
	include_once("WxPayPub/WxPayPubHelper.php");
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
	$log_name="pingfu_url.log";//log文件路径
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
			$arr = $notify->data["attach"];
			$log_->log_result($log_name,"【支付成功】:\n");
			$arr = explode('-', $arr);
			$did = $arr[0];//订单id
			$zhi = $arr[1];//购买课程类型，值为sub是章节，super是套餐，zhibo是直播
			// $conn=ConfigDb::mysqlConnect();
			
			$conn=mysql_connect('rm-8vb431shd233813u6ko.mysql.zhangbei.rds.aliyuncs.com','mumway','Mumway1234!@#$');
				mysql_query("set names 'utf8'");
				mysql_select_db('yun');
			$search = mysql_query("select userid,kcid,quanid,money,paycontent from dingdan where id = $did",$conn);
			$search = mysql_fetch_row($search);
			//print_r($search);
			if($search){
				if("wxsuper" == $zhi){
					//防止重复添加
					$cus = mysql_query("select * from t_classuser where userid='{$search[0]}' and classid=$search[1]",$conn);
					$cus = mysql_fetch_row($cus);
					if(!$cus){
						$ti = date("Y-m-d H:i:s", time());
						//添加购买课程
						$sql = "INSERT t_classuser (userid,classid,addtime) VALUES ('$search[0]',$search[1],'$ti')";
						mysql_query($sql,$conn);
						/*
						$student = mysql_query("select name,phone from user_weixin where openid = '{$search[0]}'",$conn);
						$student = mysql_fetch_row($student);
						if($student){
							//添加学员
							$sql = "INSERT newadmin.mumway_recruit_student (name,phone,source_first,source,store_id,createtime,status,is_common,organization_id,follow_admin_name) VALUES ('$student[0]','{$student[1]}',66,67,30,'$ti',0,1,1,'')";
							@mysql_query($sql,$conn);
						}
						*/
						//@file_get_contents('https://wenda.shukaiming.com/');
					}
				}
				//修改订单状态为支付
				$sql ="update dingdan set state = 1 where id = $did"; //SQL语句
				mysql_query($sql,$conn); //执行
			}
		}
	}
?>