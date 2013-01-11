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

    <?php if ($this->action->id === 'create'): ?>
        <?php echo $form->beginHolder($model, 'alias'); ?>
        <?php echo $form->labelEx($model, 'alias'); ?>
        <?php echo $form->textField($model, 'alias'); ?>
        <?php echo $form->hint($model, 'alias'); ?>
        <?php echo $form->endHolder(); ?>
    <?php endif; ?>

    <?php echo $form->beginHolder($model, 'description'); ?>
    <?php echo $form->labelEx($model, 'description'); ?>
    <?php echo $form->textArea($model, 'description', array('rows' => 5, 'cols' => 50)); ?>
    <?php echo $form->hint($model, 'description'); ?>
    <?php echo $form->endHolder(); ?>

    <div class="buttonHolder">
        <?php echo CHtml::submitButton('Submit', array('class' => 'primaryAction')); ?>
    </div>
</fieldset>



<?php $this->endWidget(); ?>
