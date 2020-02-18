<?php
class PeriodAction extends BaseAction{

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
		$param['period_stage_name']=$this->_get('period_stage_name');
		if($param['period_stage_name']){
			$condition .= " AND period_stage_name like '%". $param['period_stage_name'] ."%'";
		}
		$this->assign('para', $param);
		$peroid=D('Period');
		$result=$peroid->where($condition)->limit($pagesize)->page($page)->select();
		$count=$peroid->where($condition)->count();
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
	public function saveItem(){
		$peroid=D('Period');
		$data['period_stage_name']=$_POST['period_stage_name'];
		$data['period_duration']=$_POST['period_duration'];
		$data['enable_status']=$_POST['enable_status'];
		$data['period_state']=$_POST['period_state'];
		$peroid->add($data);
		if($peroid!==false){
			$this->success('添加成功!','__URL__/index');
		}else{
			$this->error('添加失败!');
		}
	}
	/**
	 * 状态修改
	 */
	public function is_normal(){
		$db = D('Period');
		$id = $this->_get("id");
		$data['enable_status'] = $this->_get("is_normal")*1;
	
		$where['id'] = $id;
	
		if($db->where($where)->save($data)){
			$this->success2("设置成功", "__URL__/index");
		}else{
			$this->error("设置失败");
		}
	}
	public function delete(){
		$peroid=D('Period');
		$id=$this->_get('id');
		$result=$peroid->delete($id);
		if($result!==false){
			$this->success2('删除成功!','__URL__/index');
		}else{
			$this->error('删除失败!');
		}
	}
	
}
?>