<?php

class GetcodeModel extends Model {
    
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    /**
    * 获取一个验证码
    * $codetype 0 字母 1 数字 '' 混合
    */
    public function getOneSafecode($account, $codetype=1, $codelen=6){
        import('ORG.Util.String');
        $code = String::randString($codelen, $codetype);
        return $code;
    }

    /**

    /**
    * 短信发送
    */
    public function sendMsg($mobile, $msg){
        $mobile = trim($mobile);
        if(!$mobile || strlen($mobile)>11){
            return ;
        }
		
        $msg = $msg.'【有律创业】'; //带上签名
		//echo $msg."<br>";
        $msg = urlencode($msg);
	 //  echo urldecode($msg) ;

$userid = '';
//用户账号 $account
$account = 'z00183';
//用户密码 $password
$password = '456789';
//发送到的目标手机号码 $mobile
$mobile = $mobile;
//短信内容 $content
$content =$msg;


//发送短信（其他方法相同）
$gateway ="http://xintx.telhk.cn/sms.aspx?action=send&userid={$userid}&account={$account}&password={$password}&mobile={$mobile}&content={$content}&sendTime=";
//echo $gateway;
$ret = trim(file_get_contents($gateway));  






       //var_dump($ret);die;
       // $ret = trim(file_get_contents($target));

        if(strpos($ret, '<returnstatus>Success</returnstatus>')!==false){
            return array('info'=>'', 'status'=>1);
        }else{
            preg_match("#<message>([^<]*)</message>#", $ret, $matches);
            return array('info'=>'发送错误，错误消息：'.$matches[1], 'status'=>0);
        }
    }



}