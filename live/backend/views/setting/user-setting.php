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
                        <legend><?php echo Ycms::t ( 'setting','注册和取消注册' )?></legend>

                        <?php echo $form -> beginHolder ( $model,'anonymous' );?>
                        <?php echo $form -> labelEx ( $model,'anonymous' );?>
                        <?php echo $form -> textField ( $model,'anonymous' );?>
                        <?php echo $form -> hint ( $model,'anonymous' );?>
                        <?php echo $form -> endHolder ();?>
                        
                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'allowRegister' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'allowRegister',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'allowRegister' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'chooseUserType' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'chooseUserType',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'chooseUserType' );?>
                        </div>


                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'userVerify' );?>
                                <?php echo $form -> dropDownList ( $model,'userVerify',$model -> loadFormOptions ( 'userVerify' ) );?>
                                <?php echo $form -> hint ( $model,'userVerify' );?>
                        </div>


                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'invitationCode' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'invitationCode',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'invitationCode' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'userDelMethod' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'userDelMethod',$model -> loadFormOptions ( 'userDelMethod' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'userDelMethod' );?>
                        </div>




                </fieldset>
        </div>

        <div class="f-right width-49">
                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','个性化设置' )?></legend>

                        <?php echo $form -> beginHolder ( $model,'avatarDir' );?>
                        <?php echo $form -> labelEx ( $model,'avatarDir' );?>
                        <?php echo $form -> textField ( $model,'avatarDir' );?>
                        <?php echo $form -> hint ( $model,'avatarDir' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'avatarDefault' );?>
                        <?php echo $form -> labelEx ( $model,'avatarDefault' );?>
                        <?php echo $form -> textField ( $model,'avatarDefault' );?>
                        <?php echo $form -> hint ( $model,'avatarDefault' );?>
                        <?php echo $form -> endHolder ();?>
                </fieldset>

        </div>

</div>

<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>



<?php $this -> endWidget ();?>