<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;
$layout_asset="/assets/751ad8b7";
        $cs->registerCssFile($layout_asset . '/css/payway.css');
        $cs->registerScriptFile($layout_asset . '/js/payfun.js?v=1', CClientScript::POS_END);
?>

<div class="main mgAuto">
        <div class="inner">
                <div class="payflow mgB5">
                        <div class="cont">
                                <ol class="step2">
                                        <li><strong>选择充值游戏</strong></li>
                                        <li>选择充值方式</li>
                                        <li>确认充值信息</li>
                                        <li>充值成功</li>
                                </ol>
                        </div>
                </div>
                <div class="leftSide">
                        <div class="leftSide_inner">
                                <div class="leftSide_cont" id="div1">
                                        <div class="mod_1 pay mgB10">
                                                <h2> 请选择充值方式</h2>
                                                <ul class="payway">
                                                        <?php foreach ($payways as $payway): ?>
                                                                        <?php
                                                                        $params = array('gameid' => $gameid, 'payway' => $payway['pay_id']);

                                                                        if ($server !== '')
                                                                        {
                                                                                $params['server'] = $server;
                                                                        }
                                                                        $class = '';
                                                                        if ($paywayId == $payway['pay_id'])
                                                                        {
                                                                                $class = " class=\"current\"";
                                                                        }
                                                                        ?>
                                                                        <li <?php echo $class; ?>>
                                                                                <a href="<?php echo $this->createUrl('payway/game', $params); ?>" class="way_<?php echo $payway['pay_id']; ?>">
                                                                                        <span><?php echo $payway['name'] ?></span></a>
                                                                        </li>
        <?php endforeach; ?>

                                                </ul>
                                        </div>
                                        <br />
                                        <div id="paytip"> </div>
                                        <br />
                                        <div class="mod_1 helpcenter">
                                                <h2> 充值帮助</h2>
                                                <ul class="mgB10">
<?php $this->widget('frontwidgets.helpcenter.HelpcenterBlock'); ?>
                                                </ul>
                                                <a href="<?php echo $this->createUrl('customer/index') ?>" target="_blank" class="clientser">充值咨询 联系客服</a><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息" style="margin-left:30px;"></a>
                                                <div class="clear"> </div>
                                        </div>
                                </div>
                        </div>
                </div>
                <div class="rightSide">
                        <div class="rightSide_inner">
                                <div class="rightSide_cont" id="div2">
                                        <?php
                                                $form = $this->beginWidget('CActiveForm', array(
                                                            'id' => 'payform'
                                                                ));
                                        ?>

                                        <div class="paywayAll">
                                                <p class="paywayHeader">
                                                        您当前选择的是“<strong class="t_orange"><?php echo $payways[$paywayId]['name'] ?></strong>”支付方式
                                                        <?php 
														  if($payways[$paywayId]['name']=="骏网一卡通")
														  {
															  echo "<br>银行卡支付
																	<br>骏卡支付
																	<br>盛大点卡支付
																	<br>移动手机充值卡
																	<br>联通手机充值卡
																	<br>电信手机充值卡
																		<em class='t_orange f12 fB'>(点击左侧更换支付方式)</em>";
														  }
														  else
														  {
														   echo "<br>支持全国29家银行卡(需要开通网上银行)<em class='t_orange f12 fB'>(点击左侧更换支付方式)</em>";
														  }
														?>
                                                </p>
                                                <div class="payModel">
                                                        <h5> 选择您要充值到哪里</h5>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="payTable">
                                                                <tr>
                                                                        <th width="15%"> 充值游戏： </th>
                                                                        <td width="33%"><div class="gamePay">
                                                                                        <span class="gameShow">
                                                                                                <em class="selectGame">
                                                                                                        
                                                                                                        <img src="<?php echo $games[1]['ico_logo'] ?>" alt="csws" gid="102"><?php echo $games[1]['object_name']; ?>
                                                                                                </em>
                                                                                                <input type="hidden" id="gameid" name="gameid" value="<?php echo $gameid; ?>">
                                                                                                <input type="hidden" id="gamename" name="gamename" value="<?php echo $games[1]['object_name']; ?>">
                                                                                        </span>

                                                                                        <div class="jumplist">
                                                                                                <iframe frameborder="0" class="iframe_ie6"></iframe>
                                                                                                <div class="border-1"> </div>
                                                                                                <div class="selectBox">
<?php foreach ($games as $g): ?>
                                                                                                        
                                                                                                        <?php if($g['object_status'] == 1):?>
                                                                                                                        <span class=""> 
                                                                                                                                <img src="<?php echo $g['ico_logo'] ?>" alt="<?php echo $g['game_sn'] ?>" gameid="<?php echo $g['object_id'] ?>"><?php echo $g['object_name'] ?>
                                                                                                                        </span>
                                                                                                        <?php endif;?>
                                                                                                        
        <?php endforeach; ?>
                                                                                                        <div class="clear"> </div>
                                                                                                </div>
                                                                                        </div>
                                                                                </div></td>
                                                                        <td width="52%"><div class="onCorrect"> &nbsp;</div></td>
                                                                </tr>
                                                                <tr>
                                                                        <th> 充值服务器： </th>
                                                                        <td><select name="selectserver" id="selectserver">
                                                                                        <option>请选择服务器</option>
                                                                                </select>
                                                                                <input type="hidden" id="servername" name="servername" /></td>
                                                                        <td><div id="selectserverTip" class="onShow"> 充值前请建好此服的游戏角色</div></td>
                                                                </tr>


<?php if (user()->isGuest !== true): ?>
                                                                                <tr>
                                                                                        <th> 充入账号： </th>
                                                                                        <td><span><strong> <?php echo user()->username ?></strong></span>
                                                                                                <input type="text" id="account" name="account" value="<?php echo user()->username ?>" class="txtSty"
                                                                                                       style="display: none;" /></td>
                                                                                        <td><div id="accountTip" class="onShow"> &nbsp;</div></td>
                                                                                </tr>
        <?php else: ?>
                                                                                <tr>
                                                                                        <th> 充入账号： </th>
                                                                                        <td><input type="text" id="account" name="account" value="" class="txtSty"></td>
                                                                                        <td><div id="accountTip" class="onShow"> 请输入你想充值的微网游帐号</div></td>
                                                                                </tr>

<?php endif; ?>

                                                                <tr id="trEmail" style="display:none;">
                                                                        <th>电子邮件：</th>
                                                                        <td><input type="text" class="txtSty" name="email" id="email"/></td>
                                                                        <td><div id="emailTip" class="onShow">邮箱6-100个字符，格式正确且需唯一</div></td>
                                                                </tr>
                                                                <tr id="trEmailTip" style="display:none;">
                                                                        <th></th>
                                                                        <td colspan="2"><p style="float:left; border:1px solid #FFC; background:#ffc; padding:3px 4px; border:1px solid #CCC"><span style="color:#FF7400;">提示：电子邮件是找回密码的唯一方式，请认真填写!</span></p></td>
                                                                </tr>			
                                                        </table>
                                                </div>
                                                <div class="hr2"> </div>
                                                <div class="payModel">
                                                        <h5> 选择充值金额</h5>
                                                        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="payTable">
                                                                <tr>
                                                                        <th width="15%"> 充值金额： </th>
                                                                        <td width="33%"><select name="selectmoney" id="selectmoney">
                                                                                        <option value="0">请选择充值金额</option><option value="10">10 元 </option><option value="20">20 元 </option><option value="50">50 元 </option><option value="100">100 元 </option><option value="200">200 元 </option><option value="300">300 元 </option><option value="500">500 元 </option><option value="800">800 元 </option><option value="1000">1000 元 </option><option value="2000">2000 元 </option><option value="5000">5000 元 </option><option value="10000">10000 元 </option><option value="20000">20000 元 </option><option value="50000">50000 元 </option>
                                                                                </select></td>
                                                                        <td width="52%"><div id="selectmoneyTip"> &nbsp;</div></td>
                                                                </tr>
                                                                <!--<tr><th> 其他充值金额： </th><td><input type="text" id="othermoney" name="othermoney" maxlength="6" class="txtSty" /></td><td><div id="othermoneyTip" class="onShow"> 如果下拉表没有您想充的金额，请在此填写</div></td></tr>-->
                                                                <tr>
                                                                        <th> 对应<span id="spUnit"></span>数量： </th>
                                                                        <td><input type="text" id="goldnum" disabled="disabled" name="goldnum" class="txtSty" /></td>
                                                                        <td><div class="onShow"> 兑换比例 1：<span id="spRate"></span></div></td>
                                                                </tr>
                                                                <tr>
                                                                        <th>&nbsp; </th>
                                                                        <td colspan="2"><p class="tishi">

                                                                                </p></td>
                                                                </tr>
                                                        </table>
                                                </div>

                                                <div class="payModel">
<!--
                                                        <h5> 请选择银行-暂未开通充值系统</h5>
                                                        <div id="bankList" class="banks clearfix">
                                                                <div class="selected">
                                                                        <input type="radio" id="ICBC" value="ICBC" checked="checked" name="pay_bank">
                                                                        <label for="ICBC"> <img title="中国工商银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_icbc.gif" width="120" height="30"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="CCB" value="CCB" name="pay_bank">
                                                                        <label for="CCB"> <img border="0" title="中国建设银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_ccb.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="ABC" value="ABC" name="pay_bank">
                                                                        <label for="ABC"> <img border="0" title="中国农业银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_abc.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="CMB" value="CMB" name="pay_bank">
                                                                        <label for="CMB"> <img border="0" title="招商银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_cmb.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="BCOM" value="BCOM" name="pay_bank">
                                                                        <label for="BCOM"> <img border="0" title="中国交通银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_bcom.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="BOC" value="BOC" name="pay_bank">
                                                                        <label for="BOC"> <img border="0" title="中国银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_boc.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="PSBC" value="PSBC" name="pay_bank">
                                                                        <label for="PSBC"> <img border="0" title="中国邮政储蓄银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_post.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="CITIC" value="CITIC" name="pay_bank">
                                                                        <label for="CITIC"> <img border="0" title="中信银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_citic.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="SPDB" value="SPDB" name="pay_bank">
                                                                        <label for="SPDB"> <img border="0" title="浦发银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_spdb.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="CEB" value="CEB" name="pay_bank">
                                                                        <label for="CEB"> <img border="0" title="中国光大银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_ceb.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="CIB" value="CIB" name="pay_bank">
                                                                        <label for="CIB"> <img border="0" title="兴业银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_cib.gif"></label>
                                                                </div>
                                                                <div>
                                                                        <input type="radio" id="CMBC" value="CMBC" name="pay_bank">
                                                                        <label for="CMBC"> <img border="0" title="中国民生银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_cmbc.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="GDB" value="GDB" name="pay_bank">
                                                                        <label for="GDB"> <img border="0" title="广东发展银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_gdb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="SDB" value="SDB" name="pay_bank">
                                                                        <label for="SDB"> <img border="0" title="深圳发展银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_sdb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="HXB" value="HXB" name="pay_bank">
                                                                        <label for="HXB"> <img border="0" title="华夏银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_hxb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="PAB" value="PAB" name="pay_bank">
                                                                        <label for="PAB"> <img border="0" title="平安银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_pab.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="BOB" value="BOB" name="pay_bank">
                                                                        <label for="BOB"> <img border="0" title="北京银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_bob.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="CBHB" value="CBHB" name="pay_bank">
                                                                        <label for="CBHB"> <img border="0" title="渤海银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_cbhb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="BJRCB" value="BJRCB" name="pay_bank">
                                                                        <label for="BJRCB"> <img border="0" title="北京农商银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_bjrcb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="HSB" value="HSB" name="pay_bank">
                                                                        <label for="HSB"> <img border="0" title="徽商银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_hsb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="CZB" value="CZB" name="pay_bank">
                                                                        <label for="CZB"> <img border="0" title="浙商银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_czb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="HZB" value="HZB" name="pay_bank">
                                                                        <label for="HZB"> <img border="0" title="杭州银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_hzb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="SHB" value="SHB" name="pay_bank">
                                                                        <label for="SHB"> <img border="0" title="上海银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_shb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="NBCB" value="NBCB" name="pay_bank">
                                                                        <label for="NBCB"> <img border="0" title="宁波银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_nbcb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="NJCB" value="NJCB" name="pay_bank">
                                                                        <label for="NJCB"> <img border="0" title="南京银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_njcb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="BEA" value="BEA" name="pay_bank">
                                                                        <label for="BEA"> <img border="0" title="东亚银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_bea.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="SRCB" value="SRCB" name="pay_bank">
                                                                        <label for="SRCB"> <img border="0" title="上海农村商业银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_shrcb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="GZCB" value="GZCB" name="pay_bank">
                                                                        <label for="GZCB"> <img border="0" title="广州银行" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_gzcb.gif"></label>
                                                                </div>
                                                                <div style="display: none; ">
                                                                        <input type="radio" id="UPOP" value="UPOP" name="pay_bank">
                                                                        <label for="UPOP"> <img border="0" title="银联在线支付" src="http://static.sdg-china.com/vgp/pic/web2/pay/bank_upop.gif"></label>
                                                                </div>
                                                        </div>
-->
                                                        <input type="hidden" name="payway" id="payway" value="<?php echo $paywayId ?>">
                                                        <input type="button" id="Submit1" name="submitok" value="立即充值" class="payBtn" hidefocus="">
                                                </div>

                                                <div class="hr2"> </div>
                                                <div class="payModel">
                                                        <h5> 网银充值说明</h5><ul class="readme"><li>1、您必须开通了网上银行业务</li><li>2、网上银行开通办法请咨询当地所属银行</li><li>3、请您关闭所有屏蔽弹出窗口之类的功能，否则在线支付将无法继续，比如：3721、上网助手、google toolbar、 alexa toolbar、baidu等 </li><li>4、如果您用信用卡支付，请确认该信用卡的网上交易限额大于等于您的充值金额</li><li>5、如果有疑问，请联系我们<a target="_blank" href="/customer/index.html"><span class="t_orange">在线客服</span></a></li><li>6、<span class="t_orange">请充值时务必确认好您的充值金额准确无误后再进行充值，避免输错金额导致的失误，如因未 仔细确认金额造成 的充值问题，我们将一律不予处理此类退款申诉</span></li></ul>
                                                </div>
                                        </div>
<?php $this->endWidget(); ?>
                                </div>
                        </div>
                </div>
                <div class="clear"> </div>
        </div>
</div>

