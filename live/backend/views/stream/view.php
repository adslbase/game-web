<?php
    $form = $this->beginWidget('ycms.widget.YActiveForm', array(
                        'uniform' => true,
                ));
?>

<?php echo $form->errorSummary($model, null, null, array('id' => 'errorMsg')); ?>

<fieldset>
    <div class="ctrlHolder">
        <?php echo $form->labelEx($model, 'ch_id'); ?>
        <?php echo $form->dropDownList($model, 'ch_id', $model->loadFormOptions('channel')); ?>
        <?php echo $form->hint($model, 'ch_id'); ?>
    </div>

    <div class="ctrlHolder">
        <?php echo $form->pLabel($model, 'type'); ?>
        <ul>
            <?php echo $form->radioButtonList($model, 'type', $model->loadFormOptions('type'), array('template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>', 'separator' => '')); ?>
        </ul>
        <?php echo $form->hint($model, 'type'); ?>
    </div>

    <div class="ctrlHolder">
        <?php echo $form->pLabel($model, 'service'); ?>
        <ul>
            <?php echo $form->radioButtonList($model, 'service', $model->loadFormOptions('service'), array('template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>', 'separator' => '')); ?>
        </ul>
        <?php echo $form->hint($model, 'service'); ?>
    </div>

    <?php echo $form->beginHolder($model, 'stream'); ?>
    <?php echo $form->labelEx($model, 'stream'); ?>
    <?php echo $form->textArea($model, 'stream',array('style'=>'height:100px;')); ?>
    <?php echo $form->hint($model, 'stream'); ?>
    <?php echo $form->endHolder(); ?>


    <div class="buttonHolder">
        <?php echo CHtml::submitButton('提交', array('class' => 'primaryAction')); ?>
    </div>


</fieldset>

<?php $this->endWidget(); ?>
