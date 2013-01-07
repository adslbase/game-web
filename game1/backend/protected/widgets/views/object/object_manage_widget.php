<?php

        $columns = array(
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
        );



        switch ($type)
        {
                case 'game' :
                        $columns[] = array(
                                    'class' => 'CButtonColumn',
                                    'template' => '{serverliest}',
                                    'buttons' => array
                                                (
                                                'serverliest' => array
                                                            (
                                                            'label' => t('服务器列表'),
                                                            'imageUrl' => false,
                                                            'url' => 'Yii::app()->createUrl("' . app()->controller->id . '/server", array("object_parent"=>$data->object_id))',
                                                ),
                                    ),
                        );
                        break;
                case 'server' :
                        $columns[] = array(
                                    'name' => 'object_parent',
                                    'type' => 'raw',
                                    'htmlOptions' => array('class' => 'gridLeft gridmaxwidth'),
                                    'value' => 'CHtml::link(Object::convertObjectName($data->object_parent),array("' . app()->controller->id . '/update","id"=>$data->object_parent))',
                        );
                        break;

                case 'card' :
                        $columns[] = array(
                                    'class' => 'CButtonColumn',
                                    'template' => '{import}',
                                    'buttons' => array
                                                (
                                                'import' => array
                                                            (
                                                            'label' => t('导入'),
                                                            'imageUrl' => false,
                                                            'url' => 'Yii::app()->createUrl("becard/import", array("id"=>$data->object_id))',
                                                ),
                                    ),
                        );
                        break;
                case '':
                        $columns[] = array(
                                    'name' => 'object_type',
                                    'type' => 'raw',
                                    'htmlOptions' => array('class' => 'gridLeft gridmaxwidth'),
                                    'value' => 'Object::convertObjectType($data->object_type)',
                        );
                        break;
        }




        $columns[] = array
                    (
                    'class' => 'CButtonColumn',
                    'template' => '{update}',
                    'buttons' => array
                                (
                                'update' => array
                                            (
                                            'label' => t('编辑'),
                                            'imageUrl' => false,
                                            'url' => 'Yii::app()->createUrl("' . app()->controller->id . '/update", array("id"=>$data->object_id))',
                                ),
                    ),
        );
        $columns[] = array
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
        );

        $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'object-grid',
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
                    'columns' => $columns,
        ));
?>
