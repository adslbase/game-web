<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/xxhzw/main.css');
?>

<!doctype html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        

		<title>Marstv游戏中心_小小海贼王_Marstv火星一服_直播观众礼包|公会卡|<?php echo $this->pageTitle . '-' . settings()->get('general', 'site_name'); ?></title>
		<meta name="Keywords" content="小小海贼王,小小海贼王官网,marstv火星一服，marstv小小海贼王,直播观众礼包,小小海贼王礼包,小小海贼王激活码,小小海贼王攻略,小小海贼王职业,小小海贼王公会卡,小小海贼王招募，"/>
		<meta name="description" content="小小海贼王是一款以动漫故事为背景的大型同人网页游戏，marstv小小海贼王以海贼王剧集为蓝本，在游戏中打造出多种海贼王职业，玩家可通过海贼王招募，发布悬赏，任务，战役等一系列创新玩法进行激烈对碰，想成为草帽海贼团吗？浏览小小海贼王官网，海量的小小海贼王攻略，伴你冲进大海深处，寻找海贼王的宝藏！" />

                <?php
                        $cs = Yii::app()->clientScript;
                        $cs->registerCoreScript('jquery');
                        $cs->registerScriptFile($layout_asset . '/js/common.js?v=1', CClientScript::POS_END);
                ?>
        </head>

        <body>
                <div id="top">
                        <div id="top_cont" class="wp">
                                <dl>
                                        <dt><a href="<?php echo FRONT_SITE_URL; ?>" title="MarsTV-小小海贼王" id="top_logo" class="text_td">MarsTV-小小海贼王</a></dt>
                                        <dd class="red">本游戏适合18岁以上玩家进入</dd>
                                </dl>
                                <ul>
                                        <li class="tli1"><a href="<?php echo $this->createUrl('customer/4'); ?>" title="" id="addDesktop">防沉迷系统</a></li>
                                        <li class="tli4"><a href="<?php echo $this->createUrl('object/dispute'); ?>" title="">交易纠纷处理</a></li>
                                        <li class="tli2"><a href="javascript:;" title="" id="setHomepage">设为首页</a></li>
                                        <li class="tli3"><a href="javascript:;" title="" id="addFavorite">加入收藏</a></li>
                                </ul>
                        </div>
                </div>
                <div id="header" class="wp">
                        <div id="banner">
                                <h1><a href="<?php echo $this->createUrl($this->game['game_sn'] . '/index'); ?>" title="MarsTV-小小海贼王官网" id="logo" class="text_td">MarsTV-小小海贼王官网</a></h1>
                        </div>
                        <div id="main_nav">
                                <div id="mn_cont">
                                        <div id="mn_left"></div>
                                        <ul>
                                                <?php $this->widget('frontwidgets.menu.MenuBlock', array('menu_id' => $this->menuid, 'template' => 'xxhzwnav')); ?>

                                        </ul>
                                        <div id="mn_right"></div>
                                </div>
                                <div id="mn_bottom"></div>
                        </div>
                </div>


                <?php echo $content ?>


                <div id="footer">
                        <div id="footer_cont" class="wp">
                                <h3 class="text_td"><a href="javascript:;" title="">MarsTV-小小海贼王官网</a></h3>
                                <div id="copyright">
                                        <ul>
                                                <li><a href="<?php echo $this->createUrl('object/duty') ?>" title="">免责声明</a></li>
                                                <li><a href="<?php echo $this->createUrl('object/business') ?>" title="">商务合作</a></li>

                                                <li><a href="<?php echo $this->createUrl('object/privacy') ?>" title="">用户协议</a></li>
                                                <li><a href="<?php echo $this->createUrl('object/contact') ?>" title="">联系我们</a></li>
                                        </ul>
                                        <p>上海耀宇文化传媒有限公司版权所有&nbsp; &nbsp; &nbsp; &nbsp; <a href="javascript:;" title="">沪ICP备12001511号-1</a></p>
                                </div>
                        </div>
                </div>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fe2c4a996b80c00854f2a80f63690b118' type='text/javascript'%3E%3C/script%3E"));
</script>

        </body>
</html>
