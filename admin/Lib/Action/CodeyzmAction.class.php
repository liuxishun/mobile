<?php
header("content-type:text/html;charset=utf-8");

// 本类由系统自动生成，仅供测试用途
class CodeyzmAction extends BaseAction {
    
	
	/*
登录验证码
url:  index.php?m=codeyzm&a=getcode&ZhuCeUserName
返回值   :验证码
	*/
	
	public function getcode(){

		$db=D('Code');
		
         $result=$db->getMobilecode($this->_get('ZhuCeUserName'));
		 //print_r($result);
		echo $this->ajaxReturn($result);

	
    }

	public function   reg()
	{
           $db=D('Code');
		  import('ORG.Util.String');
	      $salt = String::randString(8);
	    $result=$db->_reg($this->_get('ZhuCeUserName'),$this->my_md5($this->_get('ZhuCeMiMa'), $salt),$salt);
		 //print_r($result);
		echo $this->ajaxReturn($result);

	}




	/*
	忘记密码验证码
url:  index.php?m=codeyzm&a=getcode&getmima=
返回值   :验证码
	*/

	public  function  getmima()
	{
      $db=D('Code');
		 $result=$db->_getmima($this->_get('ZhaoHuiYanZhengMa'));
		// print_r($result);
		echo $this->ajaxReturn($result);

	}
		/*
	忘记密码
url:  index.php?m=codeyzm&a=upmima&ZhaoHuiUserName=val&ZhaoHuiMiMa=val

返回值  

1  修改成功
-1   修改失败
	*/

	public  function  upmima()
	{
      $db=D('Code');
		 $result=$db->_upmima($this->_get('ZhaoHuiUserName'),$this->_get('ZhaoHuiMiMa'));
		// print_r($result);
		echo $this->ajaxReturn($result);

	}

//健康档案
   public   function    creatdata()
	{
	     $db=D('Code');
		 $result=$db->_creatdata($this->_get('jiankangdangan'),$this->_get('uid'));
		
		   echo $this->ajaxReturn($result);

	}










//公用

		private function successMessage($result){

	
		return json_encode(array('result'=>$result));
	}


	private function errorMessage($code,$message,$result){
		$message = array(
				'code'=>$code,
				'message'=>$message,
			    'data'=>$result
		);
		return json_encode(array('result'=>$message));
	}

}