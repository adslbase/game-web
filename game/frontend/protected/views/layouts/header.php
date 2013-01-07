<!doctype html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        

                <link rel="stylesheet" href="<?php $layout_asset="/assets/751ad8b7"; echo $layout_asset; ?>/css/main.css" type="text/css" />

                <title><?php echo $this->pageTitle.'-'.settings()->get('general', 'site_name'); ?></title>
                <meta name="description" content="火星联盟 乐游三国，乐游三国官网，小小海贼王，小小海贼王官网，大侠传，大侠传官网，页游，2012，网页游戏，最新网页游戏，最好玩的网页游戏，请锁定火星游戏中心g.marstv.com，webgame" />  <meta name="keywords" content="火星联盟 乐游三国，火星，火星游戏中心，小小海贼王，小小海贼王官网，大侠传，大侠传官网，火星一服，marstv，最新网页游戏，webgame" />
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

