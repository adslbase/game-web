<?php

//标示程序从入口进入
define('INYCMS', 1);

define('YPATH_BASE', dirname(__FILE__));

require YPATH_BASE . '/libraries/ycms/defines.php';//定义。如果引入站点下的define.php 或者根目录下的。则使用它们。。否则使用ycms。让用户能够自定义前台和后台目录

require YPATH_YCMS . '/Ycms.php';

Ycms::getApplication('frontend')->run();
