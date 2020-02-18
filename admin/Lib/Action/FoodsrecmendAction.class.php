<?php
class FoodsrecmendAction extends BaseAction{
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
    		$condition .= " AND b.m_title like '%". $param['m_title'] ."%'";
    	}
    	$this->assign('para', $param);
    	$music=M('foods_recmend');
    	$db_prefix=C('DB_PREFIX');
    	$join=" as b LEFT JOIN {$db_prefix}foods as f ON b.f_id=f.id";
    	$field='b.*,f.f_name';
    	$result=$music->field($field)->join($join)->where($condition)->limit($pagesize)->page($page)->select();
    	$count=$music->field($field)->join($join)->where($condition)->count();
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
		$period=D('Period');
    	$foods=M('foods');
    	$this->assign('foods',$foods->select());
		return $this->display('add');
	}
	public function edit(){
		$period=D('Period');
		$period_states=$period->field(array('id','period_state'))->select();
		$foods=M('foods');
		$this->assign('foods',$foods->select());
		$this->assign('period_states',$period_states);
		$this->assign('foods_recmend',M('foods_recmend')->find($_GET['id']));
		return $this->display('edit');
	}
	public function saveItem(){
		$foods=M('foods_recmend');
		$p_id=$_POST['p_id'];
		$f_name=$_POST['f_id'];
		$f_desc=$_POST['f_desc'];
		$f_names=explode(',', $f_name);
		$foods->startTrans();
		for($i=0;$i<count($f_names);$i++){
			$id=$foods->data(array('f_id'=>$f_names[$i],'p_id'=>$p_id,'f_desc'=>$f_desc))->add();
			if($id===false){
				$foods->rollback();
				$this->error('新增失败！');
				return;
			}
		}
			$foods->commit();
			$this->success('新增成功！','__URL__/index');
		
	}
}
?>