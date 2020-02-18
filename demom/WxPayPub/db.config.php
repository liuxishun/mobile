<?php
/**
* 	配置账号信息
*/

class ConfigDb
{
	//微信公众号身份的唯一标识。审核通过后，在微信发送的邮件中查看
	const APPID = 'wxcd720e416bcaaa0d';
	//JSAPI接口中获取openid，审核后在公众平台开启开发模式后可查看
	const APPSECRET = 'e5ebc693eeb62f3ab03253297a5a41e7';
	//数据库用户
	const USERNAME = 'mumway';
	//数据库密码
	const PASSWORK = 'Mumway1234!@#$';
	//数据库连接地址
	const KUURL = 'rm-8vb431shd233813u6mo.mysql.zhangbei.rds.aliyuncs.com';
	//数据库库名称
	const KUNAME = 'yun';
	
	/**
	 * 获取mysql连接
	 * $db 为库名
	 */
	public static function mysqlConnect($db = 'yun'){
		$conn=mysql_connect(self::KUURL,self::USERNAME,self::PASSWORK);
		mysql_query("set names 'utf8'");
		mysql_select_db($db);
		return $conn;
	}
	
	//示远短信推送
	public static function yuanMsg($mobile, $msg){
		$mobile = trim($mobile);
		if(!$mobile){
			return 0;
		}
		//$msg = iconv('UTF-8', 'GBK', $msg);
		$msg = urlencode($msg);//发送内容
		$target = "http://send.18sms.com/msg/HttpBatchSendSM?account=30fv2g&pswd=hxJUKC10&mobile={$mobile}&msg={$msg}&needstatus=true&product=";
		$ret = trim(file_get_contents($target));
		if(strpos($ret, ',0')!==false){
			return 1;
		}else{
			return 0;
		}
	}
	
}
	
?>