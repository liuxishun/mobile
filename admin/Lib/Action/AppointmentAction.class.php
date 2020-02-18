<?php

class AppointmentAction extends BaseAction{
	
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
        
		$db = M('appointment');

        $condition = '1=1';
        $para = array();
        $para['title'] = $this->_get('title');
        if($para['title']){
            $condition .= " AND (username LIKE '%". $para['title'] ."%' OR tel LIKE '%". $para['title'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

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
	 * 编辑
	 */
	public function edit(){
		$db = M('appointment');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");


			if($db->where(array('id'=>$id))->save($data)!==false){
                
                $this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$this->assign("arr", $arr);

			$this->display('add');
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('appointment');
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);
			if($db->where($data)->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
			if($db->where(array('id'=>$id))->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败");
			}
		}
	}
        
        public function order(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '月嫂服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
          $condition .= " AND status != '99'";  
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('order');
        }
        
        public function orderw(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '月嫂服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '0'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('order');
        }
        public function orderc(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '月嫂服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '1'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('order');
        }
        public function orderj(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '月嫂服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '2'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('order');
        }
        public function orderd(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '月嫂服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '99'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('order');
        }
        
        
        
         
        public function infant_care(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '育婴早教服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
        if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
          $condition .= " AND status != '99'";  
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('infant_care');
        }
        
        public function infant_carew(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '育婴早教服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
         if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '0'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('infant_care');
        }
        
         public function infant_carec(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '育婴早教服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
         if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '1'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('infant_care');
        }
        
         public function infant_carej(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '育婴早教服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
         if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '2'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('infant_care');
        }
        
         public function infant_cared(){
            $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
            $pagesize = $pagesize<1? 1 : $pagesize;
            $pagesize = $pagesize>100? 100 : $pagesize;
            $page = $_GET['page']? $_GET['page']*1 : 1;
            $db = M('order');

        $condition = '1=1';
        $para = array();
        $para['name'] = $this->_get('title');
        $condition .= " AND `type`= '育婴早教服务' " ;
        if($para['name']){
            $condition .= " AND (name LIKE '%". $para['name'] ."%' OR mobile LIKE '%". $para['name'] ."%')";
        }
        $para['status'] = $this->_get('status');
         if($para['status'].''!==''){
            $condition .= " AND status = '". ($para['status']*1) ."'";
        }else{
            $condition .= " AND status = '99'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

        
	$count = $db->where($condition)->count();
	$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
	$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
            $this->display('infant_care');
        }
        
        
        
        
/**
	 * 删除
	 */
	public function dels(){
		$db = M('order');
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);
			if($db->where($data)->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
			if($db->where(array('id'=>$id))->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败");
			}
		}
	}

        public function chuli(){
            $remark= $_REQUEST['remark'] ;
            $id    = $_POST['id'];
            $where = array('id'=>$id);
            $info  = M('order')->where($where)->field('remark')->find();
            $time  = date("Y-m-d H:i:s",time());
            $infos = $info['remark'].'&#13'."您于 ".$time."处理了此预约，备注信息为: ".$remark;  
            $data  = array('status'=>'1','remark'=>trim($infos));
            $re    = M('order')->where($where)->data($data)->save();
            if($re){
                echo 1;
            }else{
                echo 0;
            }
            
        }
        
        public function jujue(){
            $remark = $_REQUEST['remark'] ;
            $id    = $_REQUEST['id'];
            $where = array('id'=>$id);
            $info  = M('order')->where($where)->field('remark')->find();
            $time  = date("Y-m-d H:i:s",time());
            $infos = $info['remark'].'&#13'."您于 ".$time."拒绝了此预约，备注信息为: ".$remark;  
            $data  = array('status'=>'2','remark'=>trim($infos));
            $re    = M('order')->where($where)->data($data)->save();
            if($re){
                echo 1;
            }else{
                echo 0;
            }
        }
        
        public function shanchu(){
            $id    = $_REQUEST['id'];
            $where = array('id'=>$id);
            $info  = M('order')->where($where)->field('remark')->find();
            $time  = date("Y-m-d H:i:s",time());
            $infos = $info['remark'].'&#13'."您于 ".$time."删除了此预约，备注信息为: ".$remark;  
            $data  = array('status'=>'99','remark'=>$infos);
            $re    = M('order')->where($where)->data($data)->save();
           if($re){
                echo 1;
            }else{
                echo 0;
            }
        }
         
        public function listinfo(){
            $id = $_REQUEST['id'];
            $where = array('id'=>$id);
            $re = M('order')->where($where)->field('remark')->find();
            if($re){
                echo $re['remark'];
            }else{
                echo '';
            }
        }
  
}
?>