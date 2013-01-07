<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
            
                array('name'=>'object_id',
			'type'=>'raw',			
			'value'=>$model->object_id,
		    ),
                
		array(
			'name'=>'object_name',
			'type'=>'raw',		
			'value'=>CHtml::link($model->object_name,array("update","id"=>$model->object_id)),
		    ),

                array(
			'name'=>'comment_status',
			'value'=>Object::convertObjectCommentType($model->comment_status)
		),
                array(
			'name'=>'object_date',
			'value'=>date("Y-m-d H:i:s", $model->object_date)
		),
                array(
			'name'=>'object_type',
			'type'=>'raw',			
			'value'=>Object::convertObjectType($model->object_type),
		    ),            
		array(
			'name'=>'object_status',
			'type'=>'raw',			
			'value'=>Object::convertObjectStatus($model->object_status),
		),
                'object_view',
            
            
		
	),
)); ?>
