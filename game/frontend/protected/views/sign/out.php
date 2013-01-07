<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" > 
        <head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>退出页面</title> 
                <link type="text/css" rel="stylesheet" href="<?php echo $layout_asset; ?>/css/exit.css" />
                <script type="text/javascript"> 
                         setTimeout( 'window.location= "<?php echo Yii::app()->user->loginUrl; ?>" ',3000) ;         
                </script> 
                <?php echo $script; ?>
        </head> 
        <body> 
                <div class="topBox" id="logout_window">
                        <p id="loading_msg" align="center">
                                系统正在为您退出，请稍候... 
                        </p>
                        <div class="graph"> 
                                <strong id="bar" style="width:100%;"> </strong> 
                        </div> 
                        <p id="loading_back" align="center" class="pd10" >
                                <span id="second">3</span>&nbsp;秒后返回到登录页面 <a href="<?php echo Yii::app()->user->loginUrl; ?>">立即返回</a>
                        </p>
                </div>



        </body> 
</html> 














