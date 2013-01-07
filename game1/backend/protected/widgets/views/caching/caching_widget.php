<div class="form">
<?php $this->render('backwidgets.views.notification'); ?>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=backend_assets"><?php echo t('清除后台资源'); ?></a>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=backend_cache"><?php echo t('清除后台缓存'); ?></a>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=frontend_assets"><?php echo t('清除前台资源'); ?></a>
<a class="button" href="<?php echo bu();?>/becaching/clear?cache_id=frontend_cache"><?php echo t('清除前台缓存'); ?></a>
</div>