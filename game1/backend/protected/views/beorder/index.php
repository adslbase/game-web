<?php if (Yii::app()->user->hasFlash('success')): ?>
                <div class="notification notesuccess png_bg">
                        <div>
                                <?php echo Yii::app()->user->getFlash('success'); ?>
                        </div>
                </div>
                <script type="text/javascript" >
                        $(".notification").delay(2100).fadeOut(1300);
                </script>
        <?php endif; ?>

<?php if (Yii::app()->user->hasFlash('error')): ?>
                <div class="notification noteerror png_bg">
                        <div>
                                <?php echo Yii::app()->user->getFlash('error'); ?>
                        </div>
                </div>
                <script type="text/javascript" >
                        $(".notification").delay(2100).fadeOut(1300);
                </script>
        <?php endif; ?>

<?php
        $this->widget('zii.widgets.grid.CGridView', array(
                    'id' => 'order-grid',
                    'dataProvider' => $dataProvider,
                    'filter' => $model,
                    'summaryText' => t('显示') . ' {start} - {end} ' . t('有') . ' {count} ' . t('结果'),
                    'columns' => array(
                                array(
                                            'name' => 'id',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'trade_sn',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'userid',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'username',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'payname',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'gamename',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'servername',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'status',
                                            'type' => 'raw',
                                ),
                                array(
                                            'name' => 'money',
                                            'type' => 'raw',
                                ),
                                array(
                                            'class' => 'CButtonColumn',
                                            'template' => '{update} ',
                                            'buttons' => array(
                                                        'update' => array(
                                                                    'label' => t('编辑'),
                                                                    'imageUrl' => false,
                                                                    'url' => 'Yii::app()->createUrl("' . app()->controller->id . '/update", array("id"=>$data->id))',
                                                        ),
                                            ),
                                ),
                                array(
                                            'class' => 'CButtonColumn',
                                            'template' => '{charge} ',
                                            'buttons' => array(
                                                        'charge' => array(
                                                                    'label' => t('补单'),
                                                                    'imageUrl' => false,
                                                                    'url' => 'Yii::app()->createUrl("' . app()->controller->id . '/charge", array("id"=>$data->id))',
                                                                    'options' => array('onclick' => 'return ajaxcharge(this.href)')
                                                        )
                                            ),
                                ),
                    )
        ));
?>


<script>
        function ajaxcharge(url)
        {
                var a= window.confirm("您确定要为该用户补单吗？你需要对你所做的事情进行负责！");
                if(a)
                {
                        $.getJSON(url, function(data){
                                alert(data.message);
                                if(data.r == 1 )
                                {
                                        window.location.reload(); 
                                }
                        });
                }
                
                

                return false;
        }

</script>