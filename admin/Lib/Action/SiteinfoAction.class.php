<?php

class SiteinfoAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

        $this->artmode=array('0'=>'文章', '1'=>'链接');
    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M('siteinfo');
			$data = $this->_post("info");
            if(!$data["title"]){
                $this->error("标题不能为空");
            }
			
            $data["addtime"] = time();
            if($db->add($data)){
                $this->success("添加成功", "__URL__/lists");
            }else{
                $this->error("添加失败，请重新添加");
            }
		}else{
			$this->assign('tlist', M('siteinfo_type')->select());
			$period=D('Period');
			$db_prefix=C('DB_PREFIX');
			$period_states=$period->field(array('id','period_state'))->select();
			$this->assign('period_states',$period_states);
            $this->display();
		}
	}
	

	/**
	 * 列表页
	 */
	public function lists(){
        $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        
		$db = M('siteinfo');

        $condition = '1=1';
        $para = array();
        $para['title'] = $this->_get('title');
        if($para['title']){
            $condition .= " AND (title LIKE '%". $para['title'] ."%' OR cusid LIKE '%". $para['title'] ."%')";
        }
        $para['typeid'] = $this->_get('typeid');
        if($para['typeid']){
            $condition .= " AND typeid = '". ($para['typeid']*1) ."'";
        }
        $para['mode'] = $this->_get('mode');
        if($para['mode']){
            $condition .= " AND mode = '". ($para['mode']*1) ."'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');
        $join = "LEFT JOIN {$db_pre}siteinfo_type ON {$db_pre}siteinfo_type.id={$db_pre}siteinfo.typeid";

		$count = $db->where($condition)->count();
		$list = $db->field("{$db_pre}siteinfo.*, {$db_pre}siteinfo_type.name as typename, {$db_pre}siteinfo_type.position")->join($join)->where($condition)->order('is_top DESC, id DESC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));

        //文章分类数组
        $tlist = $db->Distinct(true)->field("{$db_pre}siteinfo_type.*")->join("{$db_pre}siteinfo_type ON {$db_pre}siteinfo_type.id={$db_pre}siteinfo.typeid")->select();
        $this->assign('tlist', $tlist);

		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('siteinfo');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");
            if(!$data["title"]){
                $this->error("标题不能为空");
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

            $this->assign('tlist', M('siteinfo_type')->select());
			$this->display('add');
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('siteinfo');
		if($this->isPost()){
			$arr=$this->_post("checkboxes");
			$str=implode(",",$arr);
			$data['id']=array('in', $str);
			if($db->where($data)->delete()){
                $this->success2("删除成功", "__URL__/lists");
			}else{
				$this->error("删除失败", "__URL__/lists");
			}
		}else{
			$id=$this->_get('id');
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
		$db = M('siteinfo');
		$id = $this->_get("id");
        $data['is_display'] = $this->_get("is_display")*1;
        
        if($db->where(array('id'=>$id))->save($data)){
            $this->success2("设置成功", "__URL__/lists");
        }else{
            $this->error("设置失败");
        }
	}

    /**
    * 置顶状态修改
    */
    public function is_top(){
		$db = M('siteinfo');
		$id = $this->_get("id");
        $data['is_top'] = $this->_get("is_top")*1;
        
        if($db->where(array('id'=>$id))->save($data)){
            $this->success2("设置成功", "__URL__/lists");
        }else{
            $this->error("设置失败");
        }
	}
  
}
?>