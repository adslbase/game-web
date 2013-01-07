<?php
Yii::app()->setTimeZone(APP_TIMEZONE);
Yii::setPathOfAlias('common', COMMON_FOLDER);
return array(
    'id' => SITE_NAME,
    //Edit more information for your site here
    'name' => SITE_NAME,
    'language' => 'zh_cn',
    // autoloading model and component classes
    // autoloading from the CMS and Common Folder
    'import' => array(
        'application.models.*',
        'application.components.*',
        //Import 模型
        'common.models.*',
        'common.models.object.*',
        'common.models.page.*',
        'common.models.pay.*',
        'common.models.resource.*',
        'common.models.settings.*',
        'common.models.user.*',
        //Import Common Classes                    
        'common.components.*',
        'common.components.user.*',
        'common.storages.*',
		'common.payway.*',
        //Import rights Classes     
        'common.modules.rights.*',
        'common.modules.rights.components.*',
    ),
    'modules' => array(
        //Modules Rights
        'rights' => array(
            'class' => 'common.modules.rights.RightsModule',
            'install' => false, // Enables the installer.
            'appLayout' => 'application.views.layouts.main',
            'superuserName' => 'Admin',
        ),
    ),
    // application components
    'components' => array(
        //Edit your Database Connection here	
        //Use MySQL database		
        'db' => array(
            'connectionString' => 'mysql:host=database.marstv.com;dbname=game',
            'schemaCachingDuration' => 3600,
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => 'f2j1v1L2FD',
            'charset' => 'utf8',
            'tablePrefix' => 'gxc_',
            'enableProfiling' => false, //启用性能报告
            'enableParamLogging' => false, //我们可以在应用配置中设置 CDbConnection::enableParamLogging 为 true ，这样绑定在 SQL 语句中的参数值也会被记录。
        ),
        //User Componenets
        'user' => array(
            'class' => 'GxcUser',
            'allowAutoLogin' => true,
            'loginUrl' => FRONT_SITE_URL . '/sign/in',
            'stateKeyPrefix' => 'system_user',
			'identityCookie' => array('domain' => '.marstv.com'),
        ),
        'mail' => array(
            'class' => 'common.extensions.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'viewPath' => '',
        ),
        //Auth Manager
        'authManager' => array(
            'class' => 'RDbAuthManager',
            'defaultRoles' => array('Guest', 'Authenticated')
        ),
        //Use Cache System by File
        'cache' => array(
            'class' => 'system.caching.CFileCache',
        ),
        //Use the Settings Extension and Store value in Database
        'settings' => array(
            'class' => 'common.extensions.settings.CmsSettings',
            'cacheId' => 'global_website_settings',
            'cacheTime' => 84000,
        ),
        //Use Session Handle in Database
        'session' => array(
            'class' => 'CDbHttpSession',
            'connectionID' => 'db',
            'autoCreateSessionTable' => true,
            'sessionTableName' => 'gxc_session',
			'cookieParams' => array('domain' => '.marstv.com'),
        ),
        //Error Action when having Errors
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),

        //Enable Cookie Validation and Csrf Validation
        'request' => array(
            'class' => 'HttpRequest',
            'enableCookieValidation' => true,
            'enableCsrfValidation' => true,
              'noCsrfValidationRoutes' => array('site/caching','order/return','order/notify','order/test')
        ),
    ),
    'params' => array(
    ),
);