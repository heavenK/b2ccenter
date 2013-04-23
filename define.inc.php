<?php

    // global config
    define('ET_URL','http://'.$_SERVER['HTTP_HOST'].'/');
    define('SITE_INDEX',ET_URL.'index.php?s=/');
    define('SITE_DATA',ET_URL.'Data/');
	
    define('LOGIN_TIME_REMEMBER', 3600 * 24 * 30);
    define('LOGIN_TIME', 3600 * 6);
    define('LOGIN_TIME_FAILE', 60 * 10);
	
	//线路主栏目ID
    define('XIANLU_TYPEID', 14);
	//线路频道模型ID
    define('XIANLU_CHANNEL', 18);
	//线路附表ID
    define('XIANLU_ADDONARTICLE', 'glly_addonarticle18');
//	//商品子团栏目ID
//    define('ZITUAN_TYPEID', 25);
//	//商品子团频道模型ID
//    define('ZITUAN_CHANNEL', 19);
//	//商品子团附表ID
//    define('ZITUAN_ADDONARTICLE', 'glly_addonshop19');
?>