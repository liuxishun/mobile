<?php

class HwtagAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		$db_pre = C('DB_PREFIX');
        if($this->isPost()){
			$db = M('houseworker');
			//$data = $this->_post("info");

            $tag_ids = $_POST['tag_ids'];
            $newtags = $_POST['newtag']? explode(' ', trim($_POST['newtag'])) : array();

            
			
           //// $data["addtime"] = time();
           // $hw_id = $db->add($data);
            //if($hw_id){
                if($tag_ids){
                    M('hwtag_ref')->where(array('hw_id'=>$hw_id))->delete();
                    foreach($tag_ids as $tag_id){
                        M('hwtag_ref')->add(array('hw_id'=>$hw_id, 'tag_id'=>$tag_id));
                    }
                    M('hwtag')->where("id NOT IN(SELECT DISTINCT tag_id FROM {$db_pre}hwtag_ref)")->delete();
                }
                foreach($newtags as $tag){
                    $tag = trim($tag);
                    $t_row = M('hwtag')->where(array('name'=>$tag))->find();
                    if($t_row){
                        if(!in_array($t_row['id'], $tag_ids))M('hwtag_ref')->add(array('hw_id'=>$hw_id, 'tag_id'=>$t_row['id']));
                    }else{
                        $tag_id = M('hwtag')->add(array('name'=>$tag));
                        M('hwtag_ref')->add(array('hw_id'=>$hw_id, 'tag_id'=>$tag_id));
                    }
                }
                
                $this->success("添加成功", "__URL__/lists");
           // }else{
             //   echo $db->getLastSql();exit;
           //     $this->error("添加失败，请重新添加");
           // }
		}else{
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
        
		$db = M('houseworker');

        $condition = '1=1';
        $para = array();
        $para['id'] = $this->_get('id');
        if($para['id']){
            $condition .= " AND id='". $para['id'] ."'";
        }
        $para['title'] = $this->_get('title');
        if($para['title']){
            $condition .= " AND (title LIKE '%". $para['title'] ."%')";
        }
        $para['hwtype_id'] = $this->_get('hwtype_id');
        if($para['hwtype_id']>0){
            $condition .= " AND hwtype_id = '". ($para['hwtype_id']*1) ."'";
        }
        $para['mode'] = $this->_get('mode');
        if($para['mode']){
            $condition .= " AND mode = '". ($para['mode']*1) ."'";
        }
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

		$count = $db->where($condition)->count();
		$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));

        $this->assign('tabid', $this->_get('tabid'));

		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('houseworker');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");

            $hwlevel = M('hwlevel')->where(array('id'=>$data['hwlevel_id']))->find();
            if(!$hwlevel){
                $this->error("没有选择星级");
            }
            $data['hwtype_id'] = $hwlevel['hwtype_id'];

            $tag_ids = $_POST['tag_ids'];
            $newtags = $_POST['newtag']? explode(' ', trim($_POST['newtag'])) : array();

            if(!$data["title"]){
                $this->error("名称不能为空");
            }

			if($db->where(array('id'=>$id))->save($data)!==false){
                if($tag_ids){
                    M('hwtag_ref')->where(array('hw_id'=>$id))->delete();
                    $_tag_ids = array();
                    foreach($tag_ids as $tag_id){
                        if(!in_array($tag_id, $_tag_ids)){
                            M('hwtag_ref')->add(array('hw_id'=>$id, 'tag_id'=>$tag_id));
                            $_tag_ids[] = $tag_id;
                        }
                    }
                    M('hwtag')->where("id NOT IN(SELECT DISTINCT tag_id FROM {$db_pre}hwtag_ref)")->delete();
                }
                foreach($newtags as $tag){
                    $tag = trim($tag);
                    $t_row = M('hwtag')->where(array('name'=>$tag))->find();
                    if($t_row){
                        if(!in_array($t_row['id'], $tag_ids))M('hwtag_ref')->add(array('hw_id'=>$id, 'tag_id'=>$t_row['id']));
                    }else{
                        $tag_id = M('hwtag')->add(array('name'=>$tag));
                        M('hwtag_ref')->add(array('hw_id'=>$id, 'tag_id'=>$tag_id));
                    }
                }
                
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
		$db = M('houseworker');
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
		$db = M('houseworker');
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
		$db = M('houseworker');
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