<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/lysg/main.css');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MarsTV-乐游三国—火星游戏中心 火星联盟</title> 

<meta name="description" content="火星联盟 乐游三国，乐游三国官网，《乐游三国》是三国题材的RPG游戏，以三国题材为背景，画风清新可爱引人入胜。游戏独创云职业系统，三国名将沙场点兵，技能搭配神器逆天，全新的理念，打造最好玩的网页游戏，请锁定火星游戏中心g.marstv.com" />

<meta name="keywords" content="火星联盟 乐游三国，火星，火星游戏中心，乐游三国礼包，乐游三国新手卡，火星一服，marstv" />

<style>
#banner{height:300px;}
#flash_text{left:180px;top:80px;}
#warp{background:#ccc;margin-top:-60px;}
#warp_title{height:37px;line-height:40px;background:url(http://g.marstv.com/assets/751ad8b7/css/lysg/images/page.png) no-repeat;padding-left:5em;}
#warp_title dt,#warp_title dd{float:left;margin-left:.6em;color:#fff;}#warp_title dd a{color:#fff;}
#warp_cont{background:url(http://g.marstv.com/assets/751ad8b7/css/lysg/images/page_bg.jpg) repeat-y;padding:10px;color:#51853b;}
#warp_bottom{height:10px;background:url(http://g.marstv.com/assets/751ad8b7/css/lysg/images/page.png) no-repeat bottom center;}
#news_list{padding:10px 2em;}
#news_list li{line-height:3em;border-bottom:1px dashed #ccc;}
#news_list li span{float:right;*margin-top:-3em;}
#news_list .page_nu{text-align:center;font-weight:normal;margin-top:2em;}
#news_list .page_nu a{border:1px solid #ccc;padding:.5em;margin:0px .5em;color:#999;}
#news_list .page_nu a:hover{border:1px solid #333;color:red;}
</style>
</head>
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
    	<?php  $this->widget('frontwidgets.signin.SigninBlock',array('template'=>'lysg')); ?>
    </div>
    <div class="cl"></div>
    <div id="server">
    		<h2>推荐服务器</h2>
    		<ul>
            	<?php $this->widget('frontwidgets.gameserver.GameServerBlock', array('template' => '', 'gameid' => $this->gameid)); ?>
            </ul>
    </div>
    <div id="kefu">
        <ul>
        	<li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/tel_icon.jpg" alt="" /></span><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/mail_icon.jpg" alt="" /></span>投诉信箱：gmkf@marstv.com</li>
            <li><span><img src="http://g.marstv.com/assets/751ad8b7/css/lysg/images/qq_icon.jpg" alt="" /></span>玩家QQ群：152556366</li>
        </ul>
        <div class="cl"></div>
        <a href="javascript:;" title="" class="sbtn"></a>
        <a href="javascript:;" title="" class="wcn">未成年人家长监护</a>
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
         <div id="news_list">
         <?php
                                        $this->widget('zii.widgets.CListView', array(
                                            'dataProvider' => $dataProvider,
                                            'itemView' => '_list',
                                            'itemsTagName' => 'ul',
                                                    'ajaxUpdate'=>FALSE
                                        ));
                                        ?>  
         <div class="cl"></div>
         
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
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F8887e203ca80d86cefcd6eacd1b7edaf' type='text/javascript'%3E%3C/script%3E"));
</script>
</body>
</html>
