<?php
class MusicAction extends BaseAction{
  public function _initialize(){
        parent::_initialize();

    }
    public function index(){
    	$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
    	$pagesize = $pagesize<1? 1 : $pagesize;
    	$pagesize = $pagesize>100? 100 : $pagesize;
    	$page = $_GET['page']? $_GET['page']*1 : 1;
    	$condition='1=1';
    	$param=array();
    	$param['m_title']=$this->_get('m_title');
    	if($param['m_title']){
    		$condition .= " AND m_title like '%". $param['m_title'] ."%'";
    	}
    	$this->assign('para', $param);
    	$music=M('music');
    
    	$result=$music->where($condition)->limit($pagesize)->page($page)->select();
    	$count=$music->where($condition)->count();
    	$this->assign('list',$result);
    	$this->assign('pager', array(
    			'pageSize' => $pagesize,
    			'count' => $count,
    			'currentPage' => $count==0? 0 : $page,
    			'pageCount' => ceil($count/$pagesize),
    	));
    	return $this->display('list');
    }
    public function delete(){
    	$symptom=M('music');
    	$result=$symptom->delete($_GET['id']);
    	if($result!==false){
    		$this->success2('删除成功！','__URL__/index');
    	}else{
    		$this->error('删除失败！');
    	}
    }
    public function add(){
    	
    	return $this->display('add');
    }
    public function saveItem(){
    	$music=M('music');
    	$data['m_title']=$_REQUEST['m_title'];
    	$data['m_author']=$_REQUEST['m_author'];
    	$data['m_pic']=$_REQUEST['m_pic'];
    	$data['m_url']=$_REQUEST['m_url'];
    	$data['enable_status']=$_REQUEST['enable_status'];
    	$data['p_id']=$_REQUEST['p_id'];
		$result=$music->data($data)->add();
    	
    	//$this->show('test');
    	if($result!==false){
    	$this->success('新增成功！','__URL__/index');
    	}else{
    		$this->error('新增失败！');
    	}
    }
    /**
     * 状态修改
     */
    public function is_normal(){
    	$db = M('music');
    	$id = $this->_get("id");
    	$data['enable_status'] = $this->_get("is_normal")*1;
    
    	$where['id'] = $id;
    
    	if($db->where($where)->save($data)){
    		$this->success2("设置成功", "__URL__/index");
    	}else{
    		$this->error("设置失败");
    	}
    }
}
?>