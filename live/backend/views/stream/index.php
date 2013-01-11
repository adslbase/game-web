<?php

    YMessage::getFlash();
    $this->widget('ycms.widget.YGridView', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
            'topButtons' => array(
                    array(
                            'link',
                            Ycms::t('ycms', '增加播放地址'),
                            $this->createUrl('create'),
                    ),
            ),
            'columns' => array(
                    array(
                            'name' => Ycms::t('stream', '频道'),
                            'value' => '$this->grid->model->loadFormOptions("channel",$data["ch_id"])',
                    ),
                    array(
                            'name' => Ycms::t('stream', '直播类型'),
                            'value' => '$this->grid->model->loadFormOptions("type",$data["type"])', // .
                    ),
                    array(
                            'name' => Ycms::t('stream', '提供商'),
                            'value' => '$this->grid->model->loadFormOptions("service",$data["service"])',
                    ),
                    array(
                            'header' => Ycms::t('stream', '管理操作'),
                            'class' => 'CButtonColumn',
                            'buttons' => array(
                                    'update' => array(//这里我们添加一个上移的按钮
                                            'label' => '修改播放地址',
                                            'imageUrl' => false,
                                    ),
                                    'delete' => array(//这里我们添加一个上移的按钮
                                            'label' => '删除播放地址',
                                            'imageUrl' => false,
                                    ),
                            ),
                            'template' => '{update} | {delete}',
                            'updateButtonUrl' => 'Ycms::app()->createUrl("stream/update",array("stream_id"=>$data["stream_id"]))',
                            'deleteButtonUrl' => 'Ycms::app()->createUrl("stream/delete",array("stream_id"=>$data["stream_id"]))',
                    ),
            ),
    ));
?>

