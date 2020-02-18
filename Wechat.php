<?php
/**
 * 获取mysql连接
 * $db 为库名
 */
function mysqlConnect($db = 'yun_online'){
//	$conn=mysql_connect('rm-8vb431shd233813u6.mysql.zhangbei.rds.aliyuncs.com','mumway','Mumway1234!@#$');
	$conn=mysql_connect('39.98.241.29','root','h.y.m.m.KXC@22');
	mysql_query("set names 'utf8'");
	mysql_select_db($db);
	return $conn;
}

/**
 * 微信授权相关接口
 * 
 * @link http://www.phpddt.com
 * 微信网页授权时通过OAuth2.0完成的，整个过程分为三步：
 * 用户授权，获取code；
 * 根据code获取access_token【可通过refresh_token刷新获取较长有效期】
 * 通过access_token和openid获取用户信息
 */
 
class Wechat {
    
    //高级功能-》开发者模式-》获取母婴护理服务号
    private $app_id = 'wx2eb3f16fda2a411f';
    private $app_secret = 'beb1c65c192b6d7d5ed25f91d9ba254d';
// 	private $app_id = 'wxbfaa1d17ea7b5920';
// 	private $app_secret = 'a304d186b2ed04a29a97f8b888b68e96';
 
 
    /**
     * 获取微信授权链接
     * 
     * @param string $redirect_uri 跳转地址
     * @param mixed $state 参数
     */
    public function get_snsapi_userinfo_url($redirect_uri = '', $state = '')
    {
        $redirect_uri = urlencode($redirect_uri);
        return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state={$state}#wechat_redirect";
    }
    
    /**
     * 获取微信授权链接
     *
     * @param string $redirect_uri 跳转地址
     * @param mixed $state 参数
     */
    public function get_snsapi_base_url($redirect_uri = '', $state = '')
    {
    	$redirect_uri = urlencode($redirect_uri);
    	return "https://open.weixin.qq.com/connect/oauth2/authorize?appid={$this->app_id}&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect";
    }
    
    /**
     * 获取授权token
     * 
     * @param string $code 通过get_authorize_url获取到的code
     */
    public function get_access_token($code = '')
    {
        $token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->app_id}&secret={$this->app_secret}&code={$code}&grant_type=authorization_code";
        $token_data = $this->http($token_url);
        
        if($token_data[0] == 200)
        {
            return json_decode($token_data[1], TRUE);
        }
        
        return FALSE;
    }
    

    /**
     * 获取授权后的微信用户信息
     *
     * @param string $access_token
     * @param string $open_id
     */
    public function get_user_info($access_token = '', $open_id = '')
    {
    	if($access_token && $open_id)
    	{
    		$info_url = "https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$open_id}&lang=zh_CN";
    		$info_data = $this->http($info_url);
    
    		if($info_data[0] == 200)
    		{
    			return json_decode($info_data[1], TRUE);
    		}
    	}
    
    	return FALSE;
    }
    
    /**
     * 微信分享获取授权access_ticket
     *
     */
    public function get_access_ticket()
    {
    	$token_url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->app_id}&secret={$this->app_secret}";
    	$token_data = $this->http($token_url);
    	/*
    	 {"access_token":"ACCESS_TOKEN","expires_in":7200}
    	 {"errcode":40013,"errmsg":"invalid appid"}
    	*/
    	if($token_data[0] == 200)
    	{
    		return json_decode($token_data[1], TRUE);
    	}
    
    	return FALSE;
    }
    
    /**
     * 微信分享获取授权jsapi_ticket签名
     *
     * @param
     */
    public function get_jsapi_ticket($access_token = '')
    {
    	$token_url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token={$access_token}&type=jsapi";
    	$token_data = $this->http($token_url);
    	
	    /*{
		"errcode":0,
		"errmsg":"ok",
		"ticket":"bxLdikRXVbTPdHSM05e5u5sUoXNKd8-41ZO3MhKoyN5OfkWITDGgnr2fwJ0m9E8NYzWKVZvdVtaUgWvsdshFKA",
		"expires_in":7200
		}*/
    	if($token_data[0] == 200)
    	{
    		return json_decode($token_data[1], TRUE);
    	}
    
    	return FALSE;
    }
    
    public function http($url, $method = 'GET', $postfields = null, $headers = array(), $debug = false)
    {
        $ci = curl_init();
        /* Curl settings */
        curl_setopt($ci, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ci, CURLOPT_TIMEOUT, 30);
        curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
 
        switch ($method) {
            case 'POST':
                curl_setopt($ci, CURLOPT_POST, true);
                if (!empty($postfields)) {
                    curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
                    $this->postdata = $postfields;
                }
                break;
        }
        curl_setopt($ci, CURLOPT_URL, $url);
        curl_setopt($ci, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ci, CURLINFO_HEADER_OUT, true);
 
        $response = curl_exec($ci);
        $http_code = curl_getinfo($ci, CURLINFO_HTTP_CODE);
 
        if ($debug) {
            echo "=====post data======\r\n";
            var_dump($postfields);
 
            echo '=====info=====' . "\r\n";
            print_r(curl_getinfo($ci));
 
            echo '=====$response=====' . "\r\n";
            print_r($response);
        }
        curl_close($ci);
        return array($http_code, $response);
    }
 
}