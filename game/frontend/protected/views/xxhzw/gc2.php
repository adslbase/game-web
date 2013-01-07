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
<title>《小小海贼王》伟大航路冒险</title>
<link href="<?php echo $layout_asset;?>/css/xxhzw/gc/gc.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="background_two">
   <div id="pagepage">
   
     <div  class="picbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg01.jpg" width="501" height="344" /></div>
     <div  class="picbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg02.jpg" width="501" height="344" border="0" usemap="#Map" />
       <map name="Map" id="Map">
         <area shape="circle" coords="374,269,56" href="http://op.marstv.com/server.html" />
       </map>
     </div>
    
    <div class="con_page">
        <div class="kong"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg_tit02.jpg" width="517" height="127" /></div>
        <div class="kong"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg04.jpg" width="382" height="127" border="0" usemap="#Map2" />
          <map name="Map2" id="Map2">
            <area shape="rect" coords="4,5,172,61" href="index.html" />
            <area shape="rect" coords="189,6,352,60" href="http://op.marstv.com/" />
          </map>
        </div>
        
      <div class="con_pagerep">
      <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit02_01.gif" width="239" height="46" /></td>
  </tr>
 
  <tr>
    <td ><p class="margin" style="margin-left:50px"><span><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_bg02.jpg" width="513" height="328" /><br />
    </span>
       
       
     <span> 1、	玩家可以在港口中点击"出港"，视角将切换至伟大航路场景，共计27个岛屿；。</span><br />
     <span> 2、	航行速度根据船只基础航速来计算，玩家可以通过食物与任命船员来提高航行速度</span> <br />
     <span> 3、	航行消耗：</span><br />
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 1）	食物——船只在海上航行时会不断的消耗食物，船只停留在原地时也需要消耗，进港口停止消耗。当食物消耗完<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;     毕时，船只航速会下降；<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2）	耐久度——船只在海上航行时会不断的消耗耐久度，船只停留在原地时不消耗，船只入港时不恢复耐久度。当船<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 只耐久度为0时，船只航速同样会下降；<br />
<span> 4	、补给：</span><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1）	食物——可以通过港口船坞购买，购买上限等同于食物舱容量，玩家也可以通过制作食物进行补给；<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2）	耐久度恢复——玩家可以在港口酒馆内进行船只修理，玩家每日可低价修复耐久度2W点；<br />
<span> 5、	入港：玩家船只航行至港口点击入港按钮即可。</span>


<br />
    </p></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
      </table>
      
      
      
      


 <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit02_02.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_bg03.jpg" width="511" height="294" /><br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />玩家在海上航行，会遇到各种等级的<span>探险入口</span>。<br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
探险入口等级由低到高分为：<span>新手、初级、中级、高级</span>。进入各个等级的冒险，需要消耗相应的冒险通行证。<br />
&nbsp;&nbsp;&nbsp;&nbsp; 通行证目前可以通过完成每日的跑环任务、烹饪任务来获得。 <br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />冒险可以获得各种战船部件改造的配件和材料外，还可以<span>获得藏宝图、水晶以及各种食物等道具奖励</span>。

<br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />在冒险的过程中，玩家将遇到各种各样的随机事件，如：划拳、发现宝藏、战斗、随机传送、天气效果等等。
<br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />在冒险的过程中也可以<span>随机获得各种奖励</span>，此外玩家需要留意自己的剩余行动次数。次数为0将无法继续行动咯。
<br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />此外在冒险的过程中可以补充战斗损失的生命以及拥有跳过某些事件的功能哦。

      <br />



    </p></td>
  </tr>
      </table>
      
      
    
</div>
      
        <div class="con_foot"></div>
        
                
        <!-- foot 开始-->
<div class="foot">
<p>© All Rights Reserved. 上海耀宇文化传媒有限公司 版权所有   沪ICP备11041807号   增值电信业务经营许可证：沪 B2-20110001 </p>
<p>网络文化经营许可证：文网文[2010]0387-014号 广播电视节目制作经营许可证：(沪)字第177号</p>
<p>Powered by MarsTV.com</p>
</div>  

 
        
    </div>
  </div>
</div>
</body>
</html>
