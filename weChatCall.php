<?php
//微信服务回调方法
define("TOKEN", "mumway");//定义识别码
$wechatObj = new wechatCallbackapiTest();//实例化wechatCallbackapiTest类
if(!isset($_GET["echostr"])){
	 $wechatObj->responseMsg();
}else{
	$wechatObj->valid();
}

class wechatCallbackapiTest {
	
	//日志
	function  log_result($file,$word){
		//$file文件路径，$word内容
		$fp = fopen($file,"a");
		flock($fp, LOCK_EX) ;
		fwrite($fp,"执行日期：".strftime("%Y-%m-%d-%H：%M：%S",time())."\n".$word."\n");
		flock($fp, LOCK_UN);
		fclose($fp);
	}
	
	//微信验证
	public function valid(){ 
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
        	ob_clean();
         	echo $echoStr;
         	exit;
        }
    }
	
    //执行接收器方法
    public function responseMsg(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		//$log_name="weChatCall.log";//log文件路径
		//$this->log_result($log_name,$postStr);
		if (!empty($postStr)){
			  $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			  $RX_TYPE = trim($postObj->MsgType);
			  switch($RX_TYPE){
				 case "event":
					 //接收事件
					 $result = $this->receiveEvent($postObj);
					 break;
				 case "text":
					 //接受文本消息
					 $result = $this->receiveText($postObj);
				 	break;
				 case "image":
				 	//接受图片消息
				 	$result = $this->receiveImg($postObj);
				 	break;
			  }
			  echo $result;
	    }else{
			echo "";
			exit;
	    }
	}
	
	//根据事件做相应操作
	private function receiveEvent($postObj){
		global $weMa;
		$openid = $postObj->FromUserName;
		$content = "";
		switch ($postObj->Event){
			case "subscribe":
				$content = "";
				break;
			case "unsubscribe":
				$content = "";
				break;
			case "VIEW":
				$ekey = $postObj->EventKey;
				if('http://m.mumway.com/index.php/ke/jy_zhibo' == $ekey){
						
				}
				break;
	   }
	   $result = $this->transmitText($postObj,$content);
	   return $result;
    }
    
    //处理文本信息
    private function receiveText($postObj){
    	global $weMa;
    	$openid = $postObj->FromUserName;
    	$content = "";
    	switch ($postObj->Content){
    		case "11":
    			$content = "1111";//这里是向关注者发送的提示信息
    			$result = $this->transmitText($postObj, $content);
    			break;
    		default:
    			$content = "输入错误！";//这里是向关注者发送的提示信息
    			$result = $this->transmitText($postObj, $content);
    	}
    	
    	return $result;
    }
    
    //处理图片信息
    private function receiveImg($postObj){
    	$content = "";
    	$result = $this->transmitText($postObj,$content);
    	return $result;
    }
    
    //发送消息模式
	private function transmitText($object,$content){
		$textTpl = "<xml>
		   <ToUserName><![CDATA[%s]]></ToUserName>
		   <FromUserName><![CDATA[%s]]></FromUserName>
		   <CreateTime>%s</CreateTime>
		   <MsgType><![CDATA[text]]></MsgType>
		   <Content><![CDATA[%s]]></Content>
		   <FuncFlag>0</FuncFlag>
		   </xml>";
		$result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $content);
		return $result;
    }
    
    //发送图片消息模式
    private function transmitImage($object,$mediaId){
    	$textTpl = "<xml>
		   <ToUserName><![CDATA[%s]]></ToUserName>
		   <FromUserName><![CDATA[%s]]></FromUserName>
		   <CreateTime>%s</CreateTime>
		   <MsgType><![CDATA[image]]></MsgType>
    	   <Image>
    	   <MediaId><![CDATA[%s]]></MediaId>
    	   </Image>
		   </xml>";
    	$result = sprintf($textTpl, $object->FromUserName, $object->ToUserName, time(), $mediaId);
    	return $result;
    }
	
    //验证该请求来源于微信
	private function checkSignature(){
		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		if( $tmpStr == $signature ){
		   return true;
		}else{
		   return false;
		}
	}
	
}
?>