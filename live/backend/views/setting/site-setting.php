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
                        <legend><?php echo Ycms::t ( 'setting','网站设置' )?></legend>

                        <?php echo $form -> beginHolder ( $model,'siteName' );?>
                        <?php echo $form -> labelEx ( $model,'siteName' );?>
                        <?php echo $form -> textField ( $model,'siteName');?>
                        <?php echo $form -> hint ( $model,'siteName' );?>
                        <?php echo $form -> endHolder ();?>


                        <?php echo $form -> beginHolder ( $model,'siteUrl' );?>
                        <?php echo $form -> labelEx ( $model,'siteUrl' );?>
                        <?php echo $form -> textField ( $model,'siteUrl');?>
                        <?php echo $form -> hint ( $model,'siteUrl' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'siteDesc' );?>
                        <?php echo $form -> labelEx ( $model,'siteDesc' );?>
                        <?php echo $form -> textArea ( $model,'siteDesc' );?>
                        <?php echo $form -> hint ( $model,'siteDesc' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'siteKeys' );?>
                        <?php echo $form -> labelEx ( $model,'siteKeys' );?>
                        <?php echo $form -> textArea ( $model,'siteKeys' );?>
                        <?php echo $form -> hint ( $model,'siteKeys' );?>
                        <?php echo $form -> endHolder ();?>

                        <?php echo $form -> beginHolder ( $model,'siteRights' );?>
                        <?php echo $form -> labelEx ( $model,'siteRights' );?>
                        <?php echo $form -> textField ( $model,'siteRights' );?>
                        <?php echo $form -> hint ( $model,'siteRights' );?>
                        <?php echo $form -> endHolder ();?>


                        <?php echo $form -> beginHolder ( $model,'siteEmail' );?>
                        <?php echo $form -> labelEx ( $model,'siteEmail' );?>
                        <?php echo $form -> textField ( $model,'siteEmail');?>
                        <?php echo $form -> hint ( $model,'siteEmail' );?>
                        <?php echo $form -> endHolder ();?>


                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'siteConfig' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'siteConfig',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'siteConfig' );?>
                        </div>
                </fieldset>
        </div>

        <div class="f-right width-49">
                <fieldset class="panel">
                        <legend><?php echo Ycms::t ( 'setting','SEO设置' )?></legend>

                        <div class="ctrlHolder">
                                <?php echo $form -> labelEx ( $model,'urlFormat' );?>
                                <?php echo $form -> dropDownList ( $model,'urlFormat',$model -> loadFormOptions ( 'urlFormat' ),array ( 'class' => 'small' ) );?>
                                <?php echo $form -> hint ( $model,'urlFormat' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'showScriptName' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'showScriptName',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'showScriptName' );?>
                        </div>


                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'urlSuffix' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'urlSuffix',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'urlSuffix' );?>
                        </div>

                        <div class="ctrlHolder">
                                <?php echo $form -> pLabel ( $model,'sitenamePagetitles' );?>
                                <ul>
                                        <?php echo $form -> radioButtonList ( $model,'sitenamePagetitles',$model -> loadFormOptions ( 'general' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
                                </ul>
                                <?php echo $form -> hint ( $model,'sitenamePagetitles' );?>
                        </div>

                </fieldset>
        </div>

</div>



<div class="buttonHolder">
        <?php echo CHtml::submitButton ( 'Submit',array ( 'class' => 'primaryAction' ) );?>
</div>



<?php $this -> endWidget ();?>