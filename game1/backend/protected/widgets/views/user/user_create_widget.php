<div class="form">
<?php $this->render('backwidgets.views.notification'); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'usercreate-form',
        'enableAjaxValidation'=>true,       
        )); 
?>

<?php echo $form->errorSummary($model); ?>
<div class="row">
        <?php echo $form->labelEx($model,'email'); ?>
        <?php echo $form->textField($model,'email'); ?>
        <?php echo $form->error($model,'email'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username'); ?>
        <?php echo $form->error($model,'username'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'realname'); ?>
        <?php echo $form->textField($model,'realname'); ?>
        <?php echo $form->error($model,'realname'); ?>
</div>
        <div class="row">
        <?php echo $form->labelEx($model,'sfzh'); ?>
        <?php echo $form->textField($model,'sfzh'); ?>
        <?php echo $form->error($model,'sfzh'); ?>
</div>
<div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password'); ?>
        <?php echo $form->error($model,'password'); ?>
</div>


<div class="row buttons">
        <?php echo CHtml::submitButton(t('保存'),array('class'=>'bebutton')); ?>
</div>

<?php $this->endWidget(); ?>

<script type="text/javascript">    
    CopyString('#UserCreateForm_email','#UserCreateForm_username','email');
    CopyString('#UserCreateForm_email','#UserCreateForm_display_name','email');
</script>
</div><!-- form -->
