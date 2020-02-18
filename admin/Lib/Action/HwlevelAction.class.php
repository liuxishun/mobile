<?php
class HwlevelAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M('hwlevel');
			$data=$this->_post("info");

            $paras = array();
            $p_paras = $_POST['paras'];
            foreach($p_paras as $para){
                $paras[$para['name']] = $para['val'];
            }
            $data['paras'] = json_encode($paras);

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
	 * 技能列表
	 */
    public function attrparas(){
		$tid = $_GET['tid']*1;
        $id = $_GET['id']*1;
        
        $row_leval = M('hwlevel')->find($id);
        $paras = json_decode($row_leval['paras'], true);
        $this->assign('paras', $paras);

        $row_attr = M('hwtype')->find($tid);
        $attrs = json_decode($row_attr['attrs'], true);
        $this->assign('attrs', $attrs);

		$this->display();
	}
	

	/**
	 * 列表页
	 */
	public function lists(){        
		$db = M('hwlevel');

        $condition = '1=1';

        $para = array();
        $para['hwtype_id'] = $this->_get('hwtype_id');
        if($para['hwtype_id']){
            $condition .= " AND hwtype_id = '". ($para['hwtype_id']*1) ."'";
        }
        $this->assign('para', $para);

		$list = $db->where($condition)->order('hwtype_id ASC, sort ASC, id asc')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);

		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('hwlevel');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");

            $paras = array();
            $p_paras = $_POST['paras'];
            foreach($p_paras as $para){
                $paras[$para['name']] = $para['val'];
            }
            $data['paras'] = json_encode($paras);

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
		$db = M('hwlevel');
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);

            $ref_num = M('hwlevel')->where(array('hwtype_id'=>$data['id']))->count();
            if($ref_num>0){
                $this->error("{$ref_num}条数据被引用无法删除");
            }

			if($db->where($data)->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
            $ref_num = M('hwlevel')->where(array('hwtype_id'=>$id))->count();
            if($ref_num>0){
                $this->error("数据被引用无法删除");
            }

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
		$db = M('hwlevel');
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