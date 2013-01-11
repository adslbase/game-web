<?php
$form = $this->beginWidget('ycms.widget.YActiveForm', array(
            'uniform' => true,
        ));
?>

<?php echo $form->errorSummary($model, null, null, array('id' => 'errorMsg')); ?>

<fieldset>
    <?php echo $form->beginHolder($model, 'name'); ?>
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->hint($model, 'name'); ?>
    <?php echo $form->endHolder(); ?>



    <?php echo $form->beginHolder($model, 'description'); ?>
    <?php echo $form->labelEx($model, 'description'); ?>
    <?php echo $form->textArea($model, 'description', array('rows' => 5, 'cols' => 50)); ?>
    <?php echo $form->hint($model, 'description'); ?>
    <?php echo $form->endHolder(); ?>

    
        <?php echo $form->beginHolder($model, 'keywords'); ?>
    <?php echo $form->labelEx($model, 'keywords'); ?>
    <?php echo $form->textField($model, 'keywords'); ?>
    <?php echo $form->hint($model, 'keywords'); ?>
    <?php echo $form->endHolder(); ?>
    
    
    <div class="buttonHolder">
        <?php echo CHtml::submitButton('提交', array('class' => 'primaryAction')); ?>
    </div>
</fieldset>

<?php $this->endWidget(); ?>
