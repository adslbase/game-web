<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/object.css');
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
                <div id="news_warp">
                        <div id="news_cont">
                                <div id="news_title"><dl><dt><a href="<?php echo $this->createUrl('object/list');?>" title="">新闻中心</a>&gt;</dt><dd>正文</dd></dl></div>
                                <div id="newsCont">
                                        <div id="text_title">
                                                <h3><?php echo $object['object_name'] ?></h3>
                                                <dl>
                                                        <dt>文章来源：</dt>
                                                        <dd>火星编辑</dd>
                                                        <dt>更新日期:</dt>
                                                        <dd><?php echo date('Y-m-d', $object['object_date']) ?></dd>
                                                </dl>
                                        </div>
                                        <div id="text_cont">
                                                 <?php echo $object['meta_value'] ?>
                                        </div>
                                </div>
                        </div>
                </div>
        </div>
</div>



