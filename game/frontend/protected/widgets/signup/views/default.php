<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/reg.css');
$cs->registerScriptFile($layout_asset . '/js/formValidator.min.js');
$cs->registerScriptFile($layout_asset . '/js/formValidatorRegex.js');
?>
<div id="warp" class="wp">
        <div id="reg_warp">
                <div id="reg_cont">
                        <div id="reg_title"><h2>用户注册</h2></div>
                        <div id="regCont">
                                <!--注册提示信息 begin-->
                                <div id="reg_tips">
                                        <p>以下内容我们承诺您的信息安全，不会透露给第三方友情提示：<span class="yellow">*</span>为必填项，请认真填写！</p>
                                </div>
                                <?php
                                $form = $this->beginWidget('CActiveForm', array(
                                    'id' => 'userregister-form',
                                        ));
                                ?>
                                <!--注册提示信息 end-->
                                <div id="regBasis">
                                        <div id="regb_title"></div>
                                        <div class="regt">
                                                <span><b>*</b><label>用户名:</label></span>
                                                <?php echo $form->textField($model, 'username', array('onkeydown' => "if(event.keyCode==32) return false", 'onkeyup' => "value=value.replace(/[^\w\.\/]/ig,'')", 'id' => "us")); ?>
                                                <div id="usTip" class="onCorrect"></div>
                                        </div>
                                        <div class="regt">
                                                <span><b>*</b><label>登录密码:</label></span>
                                                <?php echo $form->passwordField($model, 'password', array('id' => 'password1', 'onkeydown' => 'if(event.keyCode==32) return false')); ?>
                                                <div id="password1Tip" class="onError"></div>
                                        </div>
                                        <div class="regt">
                                                <span><b>*</b>确认密码:</span>
                                                <?php echo $form->passwordField($model, 'password2', array('id' => 'password2', 'onkeydown' => 'if(event.keyCode==32) return false')); ?>
                                                <div id="password2Tip" class="onError"></div>
                                        </div>
                                        <div class="regt">
                                                <span><b>*</b>电子邮件:</span>
                                                <?php echo $form->textField($model, 'email', array('id' => 'email')); ?>
                                                <div id="emailTip"></div>
                                        </div>
                                        <p>提示：电子邮件是找回密码的唯一方式，请认真填写。</p>
                                </div>
                                <div id="reg_id">
                                        <div class="regt">
                                                <span><b>*</b><label>真实姓名：</label></span>
                                                <?php echo $form->textField($model, 'realname', array('id' => 'zsxm', 'onkeydown' => 'if(event.keyCode==32) return false')); ?>
                                                <div id="zsxmTip"></div>
                                        </div>
                                        <div class="regt">
                                                <span><b>*</b><label>身份证号码：</label></span>
                                                <?php echo $form->textField($model, 'sfzh', array('id' => 'sfzh')); ?>
                                                <div id="sfzhTip"></div>
                                        </div>
<!--                                        <p>提示：输入15或18位的身份证。例如：440106198507131483。</p>-->
                                </div>
                                <div id="reg_button">
                                        <input name="" type="submit" value="" class="rg_btn" id="Submit1" />
                                        <p><input name="" type="checkbox" value="" checked="checked" />
                                                <a href="<?php echo $this->createUrl('object/view', array('id' => 14)); ?>" title="" target="_blank">我已经阅读并同意《用户注册服务协议》</a>
                                        </p>
                                </div>

                                <?php $this->endWidget(); ?>
                        </div>
                </div>
        </div>
</div>

<?php if ($loginScript !== ''): ?>
        <?php echo $loginScript ?>
        <?php $this->widget('frontwidgets.artdialog.MArtdialog'); ?>

        <script>
                var timer;
                art.dialog({
                        content: '恭喜你注册成功，正在为你登陆中...',
                        lock: true,
                        background: '#000', // 背景色
                        opacity: 0.87,	// 透明度
                        init: function () {
                                var that = this, i = 5;
                                var fn = function () {
                                        that.title(i + '秒后进行跳转');
                                                !i && that.close();
                                        i --;
                                };
                                timer = setInterval(fn, 1000);
                                fn();
                        },
                        close: function () {
                                clearInterval(timer);
                                location.href = "<?php echo $this->createUrl('site/index') ?>";

                        }
                }).show();
        </script>

<?php endif; ?>
<script type="text/javascript">
<?php
$request = Yii::app()->request;
?>
        jQuery(document).ready(function () {
                $("#email,#password1,#us,#password2").bind('keyup',
                function (event) {
                        if (event.keyCode == 13) {
                                $("#Submit1").trigger('click');
                        }
                });
                 jQuery.formValidator.initConfig({ submitButtonID: "Submit1",formID:"userregister-form"});
                jQuery("#email").formValidator({ onShow: "请输入您的邮箱。这是找回密码的唯一方式！", onFocus: "邮箱6-100个字符，格式正确且需唯一", onCorrect: "恭喜你,这个邮箱可以注册" }).inputValidator({ min: 6, max: 100, onError: "你输入的邮箱长度非法" }).regexValidator({ regExp: "^([\\w-.]+)@(([[0-9]{1,3}.[0-9]{1,3}.[0-9]{1,3}.)|(([\\w-]+.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(]?)$", onError: "你输入的邮箱格式不正确" });

                jQuery("#us").formValidator({ onShow: "由半角字符的字母、数字组成，长度为6~16位。", onFocus: "由半角字符的字母、数字组成，长度为6~16位。", onCorrect: "该用户名可以注册" }).inputValidator({ min: 6, max: 16, onError: "请输入6到16位的用户名" }).regexValidator({ regExp: "^[0-9a-zA-Z]{6,16}$", onError: "用户名格式不正确" }).ajaxValidator({
                        dataType: "json",
                        async: true,
                        url: "<?php echo $this->createUrl('services/checkregname') ?>",
                        success: function (ret) {
                                if (ret.state != 0)
                                        return ret.message;
                                else
                                        return true;
                         
                        },
                        buttons: $("#Submit1"),
                        error: function (jqXHR, textStatus, errorThrown) { alert("服务器没有返回数据，可能服务器忙，请重试" + errorThrown); },
                        onWait: "正在对用户名进行合法性校验，请稍候..."
                });
                $("#sfzh").formValidator({ onShow: "", onFocus: "输入15或18位的身份证", onCorrect: "输入正确" }).functionValidator({ fun: isCardID, onError: "身份证格式不正确" });
                $("#zsxm").formValidator({ onShow: "", onFocus: "请输入你的姓名，例如：张三", onCorrect: "输入正确" }).functionValidator({ fun: isTrueName });


                jQuery("#password1").formValidator({ onShow: "密码长度为6到20位", onFocus: "密码长度为6到20位。", onCorrect: "密码合法" }).inputValidator({ min: 6, max: 20, empty:{leftEmpty:false,rightEmpty:false,emptyError:"密码两边不能有空符号"}, onError: "密码为6到20位,请确认" });
                jQuery("#password2").formValidator({ onShow: "请再输入一次密码。", onFocus: "请再输入一次密码", onCorrect: "密码一致" }).inputValidator({ min: 6, empty: { leftEmpty: false, rightEmpty: false, emptyError: "重复密码两边不能有空符号" }, onError: "重复密码不能为空,请确认" }).compareValidator({ desID: "password1", operateor: "=", onError: "2次密码不一致,请确认" });
        })
</script>


