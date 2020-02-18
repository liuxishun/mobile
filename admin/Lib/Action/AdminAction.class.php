<?php
//后台用户管理
class AdminAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M("admin");
			$data["username"]=$this->_post("username");
            if(!$data["username"]){
                $this->error("用户名不能为空");
            }
			if(!$db->where(array('username'=>$data["username"]))->select()){
				$data["password"] = $this->_post("pwd");
                if(!$data["password"]){
                    $this->error("密码不能为空");
                }
                import('ORG.Util.String');
                $salt = String::randString(8);
                $data['salt'] = $salt;
                $data["password"] = $this->my_md5($data["password"], $salt);
				$data["addtime"] = time();
				$data['diid'] = $this->_post("diid");
				if($db->add($data)){
					$this->success("添加成功", "__URL__/lists");
				}else{
					$this->error("添加失败，请重新添加");
				}
			}else{
				$this->error("名称已存在，请重新添加");
			}
		}else{
			$dian = M("dian")->select();
			$this->assign('dian', $dian);
			$this->display();
		}
	}
	

	/**
	 * 列表页
	 */
	public function lists(){
		if(C('MY_AUTH_ON')){
            $this->lists_role();
            exit;
        }
        $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        
		$db = M("admin");

        $condition = '1=1';
        $para = array();
        $para['username'] = $this->_get('username');
        if($para['username']){
            $condition .= " AND username like '%". $para['username'] ."%'";
        }
        $this->assign('para', $para);

		$count = $db->where($condition)->count();
		$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
		$this->display();
	}

    /**
	 * 列表页
	 */
	public function lists_role(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;

        
        
		$db = M("admin");
        $db_pre = C('DB_PREFIX');
        $tb_user_role = C('MY_RBAC_USER_TABLE');
        $tb_role = C('MY_RBAC_ROLE_TABLE');
        $join = "$tb_user_role ON {$tb_user_role}.user_id={$db_pre}admin.id";

        $condition = '1=1';
        $para = array();
        $para['role_id'] = $this->_get('role_id');
        if($para['role_id']*1){
            $condition .= " AND role_id='". ($para['role_id']*1) ."'";
        }
        $para['username'] = $this->_get('username');
        if($para['username']){
            $condition .= " AND username like '%". $para['username'] ."%'";
        }
        $this->assign('para', $para);

		$count = $db->join($join)->where($condition)->count();
        //echo $db->getLastSql();exit;
		$list = $db->join($join)->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();

        foreach($list as $k=>$v){
            $role = M($tb_role, null)->where(array('id'=>$v['role_id']))->find();
            $list[$k]['role'] = $role;
        }
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
        $tb = M($tb_user_role, null);
        $rlist = $tb->Distinct(true)->field("{$tb_role}.*")->join("$tb_role ON {$tb_user_role}.role_id={$tb_role}.id")->select();
        //echo $tb->getLastSql();exit;
        $this->assign('rlist', $rlist);

		$this->display();
	}
	
	/**
	 * 管理员编辑
	 */
	public function edit(){
		$db = M("admin");
		if($this->isPost()){
			$id = $this->_post("id");
			$xpassword = trim($_POST['xPassword']);
            if(!$xpassword){ 
				$this->error('请输入新密码');
			}
            import('ORG.Util.String');
            $salt = String::randString(8);
            $data['salt'] = $salt;
			$data['diid'] = $this->_post("diid");
			$data['password'] = $this->my_md5($xpassword, $salt);
			if($db->where(array('id'=>$id))->save($data)){
				$this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$dian = M("dian")->select();
			$this->assign('dian', $dian);
			$this->assign("arr", $arr);
			$this->display();
		}
	}
	
	/**
	 * 管理员删除
	 */
	public function del(){
		$db = M("admin");
        $db_user_role = M(C('MY_RBAC_USER_TABLE'), null);
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
            foreach($arr as $k=>$v){
                if($v==1)unset($arr[$k]);
            }
			$str=implode(",",$arr);
            $data['id'] = array('in', $str);
			if($db->where($data)->delete()){
                $data['user_id'] = $data['id'];
                unset($data['id']);
                $db_user_role->where($data)->delete();
                $this->success2("删除成功", "__URL__/lists");
			}else{
                $this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
			$data['id'] = array(array('eq', $id), array('neq', 1));
            if($db->where($data)->delete()){
				$data['user_id'] = $data['id'];
                unset($data['id']);
                $db_user_role->where($data)->delete();
                $this->success2("删除成功", "__URL__/lists");
			}else{
                $this->error("删除失败");
			}
		}
	}


    /**
	 * 修改密码
	 */
	public function changepsw(){
		$db = M("admin");
		if($this->isPost()){
			$id = $this->admin_id;
            $user = $db->where(array('id'=>$id))->find();
            $opassword = $this->_post('oPassword');
			$xpassword = $this->_post('xPassword');
			$qpassword = $this->_post('qPassword');
            if(!$opassword){ 
				$this->error('请输入旧密码');
			}
            if(!$xpassword){ 
				$this->error('请输入新密码');
			}
			if($xpassword != $qpassword){ 
				$this->error('两次密码输入不一致,请从新输入');
			}
            if($user['password']!=$this->my_md5($opassword, $user['salt'])){
                $this->error('旧密码输入不正确');
            }

            import('ORG.Util.String');
            $slt = String::randString(8);
            $data['salt'] = $slt;
			$data['password'] = $this->my_md5($xpassword, $slt);
			if($db->where(array('id'=>$id))->save($data)){
				$this->success("修改成功", "__SELF__");
			}else{
				$this->error("修改失败", "__SELF__");
			}
		}else{
			$this->display();
		}
	}
  
}
?>