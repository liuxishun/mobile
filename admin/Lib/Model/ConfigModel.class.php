<?php

class ConfigModel extends Model {
    
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    //获取系统配置
    public function getConfig($id='config'){
        $t = 3600*24;

        $json_obj = json_decode(S('cfg_' . $id), true);

        if($json_obj){
            return $json_obj;
        }else{
            $row_cfg = M('config')->where(array('id'=>$id))->find();

            if($row_cfg)S('cfg_' . $id, $row_cfg['config'], $t);

            return json_decode($row_cfg['config'], true);
        }

    }

}