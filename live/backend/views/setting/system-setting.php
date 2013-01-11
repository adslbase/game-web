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
                        <legend><?php echo Ycms::t ( 'setting','Cookie 设置' )?></legend>

                        <?php echo $form -> beginHolder ( $model,'cookieDomain' );?>
                        <?php echo $form -> labelEx ( $model,'cookieDomain' );?>
                        <?php echo $form -> textField ( $model,'cookieDomain' );?>
                        <?php echo $form -> hint ( $model,'cookieDomain' );?>
                        <?php echo $form -> endHolder ();?>



                        <?php echo $form -> beginHolder ( $model,'cookiePath' );?>
                        <?php echo $form -> labelEx ( $model,'cookiePath' );?>
                        <?php echo $form -> textField ( $model,'cookiePath' );?>
                        <?php echo $form -> hint ( $model,'cookiePath' );?>
                        <?php echo $form -> endHolder ();?>
                </fieldset>

                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','Session 设置' )?></legend>


                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'sessionHandler' );?>
                                <?php echo $form -> dropDownList ( $model,'sessionHandler',$model -> loadFormOptions ( 'sessionHandler' ) );?>
                                <?php echo $form -> hint ( $model,'sessionHandler' );?>
                        </div>



                        <?php echo $form -> beginHolder ( $model,'sessionLifetime' );?>
                        <?php echo $form -> labelEx ( $model,'sessionLifetime' );?>
                        <?php echo $form -> textField ( $model,'sessionLifetime' );?>
                        <?php echo $form -> hint ( $model,'sessionLifetime' );?>
                        <?php echo $form -> endHolder ();?>
                </fieldset>
        </div>

        <div class="f-right width-49">
                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','缓存设置' )?></legend>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'cacheHandler' );?>
                                <?php echo $form -> dropDownList ( $model,'cacheHandler',$model -> loadFormOptions ( 'cacheHandler' ) );?>
                                <?php echo $form -> hint ( $model,'cacheHandler' );?>
                        </div>


                        <?php echo $form -> beginHolder ( $model,'cacheLifetime' );?>
                        <?php echo $form -> labelEx ( $model,'cacheLifetime' );?>
                        <?php echo $form -> textField ( $model,'cacheLifetime' );?>
                        <?php echo $form -> hint ( $model,'cacheLifetime' );?>
                        <?php echo $form -> endHolder ();?>
                </fieldset>



                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','日志设置' )?></legend>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'logHandler' )?>
                                <ul>
                                        <?php echo $form -> checkBoxList ( $model,'logHandler',$model -> loadFormOptions ( 'logHandler' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'logHandler' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'logLevels' )?>
                                <ul>
                                        <?php echo $form -> checkBoxList ( $model,'logLevels',$model -> loadFormOptions ( 'logLevels' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'logLevels' );?>
                        </div>

                </fieldset>





        </div>

</div>
<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>

<?php $this -> endWidget ();?>