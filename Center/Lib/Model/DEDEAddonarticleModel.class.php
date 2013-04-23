<?php
class DEDEAddonarticleModel extends DEDEConfigModel {
	protected $trueTableName='glly_addonarticle';
	protected $pk = 'aid';	
   // 自动验证设置
    protected $_validate = array( 
    ); 
    // 自动填充设置 
    protected $_auto = array( 
        array('typeid','setdefualt0',1,'callback','typeid',1),  //栏目ID	//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('templet','setdefualtnone',1,'callback','templet',1),  //自定义模板	
        array('redirecturl','setdefualtnone',1,'callback','redirecturl',1),  //跳转URL	
        array('aid','setdefualt0',1,'callback','aid',1),  //文章ID		
        array('userip','setdefualtnone',1,'callback','userip',1),  //户用IP	
    ); 
	
	protected function setdefualt0($data) {
		if($data != '')
			return $data;
		else
			return 0;
	}
	protected function setdefualt1($data) {
		if($data != '')
			return $data;
		else
			return 1;
	}
	protected function setdefualtNULL($data) {
		if($data != '')
			return $data;
		else
			return NULL;
	}
	protected function setdefualtnone($data) {
		if($data != '')
			return $data;
		else
			return '';
	}

}
?>