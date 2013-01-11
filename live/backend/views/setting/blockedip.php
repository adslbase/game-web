<?php YMessage::getFlash ();?>

<div class="help"><?php echo Ycms::t ( 'blockedip','您的网站封了这里列出的IP地址。从封锁的地址访问这个网站是完全禁止的，看到只是一个简短的消息来说明这个情况。' )?> </div>

<?php
$form = $this -> beginWidget ( 'ycms.widget.YActiveForm',array (
            'uniform' => true,
        ) );
?>

<fieldset>
        <?php echo $form -> beginHolder ( $model,'ip' );?>
        <?php echo $form -> labelEx ( $model,'ip' );?>

        <?php
        $this -> widget ( 'CMaskedTextField',array (
            'model' => $model,
            'attribute' => 'ip',
            'mask' => '999.999.999.999',
            'htmlOptions' => array ( 'class' => 'textInput' )
           )
        );
        ?>


        <?php echo $form -> hint ( $model,'ip' );?>
        <?php echo $form -> endHolder ();?>
</fieldset>


<div class="ctrlHolder">
        <?php echo CHtml::submitButton ( Ycms::t ( 'ycms','添加' ),array ( 'class' => 'form-submit' ) );?>
</div>
<?php $this -> endWidget ();?>

<?php
$this -> widget ( 'ycms.widget.YGridView',array (
    'dataProvider' => $dataProvider,
    'columns' => array (
        array (
            'name' => Ycms::t ( 'blockedip','阻止的ip地址' ),
            'value' => '$data["ip"]',
        ),
        array (
            'header' => Ycms::t ( 'blockedip','管理操作' ),
            'class' => 'CButtonColumn',
            'buttons' => array (
                'delete' => array ( //这里我们添加一个上移的按钮
                    'label' => Ycms::t ( 'blockedip','删除' ),
                    'imageUrl' => false,
                ),
            ),
            'template' => '{delete}',
            'deleteButtonUrl' => 'Yii::app()->controller->createUrl("BlockedIp",array("id"=>$data["id"]))',
        ),
    ),
) );
?>