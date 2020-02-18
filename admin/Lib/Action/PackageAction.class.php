<?php
class PackageAction extends BaseAction{
	public function _initialize(){
        parent::_initialize();
    }

	public function see()
	{
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;

		$condition = array();
		$para['tian'] = $_REQUEST['tian'];
		if($para['tian']){
			$condition['tian'] = $para['tian'];
		}
		$para['mum_type'] = $_REQUEST['mum_type'];
		if($para['mum_type']){
			$condition['mum_type'] = $para['mum_type'];
		}
		$this->assign('para', $para);

		$db = M('taocan');
		$count = $db->where($condition)->count();
		$arr = $db->where($condition)->order('tian ASC')->limit($pagesize)->page($page)->select();

		$this->assign('list', $arr);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));

		$this->display();
	}
	public  function  info()
	{
		$db = M('taocan');
		if($this->isPost()){
			$data = $_POST['info'];

			if(!$data['mum_type']){
				$this->error('请选择频道类型');
			}
			if(!$data['tian']){
				$this->error('请输入周期');
			}

			$can_s = array('zao', 'wu', 'wan');
			foreach($can_s as $v){
				$can = array();
				$p_can = $_POST[$v.'can'];
				foreach($p_can as $sv){
					$sv['n'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['n']);
					$sv['num'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['num']);
					$sv['unit'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['unit']);

					if($sv['n'] && $sv['num'] && $sv['unit']){
						$can[] = $sv['n'].'('. $sv['num'].$sv['unit'] .')';
					}
				}
				$data[$v.'can'] = implode(',', $can);

				$jia = array();
				$p_jia = $_POST[$v.'jia'];
				foreach($p_jia as $sv){
					$sv['n'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['n']);
					$sv['num'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['num']);
					$sv['unit'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['unit']);

					if($sv['n'] && $sv['num'] && $sv['unit']){
						$jia[] = $sv['n'].'('. $sv['num'].$sv['unit'] .')';
					}
				}
				$data[$v.'jia'] = implode(',', $jia);

				$data[$v.'candesc'] = $_POST[$v.'candesc'].'';
			}
			$id = $db->add($data);
			if($id!==false){
				$this->success('新增成功！','__URL__/see');
			}else{
				//echo $db->getLastSql();exit;
				$this->error('新增失败！');
			}
		}else{
			$this->display();
		}
	}
	public  function  infoEdit()
	{
		$db = M('taocan');
		$id = $_REQUEST['id']*1;

		if($this->isPost()){
			$data = $_POST['info'];

			if(!$data['mum_type']){
				$this->error('请选择频道类型');
			}
			if(!$data['tian']){
				$this->error('请输入周期');
			}

			$can_s = array('zao', 'wu', 'wan');
			foreach($can_s as $v){
				$can = array();
				$p_can = $_POST[$v.'can'];
				foreach($p_can as $sv){
					$sv['n'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['n']);
					$sv['num'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['num']);
					$sv['unit'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['unit']);

					if($sv['n'] && $sv['num'] && $sv['unit']){
						$can[] = $sv['n'].'('. $sv['num'].$sv['unit'] .')';
					}
				}
				$data[$v.'can'] = implode(',', $can);

				$jia = array();
				$p_jia = $_POST[$v.'jia'];
				foreach($p_jia as $sv){
					$sv['n'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['n']);
					$sv['num'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['num']);
					$sv['unit'] = str_replace(array(',', '(', ')'), array('，', '（', '）'), $sv['unit']);

					if($sv['n'] && $sv['num'] && $sv['unit']){
						$jia[] = $sv['n'].'('. $sv['num'].$sv['unit'] .')';
					}
				}
				$data[$v.'jia'] = implode(',', $jia);

				$data[$v.'candesc'] = $_POST[$v.'candesc'].'';
			}
			$rt = $db->where(array('id'=>$id))->save($data);
			if($rt !==false){
				$this->success('保存成功！','__URL__/see');
			}else{
				//echo $db->getLastSql();exit;
				$this->error('保存失败！');
			}
		}else{
			$arr = $db->find($id);
			$this->assign('arr', $arr);
			$this->display('info');
		}
	}

	/*
	public  function  getUid()
	{
		$db1=D('member');
		$arr2=$db1->select();
		$this->assign('arr2',$arr2);
		$this->display();

		
	}




 //单位管理
public  function  add_dw()
	{


    if($this->_post())
	{
		 $db=D('danwei');
     $data['name']=$_POST['name'];
      $arr=$db->add($data);
     if($arr)
		{
		 $this->success('添加成功','__APP__/package/lists_dw');
		 }
	 }else
		{
		 $this->display();
		
	
		}
	}

 public  function  lists_dw()
	{
	 $db=D('danwei');
	 $arr=$db->select();
	 $this->assign('arr',$arr);
	 $this->display();
	}

	public  function  del_dw()
	{
	 $db=D('danwei');
	 $id=$this->_get('id');
	 $arr=$db->where('id='.$id)->delete();
	 if($arr)
		{
	     $this->success('删除成功','__APP__/package/lists_dw');
	    }
	
	}

	//查找食物
	public function getFood() {	
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
        $pagesize = $pagesize<1? 1 : $pagesize;
        $pagesize = $pagesize>100? 100 : $pagesize;
        $page = $_GET['page']? $_GET['page']*1 : 1;
        $db_pre = C('DB_PREFIX');
		$condition = '1=1';
		$cid =$_GET['cid'];
		$this->assign('cid',$cid);
		$tag = $_GET['tag'];
		$this->assign('tag',$tag);
		$kw = $_GET['kw'];
		$this->assign('kw',$kw);
		//查询单位
		$$unitoption="";
		$danwei=M("danwei")->select();
		foreach ($danwei as $v) {
			$unitoption .= '<option value="'.$v['name'].'">'.$v['name'].'</option>';
		}

		$this->assign("danwei",$unitoption);
		$count = M('foods')->where($condition)->count();
		$lists=M('foods')->where($condition)->order('id DESC')->limit($pagesize)->page($page)->select();
		$this->assign("lists",$lists);
		$this->assign('pager', array(
            'pageSize' => $pagesize,
            'count' => $count,
            'currentPage' => $count==0? 0 : $page,
            'pageCount' => ceil($count/$pagesize),
        ));
		$this->display();
	 	
	 }*/














}
