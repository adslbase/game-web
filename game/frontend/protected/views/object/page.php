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
                                        <?php //$this->widget('frontwidgets.server.ServerBlock'); ?>
										<!--上线需修改-->
										<tr class="tbline">
											<td valign="middle" height="26" align="center">12-20</td>
											<td valign="middle" height="26" align="center">16:00</td>
											<td valign="middle" height="26" align="center">
													<a title="" href="/lysg/index.html">乐游三国</a>
											</td>
											<td valign="middle" height="26" align="center">
													<a style="color: black;" title="" href="/lysg/game.html?server=143">
													火星一服                        </a>
											</td>
									    </tr>
										<tr class="tbline">
												<td valign="middle" height="26" align="center">10-25</td>
												<td valign="middle" height="26" align="center">19:00</td>
												<td valign="middle" height="26" align="center">
														<a title="" href="http://op.marstv.com/index.html">小小海贼王</a>
												</td>
												<td valign="middle" height="26" align="center">
														<a style="color: black;" title="" href="http://op.marstv.com/game.html?server=126">
														Marstv 火星二服                        </a>
												</td>
										</tr>
										<tr class="tbline">
												<td valign="middle" height="26" align="center">9-19</td>
												<td valign="middle" height="26" align="center">13:30</td>
												<td valign="middle" height="26" align="center">
														<a title="" href="http://op.marstv.com/index.html">小小海贼王</a>
												</td>
												<td valign="middle" height="26" align="center">
														<a style="color: black;" title="" href="http://op.marstv.com/game.html?server=2">
														Marstv 火星一服                        </a>
												</td>
										</tr>
										<!--上线需修改-->
                                </table>

                        </div>
                </div>
                <!--New Game end-->
        </div>
        <div id="cont">
                <div id="news_warp">
                        <div id="news_cont">
                                <div id="news_title"><dl><dt><a href="<?php echo $this->createUrl('object/list');?>" title="">新闻中心</a>&gt;</dt><dd><?php echo $this->pageTitle?></dd></dl></div>
                                <div id="newsCont">
                                                 <?php echo $object['meta_value'] ?>
                                </div>
                        </div>
                </div>
        </div>
</div>



