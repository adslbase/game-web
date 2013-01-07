<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <?php
                        if (YII_DEBUG)
                                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, true);
                        else
                                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);

                        $this->renderPartial('application.views.layouts.header', array('backend_asset' => $backend_asset));
                ?>
        </head>
        <body>

                <div class="container" id="page">
                        <div id="nav">
                                <div class="wrap">
                                        <ul class="left">
                                                <li><a href="<?php echo FRONT_SITE_URL; ?>" id="visit_site" target="_blank">访问网站</a></li>	
                                        </ul>
                                        <ul class="right">
                                                <li><?php echo t('欢迎'); ?>, <strong><?php echo user()->username; ?></strong>&nbsp;|&nbsp;</li>
                                                <li><a href="<?php echo Yii::app()->request->baseUrl ?>/beuser/updatesettings"><?php echo t('个人设置'); ?></a>&nbsp;|&nbsp;</li>
                                                <li><a href="<?php echo Yii::app()->request->baseUrl ?>/beuser/changepass"><?php echo t('修改密码'); ?></a>&nbsp;|&nbsp;</li>
                                                <li><a href="<?php echo Yii::app()->request->baseUrl ?>/besite/logout"><?php echo t('退出'); ?></a></li>
                                        </ul>
                                </div>

                        </div>
                        <div id="header">
                                <div style="float:left; padding-left:45px">
                                        <a href="<?php echo bu() . '/besite'; ?>"><img src="<?php echo $backend_asset; ?>/images/logo_small.png" /></a>
                                </div>
                                <form id="search-box" method="get" action="#" target="_blank" style="float:left;">
                                        <input class="topSearchBox" id="topSearchBox" autocomplete="off" type="text" maxlength="2048" name="q" label="Search" placeholder="" aria-haspopup="true" />
                                        <input type="submit" value="搜索" id="searchbutton" class="bebutton" />
                                </form>
                                <div class="clear"></div>
                        </div>
                        <div id="site-content">
                                <div id="left-sidebar">

                                        <?php
                                                $this->widget('zii.widgets.CMenu', array(
                                                            'encodeLabel' => false,
                                                            'activateItems' => true,
                                                            'activeCssClass' => 'list_active',
                                                            'items' => array(
                                                                        array('label' => '<span id="menu_dashboard" class="micon"></span>' . t('控制面板'), 'url' => array('/besite/index'), 'linkOptions' => array('class' => 'menu_0'),
                                                                                    'active' => ((Yii::app()->controller->id == 'besite') && (in_array(Yii::app()->controller->action->id, array('index')))) ? true : false
                                                                        ),
                                                                        array('label' => '<span id="menu_content" class="micon"></span>' . t('内容'), 'url' => 'javascript:void(0);', 'linkOptions' => array('class' => 'menu_1'), 'itemOptions' => array('id' => 'menu_1'),
                                                                                    'items' => array(
                                                                                                array('label' => t('添加内容'), 'url' => array('/beobject/create')),
                                                                                                array('label' => t('管理游戏'), 'url' => array('/beobject/game')),
                                                                                                array('label' => t('管理服务器'), 'url' => array('/beobject/server')),
                                                                                                array('label' => t('管理新手卡'), 'url' => array('/beobject/card')),
                                                                                                array('label' => t('管理文章'), 'url' => array('/beobject/article')),
                                                                                                array('label' => t('管理内容'), 'url' => array('/beobject/admin'),
                                                                                                            'visible' => user()->isAdmin ? true : false,
                                                                                                            'active' => ((Yii::app()->controller->id == 'beobject') && (in_array(Yii::app()->controller->action->id, array('update', 'view', 'admin', 'index')))) ? true : false)
                                                                        )),
                                                                        array('label' => '<span id="menu_taxonomy" class="micon"></span>' . t('分类'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_2', 'class' => 'menu_2'), 'itemOptions' => array('id' => 'menu_2'),
                                                                                    'items' => array(
                                                                                                array('label' => t('添加分类项'), 'url' => array('/beterm/create')),
                                                                                                array('label' => t('管理分类项'), 'url' => array('/beterm/admin'),
                                                                                                            'active' => ((Yii::app()->controller->id == 'beterm') && (in_array(Yii::app()->controller->action->id, array('update', 'view', 'admin', 'index'))) ? true : false)
                                                                                                ),
                                                                                                array('label' => t('添加分类'), 'url' => array('/betaxonomy/create')),
                                                                                                array('label' => t('管理分类'), 'url' => array('/betaxonomy/admin'),
                                                                                                            'active' => ((Yii::app()->controller->id == 'betaxonomy') && (in_array(Yii::app()->controller->action->id, array('update', 'view', 'admin', 'index')))) ? true : false)
                                                                                    ),
                                                                                    'visible' => user()->isAdmin ? true : false,
                                                                        ),
                                                                        array('label' => '<span id="menu_page" class="micon"></span>' . t('页面'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_3', 'class' => 'menu_3'), 'itemOptions' => array('id' => 'menu_3'),
                                                                                    'items' => array(
                                                                                                array('label' => t('添加菜单'), 'url' => array('/bemenu/create'), 'visible' => user()->isAdmin ? true : false,),
                                                                                                array('label' => t('管理菜单'), 'url' => array('/bemenu/admin'),
                                                                                                            'active' => ((Yii::app()->controller->id == 'bemenu') && (in_array(Yii::app()->controller->action->id, array('update', 'view', 'admin', 'index'))) ? true : false)),
                                                                        )),
                                                                        array('label' => '<span id="menu_resource" class="micon"></span>' . t('附件'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_4', 'class' => 'menu_4'), 'itemOptions' => array('id' => 'menu_4'),
                                                                                    'items' => array(
                                                                                                array('label' => t('上传附件'), 'url' => array('/beresource/create')),
                                                                                                array('label' => t('管理附件'), 'url' => array('/beresource/admin'),
                                                                                                            'active' => ((Yii::app()->controller->id == 'beresource') && (in_array(Yii::app()->controller->action->id, array('update', 'view', 'admin', 'index')))) ? true : false)
                                                                        )),
                                                                        array('label' => '<span id="menu_manage" class="micon"></span>' . t('管理'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_5', 'class' => 'menu_5'), 'itemOptions' => array('id' => 'menu_5'),
                                                                                    'items' => array(
                                                                                                array('label' => t('评论'), 'url' => array('/comments/admin'), 'active' => Yii::app()->controller->id == 'comments' ? true : false),
                                                                                    //array('label'=>'Like/Rating', 'url'=>array('/like/admin')),
                                                                                    //array('label'=>'Survey', 'url'=>array('/survey/admin')),
                                                                        )),
                                                                        array('label' => '<span id="menu_user" class="micon"></span>' . t('用户'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_6', 'class' => 'menu_6'), 'itemOptions' => array('id' => 'menu_6'),
                                                                                    'items' => array(
                                                                                                array('label' => t('添加用户'), 'url' => array('/beuser/create')),
                                                                                                array('label' => t('管理用户'), 'url' => array('/beuser/admin'),
                                                                                                            'active' => ((Yii::app()->controller->id == 'beuser') && (in_array(Yii::app()->controller->action->id, array('update', 'view', 'admin', 'index')))) ? true : false
                                                                                                ),
                                                                                                array('label' => t('权限'), 'url' => array('/rights/assignment'), 'active' => in_array(Yii::app()->controller->id, array('assignment', 'authItem')) ? true : false),
                                                                                    ),
                                                                                    'visible' => user()->isAdmin ? true : false,
                                                                        ),
                                                                        array('label' => '<span id="menu_setting" class="micon"></span>' . t('设置'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_7', 'class' => 'menu_7'), 'itemOptions' => array('id' => 'menu_7'),
                                                                                    'items' => array(
                                                                                                array('label' => t('基本'), 'url' => array('/besettings/general')),
                                                                                                array('label' => t('系统'), 'url' => array('/besettings/system')),
                                                                                    ),
                                                                                    'visible' => user()->isAdmin ? true : false,
                                                                        ),
                                                                        array('label' => '<span id="menu_caching" class="micon"></span>' . t('缓存'), 'url' => array('/becaching/clear'), 'linkOptions' => array('id' => 'menu_8', 'class' => 'menu_8'), 'itemOptions' => array('id' => 'menu_8'),
                                                                                    'items' => array(
                                                                                    ),
                                                                                    'visible' => user()->isAdmin ? true : false,
                                                                        ),
                                                                        array('label' => '<span id="menu_caching" class="micon"></span>' . t('支付'), 'url' => 'javascript:void(0);', 'linkOptions' => array('id' => 'menu_9', 'class' => 'menu_9'), 'itemOptions' => array('id' => 'menu_9'),
                                                                                    'items' => array(
                                                                                                array('label' => t('支付模块'), 'url' => array('/bepay/index')),
                                                                                                array('label' => t('充值记录'), 'url' => array('/beorder/index')),
                                                                                                array('label' => t('充值统计'), 'url' => array('/beorder/statis')),
                                                                                    ),
                                                                                    'visible' => user()->isAdmin ? true : false,
                                                                        )
                                                            ),
                                                ));
                                        ?>

                                </div>
                                <div id="main-content-zone">
                                        <?php if (isset($this->menu)) : ?>
                                                        <?php if (count($this->menu) > 0): ?>
                                                                <div class="header-info">
                                                                        <?php
                                                                        $this->widget('zii.widgets.CMenu', array(
                                                                                    'items' => $this->menu,
                                                                                    'htmlOptions' => array(),
                                                                        ));
                                                                        ?>
                                                                </div>
                                                        <?php endif; ?>
                                                <?php endif; ?>
                                        <div class="page-content">                                
                                                <h2><?php echo (isset($this->titleImage) && ($this->titleImage != '')) ? '<img src="' . $backend_asset . '/' . $this->titleImage . '" />' : ''; ?><?php echo isset($this->pageTitle) ? $this->pageTitle : ''; ?></h2>
                                                <?php if (isset($this->pageHint) && ($this->pageHint != '')) : ?>
                                                                <p><?php echo $this->pageHint; ?></p>
                                                        <?php endif; ?>
                                                <?php echo $content; ?>
                                        </div>
                                </div>
                                <div class="clear"></div>
                        </div>

                </div><!-- page -->
                <script type="text/javascript">

                        $(document).ready(function () {
                                //Hide the second level menu
                                $('#left-sidebar ul li ul').hide();            
                                //Show the second level menu if an item inside it active
                                $('li.list_active').parent("ul").show();
            
                                $('#left-sidebar').children('ul').children('li').children('a').click(function () {                    
                
                                        if($(this).parent().children('ul').length>0){                  
                                                $(this).parent().children('ul').toggle();    
                                        }
                 
                                });
          
            
                        });
                </script>
        </body>

</html>