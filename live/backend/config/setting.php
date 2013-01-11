<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array (
    'modules' => array (
        'gii' => array (
            'class' => 'system.gii.GiiModule' ,
            'password' => '1' ,
            'ipFilters' => array ( ) ,
            'generatorPaths' => array (
                'application.modules.gii' , // 表明Gii除了在默认的system.gii.generators之外，还在路径别名为common.gii的目录下检索可用的代码生成器，
            ) ,
        ) ,      
    ) ,
) ;
