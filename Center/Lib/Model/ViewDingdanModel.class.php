<?php

class ViewDingdanModel extends RelationModel {
	protected $trueTableName = 'viewcenter_chanpin_dingdan';	
	protected $pk = 'chanpinID';	
	
	protected $_link = array(
		//dingdan
		'zituanlist'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Zituan','true_class_name'=>'viewcenter_chanpin_zituan','foreign_key'=>'parentID','parent_key'=>'chanpinID'),
	);
	

}
?>