<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/gamecenter.css');
?>
<div id="warp" class="wp">
        <div id="sider">
                <!--User Login begin-->
                <!--User Login begin-->
                <div id="userLogin">
                        <div id="ul_title"><h2>MarsTV网页游戏平台</h2></div>
                        <div id="ul_cont">
                                <?php $this->widget('frontwidgets.signin.SigninBlock'); ?>
                        </div>
                </div>
                <?php $this->widget('frontwidgets.game.GameBlock', array('template' => 'gamecenter', 'status' => 1)); ?>
        </div>
        <div id="cont">
                <div class="game_theme mgB15" id="server_top">
                        <div class="pic">
                                <img src="<?php echo $game['game_banner'] ?>" width="710" height="267">
                        </div>
                        <div class="mask"></div>
                        <div class="menu">
                                <div class="cont">      
                                        <ul class="menus">       
                                                <li class="begin">
                                                        <a href="<?php echo $game['site_url'] ?>" target="_blank">进入官网</a>
                                                </li>        
                                                <li class="begin">
                                                        <a href="<?php echo $game['help_url'] ?>" target="_blank">攻略</a>
                                                </li>   
                                                <!--                                                <li class="begin">
                                                                                                        <a  href="/csws/newcard.htm" target="_blank">新手卡</a>
                                                                                                </li>        -->
                                                <li class="begin">
                                                        <a  href="<?php echo $this->createUrl('sign/up') ?>" target="_blank">注册</a>
                                                </li>        
                                                <li class="end">
                                                        <a  href="<?php echo $this->createUrl('payway/game', array('gameid' => $game['object_id'])); ?>">充值</a>
                                                </li>   
                                        </ul>
                                </div>
                        </div>
                </div>
                <div class="model_4">
                        <div class="model_4_top">
                                <div class="model_4_inner">
                                        <h2 class="server_title"><em><span id="spGameName"></span></em>服务器列表</h2>
                                        <div class="hr2"></div>
                                        <div class="server_info">
                                                <div class="cont clearfix" id="game_servers">

                                                        <?php $this->widget('frontwidgets.gameserver.GameServerBlock'); ?>

                                                        <div class="clear"></div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>

