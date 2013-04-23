<?php
class DEDEArchivesModel extends DEDEConfigModel {
	protected $trueTableName='glly_archives';
	protected $pk = 'id';	
   // 自动验证设置
    protected $_validate = array( 
    ); 
    // 自动填充设置 
    protected $_auto = array( 
        array('typeid2','setdefualt0',1,'callback','typeid2',1),  //副栏目ID//array('field','填充内容','填充条件','附加规则',[额外参数],[表单数据标记])
        array('dutyadmin','setdefualt0',1,'callback','dutyadmin',1),  //负责审核管理员的ID	
        array('lastpost','setdefualt0',1,'callback','lastpost',1),  //最后回复	
        array('pubdate','setdefualt0',1,'callback','pubdate',1),  //发布日期		
        array('color','setdefualtnone',1,'callback','color',1),  //标题颜色		
        array('money','setdefualt0',1,'callback','money',1),  //需要消耗金币		
        array('weight','setdefualt0',1,'callback','weight',1),  //权重		
        array('ismake','setdefualt0',1,'callback','ismake',1),  //是否生成HTML		
        array('flag','setdefualtNULL',1,'callback','flag',1),  //属性		
        array('litpic','setdefualtnone',1,'callback','dutyadmin',1),  //缩略图		
        array('scores','setdefualt0',1,'callback','scores',1),  //消耗积分		
        array('keywords','setdefualtnone',1,'callback','keywords',1),  //文档关键词		
        array('mtype','setdefualt0',1,'callback','mtype',1),  //自定义类别		
        array('filename','setdefualtnone',1,'callback','filename',1),  //自定义文件名		
        array('click','setdefualt0',1,'callback','click',1),  //点击次数		
        array('typeid','setdefualt0',1,'callback','typeid',1),  //文档排序		
        array('goodpost','setdefualt0',1,'callback','goodpost',1),  //好评		
        array('typeid','setdefualt0',1,'callback','typeid',1),  //栏目ID		
        array('shorttitle','setdefualtnone',1,'callback','shorttitle',1),  //短标题		
        array('tackid','setdefualt0',1,'callback','tackid',1),  //??	
        array('title','setdefualtnone',1,'callback','title',1),  //文档标题		
        array('description','setdefualtnone',1,'callback','description',1),  //描述		
        array('writer','setdefualtnone',1,'callback','writer',1),  //作者		
        array('mid','setdefualt0',1,'callback','mid',1),  //会员ID		
        array('id','setdefualt0',1,'callback','id',1),  //内容ID			
        array('badpost','setdefualt0',1,'callback','badpost',1),  //差评		
        array('source','setdefualtnone',1,'callback','source',1),  //来源	
        array('senddate',time,1,'function'),  //投稿日期		
        array('notpost','setdefualt0',1,'callback','notpost',1),  //不允许回复		
        array('arcrank','setdefualt0',1,'callback','arcrank',1),  //浏览权限		
        array('channel','setdefualt1',1,'callback','channel',1),  //频道模型		
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