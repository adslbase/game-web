<div class="form">
<?php $this->render('backwidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'settings-form',
        'enableAjaxValidation'=>true,       
        )); 
?>

<?php echo $form->errorSummary($model); ?>
<div class="row">
        <?php echo $form->labelEx($model,'support_email'); ?>
        <?php echo $form->textField($model,'support_email'); ?>
        <?php echo $form->error($model,'support_email'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'page_size'); ?>
        <?php echo $form->textField($model,'page_size'); ?>
        <?php echo $form->error($model,'page_size'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'language_number'); ?>
        <?php echo $form->textField($model,'language_number'); ?>
        <?php echo $form->error($model,'language_number'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'keep_file_name_upload'); ?>
        <?php echo $form->dropDownList($model,'keep_file_name_upload',SettingSystemForm::filenameUpload()); ?>
        <?php echo $form->error($model,'keep_file_name_upload'); ?>
</div>
    
 
<div class="row buttons">
        <?php echo CHtml::submitButton(t('保存'),array('class'=>'bebutton')); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
