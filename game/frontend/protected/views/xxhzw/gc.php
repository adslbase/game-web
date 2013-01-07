<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>《小小海贼王》</title>
<link href="<?php echo $layout_asset;?>/css/xxhzw/gc/gc.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="background">
    <div id="pagepage">
   <div class="indexbg">
      <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="1002" height="700" id="guhumjkono">
              <param name="movie" value="gc2012/gc.swf" />
              <param name="quality" value="high" />
              <param name="wmode" value="transparent" />
              <param name="BGCOLOR" value="#D6D6D6" />
              <param name="SCALE" value="exactfit" />
              <embed src="<?php echo $layout_asset;?>/css/xxhzw/gc/gc.swf" width="1002" height="700" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" wmode="transparent" bgcolor="#D6D6D6" scale="exactfit"></embed>
            </object>
            
            </div>
  

    <div id="pic01"></div></div>
    <div id="foot">
       <div class="foot_con">
               
        <!-- foot 开始-->
<div class="foot"><br /><br />

<p>© All Rights Reserved. 上海耀宇文化传媒有限公司 版权所有   沪ICP备11041807号   增值电信业务经营许可证：沪 B2-20110001 </p>
<p>网络文化经营许可证：文网文[2010]0387-014号 广播电视节目制作经营许可证：(沪)字第177号</p>
<p>Powered by MarsTV.com</p>

</div>  

 
       </div>
    </div>
</div>
</body>
</html>
