<?php
/**
* 	配置账号信息
*/

class WxPayConf_pub
{
	//=======【基本信息设置】=====================================
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wx30558f4b9433f66e';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = '83ad5bb0ba0b8ca7deb5d729dff1f29a';
	//受理商ID，身份标识
	const MCHID = '1287611701';
	//商户支付密钥Key。审核通过后，在微信发送的邮件中查看
	const KEY = 'mumwayxzw2016888mumway8889999lbq';
	
	//=======【JSAPI路径设置】===================================
	//获取access_token过程中的跳转uri，通过跳转将code传入jsapi支付页面
	const JS_API_CALL_URL = 'http://m.mumway.com/demo2/js_api_call.php';
	const PINGFU_URL = 'http://m.mumway.com/demo2/pingfu.php';
	const MUMWAY_URL = 'http://m.mumway.com/demo2/mumway.php';
	const YIYUAN = 'http://m.mumway.com/demo2/js_1yuan.php';
	//=======【证书路径设置】=====================================
	//证书路径,注意应该填写绝对路径
	const SSLCERT_PATH = 'WxPayPub/cacert/apiclient_cert.pem';
	const SSLKEY_PATH = 'WxPayPub/cacert/apiclient_key.pem';
	const SSLROOTCA_PATH = 'WxPayPub/cacert/rootca.pem';
	
	//=======【异步通知url设置】===================================
	//异步通知url，商户根据实际开发过程设定
	const NOTIFY_URL = 'http://m.mumway.com/demo2/notify_url.php';
	const PINGFU_URLN = 'http://m.mumway.com/demo2/pingfu_url.php';
	const YIYUAN_URL = 'http://m.mumway.com/demo2/js_1yuan_url.php';

	//=======【curl超时设置】===================================
	//本例程通过curl使用HTTP POST方法，此处可修改其超时时间，默认为30秒
	const CURL_TIMEOUT = 30;
}
	
?>