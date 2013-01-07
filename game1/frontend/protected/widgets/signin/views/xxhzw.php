<?php
if ($user->isGuest === FALSE):
        ?>

        <div id="uc2" class="login2">
                <dl>
                        <dt>您好：<u><?php echo $user->username; ?></u></dt>
                         <dd>您上次登录IP：<?php echo $user->loginip; ?></dd>
                        <dd>登录时间：<span><?php echo date('Y-m-d ', $user->recent_login); ?></span></dd>
                          <dd>
                                <a href="<?php echo $this->createUrl('usercenter/ModifyUserInfo');?>" title="" class="ulin_btn1">修改资料</a>
                                <a href="<?php echo $this->createUrl('payway/index') ?>" title="" class="ulin_btn2">充值</a>
                                <a href="<?php echo $this->createUrl('sign/out') ?>" title="" class="ulin_btn3">退出</a>
                          </dd>
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


        <div id="uc1" >
                <div class="uc_l">
                      <span style="float:left;width:45px;color:white;font-size:14px;">用户名:</span>    <?php echo $form->textField($model, 'username', array('size' => 30, 'class' => 'user_in')); ?>
                        <?php echo $form->error($model, 'username'); ?>
                
                
                </div>
                <div class="uc_l">
                       <span style="float:left;width:45px;color:white">密码:</span>    <?php echo $form->passwordField($model, 'password', array('size' => 30, 'class' => 'user_in')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                
                </div>
                
                
                <?php if ($loginScript === FALSE): ?>
                     <div class="uc_l">
                                <p style="font-size: 14px; color: red;">登陆失败，请重新登陆...</p> 

                                <script> 
                                        setTimeout( 'window.location= "<?php echo Yii::app()->getRequest()->getRequestUri(); ?>" ',3000) 
                                </script>
                         </div>
                <?php elseif ($loginScript) : ?>
                        <div class="uc_l">
                                <?php echo $loginScript; ?>
                                <p style="font-size: 14px; color: red;">正在登陆中...</p> 
                                <script> 
                                        setTimeout( 'window.location= "<?php echo  Yii::app()->getRequest()->getRequestUri(); ?>" ',3000) 
                                </script>
                          </div>
                <?php else: ?>

                             <div class="uc_l">
                        
                        <a href="<?php echo $this->createUrl('sign/up') ?>" title="">>>注册</a>
                        
                        <input name="" type="submit" value="登  录" class="user_btn" />
                
                </div>
                <?php endif; ?>
                
    
        </div>


        <?php $this->endWidget(); ?>
<? endif; ?>


