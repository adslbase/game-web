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
<title>《小小海贼王》VIP介绍页</title>
<link href="<?php echo $layout_asset;?>/css/xxhzw/vip.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="all">
    <div id="background">
       <div id="pagepage">
           
         
           <div class="toppic"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/pic01.jpg" width="501" height="197" /></div>
           <div class="toppic"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/pic02.jpg" width="501" height="197" /></div>
           
           <div class="toppic03">
           <a class="btnpay" href="<?php echo  $this->payUrl ?>"></a>
           <a class="btnhome" href="http://op.marstv.com/"></a></div>
           <div class="toppic"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/pic04.jpg" width="501" height="197" /></div>
         <div class="nav">
           <a class="nav01" href="#vip1"></a>
           <a class="nav02" href="#vip2"></a>
           <a class="nav03" href="#vip3"></a>
           <a class="nav04" href="#vip4"></a>
           <a class="nav05" href="#vip5"></a>
           <a class="nav06" href="#vip6"></a>
           <a class="nav07" href="#vip7"></a>
           <a class="nav08" href="#vip7"></a>
           <a class="nav09" href="#vip10"></a>
           <a class="nav10" href="#vip10"></a>   
         </div>
           <div class="titbgpic_01" style="float:left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/titbgpic_01.jpg" width="1002" height="74" /></div>
         <div class="Table" >
           <table width="890" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="32" class="tablebiaoge">等级</td>
    <td class="tablebiaoge">VIP1</td>
    <td class="tablebiaoge">VIP2    </td>
    <td class="tablebiaoge">VIP3    </td>
    <td class="tablebiaoge">VIP4</td>
    <td class="tablebiaoge">VIP5</td>
    <td class="tablebiaoge">VIP6</td>
    <td class="tablebiaoge">VIP7</td>
    <td class="tablebiaoge">VIP8</td>
    <td class="tablebiaoge">VIP9</td>
    <td class="tablebiaoge">VIP10</td>
  </tr>
  <tr>
    <td height="32" class="tablebiaoge02">充值金额</td>
    <td class="tablebiaoge02">100</td>
    <td class="tablebiaoge02">500</td>
    <td class="tablebiaoge02">1000</td>
    <td class="tablebiaoge02">5000</td>
    <td class="tablebiaoge02">10000</td>
    <td class="tablebiaoge02">20000</td>
    <td class="tablebiaoge02">50000</td>
    <td class="tablebiaoge02">80000</td>
    <td class="tablebiaoge02">150000</td>
    <td class="tablebiaoge02">300000</td>
  </tr>
  </table>
<div class="Table"><br />
  <p><em>注：充值金额可累计。</em>
 
    <br />
    例如：升级VIP3时需要1000金币，所以玩家可以一次性充值1000金币直接升至VIP3，也可以累计充值达到1000金币。<br />
VIP购买活力说明：每次购买均为10活力
 
     第一第二次为20金币，第三第四次为40金币，以此类推</p></div>


         </div>
           
<!-- VIP1 -->  
    <div class="vip02" style="float:left; width:411px; margin-left:60px; margin-top:16px" ><a name="vip1" id="vip9"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip1.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td height="30" align="right">高级召集1级：</td>   <td><p>每天一次免费高级召集次数。</p></td>
  </tr>
  <tr>
    <td width="145" height="30" align="right">训练位3级：</td>
    <td width="305" align="left"><p>开放第3个训练位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">连续攻击：</td>
    <td><p>开放战役中连续攻击功能；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值1级：</td>
    <td><p>可购买3次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力槽1级：</td>
    <td><p>活力槽上限增加10点。</p></td>
  </tr>

</table>

    </div>    
<!-- end -->  
  
<!-- VIP2 -->  
    <div class="vip02" style="float:left; width:451px; margin-left:20px; margin-top:16px" > <a name="vip2" id="vip8"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
   
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip2.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">强化折扣2级：</td>
    <td width="305" align="left"><p>强化装备消耗银币9折；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">开放强化暴击：</td>
    <td><p>强化装备时有概率出现暴击，升级两次；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值2级：</td>
    <td><p>可购买5次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力槽2级：</td>
    <td><p>活力槽上限增加20点。</p></td>
  </tr>
   <tr>
    <td height="30" align="right">海底宝藏2级：</td>
    <td><p>可进行海底沉船宝藏打捞。</p></td>
  </tr>
   <tr>
    <td height="30" align="right">高级召集2级：</td>
    <td><p>每天两次免费高级召集次数</p></td>
  </tr>
</table>

    </div>    
<!-- end -->     
<!-- VIP3 -->  
   <div class="vip02" style="float:left; width:411px; margin-left:60px; margin-top:16px" ><a name="vip3" id="vip3"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
    
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip3.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">训练位4级：</td>
    <td width="306" align="left"><p>开放第4个训练位置；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">奴隶位3级：</td>
    <td><p>开放第3个奴隶位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">开放高级强化：</td>
    <td><p>开放强化装备成功率100%；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">开放白金培养：</td>
    <td><p>船员培养开放更高级的培养方式；</p></td>
  </tr>
   <tr>
    <td height="30" align="right">活力值3级：</td>
    <td><p>可购买10次活力值；</p></td>
  </tr>
   <tr>
    <td height="30" align="right">活力槽3级：</td>
    <td><p>活力槽上限增加30点。</p></td>
  </tr>
   <tr>
    <td height="30" align="right">民居征税2级：</td>
    <td><p>每日民居征税增加至20次。</p></td>
  </tr>
</table>

    </div>    
<!-- end -->  
  
<!-- VIP4 -->  
    <div class="vip02" style="float:left; width:451px; margin-left:20px; margin-top:16px" ><a name="vip4" id="vip4"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip4.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">奴隶位4级：</td>
    <td width="233" align="left"><p>开放第4个奴隶位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">强化折扣3级：</td>
    <td><p>装备强化消耗银币8.5折优惠；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">开放金币训练：</td>
    <td><p>金币训练可快速获得大量船员经验；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值4级：</td>
    <td><p>可购买15次活力值；</p></td>
  </tr>
   <tr>
    <td width="145" height="30" align="right">活力槽4级：</td>
    <td width="233" align="left"><p>活力槽上限增加40点。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">一键合成：</td>
    <td><p>开放贝一键合成功能。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">战船高级升级：</td>
    <td><p>开放战船高级升级功能。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">高级召集3级：</td>
    <td><p>每天三次免费高级召集次数。</p></td>
  </tr>
</table>

    </div>    
<!-- end --> 

<!-- VIP5 -->  
   <div class="vip02" style="float:left; width:411px; margin-left:60px; margin-top:16px" ><a name="vip5" id="vip5"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip5.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">训练位5级：</td>
    <td width="233" align="left"><p>开放第5个训练位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">训练经验倍率2级：</td>
    <td><p>开放200%经验训练模式；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">奴隶位5级：</td>
    <td><p>开放第5个奴隶位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值5级：</td>
    <td><p>可购买20次活力值；</p></td>
  </tr>
   <tr>
    <td height="30" align="right">活力槽5级：</td>
    <td><p>活力槽上限增加50点。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">民居征税3级：</td>
    <td><p>每日征税次数上限至30次。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">海底宝藏3级：</td>
    <td><p>海底宝藏开放海底遗迹打捞。</p></td>
  </tr>
</table>

    </div>    
<!-- end -->  
  
<!-- VIP6 -->  
    <div class="vip02" style="float:left; width:451px; margin-left:20px; margin-top:16px" ><a name="vip6" id="vip6"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip6.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">奴隶位6级：</td>
    <td width="233" align="left"><p>开放第6个奴隶位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">强化折扣4级：</td>
    <td><p>强化装备消耗银币8折优惠；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值6级：</td>
    <td><p>可购买25次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">开放至尊培养：</td>
    <td><p>至尊培养可让船员提升更高成长；</p></td>
  </tr>
    <tr>
    <td height="30" align="right">活力槽6级：</td>
    <td><p>活力槽上限增加60点。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">&nbsp;</td>
    <td><p>一键查看战斗结果</p></td>
  </tr>
    <tr>
    <td height="30" align="right"></td>
    <td><p></p></td>
  </tr>
</table>

    </div>    
<!-- end -->     
<!-- VIP7 -->  
   <div class="vip02" style="float:left; width:411px; margin-left:60px; margin-top:16px" ><a name="vip7" id="vip7"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
    
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip7.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">训练经验倍率3级：</td>
    <td width="233" align="left"><p>开放250%训练经验模式；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">训练位6级：</td>
    <td><p>开放第6个船员训练位；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值7级：</td>
    <td><p>可购买30次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力槽7级：</td>
    <td><p>活力槽上限增加70点。</p></td>
  </tr>
    <tr>
    <td height="30" align="right">民居征税4级：</td>
    <td><p>每日征税次数上限至40次。</p></td>
  </tr>
</table>

    </div>    
<!-- end -->  
  
<!-- VIP8 -->  
    <div class="vip02" style="float:left; width:451px; margin-left:20px; margin-top:16px" ><a name="vip7" id="vip7"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
   
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip8.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">强化折扣5级：</td>
    <td width="233" align="left"><p>强化装备消耗银币减少25%；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值8级：</td>
    <td><p>可购买35次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力槽8级：</td>
    <td><p>活力槽上限增加80点。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">民居征税5级：</td>
    <td><p>每日征税次数上限至50次。</p></td>
  </tr>
      <td height="30" align="right"></td>
    <td><p></p></td>
  </tr>
</table>

    </div>    
<!-- end --> 

<!-- VIP9 -->  
   <div class="vip02" style="float:left; width:411px; margin-left:60px; margin-top:16px" ><a name="vip9" id="vip9"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip9.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">训练经验倍率4级：</td>
    <td width="233" align="left"><p>开放300%训练经验模式；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">高级金币训练：</td>
    <td><p>金币训练获得2倍经验；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值9级：</td>
    <td><p>可购买40次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">强化折扣5级：</td>
    <td><p>装备强化银币消耗减少30%。</p></td>
  </tr>
    <tr>
    <td height="30" align="right">活力槽9级：</td>
    <td><p>活力槽上限增加90点。</p></td>
  </tr>
</table>

    </div>    
<!-- end -->  
  
<!-- VIP10 -->  
    <div class="vip02" style="float:left; width:451px; margin-left:20px; margin-top:16px" ><a name="vip10" id="vip10"></a>
    <table width="411" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><img src="<?php echo $layout_asset;?>/css/xxhzw/vip/tit_vip10.gif" width="346" height="56" /></td>
    </tr>
  <tr>
    <td width="145" height="30" align="right">训练位7级：</td>
    <td width="233" align="left"><p>开放第7个训练位；</p></td>
  </tr>
    <tr>
    <td height="30" align="right">超级金币训练：</td>
    <td><p>金币训练获得2.5倍经验。</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力值10级：</td>
    <td><p>可购买50次活力值；</p></td>
  </tr>
  <tr>
    <td height="30" align="right">活力槽10级：</td>
    <td><p>活力槽上限增加100点。</p></td>
  </tr>
  <tr>
    <td height="30" align="right"></td>
    <td><p></p></td>
  </tr>
</table>

    </div>    
<!-- end -->   

  
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
