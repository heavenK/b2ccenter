<?php

class QianzhengModel extends Model {
	protected $trueTableName = 'center_chanpin_qianzheng';	
	
   // 自动验证设置 
    protected $_validate = array( 
        array('title', 'require', 'title不能为空！', 1,'',1), 
    ); 
    // 自动填充设置 
    protected $_auto = array( 
    ); 



}
?>