<?php
        if (YII_DEBUG)
                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, true);
        else
                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);
?>
<?php $this->pageTitle = SITE_NAME; ?>
        <?php $types = GxcHelpers::getAvailableContentType(); ?>
        <ul class="shortcut-buttons-set">
                <?php foreach ($types as $type) : ?>
                                <li>
                                        <a href="<?php echo bu() . '/beobject/create/type/' . $type['id']; ?>" class="shortcut-button">
                                                <span>
                                                        <img alt="icon" src="<?php
                $icon_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.content_type.' . $type['id'] . '.assets'), false, -1, false);
                echo $icon_asset . '/' . $type['icon'];
                                ?>"><br />
                                <?php echo t('新建') . ' ' . $type['name']; ?>
                                                </span></a></li>
        <?php endforeach; ?>

                <li>
                        <a href="<?php echo bu() . '/beresource/create'; ?>" class="shortcut-button">
                                <span>
                                        <img alt="icon" src="<?php echo $backend_asset . '/images/upload_file.png'; ?>"><br />
<?php echo t('上传文件'); ?>
                                </span></a></li>


        </ul>
        <div style="clear:both"></div>


