<?php
        if ($user->isGuest === FALSE):
                ?>
                <div id="ul_lin">
                        <dl id="ullin_name">
                                <dt>您好：<span><?php echo $user->username; ?></span></dt>
                                <dd>您上次登录IP：<?php echo $user->loginip; ?></dd>
                                <dd>登录时间：<?php echo date('Y-m-d h:i:s', $user->recent_login); ?></dd>
                                <dd>
                                        <a href="<?php echo $this->createUrl('usercenter/ModifyUserInfo'); ?>" title="" class="ulin_btn1">修改资料</a>
                                        <a href="<?php echo $this->createUrl('payway/index') ?>" title="" class="ulin_btn2">充值</a>
                                        <a href="<?php echo $this->createUrl('sign/out') ?>" title="" class="ulin_btn3">退出</a></dd>
                        </dl>
                        <dl id="ullin_game">
                                <dt>上次玩过的游戏</dt>
                                 <?php if (empty($lastGame)): ?>
                                        <dd><a href="<?php echo $this->createUrl('gamecenter/index')?>" title="">最近还没玩过游戏哦！</a></dd>
                                <?php else: ?>
                                        <dd>
                                                <em><a href="<?php echo  $this->createUrl($lastGame->value['gamesn'].'/index')?>" target="_blank"><?php echo $lastGame->value['gamename']?></a></em> 
                                                <a href="<?php echo  $this->createUrl($lastGame->value['gamesn'].'/game',array('server'=>$lastGame->value['serverid']))?>"  target="_blank">
                                                        <?php echo $lastGame->value['servername']?> 
                                                </a>
                                        </dd>
                                <?php endif; ?>
                        </dl>
                        <dl id="ulive_game">
                                <dt>猜你喜欢</dt>
                                <dd><a href="http://g.marstv.com/xxhzw/index.html" title=""><span>小小海贼王</span></a></dd>
                        </dl>
                </div>

        <? else: ?>    
                <?php
                $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'login-content',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                        'validateOnSubmit' => true,
                            ),
                                ));
                ?>

                <div id="ul_login">
                        <label>
                                <span class="in_title">用户名：</span>
                <?php echo $form->textField($model, 'username', array('size' => 30, 'class' => 'user_in')); ?>
                                <?php echo $form->error($model, 'username'); ?>
                        </label>
                        <label>
                                <span class="in_title">密&nbsp;&nbsp;码：</span>
                <?php echo $form->passwordField($model, 'password', array('size' => 30, 'class' => 'user_in')); ?>
                                <?php echo $form->error($model, 'password'); ?>
                        </label>
                        <label class="user_d">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>自动登录
                                <!--                        <a href="javascript:;" title="">忘记密码？</a>-->
                        </label>



                <?php if ($loginScript === FALSE): ?>
                                <label>
                                        <p style="font-size: 14px; color: red;">登陆失败，请重新登陆...</p> 

                                        <script> 
                                                setTimeout( 'window.location= "<?php echo Yii::app()->getRequest()->getRequestUri(); ?>" ',3000) 
                                        </script>
                                </label>
                <?php elseif ($loginScript) : ?>
                                <label>
                                <?php echo $loginScript; ?>
                                        <p style="font-size: 14px; color: red;">正在登陆中...</p> 
                                        <script> 
                                                setTimeout( 'window.location= "<?php echo Yii::app()->getRequest()->getRequestUri(); ?>" ',3000) 
                                        </script>
                                </label>
                <?php else: ?>

                                <label class="user_button">
                                        <input name="" type="submit" value="登录" class="ub_login" />

                                        <a title="点击注册平台新账号" href="<?php echo $this->createUrl('sign/up') ?>" class="ub_reg" target="_blank">注册</a>
                                </label>

                <?php endif; ?>
                </div>

                <?php $this->endWidget(); ?>
<? endif; ?>


