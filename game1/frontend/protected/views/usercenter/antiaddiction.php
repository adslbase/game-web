<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/user.css');
$cs->registerScriptFile($layout_asset . '/js/formValidator.min.js');
$cs->registerScriptFile($layout_asset . '/js/formValidatorRegex.js');
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
                <!--User info begin-->
                <div id="user_nav">
                        <div id="un_title"><h2>用户中心</h2></div>
                        <div id="un_cont">
                                <ul>
                                        <li><a href="<?php echo $this->createUrl('usercenter/ModifyUserInfo') ?>" title="" >修改个人信息</a></li>
                                        <li><a href="<?php echo $this->createUrl('usercenter/ChangePassword') ?>" title="">修改密码</a></li>
                                        <li><a href="<?php echo $this->createUrl('usercenter/AntiAddiction') ?>" title="" class="una">防沉迷认证</a></li>
                                        <li style="border-bottom:none;"><a href="<?php echo $this->createUrl('payway/index') ?>" title="">游戏充值</a></li>
                                </ul>
                        </div>
                        <div id="un_bottom"></div>
                </div>
                <!--User info end-->
        </div>
        <div id="cont">
                <div id="reg_warp">
                        <div id="reg_cont">
                                <div id="reg_title"><h2>用户中心&gt;修改密码</h2></div>
                                <div id="regCont">
                                        <!--注册提示信息 begin-->
                                        <div id="reg_tips">
                                                <p>您已经可以进入游戏，但是我们建议您填写如下的身份资料以免受到防沉迷系统的限制。</p>
                                        </div>
                                        <?php
                                                $form = $this->beginWidget('CActiveForm', array(
                                                    'id' => 'userautonym-form',
                                                        ));
                                                ?>
                                        <div id="reg_id">
                                                      
                                                <div class="regt">
                                                        <span><label>真实姓名：</label></span>
                                                         <?php echo $form->textField($model, 'realname', array('id' => 'realname')); ?>   
                                                       <div id="realnameTip" style="width:200px" class="onShow"></div>
                                                </div>
                                                <div class="regt">
                                                        <span><label>身份证号码：</label></span>
                                                         <?php echo $form->textField($model, 'sfzh', array('id' => 'sfzh')); ?>   
                                                       <div id="sfzhTip" style="width:200px" class="onShow"></div>
                                                </div>
                                        </div>
                                        <div id="reg_button">
                                                <input name="" type="submit" value="" class="rg_btn"  id="Submit1" />
                                        </div>
                                         <?php $this->endWidget(); ?>
                                        <div id="aa_info">
                                                <h3>网络游戏防沉迷系统及用户隐私说明</h3>
                                                <h4>按照版署《网络游戏未成年人防沉迷系统》要求</h4>
                                                <p>为预防青少年过度游戏，未满18岁的用户和身份信息不完整的用户将受到防沉迷系统的限制，火星游戏平台积极响应国家新闻出版总署防沉迷政策要求，开发出网页游戏防沉迷系统。</p>
                                                <p>年龄已满18周岁的玩家，在填写身份证资料后，可以不受防沉迷系统影响，自由进行游戏，<font color="#ff6600">否则游戏每日在线3小时后即打怪经验减半,超过5小时则无经验。</font></p>
                                                <p>说明：系统只支持输入18位的中国身份证号码，持有其他证件（如：外国护照，军人证，等）者，请与客服GM联系处理。 填写身份信息将使我们可以对您的年龄做出判断，以确定您的游戏时间是否需要按照国家新闻出版总署的要求纳入防沉迷系统的管理。</p>
                                                <p>隐私说明：用户填写的身份信息属于用户的隐私。37wan平台游戏绝对尊重用户个人隐私权。所以，37wan平台游戏绝不会公开，编辑或透露用户的信息内容，除非有法律许可及公安管理规定。</p>
                                        </div>
                                </div>
                        </div>
                </div>

        </div>
</div>
<script>
 jQuery(document).ready(function () {
        jQuery.formValidator.initConfig({ submitButtonID: "Submit1",formID:"userautonym-form"});

        jQuery("#realname").formValidator({ onShow: "请输入你的姓名，例如：张三。", onFocus: "请输入你的真实姓名", onCorrect: "" }).functionValidator({ fun: isTrueName });
        $("#sfzh").formValidator({ onShow: "请输入你的身份证，例如：440106198507131483", onFocus: "输入15或18位的身份证", onCorrect: "" }).functionValidator({ fun: isCardID, onError: "身份证格式不正确" });


    });
</script>