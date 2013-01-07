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
<title>《小小海贼王》专属船工</title>
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
        <div class="kong"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg03.jpg" width="517" height="127" /></div>
        <div class="kong"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg04.jpg" width="382" height="127" border="0" usemap="#Map2" />
          <map name="Map2" id="Map2">
            <area shape="rect" coords="4,5,172,61" href="index.html" />
            <area shape="rect" coords="189,6,352,60" href="http://op.marstv.com/" />
          </map>
        </div>
        
      <div class="con_pagerep">
      <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit01_01.gif" width="239" height="46" /></td>
  </tr>
  <tr>
    <td><P>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span >战船装备</span>是玩家提升战船实力的重要手段之一，战船装备分为10个部位，每个部位的都有对应的特点属性，具体如下：</P></td>
  </tr>
  <tr>
    <td >
    <TABLE border=0 cellSpacing=0 width=580 align=left class="magin" style=" margin-left:90px">
        <TBODY>
        <TR>
          <TH class=tablebiaoge height=25 width=143 scope=col 
            align=middle><SPAN >部位</SPAN></TH>
          <TH class=tablebiaoge width=306 scope=col align=left><SPAN 
            class=red>效果</SPAN></TH>
          <TH class=tablebiaoge width=125 scope=col align=left><span>属性</span></TH>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船首</TD>
          <TD align=left class=tablebiaoge02>增加战船血量</TD>
          <TD align=left class=tablebiaoge02>血量</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船炮</TD>
          <TD align=left class=tablebiaoge02>增加战船攻击力</TD>
          <TD align=left class=tablebiaoge02>攻击力</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船甲</TD>
          <TD align=left class=tablebiaoge02>增加战船防御力</TD>
          <TD align=left class=tablebiaoge02>防御力</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>炮台</TD>
          <TD align=left class=tablebiaoge02>增加战船攻击速度</TD>
          <TD align=left class=tablebiaoge02>攻击速度</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船骨</TD>
          <TD align=left class=tablebiaoge02>增加战船耐久度</TD>
          <TD align=left class=tablebiaoge02>耐久度</TD>
        </TR>
          <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船舱</TD>
          <TD align=left class=tablebiaoge02>增加战船的货物容量</TD>
          <TD align=left class=tablebiaoge02>货物容量</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>水手舱</TD>
          <TD align=left class=tablebiaoge02>增加水手数量</TD>
          <TD align=left class=tablebiaoge02>水手数量</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>食物舱</TD>
          <TD align=left class=tablebiaoge02>增加战船的食物容量</TD>
          <TD align=left class=tablebiaoge02>食物容量</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船帆</TD>
          <TD align=left class=tablebiaoge02>增加战船航海攻击力</TD>
          <TD align=left class=tablebiaoge02>攻击力</TD>
        </TR>
        <TR>
          <TD class=tablebiaoge02 height=25 align=middle>船桨</TD>
          <TD align=left class=tablebiaoge02>增加战船航海防御力</TD>
          <TD align=left class=tablebiaoge02>防御力</TD>
        </TR>
        <TR>
          <TD colSpan=3 align=left>
            </TD></TR></TBODY></TABLE>
          </td>
  </tr>
  <tr>
    <td ><p class="margin" style="margin-left:50px"><span>战船装备有强化和改造两个概念。</span>
        <br />
       
      <span>强化：</span>玩家使用银币来提升装备的等级。装备等级提升只增加装备的属性。<br />
<span>改造：</span>决定战船装备的成长性高低，强化等级上限。战船部件改造后，对应相应的等级上限<br />
 <br />
 当玩家海上集齐一套船部件后，船外形激活可用（只用于航路上外形，不激活陆战的船模型），并获得该船外形的<br />
 基础属性加成，相反陆地上战船模型如已激活，可在海上直接更换船模型。<br /><br />

 整套船部件改造完成后，才能够改造下级的船部件。 <br />

<br />
    </p></td>
  </tr>
      </table>
      
      
      
      


 <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit01_02.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" /><span>点击战船信息面板</span>中船员头像下方的船员副职按钮出现如下界面<br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_bg01.jpg" width="316" height="161" />      <br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      每名高级船员（紫色及以上）都会自带1个船员副职，<span>初始状态为100亲密度</span>。<br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      玩家通过<span>海上冒险收集或使用金币购买宝物赠送给船员获得亲密度</span>，亲密度上限为100点。 <br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      只有亲密度达到60的船员才可以任命，任命船员到与副职相符的部件就可以激活船员副职加成。<br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      任命后的船员每经过1场战斗都会降低1点亲密度，当亲密度低于60时，船员自动解除任命。<br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      船员的亲密度不同时，会有不同状态，影响副职效果。<br />



    </p></td>
  </tr>
      </table>
      
      
      <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit01_03.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px"><span>1.	战船每个部件都会自带3条特殊属性，初始状态为未激活。</span><br />
   
 <span>2.	当玩家任命任意船员到战船部件后，便能激活部件上的3条特殊属性</span> 。  <br /><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      玩家通过海上冒险收集或使用金币购买宝物赠送给船员获得亲密度，亲密度上限为100点。 <br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      只有亲密度达到60的船员才可以任命，任命船员到与副职相符的部件就可以激活船员副职加成。<br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      任命后的船员每经过1场战斗都会降低1点亲密度，当亲密度低于60时，船员自动解除任命。<br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/ico01.gif" width="16" height="13" />
      船员的亲密度不同时，会有不同状态，影响副职效果。<br />



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
