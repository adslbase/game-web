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
                <div id="server_warp">
                        <div class="model_2 mgB20">
                                <div class="cont">
                                        <h1> 客服中心</h1>
                                        <table width="490" border="0" cellspacing="0" cellpadding="0" class="mgAuto t_4 mgT20">
                                                <tbody><tr>
                                                                <td width="290"><p class="fB tR">通过在线解答的方式为您提供咨询服务</p>
                                                                        <p>周一至周日 9：00 - 21：00</p></td>
                                                                <td width="16">&nbsp;</td>
                                                                <td width="184"><p style="text-align:left">
                                                                                <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
                                                                        </p><p style="text-align:left">号码：192254648</p></td>
                                                        </tr>
                                                </tbody></table>
                                </div>
                        </div>
                        <div id="server_col">
                                <div class="faqs">
                                        <div id="faq_tab" class="tab_<?php echo isset($_GET['id'])?$_GET['id']:1;?>">
                                                <ul id="faq_tabs" >
                                                        <li id="no1">充值问题</li>
                                                        <li id="no2">账号问题</li>
                                                        <li id="no3">游戏常见问题</li>
                                                        <li id="no4">防沉迷FAQ</li>
                                                </ul>
                                        </div>
                                        <div class="model_3">
                                                <div class="model_3_top">
                                                        <div class="model_3_cont">
                                                                <dl class="faqList" id="fagList">
                                                                        <!-- ajax info -->
                                                                </dl>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                                <SCRIPT type=text/javascript>
                                        jQuery(document).ready(function () {
                                                var _faqs = jQuery("#faq_tab li");
                                                $.get("<?php echo  $this->createUrl('customer/faq')?>",{id:<?php echo isset($_GET['id'])?$_GET['id']:1;?>}, function (data) { 
                                                        jQuery("#fagList").empty().html(data);
                                                        jQuery("#fagList dt").bind("click", function () {jQuery(this).next("dd").show(); });
                                                });

                                                _faqs.each(function (i) {
                                                        jQuery(_faqs[i]).click(function () {
                                                                var _contId = jQuery(this).index() + 1;
                                                                jQuery("#faq_tab").removeClass().addClass("tab_" + _contId);
                                                                
                                                                $.get("<?php echo $this->createUrl('customer/faq')?>",{id:_contId}, function (data) { 
                                                                        jQuery("#fagList").empty().html(data);
                                                                        jQuery("#fagList dt").bind("click", function () { jQuery(this).next("dd").show(); });
                                                                });
                                                        });
                                                });
                                        });

                                </SCRIPT>

                        </div>
                </div>
        </div>
</div>



