<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/pay.css');
?>


<div id="warp">
        <div id="pay_top">
                <div id="payt_cont"></div>
        </div>
        <div id="pay_sider">
                <div id="pays_title"><h2>充值帮助</h2></div>
                <div id="pays_cont">

                        <?php $this->widget('frontwidgets.helpcenter.HelpcenterBlock'); ?>

                        <a href="<?php echo $this->createUrl('customer/index'); ?>" title="" class="pays_btn">充值咨询 联系客服</a>
                </div>
        </div>
        <div id="pay_cont">
                 <?php $this->widget('frontwidgets.game.GameBlock',array('template'=>'payway','status'=>1));?>
                <div class="cl"></div>
        </div>
</div>

