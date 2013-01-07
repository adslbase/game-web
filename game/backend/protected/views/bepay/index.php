<?php if(Yii::app()->user->hasFlash('success')):?>
<div class="notification notesuccess png_bg">
<div>
 <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
</div>
<script type="text/javascript" >
      $(".notification").delay(2100).fadeOut(1300);
</script>
<?php endif; ?>

<?php if(Yii::app()->user->hasFlash('error')):?>
<div class="notification noteerror png_bg">
<div>
 <?php echo Yii::app()->user->getFlash('error'); ?>
</div>
</div>
<script type="text/javascript" >
      $(".notification").delay(2100).fadeOut(1300);
</script>
<?php endif; ?>

        <?php Yii::app()->controller->pageTitle = '支付模块'; ?>


        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $dataProvider,
            'template' => "{items}\n{pager}",
            'htmlOptions' => array('class' => 'grid-view assignment-table'),
            'columns' => array(
                array(
                    'name' => 'name',
                    'header' => '支付名称',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'name-column'),
                  
                ),
                array(
                    'name' => 'desc',
                    'header' => '描述',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'role-column'),
                ),
                array(
                    'name' => 'order',
                    'header' => '排序',
                    'type' => 'raw',
                    'htmlOptions' => array('class' => 'task-column'),
                ),
                array(
                    'header' => '管理操作',
                    'type' => 'raw',
                    'value'=>'Payway::getOperation($data)'
                ),
          
            )
        ));
        ?>
