<?php

YMessage::getFlash();


$this->widget('ycms.widget.YGridView', array(
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => Ycms::t('menu', '排序'),
            'type'=>'raw',
            'htmlOptions'=>array('class'=>'t-center'),
            'value' => '"<input type=text class=t-center size=3 name=position[$data[menu_id]] value=$data[position] />"',
        ),
        array(
            'name' => Ycms::t('menu', ' 链接标题'),
            'value' => 'str_repeat("— ", $data["level"] - 1).$data["name"]', // .
        ),
        array(
            'name' => Ycms::t('menu', '链接说明'),
            'value' => '$data["description"]',
        ),
        array(
            'header' => Ycms::t('menu', '管理操作'),
            'class' => 'CButtonColumn',
            'buttons' => array(
                'create' => array(//这里我们添加一个上移的按钮
                    'label' => '增加链接',
                    'url' => 'Ycms::app()->createUrl("link/create",array("mid"=>$data["menu_id"]))',
                ),
                'update' => array(//这里我们添加一个上移的按钮
                    'label' => '修改链接',
                    'imageUrl' => false,
                ),
                'delete' => array(//这里我们添加一个上移的按钮
                    'label' => '删除链接',
                    'imageUrl' => false,
                ),
            ),
            'template' => '{create} | {update} | {delete}',
            'updateButtonUrl' => 'Ycms::app()->createUrl("link/update",array("mid"=>$data["menu_id"]))',
            'deleteButtonUrl' => 'Ycms::app()->createUrl("link/delete",array("mid"=>$data["menu_id"]))',
        ),
    ),
));
?>

