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
		$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
		//触发微信返回code码
		$url = $jsApi->createOauthUrlForCode($url, $_GET['did']);
		Header("Location: $url");
	}else
	{
		//获取code码，以获取openid
	    $code = $_GET['code'];
		$jsApi->setCode($code);
		$openid = $jsApi->getOpenId();
		$did = $_GET['state'];//订单ID
		//自定义订单号，此处仅作举例
		$timeStamp = time();//当前时间戳
		$out_trade_no = WxPayConf_pub::APPID."$timeStamp";
		$conn=ConfigDb::mysqlConnect();
		$search = mysql_query("select id,amount,openid,orderno,herlive_course_id,herlive_course_name from newadmin.mumway_herlive_order where id=$did",$conn);
		$search = mysql_fetch_row($search);
		//var_dump($search);
		if($search){
			$out_trade_no = $search[3];
		}else{
			die("没有此订单");
		}
	}
	$url = "http://m.mumway.com/index.php/km/wodexuexi/openid/{$search[2]}";
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
	$unifiedOrder->setParameter("body", "$search[5]");//商品描述
	$unifiedOrder->setParameter("out_trade_no", "$out_trade_no");//商户订单号 
	$total_fee = intval($search[1])*100;
	if($openid == 'olwOsjvawl8HIxfkQUTeGRwC-d8U'){
		$total_fee = 1;
	}
	$unifiedOrder->setParameter("total_fee", "$total_fee");//总金额
	$unifiedOrder->setParameter("notify_url","http://m.mumway.com/demom/herlivePay_url.php");//通知地址 
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
	//echo $jsApiParameters;die;

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