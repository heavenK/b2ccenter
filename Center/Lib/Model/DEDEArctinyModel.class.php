<?php
class DEDEArctinyModel extends DEDEConfigModel {
	protected $trueTableName='glly_arctiny';
	protected $pk = 'id';	

   // 自动验证设置
    protected $_validate = array( 
        array('mid', 'require', 'mid不能为空！', 1,'',1), //会员ID	
    ); 
    // 自动填充设置 
    protected $_auto = array( 
        array('typeid2','setdefualt0',1,'callback','typeid2',1),  //副栏目ID//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('typeid','setdefualt0',1,'callback','typeid',1),  //主栏目ID	
        array('sortrank','setdefualt0',1,'callback','sortrank',1),  //文档排序	
        array('senddate',time,1,'function'),  //投稿日期		
        array('channel','setdefualt1',1,'callback','channel',1),  //频道类型	
        array('arcrank','setdefualt0',1,'callback','arcrank',1),  //文档权限	
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
	
}
?>