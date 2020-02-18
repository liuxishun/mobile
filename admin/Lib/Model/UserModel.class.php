<?php
class UserModel extends Model {
	public function validate_tel($data){
		
		$dn=M('member');
		$data=$dn->where("mobile=$data")->find();
		return $data;	
	}

	public function validate($data){
		$dn=M('member');
		$mobile=$data['DengLuUserName'];
		$password=$data['Denglupassword'];
		$data=$dn->where("mobile=".$mobile)->find();
		return $data;
	}
	//健康首页
	public function healthhome($data){
		$dn=M("baby_indicator");
		$field="indicator_height,indicator_weight,indicator_baby_desc";
		$res=$dn->where("p_id='".$data['healthweeknumber']."'")->field($field)->find();
		
		
		return $res;
	}
}