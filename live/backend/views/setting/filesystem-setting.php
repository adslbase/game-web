<?php
YMessage::getFlash ();

$form = $this -> beginWidget ( 'ycms.widget.YActiveForm',array (
            'uniform' => true,
        ) );
?>

<?php echo $form -> errorSummary ( $model );?>

<div class="clearfix">
        <div class="f-left width-49">
                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','文件系统' )?></legend>

                        <?php echo $form -> beginHolder ( $model,'fileUploadPath' );?>
                        <?php echo $form -> labelEx ( $model,'fileUploadPath' );?>
                        <?php echo $form -> textField ( $model,'fileUploadPath' );?>
                        <?php echo $form -> hint ( $model,'fileUploadPath' );?>
                        <?php echo $form -> endHolder ();?>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'fileDownloadHandler' );?>
                                <?php echo $form -> dropDownList ( $model,'fileDownloadHandler',$model -> loadFormOptions ( 'fileDownloadHandler' ) );?>
                                <?php echo $form -> hint ( $model,'fileDownloadHandler' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'fileUploadHandler' );?>
                                <?php echo $form -> dropDownList ( $model,'fileUploadHandler',$model -> loadFormOptions ( 'fileUploadHandler' ) );?>
                                <?php echo $form -> hint ( $model,'fileUploadHandler' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'fileUploadWidget' );?>
                                <?php echo $form -> dropDownList ( $model,'fileUploadWidget',$model -> loadFormOptions ( 'fileUploadWidget' ) );?>
                                <?php echo $form -> hint ( $model,'fileUploadWidget' );?>
                        </div>     

                </fieldset>
        </div>

        <div class="f-right width-49">
                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','个性化设置' )?></legend>

                  

                </fieldset>

        </div>

</div>

<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>



<?php $this -> endWidget ();?>