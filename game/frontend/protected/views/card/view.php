<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/card.css');
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
        <div id="cont" class="new-page">
                <div class="games-nav">
                        <div class="title">
                                <h1><?php echo $card['object_name']; ?></h1>
                                <span class="fa"></span>
                        </div>
                        <ul>
                                <li> <a href="<?php echo $card['site_url'] ?>" class="FBlue2" target="_blank"><?php echo $card['gamename'] ?>官网</a>　 </li>
                                <li> <a href="<?php echo $card['help_url'] ?>" class="FBlue2" target="_blank"><?php echo $card['gamename'] ?>攻略</a></li>
                                <li> <a href="<?php echo $this->createUrl('payway/game', array('gameid' => $card['gameid'])); ?>" target="_blank" class="FBlue2"><?php echo $card['gamename'] ?>充值</a></li>
                        </ul>
                </div>



                <div class="gmne-rank clearfix" id="number" style="margin:0">
                        <div class="bd">
                                <h3>
                                        <?php echo $card['object_name']; ?>
                                </h3>
                                <?php echo CHtml::form('', 'post', array('onsubmit' => 'return checkform()')) ?>
                                <ul>
                                        <li>
                                                <label>服务器：</label><?php echo CHtml::dropDownList('serverid', $serverid, $servers, array('id' => 'serverid')) ?>
                                        </li> 
                                        <li>
                                                <label>激活码：</label><?php echo CHtml::textField('key', $key, array('id' => 'key')) ?> <?php echo CHtml::Button('复制', array('id' => 'copyKey')) ?>
                                        </li>
                                </ul>

                                <?php echo CHtml::hiddenField('gameid', $card['object_parent']) ?>
                                <?php echo CHtml::hiddenField('cardid', $card['object_id']) ?>
                                <div class="submit">
                                        <?php echo CHtml::submitButton('领取', array('name' => 'submit1','class'=>'ling')); ?>
                                        <span><?php echo $message; ?></span>

                                </div>


                                <?php echo CHtml::endForm() ?>
                        </div>	
                </div>

                <div class="gmne-rank clearfix">
                        <div class="hd"><h3>激活说明</h3></div>
                        <div class="bd">
                                <?php echo $card['card_explain'] ?>
                        </div>
                </div>
                <div class="gmne-rank clearfix">
                        <div class="hd">
                                <!-- 新手卡 -->
                                <h3>礼包详情</h3>
                        </div>
                        <div class="bd">

                                <?php echo $card['card_reward'] ?>

                        </div>
                </div>

                <div class="gmne-rank clearfix">
                        <div class="hd">
                                <h3>游戏介绍</h3>
                        </div>
                        <div class="bd">
                                <?php echo $card['excerpt'] ?>
                        </div>
                </div>
        </div>
</div>

<script>
        function checkform()
        {
                if($('#serverid').val()== 0 )
                {
                        alert('请先选择服务器！');
                        return false;
                }
                else
                {
                        return true;
                }
                
                
        }
        
        
        $(function(){
                $("#copyKey").click(function()
                {
                        var ab =  $('#key').val();  
                        if (document.all){                                      
                                window.clipboardData.setData('text', ab);
                                alert("复制成功！");
                        }else{
                                alert("您的浏览器不支持剪贴板操作，请自行复制。"); 
                        }
                             
                });
        })


        

</script>