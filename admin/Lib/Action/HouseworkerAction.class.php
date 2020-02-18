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
		     $data['area_id']=$_POST['area_id'];
			 $data['resourse']=implode('-',$_POST['resourse']);
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
			//echo $db->getLastsql();die;
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
         $db_pre = C('DB_PREFIX');
		$db = M('houseworker');

        $condition = '1=1';
        $para = array();
		
		
		$id=$this->_get('id')? $_GET['id']*1 : 0;
		if($id!=0)
		{
			 $condition .= "   and  status=".$id;
		}

 

        $para['username'] = $this->_get('username');
		



        if($para['username']){
            $condition .= "   and  (title LIKE '%". $para['username'] ."%')";
        }
        $para['mobile'] = $this->_get('mobile');
        if($para['mobile']){
            $condition .= " AND {$db_pre}houseworker.mobile  ='". $para['mobile'] ."'";
        }
        $para['hwtype_id'] = $this->_get('hwtype_id');
        if($para['hwtype_id']>0){
            $condition .= " AND {$db_pre}houseworker.hwtype_id = '". ($para['hwtype_id']*1) ."'";
        }
        $para['xingji'] = $this->_get('xingji');
        if($para['xingji']){
            $condition .= " AND {$db_pre}houseworker.hwlevel_id = '". ($para['xingji']*1) ."'";
        }

		  $para['minzu'] = $this->_get('minzu');
        if($para['minzu']){
            $condition .= " AND {$db_pre}houseworker.minzu like '%". ($para['minzu']) ."%'";
        }
		$para['diqu'] = $this->_get('diqu');
        if($para['diqu']){
            $condition .= " AND {$db_pre}houseworker.minzu like '%". ($para['diqu']*1) ."%'";
        }
        $this->assign('para', $para);

		$count = $db->where($condition)->count();
		$list = $db->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		//echo  $db->getLastsql();exit;
		 
		$this->assign('list', $list);
        $this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));

        $this->assign('tabid', $this->_get('tabid'));
           $this->assign('id',$id);
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
		$result=M('hwtag')->data(array('name'=>$_POST['name'],'type_id'=>$_POST['type_id'], 'desc'=>trim($_POST['desc'].'')))->where(array('id'=>$_POST['id']))->save();
		if($result!==false){
			//$this->show('test');
			$this->success('更新成功！','__URL__/taglists');
		}else{
			$this->error('更新失败！');
		}
	}
	public function addItem(){
		$result=M('hwtag')->data(array('name'=>$_POST['name'],'type_id'=>$_POST['type_id'], 'desc'=>trim($_POST['desc'].'')))->add();
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
			  $data['area_id']=implode('-',$_POST['area_id']);
			 $data['resourse']=implode('-',$_POST['resourse']);
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


	//print_r($data);die;
			if($db->where(array('id'=>$id))->save($data)!==false){
				//echo  $db->getLastsql();die;
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
		$arrr['id']=$id;
			$this->assign('arrr',$arrr);
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

    //阿姨详情
	public   function   xiangqing()
	{
		//阿姨表
     $id=$this->_get('id');
    $db = M('houseworker');
   $list = $db->where("id=".$id)->select();
   $this->assign('arr',$list);

   //培训表

   $db1=D("training");
   $arr1=$db1->where('houser_id='.$id)->select();
   $this->assign('arr1',$arr1);
  //银行卡
   $db2=D("bank");
   $arr2=$db2->where('hourser_id='.$id)->select();
   $this->assign('arr2',$arr2);
   //家庭情况
    $db3=D("family");
   $arr3=$db3->where('houser_id='.$id)->select();
   $this->assign('arr3',$arr3);
    //工作经历
    $db4=D("work");
   $arr4=$db4->where('houser_id='.$id)->select();
   $this->assign('arr4',$arr4);
   //提醒事项
    $db5=D('remind');
    $arr5=$db5->where('houser_id='.$id)->select();
   $this->assign('arr5',$arr5);


   //合同
      $db6=D('contract');
    $arr6=$db6->where('houser_id='.$id)->select();
   $this->assign('arr6',$arr6);

 //评价
   $db7=D('pingjia');
    $arr7=$db7->where('h_id='.$id)->select();
   $this->assign('arr7',$arr7);
  //收支
     $db8=D('shouzhi');
    $arr8=$db8->where('houser_id='.$id)->select();
   $this->assign('arr8',$arr8);
   //评价  
         $db_prefix=C('DB_PREFIX');	
		$pingjia=M('pingjia');
		$arr9=$pingjia->where('h_id='.$id)->select();
		$this->assign('arr9',$arr9);




//print_r($arr5);





   $this->display();

	}


  //培训添加
	public function  add_1()
	{
		$arr['id']=$this->_get('id');
		$this->assign('a_id',$arr);
		$this->display();
	}

public function  tianjia()
	{
			$b_id=$this->_post('b_id');

	$db=D('training');
	$data=$this->_post('info');
	//echo "<pre>";
	//print_r($_POST);
	
	//print_r($_POST['tra_name']);die;
	$data['tra_name']=implode(',',$_POST['tra_name']);
	$data['add_time']=time();
	//print_r($data);die;
	if($b_id!=""){
		      $arr=$db->where('id='.$b_id)->save($data);
		         if($arr)
				{
				$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
				}else
				{
							$this->error('修改失败','__URL__/xiangqing/id/'.$data['houser_id']);
				}
		}else{
				$arr=$db->add($data);
				//die;
				if($arr)
					{

					$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
					}else
					{
								$this->error('添加失败','__URL__/xiangqing/id/'.$data['houser_id']);

					}
	}
		//$this->display();
	}
	public  function tra_edit(){
		$db=D('training');

	$id=$this->_get('id');
	$a_id['id']=$this->_get('houser_id');

	//print_r($data);
	$list=$db->where('id='.$id)->find();
	$lis=explode(',',$list['tra_name']);
	$this->assign('lis',$lis);
	$this->assign('list',$list);
	$this->assign('a_id',$a_id);
	$this->display('add_1');
			}
public  function tra_del()
{


	  $id=$this->_get('id');
		$h_id=$this->_get('houser_id');

		$db=D('training');
		$de=$db->where('id='.$id)->delete();
		if($de)
		{
$this->success2('删除成功','__URL__/xiangqing/id/'.$h_id);
		}

}







	//银行
	function  bank_add()
	{

		$arr['id']=$this->_get('id');
		$this->assign('a_id',$arr);
		$this->display();
	}
	function bank_add_pro()
	{

		$b_id=$this->_post('b_id');
		$db=D('bank');
		//echo $b_id;die;
	      $data=$this->_post('info');
		if($b_id!=""){
		      $arr=$db->where('id='.$b_id)->save($data);
		         if($arr)
				{
				$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['hourser_id']);
				}else
				{
							$this->error('修改失败','__URL__/xiangqing/id/'.$data['hourser_id']);
				}
		}else{
				$arr=$db->add($data);
				if($arr)
					{
					$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['hourser_id']);
					}else
					{
								$this->error('添加失败','__URL__/xiangqing/id/'.$data['hourser_id']);
					}
	        }

	}

	function  bank_edit()
	{
		$db=D('bank');
	$id=$this->_get('id');
	$a_id['id']=$this->_get('houser_id');

	//print_r($data);
	$list=$db->where('id='.$id)->find();
	$this->assign('list',$list);
	$this->assign('a_id',$a_id);
	$this->display('bank_add');
	}

	function  bank_del()
	{
		$id=$this->_get('id');
		$h_id=$this->_get('houser_id');

		$db=D('bank');
		$de=$db->where('id='.$id)->delete();
		if($de)
		{
$this->success2('删除成功','__URL__/xiangqing/id/'.$h_id);
		}
	}
//家庭情况




	function family_add()
	{
		$arr['id']=$this->_get('id');
		$this->assign('a_id',$arr);
		$this->display();

	}
	function  family_add_pro()
	{
     

		$b_id=$this->_post('f_id');
		$db=D('family');
		//echo $b_id;die;
	      $data=$this->_post('info');
		if($b_id!=""){
		      $arr=$db->where('id='.$b_id)->save($data);
		         if($arr)
				{
				$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
				}else
				{
							$this->error('修改失败','__URL__/xiangqing/id/'.$data['houser_id']);
				}
		}else{
				$arr=$db->add($data);
				if($arr)
					{
					$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
					}else
					{
								$this->error('添加失败','__URL__/xiangqing/id/'.$data['houser_id']);
					}
	        }



	}
	function  family_edit()
	{
		$db=D('family');
	$id=$this->_get('id');
	$a_id['id']=$this->_get('houser_id');

	//print_r($data);
	$list=$db->where('id='.$id)->find();
	$this->assign('list',$list);
	$this->assign('a_id',$a_id);
	$this->display('family_add');
	}

	function  family_del()
	{
		$id=$this->_get('id');
		$h_id=$this->_get('houser_id');

		$db=D('family');
		$de=$db->where('id='.$id)->delete();
		if($de)
		{
        $this->success2('删除成功','__URL__/xiangqing/id/'.$h_id);
		}
	}
//工作经历
	function  work_add()
	{
		$arr['id']=$this->_get('id');
		$this->assign('a_id',$arr);
		$this->display();

	}
	function work_add_pro()
	{
		$b_id=$this->_post('f_id');
		$db=D('work');
		//echo $b_id;die;
	      $data=$this->_post('info');
		if($b_id!=""){
		      $arr=$db->where('id='.$b_id)->save($data);
		         if($arr)
				{
				$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
				}else
				{
							$this->error('修改失败','__URL__/xiangqing/id/'.$data['houser_id']);
				}
		}else{
				$arr=$db->add($data);
				if($arr)
					{
					$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
					}else
					{
								$this->error('添加失败','__URL__/xiangqing/id/'.$data['houser_id']);
					}
	        }
	     }
	     function work_edit()
	     {


		$db=D('work');
	$id=$this->_get('id');
	$a_id['id']=$this->_get('houser_id');

	//print_r($data);
	$list=$db->where('id='.$id)->find();
	$this->assign('list',$list);
	$this->assign('a_id',$a_id);
	$this->display('work_add');
	     }
	     function  work_del()
	     {


			     	$id=$this->_get('id');
				$h_id=$this->_get('houser_id');

				$db=D('work');
				$de=$db->where('id='.$id)->delete();
				if($de)
				{
		        $this->success('删除成功','__URL__/xiangqing/id/'.$h_id);
				}
	     }
//提醒事项
	      function  tixing_add()
	     {


			     $arr['id']=$this->_get('id');
		$this->assign('a_id',$arr);
		$this->display();
	     }

	     function tixing_add_pro()
	     {

	     	$b_id=$this->_post('f_id');
		$db=D('remind');
		//echo $b_id;die;
	      $data=$this->_post('info');
		if($b_id!=""){
		      $arr=$db->where('id='.$b_id)->save($data);
		         if($arr)
				{
				$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
				}else
				{
							$this->error('修改失败','__URL__/xiangqing/id/'.$data['houser_id']);
				}
		}else{
				$arr=$db->add($data);
				if($arr)
					{
					$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
					}else
					{
								$this->error('添加失败','__URL__/xiangqing/id/'.$data['houser_id']);
					}
	        }



	     }
			     //收支
		function   shouzhi_add()
		{
			     $arr['id']=$this->_get('id');
				$this->assign('a_id',$arr);
				$this->display();

		}

		function  shouzhi_add_pro()
		{
			$b_id=$this->_post('f_id');
				$db=D('shouzhi');
				//echo $b_id;die;
				//die;
			      $data=$this->_post('info');

				if($b_id!=""){
				      $arr=$db->where('id='.$b_id)->save($data);

				         if($arr)
						{
						$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
						}else
						{
									$this->error('修改失败','__URL__/xiangqing/id/'.$data['houser_id']);
						}
				}else{
						$arr=$db->add($data);
								     // echo $db->getLastsql();die;
						if($arr)
							{
							$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
							}else
							{
										$this->error('添加失败','__URL__/xiangqing/id/'.$data['houser_id']);
							}
			        }
		}
        function  shouzhi_edit()
	    {



		$db=D('shouzhi');
	$id=$this->_get('id');
	$a_id['id']=$this->_get('houser_id');
	$list=$db->where('id='.$id)->find();
	$this->assign('list',$list);
	$this->assign('a_id',$a_id);
	$this->display('shouzhi_add');
	    }






	     //合同
	     function   contract_add()
	     {


	     $arr['id']=$this->_get('id');
		$this->assign('a_id',$arr);
		$this->display();
              }

         function contract_add_pro()
	     {

	     	$b_id=$this->_post('b_id');
		$db=D('contract');
		//echo $b_id;die;
	      $data=$this->_post('info');
		if($b_id!=""){
		      $arr=$db->where('id='.$b_id)->save($data);
		         if($arr)
				{
				$this->success('修改成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
				}else
				{
							$this->error('修改失败','__URL__/xiangqing/id/'.$data['houser_id']);
				}
		}else{
				$arr=$db->add($data);
				if($arr)
					{
					$this->success('添加成功<script>parent.window.closeArt && parent.window.closeArt();</script>','__URL__/xiangqing/id/'.$data['houser_id']);
					}else
					{
								$this->error('添加失败','__URL__/xiangqing/id/'.$data['houser_id']);
					}
	        }
	    }

	    function  contract_edit()
	    {



		$db=D('contract');
	$id=$this->_get('id');
	$a_id['id']=$this->_get('houser_id');

	//print_r($data);
	$list=$db->where('id='.$id)->find();
	$this->assign('list',$list);
	$this->assign('a_id',$a_id);
	$this->display('contract_add');


	    }
	    function  contract_del()	    
	    {
			$id=$this->_get('id');
				$h_id=$this->_get('houser_id');

				$db=D('contract');
				$de=$db->where('id='.$id)->delete();
				if($de)
				{
		        $this->success2('删除成功','__URL__/xiangqing/id/'.$h_id);
				}
	    }


		function   up_status(){

			$id=$this->_post('id');
			$data['status']=$this->_post('status');
			$db=D('houseworker');
			$up=$db->where('id='.$id)->save($data);
			if($up)
			{
				echo 1;
			}else
			{

                  echo 2;
			}

		
		
		}











}
?>