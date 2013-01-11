<?php
//标示程序从入口进入
define('INYCMS', 1);

define('YPATH_BASE', dirname(__FILE__));

require YPATH_BASE . '/libraries/ycms/defines.php';

require YPATH_YCMS . '/Ycms.php';

Ycms::getApplication('backend')->run();
