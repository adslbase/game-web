<div class="content-box">
        <div class="content-box-header">
                <h3><?php echo t('主要内容'); ?></h3>                             
        </div> 
        <div class="content-box-content" style="display: block;">

                <div class="tab-content default-tab" id="extra_box">

                        <?php echo $form->label($model, 'game_sn'); ?>
                        <?php echo $form->textField($model, 'game_sn', array('id' => 'txt_game_sn')); ?>
                        <?php echo $form->error($model, 'game_sn'); ?>

                        <?php echo $form->label($model, 'new_service'); ?>
                        <?php echo $form->textField($model, 'new_service', array('id' => 'txt_new_service')); ?>
                        <?php echo $form->error($model, 'new_service'); ?>

                        <?php echo $form->label($model, 'service_url'); ?>
                        <?php echo $form->textField($model, 'service_url', array('id' => 'txt_service_url')); ?>
                        <?php echo $form->error($model, 'service_url'); ?>

                        <?php echo $form->label($model, 'site_url'); ?>
                        <?php echo $form->textField($model, 'site_url', array('id' => 'txt_site_url')); ?>
                        <?php echo $form->error($model, 'site_url'); ?>

                        <?php echo $form->label($model, 'help_url'); ?>
                        <?php echo $form->textField($model, 'help_url', array('id' => 'txt_help_url')); ?>
                        <?php echo $form->error($model, 'help_url'); ?>

                        <?php echo $form->label($model, 'card_url'); ?>
                        <?php echo $form->textField($model, 'card_url', array('id' => 'txt_card_url')); ?>
                        <?php echo $form->error($model, 'card_url'); ?>

                        <?php echo $form->label($model, 'bbs_url'); ?>
                        <?php echo $form->textField($model, 'bbs_url', array('id' => 'txt_bbs_url')); ?>
                        <?php echo $form->error($model, 'bbs_url'); ?>

                        <?php echo $form->label($model, 'ratio'); ?>
                        <?php echo $form->textField($model, 'ratio', array('id' => 'txt_ratio')); ?>
                        <?php echo $form->error($model, 'ratio'); ?>

                        <?php echo $form->label($model, 'money_name'); ?>
                        <?php echo $form->textField($model, 'money_name', array('id' => 'txt_money_name')); ?>
                        <?php echo $form->error($model, 'money_name'); ?>
                        <?php
                                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);
                        ?>

                        <?php echo $form->label($model, 'ico_logo'); ?>
                        <?php echo $form->textField($model, 'ico_logo', array('id' => 'ico_logo')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="ico_logo"/>
                        <?php echo $form->error($model, 'ico_logo'); ?>

                        <?php echo $form->label($model, 'small_logo'); ?>
                        <?php echo $form->textField($model, 'small_logo', array('id' => 'small_logo')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="small_logo"/>
                        <?php echo $form->error($model, 'small_logo'); ?>

                        <?php echo $form->label($model, 'medium_logo'); ?>
                        <?php echo $form->textField($model, 'medium_logo', array('id' => 'medium_logo')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="medium_logo"/>
                        <?php echo $form->error($model, 'medium_logo'); ?>

                        <?php echo $form->label($model, 'big_logo'); ?>
                        <?php echo $form->textField($model, 'big_logo', array('id' => 'big_logo')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="big_logo"/>
                        <?php echo $form->error($model, 'big_logo'); ?>
                        
                                                <?php echo $form->label($model, 'game_banner'); ?>
                        <?php echo $form->textField($model, 'game_banner', array('id' => 'game_banner')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="game_banner"/>
                        <?php echo $form->error($model, 'game_banner'); ?>
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