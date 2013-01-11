
<?php
    $form = $this->beginWidget('ycms.widget.YActiveForm', array(
                        'uniform' => true,
                ));
?>

<?php echo $form->errorSummary($model, null, null, array('id' => 'errorMsg')); ?>

<fieldset>


    <?php if ($this->action->id == 'create'): ?>
            <div class="ctrlHolder">
                <?php echo $form->labelEx($model, 'parent_id'); ?>
                <?php echo $form->dropDownList($model, 'parent_id', $menus); ?>
                <?php echo $form->hint($model, 'parent_id'); ?>
            </div>
        <?php endif; ?>

    <?php echo $form->beginHolder($model, 'name'); ?>
    <?php echo $form->labelEx($model, 'name'); ?>
    <?php echo $form->textField($model, 'name'); ?>
    <?php echo $form->hint($model, 'name'); ?>
    <?php echo $form->endHolder(); ?>

    <?php echo $form->beginHolder($model, 'style'); ?>
    <?php echo $form->labelEx($model, 'style'); ?>

    <span id="diy-style">
        <?php $this->widget('ycms.widget.colorpicker.YColorPicker', array('model' => $model, 'attribute' => 'style[color]', 'htmlOptions' => array('style' => 'width:60px;'))) ?>
    </span>

    <?php echo $form->textField($model, 'style[class]', array('class' => 'short', 'id' => 'custom-style', 'style' => 'display:none;')); ?>

    <?php echo YHtml::checkBox('style-switch', FALSE, array('onclick' => 'if($(this).attr("checked")){$("#custom-style").show();$("#diy-style").hide();}else{$("#custom-style").hide();$("#diy-style").show();}')); ?>
    <?php echo YHtml::label('自定义', 'style-switch', array('style' => 'display:inline; font-weight:normal')) ?>

    <?php echo $form->hint($model, 'style'); ?>
    <?php echo $form->endHolder(); ?>



    <?php echo $form->beginHolder($model, 'alias'); ?>
    <?php echo $form->labelEx($model, 'alias'); ?>
    <?php echo $form->textField($model, 'alias'); ?>
    <?php echo $form->hint($model, 'alias'); ?>
    <?php echo $form->endHolder(); ?>




    <?php echo $form->beginHolder($model, 'route'); ?>
    <?php echo $form->labelEx($model, 'route'); ?>
    <?php echo $form->textField($model, 'route', array('class' => 'short')); ?>
    <?php echo $form->checkBox($model, 'external', array('onclick' => '$("#link-param").toggle()')); ?> <?php echo $form->labelEx($model, 'external', array('style' => 'display:inline; font-weight:normal')); ?>
    <?php echo $form->hint($model, 'route'); ?>
    <?php echo $form->endHolder(); ?>

    <?php echo $form->beginHolder($model, 'param', array('id' => 'link-param')); ?>
    <?php echo $form->labelEx($model, 'param'); ?>
    <?php echo $form->textField($model, 'param'); ?>
    <?php echo $form->hint($model, 'param'); ?>
    <?php echo $form->endHolder(); ?>

    <div class="ctrlHolder">
        <?php echo $form->labelEx($model, 'target'); ?>
        <?php echo $form->dropDownList($model, 'target', array('' => '同一窗口或标签', '_blank' => '新窗口或新标签', '_top' => '不包含框架的当前窗口或标签')); ?>
        <?php echo $form->hint($model, 'target'); ?>
    </div>

    <div class="ctrlHolder noLabel">
        <ul>
            <li><?php echo $form->label($model, 'hidden', array('element' => 'openfor')); ?><?php echo $form->checkBox($model, 'hidden'); ?> <?php echo $form->label($model, 'hidden', array('element' => 'close')); ?></li>
        </ul>
        <?php echo $form->hint($model, 'hidden'); ?>
    </div>



    <div class="ctrlHolder">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 2, 'cols' => 50)); ?>
        <?php echo $form->hint($model, 'description'); ?>
    </div>

    <div class="buttonHolder">
        <?php echo YHtml::submitButton('提交', array('class' => 'primaryAction')); ?>
        <?php if ($this->action->id == 'update'): ?>
                <?php echo YHtml::link('删除链接', Ycms::app()->createUrl("link/delete", array("mid" => $mid)), array('onclick' => "if(!confirm('确定要删除这条数据吗?')) return false;", 'encode' => false, 'style' => 'padding-left:10px;')) ?>
            <?php endif; ?>
    </div>
</fieldset>
<?php $this->endWidget(); ?>
