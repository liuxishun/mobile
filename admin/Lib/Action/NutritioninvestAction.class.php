<?php
class NutritioninvestAction extends BaseAction{

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
		$param['parent_type_name']=$this->_get('parent_type_name');
		if($param['parent_type_name']){
			$condition .= " AND parent_type_name like '%". $param['parent_type_name'] ."%'";
		}
		$this->assign('para', $param);
		$result=M('nutrition_parent')->where($condition)->limit($pagesize)->page($page)->select();
		$count=M('nutrition_parent')->where($condition)->count();
		$this->assign('list',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		return $this->display("invest");
	}
	public function delete(){
		$id=$_REQUEST['id'];
		$nutrition_parent=M('nutrition_parent');
		$ids=explode(',', $id);
		for($i=0;$i<count($ids);$i++){
			$nutrition_parent->delete($ids[$i]);
		}
		return $this->success2("删除成功", "__URL__/index");
	}
	public function add(){
		$this->display('add');
	}
	public function saveItem(){
		$choice_mode=$_REQUEST['choice_mode'];
		$parent_type_name=$_REQUEST['parent_name'];
		$new_child=$_REQUEST['new_child'];
		$enable_status=$_REQUEST['enable_status'];
		$data['parent_type_name']=$parent_type_name;
		$data['choice_mode']=$choice_mode;
		$data['enable_status']=$enable_status;
		$data['addtime']=time();
		$parent_id=M('nutrition_parent')->data($data)->add();
		if($new_child){
			$new_childs=explode(',',$new_child);
			for($i=0;$i<count($new_childs);$i++){
				M('nutrition_child')->data(array('child_type_name'=>$new_childs[$i],'parent_id'=>$parent_id))->add();
			}
		}
		
	}
	public function edit(){
		$id=$_GET['id'];
		$db_prefix=C('DB_PREFIX');
		$nutrition_parent=M('nutrition_parent')->where(array('id'=>$id))->select();
		$nutrition_child=M('nutrition_child')->where(array('parent_id'=>$id))->select();
		$this->assign('nutrition_parent',$nutrition_parent);
		$this->assign('nutrition_child',$nutrition_child);
		return $this->display('edit');
	}
	public function save(){
		$child_type_name=$_REQUEST['child_type_name'];
		$child_id=$_REQUEST['child_id'];
		$choice_mode=$_REQUEST['choice_mode'];
		$parent_type_name=$_REQUEST['parent_type_name'];
		$parent_id=$_REQUEST['parent_id'];
		$new_child=$_REQUEST['new_child'];
		$enable_status=$_REQUEST['enable_status'];
		$condition['id']=$parent_id;
		$data['parent_type_name']=$parent_type_name;
		$data['choice_mode']=$choice_mode;
		$data['enable_status']=$enable_status;
		$data['addtime']=time();
		M('nutrition_parent')->where($condition)->data($data)->save();
		$child_type_names=explode(',', $child_type_name);
		$child_ids=explode(',', $child_id);
		for($i=0;$i<count($child_ids);$i++){
			M('nutrition_child')->where(array('id'=>$child_ids[$i],'parent_id'=>$parent_id))
			->data(array('child_type_name'=>$child_type_names[$i]))->save();
		}
		if($new_child){
			$new_childs=explode(',',$new_child);
			for($i=0;$i<count($new_childs);$i++){
				M('nutrition_child')->data(array('child_type_name'=>$new_childs[$i],'parent_id'=>$parent_id))->add();
			}
		}
	}
	public function deleteChildItem(){
		$id=$_GET['id'];
		$pid=$_GET['pid'];
		M('nutrition_child')->delete($id);
		$db_prefix=C('DB_PREFIX');
		$nutrition_parent=M('nutrition_parent')->where(array('id'=>$pid))->select();
		$nutrition_child=M('nutrition_child')->where(array('parent_id'=>$pid))->select();
		$this->assign('nutrition_parent',$nutrition_parent);
		$this->assign('nutrition_child',$nutrition_child);
		return $this->display('edit');
	}
	/**
	 * 状态修改
	 */
	public function is_normal(){
		$db = M('nutrition_parent');
		$id = $_GET['id'];
		$data['enable_status'] = $_GET['is_normal'];
		
		$where['id'] = $id;
		
		if($db->where($where)->save($data)){
			$this->success2("设置成功", "__URL__/index");
		}else{
			$this->error("设置失败");
		}
	}
}