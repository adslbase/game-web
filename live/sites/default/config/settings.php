<?php

    return array(
            'language' => 'zh_cn', //默认是sourceLanguage
            'timeZone' => 'Asia/Shanghai',
            // application components
            'components' => array(
                    //数据库连接
                    'db' => array(
                            'connectionString' => 'mysql:host=localhost;dbname=live',
                            'emulatePrepare' => true, //为真则会执行这句$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,true);
                            'username' => 'root',
                            'password' => '123456q',
                            'charset' => 'utf8',
                            'autoConnect' => FALSE, //默认打开，即使用该组件就会setActive(true)然后打开一个连接
                            'tablePrefix' => '',
                            'enableProfiling' => true, //启用性能报告
                            'enableParamLogging' => true, //我们可以在应用配置中设置 CDbConnection::enableParamLogging 为 true ，这样绑定在 SQL 语句中的参数值也会被记录。
//            'schemaCachingDuration' => 3600,//缓存
                    ),
                    'cache' => array(
                            'class' => 'system.caching.CDbCache',
                            'cacheTableName' => 'cache',
                            'connectionID' => 'db',
                    ),
                    //日志记录
                    'log' => array(
                            'class' => 'CLogRouter',
                            'routes' => array(
                                    //将信息保存到数据库的表中。
                                    array(
                                            'class' => 'CDbLogRoute',
                                            'connectionID' => 'db',
                                            'logTableName' => '{{log}}',
                                            'levels' => 'error, warning',
                                    ),
//                                    // 将 信息 显示在当前页面的底部。 
//                                    array(
//                                            'class' => 'CWebLogRoute',
//                                            'filter' => 'CLogFilter', //记录$_GET,$_SESSION等信息，
//                                    ),
//                                    array(//程序概要分析 - 报告概述 (时间: 0.10197 秒, 内存: 7,876KB)
//                                            'class' => 'CProfileLogRoute',
//                                    ),
                            ),
                    ),
            ),
    );