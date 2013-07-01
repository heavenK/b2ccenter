<?php

class ChanpinModel extends RelationModel {
	protected $trueTableName = 'center_chanpin';	
	protected $pk = 'chanpinID';	
	
   // 自动验证设置
    protected $_validate = array( 
    ); 
    // 自动填充设置 
    protected $_auto = array( 
        array('status', 'set_status', 1,'callback','status,parentID',1),//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('time', 'set_time', 1,'callback','time',1),//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('marktype', 'set_marktype', 1,'callback'),//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('islock', 'set_islock', 1,'callback','islock',1),//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('status_system', 'set_status_system', 1,'callback','status_system',1),//1正常,-1删除
    ); 
	
	protected function set_status($status,$parentID) {
		if($status != '')	
			return $status;
		else
			return '准备';
	}
	
	protected function set_islock($islock) {
		if($islock != '')	
			return $islock;
		else
			return '未锁定';
	}
	
	protected function set_status_system($status_system) {//1正常,-1删除
		if($status_system != '')	
			return $status_system;
		else
			return 1;
	}
	
	protected function set_time($time) {
		if($time != '')	
			return $time;
		else
			return time();
	}
	
	protected function set_marktype() {
		$options = $this->getRelationOptions();
		return $options;
	}
	
	protected $_link = array(
		//xianlu
		'xianlu'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Xianlu','foreign_key'=>'chanpinID'),
		'zituanlist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_zituan','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
//		//zituan
		'xianlulist'=>array('mapping_type'=>BELONGS_TO,'class_name'=>'Xianlu','true_class_name'=>'viewcenter_chanpin_xianlu','foreign_key'=>'parentID','parent_key'=>'chanpinID'),
		'zituan'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Zituan','foreign_key'=>'chanpinID'),
		'dingdanlist'=>array('mapping_type'=>HAS_MANY,'class_name'=>'viewcenter_chanpin_dingdan','foreign_key'=>'parentID','condition'=>"`status_system` = '1'"),
//		//dingdan
		'dingdan'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Dingdan','foreign_key'=>'chanpinID'),
		//qianzheng
		'qianzheng'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Qianzheng','foreign_key'=>'chanpinID'),
		
		
	);
	

}
?>