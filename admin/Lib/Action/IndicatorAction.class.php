<?php
class IndicatorAction extends BaseAction{
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
		$param['indicator_name']=$this->_get('indicator_name');
		if($param['indicator_name']){
			$condition .= " AND indicator_name like '%". $param['indicator_name'] ."%'";
		}
		$param['p_id']=$this->_get('p_id');
		if($param['p_id']){
			$condition .= " AND p_id = '". ($param['p_id']*1) ."'";
		}
		$param['mum_type']=$this->_get('mum_type');
		if($param['mum_type']){
			$condition .= " AND mum_type = '". $param['mum_type'] ."'";
		}

		$this->assign('para', $param);
		$baby_indicator=M('baby_indicator');
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
	public function delete(){
		$symptom=M('baby_indicator');
		$result=$symptom->delete($_GET['id']);
		if($result!==false){
			$this->success2('删除成功！','__URL__/index');
		}else{
			$this->error('删除失败！');
		}
	}
	public function add(){
		/*$period=D('Period');
		$db_prefix=C('DB_PREFIX');
		$where="id NOT IN (SELECT p_id FROM {$db_prefix}baby_indicator)";
		$period_states=$period->field(array('id','period_state'))->where($where)->select();
		$this->assign('period_states',$period_states);*/

		$id = $this->_get('id')*1;
		$arr = M('baby_indicator')->find($id);
		$this->assign('arr', $arr);

		return $this->display('add');
	}
	public function saveItem(){
		$baby_indicator=M('baby_indicator');
		if($this->isPost()){
			$id = $_POST['id']*1;
			$data=$this->_post();
			unset($data['id']);
			if($id==0){
				$result=$baby_indicator->add($data);
				if($result!==false){
					//$this->show('test');
					$this->success('新增成功','__URL__/index');
				}
			}else{
				$result=$baby_indicator->where(array('id'=>$id))->save($data);
				if($result!==false){
					//$this->show('test');
					$this->success('修改成功','__URL__/index');
				}
			}
			
		}else{
			$this->error($period->getError());
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
}
?>