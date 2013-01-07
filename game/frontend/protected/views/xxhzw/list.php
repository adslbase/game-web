<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/xxhzw/list.css');
?>
<div id="web_cont" class="wp">
	<div id="sider">
	<div id="user_login">
                        <div id="user_title"></div>
                        <div id="user_cont">

                             <?php $this->widget('frontwidgets.signin.SigninBlock',array('template'=>'xxhzw')); ?>
                        </div>
                </div>
	     <div id="star_game"><a href="<?php echo $this->createUrl('xxhzw/server')?>" title="进入游戏" class="text_td">进入游戏</a></div>
                <div id="ka">
                        <ul>
                                <li><span></span><a href="http://g.marstv.com/card/index.html" title=""><img src="<?php echo $layout_asset . '/css/xxhzw/images/xsk.jpg' ?>" alt="领取新手卡" /></a></li>
                                <li><span></span><a href="<?php echo $this->createUrl('payway/game', array('gameid' => $this->gameid)); ?>" title="">
                                                <img src="<?php echo $layout_asset . '/css/xxhzw/images/yxcz.jpg' ?>" alt="游戏充值" />
                                        </a>
                                </li>
                        </ul>
                </div>
    <div id="game_server" class="scol">
    	<div id="gs_title" class="scol_title"><h2 class="text_td">游戏服务器</h2></div>
        <div id="gs_cont" class="scol_cont">
        	<ul>
                    <?php $this->widget('frontwidgets.gameserver.GameServerBlock', array('template' => 'xxhzw', 'gameid' => $this->gameid)); ?>
            </ul>
        </div>
        <div class="scol_bottom"></div>
    </div>
    <div id="game_info">
    	<div id="gi_title" class="scol_title"><h2 class="text_td">游戏介绍</h2></div>
        <div id="gi_cont" class="scol_cont">
        	<dl>
            	<dt><a href="javascript:;" title="" class="yellow">小小海贼王</a></dt>
                <dd>小小海贼王 游戏以<span class="yellow">《海贼王》</span>剧情为蓝本，故事发生在大海贼时代，人人都有一个航海之梦，都渴望获得海贼王的荣誉和数之不尽的海贼大宝藏。在金钱与利益的驱使下...</dd>
            </dl>
        </div>
        <div class="scol_bottom"></div>
    </div>
</div>
	<div id="cont">
    	<div id="conter">
        	<div id="title">
            	<div id="title_left"></div>
            	<dl>
                	<dt>您的当前位置-</dt>
                    <dd><a href="javascript:;" title="">首页</a>-</dd>
                    <dd><a href="javascript:;" title="">游戏资料</a></dd>
                </dl>
                <div id="title_right"></div>
             </div>
            <div id="text">
            	<div id="text_warp">            		
                	<div id="text_cont">
                                
                                        <?php
                                        $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider,
                                            'itemView' => '_list',
                                            'itemsTagName' => 'ul',
                                                    'ajaxUpdate'=>FALSE
                                        ));
                                        ?>                                              
                </div>
                </dt>
            </div>
            	<div id="text_bottom"></div>
        </div>
    </div>
</div>
</div>
