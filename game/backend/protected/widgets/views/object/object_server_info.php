<div class="content-box">
        <div class="content-box-header">
                <h3><?php echo t('主要内容'); ?></h3>                             
        </div> 
        <div class="content-box-content" style="display: block;">

                <div class="tab-content default-tab" id="extra_box">
                        <?php
                                $this->widget('backwidgets.object.ObjectGameFormWidget', array(
                                            'model' => $model,
                                            'form'=>$form,
                                            'attribute' => 'object_parent'
                                ));
                        ?>
                        <?php echo $form->label($model, 'server_sn'); ?>
                        <?php echo $form->textField($model, 'server_sn', array('id' => 'txt_server_sn')); ?>
                        <?php echo $form->error($model, 'server_sn'); ?>
                        
                        <?php echo $form->label($model, 'server_key'); ?>
                        <?php echo $form->textField($model, 'server_key', array('id' => 'txt_server_key')); ?>
                        <?php echo $form->error($model, 'server_key'); ?>
                        
                                                <?php echo $form->label($model, 'server_is_pay'); ?>
                        <?php echo $form->dropDownList($model, 'server_is_pay', ConstantDefine::getServerIsPay()); ?>
                        <?php echo $form->error($model, 'server_is_pay'); ?>
                        
                        
                        <?php
                                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);
                        ?>

                        <?php echo $form->label($model, 'server_ico'); ?>
                        <?php echo $form->textField($model, 'server_ico', array('id' => 'server_ico')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="server_ico"/>
                        <?php echo $form->error($model, 'server_ico'); ?>


        <?php echo $form->label($model, 'server_framelogo'); ?>
                        <?php echo $form->textField($model, 'server_framelogo', array('id' => 'server_framelogo')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="server_framelogo"/>
                        <?php echo $form->error($model, 'server_ico'); ?>
                        
                        <?php echo $form->label($model, 'server_band'); ?>
                        <?php echo $form->dropDownList($model, 'server_band', ConstantDefine::getServerBand()); ?>
                        <?php echo $form->error($model, 'server_band'); ?>

                        <?php echo $form->label($model, 'server_status'); ?>
                        <?php echo $form->dropDownList($model, 'server_status', ConstantDefine::getServerStatus()); ?>
                        <?php echo $form->error($model, 'server_status'); ?>

                        <?php echo $form->label($model, 'server_date'); ?>
                        <?php
                                $this->widget('common.extensions.timepicker.EJuiDateTimePicker', array(
                                            'model' => $model,
                                            'attribute' => 'server_date',
                                            'datePickerOnly' => true,
                                            'options' => array('dateFormat' => 'yy-mm-dd'),
                                ));
                        ?>
                        <?php
                                $this->widget('common.extensions.timepicker.EJuiDateTimePicker', array(
                                            'model' => $model,
                                            'attribute' => 'server_time',
                                            'timePickerOnly' => true,
                                ));
                        ?>时
                        <?php echo $form->error($model, 'server_date'); ?> <?php echo $form->error($model, 'server_time'); ?>
                        
                        <?php echo $form->label($model, 'server_online'); ?>
                        <?php echo $form->textField($model, 'server_online', array('id' => 'txt_server_online')); ?>
                        <?php echo $form->error($model, 'server_online'); ?>
                        
                        <?php echo $form->label($model, 'server_login_gateway'); ?>
                        <?php echo $form->textField($model, 'server_login_gateway'); ?>
                        <?php echo $form->error($model, 'server_login_gateway'); ?>

                        <?php echo $form->label($model, 'server_pay_gateway'); ?>
                        <?php echo $form->textField($model, 'server_pay_gateway'); ?>
                        <?php echo $form->error($model, 'server_pay_gateway'); ?>
                </div>                                     
        </div>
</div>

<script type="text/javascript">
        
        function insertFileToUrl(type,url){
                $.prettyPhoto.open('<?php echo bu(); ?>/beresource/createframe?parent_call=true&id='+$(url).attr('class')+'&type='+type+'&iframe=true&height=400','<?php echo t('上传附件'); ?>','');
        }

        function afterUploadResourceWithUrl(id,resource_path){    
                $('#'+id).val(resource_path);
                
                $.prettyPhoto.close();
                return;    	
        }
</script>