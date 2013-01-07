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
                     <?php $this->widget('frontwidgets.game.GameBlock',array('template'=>'gamecenter','status'=>1));?>
        </div>
    <div id="cont">
    	<div id="reg_warp">
    	<div id="reg_cont">
        	<div id="reg_title"><h2>游戏中心&gt;平台热推</h2></div>
        </div>
    </div>
    	<div id="gameList_cont">
                     <?php $this->widget('frontwidgets.game.GameBlock',array('level'=>3));?>
        </div>
        <div class="cl"></div>
        <div id="gamecont_list">
                 <?php $this->widget('frontwidgets.game.GameBlock',array('template'=>'list','status'=>1));?>
            <div class="cl"></div>
        </div>
        <div class="cl"></div>
    </div>
</div>

