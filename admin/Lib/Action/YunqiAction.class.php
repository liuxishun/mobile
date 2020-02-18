<?php
header("content-type:text/html;charset=utf-8");

// 本类由系统自动生成，仅供测试用途
class YunqiAction extends BaseAction {


	public  function    index()
	{

       $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition='1=1';
		$foods=M('yunqi');
		$result=$foods->where($condition)->limit($pagesize)->page($page)->select();
		$count=$foods->where($condition)->count();
		 $this->assign('arr',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		
	  
	   $this->display();

	}

	public  function   edit()
	{

		if($this->_post())
		{   $id=$this->_post('id');
			$data=$this->_post('info');
		    $db=D('yunqi');
		    $arr=$db->where('id='.$id)->save($data);
		   if($arr)
		  {
			$this->success('修改成功','__URL__/index');
		  }else
		  {
			$this->success('修改失败','__URL__/index');
		 }


		}else
		{
	     $id=$this->_get('id');
	     $db=D('yunqi');
	    $arr=$db->where('id='.$id)->find();
		$this->assign('list',$arr);
		$this->display('add');
		}
		}

	public  function   del()
	{
		$id=$this->_get('id');
	     $db=D('yunqi');
	    $arr=$db->where('id='.$id)->delete();
		 if($arr)
		  {
			$this->success2('删除成功','__URL__/index');
		  }else
		  {
			$this->success2('删除失败','__URL__/index');
		 }
	
	}

	public  function   add()
	{
		$this->display();
	}
	public  function  add_pro()
	{

		$data=$this->_post('info');
		$db=D('yunqi');
		$arr=$db->add($data);
		if($arr)
		{
			$this->success('添加成功','__URL__/index');
		}else
		{
			$this->success('添加失败','__URL__/index');
		}



	}

         
	

}