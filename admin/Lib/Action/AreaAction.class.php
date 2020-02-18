<?php
class AreaAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }

    /**
    * 列表页
    */
    public function index(){
        $this->display('area');
    }

    /**
    * 获取数据
    */
    public function getdata(){
        $id = $this->_param('id')*1;
        $db_pre = C('DB_PREFIX');
        $db = M('area');
        $rows = $db->field("{$db_pre}area.*")->where(array('parent_id'=>$id))->order("`id` ASC")->select();
        //echo $db->getLastSql();exit;
        foreach($rows as $k=>$v){
            $rows[$k]['parentId'] = $id;
            $rows[$k]['state'] = $v['is_child']? 'open' : 'closed';

            if($v['seller_id']){
                $seller = M('member')->where(array('id'=>$v['seller_id']))->find();
                $rows[$k]['seller'] = $seller['truename'];
            }
        }
        $rows = $rows? $rows : array();
        
        echo json_encode($rows);
    }
    
    /**
	 * 添加
	 */
    public function add(){
        $db = D('Area');
        $data = $this->_post();
        $data['parent_id'] = $data['parent_id']===''? 0 : $data['parent_id']*1;
        $data['is_display'] = $data['is_display']==1? 1 : 0;
        if(!$data["areaname"]){
            $this->ajaxReturn ( null, '名称不能为空', 0);
        }
        $pid_arr = $db->getPidArr($data['parent_id']);
        if($data['parent_id']){
            $pid_arr[] = $data['parent_id'];
            $db->where(array('id'=>$data['parent_id']))->save(array('is_child'=>0));
        }
        
        $data['is_child'] = 1;
        $data['parent_ids'] = implode(',', $pid_arr);
        
        if($db->add($data)){
            $this->ajaxReturn ( null, '添加成功', 1);
        }else{
            $this->ajaxReturn ( null, '添加失败，请重新添加'.$db->getLastSql(), 0);
        }
	}
	

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = D('Area');
		$id = $this->_get("id");
        $data = $this->_post();
        $data['parent_id'] = $data['parent_id']===''? 0 : $data['parent_id']*1;
        $data['is_display'] = $data['is_display']==1? 1 : 0;
        if(!$data["areaname"]){
            $this->ajaxReturn ( null, '名称不能为空', 0);
        }
        unset($data['parent_id']);

        if($db->where(array('id'=>$id))->save($data)){
            $this->ajaxReturn ( null, '编辑成功', 1);
        }else{
            $this->ajaxReturn ( null, '编辑失败，可能没有改动，不需保存', 0);
        }
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = D('Area');
        $id = $this->_post("id")*1;
        $row = $db->where(array('id'=>$id))->find();

        if(!$row['is_child']){
            $this->ajaxReturn ( null, '删除失败，只能先从最小分类逐级删除', 0);
        }

        $trow = M('member')->where("CONCAT(',', area_ids, ',') LIKE '%,$id,%'")->find();
        if($trow){
            $this->ajaxReturn ( null, '数据已经被引用，不能删除', 0);
        }


		if($db->where("id='$id'")->delete()){
            $db->updateIsChild($row['parent_id']);

            $this->ajaxReturn ( null, '删除成功', 1);
        }else{
            $this->ajaxReturn ( null, '删除失败', 0);
        }
	}
  
}
?>