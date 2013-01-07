<?php 
$this->pageTitle=t('管理菜单');
$this->pageHint=t('管理菜单'); 
?>
<?php $this->widget('backwidgets.ModelManageWidget',array('model_name'=>'Menu')); 
?>