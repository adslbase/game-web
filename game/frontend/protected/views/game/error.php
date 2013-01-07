<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>
<!doctype html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
                <title><?php echo $this->pageTitle . '-' . settings()->get('general', 'site_name'); ?></title>
                <?php
                        $cs = Yii::app()->clientScript;
                        $cs->registerCssFile($layout_asset . '/css/game.css');
                ?>
                <style>
                        body {
                                background:url(<?php echo $server['server_framelogo'] ?>) black center center no-repeat;
                        }
                </style>
        </head>
        <body>
                <?php $this->widget('frontwidgets.artdialog.MArtdialog'); ?>

                <?php if ($isGuest == FALSE): ?>
                                <script>
                                        art.dialog({
                                                title:'<?php echo $message['title']; ?>',
                                                content: '<?php echo $message['content']; ?>',
                                                fixed: true,
                                                drag: false,
                                                resize: false,
                                                close:function () {
                                                        return false;
                                                }
                                        }).show();
                                </script>
                        <?php else : ?>

                                <div id="userLogin">
                                        <?php $this->widget('frontwidgets.signin.SigninBlock'); ?>
                                </div>
                                <script>
                                        art.dialog({
                                                title:'<?php echo $message['title']; ?>',
                                                content: document.getElementById('userLogin'),
                                                fixed: true,
                                                drag: false,
                                                resize: false,
                                                close:function () {
                                                        return false;
                                                }
                                        }).show();
                                </script>

                <?php endif; ?>
        </body>
</html>