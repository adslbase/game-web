<?php

YMessage::getFlash ();


$this -> widget ( 'ycms.widget.YGridView',array (
    'dataProvider' => $dataProvider,
    'topButtons' => array (
        array (
            'link',
            Ycms::t ( 'ycms','增加菜单'),
            $this -> createUrl ( 'create'),
        ),
    ),
    'columns' => array (
        array (
            'name' => Ycms::t ( 'menu','模版类型' ),
            'value' => '$data["type"]',
        ),
        array (
            'name' => Ycms::t ( 'menu','模版描述' ),
            'value' => '$data["name"]',
        ),
        array (
            'header' => Ycms::t ( 'menu','操作' ),
            'class' => 'CButtonColumn',
            'buttons' => array (
                'update' => array ( //这里我们添加一个上移的按钮
                    'label' => '修改菜单',
                    'imageUrl' => false,
                ),
            ),
            'template' => '{update}',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("UpdateMailTemplate",array("type"=>$data["alias"]))',
        ),
    ),
) );
?>









