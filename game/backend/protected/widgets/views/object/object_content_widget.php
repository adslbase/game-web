
<div id="titlewrap">
        <?php echo $form->textField($model, 'object_name', array('class' => 'specialTitle', 'tabindex' => '1', 'id' => 'txt_object_name')); ?>
        <?php echo $form->error($model, 'object_name'); ?>									
</div>

<div id="small_buttons_insert" align="right">
        <span><?php echo t('插入'); ?></span>
        <?php
                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);
        ?>
        <img valign="top" alt="Image" title="Image" onClick="insertFileToContent('image');" src="<?php echo $backend_asset; ?>/images/insert_image.png" />

</div>
<div id="bodywrap">		
        <?php echo $form->textArea($model, 'object_content', array('tabindex' => '2', 'class' => 'specialContent', 'id' => 'ckeditor_content')); ?>
        <?php echo $form->error($model, 'object_content'); ?>                                                          
</div>

<script type="text/javascript">
        var config =
	    {
		height: 300,
		width : '100%',
		resize_enabled : false,
		
		toolbar :
		[
		['Source','-','Bold','Italic','Underline','Strike','-','Subscript','Superscript','-','SelectAll','RemoveFormat'],
		['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
		['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		['BidiLtr', 'BidiRtl'],
		['Link','Unlink','Anchor'],
		['Image', 'Media','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe','-','Save','NewPage','Preview','-','Templates','-','Cut','Copy','Paste','PasteText','PasteFromWord'],
		'/',
		['Undo','Redo','-','Find','Replace','-','Styles','Format','Font','FontSize'],
		['TextColor','BGColor'],
		['Maximize', 'ShowBlocks','-','About']
		]
	};
	
        //Set for the CKEditor
		$('#ckeditor_content').ckeditor(config);
        
        
        
        
            function insertFileToContent(file_type){    			    	
    	$.prettyPhoto.open('<?php echo bu();?>/beresource/createframe?parent_call=true&ckeditor='+file_type+'&iframe=true&height=400','<?php echo t('上传附件');?>','');    	
    }
        function afterUploadResourceWithEditor(resource_id,resource_path,file_type,insert_type,width,height,alt){
    	var add_width='';
    	var add_height='';
    	var add_alt='';
    	if(width!='0') add_width='width="'+width+'"';
    	if(height!='0') add_height='height="'+height+'"';
    	if(alt!='') add_alt='alt="'+alt+'"';   
    	if(file_type=='image'){
    		CKEDITOR.instances['ckeditor_content'].insertHtml('<img '+add_width+' '+add_height+' '+ add_alt+' src="'+resource_path+'"/>');	
    	}
    	if(file_type=='video'){
    		/*
    		if(width!='0') add_width="'width': '"+width+"',";
    		if(height!='0') add_height="'height': '"+height+"',";
    		
			var video_insert="<div id='mediaplayer"+media_count+"'></div>"+			
			 '<script type="text/javascript" src="\'+player_path+\'/jwplayer.js"><'+'/script>'+'<script type="text/javascript">'+
			  "jwplayer('mediaplayer"+media_count+"').setup({"+
			    "'flashplayer': '\"+player_path+\"/player.swf',"+
			    "'id': 'playerID"+media_count+"',"+
			    add_width+
			    add_height+
			    "'file': '"+resource_path+"'"+
			  '});'+'<'+'/script>';			 
			  CKEDITOR.instances['ckeditor_content'].insertHtml(video_insert);
			  media_count++;	
			  */		
    	}
    		
    	
    	$.prettyPhoto.close();
    }
    </script>