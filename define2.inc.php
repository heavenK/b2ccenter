<?php
	//全局
    define('ROOT_URL','http://www.'.SITE_ROOT_NAME.'.com/');
	//常用定义
    define('SERVER_INDEX',SERVER_URL.'index.php?s=/');
    define('CLIENT_INDEX',CLIENT_URL.'index.php?s=/');
    define('WEB_INDEX',WEB_URL.'index.php?s=/');
    define('SITE_INDEX',ET_URL.'index.php?s=/');
    define('SITE_DATA',ET_URL.'Data/');
	//
    define('LOGIN_TIME_REMEMBER', 3600 * 24 * 30);
    define('LOGIN_TIME', 3600 * 6);
    define('LOGIN_TIME_FAILE', 60 * 10);
	
	//参团游线路主栏目ID
    define('A_XIANLU_TYPEID', 17);
	//参团游线路频道模型ID
    define('A_XIANLU_CHANNEL', 7);
	//参团游线路附表ID
    define('A_XIANLU_ADDONARTICLE', 'cty_addon7');
	
	//自由行线路主栏目ID
    define('B_XIANLU_TYPEID', 18);
	//自由行线路频道模型ID
    define('B_XIANLU_CHANNEL', 7);
	
	//签证主栏目ID
    define('A_QIANZHENG_TYPEID', 34);
	//签证频道模型ID
    define('A_QIANZHENG_CHANNEL', 9);
	//签证附表ID
    define('A_QIANZHENG_ADDONARTICLE', 'glly_qianzheng');
	
//	//商品子团栏目ID
//    define('ZITUAN_TYPEID', 25);
//	//商品子团频道模型ID
//    define('ZITUAN_CHANNEL', 19);
//	//商品子团附表ID
//    define('ZITUAN_ADDONARTICLE', 'glly_addonshop19');

?>