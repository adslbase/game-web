<?php

// No direct access.
defined('INYCMS') or die;

define('DS', DIRECTORY_SEPARATOR);

$parts = explode(DS, YPATH_BASE);
//Defines.
define('YPATH_ROOT', implode(DS, $parts));

unset ($parts);

define('YPATH_COMMON', YPATH_ROOT . DS . 'common');
define('YPATH_BACKEND', YPATH_ROOT . DS . 'backend');
define('YPATH_FRONTEND', YPATH_ROOT . DS . 'frontend');
define('YPATH_LIBRARIES', YPATH_ROOT . DS . 'libraries');
define('YPATH_YCMS', YPATH_LIBRARIES . DS . 'ycms');
define('YPATH_YII', YPATH_LIBRARIES . DS . 'yii');
defined('YPATH_SITES') or define('YPATH_SITES', YPATH_ROOT . DS . 'sites');