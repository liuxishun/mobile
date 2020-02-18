<?php

class MainprjAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M('main_prj');
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
        
		$db = M('main_prj');

        $condition = '1=1';
        $para = array();
        $para['title'] = $this->_get('title');
        if($para['title']){
            $condition .= " AND (s.title LIKE '%". $para['title'] ."%')";
        }
        $para['mum_type'] = $this->_get('mum_type');
        if($para['mum_type']){
            $condition .= " AND s.mum_type = '". $para['mum_type'] ."'";
        }
        
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');

		$count = $db->alias('s')->where($condition)->count();
		$list = $db->alias('s')->field("s.*")->join($join)->where($condition)->order('s.is_top DESC, s.sort ASC, s.id ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));


		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('main_prj');
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

            $this->assign('tlist', M('service_type')->select());
			$this->display('add');
		}
	}
	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('main_prj');
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
		$db = M('main_prj');
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
		$db = M('main_prj');
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