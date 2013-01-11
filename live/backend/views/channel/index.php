<?php

    YMessage::getFlash();


    $this->widget('ycms.widget.YGridView', array(
            'dataProvider' => $dataProvider,
            'topButtons' => array(
                    array(
                            'link',
                            Ycms::t('ycms', '增加频道'),
                            $this->createUrl('create'),
                    ),
            ),
            'columns' => array(
                    array(
                            'name' => Ycms::t('channel', ' 频道名称'),
                            'value' => '$data["name"]', // .
                    ),
                    array(
                            'name' => Ycms::t('channel', '频道说明'),
                            'value' => '$data["description"]',
                    ),
                    array(
                            'header' => Ycms::t('channel', '管理操作'),
                            'class' => 'CButtonColumn',
                            'buttons' => array(
                                    'update' => array(//这里我们添加一个上移的按钮
                                            'label' => '修改频道',
                                            'imageUrl' => false,
                                    ),
                                    'delete' => array(//这里我们添加一个上移的按钮
                                            'label' => '删除频道',
                                            'imageUrl' => false,
                                    ),
                            ),
                            'template' => '{update} | {delete}',
                            'updateButtonUrl' => 'Ycms::app()->createUrl("channel/update",array("id"=>$data["ch_id"]))',
                            'deleteButtonUrl' => 'Ycms::app()->createUrl("channel/delete",array("id"=>$data["ch_id"]))',
                    ),
            ),
    ));
?>

