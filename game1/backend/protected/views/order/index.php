<?php

        $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'order-grid',
                    'dataProvider' => $result,
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
                                array('name' => 'object_id',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridmaxwidth'),
                                            'value' => '$data->object_id',
                                ),
                                array(
                                            'name' => 'object_name',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridLeft'),
                                            'value' => 'CHtml::link($data->object_name,array("' . app()->controller->id . '/view","id"=>$data->object_id))',
                                ),
                                array(
                                            'name' => 'object_status',
                                            'type' => 'raw',
                                            'htmlOptions' => array('class' => 'gridLeft gridmaxwidth'),
                                            'value' => 'Object::convertObjectStatus($data->object_status)',
                                ),
                    )
        ));