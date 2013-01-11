<?php
YMessage::getFlash ();

$form = $this -> beginWidget ( 'ycms.widget.YActiveForm',array (
            'uniform' => true,
        ) );
?>

<?php echo $form -> errorSummary ( $model );?>



<fieldset class="panel">
        <legend><?php echo Ycms::t ( 'setting','Cookie 设置' )?></legend>
        <div class="ctrlHolder">
                <?php echo $model -> help?>

        </div>

        <?php echo $form -> beginHolder ( $model,'subject' );?>
        <?php echo $form -> labelEx ( $model,'subject' );?>
        <?php echo $form -> textField ( $model,'subject' );?>
        <?php echo $form -> hint ( $model,'subject' );?>
        <?php echo $form -> endHolder ();?>



        <?php echo $form -> beginHolder ( $model,'content' );?>
        <?php echo $form -> labelEx ( $model,'content' );?>
        <?php echo $form -> hint ( $model,'content' );?>
        <?php
        $this -> widget ( $this -> getSettingWidget ( 'editor' ),array (
            'model' => $model,
            'attribute' => 'content',
            'htmlOptions' => array ( 'rows' => 20,'cols' => 30 )
                )
        );
        ?>

        <?php echo $form -> endHolder ();?>


</fieldset>
<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>

<?php $this -> endWidget ();?>