<?php
/**
 * JS_API支付demo
 * ====================================================
 * 在微信浏览器里面打开H5网页中执行JS调起支付。接口输入输出数据格式为JSON。
 * 成功调起支付需要三个步骤：
 * 步骤1：网页授权获取用户openid
 * 步骤2：使用统一支付接口，获取prepay_id
 * 步骤3：使用jsapi调起支付
*/
    include_once("WxPayPub/WxPayPubHelper.php");
    include_once("WxPayPub/db.config.php");
	//使用jsapi接口
	$jsApi = new JsApi_pub();
	//=========步骤1：网页授权获取用户openid============
	//通过code获得openid
	if (!isset($_GET['code']))
	{
		//$jine=$_POST['jine'];
		//$jine=sprintf("%.2f", $jine)*100;
		$title = $_GET['name'].'*'.$_GET['phone'].'*'.$_GET['id'].'*'.$_GET['referees'].'*'.$_GET['url'];
		$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		//触发微信返回code码
		$url = $jsApi->createOauthUrlForCode($url, $title);
		Header("Location: $url");
	}else
	{
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$jsApi->setCode($code);
		$openid = $jsApi->getOpenId();
		$arr = $_GET['state'];
		$arr = explode('*', $arr);
		//自定义订单号，此处仅作举例
		$timeStamp = time();//当前时间戳
		$daytime = strtotime(date("Y-m-d"));//当天0点时间戳
		$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
		$conn=ConfigDb::mysqlConnect();
		$search = mysql_query("select * from newadmin.mumway_herlive_course where id={$arr[2]}",$conn);
		$search = mysql_fetch_row($search);
		if($search){
			$order = mysql_query("select * from newadmin.mumway_herlive_order where phone='{$arr[1]}' and herlive_course_id={$arr[2]} and createtime > $daytime and status='未支付' limit 1",$conn);
			$order = mysql_fetch_row($order);
			if($order){
				$sql = "update newadmin.mumway_herlive_order set orderno = '$out_trade_no', referees='{$arr[3]}', updatetime = $timeStamp where id = $order[0]";
				mysql_query($sql,$conn);
				$did = $order[0];
			}else{
				$sql = "INSERT newadmin.mumway_herlive_order (name,phone,amount,orderno,openid,herlive_course_id,herlive_course_name,createtime,updatetime,referees) VALUES ('$arr[0]','$arr[1]',$search[3],'$out_trade_no','$openid',$search[0],'$search[1]',$timeStamp,$timeStamp,'{$arr[3]}')";
				mysql_query($sql,$conn);
				$did =  mysql_insert_id();
			}
		}
		mysql_close();
	}
	
	$url = "http://m.mumway.com/199zb/index.html?openid=".$openid;//199直播
	if($arr[4]){
		$url = "http://admin.mumway.com/Herlive/index.html?openid=".$openid;//199课程
	}
	//=========步骤2：使用统一支付接口，获取prepay_id============
	//使用统一支付接口
	$unifiedOrder = new UnifiedOrder_pub();
	//设置统一支付接口参数
	//设置必填参数
	//appid已填,商户无需重复填写
	//mch_id已填,商户无需重复填写
	//noncestr已填,商户无需重复填写
	//spbill_create_ip已填,商户无需重复填写
	//sign已填,商户无需重复填写
	$unifiedOrder->setParameter("openid", "$openid");//商品描述
	$unifiedOrder->setParameter("body", "$search[1]");//商品描述
	$unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号 
	if($arr[1] == '15210101010'){
		$unifiedOrder->setParameter("total_fee", 1);//总金额
	}else{
		$unifiedOrder->setParameter("total_fee", $search[3]*100);//总金额
	}
	$unifiedOrder->setParameter("notify_url","http://m.mumway.com/demo2/herlivePay_url.php");//通知地址 
	$unifiedOrder->setParameter("trade_type","JSAPI");//交易类型
	//非必填参数，商户可根据实际情况选填
	//$unifiedOrder->setParameter("sub_mch_id"," ");//子商户号  
	//$unifiedOrder->setParameter("device_info","");//设备号 
	$unifiedOrder->setParameter("attach","$did");//附加数据
	//$unifiedOrder->setParameter("time_start"," ");//交易起始时间
	//$unifiedOrder->setParameter("time_expire"," ");//交易结束时间 
	//$unifiedOrder->setParameter("goods_tag"," ");//商品标记 
	//$unifiedOrder->setParameter("openid"," ");//用户标识
	//$unifiedOrder->setParameter("product_id"," ");//商品ID
	$prepay_id = $unifiedOrder->getPrepayId();
	//=========步骤3：使用jsapi调起支付============
	$jsApi->setPrepayId($prepay_id);
	$jsApiParameters = $jsApi->getParameters();
	//echo $jsApiParameters;

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8"/>
    <title>微信安全支付</title>
	<script type="text/javascript">
		callpay();
		//调用微信JS api 支付
		function jsApiCall()
		{
			WeixinJSBridge.invoke(
				'getBrandWCPayRequest',
				<?php echo $jsApiParameters; ?>,
				function(res){
					WeixinJSBridge.log(res.err_msg);
					//alert(res.err_code+res.err_desc+res.err_msg);
					if(res.err_msg == 'get_brand_wcpay_request:ok') {
						window.location.href="<?php echo $url; ?>";
					}else {
						alert('支付失败！');
						//WeixinJSBridge.call('closeWindow');//关闭当前窗口
						//window.history.back();
						window.location.href="<?php echo $url; ?>";
					}
					
				}
			);
		}

		function callpay()
		{
			if (typeof WeixinJSBridge == "undefined"){
			    if( document.addEventListener ){
			        document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
			    }else if (document.attachEvent){
			        document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
			        document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
			    }
			}else{
			    jsApiCall();
			}
		}

	</script>
</head>
<body>

</body>
</html>