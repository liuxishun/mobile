<?php
class ShipinAction extends BaseAction{
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
    	$param['name']=$this->_get('name');
    	if($param['name']){
    		$condition .= " AND name like '%". $param['name'] ."%'";
    	}
    	$this->assign('para', $param);
    	$music=M('shipin');
    
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
    	$symptom=M('shipin');
    	$result=$symptom->delete($_GET['id']);
    	if($result!==false){
    		$this->success2('删除成功！','__URL__/index');
    	}else{
    		$this->error('删除失败！');
    	}
    }
    public function add(){
    	if($this->isPost()){
    		$data['name']=$_POST['name'];
    		$data['pic']=$_POST['pic'];
    		$data['address']=$_POST['address'];
    		$data['p_id']=$_POST['p_id'];
    		$shipin=M('shipin');
    		$result=$shipin->data($data)->add();
    		if($result!==false){
    			$this->success('新增成功！','__URL__/index');
    		}else{
    			$this->error('新增失败！');
    		}
    	}else{
    		return $this->display('add');
    	}
    }
   public function edit(){
   	if($this->isPost()){
   		$data['name']=$_POST['name'];
   		$data['pic']=$_POST['pic'];
   		$data['address']=$_POST['address'];
   		$data['p_id']=$_POST['p_id'];
   		$shipin=M('shipin');
   		$result=$shipin->data($data)->where(array('id'=>$_POST['id']))->save();
   		if($result!==false){
   			$this->success('更新成功！','__URL__/index');
   		}else{
    			$this->error('更新失败！');
    		}
   	}else{
   		$id=$_GET['id'];
   		$shipin=M('shipin');
   		$list=$shipin->find($id);
   		$this->assign('list',$list);
   		$this->display('edit');
   	}
   }
 
}
?>