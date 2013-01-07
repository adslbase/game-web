<div class="form span-12 first">
        <?php $form = $this->beginWidget('CActiveForm'); ?>
        <div class="row">
                支付方式:<?php echo $model->name ?>
        </div>
        <div class="row">
                <?php echo $form->labelEx($model, 'name'); ?>
                <?php echo $form->textField($model, 'name', array('maxlength' => 255, 'class' => 'text-field')); ?>
                <?php echo $form->error($model, 'name'); ?>
        </div>
        <div class="row">
                <?php echo $form->labelEx($model, 'is_online'); ?>
                <?php
                $b = $model->is_online ? '是' : '否';
                echo $b;
                ?>
                <?php echo $form->error($model, 'is_online'); ?>
                <?php echo $form->hiddenField($model, 'is_online'); ?>
        </div>

        <div class="row">
                <label>网银在线商户号：</label> 
                <?php echo $form->textField($model, 'pay_account'); ?>
                <?php echo $form->error($model, 'pay_account'); ?>
        </div>
        <div class="row">
                <label>网银在线MD5私钥：</label> 
                <?php echo $form->textField($model, 'config[chinabank_key]'); ?>
                <?php echo $form->error($model, 'config[chinabank_key]'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($model, 'pay_method'); ?>
                <?php echo $form->dropDownList($model, 'pay_method', ConstantDefine::getPayMethod()); ?>
                <?php echo $form->error($model, 'pay_method'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($model, 'pay_fee'); ?>
                <?php echo $form->textField($model, 'pay_fee', array('maxlength' => 255, 'class' => 'textField')); ?>
                <?php echo $form->error($model, 'pay_fee'); ?>
        </div>
        <div class="row">
                <?php echo $form->labelEx($model, 'order'); ?>
                <?php echo $form->textField($model, 'order', array('maxlength' => 255, 'class' => 'textField')); ?>
                <?php echo $form->error($model, 'order'); ?>
        </div>
        <div class="row">
                <?php echo $form->labelEx($model, 'desc'); ?>
                <?php echo $form->textarea($model, 'desc', array('maxlength' => 255, 'class' => 'textarea')); ?>
                <?php echo $form->error($model, 'desc'); ?>
        </div>
             <?php if(!$model->isNewRecord):?>
  <?php echo $form->hiddenField($model, 'pay_id'); ?>
        <?php endif;?>
                <?php echo $form->hiddenField($model, 'enabled', array('value' => 1)); ?>

                <?php echo $form->hiddenField($model, 'class'); ?>


        <div class="row buttons">
                <?php echo CHtml::submitButton(Rights::t('core', 'Save')); ?> | <?php echo CHtml::link(Rights::t('core', 'Cancel'), Yii::app()->user->rightsReturnUrl); ?>
        </div>

        <?php $this->endWidget(); ?>

</div>     



