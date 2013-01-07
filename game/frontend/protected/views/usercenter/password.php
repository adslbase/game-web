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
                                        <li><a href="<?php echo $this->createUrl('usercenter/ChangePassword') ?>" title="" class="una">修改密码</a></li>
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
                                <div id="reg_title"><h2>用户中心&gt;修改密码</h2></div>
                                <div id="regCont">
                                               <?php
                                                $form = $this->beginWidget('CActiveForm', array(
                                                    'id' => 'changepass-form',
                                                        ));
                                                ?>
                                        <div id="reg_id">
                                         
                                                <div class="regt">
                                                        <span><label>请输入旧密码：</label></span>
                                                        <?php echo $form->passwordField($model, 'old_password', array('id' => 'oldpsw')); ?>   
                                                        <div id="oldpswTip" style="width:200px" class="onShow"></div>
                                                </div>
                                                <div class="regt">
                                                        <span><label>请输入新密码：</label></span>
                                                        <?php echo $form->passwordField($model, 'new_password_1', array('id' => 'password1')); ?>    
                                                        <div id="password1Tip" style="width:200px"  class="onShow"></div>
                                                </div>
                                                <div class="regt">
                                                        <span><label>再输入新密码：</label></span>
                                                        <?php echo $form->passwordField($model, 'new_password_2', array('id' => 'password2')); ?>    
                                                        <div id="password2Tip" style="width:200px"  class="onShow"></div>
                                                </div>

                                        </div>
                                        <div id="reg_button">
                                                <input name="" type="submit" value="" class="rg_btn" id="Submit1" />
                                        </div>

                                        <?php $this->endWidget(); ?>
                                </div>
                        </div>

                </div> 
        </div>
</div>
<script type="text/javascript">
        jQuery(document).ready(function () {
                jQuery.formValidator.initConfig({formID:"changepass-form", submitButtonID: "Submit1"
                });
                $("#oldpsw").formValidator({ onShow: "请输入原始密码", onFocus: "请输入原始密码", onCorrect: "" }).inputValidator({ min: 6, onError: "密码不能少于6位!" });
                $("#password1").formValidator({ onShow: "请输入新密码", onFocus: "至少6个长度", onCorrect: "密码合法" }).inputValidator({ min: 6, empty: { leftEmpty: false, rightEmpty: false, emptyError: "密码两边不能有空符号" }, onError: "密码不能少于6位" });
                $("#password2").formValidator({ onShow: "请重复你的密码！", onFocus: "至少6个长度", onCorrect: "密码一致" }).inputValidator({ min: 6, empty: { leftEmpty: false, rightEmpty: false, emptyError: "重复密码两边不能有空符号" }, onError: "重复密码不能为空,请确认" }).compareValidator({ desID: "password1", operateor: "=", onError: "2次密码不一致,请确认" });
        });

</script>
