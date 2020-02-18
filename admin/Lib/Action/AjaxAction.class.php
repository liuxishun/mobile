<?php
class AjaxAction extends BaseAction {
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
    * 获取地区代码
    */
    public function getAreacode(){
        $db = M('area');
        $id = $_REQUEST['id']*1;
        $rows = $db->field("id, areaname as n")->where(array('is_display'=>1, 'parent_id'=>$id))->order('sortrank ASC')->select();

        $this->ajaxRt($rows, '', 1);
    }

    /**
    * 获取品牌下车型
    */
    public function getHwlevels(){
        $db = M('hwlevel');
        $id = $_REQUEST['id']*1;
        if($id){
            $rows = $db->field("id, name as n")->where(array('is_display'=>1, "hwtype_id"=>$id))->limit(100)->order('sort ASC, id DESC')->select();
            //echo $db->getLastSql();exit;
        }

        $this->ajaxRt($rows, '', 1);
    }


}