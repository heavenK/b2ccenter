<?php
define('IN_ET', TRUE);
require('./define.inc.php');
require('./define2.inc.php');

define('ET_ROOT', dirname(__FILE__));
define('MODE_NAME','mycore');
define('THINK_PATH','./ThinkPHP/');
define('APP_NAME', 'Center');
define('APP_PATH', './Center/');
define('DEFAULT_TYPE','default');
define('__PUBLIC__',ET_URL."Public");
define('SITE_URL',ET_URL);
define('APP_DEBUG', true);

require(APP_PATH.'Common/Function.php');
require(APP_PATH.'Common/MyFunction.php');
require(APP_PATH.'Common/FusionCharts.php');
require(APP_PATH.'Common/NewFunction.php');
require(APP_PATH.'Common/B2CFunction.php');

require(THINK_PATH.'ThinkPHP.php');

?>