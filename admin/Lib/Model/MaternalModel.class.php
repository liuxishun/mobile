<?php
class MaternalModel extends RelationModel{
	protected $_link=array(
			'maternal_info'=>array(
				'mapping_type'=>HAS_ONE,
					'class_name'=>'maternal_info',
					'mapping_name'=>'maternal_infos',
					'foreign_key'=>'m_id'
				),
			'maternal_physical_condition'=>array(
					'mapping_type'=>HAS_ONE,
					'class_name'=>'maternal_physical_condition',
					'mapping_name'=>'maternal_physical_conditions',
					'foreign_key'=>'m_id'
			),
			'baby_baseinfo'=>array(
					'mapping_type'=>HAS_MANY,
					'class_name'=>'baby_baseinfo',
					'mapping_name'=>'baby_baseinfos',
					'foreign_key'=>'m_id'
			),
	);
	protected $_validate=array(
		array('m_name','require','姓名不能为空!'),
		array('m_profession','require','职业不能为空!'),
		array('m_contact_number','require','联系电话不能为空!'),
		array('m_birthday','require','请选择出生日期!'),
		array('m_address','require','请填写通讯地址!'),
		array('m_blood_pressure','require','请填写血压指数!'),
		array('m_before_pregnant_weight','require','请填写孕前体重!'),
		array('m_before_birth_weight','require','请填写产前体重!'),
		array('m_current_weight','require','请填写目前体重!'),
		array('m_name','','帐号名称已经存在！',0,'unique',1),
		array('baby_weight','checkWeight','请填写您的宝宝出生体重！',0,'function',1),
	);
	protected function checkWeight($baby_weight){
		if(!$baby_weight){
			return false;
		}
		$baby_weights=explode(',', $baby_weight);
		for($i=0;$i<count($baby_weights);$i++){
			if(!$baby_weights[$i]){
				return false;
			}
		}
		return true;
	}
}
?>