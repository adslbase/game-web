<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/payway.css');
?>

<div class="main mgAuto">
        <div class="inner">
                <div class="payflow mgB5">
                        <div class="cont">
                                <ol class="step4">
                                        <li><strong>选择充值游戏</strong></li>
                                        <li>选择充值方式</li>
                                        <li>确认充值信息</li>
                                        <li>充值成功</li>
                                </ol>
                        </div>
                </div>
                <div class="leftSide">
                        <div class="leftSide_inner">
                                <div class="leftSide_cont" id="div1">
                                        <div class="mod_1 helpcenter">
                                                <h2> 充值帮助</h2>
                                                <ul class="mgB10">
                                                        <?php $this->widget('frontwidgets.helpcenter.HelpcenterBlock'); ?>
                                                </ul>
                                                <a href="<?php echo $this->createUrl('customer/index') ?>" target="_blank" class="clientser">充值咨询 联系客服</a>
                                                <div class="clear"> </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="rightSide">
                        <div class="rightSide_inner">
                                <div class="rightSide_cont" id="div2">
                                        <div class="paywayAll">
                                                <p class="paywayHeader">
                                                        <strong><?php echo $message; ?></strong></p>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="clear"> </div>
        </div>
</div>

