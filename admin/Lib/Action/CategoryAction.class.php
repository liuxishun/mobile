<?php
class CategoryAction extends BaseAction{
	public function _initialize(){
        parent::_initialize();

    }

	public  function   add()
	{
   $this->display();

	}
	public  function  add_pro()
	{

		$data=$this->_post('info');
		$db=D('food_catorgory');
		$arr=$db->add($data);
		if($arr)
		{
			$this->success('添加成功','__URL__/lists');
		}else
		{
			$this->success('添加失败','__URL__/lists');
		}
		
	}
	public  function  lists()
	{
		$db=D('food_catorgory');
		$arr=$db->select();
		$this->assign('arr1',$arr);
		$this->display();
	}
	public  function  del()
	{
        $db=D('food_catorgory');
		$id=$this->_get('id');
		
		$arr=$db->where("id=".$id)->delete();
	
		if($arr)
		{
			$this->success2('删除成功',"__URL__/lists");
		}


	}
    
    

}
?>