<div class="form">
<?php $this->render('backwidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'userupdatesettings-form',
        'enableAjaxValidation'=>true,       
        )); 
?>


<?php echo $form->errorSummary($model); ?>
<div class="row">
        <?php echo $form->labelEx($model,'realname'); ?>
        <?php echo $form->textField($model,'realname'); ?>
        <?php echo $form->error($model,'realname'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
</div>

<div class="row buttons">
        <?php echo CHtml::submitButton(t('保存'),array('class'=>'bebutton')); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->