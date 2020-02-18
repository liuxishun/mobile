<?php

class HouseworkerModel extends RelationModel {
    
    //非约束名称时使用
    //protected $tableName = 'tb'; 
    //protected $trueTableName = 'pre_tb';

    public function _initialize(){
        parent::_initialize();

    }

    /**
    * 封装返回数据
    */
    private function rt($data, $info, $status){
        return array('data'=>$data, 'info'=>$info, 'status'=>$status);
    }


    /**
    * 根据用户ID获取标签列表
    */
    public function getTagsByUid($uid,$typeid){
        $db_pre = C('DB_PREFIX');
        $field = "DISTINCT {$db_pre}hwtag.*";
        $join = "{$db_pre}hwtag ON {$db_pre}hwtag.id={$db_pre}hwtag_ref.tag_id";
        $condition["{$db_pre}hwtag.type_id"] = $typeid;
        if($uid.''!==''){
            $condition["{$db_pre}hwtag_ref.hw_id"] = $uid*1;
        }

        $rows = M('hwtag_ref')->join($join)->field($field)->where($condition)->select();

        return $rows;
    }

    /**
    * 获取标签字典
    */
    public function getTagLists($pdata){
        $db_pre = C('DB_PREFIX');
        if($pdata['hwtype_id']){
            $condition[] = "EXISTS (SELECT tag_id FROM {$db_pre}hwtag_ref r WHERE r.tag_id=t.id AND EXISTS (SELECT id FROM {$db_pre}houseworker hw WHERE r.hw_id=hw.id AND hw.hwtype_id='".($pdata['hwtype_id']*1)."') )"; //t.id IN ( r )
        }

        $rows = M('hwtag t')->where($condition)->order('t.name ASC')->select();
        //echo M('hwtag t')->getLastSql();exit;

        return $rows;
    }

    /**
    * 获取阿姨列表
    */
    public function getHouseworkerList($pdata){
        $db_pre = C('DB_PREFIX');
        $db = M('houseworker');
        
        $data['page'] = $pdata['page'];
        $data['pagesize'] = $pdata['pagesize'];

        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;
        $hwtype_id = $pdata['hwtype_id']*1;
        $age_min = $pdata['age_min']*1;
        $age_max = $pdata['age_max']*1;
        $tag_ids = $pdata['tag_ids'].'';
        
        $condition = array();
        
        
        $field = "{$db_pre}houseworker.*";

        $condition = "1=1";
        $condition .= " AND {$db_pre}houseworker.is_display='1'";
        if($hwtype_id>0){
            $condition .= " AND {$db_pre}houseworker.hwtype_id='{$hwtype_id}'";
        }
        if($age_min>0){
            $con_date = (date('Y')-$age_min) . '-01-01';
            $condition .= " AND {$db_pre}houseworker.birthday<='{$con_date}'";
        }
        if($age_max>0){
            $con_date = (date('Y')-$age_max) . '-01-01';
            $condition .= " AND {$db_pre}houseworker.birthday>='{$con_date}'";
        }
        if($tag_ids.''!==''){
            $con_ids = array();
            $tag_ids = explode(',', $tag_ids);
            foreach($tag_ids as $tag_id){
                if($tag_id>0) $con_ids[] = $tag_id*1;
            }
            if($con_ids) $condition .= " AND {$db_pre}houseworker.id IN(SELECT DISTINCT hw_id FROM {$db_pre}hwtag_ref WHERE tag_id IN(". (implode(',', $con_ids)) ."))";
        }

        $count = $db->field($field)->join($join)->where($condition)->count();

        $rows = $db->field($field)->join($join)->order("{$db_pre}houseworker.sort ASC, {$db_pre}houseworker.id DESC")->where($condition)->limit($pagesize)->page($page)->select();
        //echo $db->getLastSql();exit;
        $rows = $rows? $rows : "";      

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $rows;

        $lists = $rows;

        return array('page'=>$data['page'], 'count'=>$data['count'], 'pagesize'=>$data['pagesize'], 'page_count'=>$data['page_count'], 'list'=>$lists);
    }

    /**
    * 获取阿姨评价
    */
    public function getCmts($pdata){
        $db_pre = C('DB_PREFIX');
        $db = M('pingjia');

        $data['page'] = $pdata['page'];
        $data['pagesize'] = $pdata['pagesize'];

        $pagesize = $data['pagesize']? $data['pagesize']*1 : 20;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $data['page']? $data['page']*1 : 1;

        $condition = '1=1';
        $para = array();
        $para['h_id'] = $pdata['h_id']*1;
        if($para['h_id']){
            $condition .= " AND h_id='". $para['h_id'] ."'";
        }

        $count = $db->where($condition)->count();
        $list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();

        foreach($list as $k=>$v){
            $list[$k]['addtime'] = reset(explode(' ', $v['addtime']));
            $pics = M('pingjia_pic')->where(array('p_id'=>$v['id']))->select();
            $list[$k]['pics'] = $pics? $pics : '';
            $list[$k]['dianping']=preg_replace ( "/(\<[^\<]*\>|\r|\n|\s|\[.+?\])/is", '', $v['dianping']);
        }

        $data['page'] = $page;
        $data['count'] = $count;
        $data['page_count'] = ceil($count/$pagesize);
        $data['list'] = $list ;

        return $data;
    }
    
}