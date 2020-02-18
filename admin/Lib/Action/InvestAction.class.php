<?php
class InvestAction extends BaseAction{

	public function _initialize(){
		parent::_initialize();
	}
	public function index(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition='1=1';
		$param=array();
		$param['t_name']=$this->_get('t_name');
		if($param['t_name']){
			$condition .= " AND t_name like '%". $param['t_name'] ."%'";
		}
		$condition .= " AND parent_id=0";
		$this->assign('para', $param);
		$result=M('invest')->where($condition)->limit($pagesize)->page($page)->select();
		$count=M('invest')->where($condition)->count();
		$this->assign('list',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		return $this->display("invest");
	}
	public function delete(){
		$id=$_REQUEST['id'];
		$invest=M('invest');
		$invest->startTrans();
		$result=$invest->delete($id);
		if($result===false){
			$this->error('删除败！');
			//echo '1111111111111';
			$this->show('test');
			$invest->rollback();
			return ;
		}
		$ids=$invest->field('id')->where(array('parent_id'=>$id))->select();
		$result=$invest->where(array('parent_id'=>$id))->delete();
		if($result===false){
			$this->error('删除败！');
			//$this->show('test');
			$invest->rollback();
			return ;
		}
		if($ids){
		foreach($ids as $val){
			$result=$invest->where(array('parent_id'=>$val['id']))->delete();
			if($result===false){
				$this->error('删除败！');
				//$this->show('test');
				$invest->rollback();
				return ;
			}
		}
		}
		$invest->commit();
		//$this->show('test');
		return $this->success2("删除成功", "__URL__/index");
	}
	public function add(){
		if($this->isPost()){
			$t_name=$_POST['t_name'];
			$invest=M('invest');
			
            //卷名
			$parent_id=$invest->data(array('t_name'=>$t_name,'parent_id'=>0, 'choice_mode'=>0))->add();
			if($parent_id===false){
				$this->error('新增失败');
				return ;
			}

            $sub = $_POST['sub'];
            foreach($sub as $val){
                $sid = $invest->data(array('t_name'=>$val['name'],'parent_id'=>$parent_id, 'choice_mode'=>$val['choice_mode']))->add();
                foreach($val['item'] as $sval){
                    $invest->data(array('t_name'=>$sval,'parent_id'=>$sid, 'choice_mode'=>0))->add();
                }
            }

			$this->success('新增成功！','__URL__/index');
		}else{
			$this->display('add');
		}
	}
	public function additem(){
		if($this->isPost()){
			$id=$_POST['t_sub_id'];
			$t_name=$_POST['p_names'];
			if($t_name==''||$t_name==null){
				$this->error('未更新任何数据!');
				return ;
			}
			$t_names=explode(',', $t_name);
			$invest=M('invest');
			$invest->startTrans();
			for($i=0;$i<count($t_names);$i++){
				$result=$invest->data(array('parent_id'=>$id,'t_name'=>$t_names[$i]))->add();
				if($result===false){
					$this->error('新增失败！');
					$invest->rollback();
					return ;
				}
			}
			$invest->commit();
			$this->success('新增成功！','__URL__/index');
		}else{
			$invest=M('invest');
			$list=$invest->where(array('parent_id'=>0))->select();
			$this->assign('list',$list);
			$this->display('additem');
		}
	}
	public function itemlist(){
		$pagesize = $_GET['pagesize']? $_GET['pagesize']*1 : 15;
		$pagesize = $pagesize<1? 1 : $pagesize;
		$pagesize = $pagesize>100? 100 : $pagesize;
		$page = $_GET['page']? $_GET['page']*1 : 1;
		$condition='1=1';
		$param=array();
		$param['t_name']=$this->_get('t_name');
		if($param['t_name']){
			$condition .= " AND t_name like '%". $param['t_name'] ."%'";
		}
		$this->assign('para', $param);
		$db_pre = C('DB_PREFIX');
		$join=" AS a INNER JOIN {$db_pre}invest AS b ON a.parent_id=b.id INNER JOIN {$db_pre}invest AS c ON c.parent_id=0 AND c.id=b.parent_id";
		$field='a.id,a.t_name,b.t_name as b_name,c.t_name as p_name';
		$result=M('invest')->field($field)->join($join)->where($condition)->limit($pagesize)->page($page)->select();
		$count=M('invest')->field($field)->join($join)->where($condition)->count();
		$this->assign('list',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		return $this->display('itemlist');
	}
	public function deleteitem(){
		$invest=M('invest');
		$id=$_GET['id'];
		$result=$invest->delete($id);
		if($result!==false){
			$this->success2('删除成功！','__URL__/itemlist');
		}else{
			$this->error('删除失败！');
		}
	}
	public function getSubItem(){
		$invest=M('invest');
		$id=$_POST['id'];
		$sublist=$invest->where(array('parent_id'=>$id))->select();
		echo json_encode($sublist);
		exit();
	}
	public function saveItem(){
		$id=$_POST['t_id'];

		$t_name=$_POST['t_name'];
		$invest=M('invest');
		
		$result=$invest->data(array('t_name'=>$t_name))->where(array('id'=>$id))->save();
		if($result===false){
			$this->error('更新失败！');
			return;
		}

        //添加
        $parent_id = $id;
        $sub = $_POST['sub'];
        foreach($sub as $val){
            $sid = $invest->data(array('t_name'=>$val['name'],'parent_id'=>$parent_id, 'choice_mode'=>$val['choice_mode']))->add();
            foreach($val['item'] as $sval){
                $invest->data(array('t_name'=>$sval,'parent_id'=>$sid, 'choice_mode'=>0))->add();
            }
        }

        //更新
        $sub2 = $_POST['sub2'];
        foreach($sub2 as $sid=>$val){
            $invest->where(array('id'=>$sid))->save(array('t_name'=>$val['name'], 'choice_mode'=>$val['choice_mode']));

            foreach($val['item'] as $sk=>$sval){
                if(strpos($sk, 's')===0){
                    $invest->where(array('id'=>str_replace('s', '', $sk)))->save(array('t_name'=>$sval));
                }else{
                    $invest->data(array('t_name'=>$sval,'parent_id'=>$sid, 'choice_mode'=>0))->add();
                }
            }
        }

		$this->success('更新成功！','__URL__/index');
	}
	public function edit(){
		$id=$_GET['id'];
		$invest=M('invest');
		$plist=$invest->find($id);

		$list=$invest->where(array('parent_id'=>$id))->select();
		$this->assign('plist',$plist);

		$this->assign('list',$list);
		return $this->display('edit');
	}
	
	public function deleteSub(){
		$id=$_GET['id'];
		$invest=M('invest');
		$invest->startTrans();
		$result=$invest->delete($id);
		if($result===false){
			$this->error('删除败！');
			//$this->show('test');
			$invest->rollback();
			return ;
		}
		$result=$invest->where(array('parent_id'=>$id))->delete();
		if($result===false){
			$this->error('删除败！');
			//$this->show('test');
			$invest->rollback();
			return ;
		}
		$invest->commit();
		$this->success2('删除成功！','__URL__/edit');
	}
	/**
	 * 状态修改
	 */
	public function is_normal(){
		$db = M('nutrition_parent');
		$id = $_GET['id'];
		$data['enable_status'] = $_GET['is_normal'];
		
		$where['id'] = $id;
		
		if($db->where($where)->save($data)){
			$this->success2("设置成功", "__URL__/index");
		}else{
			$this->error("设置失败");
		}
	}
}