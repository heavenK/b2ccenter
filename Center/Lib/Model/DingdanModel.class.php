<?php

class DingdanModel extends RelationModel {
	protected $trueTableName = 'center_userdata_dingdan';	
	protected $pk = 'userdataID';
   // 自动验证设置 
    protected $_validate = array( 
//        array('title_copy', 'require', 'title_copy不能为空！', 1,'',1), 
//        array('guojing_copy', 'require', 'guojing_copy不能为空！', 1,'',1), 
//        array('kind_copy', 'require', 'kind_copy不能为空！', 1,'',1), 
    ); 
    // 自动填充设置 
    protected $_auto = array( 
    ); 
	
	protected $_link = array(
		//zituan
//		'shoujialist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'myerpview_chanpin_shoujia','foreign_key'=>'parentID'),
//		'xianlulist'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Xianlu','true_class_name'=>'myerpview_chanpin_xianlu','foreign_key'=>'parentID','parent_key'=>'chanpinID'),
//		'xingcheng'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Xingcheng','foreign_key'=>'chanpinID','parent_key'=>'parentID'),
//		'chengben'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Chengben','foreign_key'=>'chanpinID','parent_key'=>'parentID'),
//		'dingdanlist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'myerpview_chanpin_dingdan','foreign_key'=>'parentID'),
	);
}
?>