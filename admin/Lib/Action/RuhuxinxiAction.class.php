<?php
class RuhuxinxiAction extends BaseAction{
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
		$param['p_title']=$this->_get('p_title');
		if($param['p_title']){
			$condition .= " AND b.p_title like '%". $param['p_title'] ."%'";
		}
		$this->assign('para', $param);
		$foods=M('pinglun');
		$db_prefix=C('DB_PREFIX');
		$join=" as b INNER JOIN {$db_prefix}pinglun as p ON b.p_parent_id=p.id";
		$field='b.id,b.p_title,p.p_title as p_sub_title';
		$result=$foods->field($field)->join($join)->where($condition)->limit($pagesize)->page($page)->select();
		$count=$foods->field($field)->join($join)->where($condition)->count();
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
		$pinglun=M('pinglun');
		$pingluns=$pinglun->where(array('p_parent_id'=>0))->select();
		$this->assign('pingluns',$pingluns);
		return $this->display('add');
	}
	public function edit(){
		$id=$_GET['id'];
		$pinglun=M('pinglun');
		$db_prefix=C('DB_PREFIX');
		$join=" as b INNER JOIN {$db_prefix}pinglun as p ON b.p_parent_id=p.id";
		$field='b.id,b.p_title,p.id as p_id';
		$condition='b.id='.$id;
		$result=$pinglun->field($field)->join($join)->where($condition)->select();
		$this->assign('tpinglun',$result);
		$result=$pinglun->where(array('p_parent_id'=>0))->select();
		$this->assign('pingluns',$result);
		$this->display('edit');
	}
	public function Addtype(){
		$c_type_name=$_POST['c_type_name'];
		$pinglun=M('pinglun');
		$data['p_title']=$c_type_name;
		$data['p_parent_id']=0;
		$id=$pinglun->data($data)->add();
		if($id!==false){
			$data['id']=$id;
			echo json_encode($data);
		}else{
			echo '';
		}
	}
	public function saveItem(){
		$pinglun=M('pinglun');
		$id=$_POST['id'];
		$sub_titles=explode(',', $_POST['sub_title_s']);
		$pinglun->startTrans();
	
		for($i=0;$i<count($sub_titles);$i++){
			$result=$pinglun->data(array('p_title'=>$sub_titles[$i],'p_parent_id'=>$id))->add();
			if($result===false){
				$pinglun->rollback();
				$this->error('新增失败！');
			}
		}
		//$this->show('test2');
		$pinglun->commit();
		$this->success('新增成功！','__URL__/index');
	}
	public function save(){
		$p_id=$_POST['p_id'];
		$sub_id=$_POST['sub_id'];
		$sub_name=$_POST['sub_name'];
		$pinglun=M('pinglun');
		$result=$pinglun->data(array('p_title'=>$sub_name,'p_parent_id'=>$p_id))->where(array('id'=>$sub_id))->save();
		if($result!==false){
			$this->success('更新成功！','__URL__/index');
		}else{
			$this->success('更新失败！');
		}
	}
	public function delete(){
		$id=$_GET['id'];
		$pinglun=M('pinglun');
		$result=$pinglun->delete($id);
		if($result!==false){
			$this->success2('删除成功！','__URL__/index');
		}else{
			$this->error('删除失败！');
		}
	}
	}
?>