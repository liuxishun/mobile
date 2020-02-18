<?php

class AreaModel extends Model {
    
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    //获取某个分类下的所有分类
    public function getTree($pid=0, $filter_display = false, $allsub=true, $pfield=""){
        $condition = "parent_id='$pid'";
        $condition .= $filter_display? " AND is_display='1'" : "";

        $field = $pfield? $pfield : "id, areaname, parent_id";

		$list = $this->field($field)->where($condition)->order('sortrank ASC')->select();
        foreach($list as $k=>$v){
            if($allsub) $slist = $this->getTree($v['id'], $filter_display);

            if($slist){
                $list[$k]['slist'] = $slist;
            }
        }
        return $list;
    }

    //查找某个分类下的父ID、路径
    public function getPidArr($id){
        $arr = array();

        $row = $this->where(array('id'=>$id))->find();
        if(!$row)return array(0);
        while($row){
            $id = $row['parent_id'];
            $arr[] = $id;
            
            $row = $this->where(array('id'=>$id))->find();
        }
        krsort($arr);

        return $arr;
    }

    //更新某个id的is_child
    public function updateIsChild($id){
        $c = $this->where(array('parent_id'=>$id))->count();
        $this->where(array('id'=>$id))->save(array('is_child'=>$c?0:1));
    }

    //更新某个分类下子分类的pid_arr
    public function updateChildPidArr($id){
       	$list = $this->where(array('pid'=>$id))->select();
        foreach($list as $k=>$v){
            $pid_arr = $this->getPidArr($v['id']);
            $data = array();
            $data['pid_arr'] = implode(',', $pid_arr);
            $data['level'] = count($pid_arr);
            $this->where(array('id'=>$v['id']))->save($data);

            $slist = $this->where(array('pid'=>$v['id']))->count();
            if($slist){
                $this->updateChildPidArr($v['id']);
            }
        }
    }

    /**
    * 根据多个id，获取地址
    */
    public function getAreanames($ids, $splitor=' '){
        $arows = $this->select($ids);
        $arr = array();
        foreach($arows as $arow){
            $arr[] = $arow['areaname'];
        }
        return implode($splitor, $arr) . ($splitor==' '? ' ' : '');
    }

}