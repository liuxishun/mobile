<?php
class MaternalAction extends BaseAction{

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
		$param['m_name']=$this->_get('m_name');
		if($param['m_name']){
			$condition .= " AND m_name like '%". $param['m_name'] ."%'";
		}
		$this->assign('para', $param);
		$maternal=D('Maternal');
		$result=$maternal->where($condition)->limit($pagesize)->page($page)->select();
		$count=$maternal->where($condition)->count();
		$this->assign('list',$result);
		$this->assign('pager', array(
				'pageSize' => $pagesize,
				'count' => $count,
				'currentPage' => $count==0? 0 : $page,
				'pageCount' => ceil($count/$pagesize),
		));
		return $this->display("maternal");
	}
	public function delete(){
		$id=$_REQUEST['id'];
		$maternal=D('Maternal');
		$ids=explode(',', $id);
		$maternal->startTrans();
		$result=0;
		for($i=0;$i<count($ids);$i++){
			$result=$maternal->relation(true)->delete($ids[$i]);
			if($result===false){
				break;
			}
		}
		if($result!==false){
			$maternal->commit();
			return $this->success2("删除成功", "__URL__/index");
		}else{
			$REFERER = $this->_SERVER('HTTP_REFERER');
			$maternal->rollback();
			return $this->error ( "删除失败！", $REFERER );
		}
		
	}
	public function add(){
		$this->display('add');
	}
	public function saveItem(){
		$maternal=D('Maternal');
		if($maternal->create()){
		$baby_weights=explode(',', $_POST['baby_weight']);
		$baby_heights=explode(',', $_POST['baby_height']);
		$baby_icteruss=explode(',', $_POST['baby_icterus']);
		$baby_feed_types=explode(',', $_POST['baby_feed_type']);
		$baby_take_yikexins=explode(',', $_POST['baby_take_yikexin']);
		$data['m_name']=$_POST['m_name'];
		$data['m_birthday']=$_POST['m_birthday'];
		$data['m_age']=$_POST['m_age'];
		$data['m_edu_degree']=$_POST['m_edu_degree'];
		$data['m_profession']=$_POST['m_profession'];
		$data['m_nation']=$_POST['m_nation'];
		$data['m_address']=$_POST['m_address'];
		$data['m_contact_number']=$_POST['m_contact_number'];
		$data['area_ids']=$_POST['area_ids'];
		$data['m_head_pic']=$_POST['m_head_pic'];
		$data['maternal_infos']=array(
				'm_height'=>$_POST['m_height'],
				'm_birth_date'=>$_POST['m_birth_date'],
				'm_blood_pressure'=>$_POST['m_blood_pressure'],
				'm_before_pregnant_weight'=>$_POST['m_before_pregnant_weight'],
				'm_before_birth_weight'=>$_POST['m_before_birth_weight'],
				'm_current_weight'=>$_POST['m_current_weight'],
				'm_deliver'=>$_POST['m_deliver'],
				'm_suffer_sick'=>$_POST['m_suffer_sick'],
				'm_medicine_history'=>$_POST['m_medicine_history'],
				'm_sensitive_history'=>$_POST['m_sensitive_history'],
				'm_take_supply'=>$_POST['m_take_supply'],
		);
		$data['maternal_physical_conditions']=array(
				'm_breast_excret'=>$_POST['m_breast_excret'],
				'm_mastitis'=>$_POST['m_mastitis'],
				'm_bleed'=>$_POST['m_bleed'],
				'm_puerperal'=>$_POST['m_puerperal'],
				'm_edema'=>$_POST['m_edema'],
				'm_thirsty'=>$_POST['m_thirsty'],
				'm_lochia'=>$_POST['m_lochia'],
				'm_chap'=>$_POST['m_chap'],
				'm_constipation'=>$_POST['m_constipation'],
				'm_urine'=>$_POST['m_urine'],
		);
		for($i=0;$i<count($baby_heights);$i++){
			$data['baby_baseinfos'][$i]=array(
					'baby_weight'=>$baby_weights[$i],
					'baby_height'=>$baby_heights[$i],
					'baby_icterus'=>$baby_icteruss[$i],
					'baby_feed_type'=>$baby_feed_types[$i],
					'baby_take_yikexin'=>$baby_take_yikexins[$i],
			);
		}
		$maternal->startTrans();
		$result=$maternal->relation(true)->add($data);
		if($result!==false){
			$maternal->commit();
			//$this->show('test');
			$this->success("更新成功","__URL__/index");
		}else{
			$REFERER = $this->_SERVER('HTTP_REFERER');
			$maternal->rollback();
			$this->error ( "更新失败！", $REFERER );
		}
		}else{
			$this->error($maternal->getError());
		}
		//$this->success2('test');
	}
	public function edit(){
		$id=$_GET['id'];
		$maternal=D('Maternal');
		$list=$maternal->relation(true)->where(array('id'=>$id))->select();
		$this->assign('maternal',$list);
		return $this->display('edit');
	}
	public function save(){
			$maternal=D('Maternal');
			$id=$_POST['id'];
			$baby_id=$_POST['baby_id'];
			$baby_ids=explode(',', $baby_id);
			$baby_weights=explode(',', $_POST['baby_weight']);
			$baby_heights=explode(',', $_POST['baby_height']);
			$baby_icteruss=explode(',', $_POST['baby_icterus']);
			$baby_feed_types=explode(',', $_POST['baby_feed_type']);
			$baby_take_yikexins=explode(',', $_POST['baby_take_yikexin']);
			$data['m_name']=$_POST['m_name'];
			$data['m_birthday']=$_POST['m_birthday'];
			$data['m_age']=$_POST['m_age'];
			$data['m_edu_degree']=$_POST['m_edu_degree'];
			$data['m_profession']=$_POST['m_profession'];
			$data['m_nation']=$_POST['m_nation'];
			$data['m_address']=$_POST['m_address'];
			$data['m_contact_number']=$_POST['m_contact_number'];
			$data['area_ids']=$_POST['area_ids'];
			$data['m_head_pic']=$_POST['m_head_pic'];
			$data['maternal_infos']=array(
				'm_height'=>$_POST['m_height'],
				'm_birth_date'=>$_POST['m_birth_date'],
				'm_blood_pressure'=>$_POST['m_blood_pressure'],
				'm_before_pregnant_weight'=>$_POST['m_before_pregnant_weight'],
				'm_before_birth_weight'=>$_POST['m_before_birth_weight'],
				'm_current_weight'=>$_POST['m_current_weight'],
				'm_deliver'=>$_POST['m_deliver'],
				'm_suffer_sick'=>$_POST['m_suffer_sick'],
				'm_medicine_history'=>$_POST['m_medicine_history'],
				'm_sensitive_history'=>$_POST['m_sensitive_history'],
				'm_take_supply'=>$_POST['m_take_supply'],
			);
			$data['maternal_physical_conditions']=array(
					'm_breast_excret'=>$_POST['m_breast_excret'],
					'm_mastitis'=>$_POST['m_mastitis'],
					'm_bleed'=>$_POST['m_bleed'],
					'm_puerperal'=>$_POST['m_puerperal'],
					'm_edema'=>$_POST['m_edema'],
					'm_thirsty'=>$_POST['m_thirsty'],
					'm_lochia'=>$_POST['m_lochia'],
					'm_chap'=>$_POST['m_chap'],
					'm_constipation'=>$_POST['m_constipation'],
					'm_urine'=>$_POST['m_urine'],
			);
			for($i=0;$i<count($baby_ids);$i++){
				$data['baby_baseinfos'][$i]=array(
					'id'=>$baby_ids[$i],
					'baby_weight'=>$baby_weights[$i],
					'baby_height'=>$baby_heights[$i],
					'baby_icterus'=>$baby_icteruss[$i],
					'baby_feed_type'=>$baby_feed_types[$i],
					'baby_take_yikexin'=>$baby_take_yikexins[$i],
				);
			}
			$maternal->startTrans();
			
			if(count($baby_weights)>count($baby_ids)){
				for($i=count($baby_ids);$i<count($baby_weights);$i++){
					$data['baby_baseinfos'][$i]=array(
							'baby_weight'=>$baby_weights[$i],
							'baby_height'=>$baby_heights[$i],
							'baby_icterus'=>$baby_icteruss[$i],
							'baby_feed_type'=>$baby_feed_types[$i],
							'baby_take_yikexin'=>$baby_take_yikexins[$i],
					);
				}
			}
			$result=$maternal->relation(true)->where(array('id'=>$id))->save($data);
			if($result!==false){
				$maternal->commit();
				//$this->show('test');
				$this->success("更新成功");
			}else{
				$REFERER = $this->_SERVER('HTTP_REFERER');
				$maternal->rollback();
				$this->error ( "更新失败！", $REFERER );
			}
			//
	}
	public function deleteChildItem(){
		$_id=$_GET['id'];
		$maternal=M('baby_baseinfo');
		$result=$maternal->delete($_id);
		if($result!==false){
			//$this->show('test');
			$this->success2("删除成功");
		}else{
			$REFERER = $this->_SERVER('HTTP_REFERER');
				$this->error ( "删除失败！", $REFERER );
		}
		//$id=$_GET['pid'];
		
	}

	

}