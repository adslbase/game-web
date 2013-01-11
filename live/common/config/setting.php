<?php

    return array(
            'preload' => array('log'),
            'sourceLanguage' => 'zh_cn',
            'runtimePath' => dirname(dirname(__FILE__)) . DS . 'runtime',
            'components' => array(
                    //session保存到数据库
                    'session' => array(
                            'class' => 'CDbHttpSession',
                            'connectionID' => 'db',
                            'sessionTableName' => 'session',
                            'Timeout' => 200000,
                            'GCProbability' => 1,
                            'CookieMode' => 'only',
                            'UseTransparentSessionID' => 0,
                    ),
                    'user' => array(
                            'class' => 'ycms.web.auth.YWebUser',
                            'allowAutoLogin' => true,
                            'guestName' => Ycms::t('user', '游客')//使用getName才能使用这个属性
                    ),
                    'errorHandler' => array(
                            // use 'site/error' action to display errors
                            'errorAction' => 'site/error',
                            'adminInfo' => 'lifx@neotv.cn',
                    ),
                    'format' => array(
                            'class' => 'ycms.util.YFormatter',
                    ),
                    'assetManager' => array(
                            'class' => 'ycms.web.YAssetManager',
                            'onlyDir' => 'dynamics'
                    ),
                    //URL管理
                    'urlManager' => array(
                            'routeVar' => 'q',
                    ),
                    //安全配置  http://www.yiiframework.com/doc/guide/1.1/zh_cn/topics.security
                    'request' => array(
                            'enableCsrfValidation' => true,
                            'csrfTokenName' => 'YCMS_CSRF_TOKEN',
                            'enableCookieValidation' => true, //会在runtime文件夹下生成state.bin存储Yii.CSecurityManager.validationkey---把他保存到数据库
                    ),
            ),
            'error_reporting' => 2047,
    );