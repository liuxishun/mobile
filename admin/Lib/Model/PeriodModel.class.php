<?php
class PeriodModel extends RelationModel{
	protected $_link=array(
			'baby_indicator'=>array(
					'mapping_type'=>HAS_ONE,
					'class_name'=>'baby_indicator',
					'mapping_name'=>'baby_indicators',
					'foreign_key'=>'p_id'
			),
			'symptom'=>array(
					'mapping_type'=>HAS_MANY,
					'class_name'=>'symptom',
					'mapping_name'=>'symptoms',
					'foreign_key'=>'p_id',
			),
	);
}
?>