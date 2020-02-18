<?php
class RbacAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

        $this->table = array('role'=>C('MY_RBAC_ROLE_TABLE'),'user'=>C('MY_RBAC_USER_TABLE'),'access'=>C('MY_RBAC_ACCESS_TABLE'),'node'=>C('MY_RBAC_NODE_TABLE'));
    }
    
    /**
	 * 添加权限组
	 */
    public function role_add(){
		if($this->isPost()){
			$db = M($this->table['role'], null);
			$data=$this->_post("info");
            if(!$data["name"]){
                $this->error("权限组名不能为空");
            }
			if(!$db->where(array('name'=>$data["name"]))->find()){
                if($db->add($data)){
					$this->success("添加成功", "__URL__/roles");
				}else{
					$this->error("添加失败，请重新添加");
				}
			}else{
				$this->error("名称已存在，请重新添加");
			}
		}else{
			$this->display();
		}
	}
	

	/**
	 * 权限组列表页
	 */
	public function roles(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        
		$db = M($this->table['role'], null);

        $condition = '1=1';
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
	 * 权限组编辑
	 */
	public function role_edit(){
		$db = M($this->table['role'], null);
		if($this->isPost()){
			$id=$this->_post("id");
			
            $data=$this->_post("info");
            if(!$data["name"]){
                $this->error("权限组名不能为空");
            }
			if(!$db->where("id!='%s' AND name='%s'", array($id, $data["name"]))->find()){
                if($db->where(array('id'=>$id))->save($data)){
                    $this->success2("编辑成功", "__URL__/roles");
                }else{
                    $this->error("编辑失败");
                }
			}else{
				$this->error("名称已存在，请重新添加");
			}			
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$this->assign("arr", $arr);
			$this->display();
		}
	}
	
	/**
	 * 权限组删除
	 */
	public function role_del(){
		$db = M($this->table['role'], null);
        $access_db = M($this->table['access'], null);
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);
			if($db->where($data)->delete()){
				$access_db->where(array('role_id'=>array('in', $str)))->delete();
                $this->success2("删除成功", "__URL__/roles");
			}else{
				$this->error("删除失败");
			}
		}else{
			$id=$this->_get('id');
			if($db->where(array('id'=>$id))->delete()){
				$access_db->where(array('role_id', $id))->delete();
                $this->success2("删除成功", "__URL__/roles");
			}else{
				$this->error("删除失败");
			}
		}
	}

    /**
    * 权限组状态修改
    */
    public function role_status(){
		$db = M($this->table['role'], null);
		$id = $this->_get("id");
        $data['status'] = $this->_get("status")*1;
        
        if($db->where(array('id'=>$id))->save($data)){
            $this->success2("设置成功", "__URL__/roles");
        }else{
            $this->error("设置失败");
        }
	}

    /**
	 * 权限组权限编辑
	 */
	public function role_node_edit(){
		$db = M($this->table['access'], null);
		if($this->isPost()){
			$id=$this->_post("id");
            $db->where(array('role_id'=>$id))->delete();
            $arr=$this->_post("checkboxes");
            foreach($arr as $node_id){
                $db->add(array('role_id'=>$id, 'node_id'=>$node_id));
            }
            $this->success2("设置成功", "__URL__/roles");
		}else{
			$id = $this->_get("id");
            $this->assign('role_id', $id);
            $nlist = $this->getNodes(3, $id);

            $this->assign('nlist', $nlist);

			$this->display();
		}
	}

    /**
	 * 用户权限组编辑
	 */
	public function user_role_edit(){
		$db = M($this->table['user'], null);
		if($this->isPost()){
			$id=$this->_post("id");
            $db->where(array('user_id'=>$id))->delete();

            $role_id = $this->_post("role_id");
            if($role_id){
                $db->add(array('role_id'=>$role_id, 'user_id'=>$id));
            }
            $this->success2("设置成功", "__URL__/roles");
		}else{
            $id = $this->_get("id");
            $this->assign('userid', $id);
            $this->assign('username', base64_decode($this->_get("username")));

            $rlist = M($this->table['role'], null)->select();
            foreach($rlist as $k=>$v){
                if($db->where(array('role_id'=>$v['id'], 'user_id'=>$id))->count()){
                    $rlist[$k]['check_role'] = true;
                }
            }

            $this->assign('rlist', $rlist);

			$this->display();
		}
	}

    /**
    * 获取节点
    */
    protected function getNodes($level=3, $check_role=0){
        $db = M($this->table['node'], null);
        $access_db = M($this->table['access'], null);

		$list = $db->where("pid=0")->order('sort ASC')->select();

        foreach($list as $k=>$v){
            if($check_role){
                $list[$k]['check_role'] = $access_db->where(array('role_id'=>$check_role, 'node_id'=>$v['id']))->count();
            }
            $mlist = $db->where("pid='%s'", $v['id'])->order('sort ASC')->select();
            $list[$k]['mlist'] = $mlist;
            if($level==3){
                foreach($mlist as $m=>$n){
                    if($check_role){
                        $list[$k]['mlist'][$m]['check_role'] = $access_db->where(array('role_id'=>$check_role, 'node_id'=>$n['id']))->count();
                    }
                    $alist = $db->where("pid='%s'", $n['id'])->order('sort ASC')->select();
                    $list[$k]['mlist'][$m]['alist'] = $alist;
                    
                    foreach($alist as $e=>$f){
                        if($check_role){
                            $list[$k]['mlist'][$m]['alist'][$e]['check_role'] = $access_db->where(array('role_id'=>$check_role, 'node_id'=>$f['id']))->count();
                        }
                    }
                }
            }
        }
        return $list;
    }


    /**
	 * 添加节点
	 */
    public function node_add(){
		if($this->isPost()){
			$db = M($this->table['node'], null);
			$data=$this->_post("info");
            if(!$data["title"]){
                $this->error("节点名称不能为空");
            }
            if(!$data["name"]){
                $this->error("节点参数不能为空");
            }
            $data["isexp"] = $data["isexp"]*1;
			if($db->add($data)){
                $this->success("添加成功", "__URL__/nodes");
            }else{
                $this->error("添加失败，请重新添加");
            }
		}else{
			$this->assign('nlist', $this->getNodes(2));
            
            $this->display();
		}
	}

    /**
	 * 节点列表页
	 */
	public function nodes(){        
		$list = $this->getNodes();
        //print_r($list);exit;
		 
		$this->assign('list', $list);
		$this->display();
	}

    /**
	 * 节点编辑
	 */
	public function node_edit(){
		$db = M($this->table['node'], null);
		if($this->isPost()){
			$id = $this->_post("id");
			
            $data=$this->_post("info");
            if(!$data["title"]){
                $this->error("节点名称不能为空");
            }
            if(!$data["name"]){
                $this->error("节点参数不能为空");
            }
            $data["isexp"] = $data["isexp"]*1;
			if($db->where(array('id'=>$id))->save($data)){
                $this->success2("编辑成功", "__URL__/roles");
            }else{
                $this->error("编辑失败");
            }			
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$this->assign("arr", $arr);

            $this->assign('nlist', $this->getNodes(2));
			$this->display();
		}
	}

    /**
	 * 节点删除
	 */
	public function node_del(){
		$db = M($this->table['node'], null);
        $access_db = M($this->table['access'], null);
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
            $flag_all = true;
            foreach($arr as $id){
                if(!$db->where(array('pid'=>$id))->find()){
                    $db->where(array('id'=>$id))->delete();
                    $access_db->where(array('node_id'=>$id))->delete();
                }else{
                    $flag_all = false;
                }
            }
			if($flag_all){
				$this->success2("删除成功", "__URL__/nodes");
			}else{
				$this->error("部分删除失败，部分有子项目，不能删除");
			}
		}else{
			$id=$this->_get('id');
            if($db->where(array('pid'=>$id))->find()){
                $this->error("删除失败，该项有子项目，不能删除");
            }
			if($db->where(array('id'=>$id))->delete()){
				$access_db->where(array('node_id'=>$id))->delete();
                $this->success2("删除成功", "__URL__/nodes");
			}else{
				$this->error("删除失败");
			}
		}
	}

    /**
    * 节点状态修改
    */
    public function node_status(){
		$db = M($this->table['node'], null);
		$id = $this->_get("id");
        $data['status'] = $this->_get("status")*1;
        
        if($db->where(array('id'=>$id))->save($data)){
            $this->success2("设置成功", "__URL__/roles");
        }else{
            $this->error("设置失败");
        }
	}
  
}
?>