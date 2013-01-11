<?php
    YMessage::getFlash();
?>

<div class="grid-top">
    <div class="f-right topfilter">
        <?php echo YHtml::beginForm(); ?>
        <?php echo YHtml::label('搜索', 'ch_id'); ?>
        <?php echo YHtml::activeDropDownList($model, 'ch_id', $model->loadFormOptions('channel')); ?>
        <?php echo YHtml::label('日期', 'date'); ?>
        <?php
            $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model' => $model,
                    'attribute' => 'date',
                    'options' => array('dateFormat' => 'yy-mm-dd'),
            ));
        ?>
        <?php echo CHtml::submitButton('搜索', array('name' => 'gridSubmit')); ?>
        <?php echo CHtml::endForm(); ?>
    </div>
    <div class="topButton">
        <a href="<?php echo Ycms::app()->createUrl("program/create") ?>">增加节目单</a>
    </div>

</div>




<?php
    $this->widget('ycms.widget.YGridView', array(
            'dataProvider' => $dataProvider,
            'model' => $model,
            'columns' => array(
                    array(
                            'name' => Ycms::t('program', '频道'),
                            'value' => '$this->grid->model->loadFormOptions("channel",$data["ch_id"])',
                    ),
                    array(
                            'name' => Ycms::t('program', '日期'),
                            'value' => '$data["date"]', // .
                    ),
                    array(
                            'name' => Ycms::t('program', '开始时间'),
                            'value' => '$data["start_time"]', // .
                    ),
                    array(
                            'name' => Ycms::t('program', '结束时间'),
                            'value' => '$data["end_time"]', // .
                    ),
                    array(
                            'name' => Ycms::t('program', '节目'),
                            'value' => '$data["name"]',
                    ),
                    array(
                            'name' => Ycms::t('program', '类型'),
                            'value' => '$this->grid->model->loadFormOptions("type",$data["type"])',
                    ),
                    array(
                            'header' => Ycms::t('program', '管理操作'),
                            'class' => 'CButtonColumn',
                            'buttons' => array(
                                    'update' => array(
                                            'label' => '修改节目单',
                                            'imageUrl' => false,
                                    ),
                                    'delete' => array(
                                            'label' => '删除节目单',
                                            'imageUrl' => false,
                                    ),
                            ),
                            'template' => '{update} | {delete}',
                            'updateButtonUrl' => 'Ycms::app()->createUrl("program/update",array("date"=>$data["date"],"ch_id"=>$data["ch_id"]))',
                            'deleteButtonUrl' => 'Ycms::app()->createUrl("program/delete",array("id"=>$data["program_id"]))',
                    ),
            ),
    ));
?>

