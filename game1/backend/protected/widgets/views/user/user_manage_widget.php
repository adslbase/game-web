<?php

        $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'user-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'summaryText' => t('显示') . ' {start} - {end} ' . t('有') . ' {count} ' . t('结果'),
                    'pager' => array(
                                'header' => t('跳转'),
                                'nextPageLabel' => t('下页'),
                                'prevPageLabel' => t('上页'),
                                'firstPageLabel' => t('首页'),
                                'lastPageLabel' => t('尾页'),
                                'pageSize' => Yii::app()->settings->get('system', 'page_size')
                    ),
                    'columns' => array(
                                array('name' => 'user_id',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridmaxwidth'),
                                            'value' => '$data->user_id',
                                ),
                                array(
                                            'name' => 'username',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridLeft'),
                                            'value' => 'CHtml::link($data->username,array("' . app()->controller->id . '/view","id"=>$data->user_id))',
                                ),
                                array(
                                            'name' => 'realname',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridLeft'),
                                            'value' => '$data->realname',
                                ),
                                array(
                                            'name' => 'email',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridLeft'),
                                            'value' => '$data->email',
                                ),
                                array(
                                            'name' => 'status',
                                            'type' => 'image',
                                            'htmlOptions' => array('class' => 'gridmaxwidth'),
                                            'value' => 'User::convertUserState($data)',
                                            'filter' => false
                                ),
                                array(
                                            'header' => t('Roles'),
                                            'type' => 'raw',
                                            'value' => 'User::getStringRoles($data->user_id)',
                                ),
                                array
                                            (
                                            'class' => 'CButtonColumn',
                                            'template' => '{update}',
                                            'buttons' => array
                                                        (
                                                        'update' => array
                                                                    (
                                                                    'label' => t('编辑'),
                                                                    'imageUrl' => false,
                                                                    'url' => 'Yii::app()->createUrl("' . app()->controller->id . '/update", array("id"=>$data->user_id))',
                                                        ),
                                            ),
                                ),
                                array
                                            (
                                            'class' => 'CButtonColumn',
                                            'template' => '{delete}',
                                            'buttons' => array
                                                        (
                                                        'delete' => array
                                                                    (
                                                                    'label' => t('删除'),
                                                                    'imageUrl' => false,
                                                        ),
                                            ),
                                ),
                    ),
        ));
?>
