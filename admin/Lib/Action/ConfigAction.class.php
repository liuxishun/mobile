<?php

class ConfigAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
	
	/**
	 * 编辑
	 */
	public function edit($id='config', $tpl=null){
        $db = M("config");
		if($this->isPost()){

            foreach($_POST['info'] as $key=>$item){
                $arr[$key] = $item;
            }
            $data['config'] = json_encode($arr);

            $row = $db->where(array('id'=>$id))->find();
            if($row){
                $db->where(array('id'=>$id))->save($data);
                $this->success("保存成功，生效需清除缓存", "__APP__/index/cache");
            }else{
                $data['id'] = $id;
                $db->add($data);
                $this->success("添加成功，生效需清除缓存", "__APP__/index/cache");
            }
		}else{
			$arr = $db->where(array('id'=>$id))->find();

			$this->assign("arr", $arr);
            $config = @json_decode($arr['config'], true);
            $config = is_array($config)? $config : array();
            $this->assign('config', $config);
			$this->display($tpl);
		}
	}

    public function carpara(){
        $this->edit('carpara', 'carpara');
    }
  
}
?>