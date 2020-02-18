<?php

class MemberAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
	

	/**
	 * 列表页
	 */
	public function lists(){
        $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        
		$db_pre = C('DB_PREFIX');
        $db = M('member');
        //$join = "{$db_pre}admin ON {$db_pre}admin.id=seller_id";
        $field = "{$db_pre}member.*"; //, {$db_pre}admin.username AS seller_name

        $condition = "1=1";

        $para = array();

        $para['truename'] = $this->_get('truename');
        if($para['truename']){
            $condition .= " AND truename like '%". $para['truename'] ."%'";
        }

        $para['mobile'] = $this->_get('mobile');
        if($para['mobile']){
            $condition .= " AND mobile like '%". $para['mobile'] ."%'";
        }
        
        $para['area_id'] = $this->_get('area_id');
        if($para['area_id'].''!==''){
            $condition .= " AND (CONCAT(',', area_ids, ',')  LIKE '%,". ($para['area_id']) .",%') ";
        }

        $para['mum_type'] = $this->_get('mum_type');
        if($para['mum_type']){
            $condition .= " AND mum_type = '". $para['mum_type'] ."'";
        }

        $this->assign('para', $para);

        $count = $db->where($condition)->count();
		
		$list = $db->field($field)->join($join)->where($condition)->order("{$db_pre}member.id DESC")->limit($pagesize)->page($page)->select();

        foreach($list as $k=>$v){

        }
		 
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
	 * 编辑
	 */
	public function edit(){
		$db_pre = C('DB_PREFIX');
        $db = M('member');
        //$join = "{$db_pre}admin ON {$db_pre}admin.id=seller_id";
        $field = "{$db_pre}member.*"; //, {$db_pre}admin.username AS seller_name

        $where = array();

		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");

            if($data['password']){
                import('ORG.Util.String');
                $salt = String::randString(8);
                $data['salt'] = $salt;
                $data["password"] = $this->my_md5($data["password"], $salt);
            }else{
                unset($data['password']);
            }
            if($data['mobile'] && $db->where("id!='{$id}' AND mobile='{$data['mobile']}'")->count()>0){
                $this->error("手机号已存在");
            }

			$where["{$db_pre}member.id"] = $id;
            if($db->where($where)->save($data)){
				$this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
            $where["{$db_pre}member.id"] = $id;
			$arr=$db->field($field)->join($join)->where($where)->find();

			$this->assign("arr", $arr);

			$this->display();
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('member');
		$where = array();
        //如果是业务员仅可查看所属会员

        if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$where['id']=array('in', $str);
			
            if($db->where($where)->delete()){
                M('auth')->where(array('loginid'=>array('in', $str)))->delete();

                //#关联删除
                M('account_log')->where(array('userid'=>array('in', $str)))->save(array('is_delete'=>1));

                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
			$where['id']=$id;
            if($db->where($where)->delete()){
                M('auth')->where(array('loginid'=>$id))->delete();

                //#关联删除
                M('account_log')->where(array('userid'=>$id))->save(array('is_delete'=>1));

                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败");
			}
		}
	}


    /**
    * 状态修改
    */
    public function is_normal(){
		$db = M('member');
		$id = $this->_get("id");
        $data['status'] = $this->_get("is_normal")*1;

        $where['id'] = $id;
        
        if($db->where($where)->save($data)){
            $this->success2("设置成功", "__URL__/lists");
        }else{
            $this->error("设置失败");
        }
	}
  
}
?>