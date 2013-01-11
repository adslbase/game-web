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
            'name' => Ycms::t ( 'menu','菜单标题' ),
            'value' => '$data["name"]',
        ),
        array (
            'name' => Ycms::t ( 'menu','菜单说明' ),
            'value' => '$data["description"]',
        ),
        array (
            'header' => Ycms::t ( 'menu','操作' ),
            'class' => 'CButtonColumn',
            'buttons' => array (
                'view' => array ( //这里我们添加一个上移的按钮
                    'label' => '查看链接',
                    'imageUrl' => false,
                ),
                'create' => array ( //这里我们添加一个上移的按钮
                    'label' => '增加链接',
                    'url' => 'Yii::app()->controller->createUrl("link/create",array("mid"=>$data["menu_id"],"#"=>"organization"))',
                ),
                'update' => array ( //这里我们添加一个上移的按钮
                    'label' => '修改菜单',
                    'imageUrl' => false,
                ),
                'delete' => array ( //这里我们添加一个上移的按钮
                    'label' => '删除菜单',
                    'imageUrl' => false,
                ),
            ),
            'template' => '{view} | {create} | {update} | {delete}',
            'viewButtonUrl' => 'Yii::app()->controller->createUrl("link/index",array("mid"=>$data["menu_id"]))',
            'updateButtonUrl' => 'Yii::app()->controller->createUrl("update",array("mid"=>$data["menu_id"]))',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("delete",array("mid"=>$data["menu_id"]))',
        ),
    ),
) );
?>










