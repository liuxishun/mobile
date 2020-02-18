<?php
class FeedbackAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();
    }

    /**
    * 列表页
    */
    public function index(){
        
        $this->display('feedback');
    }

    /**
    * 获取数据
    */
    public function getdata(){
        $pagesize = $_REQUEST['rows']? $_REQUEST['rows']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_REQUEST['page']? $_REQUEST['page']*1 : 1;
        
        $condition = array();
        
        $db_pre = C('DB_PREFIX');
        $db = M('feedback');

        $condition = array();
        $para = array();
        $para['id'] = $this->_get('id');
        if($para['id']){
            $condition["{$db_pre}user.id"] = $para['id']*1;
        }
        $para['mobile'] = $this->_get('mobile');
        if($para['mobile']){
            $condition["{$db_pre}user.mobile"] = array('like', '%'. $para['mobile'] .'%');
        }

        $count = $db->where($condition)->count();

        $rows = $db->field("{$db_pre}feedback.*, {$db_pre}user.mobile, {$db_pre}user.truename")->join("{$db_pre}user ON {$db_pre}user.id={$db_pre}feedback.user_id")->order("{$db_pre}feedback.id DESC")->where($condition)->limit($pagesize)->page($page)->select();
        $rows = $rows? $rows : array();

        foreach($rows as $k=>$v){
            $rows[$k]['content'] = preg_replace("#<#is", '&lt;', $rows[$k]['content']);
            $rows[$k]['add_time'] = date('Y-m-d H:i:s', $rows[$k]['add_time']);
        }
       
        
        echo json_encode(array('total'=>$count, 'rows'=>$rows));
    }

	
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('feedback');
        $id = $this->_post("id")*1;

		if($db->where(array('id'=>$id))->delete()){
            $this->ajaxReturn ( null, '删除成功', 1);
        }else{
            $this->ajaxReturn ( null, '删除失败', 0);
        }
	}

    /**
	 * 删除
	 */
	public function delAll(){
		$db = M('feedback');

		$db->where("1=1")->delete();

        $this->ajaxReturn ( null, '删除成功', 1);
	}

  
}
?>