<?php

class SiteinfoModel extends Model {
    
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    /**
    * 获取指定名称的文章
    */
    public function getInfoByCusid($cusid){
        $row = $this->where(array('cusid'=>$cusid, 'is_display'=>1))->find();
        return $row;
    }

    /**
    * 通过位置代码获取文章列表[mode 0文章， 1链接，all全部]
    */
    public function getInfosByPosition($position, $mode='all'){
        $rows = S($position);
        if(!$rows){
            $db_pre = C('DB_PREFIX');
            $condition = array();
            $condition["{$db_pre}siteinfo_type.position"] = $position;
            $condition["{$db_pre}siteinfo.is_display"] = 1;
            if($mode!='all'){
                $condition["{$db_pre}siteinfo.mode"] = $mode;
            }

            $rows = $this->field("{$db_pre}siteinfo.*")->join("{$db_pre}siteinfo_type ON {$db_pre}siteinfo_type.id={$db_pre}siteinfo.typeid")->where($condition)->order("{$db_pre}siteinfo.is_top DESC, {$db_pre}siteinfo.sort ASC")->select();
            S($position, $rows, 3600*24);
        }
        return $rows;
    }

}