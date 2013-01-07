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
<title>《小小海贼王》征服列岛</title>
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
        <div class="kong"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg_tit03.jpg" width="517" height="127" /></div>
        <div class="kong" ><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/picbg04.jpg" width="382" height="127" border="0" usemap="#Map2" />
          <map name="Map2" id="Map2">
            <area shape="rect" coords="5,6,173,62" href="index.html" />
            <area shape="rect" coords="190,6,353,60" href="http://op.marstv.com/" />
          </map>
        </div>
        
      <div class="con_pagerep">
      <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit03_01.gif" width="239" height="46" /></td>
  </tr>
 
  <tr>
    <td ><p class="margin" style="margin-left:50px"><span>港口建筑功能：<br />
      <img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_bg04.jpg" width="513" height="328" /><br />
    </span>
       
<span> 1、	总督府——玩家可以进行港口投资、环任务提交、烹饪任务提交等操作</span>
<br />
<span> 2、	交易所——玩家可以进行特产买卖、了解风靡信息</span>
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1）	玩家在每个港口拥有初始配额，玩家购买特产时配额相应减少，当配额为0时玩家不可再购入该特产，配额<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可以根据该港口的总督友好度等级提升，每级提升20%配额；<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2）	系统刷新配额时间为30分钟，玩家也可以花费20金币立即刷新全部港口配额；
3）	港口如果不是玩家所在阵<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;营的占领港口时，玩家在该港口购买或出售特产时需要额外缴纳20%的税金 <br />
<span>3、	酒馆——玩家可以在酒馆补充水手、食物以及耐久修理</span>


<br />
    </p></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
  </tr>
      </table>
      
      
      
      


 <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit03_02.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px"><br />
    <span> 1、	港口规模</span>——港口规模分为小型、中型、大型、巨型四种港口。
<br />
<span> 2、	所属阵营及占有度</span>——在总督府对港口进行投资可以提升阵营对该港口的占有度，当一方阵营的占有度超过50%时，<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;则港口归该阵营所有。拥有港口的阵营玩家在该港口交易所内进行买卖免税，当两方阵营对该港口的占有度都不足<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;50%或同为50%时，该港口不归属任何一方，为中立港口。
<br />
<span> 3、	总督友好度</span>——任意玩家对港口进行投资时，该玩家在该港口的总督友好度将会提升，友好度提升玩家在交易所内<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 的特产品购买配额相应提升。 </p></td>
  </tr>
      </table>
      
      
       <table width="860" border="0" cellpadding="2" cellspacing="2">
  <tr>
    <td class="titbg"><img src="<?php echo $layout_asset;?>/css/xxhzw/gc/pic_tit03_03.gif" width="239" height="46" /></td>
  </tr>

 
  
  <tr>
    <td ><p class="margin" style="margin-left:50px">1.玩家可以通过航海贸易获得利润，同时可获得贸易经验。贸易经验通过出售利润获得。
<br />
2.每个港口产出货物为1~3种，货物1无需贸易等级即可购买，货物2.3需要根据对应的货物等级才能购买。<br />
&nbsp;&nbsp; 物价每半小时会刷新1次. <br />
3.越远价格越高，本地购买后，本地卖出则以1/10购买价格回收。
<br />
4.风靡货物可以在右侧提示栏查看风靡货物产出地以及等级，风靡货物需求处，风靡刷新时间等等。  
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
