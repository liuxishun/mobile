<?php
class NurselogAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
	
	}
	public function index(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition='1=1';
		$nurselog=M('huli_log');
		$field='id,tiwen,xueya,tizhong,bianmi,qingxu';
		$result=$nurselog->field($field)->where($condition)->limit($pagesize)->page($page)->select();
		$count=$nurselog->field($field)->where($condition)->count();
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
		$id=$_GET['id'];
		$nurselog=M('huli_log');
		$result=$nurselog->delete($id);
		if($result!==false){
			$this->success2('删除成功！','__URL__/index');
		}else{
			$this->error('删除失败！');
		}
	}
	public function edit(){
		$id=$_GET['id'];
		$nurselog=M('huli_log');
		$db_prefix=C('DB_PREFIX');
		$join=" AS n LEFT JOIN {$db_prefix}period AS p ON n.p_id=p.id";
		$field='n.*,p.period_state';
		$where='n.id='.$id;
		$result=$nurselog->join($join)->field($field)->where($where)->select();
		$this->assign('nurselog',$result);
		$this->display('details');
	}
}
?>