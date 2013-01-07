<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MarsTV-乐游三国—火星游戏中心 火星联盟</title> 

<meta name="description" content="火星联盟 乐游三国，乐游三国官网，《乐游三国》是三国题材的RPG游戏，以三国题材为背景，画风清新可爱引人入胜。游戏独创云职业系统，三国名将沙场点兵，技能搭配神器逆天，全新的理念，打造最好玩的网页游戏，请锁定火星游戏中心g.marstv.com" />

<meta name="keywords" content="火星联盟 乐游三国，火星，火星游戏中心，乐游三国礼包，乐游三国新手卡，火星一服，marstv" />

<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/lysg/main.css');
?>
<body>
<div id="main_nav">
	<ul>
    	<li><a href="http://www.marstv.com/" target="_blank" title="官网首页" id="nv1">官网首页</a></li>
        <li><a href="http://lysg.marstv.com/xw.html" target="_blank" title="新闻公告" id="nv2">新闻公告</a></li>
        <li><a href="http://g.marstv.com/card/index.html" title="领新手卡" id="nv3">领新手卡</a></li>
        <li><a href="http://g.marstv.com/payway/game.html?gameid=142" target="_blank" title="充值中心" id="nv4">充值中心</a></li>
        <li><a href="http://g.marstv.com/customer.html" target="_blank" title="客服中心" id="nv5">客服中心</a></li>
        <li><a href="http://bbs.marstv.com/forum-103-1.html" target="_blank" title="游戏论坛" id="nv6">游戏论坛</a></li>
    </ul>
</div>
<div id="banner">
	<div id="flash_text">
    	<!--<a href="javascript:;" title="">双线五区 舌战群儒 10月22日 11:00火爆开启--></a>
    </div>
    <div id="star">
   	  <object width="258" height="246" align="bottom" id="_playerswf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab#version=10,0,0,0">
      <param name="movie" value="http://g.marstv.com/assets/751ad8b7/css/lysg/images/startgame/startgame.swf">
      <param name="wmode" value="transparent">
      <param name="allowscriptaccess" value="true"><param name="quality" value="high">
      <param name="allowfullscreen" value="true"><param name="allownetworking" value="all">
      <embed width="258" height="246" align="bottom" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="true" id="_playerswf" name="_playerswf" quality="high" src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/startgame/startgame.swf" wmode="transparent">
      </object>
    </div>
    <div id="show">
    	<object width="500" height="286" align="bottom" id="_playerswf" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/get/flashplayer/current/swflash.cab#version=10,0,0,0">
      <param name="movie" value="http://g.marstv.com/assets/751ad8b7/css/lysg/images/startgame/show_pic.swf">
      <param name="wmode" value="transparent">
      <param name="allowscriptaccess" value="true"><param name="quality" value="high">
      <param name="allowfullscreen" value="true"><param name="allownetworking" value="all">
      <embed width="500" height="286" align="bottom" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="true" id="_playerswf" name="_playerswf" quality="high" src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/startgame/show_pic.swf" wmode="transparent">
      </object>
    </div>
</div>
<div id="web">
<div id="sider">
	<div id="login">
    	<!--<form action="" method="get">
        		<div><label>帐号:</label><input type="text" size="18" class="lgin" /></div>
                <div><label>密码:</label><input type="password" size="18" class="lgin" /></div>
                <div><a href="javascript:; "title="">&gt;&gt;忘记了密码？</a></div>
                <div><input type="button" value="登录" class="lgreg lg1" /><input type="button" value="注册" class="lgreg lg2" /></div>
        </form>-->
		 <?php  $this->widget('frontwidgets.signin.SigninBlock',array('template'=>'lysg')); ?>
    </div>
    <div class="cl"></div>
    <div id="server">
    		<h2>推荐服务器</h2>
    		<ul>
			    <?php $this->widget('frontwidgets.gameserver.GameServerBlock', array('template' => '', 'gameid' => $this->gameid)); ?>
            	<!--<li><a href="http://g.marstv.com/lysg/game?server_id=1" title="">S4-草船借箭</a><span class="gr">新开</span></li>-->
                <!--<li><a href="javascript:;" title="">S4-草船借箭</a><span class="yl">新开</span></li>
                <li><a href="javascript:;" title="">S4-草船借箭</a><span class="yl">新开</span></li-->
            </ul>
            <!--<a href="javascript:;" title="" class="allserver">全部服务器</a>-->
    </div>
    <div id="kefu">
        <ul>
        	<li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/tel_icon.jpg" alt="" /></span><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/mail_icon.jpg" alt="" /></span>投诉信箱：gmkf@marstv.com</li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/qq_icon.jpg" alt="" /></span>玩家QQ群：152556366</li>
            <!--<li><span><img src="http://game.marstv.cn/assets/751ad8b7/css/lysg/images/web_icon.jpg" alt="" /></span>商务合作：bd@96wan.com</li>-->
        </ul>
        <div class="cl"></div>
        <a target="_blank" href="http://chat.53kf.com/company.php?arg=96wankf&style=1" title="" class="sbtn"></a>
        <a target="_blank" href="javascript:;" title="" class="wcn">未成年人家长监护</a>
    </div>
    <!--<div id="flink">
    	<ul>
        	<li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
            <li><a href="javascript:;" title="">泡泡玩</a></li>
        </ul>
    </div>-->
</div>
<div id="warp">
    <div id="cont">
    	<div id="news_inf">
        	<div id="news">
            	<div id="news_title">
                <ul>
                	<li><a href="javascript:;" title="" class="ahv">最新</a></li>
                </ul>
                <a href="http://lysg.marstv.com/xw.html" title="" class="news_more">更多&gt;&gt;</a></div>
            	<div id="news_cont">
                	<h3><a href="http://g.marstv.com/lysg/246.html" target="_blank" title="">《乐游三国》双线 火星一服 12月20日16点火爆开启</a></h3>
                    <ul>
					 <?php foreach ($news as $new): ?>
                    	<li><a href="<?php echo $this->createUrl('lysg/view', array('id' => $new['object_id'])); ?>" target="_blank" title=""><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/n1_icon.jpg" alt="" /><?php echo str_cut($new['object_name'], 70); ?></a><span>12-12</span></li>
					<?php endforeach; ?>
                    </ul>
                </div>
            </div>
            <div id="inf">
            	<div id="inf_title"><div id="tz"></div></div>
                <div id="inf_cont">
				<div class="cl"></div>
                	<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #9fb993;font-size:12px;">
					  <tr class="tdbr">
					   <td height="48" align="center" valign="middle" bgcolor="#598c00"><font color="#fff">游戏介绍</font></td>
						<td width="14" height="48" valign="middle" class="tdbg"></td>
						<td width="10" height="48" valign="middle" bgcolor="#e4f6da"></td>
						<td valign="middle" bgcolor="#e4f6da">
						         <a href="http://g.marstv.com/lysg/150.html" title="">地图详情 </a>|
								 <a href="http://g.marstv.com/lysg/151.html" title=""> 阵型介绍 </a>|
								 <a href="http://g.marstv.com/lysg/152.html" title=""> 游戏简介 </a>|
								 <a href="http://g.marstv.com/lysg/153.html" title=""> 故事背景</a>
						</td>
						<td width="10" valign="middle" bgcolor="#e4f6da"></td>
					  </tr>
					  <tr>
						<td height="1" colspan="5" valign="middle" bgcolor="#9fb993"></td>
					  </tr>
					  <tr>
						<td width="72" height="48" align="center" valign="middle" bgcolor="#598c00"><font color="#fff">新手指南</font></td>
						<td height="48" valign="middle" class="tdbg"></td>
						<td height="48" valign="middle" bgcolor="#e4f6da"></td>
						<td height="48" valign="middle" bgcolor="#e4f6da">
						          <a href="http://g.marstv.com/lysg/155.html" title="">剧情任务 </a>|
								  <a href="http://g.marstv.com/lysg/156.html" title=""> 人物角色 </a>|
								  <a href="http://g.marstv.com/lysg/157.html" title=""> 装备信息 </a>|
								  <a href="http://g.marstv.com/lysg/158.html" title=""> 游戏FAQ </a>|
								  <a href="http://g.marstv.com/lysg/154.html" title=""> 其他道具</a>
					   </td>
					   <td width="10" valign="middle" bgcolor="#e4f6da"></td>
					  </tr>
					  <tr>
						<td height="1" colspan="5" valign="middle" bgcolor="#9fb993"></td>
						</tr>
					  <tr>
						 <td width="72" height="48" align="center" valign="middle" bgcolor="#598c00"><font color="#fff">特色系统</font></td>
						<td height="48" valign="middle" class="tdbg"></td>
						<td height="48" valign="middle" bgcolor="#e4f6da"></td>
						<td height="48" valign="middle" bgcolor="#e4f6da">
						          <a href="http://g.marstv.com/lysg/159.html" title="">帮会系统 </a>|
								  <a href="http://g.marstv.com/lysg/160.html" title=""> 声望系统 </a>|
								  <a href="http://g.marstv.com/lysg/161.html" title=""> 经验球系统</a></td>
						<td height="48" valign="middle" bgcolor="#e4f6da"></td>
					  </tr>
					  <tr>
						<td height="1" colspan="5" valign="middle" bgcolor="#9fb993"></td>
						</tr>
					  <tr>
						<td width="72" height="48" align="center" valign="middle" bgcolor="#598c00"><font color="#fff">精彩玩法</font></td>
						<td height="48" valign="middle" class="tdbg">&nbsp;</td>
						<td height="48" valign="middle" bgcolor="#e4f6da">&nbsp;</td>
						<td height="48" valign="middle" bgcolor="#e4f6da">
						         <a href="http://g.marstv.com/lysg/162.html" title="">过关斩将 </a>|
								 <a href="http://g.marstv.com/lysg/163.html" title=""> 竞技场 </a>|
								 <a href="http://g.marstv.com/lysg/164.html" title=""> 扫荡系统 </a>|
								 <a href="http://g.marstv.com/lysg/165.html" title=""> 挑战精英 </a>|
								 <a href="http://g.marstv.com/lysg/166.html" title=""> 大乱斗 </a>|
								 <a href="http://g.marstv.com/lysg/169.html" title=""> 帮会BOSS </a>|
								 <a href="http://g.marstv.com/lysg/167.html" title=""> 帮会战</a></td>
						<td height="48" valign="middle" bgcolor="#e4f6da">&nbsp;</td>
					  </tr>
					  <tr>
						<td height="1" colspan="5" valign="middle" bgcolor="#9fb993"></td>
				      </tr>
					  <tr>
						<td width="72" height="48" align="center" valign="middle" bgcolor="#598c00"><font color="#fff">高手进阶</font></td>
						<td height="48" valign="middle" class="tdbg">&nbsp;</td>
						<td height="48" valign="middle" bgcolor="#e4f6da">&nbsp;</td>
						<td height="48" valign="middle" bgcolor="#e4f6da">
						         <a href="http://g.marstv.com/lysg/171.html" title="">押镖系统 </a>|
								 <a href="http://g.marstv.com/lysg/172.html" title=""> 提升将领 </a>|
								 <a href="http://g.marstv.com/lysg/174.html" title=""> 社交系统 </a>|
								 <a href="http://g.marstv.com/lysg/175.html" title=""> 神器升级 </a>|
								 <a href="http://g.marstv.com/lysg/178.html" title=""> 坐骑系统 </a>|
								 <a href="http://g.marstv.com/lysg/179.html" title=""> 修炼系统 </a>|
								 <a href="http://g.marstv.com/lysg/180.html" title=""> 神器系统</a></td>
						<td height="48" valign="middle" bgcolor="#e4f6da">&nbsp;</td>
					  </tr>
                  </table>
              </div>
            </div>
        </div>
        <div id="vtg">
        	<div id="play">
            	<a href="http://g.marstv.com/payway/game.html?gameid=142" target="_blank" title="">游戏充值</a>
            </div>
            <div class="cl"></div>
            <div id="vip">
            	<a href="http://g.marstv.com/lysg/243.html" title=""><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/vip_icon.png" alt="" /></a>
            </div>
            <div class="cl"></div>
            <div id="weibo">
            	<a href="http://g.marstv.com/card/index.html" title=""><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/weibo.jpg" alt="" /></a>
            </div>
            <div class="cl"></div>
            <div id="gl">
            	<div id="gl_title"></div>
                <ul>
				    <?php $i = 0 ?>
                    <?php foreach ($gls as $new): ?>
                	<li><a href="<?php echo $this->createUrl('lysg/view', array('id' => $new['object_id'])); ?>" title=""><?php echo str_cut($new['object_name'], 48); ?></a><span><?php echo date('m-d', $new['object_date']) ?></span></li>
                                       <?php $i++ ?>
                                         <?php if ($i == 10): ?>
										   </ul>
										   <ul style="margin-left:50px;">
										 <?php endif; ?>

                  <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="cl"></div>
    <div id="pic">
    	<div id="pic_title">
        	<ul>
                <li><a href="javascript:;" title="" class="pt2">游戏截图</a></li>
            </ul>
        </div>
        <div class="cl"></div>
        <div id="pic_cont">
        	<div id="pic1">
            	<ul>
                	<li><a href="http://sg.96wan.com/files/2012/09/原画3.jpg" target="_blank" title=""><img src="http://sg.96wan.com/files/2012/09/原画3-154x103.jpg" alt="" /></a></li>
                    <li><a href="http://sg.96wan.com/files/2012/09/原画2.jpg" target="_blank" title=""><img src="http://sg.96wan.com/files/2012/09/原画2-154x103.jpg" alt="" /></a></li>
                    <li><a href="http://sg.96wan.com/files/2012/09/原画1.jpg" target="_blank" title=""><img src="http://sg.96wan.com/files/2012/09/原画1-154x103.jpg" alt="" /></a></li>
                    <li><a href="javascript:;" target="_blank" title=""><img width="154" height="103" src="http://sg.96wan.com/statics/img/sg/1312.jpg" alt="" /></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="bottom"></div>
</div>
</div>
<div class="cl"></div>
<div id="footer">
	<div id="footer_cont">
    	<div id="footer_pic"><a href="javascript:;" title=""><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/logo_marstv.jpg" alt="" /></a></div>
        <div id="ft">
        	<p>客服邮箱：gmkf@marstv.com 客服QQ：192254648</p>
            <p>抵制不良游戏，拒绝盗版游戏，注意自我保护，谨防受骗上当，适度游戏益脑，沉迷游戏伤身，合理安排时间，享受健康生活。</p>
        </div>
        <div class="cl"></div>
        <p class="copy">上海耀宇文化传媒有限公司版权所有(<a href="http://www.marstv.com" title="">www.marstv.com</a>) 沪ICP备12001511号-1</p>
    </div>
</div>
<script type="text/javascript">
<!--
swfobject.registerObject("FlashID");
//-->
</script>
<script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F8887e203ca80d86cefcd6eacd1b7edaf' type='text/javascript'%3E%3C/script%3E"));
hide(_bdhmProtocol);
</script>
</body>
</html>
