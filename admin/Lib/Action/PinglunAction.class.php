<?php
class PinglunAction extends BaseAction{
	public function _initialize(){
		parent::_initialize();
	
	}
	public function index(){
		return $this->display('lists');
	}
	public function lists(){
			$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
			$pagesize = $pagesize<1? 1 : $pagesize;
			$pagesize = $pagesize>100? 100 : $pagesize;
			$page = $_GET['page']? $_GET['page']*1 : 1;
			$db_prefix=C('DB_PREFIX');	
			$pingjia=M('pingjia');
			$join=" AS p LEFT JOIN {$db_prefix}houseworker AS h ON p.h_id=h.id";
			$field='p.*,h.title';
			$result=$pingjia->field($field)->join($join)->limit($pagesize)->page($page)->select();
			$count=$pingjia->field($field)->join($join)->count();
			$this->assign('list',$result);
			$this->assign('pager', array(
					'pageSize' => $pagesize,
					'count' => $count,
					'currentPage' => $count==0? 0 : $page,
					'pageCount' => ceil($count/$pagesize
			),
			));
		$this->display('lists');
	}
	public function delete(){
		$id=$_GET['id'];
		$result=D('Pingjia')->relation(true)->delete($id);
		if($result!==false){
			//$this->show('test');
			$this->success2('删除成功！','__URL__/lists');
		}else{
			$this->error('删除失败！');
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
			$this->success('修改成功！','__URL__/lists');
		}else{
            $row  = $pingjia->find($id);
            $this->assign('arr', $row);

            $pics = $pingjia_pic->where(array('p_id'=>$id))->getField('pic', true);
            //print_r($pics);exit;
            
            $this->assign('pics', $pics);
            return $this->display('add');
        }
	}
	public function add(){
		if($this->isPost()){
			$data=$this->_post("info");
			$pingjia=M('pingjia');
            $data['addtime'] = date('Y-m-d H:i:s',time());

			$id=$pingjia->data($data)->add();
			$pingjia_pic=M('pingjia_pic');
			$pics=explode('|', $data['pics']);
			for($i=0;$i<count($pics);$i++){
				$pingjia_pic->data(array('p_id'=>$id,'pic'=>$pics[$i]))->add();
			}
			//$this->show('test');
			$this->success('提交成功！','__URL__/lists');
		}else{
			//$houseworker=M('houseworker')->field('id,title')->select();
			//$this->assign('list',$houseworker);
			$this->display('add');
		}
	}
}
?>