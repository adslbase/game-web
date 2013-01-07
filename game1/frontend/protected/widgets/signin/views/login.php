
<div id="warp" class="wp">
        <div id="user_login">
                <div id="login_banner"></div>

                <div id="login">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-content',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                            ),
                                ));
                        ?>

                        <div id="login_title"><h2>MarsTV网页游戏--请登录后才允许操作</h2></div>
                        <div id="login_warp">
                                <div id="login_cont">
                                        <div class="lc_l">
                                                <span>帐户名：</span>
                                                <?php echo $form->textField($model, 'username', array('size' => 30, 'class' => 'login_in')); ?>
                                                <?php echo $form->error($model, 'username'); ?>
                                        </div>

                                        <div class="lc_l">
                                                <span>密&nbsp;&nbsp;&nbsp;码：</span>
                                                <?php echo $form->passwordField($model, 'password', array('size' => 30, 'class' => 'login_in')); ?>
                                                <?php echo $form->error($model, 'password'); ?>
                                        </div>


                                        <?php if ($loginScript === FALSE): ?>
                                                <div class="lc_l">
                                                        <p style="font-size: 14px; color: red;">登陆失败，请重新登陆...</p> 

                                                        <script> 
                                                                setTimeout( 'window.location= "<?php echo  $user->getReturnUrl(); ?>" ',3000) 
                                                        </script>
                                                </div>
                                        <?php elseif ($loginScript) : ?>
                                                <div class="lc_l">
                                                        <?php echo $loginScript; ?>
                                                        <p style="font-size: 14px; color: red;">正在登陆中...</p> 
                                                        <script> 
                                                                setTimeout( 'window.location= "<?php echo  $user->getReturnUrl(); ?>" ',3000) 
                                                        </script>
                                                </div>
                                        <?php else: ?>



                                                <div class="lc_l">
                                                        <span></span>
                                                        <div>
                                                                <label> <?php echo $form->checkBox($model, 'rememberMe', array('size' => 30, 'class' => 'lc_box')); ?>自动登录</label>
                                                        </div>
                                                </div>

                                                <div class="lc_l">
                                                        <input name="" type="submit" value="登录" class="lc_b1" />
                                                        <a title="点击注册平台新账号" href="<?php echo $this->createUrl('sign/up') ?>" class="lc_b2" target="_blank">注册</a>
                                                </div>

                                        <?php endif; ?>
                                </div>
                        </div>
                        <div id="login_bottom"></div>



                        <?php $this->endWidget(); ?>
                </div>
        </div>
</div>