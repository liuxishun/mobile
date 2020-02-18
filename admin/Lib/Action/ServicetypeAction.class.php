<?php
class ServicetypeAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M('service_type');
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
			$this->display();
		}
	}
	

	/**
	 * 列表页
	 */
	public function lists(){        
		$db = M('service_type');

        $condition = '1=1';

		$list = $db->where($condition)->order('sort ASC, id ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);

		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('service_type');
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
			$this->display('add');
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('service_type');
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

    /**
    * 状态修改
    */
    public function is_display(){
		$db = M('service_type');
		$id = $this->_get("id");
        $data['is_display'] = $this->_get("is_display")*1;
        
        if($db->where(array('id'=>$id))->save($data)){
            $this->success2("设置成功", "__URL__/lists");
        }else{
            $this->error("设置失败");
        }
	}
  
}
?>