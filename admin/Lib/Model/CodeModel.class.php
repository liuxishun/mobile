<?php
header("content-type:text/html;charset=utf-8");

class CodeModel extends Model {
	//注册验证码
    public function getMobilecode($account) {
		 //echo 1;die;
		$account = $account;
		
		if (!$account || strlen($account)!=11 ) {
			return $this->rt ( '', '手机号不能为空或格式错误', 0 );
		} else {

                $db1=D('member');
                $row = $db1->where(array('mobile'=>$account))->find();
            if($row){
			
                return $this->rt ( '', '手机号已经被使用，请更换其它手机号', 0 );
            }	
                $db = D('Getcode');
				$code = $db->getOneSafecode ( $account );
				// 发送注册duanxin
                $srt = $db->sendMsg($account, "您注册的有律创业0验证码是：".$code);                if($srt['status']!=1){
				
                    //print_r($srt);exit;
                    //return $this->rt ( '', $srt['info'], 0);
                    return $this->rt ( '', '发送错误，短信验证码'.$code , 0);//
                }else{
					
                    return $this->rt ( $code, "发送成功，请注意接收短信", 1 );//($code)
					}
			
		}
	}

	//注册
	public  function   _reg($mobile,$pwd,$salt)
	{

       
        $data['mobile']=$mobile;
        $data['salt'] = $salt;
        $data['password'] = $pwd;
		$data['addtime']=time();
		$db=D('member');
		$arr=$db->add($data);
		 //echo $db->getLastsql();
		if($arr)
		{
			 return $this->rt ( '','注册成功', 1);
		}else
		{
          return $this->rt ('','注册失败', 0);
		}		
	}

    //忘记密码验证码
	    public function _getmima($account)
		 {
			$account = $account;


           $db1=D('member');
            $row = $db1->where(array('mobile'=>$account))->find();
            if($row){
				$db = D('Getcode');
				$code = $db->getOneSafecode ($account);
				// 发送注册duanxin
                $srt = $db->sendMsg($account, "您注册的有律创业验证码是：".$code);
                if($srt['status']!=1){
                    return $this->rt ( '', '发送错误，短信验证码'.$code , 0);//
                }else{
					
                    return $this->rt ( $code, "发送成功，请注意接收短信", 1 );//($code)
                } 
			}else
			 {
				 return $this->rt ( '', "用户名不正确或没有此用户", -1);
			 }
     	}

		//忘记密码
	public  function   _upmima($user,$pwd)
	{
		$db=D('member');
		$data['password']=$pwd;
		$arr=$db->where("mobile='".$user."'")->save($data);
		if($arr){

		 return $this->rt ('', "密码重置成功",1);
		}else
		{
       return $this->rt ('', "密码重置失败",'-1');

		}




	}
	//健康档案
	public  function  _createdata($arr,$uid)
	{
		$dat=json_decode($arr,true);
		$data['name']   =    $dat['jbxx']['name'];
		$data['age']    =    $dat['jbxx']['age'];
		$data['nation'] =    $dat['jbxx']['nation'];
		$data['tall']   =    $dat['jbxx']['tall'];
		$data['xueya']  =    $dat['jbxx']['xueya'];
		$data['yqtz']   =    $dat['jbxx']['yqtz'];
		$data['mqtz']   =    $dat['jbxx']['mqtz'];
		$data['mqzk']   =    $dat['stzk']['mqzk'][0];
		$data['mqzk_desc']=  $dat['stzk']['mqzk'][1];
		$data['yqbfz']=      $dat['stzk']['yqbfz'][0];
		$data['yqbfz_desc']= $dat['stzk']['yqbfz'][1];
		$data['czgm']   =    $dat['stzk']['czgm'][0];
		$data['fyqk']   =    $dat['stzk']['fyqk'][0];
		$data['kw']     =    $dat['ysxg']['kw'][0];
		$data['eattype']=    $dat['ysxg']['eattype'];
		$data['like_eat']=   $dat['ysxg']['like_eat'];
		$data['no_eat']=     $dat['ysxg']['no_eat'];
		$data['u_id']=     $uid;
		$db=D('dangan');
		$arr=$db->add($data);
		if($arr){

		 return $this->rt ($uid, "档案创建成功",1);
		}else
		{
       return $this->rt ('', "档案创建失败",'-1');
		}


		 






		
	}







	//公用
	  private function rt($data, $info, $status){
        return array('data'=>$data, 'info'=>$info, 'status'=>$status);
    }



}