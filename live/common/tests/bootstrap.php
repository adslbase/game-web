<?php
// Set flag that this is a parent file
define('INYCMS', 1);

define('PHP_UNIT', 1);

define('YPATH_BASE', dirname(dirname(dirname(__FILE__))));
error_reporting(0);
require_once YPATH_BASE . '/libraries/ycms/defines.php';
require_once YPATH_YII.'/yiit.php';
require_once YPATH_YCMS . '/Ycms.php';


$config =  YPATH_COMMON . '/config/test.php';
require_once dirname(__FILE__) .'/WebTestCase.php' ;


Ycms::registerAutoloader(array('Ycms', 'autoload'));

Ycms::createWebApplication($config);

