                <?php echo $form->labelEx($model, 'level'); ?>
                <?php echo $form->dropDownList($model, 'level', ConstantDefine::getContentLevel()); ?>
                <?php echo $form->error($model, 'level'); ?>

                <?php echo $form->labelEx($model, 'order'); ?>
                <?php echo $form->textArea($model, 'order',array('tabindex' => '1', 'id' => 'txt_order')); ?>
                <?php echo $form->error($model, 'order'); ?>