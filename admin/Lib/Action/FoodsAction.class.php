<?php
class FoodsAction extends BaseAction{
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
		$param['f_name']=$this->_get('f_name');
		if($param['f_name']){
			$condition .= " AND b.f_name like '%". $param['f_name'] ."%'";
		}
		$this->assign('para', $param);
		$foods=M('foods');
		$db_prefix=C('DB_PREFIX');
		$join=" as b LEFT JOIN {$db_prefix}food_catorgory as p ON b.c_id=p.id";
		$field='b.*,p.c_type_name';
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
		if($this->isPost()){
			$foods=M('foods');
			$data = $_POST['info'];

			if(!$data["f_name"]){
                $this->error("标题不能为空");
            }
            $data["f_name"] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $data["f_name"]);
            $data["unit"] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $data["unit"]);
			
			$data['timeeat']=$_POST['timeeat']? ','.implode(',',$_POST['timeeat']).',' : '';

			$id=$foods->data($data)->add();
			if($id!==false){
				$this->success('新增成功！','__URL__/index');
			}else{
				//$this->show('test');
				$this->error('新增失败！');
			}
		}else{
			$food_catorgory=M('food_catorgory');
			$food_catorgories=$food_catorgory->select();
			$this->assign('food_catorgories',$food_catorgories);

			return $this->display('add');
		}
	}
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('foods');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");
            if(!$data["f_name"]){
                $this->error("标题不能为空");
            }

            $data["f_name"] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $data["f_name"]);
            $data["unit"] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $data["unit"]);

            $data['timeeat']=$_POST['timeeat']? ','.implode(',',$_POST['timeeat']).',' : '';

			if($db->where(array('id'=>$id))->save($data)){
				$this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$food_catorgory=M('food_catorgory');

			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			//echo $db->getLastSql();exit;
			$this->assign("arr", $arr);

			$food_catorgories=$food_catorgory->select();
			$this->assign('food_catorgories',$food_catorgories);

			$this->display('add');
		}
	}

	public function Addtype(){
		$c_type_name=$_POST['c_type_name'];
		$food_catorgory=M('food_catorgory');
		$data['c_type_name']=$c_type_name;
		$id=$food_catorgory->data($data)->add();
		if($id!==false){
			$this->success('新增分类成功！','__URL__/add');
		}else{
			$this->error('新增失败！');
		}
	}
	public function delete(){
		$foods=M('foods');
		$result=$foods->delete($_GET['id']);
		if($result!==false){
			$this->success2('删除成功！','__URL__/index');
		}else{
			$this->error('删除失败！');
		}
	}
}
?>