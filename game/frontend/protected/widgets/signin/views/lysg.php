<style>
.login2{padding:0px 10px;}
.login2 dl{line-height:1.4em;color:#333;}
.login2 dl dt u{font-weight:bold;}
.login2 dl dd a{display:inline;color:#069;padding-left:0px!important;}
.login2 dl dd span{color:#000;font-family:Verdana;}
</style>
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
                      帐号:<?php echo $form->textField($model, 'username', array('size' => 12, 'class' => 'lgin')); ?>
                        <?php echo $form->error($model, 'username'); ?>
                
                
                </div>
                <div class="uc_l">
                       密码:<?php echo $form->passwordField($model, 'password', array('size' => 12, 'class' => 'lgin')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                
                </div>

				     <div><a href="javascript:; "title="">&gt;&gt;忘记了密码？</a></div>
                
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
                        
                        
						<input name="" type="submit" value="注册" class="lgreg lg2" />
                        
                        <input name="" type="submit" value="登  录" class="lgreg lg1" />
                
                </div>
                <?php endif; ?>
                
    
        </div>


        <?php $this->endWidget(); ?>
<? endif; ?>


