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
                                        <li><a href="<?php echo $this->createUrl('usercenter/ModifyUserInfo') ?>" title="" class="una">修改个人信息</a></li>
                                        <li><a href="<?php echo $this->createUrl('usercenter/ChangePassword') ?>" title="" >修改密码</a></li>
                                        <li><a href="<?php echo $this->createUrl('usercenter/AntiAddiction') ?>" title="">防沉迷认证</a></li>
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
                                <div id="reg_title"><h2>用户中心&gt;修改个人信息</h2></div>
                                <div id="regCont">
                                        <!--注册提示信息 begin-->
                                        <div id="reg_tips">
                                                <p>以下内容我们承诺您的信息安全，不会透露给第三方友情提示：<span class="yellow">*</span>为必填项，请认真填写！</p>
                                        </div>
                                               <?php
                                                $form = $this->beginWidget('CActiveForm', array(
                                                    'id' => 'userprofile-form',
                                                        ));
                                                ?>
                                        <!--注册提示信息 end-->
                                        <div id="reg_id">
                                         
                                                <div class="regt">
                                                        <span><b>*</b><label>我的账号：</label></span>
                                                        <?php echo $user->username ?>    
                                                </div>
                                                <div class="regt">
                                                        <span><b>*</b><label>防沉迷：</label></span>
                                                        <?php if (empty($user->sfzh) || empty($user->realname)): ?>
                                                                未认证，<a href="<?php echo $this->createUrl('usercenter/AntiAddiction') ?>">现在去认证！</a>
                                                        <?php else: ?>
                                                                已经认证
                                                        <?php endif; ?>
                                                </div>

                                                <div class="regt">
                                                        <span><b>*</b><label>电子邮件：</label></span>
                                                        <?php echo $form->textField($model, 'email', array('id' => 'email')); ?>    
                                                        <div id="emailTip" style="width:200px" class="onShow"></div>
                                                </div>
                                                <div class="regt">
                                                        <span><label>手机号码：</label></span>
                                                        <?php echo $form->textField($model, 'phone', array('id' => 'phone')); ?>    
                                                       <div id="phoneTip" style="width:200px" class="onShow"></div>
                                                </div>
                                                <div class="regt">
                                                        <span><label>QQ/MSN：</label></span>
                                                        <?php echo $form->textField($model, 'qq', array('id' => 'qq')); ?>    
                                                        <div id="qqTip" style="width:200px" class="onShow"></div>
                                                </div>
                                          
                                        </div>
                                        <div id="reg_button">
                                                <input name="" type="submit" value="" class="rg_btn"  id="Submit1" />
                                        </div>
                                                     <?php $this->endWidget(); ?>
                                </div>
                        </div>
                </div>
        </div>
</div>
<script>
        jQuery.formValidator.initConfig({ submitButtonID: "Submit1",formID:"userprofile-form"});
        jQuery("#email").formValidator({onShow: "", onFocus: "邮箱6-100个字符，格式正确且需唯一", onCorrect: "" }).inputValidator({ min: 6, max: 100, onError: "你输入的邮箱长度非法,请确认" }).regexValidator({ regExp: "^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$", onError: "你输入的邮箱格式不正确" });
        jQuery("#phone").formValidator({ empty: true, onShow: "", onFocus: "请输入你的手机号码", onCorrect: "", onEmpty: "你真的不想留手机号码啊？" }).inputValidator({ min: 11, max: 11, onError: "手机号码必须是11位的,请确认" }).functionValidator({ fun: isMobile });

</script>