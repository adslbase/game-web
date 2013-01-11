<?php
$form = $this -> beginWidget ( 'ycms.widget.YActiveForm',array (
            'enableClientValidation' => false,
            'uniform' => true,
            'clientOptions' => array (
                'validateOnSubmit' => false,
            ),
        ) );
?>

<?php echo $form -> errorSummary ( $model,null,null,array ( 'id' => 'errorMsg' ) );?>

<fieldset>

    <?php echo $form -> beginHolder ( $model,'user_name',array ( 'class' => 'ctrlHolder' ) );?>
    <?php echo $form -> labelEx ( $model,'user_name' );?>
    <?php echo $form -> textField ( $model,'user_name',array ( 'class' => 'textInput' ) );?>
    <?php echo $form -> hint ( $model,'user_name',array ( 'class' => 'formHint' ) );?>
    <?php echo $form -> endHolder ();?>

    <?php echo $form -> beginHolder ( $model,'email',array ( 'class' => 'ctrlHolder' ) );?>
    <?php echo $form -> labelEx ( $model,'email' );?>
    <?php echo $form -> textField ( $model,'email',array ( 'class' => 'textInput' ) );?>
    <?php echo $form -> hint ( $model,'email',array ( 'class' => 'formHint' ) );?>
    <?php echo $form -> endHolder ();?>


    <?php echo $form -> beginHolder ( $model,'pass',array ( 'class' => 'ctrlHolder' ) );?>
    <p class="label">
        <?php echo Ycms::t ( 'user','请输入你的密码：' )?>
    </p>
    <ul>
        <li><?php echo $form -> labelEx ( $model,'pass',array ( 'element' => 'open' ) );?> <?php echo $form -> passwordField ( $model,'pass',array ( 'class' => 'textInput' ) );?></label></li>
        <li><?php echo $form -> labelEx ( $model,'confirmPass',array ( 'element' => 'open' ) );?> <?php echo $form -> passwordField ( $model,'confirmPass',array ( 'class' => 'textInput' ) );?></label></li>
    </ul>
    <?php echo $form -> hint ( $model,'pass',array ( 'class' => 'formHint' ) );?>
    <?php echo $form -> endHolder ();?>


    <div class="ctrlHolder">
        <p class="label">
            <?php echo Ycms::t ( 'user','状态：' )?>
        </p>
        <ul>
            <?php echo $form -> radioButtonList ( $model,'status',array ( '0' => '阻止','1' => '活跃' ),array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
        </ul>
        <?php echo $form -> hint ( $model,'status',array ( 'class' => 'formHint' ) );?>
    </div>




    <?php if ( $canAssignRoles !== array ( ) ):?>
        <div class="ctrlHolder">
            <p class="label">
                <?php echo Ycms::t ( 'user','用户角色：' )?>
            </p>
            <ul>
                <?php echo $form -> checkBoxList ( $model,'roles',$canAssignRoles,array ( 'template' => '<li>{labelopen}&nbsp;{input}&nbsp;{labelclose}</li>','separator' => '' ) );?>
            </ul>
            <?php echo $form -> hint ( $model,'roles',array ( 'class' => 'formHint' ) );?>
        </div>

    <?php endif;?>


    <?php if ( $this -> action -> id === 'create' ):?>
        <div class="ctrlHolder noLabel">
            <ul>
                <li><?php echo $form -> label ( $model,'isSendEmail',array ( 'element' => 'openfor' ) );?><?php echo $form -> checkBox ( $model,'isSendEmail' );?>  <?php echo $form -> label ( $model,'isSendEmail',array ( 'element' => 'close' ) );?></li>
            </ul>
            <?php echo $form -> hint ( $model,'isSendEmail',array ( 'class' => 'formHint' ) );?>
        </div>
    <?php endif;?>

    <div class="buttonHolder">
        <?php echo CHtml::ajaxSubmitButton ( Yii::t ( 'ycms','确定' ),CHtml::normalizeUrl ( array ( 'job/addnew','render' => false ) ),array ( 'onclick' => 'js:$("#jobDialog").dialog("close")','success' => 'js: function(data) {
                    }' ),array ( 'id' => 'closeJobDialog','class' => 'primaryAction' ) );?>           
    </div>
</fieldset>
<?php $this -> endWidget ();?>
