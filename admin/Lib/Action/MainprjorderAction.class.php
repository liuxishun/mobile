<?php

class MainprjorderAction extends BaseAction{
	
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
        
		$db = M('main_prj_order');

        $condition = '1=1';
        $para = array();
        $para['u_id'] = $this->_get('u_id');
        if($para['u_id']){
            $condition .= " AND o.u_id = '". $para['u_id'] ."'";
        }
        $para['mp_id'] = $this->_get('mp_id');
        if($para['mp_id']){
            $condition .= " AND o.mp_id = '". $para['mp_id'] ."'";
        }
        $para['status'] = $this->_get('status');
        if($para['status']){
            $condition .= " AND o.status = '". $para['status'] ."'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

		$count = $db->alias('o')->where($condition)->count();
		$list = $db->alias('o')->field("o.*")->join($join)->where($condition)->order('o.id DESC')->limit($pagesize)->page($page)->select();
		 
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
		$db = M('main_prj_order');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");


			if($db->where(array('id'=>$id))->save($data)){
				$this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$this->assign("arr", $arr);

            $this->assign('tlist', M('service_type')->select());
			$this->display('add');
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('main_prj_order');
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);

			$rel_num = $db->where(array('id'=>$data['id'], "status!=-1"))->count();
			if($rel_num>0){
				$this->error("有订单未取消，不能删除");
			}

			if($db->where($data)->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');

			$rel_num = $db->where(array('id'=>$id, "status!=-1"))->count();
			if($rel_num>0){
				$this->error("订单未取消，不能删除");
			}

			if($db->where(array('id'=>$id))->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败");
			}
		}
	}


  
}
?>