<!doctype html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        

                <link rel="stylesheet" href="<?php echo $layout_asset; ?>/css/main.css" type="text/css" />

                <title><?php echo $this->pageTitle.'-'.settings()->get('general', 'site_name'); ?></title>

                <?php
                $cs = Yii::app()->clientScript;
                $cs->registerCoreScript('jquery');
                $cs->registerScriptFile($layout_asset . '/js/common.js?v=1');
                ?>
        </head>

        <body>
                <div id="header">
                        <!--Top links begin-->
                        <div id="top_link">
                                <div id="top_link_cont" class="wp">
                                        <h2 class="red tips">本公司游戏仅适合18岁以上玩家！</h2>
                                        <ul>
                                                <li class="tli1"><a href="<?php echo $this->createUrl('customer/4');?>" title="" id="addDesktop">防沉迷系统</a></li>
                                                    <li class="tli4"><a href="<?php echo $this->createUrl('object/dispute');?>" title="">交易纠纷处理</a></li>
                                                <li class="tli2"><a href="javascript:;" title="" id="setHomepage">设为首页</a></li>
                                                <li class="tli3"><a href="javascript:;" title="" id="addFavorite">加入收藏</a></li>
                                            
                                        </ul>
                                </div>
                        </div>
                        <!--Top links end-->
                        <!--Banner&Top Ad begin-->
                        <div id="banner">
                                <!--Logo-->
                                <div id="banner_cont" class="wp">
                                        <h1><a href="<?php echo FRONT_SITE_URL?>" title="MarsTV网页游戏平台">MarsTV网页游戏平台</a></h1>
                                </div>
                        </div>
                        <!--Banner&Top Ad end-->
                        <!--Main Nav begin-->
                        <div id="main_nav">
                                <div id="main_nav_cont" class="wp">
                                             <?php $this->widget('frontwidgets.menu.MenuBlock', array('menu_id' => 1,'template'=>'mainnav')); ?>
                                </div>
                        </div>
                        <!--Main Nav end-->
                </div>

