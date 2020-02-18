<?php

class SafecodeModel extends Model {
    
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

        //删除过期验证码
        $this->where(array('add_time'=>array('lt', time()-3600*24)))->delete();

        $data = array('account'=>$account, 'code'=>$code, 'add_time'=>time());
        $this->add($data);

        return $code;
    }

    /**
    * 检查验证码是否正确
    */
    public function checkSafecode($account, $code, $second_range=3600){
        $row = $this->where(array('account'=>$account, 'code'=>$code))->order('add_time DESC')->find();
        if($row){
            if(time()-$row['add_time']<=$second_range){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    private function post($curlPost,$url){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_NOBODY, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
            $return_str = curl_exec($curl);
            curl_close($curl);
            return $return_str;
    }

    private function xml_to_array($xml){
        $reg = "/<(\w+)[^>]*>([\\x00-\\xFF]*)<\\/\\1>/";
        if(preg_match_all($reg, $xml, $matches)){
            $count = count($matches[0]);
            for($i = 0; $i < $count; $i++){
            $subxml= $matches[2][$i];
            $key = $matches[1][$i];
                if(preg_match( $reg, $subxml )){
                    $arr[$key] = $this->xml_to_array( $subxml );
                }else{
                    $arr[$key] = $subxml;
                }
            }
        }
        return $arr;
    }

    /**
    * 短信模版发送
    */
    public function sendMsgTpl($tplid, $mobile, $msg){
        $account = 'XFTB702022';
        $password = '003908';
        $target = "http://222.185.228.25:8000/msm/sdk/http/sendsms.jsp?";
        
        if(empty($mobile)){
            exit('手机号码不能为空');
        }

        $content = array();
        foreach($msg as $k=>$v){
            $v = iconv('utf-8', 'gbk', $v);
            $content[] = "@{$k}@={$v}";
        }
        $content = join(',', $content);

        $_data = "username={$account}&scode={$password}&content={$content}&tempid={$tplid}&mobile={$mobile}";

        $ret = trim(file_get_contents($target . $_data));
        $ret = preg_replace('/\s/im', '', $ret);

        $code = str_replace('#', '', $ret);
        $code = substr($code, 0, 3);

        $errs = array();
        $errs['100'] = '发送失败';
        $errs['101'] = '用户账号不存在或密码错误';
        $errs['102'] = '账号已禁用';
        $errs['103'] = '参数不正确';
        $errs['105'] = '短信内容超过500字、或为空、或内容编码格式不正确';
        $errs['106'] = '手机号码超过100个或合法的手机号码为空，每次最多提交100个号';
        $errs['108'] = '余额不足';
        $errs['109'] = '指定访问ip地址错误';
        $errs['110'] = '短信内容存在系统保留关键词，如有多个词，使用逗号分隔：110#(李老师,成人)';
        $errs['114'] = '模板短信序号不存在';
        $errs['115'] = '短信签名标签序号不存在';

        if(strpos($code, '0')===0){
            return array('info'=>'', 'status'=>1);
        }else if($errs[$code]){
            return array('info'=>$errs[$code], 'status'=>0);
        }else{
            return array('info'=>'发送错误，未知错误', 'status'=>0);
        }
    }

    /**
    * 短信发送
    */
    public function sendMsg($mobile, $msg){
        $mobile = trim($mobile);
        if(!$mobile || strlen($mobile)>11){
            return;
        }
        /*
        //$msg = iconv('UTF-8', 'GBK', $msg);
        $msg = $msg.'【好孕妈妈】'; //带上签名
        $msg = urlencode($msg);
        $target = "http://xintx.telhk.cn/sms.aspx?action=send&account=z00109&password=853691&mobile={$mobile}&content={$msg}";

        $ret = trim(file_get_contents($target));

        if(strpos($ret, '<returnstatus>Success</returnstatus>')!==false){
            return array('info'=>'', 'status'=>1);
        }else{
            preg_match("#<message>([^<]*)</message>#", $ret, $matches);
            return array('info'=>'发送错误，错误消息：'.$matches[1], 'status'=>0);
        }*/
    	$msg = urlencode($msg);//发送内容
		$target = "http://send.18sms.com/msg/HttpBatchSendSM?account=30fv2g&pswd=hxJUKC10&mobile={$mobile}&msg={$msg}&needstatus=true&product=";
		$ret = trim(file_get_contents($target));
		if(strpos($ret, ',0')!==false){
			return array('info'=>'', 'status'=>1);
		}else{
			return array('info'=>'发送失败', 'status'=>0);
		}
    }



}