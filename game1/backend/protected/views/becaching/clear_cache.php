<?php 
$this->pageTitle=t('缓存管理');
$this->pageHint=t('清楚前台和后台缓存文件和静态文件'); 
?>
<?php $this->widget('backwidgets.caching.CachingClearWidget',array()); 
?>