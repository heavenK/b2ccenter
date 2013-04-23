<?php

class ViewXianluModel extends RelationModel {
	protected $trueTableName = 'viewcenter_chanpin_xianlu';	
	protected $pk = 'chanpinID';	
	
	protected $_link = array(
		//xianlu
		'xianlu'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Xianlu','foreign_key'=>'chanpinID'),
		'zituanlist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_zituan','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
		'shoujialist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_shoujia','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
		'xingchenglist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_xingcheng','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
		'chengben'=>array('mapping_type'=>HAS_MANY,'class_name'=>'Chengben','foreign_key'=>'chanpinID','condition'=>"`status_system` = '1'"),
//		//zituan
		'xianlulist'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Xianlu','true_class_name'=>'viewcenter_chanpin_xianlu','foreign_key'=>'parentID','parent_key'=>'chanpinID'),
		'zituan'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Zituan','foreign_key'=>'chanpinID'),
		'dingdanlist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_dingdan','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
		'fenfanglist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_fenfang','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
		'tdbzdlist'=>array('mapping_type'=>HAS_ONE,'class_name'=>'ViewBaozhang','foreign_key'=>'parentID','condition'=>"`status_system` = '1' and `type` = '团队报账单'"),
//		//shoujia
		'shoujia'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Shoujia','foreign_key'=>'chanpinID'),
//		//chengbenlist
		'chengbenlist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_chengben','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
//		//xingcheng
		'xingcheng'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Xingcheng','foreign_key'=>'chanpinID'),
//		//dingdan
		'dingdan'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Dingdan','foreign_key'=>'chanpinID'),
		'chanpinparentlist'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Chanpin','true_class_name'=>'myerp_chanpin','foreign_key'=>'parentID','parent_key'=>'chanpinID'),
	);

}
?>