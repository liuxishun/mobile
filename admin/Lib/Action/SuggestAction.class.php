<?php
class SuggestAction extends BaseAction{
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
    	$param['s_nutrients']=$this->_get('s_nutrients');
    	if($param['s_nutrients']){
    		$condition .= " AND s_nutrients like '%". $param['s_nutrients'] ."%'";
    	}
    	$this->assign('para', $param);
    	$suggest=M('suggest');
    	
    	$result=$suggest->where($condition)->limit($pagesize)->page($page)->select();
    	$count=$suggest->where($condition)->count();
    	$this->assign('list',$result);
    	$this->assign('pager', array(
    			'pageSize' => $pagesize,
    			'count' => $count,
    			'currentPage' => $count==0? 0 : $page,
    			'pageCount' => ceil($count/$pagesize),
    	));
    	return $this->display('list');
    }
    public function add(){
    	
    	return $this->display('add');
    }
    public function delete(){
    	$symptom=M('suggest');
    	$result=$symptom->delete($_GET['id']);
    	if($result!==false){
    		$this->success2('删除成功！','__URL__/index');
    	}else{
    		$this->error('删除失败！');
    	}
    }
    public function saveItem(){
    	$suggest=M('suggest');
    	$data['s_desc']=$_POST['s_desc'];
    	$data['s_nutrients']=$_POST['s_nutrients'];
    	$data['enable_status']=$_POST['enable_status'];
    	$data['p_id']=$_POST['p_id'];
    	$result=$suggest->data($data)->add();
    	//$this->show('test');
    	if($result!==false){
    		//$this->show('test');
    	$this->success('新增成功！','__URL__/index');
    	}else{
    		$this->show('test');
    		//$this->error('新增失败！');
    	}
    }
    /**
     * 状态修改
     */
    public function is_normal(){
    	$db = M('suggest');
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