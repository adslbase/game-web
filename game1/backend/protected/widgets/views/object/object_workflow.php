
<div class="row odd buttons border-left-silver">                                                                                       

        <?php echo $form->dropDownList($model, 'object_status', $content_status, array('class' => 'status_select')); ?>
        <?php echo CHtml::Button(t('发布'), array('class' => 'button active', 'onClick' => 'return doFormSave();', 'style' => 'display:block;width:100px')); ?>
        <div class="clear"></div>

        <script type="text/javascript">
                function doFormSave(){
                        $('#object-form').submit();
                }                                                     
        </script>
</div>