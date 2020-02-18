<?php

class YuezifoodschatAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
    /**
	 * 添加
	 */
    public function add(){
		if($this->isPost()){
			$db = M('yuezi_foods_chat');
			$data = $this->_post("info");
            if(!$data["content"]){
                $this->error("内容不能为空");
            }
            if(!$data['to_mid']){
            	$this->error("回复用户ID不能为空");
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
        
		$db = M('yuezi_foods_chat');

        $condition = array();
        $condition[] = "mid>0";

        $para = array();
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');
        $join = "c LEFT JOIN {$db_pre}member m ON m.id=c.mid";

		$count = $db->where($condition)->count();
		$list = $db->field("m.mum_type, m.pic AS m_pic, m.nickname, m.truename, m.mobile, c.*")->join($join)->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		 
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
	 * 用户列表页
	 */
	public function mlists(){
        $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        //$page = $_GET['page']? $_GET['page']*1 : 1;

        $mid = $_REQUEST['mid']*1;
        $this->assign('mid', $mid);
        
		$db = M('yuezi_foods_chat');

        $condition = array();
        $condition[] = "mid='{$mid}' OR to_mid='{$mid}'";

        $para = array();
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');
        $join = "c LEFT JOIN {$db_pre}member m ON m.id=c.mid";

		$count = $db->where($condition)->count();
		$pageCount = ceil($count/$pagesize);
		$page = $_GET['page']? $_GET['page']*1 : $pageCount;

		$list = $db->field("m.mum_type, m.pic AS m_pic, m.nickname, m.truename, m.mobile, c.*")->join($join)->where($condition)->order('id ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));

        $db->where(array('id'=>$_REQUEST['id']*1))->save(array('is_new'=>0));

		$this->display();
	}

	
	/**
	 * 删除
	 */
	public function del(){
		$db = M('yuezi_foods_chat');
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
  
}
?>