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
                        <legend><?php echo Ycms::t ( 'setting','服务器设置' )?></legend>
                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'timezone' );?>
                                <?php echo $form -> dropDownList ( $model,'timezone',$model -> loadFormOptions ( 'timezone' ) );?>
                                <?php echo $form -> hint ( $model,'timezone' );?>
                        </div>

                        <?php echo $form -> beginHolder ( $model,'runtimePath' );?>
                        <?php echo $form -> labelEx ( $model,'runtimePath' );?>
                        <?php echo $form -> textField ( $model,'runtimePath' );?>
                        <?php echo $form -> hint ( $model,'runtimePath' );?>
                        <?php echo $form -> endHolder ();?>


                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'errorReporting' );?>
                                <?php echo $form -> dropDownList ( $model,'errorReporting',$model -> loadFormOptions ( 'errorReporting' ) );?>
                                <?php echo $form -> hint ( $model,'errorReporting' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'gzip' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'gzip',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'gzip' );?>
                        </div>
                </fieldset>

                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','FTP设置' )?></legend>
                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'ftpEnable' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'ftpEnable',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'ftpEnable' );?>
                        </div>

                        <?php echo $form -> beginHolder ( $model,'ftpHost' );?>
                        <?php echo $form -> labelEx ( $model,'ftpHost' );?>
                        <?php echo $form -> textField ( $model,'ftpHost' );?>
                        <?php echo $form -> hint ( $model,'ftpHost' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'ftpPort' );?>
                        <?php echo $form -> labelEx ( $model,'ftpPort' );?>
                        <?php echo $form -> textField ( $model,'ftpPort' );?>
                        <?php echo $form -> hint ( $model,'ftpPort' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'ftpUser' );?>
                        <?php echo $form -> labelEx ( $model,'ftpUser' );?>
                        <?php echo $form -> textField ( $model,'ftpUser' );?>
                        <?php echo $form -> hint ( $model,'ftpUser' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'ftpPass' );?>
                        <?php echo $form -> labelEx ( $model,'ftpPass' );?>
                        <?php echo $form -> textField ( $model,'ftpPass' );?>
                        <?php echo $form -> hint ( $model,'ftpPass' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'ftpRoot' );?>
                        <?php echo $form -> labelEx ( $model,'ftpRoot' );?>
                        <?php echo $form -> textField ( $model,'ftpRoot' );?>
                        <?php echo $form -> hint ( $model,'ftpRoot' );?>
                        <?php echo $form -> endHolder ();?>
                </fieldset>
        </div>

        <div class="f-right width-49">
                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','邮件设置' )?></legend>
                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'mailHandler' );?>
                                <?php echo $form -> dropDownList ( $model,'mailHandler',$model -> loadFormOptions ( 'mailHandler' ) );?>
                                <?php echo $form -> hint ( $model,'mailHandler' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'mailer' );?>
                                <?php echo $form -> dropDownList ( $model,'mailer',$model -> loadFormOptions ( 'mailer' ) );?>
                                <?php echo $form -> hint ( $model,'mailer' );?>
                        </div>

                        <?php echo $form -> beginHolder ( $model,'mailFrom' );?>
                        <?php echo $form -> labelEx ( $model,'mailFrom' );?>
                        <?php echo $form -> textField ( $model,'mailFrom' );?>
                        <?php echo $form -> hint ( $model,'mailFrom' );?>
                        <?php echo $form -> endHolder ();?>


                        <?php echo $form -> beginHolder ( $model,'fromName' );?>
                        <?php echo $form -> labelEx ( $model,'fromName' );?>
                        <?php echo $form -> textField ( $model,'fromName' );?>
                        <?php echo $form -> hint ( $model,'fromName' );?>
                        <?php echo $form -> endHolder ();?>


                        <?php echo $form -> beginHolder ( $model,'sendmail' );?>
                        <?php echo $form -> labelEx ( $model,'sendmail' );?>
                        <?php echo $form -> textField ( $model,'sendmail' );?>
                        <?php echo $form -> hint ( $model,'sendmail' );?>
                        <?php echo $form -> endHolder ();?>


                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'smtp[auth]' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'smtp[auth]',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'smtp[auth]' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'smtp[secure]' );?>
                                <?php echo $form -> dropDownList ( $model,'smtp[secure]',$model -> loadFormOptions ( 'smtp[secure]' ) );?>
                                <?php echo $form -> hint ( $model,'smtp[secure]' );?>
                        </div>


                        <?php echo $form -> beginHolder ( $model,'smtp[port]' );?>
                        <?php echo $form -> labelEx ( $model,'smtp[port]' );?>
                        <?php echo $form -> textField ( $model,'smtp[port]' );?>
                        <?php echo $form -> hint ( $model,'smtp[port]' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'smtp[username]' );?>
                        <?php echo $form -> labelEx ( $model,'smtp[username]' );?>
                        <?php echo $form -> textField ( $model,'smtp[username]' );?>
                        <?php echo $form -> hint ( $model,'smtp[username]' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'smtp[password]' );?>
                        <?php echo $form -> labelEx ( $model,'smtp[password]' );?>
                        <?php echo $form -> passwordField ( $model,'smtp[password]' );?>
                        <?php echo $form -> hint ( $model,'smtp[password]' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'smtp[host]' );?>
                        <?php echo $form -> labelEx ( $model,'smtp[host]' );?>
                        <?php echo $form -> textField ( $model,'smtp[host]' );?>
                        <?php echo $form -> hint ( $model,'smtp[host]' );?>
                        <?php echo $form -> endHolder ();?>

                </fieldset>

        </div>

</div>
<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>

<?php $this -> endWidget ();?>