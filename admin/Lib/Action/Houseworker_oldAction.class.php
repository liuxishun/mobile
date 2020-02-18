<?php

class HouseworkerAction extends BaseAction{
	
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

            $_level_ids = $_POST['level_page_pics'];
            $level_pics = array();
            foreach($_level_ids as $pid){
                $level_pics[] = $pid . '|' . $_POST['level_page_pic_'.$pid];
            }
            $data['level_page_pics'] = implode(',', $level_pics);
			
            $data["addtime"] = time();
            $hw_id = $db->add($data);
            if($hw_id){
                if($tag_ids){
                    M('hwtag_ref')->where(array('hw_id'=>$hw_id))->delete();
                    foreach($tag_ids as $tag_id){
                        M('hwtag_ref')->add(array('hw_id'=>$hw_id, 'tag_id'=>$tag_id));
                    }
                    //M('hwtag')->where("id NOT IN(SELECT DISTINCT tag_id FROM {$db_pre}hwtag_ref)")->delete();
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
            }else{
                echo $db->getLastSql();exit;
                $this->error("添加失败，请重新添加");
            }
		}else{
			
            $this->display('edit');
		}
	}
	

	public function getTagsByUid(){
		$hwtype_id=$_POST['id'];
		$tags=D('Houseworker')->getTagsByUid('',$hwtype_id);
		echo json_encode($tags);
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

	public function taglists(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition='1=1';
		$db_pre = C('DB_PREFIX');
		$param=array();
		$param['name']=$this->_get('name');
		if($param['name']){
			$condition .= " AND name like '%". $param['name'] ."%'";
		}
        $param['tid']=$this->_get('tid');
		if($param['tid']){
			$condition .= " AND h.type_id = '". ($param['tid']*1) ."'";
		}

		$join=" AS h LEFT JOIN {$db_pre}hwtype AS t ON h.type_id=t.id";
		$field="h.*,t.name as t_name";
		$this->assign('para', $param);
		$maternal=M('hwtag');
		$result=$maternal->join($join)->field($field)->where($condition)->limit($pagesize)->page($page)->select();
		$count=$maternal->join($join)->where($condition)->count();
		$this->assign('list',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		return $this->display("taglists");
	}
	public function tagedit(){
		$this->assign('tag',M('hwtag')->find($_GET['id']));
		return $this->display("tagedit");
	}
	public function saveItem(){
		$result=M('hwtag')->data(array('name'=>$_POST['name'],'type_id'=>$_POST['type_id']))->where(array('id'=>$_POST['id']))->save();
		if($result!==false){
			//$this->show('test');
			$this->success('更新成功！','__URL__/taglists');
		}else{
			$this->error('更新失败！');
		}
	}
	public function addItem(){
		$result=M('hwtag')->data(array('name'=>$_POST['name'],'type_id'=>$_POST['type_id']))->add();
		$result=M('hwtag_ref')->data(array('hw_id'=>$_POST['type_id'],'tag_id'=>$result))->add();
		if($result!==false){
			//$this->show('test');
			$this->success('更新成功！','__URL__/taglists');
		}else{
			$this->error('更新失败！');
		}
	}
	public function deletetag(){
		$result=M('hwtag')->delete($_GET['id']);
		if($result!==false){
			//$this->show('test');
			$this->success2('删除成功！','__URL__/taglists');
		}else{
			$this->error('删除失败！');
		}
	}
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('houseworker');
		$db_pre = C('DB_PREFIX');
		if($this->isPost()){
			
			$data = $this->_post("info");
			$id=$_POST['id'];
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
            
            $_level_ids = $_POST['level_page_pics'];
            $level_pics = array();
            foreach($_level_ids as $pid){
                $level_pics[] = $pid . '|' . $_POST['level_page_pic_'.$pid];
            }
            $data['level_page_pics'] = implode(',', $level_pics);

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
                    //M('hwtag')->where("id NOT IN(SELECT DISTINCT tag_id FROM {$db_pre}hwtag_ref)")->delete();
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
                //$this->show('test');
                
                $this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
			$arr=$db->where(array('id'=>$id))->find();
			$this->assign("arr", $arr);

			$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
			$pagesize = $pagesize<1? 1 : $pagesize;
			$pagesize = $pagesize>100? 100 : $pagesize;
			$page = $_GET['page']? $_GET['page']*1 : 1;
				
			$pingjia=M('pingjia');
			$result=$pingjia->limit($pagesize)->where(array('h_id'=>$id))->page($page)->select();
			$count=$pingjia->where(array('h_id'=>$id))->count();
			$this->assign('list',$result);
			$this->assign('pager', array(
					'pageSize' => $pagesize,
					'count' => $count,
					'currentPage' => $count==0? 0 : $page,
					'pageCount' => ceil($count/$pagesize),
			));
            $this->assign('tlist', M('siteinfo_type')->select());
			$this->display('edit');
		}
	}
	
	
	public function more(){
		$pingjia=M('pingjia');
		$id=$_REQUEST['id']*1;
		$pingjia_pic=M('pingjia_pic');

        if($this->isPost()){
			$data=$this->_post("info");
			$pingjia=M('pingjia');

			$pingjia->where(array('id'=>$id))->data($data)->save();
			$pingjia_pic = M('pingjia_pic');
            $pingjia_pic->where(array('p_pic'=>$id))->delete();

			$pics=explode('|', $data['pics']);
			for($i=0;$i<count($pics);$i++){
				$pingjia_pic->data(array('p_id'=>$id,'pic'=>$pics[$i]))->add();
			}
			//$this->show('test');
			$this->success('修改成功！', __SELF__);
		}else{
            $row  = $pingjia->find($id);
            $this->assign('arr', $row);

            $pics = $pingjia_pic->where(array('p_id'=>$id))->getField('pic', true);
            //print_r($pics);exit;
            
            $this->assign('pics', $pics);
            return $this->display('Pinglun/add');
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