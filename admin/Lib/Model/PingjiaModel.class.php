<?php
class PingjiaModel extends RelationModel{
	protected $_link=array(
		
			'pingjia_pic'=>array(
					'mapping_type'=>HAS_MANY,
					'class_name'=>'pingjia_pic',
					'mapping_name'=>'pingjia_pics',
					'foreign_key'=>'p_id',
			),
			
			
	);
}
?>