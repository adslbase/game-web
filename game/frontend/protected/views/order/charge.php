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
                                     
                                                                <div class=" payInfo">

                                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="mgAuto mgB10 mgT20">
                                                                                <tbody><tr>
                                                                                                <th width="46%">
                                                                                                        您的充值方式是：
                                                                                                </th>
                                                                                                <td width="54%">
                                                                                                        <?php echo $order['payname']; ?>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <th>
                                                                                                        您充值的游戏是：
                                                                                                </th>
                                                                                                <td>
                                                                                                        <em>
                                                                                                                <?php echo $order['gamename']; ?>
                                                                                                        </em>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <th>
                                                                                                        您充值的区服是：
                                                                                                </th>
                                                                                                <td>
                                                                                                        <?php echo $order['servername']; ?>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <th>
                                                                                                        您的订单编号是：
                                                                                                </th>
                                                                                                <td>
                                                                                                        <?php echo $order['trade_sn']; ?>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <th>
                                                                                                        您充值的帐号是：
                                                                                                </th>
                                                                                                <td>
                                                                                                        <em>
                                                                                                                <?php echo $order['username']; ?>
                                                                                                        </em>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <th>
                                                                                                        您充值的金额是：
                                                                                                </th>
                                                                                                <td>
                                                                                                        <span>
                                                                                                                <?php echo $order['money']; ?>
                                                                                                        </span>元(人民币)
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <th>
                                                                                                        对应的
                                                                                                        <?php echo $order['gameunit']; ?> 
                                                                                                        是：
                                                                                                </th>
                                                                                                <td>
                                                                                                        <span>
                                                                                                                <?php echo $order['quantity']; ?> 
                                                                                                        </span>
                                                                                                        <?php echo $order['gameunit']; ?> 
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td colspan="2">
                                                                                                        <div class="hr2">
                                                                                                        </div>
                                                                                                </td>
                                                                                        </tr>
                                                                                        <tr>
                                                                                                <td colspan="2">
                                                                                                        <input type="button" value="进行兑换" class="chargeBtn" id="continueBtn" onclick="window.location = '<?php echo $this->createUrl('order/charge', array('sn' => $order['trade_sn'])); ?>'"  hidefocus />
                                                                                                </td>
                                                                                        </tr>
                                                                                </tbody></table>        
                                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="clear"> </div>
        </div>
</div>

