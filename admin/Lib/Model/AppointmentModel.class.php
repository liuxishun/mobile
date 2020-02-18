<?php

class AppointmentModel extends Model {
    
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    /**
    * 判断预约点是否可用
    */
    public function isBookTimeEmpty($hw_ids, $t){
        $hw_ids = is_array($hw_ids)? $hw_ids : explode(',', trim($hw_ids, " \t\n\r\0\x0B,"));
        foreach($hw_ids as $hw_id){//'hwtype_id'=>$hwtype_id, 
            $a_row = $this->where(array('plan_date'=>$t, "status>-1 AND status<6", "CONCAT(',', hw_ids, ',') LIKE '%,". ($hw_id*1) .",%'"))->find();
            //echo date('Y-m-d H:i', $t)."\n";
            //echo $this->getLastSql()."\n";
            if($a_row){
                return false;
            }
        }
        return true;
    }

}