<?php

class AuthModel extends Model {
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    /**
    * 获取一个登录token(loginid, type[0web,1客户端])
    */
    public function getToken($loginid, $type=0){
        $token = $type . '_' . md5(uniqid($loginid.time(), true));
        while($this->where(array('id'=>$token))->find()){
            $token = $type . '_' . md5(uniqid($loginid.time(), true));
        }
        
        $ip = get_client_ip();
        $time = time();
        $row = $this->where(array('loginid'=>$loginid, 'type'=>$type))->find();
        if($row){
            $this->where(array('id'=>$row['id']))->save(array('id'=>$token, 'loginip'=>$ip, 'logintime'=>$time));
        }else{
            $this->add(array('id'=>$token, 'loginid'=>$loginid, 'type'=>$type, 'loginip'=>$ip, 'logintime'=>$time));
        }
        return $token;
    }

    /**
    * 根据token获取有效id
    */
    public function getLoginid($token, $type=0){
        if($type==1){
            $time = time()-30*3600*24;
        }else{
            $time = time()-7*3600*24;
        }
        $row = $this->where(array('id'=>$token, 'type'=>$type, 'logintime'=>array('gt', $time)))->find();
        if($row){
            return $row['loginid'];
        }else{
            return null;
        }
    }

    /**
    * 删除token
    */
    public function removeToken($token, $type){
        $this->where(array('id'=>$token, 'type'=>$type))->delete();
    }
}