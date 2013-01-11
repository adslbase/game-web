<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
Yii::setPathOfAlias('common', YPATH_COMMON);
return array(
    'basePath' => dirname(__FILE__)  . DIRECTORY_SEPARATOR . '..', //无默认值。这个需要设置，一般为protected目录
    'preload' => array('log'),
//    'behaviors' => array(),
//    'ModulePath'=>'',//默认$this->getBasePath().DIRECTORY_SEPARATOR.'modules';
    'name' => 'YCMS', //默认My Application
//    'charset' => 'utf-8', //默认UTF-8
//    'sourceLanguage' => 'zh_cn', //默认en_us，该属性是capplication的属性，会通过getLanguage赋值给_language..ycms的源语言
//    'id' => '', //默认sprintf('%x',crc32($this->getBasePath().$this->name))，应用id
//  'runtimePath' => '',//默认为$this->getBasePath().DIRECTORY_SEPARATOR.'runtime'
    'ExtensionPath' => YPATH_COMMON .DS. 'extensions', //默认为Yii::getPathOfAlias('ext')，会将这个值设置为ext别名
    'language' => 'zh_cn', //默认$this->_language===null ? $this->sourceLanguage : $this->_language;
    'timeZone' => 'Asia/Shanghai',
//    'LocaleDataPath'=> YPATH_COMMON.DS.'i18n',//默认为Yii::getPathOfAlias('system.i18n.data')，设置多语言文件路径
//    'defaultController' => 'site',//默认site
//    'layout' => 'main',//默认main
//    'controllerMap' => array(),//默认array()
//    'catchAllRequest' => array(//默认null，捕捉所有请求,常用于开发模式。所有请求。都转发到'offline/notice'路由，后面的值为参数
//        'offline/notice',
//        'param1' => 'value1',
//        'param2' => 'value2',
//    ),
//    'controllerPath' => '',//默认为$this->getBasePath().DIRECTORY_SEPARATOR.'controllers'
//    'viewPath' => '',//默认为$this->getBasePath().DIRECTORY_SEPARATOR.'views'
//    'systemViewPath' => '',//默认为$this->getViewPath().DIRECTORY_SEPARATOR.'system'
//    'layoutPath' => '',//默认为$this->getViewPath().DIRECTORY_SEPARATOR.'layouts'
//    'controller' => '',//默认没有设置，没啥特殊用处
//    'homeUrl' => '',//默认$this->getRequest()->getScriptUrl()
//    'theme' => '',//默认为空
// autoloading model and component classes
    'aliases' => array(
        'models' => 'application.models', // an existing alias
        'extensions' => 'application.extensions', // an existing alias
        'backend' => dirname(__FILE__)  . '/../backend', // a directory
    ),
    'import' => array(
        'common.models.*',
        'common.components.*',
    ),
    'modules' => array(),
    // application components
    'components' => array(
        'hook' => array(
            'class' => 'ycms.event.yhook',
        ),
        'user' => array(
             //允许自动登录，开启后会把登录信息储存到cookie
            'allowAutoLogin' => true,
        ),
        //URL管理
        'urlManager' => array(
            'urlFormat' => 'get',
            'showScriptName' => TRUE, //显示脚本名
            'routeVar' => 'q',
            'rules' => array(
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        //数据库连接
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=ycms',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'toplfx007',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'enableProfiling' => true,
            'enableParamLogging' => true, //我们可以在应用配置中设置 CDbConnection::enableParamLogging 为 true ，这样绑定在 SQL 语句中的参数值也会被记录。
        ),
        //session保存到数据库
        'session' => array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'sessionTableName' => 'session',
        ),
        //验证与授权
        'authManager' => array(
            'class' => 'CDbAuthManager',
            'connectionID' => 'db',
            'defaultRoles' => array('authenticated', 'guest'),
            'itemTable' => 'AuthItem',
            'itemChildTable' => 'AuthItemChild',
            'assignmentTable' => 'AuthAssignment',
        ),
        'cache' => array(
            'class' => 'CFileCache',
        ),
        //使用文件存储缓存数据。这个特别适合用于存储大块数据
        'FileCache' => array(
            'class' => 'CFileCache',
        ),
        //使用一个数据表存储缓存数据
        'Dbcache' => array(
            'class' => 'CDbCache',
            'connectionID' => 'db',
            'cacheTableName' => 'cache',
        ),
        //日志记录
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                //将信息保存到数据库的表中。
                array(
                    'class' => 'CDbLogRoute',
                    'connectionID' => 'db',
                    'logTableName' => 'log',
                    'levels' => 'error, warning',
                ),
                //保存信息到应用程序 runtime 目录中的一个文件中。
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                // 将 信息 显示在当前页面的底部。 
                array(
                    'class' => 'CWebLogRoute',
                //'filter'=>'CLogFilter',//记录$_GET,$_SESSION等信息，
                ),
                //在页面的底部显示概述（profiling）信息。
                array(
                    'class' => 'CProfileLogRoute',
                    'levels' => 'error, warning',
                )
            ),
        ),
        'errorHandler' => array(
// use 'site/error' action to display errors
            'errorAction' => 'site/error',
            'adminInfo' => 'lifeixiang@yeah.net',
        ),
//        'clientScript' => array(
//            'packages' => array(
//                'ycms' => array(
//                    'basePath' => 'webroot.style',
//                    'js' => array('js/jquery.yiiactiveform.js', 'js/jquery.js'),
//                ),
//            ),
//            'scriptMap' => array(
//                'jquery.js' => '/js/all.js',
//                'jquery.ajaxqueue.js' => '/js/all.js',
//                'jquery.cookie.js' => '/js/all.js',
//            ),
//        ),
        /* //模板引擎
          'viewRenderer'=>array(
          'class'=>'CPradoViewRenderer',
          ),
         * 
         * 
         */

//安全配置  http://www.yiiframework.com/doc/guide/1.1/zh_cn/topics.security
        'request' => array(
            'enableCsrfValidation' => true,
            'csrfTokenName' => 'YCMS_CSRF_TOKEN',
            'enableCookieValidation' => true,
        ),
    ),
    // application-level parameters that can be accessed
// using Yii::app()->params['paramName']
    'params' => require(YPATH_COMMON . '/config/params.php'),
);