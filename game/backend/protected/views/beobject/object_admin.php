<?php
        switch ($type)
        {
                case 'game' :
                        $this->pageTitle = t('管理游戏');
                        break;

                case 'article' :
                        $this->pageTitle = t('管理文章');
                        break;
                case 'card' :
                        $this->pageTitle = t('管理新手卡');
                        break;
                default :
                        $this->pageTitle = t('管理内容');
                        break;
        }
?>
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


<?php $this->widget('backwidgets.object.ObjectManageStatusWidget', array('type' => $type));
?>


