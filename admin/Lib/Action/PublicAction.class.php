<?php
// 后台管理员登录以及相关操作
class PublicAction extends BaseAction
{
    /**
    * 默认操作
    */
	public function login()
	{
		import('ORG.Util.String');

        $POST = array_trim($_POST);
        $db = M('admin');
        /*
        $slt = String::randString(8);
        $psw = $this->my_md5('111111', $slt);
        echo $psw . '|' . $slt;exit; //663700d975344485d4e059d56b58af4c|ZAaXjnde
        $db->add(array('username'=>'admin', 'password'=>$psw, 'salt'=>$slt, 'addtime'=>time()));
        */
		if ($_POST) {
			$username = $POST['username'];
			$password = $POST['password'];
			if (!$username || !$password) {
				$this->error('用户名或密码不能为空！' , '__APP__/Public/login');
			}
			
			if($_SESSION['verify'] != md5($_POST['verify'])) {
			   unset($_SESSION[C('verify')]);
               $this->error('验证码错误！' , '__URL__/login');
			}
			$row = $db->where(array('username'=>$username))->find();
            //echo $db->getLastSql();exit;
			
			if($row) {
				if($row['password'] != $this->my_md5($password, $row['salt'])) {
					$this->error('密码错误！' , '__URL__/login');
				}
				$_SESSION['admin_id'] =$row['id'];
				$id = $_SESSION[C('MY_AUTH_KEY')];
                if($id==1){
                    $_SESSION[C('MY_ADMIN_AUTH_KEY')] = $id;
                }

				$db->where(array('id'=>$id))->save(array('login_num'=>array('exp', 'login_num+1'), 'lastlogin'=>time()));
				$this->success('登录成功！','__APP__/Index/index');
				exit;
			}else {
				$this->error('帐号不存在或已禁用！' , '__URL__/login');
			}
		}
		$this->display();
	}
	/**
	 * 管理员退出
	 */
	public function logout()
	{
		if(isset($_SESSION[C('MY_AUTH_KEY')])) {
			unset($_SESSION[C('MY_AUTH_KEY')]);
            unset($_SESSION[C('MY_ADMIN_AUTH_KEY')]);
            session_destroy();
			$this->success('退出成功！' , '__URL__/login');
		}else {
			$this->error('退出失败！' , '__APP__/Index/index');
		}
	}
	
	/**
	 * 后台主页控制面板信息
	 */
	public function panel()
	{
		$security_info=array();
		if(APP_DEBUG==true){
			$security_info[]="强烈建议您网站上线后，关闭 DEBUG （错误提示）";
		}
		$this->assign('security_info',$security_info);
		$server_info = array(
		    '信息平台版本'=>'1.0 beta',
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
		    'PHP运行方式'=>php_sapi_name(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
		    '服务器时间'=>date("Y年n月j日 H:i:s"),
		    '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
		);
		$this->assign('server_info',$server_info);
		$Depart_mod=D('Department');
		$res=$Depart_mod->where('id='.$_SESSION['admin_info']['depart_id'])->find();
		$this->assign('department',$res);
		$this->display();
	}
	
	 /**
	 * 后台验证码
	 ***/
	public function verify(){
        import('ORG.Util.Image');
        Image::buildImageVerify();
    }


}
?>