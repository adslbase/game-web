<style>
.login2{padding:0px 10px;}
.login2 u{font-weight:bold;font-size:14px;color:#FF6600;}
.login2 dt a{margin-left:1em;}
.login2 dt,.login2 dd{line-height:2em;}
.login2 dd a{margin-right:1em;}
.ginbtn{display:block;width:188px;height:39px;background:url(http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/sprite_dlji.png) no-repeat 0 -44px;margin-top:1em;}
.ginbtn:hover{background:url(http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/sprite_dlji.png) no-repeat 0 0;}
.sname{color:#EA522B;text-decoration:underline;}
</style>
<?php
if ($user->isGuest === FALSE):
        ?>

        <div id="uc2" class="login2">
                <dl>
                        <dt><u><?php echo $user->username; ?></u>&nbsp;您好<a href="<?php echo $this->createUrl('sign/out') ?>" title="" class="ulin_btn3">退出</a></dt>
                         <dd>推荐服务器：<a href="javascript:;" title="" class="sname">火星一服</a></dd>
                         <dd>更多服务器：<span><a href="http://g.marstv.com/dxz/server.html" title="" class="sname">更多</a></span><!--<a href="javascript:;" title="">更多</a>--></dd>
                          <dd><a href="javascript:;" title="" class="ginbtn"></a></dd>
                </dl>
        </div>
		<div class="Zcczqu">
                <div class="zczu_1"><a href="/sign/up.html"  class="btn_zc">帐号注册</a><a href="/payway.html"  class="btn_cz">游戏充值</a></div>
              </div>
			  <div class="baiduSharePost">
        <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"> </div>
        
      </div>
<? else: ?>    
        <div class="userin_dengluQu">
		<?php
        $form = $this->beginWidget('CActiveForm', array(
            'id' => 'login-content',
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
                ));
        ?>
			    
				<div class="lg_srqu">
                  <p class="lg_srzh">
				   <?php echo $form->textField($model, 'username', array('size' => 12, 'class' => 'nor')); ?>
                        <?php echo $form->error($model, 'username'); ?>
                  </p>
                  <p class="lg_srmm">
				   <?php echo $form->passwordField($model, 'password', array('size' => 12, 'class' => 'nor')); ?>
                        <?php echo $form->error($model, 'password'); ?>
                  </p>
                   <p class="lg_dl"><input class="btn_dl" type="submit"> </p>
                  <input name="checkbox" type="checkbox" class="fill_duoxuan" value="checkbox" />
                  <p class="lg_ts"> <span class="jzyhm">下次自动登录</span>
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

                        
                        
						<!--<p class="lg_dl"><input name="" type="submit" value="注册" class="btn_dl" /></p>
                        
                        <input name="" type="submit" value="登  录" class="btn_zc" />-->
                
                <?php endif; ?>
           </div>
		   <div class="Zcczqu">
                <div class="zczu_1"><a href="/sign/up.html"  class="btn_zc">帐号注册</a><a href="/payway.html"  class="btn_cz">游戏充值</a></div>
              </div>


        <?php $this->endWidget(); ?>
<? endif; ?>
