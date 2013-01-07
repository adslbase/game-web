<?php

Yii::setPathOfAlias('frontwidgets', FRONT_WIDGETS);
return CMap::mergeArray(
                require(COMMON_FOLDER . '/config.php'), array(
            'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
            'import' => array(
                'application.widgets.*',
            ),
            'components' => array(
                'urlManager' => array(
                    'urlFormat' => 'path',
                    'showScriptName' => false,
					'caseSensitive'=>false,
                    'urlSuffix'=>'.html',
                    'rules' => array(
                        '<controller:\w+>/<id:\d+>' => '<controller>/view',
						'http://op.marstv.com/<_a>'=>array('xxhzw/<_a>'),
                        '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                        '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                    ),
                ),
            ),
      )
);


