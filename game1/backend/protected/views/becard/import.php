<div class="form">
        <?php
                $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'code-form',
                            'enableAjaxValidation' => true,
                                ));
        ?>

        <?php echo $form->errorSummary($model); ?>
        <div class="row">
                <label >新手卡名称</label>
                <?php echo $card->object_name; ?>
                <?php echo $form->hiddenField($model, 'cardid', array('value'=>$card->object_id)); ?>
                 <?php echo $form->hiddenField($model, 'gameid', array('value'=>$card->object_parent)); ?>
        </div>
        
        <div class="row">
                <?php echo $form->label($model, 'serverid'); ?>
                <?php echo $form->dropDownList($model, 'serverid', $servers); ?>
                <?php echo $form->error($model, 'serverid'); ?>
        </div>
       
        <div class="row">
                <?php echo $form->labelEx($model, 'key'); ?>
                <?php echo $form->textarea($model, 'key'); ?>
                <?php echo $form->error($model, 'key'); ?>
        </div>


        <div class="row buttons">
                <?php echo CHtml::submitButton(t('保存'), array('class' => 'bebutton')); ?>
        </div>

        <?php $this->endWidget(); ?>




