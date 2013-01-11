<?php
    $form = $this->beginWidget('ycms.widget.YActiveForm', array(
            'uniform' => true,
                ));
?>

<?php echo $form->errorSummary($model, null, null, array('id' => 'errorMsg')); ?>

<fieldset>
    <div class="ctrlHolder">
        <?php echo $form->labelEx($model, 'ch_id'); ?>
        <?php if ($this->action->id === 'create'): ?>
                <?php echo $form->dropDownList($model, 'ch_id', $model->loadFormOptions('channel')); ?>
            <?php elseif ($this->action->id === 'update'): ?>
                <?php echo YHtml::encode($model->loadFormOptions('channel', $model->ch_id)); ?>
                <?php echo $form->hiddenField($model, 'ch_id') ?>
            <?php endif; ?>
        <?php echo $form->hint($model, 'ch_id'); ?>
    </div>

    <div class="ctrlHolder">
        <?php echo $form->labelEx($model, 'date'); ?>
        <?php if ($this->action->id === 'create'): ?>
                <?php
                $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model' => $model,
                        'attribute' => 'date',
                        'options' => array('dateFormat' => 'yy-mm-dd'),
                ));
                ?>
            <?php elseif ($this->action->id === 'update'): ?>
                <?php echo YHtml::encode($model->date); ?>
                <?php echo $form->hiddenField($model, 'date') ?>
            <?php endif; ?>
        <?php echo $form->hint($model, 'date'); ?>
    </div>

    <div class="ctrlHolder">
        <?php echo $form->labelEx($model, 'pid'); ?>
        <?php echo $form->textField($model, 'pid', array('style' => 'width:50px;')); ?>
    </div>

    <?php for ($i = 0; $i < $num; $i++): ?>
            <div class="ctrlHolder ">
                <?php echo $form->labelEx($model, 'start_time', array('class' => 'inline-label')); ?>
                <?php
                $this->widget('ycms.widget.timepicker.YJuiTimePicker', array(
                        'model' => $model,
                        'attribute' => 'start_time[' . $i . ']',
                        'language' => 'zh',
                        'options' => array(
                                'showButtonPanel' => FALSE,
                                'hourGrid' => 4,
                                'minuteGrid' => 10,
                                'showSecond' => true,
                                'timeFormat' => 'hh:mm:ss',
                                'secondGrid' => 10
                        ),
                        'htmlOptions' => array('style' => 'width:50px')
                ));
                ?>
                <?php echo $form->labelEx($model, 'end_time', array('class' => 'inline-label')); ?>
                <?php
                $this->widget('ycms.widget.timepicker.YJuiTimePicker', array(
                        'model' => $model,
                        'attribute' => 'end_time[' . $i . ']',
                        'language' => 'zh',
                        'options' => array(
                                'showButtonPanel' => FALSE,
                                'hourGrid' => 4,
                                'minuteGrid' => 10,
                                'showSecond' => true,
                                'timeFormat' => 'hh:mm:ss',
                                'secondGrid' => 10
                        ),
                        'htmlOptions' => array('style' => 'width:50px')
                ));
                ?>
                <?php echo $form->labelEx($model, 'type', array('class' => 'inline-label')); ?>
                <?php echo $form->dropDownList($model, 'type[' . $i . ']', $model->loadFormOptions('type'), array('style' => 'display:inline;float:none;width:60px;')); ?>

                <?php echo $form->labelEx($model, 'post_id', array('class' => 'inline-label')); ?>
                <?php echo $form->textField($model, 'post_id[' . $i . ']', array('style' => 'display:inline;float:none; width:40px;')); ?>

                <?php echo $form->labelEx($model, 'name', array('class' => 'inline-label')); ?>
                <?php echo $form->textField($model, 'name[' . $i . ']', array('style' => 'display:inline;float:none;')); ?>

                <?php echo $form->hiddenField($model, 'program_id[' . $i . ']') ?>

            </div>
        <?php endfor; ?>


    <div class="t-right">
        <input type="hidden" name="num" value="<?php echo $num ?>" />
        插入新行 <input type="text" name="add" style="width:30px" value="1" > <input value="执行" type="submit" name="add-submit" >
    </div>

    <div class="buttonHolder">
        <?php if($this->action->id =='update'):?>
        <a href ="<?php echo Ycms::app()->createUrl("program/delete",array("date"=>$date)); ?>">删除节目单</a>
        <?php endif;?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::submitButton('提交', array('class' => 'primaryAction')); ?> 
    </div>

</fieldset>

<?php $this->endWidget(); ?>
