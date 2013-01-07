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
                        <?php echo $form->label($model, 'card_explain'); ?>
                        <?php echo $form->textArea($model, 'card_explain', array('id' => 'card_explain')); ?>
                        <?php echo $form->error($model, 'card_explain'); ?>
                        
                        <?php echo $form->label($model, 'card_reward'); ?>
                        <?php echo $form->textArea($model, 'card_reward', array('id' => 'card_reward')); ?>
                        <?php echo $form->error($model, 'card_reward'); ?>
                       
                        
                        <?php
                                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);
                        ?>

        <?php echo $form->label($model, 'card_logo'); ?>
                        <?php echo $form->textField($model, 'card_logo', array('id' => 'card_logo')); ?>   <img valign="top" alt="Image" title="Image" onClick="insertFileToUrl('image',this);" src="<?php echo $backend_asset; ?>/images/insert_image.png" class="card_logo"/>
                        <?php echo $form->error($model, 'server_ico'); ?>
                </div>                                     
        </div>
</div>

<script type="text/javascript">
                var config =
	    {
		height: 200,
		width : '100%',
		resize_enabled : false,
		
		toolbar :
		[
		['Source','-','Bold','Italic','Underline','Strike','-','SelectAll','RemoveFormat'],
		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['Link','Unlink','Table'],
		['Styles','Format','Font','FontSize'],
		['TextColor','BGColor'],
		]
	};
	
        //Set for the CKEditor
		$('#card_explain').ckeditor(config);
                                $('#card_reward').ckeditor(config);
                                
                                
        function insertFileToUrl(type,url){
                $.prettyPhoto.open('<?php echo bu(); ?>/beresource/createframe?parent_call=true&id='+$(url).attr('class')+'&type='+type+'&iframe=true&height=400','<?php echo t('上传附件'); ?>','');
        }

        function afterUploadResourceWithUrl(id,resource_path){    
                $('#'+id).val(resource_path);
                
                $.prettyPhoto.close();
                return;    	
        }
</script>