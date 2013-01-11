<?php

YMessage::getFlash();


$url = $this->createUrl('user/create', array('mode' => 'dialog'));

$this->widget('ycms.widget.YGridView', array(
    'dataProvider' => $dataProvider,
    'bottomButtons' => array(
        array('删除用户', array()),
        array('激活用户', array()),
        array('锁定用户', array()),
    ),
    'columns' => array(
        array(
            'class' => 'CCheckBoxColumn',
            'id' => 'selectedItems',
            'selectableRows' => 2
        ),
        array(
            'name' => Ycms::t('user', '用户名'),
            'type' => 'raw',
            'value' => 'CHtml::encode($data["user_name"])',
        ),
        array(
            'name' => Ycms::t('user', '状态'),
            'value' => '$data["status"]?"激活":"禁止"',
        ),
        array(
            'name' => Ycms::t('user', '注册时间'),
            'value' => '$data["create_time"]',
        ),
        array(
            'name' => Ycms::t('user', '上次访问'),
            'value' => '$data["login_time"]',
        ),
    ),
));



?>
