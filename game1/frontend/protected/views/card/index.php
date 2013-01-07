<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/cardindex.css');
?>

<div id="warp" class="wp">
        <div id="sider">
                <!--User Login begin-->
                <div id="userLogin">
                        <div id="ul_title"><h2>MarsTV网页游戏平台</h2></div>
                        <div id="ul_cont">
                                <?php $this->widget('frontwidgets.signin.SigninBlock'); ?>
                        </div>
                </div>
                <!--User Login end-->
                <!--New Game begin-->
                <div id="newGame">
                        <div id="ng_title"><div class="ngt_left"></div><h2>新开服务列表</h2><div class="ngt_right"></div></div>
                        <div id="ng_cont">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr style="color:#fff;">
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">日期</td>
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">时间</td>
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">游戏名称</td>
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">服数</td>
                                        </tr>
                                        <?php $this->widget('frontwidgets.server.ServerBlock'); ?>
                                </table>

                        </div>
                </div>
                <!--New Game end-->
        </div>
        <div id="cont">
                <div id="new_ka">
                        <div id="nk_title" class="ka_title"><h2>新手卡列表</h2></div>
                        <div id="nk_cont">

                                <?php $this->widget('frontwidgets.game.GameBlock', array('template' => 'card', 'status' => 1, 'moreItem' => array('object_id' => 0, 'object_name' => '全部'))); ?>

                        </div>
                </div>


                <div id="game_inf">
                        <div id="gi_title" class="ka_title"><h2>游戏信息</h2></div>
                        <div id="gi_cont">
                                <?php $i = 0 ?>
                                <?php foreach ($cards as $card): ?>

                                                <dl <?php echo $i % 2 == 0 ? 'class="gi_bg"' : ''; ?>>
                                                        <dt>
                                                        <a href="<?php echo $this->createUrl('card/view', array('id' => $card['object_id'])); ?>" title="">
                                                                <img src="<?php echo $card['card_logo'] ?>" width="120" height="80" alt="<?php echo $card['object_name'] ?>" /></a>
                                                        </dt>
                                                        <dd class="game_name"><a href="<?php echo $this->createUrl('card/view', array('id' => $card['object_id'])); ?>"><?php echo $card['gamename'] ?></a><span><?php echo $card['object_name'] ?></span></dd>
                                                        <dd>游戏类型：<a href="javascript:;" title=""><?php echo $card['termname'] ?></a> </dd>

                                                        <dd>
                                                                <a href="<?php echo $card['site_url'] ?>" class="FBlue2" target="_blank">官网</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <a href="<?php echo $card['help_url'] ?>" class="FBlue2" target="_blank">攻略</a>&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <a href="<?php echo $this->createUrl('payway/game', array('gameid' => $card['gameid'])); ?>" target="_blank" class="FBlue2">充值</a>
                                                        </dd>
                                                        <dd class="gi_btn"><a href="<?php echo $this->createUrl('card/view', array('id' => $card['object_id'])); ?>" title="">领号</a></dd>
                                                </dl>
                                                <?php $i++ ?>
                                        <?php endforeach; ?>
                        </div>
                </div>



        </div>
</div>



