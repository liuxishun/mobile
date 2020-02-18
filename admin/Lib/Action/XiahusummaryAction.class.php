<?php
class XiahusummaryAction extends BaseAction{

	public function _initialize(){
		parent::_initialize();
	
	}
	public function index(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition="1=1 AND n.jieruxiahu='0'";
		$nurselog=M('huli_xiaojie');
		$db_prefix=C('DB_PREFIX');
		$field='n.yueling,n.touwei,n.shenchang,n.tizhong,n.huangdan,p.id,p.title';
		$join=" AS n LEFT JOIN {$db_prefix}houseworker AS p ON n.h_id=p.id";
		$result=$nurselog->join($join)->field($field)->where($condition)->limit($pagesize)->page($page)->select();
		$count=$nurselog->join($join)->field($field)->where($condition)->count();
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
		$nurselog=M('huli_xiaojie');
		$result=$nurselog->where(array('h_id'=>$id))->delete();
		if($result!==false){
			$this->success2('删除成功！','__URL__/index');
		}else{
			$this->error('删除失败！');
		}
	}
	public function edit(){
		$id=$_GET['id'];
		$nurselog=M('huli_xiaojie');
		$result=$nurselog->where(array('h_id'=>$id))->select();
		$this->assign('nurselog',$result);
		$this->display('details');
	}
	
}
?>