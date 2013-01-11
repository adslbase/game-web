<?php
YMessage::getFlash ();

$form = $this -> beginWidget ( 'ycms.widget.YActiveForm',array (
            'uniform' => true,
        ) );
?>

<?php echo $form -> errorSummary ( $model );?>

<fieldset class="panel">
        <legend><?php echo Ycms::t ( 'setting','维护模式' )?></legend>

        <div class="ctrlHolder">
                <?php echo $form -> pLabel ( $model,'maintenanceMode');?>
                <ul>
                        <?php echo $form -> radioButtonList ( $model,'maintenanceMode',$model->loadFormOptions('general'),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                </ul>
                <?php echo $form -> hint ( $model,'maintenanceMode');?>
        </div>


        <?php echo $form -> beginHolder ( $model,'maintenanceModeMessage' );?>
        <?php echo $form -> labelEx ( $model,'maintenanceModeMessage' );?>
        <?php echo $form -> textArea ( $model,'maintenanceModeMessage' );?>
        <?php echo $form -> hint ( $model,'maintenanceModeMessage' );?>
        <?php echo $form -> endHolder ();?>

</fieldset>




<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>



<?php $this -> endWidget ();?>