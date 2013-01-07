<?php
$this->pageTitle = Yii::app()->name . ' - 登陆';
$this->breadcrumbs = array(
    '登陆',
);
?>

<div class="form">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'login-content',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>

    <div class="notification noteinformation png_bg">
        <div>
            <?php echo t('填入用户名和密码'); ?>
        </div>
    </div>

    <div>
        <?php echo $form->error($model, 'username', array('style' => 'text-align:right')); ?>
        <?php echo $form->label($model, 'username'); ?>
        <?php echo $form->textField($model, 'username', array('class' => 'text-input')); ?>
    </div>
    <div class="clear"></div>
    <div>
        <?php echo $form->error($model, 'password', array('style' => 'text-align:right')); ?>
        <?php echo $form->label($model, 'password'); ?>
        <?php echo $form->passwordField($model, 'password', array('class' => 'text-input')); ?>
    </div>
    <div class="clear"></div>

    <?php if ($loginScript === FALSE): ?>
        <p style="font-size: 14px; color: red;">登陆失败，请重新登陆...</p> 

        <script> 
            setTimeout( 'window.location= "<?php echo BACKEND_SITE_URL?>" ',2000) 
        </script>
    <?php elseif ($loginScript) : ?>
        <?php echo $loginScript; ?>
        <p style="font-size: 14px; color: red;">正在登陆中...</p> 
        <script> 
            setTimeout( 'window.location= "<?php echo BACKEND_SITE_URL?>" ',2000) 
        </script>
    <?php else: ?>
        <div id="remember-password" style="float:right;">
            <?php echo $form->checkBox($model, 'rememberMe', array('style' => 'float:left;margin-right: 5px;')); ?>
            <?php echo $form->label($model, 'rememberMe'); ?>
            <?php echo $form->error($model, 'rememberMe'); ?>
        </div>
        <div class="clear"></div>
        <div>
            <?php echo CHtml::submitButton(t('Login'), array('id' => 'login-content-button', 'class' => 'bebutton')); ?>

        </div>
    <?php endif; ?>


    <br class="clear" />



    <?php $this->endWidget(); ?>
</div><!-- form -->
