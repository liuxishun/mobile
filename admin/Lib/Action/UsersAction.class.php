<?php
header("Content-Type:text/html;charset=utf-8"); 
// 本类由系统自动生成，仅供测试用途
class UsersAction extends BaseAction{
	private $key = 'abcdefghigklmn123456789';
	private $errorMessage = '';
	private $USERMODEL = 'user_model';
	
	
	static $error = '系统异常';
	static $telError = '用户名不存在';
	static $loginError = '密码错误';
	static $loginStatusError = '账号已被禁用，请联系客服';
	static $regTelError = '用户名不存在存在';
	static $regSuccess = '注册成功';
	static $loginSuccess = '注册成功';
	static $regError = '注册失败';
	static $perfactMessageSuccess = '信息完善成功';
	static $perfactMessageErrors = '信息完善失败';
	static $perfactMessageError = '请完善信息';
	static $false='修改失败';

	/**
	 *  登录接口 /Index/memberLogin
	 * 	方式：POST
	 *  发送参数：
	 *  	tel 手机号
	 *  	password 无加密密码
	 *  返回参数
	 *  	1 => uid 用户唯一标示
	 *
	 * */
	public function memberLogin(){
		$_REQUEST['DengLuUserName']="123456";
		$_REQUEST['Denglupassword']="123456";
		$db = D('User');
		//print_r($_REQUEST);die;
		if($_REQUEST){
			if(!$db->validate_tel($_REQUEST['DengLuUserName'])){
				echo $this->errorMessage('-2',self::$telError);
			}else{
				$result = $db->validate($_REQUEST);
				//print_r($result);
				if($result['status'] != 0){
					if($result['password']==$this->my_md5($_REQUEST['Denglupassword'], $result['salt'])){
						echo $this->successMessage('1',self::$loginSuccess,$result['id']);
					}else{
						echo $this->errorMessage('0',self::$loginError);
					}
				}
				else{
					echo $this->successMessage('0',self::$loginStatusError);exit();
				}
				
			}
		}else{
			echo $this->errorMessage('-1',self::$error);
		}

	}



	/**
	 *  健康首页 /Index/health
	 * 	方式：get
	 *  发送参数：
	 *  	天数    healthweeknumber
			uid		用户id
	 *  返回参数
	 *  	indicator_height	身高
			indicator_weight	体重
			indicator_baby_desc	宝贝详情
			yuchan				预产期
			tian				第几天
			fooddesc			描述
			zaocan				早餐
			y_desc				孕期要点
	 *
	 * */
	public function health(){
		$_REQUEST['healthweeknumber']=10;
		$_REQUEST['uid']=38;
		$db = D('User');
		
		//$db=M("member");
		//$rea=$db->where("id=".$_REQUEST['uid'])->field("addtime")->find();
		$rea['addtime']=1438074910;
		//这个$day其实得是下订单到现在的时间(现在只是模拟的注册到现在的时间)
		//$day=ceil((time()-$rea['addtime'])/3600);
		$day=4;
		
		if($_REQUEST){
			$result=$db->healthhome($_REQUEST);
			$result['yuchan']=280-$_REQUEST['healthweeknumber'];
			//孕期要点
			$ress=M('yunqi')->where("y_day=".$day)->field("y_desc")->find();
			//查询当前时间的营养美食
			$resa=M("taocan")->where("tian=$day")->field("zaocan,fooddesc,tian")->find();
			//echo M('taocan')->getlastsql();die;
			//print_r($resa);die;
			$result=array_merge($result,$resa,$ress);
			//print_r($result);die;
			echo $this->successMessage('1',self::$loginSuccess,$result);
		}else{
			echo $this->errorMessage('-1',self::$error);
		}
	}



	/**
	 *  健康首页下面详情的早餐 /Users/breakfist
	 * 	方式：get
	 *  发送参数：
	 *  	第几天    tian
	 *  返回参数
			fooddesc			早餐描述
			zaocan				早餐
	 *
	 * */
	public function breakfist(){
		$_REQUEST['tian']=6;
		//$db=M("member");
		//$rea=$db->where("id=".$_REQUEST['uid'])->field("addtime")->find();
		//这个$day其实得是下订单到现在的时间(现在只是模拟的注册到现在的时间)
		//$day=ceil((time()-$rea['addtime'])/3600);
		if($_REQUEST){
			
			//查询当前时间的营养美食
			$result=M("taocan")->where("tian=".$_REQUEST['tian'])->field("zaocan,zaocandesc,firstimg")->find();
			//print_r($result);die;
			
			//echo M('taocan')->getlastsql();die;
			echo $this->successMessage('1',self::$loginSuccess,$result);
		}else{
			echo $this->errorMessage('-1',self::$error);
		}
	}


	/**
	 *  健康首页下面详情的午餐 /Users/lunch
	 * 	方式：get
	 *  发送参数：
	 *  	第几天    tian
	 *  返回参数
			fooddesc			早餐描述
			zaocan				早餐
	 *
	 * */
	public function lunch(){
		$_REQUEST['tian']=4;
		//$db=M("member");
		//$rea=$db->where("id=".$_REQUEST['uid'])->field("addtime")->find();
		//这个$day其实得是下订单到现在的时间(现在只是模拟的注册到现在的时间)
		//$day=ceil((time()-$rea['addtime'])/3600);
		if($_REQUEST){
			
			//查询当前时间的营养美食
			$result=M("taocan")->where("tian=".$_REQUEST['tian'])->field("wucan,wucandesc,lunchimg")->find();
			//echo M('taocan')->getlastsql();die;
			echo $this->successMessage('1',"查询成功",$result);
		}else{
			echo $this->errorMessage('-1',self::$error);
		}
	}
	


	/**
	 *  健康首页下面详情的午餐 /Users/dinner
	 * 	方式：get
	 *  发送参数：
	 *  	第几天    tian
	 *  返回参数
			fooddesc			早餐描述
			zaocan				早餐
	 *
	 * */
	public function dinner(){
		$_REQUEST['tian']=4;
		//$db=M("member");
		//$rea=$db->where("id=".$_REQUEST['uid'])->field("addtime")->find();
		//这个$day其实得是下订单到现在的时间(现在只是模拟的注册到现在的时间)
		//$day=ceil((time()-$rea['addtime'])/3600);
		if($_REQUEST){
			
			//查询当前时间的营养美食
			$result=M("taocan")->where("tian=".$_REQUEST['tian'])->field("wancan,wancandesc,dinnerimg")->find();
			//echo M('taocan')->getlastsql();die;
			echo $this->successMessage('1',"查询成功",$result);
		}else{
			echo $this->errorMessage('-1',self::$error);
		}
	}


	/**
	 *  营养美食的图片批量上传 /Users/uploadimg
	 * 	方式：get
	 *  发送参数：
	 *  	第几天    tian
	 *  返回参数
			fooddesc			早餐描述
			zaocan				早餐
	 *
	 * */
	 /*
	public function uploadimg(){
		$_REQUEST['uid']=1;
		$_REQUEST['tian']=4;
		//还得传个参数来分辨是早餐还是午餐晚餐(1代表早餐，2代表午餐，3代表晚餐)
		$_REQUEST['zww']=1;
		if($_REQUEST['zww']==1){
			import("ORG.Net.UploadFile");
			$upload = new UploadFile();
			foreach ($_FILES as $key=>$file){
				if(!empty($file['name'])) {
					$upload->autoSub = true;
					$upload->subType   =  'date';
					$info =  $upload->uploadOne($file);
					if($info){ // 保存附件信息
						M('foodimg')->add($info);
					}else{ // 上传错误
						$this->error($upload->getErrorMsg());
					}
				}
			}
		}else{
			echo $this->errorMessage('-1',self::$error);
		}
	}
	*/

	





	/**
	 *  在线咨询的默认提示 /Users/online_zx
	 * 	方式：get
	 *  发送参数：
	 *  	
	 *  返回参数
	 *  	yingyangshi	就是点击咨询进去的那个友情提示
	 *
	 * */
	public function online_zx(){
		$field="yingyangshi";
		$result = D('yingyangshi')->field($field)->select();
		echo $this->successMessage('1',"查询成功",$result);
	}

	/**
	 *  在线咨询的问答 /Users/answer
	 * 	方式：get
	 *  发送参数：
	 *  	用户id    uid
			用户提问	userdesc
	 *  返回参数
	 *  	id 提问id
			userdesc	用户提问
			uid		用户id
			pid		父id
			addtime		添加时间
	 *
	 * */
	public function answer(){
		$db = D('consult');
		$field="yingyangshi";
		//$data['uid']=$_REQUEST['uid'];
		//$data['userdesc']=$_REQUEST['userdesc'];
		$data['uid']=36;
		$data['userdesc']="aaaaaaaaaaaaaaa";
		$data['pid']="";
		$data['addtime']=time();
		$res=$db->add($data);
		if($data['userdesc']){
			if($res){
				$resa = M('yingyangshi')->field($field)->select();
				//print_r($result);
				//$res=$db->where("uid=".$_REQUEST['uid'])->select();
				$res=$db->where("uid=36")->order("addtime asc")->select();
				//print_r($res);
				$result=array_merge($resa,$res);
				//print_r($result);die;
				echo $this->successMessage('1',"发表成功",$result);
			}else{
				echo $this->errorMessage('-1',"发表失败");
			}	
		}else{
			echo $this->errorMessage('-1',self::$error);
		}
	}


	private function successMessage($code,$message,$data){
		$message = array(
				'code'=>$code,
				'message'=>$message,
				'data'=>$data
		);
		return json_encode($message);
	}
	private function errorMessage($code,$message,$data){
		$message = array(
			'code'=>$code,
			'message'=>$message,
			'data'=>$data
		);
		return json_encode($message);
	}

}