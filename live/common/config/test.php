<?php

Yii::setPathOfAlias('backendApp', YPATH_BACKEND);
Yii::setPathOfAlias('frontendApp', YPATH_FRONTEND);
return array(
    'basePath' => YPATH_BACKEND,
    'import' => array(
        'backendApp.models.*',
        'backendApp.components.*',
        'frontendApp.models.*',
        'frontendApp.components.*',
    ),
    'components' => array(
        'fixture' => array(
            'class' => 'system.test.CDbFixtureManager',
        ),
        //数据库连接
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=live-test',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'toplfx007',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'enableProfiling' => true,
            'enableParamLogging' => true, //我们可以在应用配置中设置 CDbConnection::enableParamLogging 为 true ，这样绑定在 SQL 语句中的参数值也会被记录。
        ),
    ),
);
