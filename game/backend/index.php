<?php

// remove the following lines when in production mode
//defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
//defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

// Set the constant for the FRONT_STORE Directory
// Don't change if you are not sure

//You need to specify the path to CORE FOLDER CORRECTLY

define('COMMON_FOLDER',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'common');

define('RESOURCES_FOLDER',COMMON_FOLDER.DIRECTORY_SEPARATOR.'resources');

define('FRONT_STORE',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'frontend');

define('BACK_STORE',dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'backend');

define('BACK_WIDGETS',BACK_STORE.DIRECTORY_SEPARATOR.'protected'.DIRECTORY_SEPARATOR.'widgets');

define('YII_DEBUG', 1);

// change the following paths if necessary
$yii=COMMON_FOLDER.'/yii/framework/yii.php';
$globals=COMMON_FOLDER.'/globals.php';
$define=COMMON_FOLDER.'/define.php';
$config=BACK_STORE.'/protected/config/main.php';


require_once($yii);
require_once($globals);
require_once($define);


Yii::createWebApplication($config)->run();



