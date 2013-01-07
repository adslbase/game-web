<div class="form">
        <?php $this->render('backwidgets.views.notification'); ?>
        <?php
                $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'menu-form',
                            'enableAjaxValidation' => true,
                                ));
        ?>

                <?php echo $form->errorSummary($model); ?>
        <div class="row">
                <?php echo $form->labelEx($model, 'menu_name'); ?>
                <?php echo $form->textField($model, 'menu_name'); ?>
<?php echo $form->error($model, 'menu_name'); ?>
        </div>
        <div class="row">
                <?php echo $form->labelEx($model, 'menu_description'); ?>
                <?php echo $form->textField($model, 'menu_description'); ?>
<?php echo $form->error($model, 'menu_description'); ?>
        </div>

                <?php if (!$model->isNewRecord) : ?>
                        <div class="row"> 
                                <?php
                                $this->widget('backwidgets.TreeFormWidget', array('title' => t('Items'),
                                            'form_create_url' => $this->form_create_term_url,
                                            'form_update_url' => $this->form_update_term_url,
                                            'form_change_order_url' => $this->form_change_order_term_url,
                                            'form_delete_url' => $this->form_delete_term_url,
                                            'list_items' => isset($list_items) ? $list_items : array()
                                ));
                                ?>
                        </div>
                        <?php endif; ?>  


        <div class="row buttons">
<?php echo CHtml::submitButton(t('保存'), array('class' => 'bebutton')); ?>
        </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
