<?php

        $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'term-grid',
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
                                array('name' => 'term_id',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridmaxwidth'),
                                            'value' => '$data->term_id',
                                ),
                                array(
                                            'name' => 'name',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridLeft'),
                                            'value' => 'CHtml::link($data->name,array("' . app()->controller->id . '/view","id"=>$data->term_id))',
                                ),
                                'description',
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
                                                                    'url' => 'Yii::app()->createUrl("' . app()->controller->id . '/update", array("id"=>$data->term_id))',
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
