<?php
YMessage::getFlash ();

$form = $this -> beginWidget ( 'ycms.widget.YActiveForm',array (
            'uniform' => true,
        ) );
?>

<?php echo $form -> errorSummary ( $model );?>

<fieldset class="panel">
        <legend><?php echo Ycms::t ( 'setting','挂件设置' )?></legend>

        <div class="ctrlHolder">
                <?php echo $form -> labelEx ( $model,'editor' );?>
                <?php echo $form -> dropDownList ( $model,'editor',$model->loadFormOptions('editor'),array('class'=>'small'));?>
                <?php echo $form -> hint ( $model,'editor');?>
        </div>
</fieldset>




<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>



<?php $this -> endWidget ();?>