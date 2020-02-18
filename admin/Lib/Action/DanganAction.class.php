<?php
class DanganAction extends BaseAction{
	public function _initialize(){
        parent::_initialize();

    }

	public  function   liebiao()
	{
		
	
		

		 $pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition='1=1';
		$param=array();
		$param['name']=$this->_get('name');
		if($param['name']){
			$condition .= " name like '%". $param['name'] ."%'";
		}
		$this->assign('para', $param);
		$db=D('dangan');
		
	
		$result=$db->where($condition)->limit($pagesize)->page($page)->select();
		$count=$db->where($condition)->count();
		$this->assign('list',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		$this->display();

	}
	public  function  del ()
	{
		$id=$this->_get('id');
		$db=D('dangan');
		$r=$db->where('id='.$id)->delete();
		if($r)
		{
			$this->success('删除成功',"__URL__/liebiao");
		}
	}

	public  function  lists()
	{
		$db=D('yinshi');
		$arr=$db->select();
		$this->assign('arr',$arr);
		$this->display();  

	}

    
    

}
?>