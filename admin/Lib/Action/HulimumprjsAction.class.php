<?php
class HulimumprjsAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M('huli_mum_prjs');
			$data=$this->_post("info");
            if(!$data["name"]){
                $this->error("名称不能为空");
            }
			if($db->add($data)){
                $this->success("添加成功", "__URL__/lists");
            }else{
                $this->error("添加失败，请重新添加");
            }
		}else{
			$this->display('edit');
		}
	}
	

	/**
	 * 列表页
	 */
	public function lists(){        
		$db = M('huli_mum_prjs');

        $condition = '1=1';

		$list = $db->where($condition)->order('type ASC, name ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);

		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('huli_mum_prjs');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");
			if(!$data["name"]){
                $this->error("名称不能为空");
            }
            if($db->where(array('id'=>$id))->save($data)){
				$this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$this->assign("arr", $arr);
			$this->display();
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('huli_mum_prjs');
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);
			if($db->where($data)->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
			if($db->where(array('id'=>$id))->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败");
			}
		}
	}
  
}
?>