<?php

        Yii::setPathOfAlias('frontend', FRONT_STORE);
        Yii::setPathOfAlias('backwidgets', BACK_WIDGETS);
        return CMap::mergeArray(
                                        require(COMMON_FOLDER . '/config.php'), array(
                                    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
                                    'name' => '后台',
                                    'defaultController' => 'besite',
                                    'import' => array(
                                                'backwidgets.*',
                                                'backwidgets.object.*',
                                                'frontend.protected.components.*'
                                    ),
                                    'components' => array(
                                                //Error Action when having Errors
                                                'errorHandler' => array(
                                                            // use 'site/error' action to display errors
                                                            'errorAction' => 'besite/error',
                                                ),
                                                //User Componenets                    
                                                'user' => array(
                                                            'allowAutoLogin' => true,
                                                            'loginUrl' => BACKEND_SITE_URL . '/besite/login',
                                                            'stateKeyPrefix' => 'system_user',
                                                ),
                                                // URL Format and Rewrite			
                                                'urlManager' => array(
                                                            'urlFormat' => 'path',
                                                            'showScriptName' => false,
                                                            'rules' => array(
                                                                        '<controller:\w+>/<id:\d+>' => '<controller>/index',
                                                                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                                                                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                                                            ),
                                                ),
                                    ),
                                    'modules' => array(
                                    ),
                                        )
        );







        