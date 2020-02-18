<?php
class SymptomAction extends BaseAction{
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
    	$param['s_name']=$this->_get('s_name');
    	if($param['s_name']){
    		$condition .= " AND s_name like '%". $param['s_name'] ."%'";
    	}
    	$this->assign('para', $param);
    	$baby_indicator=M('symptom');
    	
    	$condition.=" AND parent_id=0";
    	$result=$baby_indicator->where($condition)->limit($pagesize)->page($page)->select();
    	$count=$baby_indicator->where($condition)->count();
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
    	$symptom=M('symptom');
    	$result=$symptom->delete($_GET['id']);
    	if($result!==false){
    		$this->success2('删除成功！','__URL__/index');
    	}else{
    		$this->error('删除失败！');
    	}
    }
    public function saveItem(){
    	$symptom=M('symptom');
    	$s_name=$_POST['s_name'];
    	$p_id=$_POST['p_id'];
    	$sc_name=$_POST['sc_names'];
    	$data['parent_id']=0;
    	$data['s_name']=$s_name;
    	$data['p_id']=$p_id;
    	$symptom->startTrans();
    	$parent_id=$symptom->data($data)->add();
    	if($parent_id){
    		if($sc_name){
    			$sc_names=explode(',', $sc_name);
    			for($i=0;$i<count($sc_names);$i++){
    						$data['parent_id']=$parent_id;
    						$data['s_name']=$sc_names[$i];
    						$data['p_id']=$p_id;
    						$result=$symptom->data($data)->add();
    						if($result===false){
    							$symptom->rollback();
    							$this->error($symptom->getError());
    							return;
    						}
    			}
    		}
    	}else{
    		$symptom->rollback();
    		$this->error($symptom->getError());
    		return;
    	}
    	$symptom->commit();
    	//$this->show('test');
    	$this->success('新增成功！','__URL__/index');
    }
}
?>