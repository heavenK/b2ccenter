<?php

class UserDataModel extends RelationModel {
	protected $trueTableName = 'center_userdata';	
	protected $pk = 'userdataID';	
	
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
		//dingdan
		'dingdan'=>array('mapping_type'=>HAS_ONE,'class_name'=>'Dingdan','foreign_key'=>'chanpinID'),
	);
	

}
?>