<?php

class ServiceAction extends BaseAction{
	
    public function _initialize(){
        parent::_initialize();

    }
    
	 public function pages(){
		Session_start();
		$project=empty($_SESSION["project"])?"母婴护理":$_SESSION["project"];
		$this->assign('project',$project);
	    $this->display();
	}
    /**
	 * 添加
	 */
	 
	 
	 public function addUser(){
            $db_pre = C('DB_PREFIX');
            $db = M('user');
            $data = array();
                
                $data['name']=$_POST['name'];
				$data['phone']=$_POST['phone'];
				$data['project']=$_POST['project'];
				$data['number']=$_POST['number'];
			    $data['date']=$_POST['date'];
				$data['riqi']=$_POST['riqi'];
				$data['address']=$_POST['address'];
    if($db->add($data)){
	$status=0;
	}else{
	$status=1;	
		}
	$this->ajaxReturn($status);
	 }

    public function addtijiao(){
	
	            $data = array();
                $data['name']=$_POST['name'];
				$data['phone']=$_POST['phone'];
				$data['project']=$_POST['project'];
			    $data['number']=$_POST['number'];
				$data['date']=$_POST['date'];
                $data['riqi']=$_POST['riqi'];
				$data['address']=$_POST['address'];
			if($_POST['phone'] == "" || $_POST['name'] == ""){
		
			$this->display('pages');
		}else{
			$db = M('user');
			$hw_id = $db->add($data);
				
				$this->success("添加成功!客服会联系您！");
	
	}

	}
	
    public function tijiao(){
	
	            $data = array();
                $data['name']=$_POST['name'];
				$data['phone']=$_POST['phone'];
				$data['yuchaqi']=$_POST['yuchaqi'];
			    $data['city']=$_POST['city'];
				
				
			
				

		if($_POST['phone'] == "" || $_POST['name'] == ""){
		
			$this->display('pages');
		}else{
			$db = M('user');
			$hw_id = $db->add($data);
				
				$this->success("添加成功!客服会联系您！");

	              }

	}
		
		
		public function kehulists(){
        $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        $db_pre = C('DB_PREFIX');
		$db = M('user');
/*
        $condition = '1=1';
        $para = array();
		
        $para['title'] = $this->_get('title');
        if($para['title']){
            $condition .= " AND (s.title LIKE '%". $para['title'] ."%')";
        }
        $para['typeid'] = $this->_get('typeid');
        if($para['typeid']){
            $condition .= " AND s.typeid = '". ($para['typeid']*1) ."'";
        }
        
        $this->assign('para', $para);
*/
		$count = $db->count();
		$list = $db->order('id ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
		
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
		$this->display();
	}
       public function yuesaoyy(){
		   
		      $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        $db_pre = C('DB_PREFIX');
		$db = M('yuesaoyuyb');

		$count = $db->count();
		$list = $db->order('id ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
		
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
		$this->display();
	 
        }
	 public function yuesaoyy_del(){
		  $id = $this->_get('id');
                        $re = M('yuesaoyuyb')->where("id=$id")->delete();
                        if($re){
                                $this->success('删除成功', '__URL__/yuesaoyy');
                        }else{
                                $this->error('删除失败','__URL__/yuesaoyy');
                        }
		 }
    public function add(){
        
		if($this->isPost()){
			$db = M('service');
			$data = $this->_post("info");
            if(!$data["title"]){
                $this->error("标题不能为空");
            }
            $data['content'] = serialize($_POST['info']['content']) ;	
            $data["addtime"] = time();
            if($db->add($data)){
                $this->success("添加成功", "__URL__/pages");         
				   }else{
                $this->error("添加失败，请重新添加");
            }
		}else{
			$this->assign('tlist', M('service_type')->select());
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
        
		$db = M('service s');

        $condition = '1=1';
        $para = array();
        $para['title'] = $this->_get('title');
        if($para['title']){
            $condition .= " AND (s.title LIKE '%". $para['title'] ."%')";
        }
        $para['typeid'] = $this->_get('typeid');
        if($para['typeid']){
            $condition .= " AND s.typeid = '". ($para['typeid']*1) ."'";
        }
        
        $this->assign('para', $para);

        $db_pre = C('DB_PREFIX');
        $join = "LEFT JOIN {$db_pre}service_type st ON st.id=s.typeid";

		$count = $db->where($condition)->count();
		$list = $db->field("s.*, st.name as typename")->join($join)->where($condition)->order('s.is_top DESC, s.sort ASC, s.id ASC')->limit($pagesize)->page($page)->select();
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));

        //文章分类数组
        $tlist = $db->Distinct(true)->field("st.*")->join("{$db_pre}service_type st ON st.id=s.typeid")->select();
        $this->assign('tlist', $tlist);

		$this->display();
	}

	
	/**
	 * 编辑
	 */
	public function edit(){
		$db = M('service');
		if($this->isPost()){
			$id = $this->_post("id");
			$data = $this->_post("info");
            if(!$data["title"]){
                $this->error("标题不能为空");
            }
$data['content'] = serialize($_POST['info']['content']) ;
			if($db->where(array('id'=>$id))->save($data)){
				$this->success2("编辑成功", "__URL__/lists");
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id=$this->_get("id");
                        
			$arr=$db->where(array('id'=>$id))->find();
                           $info['shows'] = unserialize($arr['content']) ;
                            $array = array_chunk($info['shows'],2,true);
                            $newArr = array();
                            foreach($array as $key=>$v){
                              foreach($v as $ksy=>$j){
                                  $newArr[$key][] = $j ;
                              }
                            }
                            $this->assign('newArr',$newArr);
			$this->assign("arr", $arr);

            $this->assign('tlist', M('service_type')->select());
			$this->display('add');
		}
	}
	
	/**
	 * 删除
	 */
	 
	 
public function kehu_del(){
                        $id = $this->_get('id');
                        $re = M('user')->where("id=$id")->delete();
                        if($re){
                                $this->success('删除成功', '__URL__/kehulists');
                        }else{
                                $this->error('删除失败','__URL__/kehulists');
                        }
                }

	
	 
	 
	 
	 
	public function del(){
		$db = M('service');
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
		$db = M('service');
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
		$db = M('service');
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