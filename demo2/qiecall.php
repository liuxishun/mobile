<?php 
header("Content-type: text/html; charset=utf-8");
/**
 * 企业付款测试
 * http://www.cnblogs.com/maxwen/p/4828599.html
 * 班长提现
 */
include_once("WxPayPub/WxPayQie.php");
rebate();
function rebate(){
	$openid = $_POST['openid'];
	$jine = $_POST['jine'];
	$jine = sprintf("%.2f", $jine)*100;
	$conn=ConfigDb::mysqlConnect();
	$search = mysql_query("select jine,id from user_weixin where openid = '$openid'",$conn);
	$search = mysql_fetch_row($search);
	if($search[0] < $_POST['jine']){
		echo json_encode( array('return_code' => 'ERROR'));
		die;
	}
	$mchPay = new WxMchPay();
	// 用户openid
	$mchPay->setParameter('openid', $openid);
	//$mchPay->setParameter('openid', 'olwOsjvawl8HIxfkQUTeGRwC-d8U');
	// 商户订单号
	$mchPay->setParameter('partner_trade_no', 'hymm'.time());
	// 校验用户姓名选项
	$mchPay->setParameter('check_name', 'NO_CHECK');
	// 企业付款金额  单位为分
	$mchPay->setParameter('amount', $jine);
	// 企业付款描述信息
	$mchPay->setParameter('desc', '提现');
	// 调用接口的机器IP地址  自定义
	$mchPay->setParameter('spbill_create_ip', '127.0.0.1'); # getClientIp()
	// 收款用户姓名
	// $mchPay->setParameter('re_user_name', 'Max wen');
	// 设备信息
	// $mchPay->setParameter('device_info', 'dev_server');

	$response = $mchPay->postXmlSSL();
	if( !empty($response) ) {
		$data = simplexml_load_string($response, null, LIBXML_NOCDATA);
		if($data->result_code == 'SUCCESS'){
			$search = mysql_query("select jine,id from user_weixin where openid = '$openid'",$conn);
			$search = mysql_fetch_row($search);
			if($search[0] >= $_POST['jine']){
				$tm = date("Y-m-d h:i:s", time());
				$jine = $jine/100;
				$sql = "INSERT t_bantixian (openid,jine,addtime) VALUES ('$openid',$jine,'$tm')";
				mysql_query($sql,$conn);
				$sql ="update user_weixin set jine = jine-$jine where id = $search[1]"; //SQL语句
				mysql_query($sql,$conn);
			}
			
		}
		mysql_close();
		$url = 'http://m.mumway.com/index.php/ke/bantixian?openid='.$openid;
		Header("Location: $url");exit;
		//echo json_encode($data);
		//print_r($data);
	}else{
		echo json_encode( array('return_code' => 'FAIL', 'return_msg' => 'transfers_接口出错', 'return_ext' => array()) );
	}
}


?>