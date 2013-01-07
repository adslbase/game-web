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
<title>《小小海贼王》饕餮盛宴</title>
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
        <div class="kong" ><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg_tit04.jpg" width="517" height="127" /></div>
        <div class="kong" ><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg04.jpg" width="382" height="127" border="0" usemap="#Map2" />
          <map name="Map2" id="Map2">
            <area shape="rect" coords="5,4,173,60" href="index.html" />
            <area shape="rect" coords="190,5,353,59" href="http://op.marstv.com/" />
          </map>
        </div>
        
      <div class="con_pagerep">
      <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit04_01.gif" width="239" height="46" /></td>
  </tr>
 
  <tr>
    <td ><p class="margin" style="margin-left:50px"><span>
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_bg05.jpg" width="513" height="350" /><br />
    </span>
       
<span> 1、	烹饪时可以获得烹饪经验，</span>可通过不断烹饪提升烹饪等级；随着烹饪等级提升，将开放更多高级的食谱，烹饪<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;的食物等级不超过玩家烹饪等级；特殊的食谱需要通过冒险获得，高级的食物需要特殊的食材来制作。 <br />
<span>2、	当玩家烹饪等级提升后，在食谱中自动开放新的食谱</span>
<br />
3、	烹饪暴击初始为10%，玩家可以使用相应道具或食物来增加暴击率，并且有相应的持续时间，当烹饪产出暴击时，<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;烹饪经验*2，食物*2。 <br />
4、	制作出的食物自动进入玩家仓库，不同的食物可以补充玩家航海时的食物消耗或者增加玩家的战船属性，食物可以<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出售（价格=制作食材总价*1.5）。 </span>


<br />
    </p></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
      </table>
      
      
      
      


 <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit04_02.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px">1、	玩家每日可以自动领取到烹饪任务，一共10环，完成1个任务后自动接到下1个任务；任务奖励在完成任务时自动<br />
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;发放，完成最后一环后可获得丰厚的额外奖励（鼓励玩家完成每日环任务）。 <br />
        2、	烹饪任务类型唯一：要求玩家制作若干玩家已开放食谱中的食物送至随机港口总督处，即可完成任务，烹饪任务产<br />
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;出为【船部件改装必需材料、银币奖励、藏宝图】，最后一环可获得金币奖励。 </p></td>
  </tr>
      </table>
      
      
       <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit04_03.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px">1、	烹饪经验只有通过烹饪一个途径获得，烹饪等级最高为100级。
        <br />
        2、	当烹饪食物等级＝玩家烹饪等级时，获得100%烹饪经验。
        <br />
        3、	当玩家烹饪等级—烹饪食物等级＝10时，降低50%烹饪经验<br />
4、	当玩家烹饪等级－烹饪食物等级>10时，降低90%烹饪经验
</p></td>
  </tr>
      </table>
      
      <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit04_04.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px">1、	玩家可以通过冒险获得稀有食谱，学习后即可制作稀有食物
        <br />
        2、	稀有食物使用后会有特殊效果，但制作材料较难收集。
        <br />
        3、	后期将开放食物图鉴供玩家收集<span>【大航海成就系统】</span>。 </p></td>
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
