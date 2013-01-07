<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MarsTV</title>
<style>
#banner{height:300px;}
#flash_text{left:180px;top:80px;}
#warp{background:#ccc;margin-top:-60px;}
#warp_title{height:37px;line-height:40px;background:url(http://g.marstv.com/assets/751ad8b7/css/lysg/images/page.png) no-repeat;padding-left:5em;}
#warp_title dt,#warp_title dd{float:left;margin-left:.6em;color:#fff;}#warp_title dd a{color:#fff;}
#warp_cont{background:url(http://g.marstv.com/assets/751ad8b7/css/lysg/images/page_bg.jpg) repeat-y;padding:10px;color:#51853b;}
#warp_bottom{height:10px;background:url(http://g.marstv.com/assets/751ad8b7/css/lysg/images/page.png) no-repeat bottom center;}
#wc_title{text-align:center;border-bottom:1px dashed #ccc;margin-bottom:10px;}
#wc_title h2{font-size:16px;line-height:2em;}
#wc_title p{line-height:2em;}
#wc_cont{padding:0px 10px;}
#wc_cont p{text-indent:2em;line-height:2em;margin-bottom:1.5em;}
</style>
</head>
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
    	<a href="javascript:;" title="">双线五区 舌战群儒 10月22日 11:00火爆开启</a>
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
</div>
<div id="web">
<div id="sider">
	<div id="login">
    	
    </div>
    <div class="cl"></div>
    <div id="server">
    		<h2>推荐服务器</h2>
    		<ul>
            	<li><a href="http://g.marstv.com/lysg/game?server_id=1" title="">S4-草船借箭</a><span class="gr">新开</span></li>
                <!--<li><a href="javascript:;" title="">S4-草船借箭</a><span class="yl">新开</span></li>
                <li><a href="javascript:;" title="">S4-草船借箭</a><span class="yl">新开</span></li>-->
            </ul>
            <!--<a href="javascript:;" title="" class="allserver">全部服务器</a>-->
    </div>
    <div id="kefu">
        <ul>
        	<li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/tel_icon.jpg" alt="" /></span><a target="_blank" href="http://chat.53kf.com/company.php?arg=96wankf&style=1" title="">在线客服</a></li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/mail_icon.jpg" alt="" /></span><a href="javascript:;" title="">投诉信箱：tousu@96wan.com</a></li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/qq_icon.jpg" alt="" /></span><a href="javascript:;" title="">玩家QQ群：113722285</a></li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/web_icon.jpg" alt="" /></span><a href="javascript:;" title="">商务合作：bd@96wan.com</a></li>
        </ul>
        <div class="cl"></div>
        <a target="_blank" href="http://chat.53kf.com/company.php?arg=96wankf&style=1" title="" class="sbtn"></a>
        <a target="_blank" href="http://www.96wan.com/jzjh/" title="" class="wcn">未成年人家长监护</a>
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
    <div id="warp_title">
    	<dl>
        	<dt>当前位置：</dt>
            <dd><a href="javascript:;" title="">乐游三国</a>&gt;</dd>
            <dd><a href="javascript:;" title="">新闻</a>&gt;</dd>
            <dd><a href="javascript:;" title="">文章正文</a></dd>
        </dl>
    </div>
    <div id="warp_cont">
    	<div id="wc_title">
        	<h2>盘点《乐游三国》中的萌文化之第三季</h2>
        	<p>新闻/2012-11-20</p>
        </div>
        <div id="wc_cont">
        	<p>《乐游三国》在紧张纷呈的三国世界内添加了许多搞笑的元素，萌死人不偿命的NPC，独具匠心的地图细节，以及轻松搞笑的台词，使得精彩刺激的剧情之中又不乏轻松有趣！闲话少说，让我们书接上会继续盘点那些令人捧腹的瞬间：</p>
            <p>‘文明单挑，不准打脸！？’说起来古人的素质水平还真高，不过刀枪棍棒的伺候想要做到不打脸貌似有点难度！留个全尸都已经谢天谢地了。</p>
            <img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/wenmingdantiao-700x390.jpg" alt="" />
        </div>
    </div>
    <div id="warp_bottom"></div>
</div>
</div>
<div class="cl"></div>
<div id="footer">
	<div id="footer_cont">
    	<div id="footer_pic"><a href="javascript:;" title=""><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/logo_marstv.jpg" alt="" /></a></div>
        <div id="ft">
        	<p>投诉邮箱：ts@96wan.com   客服邮箱：cs@96wan.com   客服电话：400 800 8080  客服传真：021-35120477</p>
            <p>抵制不良游戏，拒绝盗版游戏，注意自我保护，谨防受骗上当，适度游戏益脑，沉迷游戏伤身，合理安排时间，享受健康生活。</p>
        </div>
        <div class="cl"></div>
        <p class="copy">Copyright ©2012-2015  www.96wan.com All Rights Reserved <a href="javascript:;" title="">沪ICP备12027155号</a>网络文化经营许可证：<a href="javascript:;" title="">沪网文[2012]0312-050号</a>  上海阡萌网络科技有限公司</p>
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
</script>
</body>
</html>
