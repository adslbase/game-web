<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/dxz/main.css');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大侠传</title>
<meta name="keywords" content="大侠传" />
<meta name="description" content="大侠传" />
</head>
<body>
<script type="text/javascript">
function addfavorite()
{
   if (document.all)
   {
      window.external.addFavorite('http://dxz.marstv.com','收藏夹');
   }
   else if (window.sidebar)
   {
      window.sidebar.addPanel('Martsv-大侠传', 'http://dxz.marstv.com', "");
   }
} 

function SetHome(obj,vrl){
        try{
                obj.style.behavior='url(#default#homepage)';obj.setHomePage(vrl);
        }
        catch(e){
                if(window.netscape) {
                        try {
                                netscape.security.PrivilegeManager.enablePrivilege("UniversalXPConnect");
                        }
                        catch (e) {
                                alert("此操作被浏览器拒绝！\n请在浏览器地址栏输入“about:config”并回车\n然后将 [signed.applets.codebase_principal_support]的值设置为'true',双击即可。");
                        }
                        var prefs = Components.classes['@mozilla.org/preferences-service;1'].getService(Components.interfaces.nsIPrefBranch);
                        prefs.setCharPref('browser.startup.homepage',vrl);
                 }
        }
}
</script>
<!--统一头部导航开始-->
<div id="top">
	<div id="top_cont" class="wp">
    	<dl>
        	<dt><a href="javascript:;" title="MarsTV-小小海贼王" id="top_logo" class="text_td">MarsTV-小小海贼王</a></dt>
            <dd class="red">本游戏适合18岁以上玩家进入</dd>
        </dl>
        <ul>
        		<li class="tli1"><a href="/customer/4.html" title="">防沉迷系统</a></li>
            	<li class="tli2"><a href="/object/dispute.html" title="">交易纠纷处理</a></li>
            	<li class="tli3"><a id="setHomepage" title="" onClick="SetHome(window.location,document.title)"  href="javascript:;">设为首页</a></li>
            	<li class="tli4"><a id="addFavorite" title="" onClick="return addfavorite();" href="javascript:;">加入收藏</a></li>
        	</ul>
    </div>
</div>

<!--页面大区开始-->
<div class="pgbgs">
 <div class="wrap">
  <!--头部区开始-->
  <div class="Headerbar">
   <!--导航开始-->
   <div class="NavBar">
    <ul class="navs1ji">
     <li class="nahome">
      <p class="nbts"><a title="官网首页" href="http://dxz.marstv.com" target="_blank" class="current">官网首页</a></p>
     </li>
     <li class="naxinwen">
      <p class="nbts"><a title="新闻公告" href="http://g.marstv.com/dxz/xw.html" target="_blank">新闻公告</a></p>
     </li>
     <li class="naziliao">
      <p class="nbts"><a title="游戏资料" target="_blank" href="http://g.marstv.com/dxz/gl.html">游戏资料</a></p>
     </li>
     <li class="napay">
      <p class="nbts"><a title="充值中心" href="http://g.marstv.com/payway.html" target="_blank">充值中心</a></p>
     </li>
     <li class="nakefu">
      <p class="nbts"><a title="客服中心" href="http://g.marstv.com/customer.html" target="_blank">客服中心</a></p>
     </li>
     <li class="nabbs">
      <p class="nbts"><a title="玩家论坛" target="_blank" href="http://bbs.marstv.com/forum-104-1.html">玩家论坛</a></p>
     </li>
    </ul>
    <div class="clear"></div>
   </div>
   <!--导航结束-->
   <div class="LogoPost"><a title="大侠传" href="http://http://g.marstv.com/dxz">大侠传</a></div>
   <div class="XiarenPost"><a title="侠人轶事" href="#">侠人轶事</a></div>
   <div class="JiangPost"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/jiangtu.jpg" width="215" height="50" /></div>
   <div class="AgePost">适合年龄：18岁以上玩家</div>
   <div class="adbannerPost"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/banner.jpg" alt="封测盛大开启" width="500" height="147" border="0" /></a></div>
  </div>
  <!--头部区end-->
  <!--内容框架区开始-->
  <div class="NrkuangBar">
   <div class="side_LtBar">
    <!--开始游戏区开始-->
    <div class="KsGroup"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/tus_02.jpg" width="215" height="110" border="0"></a></div>
    <!--开始游戏区end-->
    <!--登录区开始-->
    <div class="Login_bar">
     <div class="Login_bgqu">
      <div class="userin_dengluQu">
       <?php  $this->widget('frontwidgets.signin.SigninBlock',array('template'=>'dxz')); ?>
      </div>
     </div>
    </div>
    <!--登录区end-->
    <!--推荐服务器区开始-->
    <div class="TuijGroup">
     <div class="xbox_bts_lt">
      <h3 class="bt_01">推荐服务器</h3>
     </div>
     <div class="xbox_nei_1">
      <div class="tj_lis">
       <?php $this->widget('frontwidgets.gameserver.GameServerBlock', array('template' => 'dxz2', 'gameid' => $this->gameid)); ?>
      </div>
      <div class="tj_gd"><a href="http://g.marstv.com/dxz/server.html" target="_blank">更多服务器列表</a></div>
            <div class="tj_wh"><span class=""></span></div>
     </div>
     <div class="xbox_end"></div>
    </div>
    <!--推荐服务器区end-->
    <!--侧边游戏资料开始-->
    <div class="yxzlbGroup">
     <div class="xbox_bts_lt">
      <h3 class="bt_11">游戏资料</h3>
      <a href="http://g.marstv.com/dxz/gl.html" class="mores">更多</a> </div>
     <div class="xbox_nei_1">
            <h2 class="bts1"><span class="zlbtzi"><a href="#">初出茅庐</a></span></h2>
            <ul class="yxzlis">
              <li><a href="http://g.marstv.com/dxz/168.html">创建角色</a></li>
              <li><a href="http://g.marstv.com/dxz/170.html">界面操作</a></li>
			  <li><a href="http://g.marstv.com/dxz/173.html">聊天系统</a></li>
			  <li><a href="http://g.marstv.com/dxz/176.html">NPC功能</a></li>
            </ul>
            <h2 class="bts2"><span class="zlbtzi"><a href="#">江湖磨练</a></span></h2>
            <ul class="yxzlis">
              <li><a href="http://g.marstv.com/dxz/185.html">侠侣招募</a></li>
              <li><a href="http://g.marstv.com/dxz/187.html">侠侣名典</a></li>
              <li><a href="http://g.marstv.com/dxz/188.html">提升资质</a></li>
              <li><a href="http://g.marstv.com/dxz/189.html">培养段位</a></li>
            </ul>
            <h2 class="bts3"><span class="zlbtzi"><a href="#">闯荡武林</a></span></h2>
            <ul class="yxzlis">
              <li><a href="http://g.marstv.com/dxz/216.html">主线任务</a></li>
              <li><a href="http://g.marstv.com/dxz/217.html">日常任务</a></li>
              <li><a href="http://g.marstv.com/dxz/218.html">副本挑战</a></li>
              <li><a href="http://g.marstv.com/dxz/219.html">攀越天榜</a></li>
            </ul>
            <h2 class="bts4"><span class="zlbtzi"><a href="#">闲情逸致</a></span></h2>
            <ul class="yxzlis">
              <li><a href="http://g.marstv.com/dxz/224.html">宅院升级</a></li>
              <li><a href="http://g.marstv.com/dxz/225.html">击杀盗贼</a></li>
              <li><a href="http://g.marstv.com/dxz/226.html">金元宝树</a></li>
              <li><a href="http://g.marstv.com/dxz/227.html">太公钓鱼</a></li>
            </ul>
            <div class="clear"></div>
          </div>
     <div class="xbox_end"></div>
    </div>
    <!--侧边游戏资料end-->
    <!--玩家交流群开始-->
    <div class="PlayerGroup">
     <div class="xbox_bts_lt">
      <h3 class="bt_04">玩家交流群</h3>
     </div>
     <div class="xbox_nei_1">
      <p class="qqqun">QQ群152556366</p>
     </div>
     <div class="xbox_end"></div>
    </div>
    <!--玩家交流群end-->
    <!--客户服务区开始-->
    <div class="ServiceGroup">
          <div class="tops">
	         <p class="kftel">021-56710600-8003</p>
          </div>
          <div class="Sernrs">
	         <p> 客服论坛： <a href="http://bbs.marstv.com/forum-104-1.html" target="_blank">点击进入&gt;&gt;</a> </p>
             <p>客服QQ:<a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></p>
          </div>
    </div>
    <!--客户服务区end-->
   </div>
   <!--左部框架区结束-->
   <div class="side_RtBar">
    <!--路径区-->
    <div class="PathQu">
     <div class="shuo_tu"><span class="t_news">游戏资料</span></div>
     <!--<div class="shuo_lu">当前位置： <a href="http://g.marstv.com/dxz">首页</a> > <span class="cur">游戏资料</span></div>-->
    </div>
    <!--路径区End-->
    <!--新闻内容页面开始-->
    <div class="NeikuangBar">
     <div class="pages_newsnr">
      <!--新闻列表开始-->
       <ul class="NewslistZu">
	     <?php
			$this->widget('zii.widgets.CListView', array(
				'dataProvider' => $dataProvider,
				'itemView' => '_list',
				'itemsTagName' => 'ul',
				'ajaxUpdate'=>TRUE,
				'pager' => array('class'=>'CLinkPager',
				'cssFile'=>$layout_asset . '/css/dxz/list.css',
				'header'=>'')
	
			));
		 ?>  
      </ul>
      <!--新闻列表结束-->
      <!--翻页开始
      <div class="pagenumQu">
       <ul  class="yiiPager">
        <li class="first"><a href="#">第一页</a></li>
        <li class="previous hidden"><a href="#">上一页</a></li>
        <li class="page"><a href="#">1</a></li>
        <li class="page selected"><a href="#">2</a></li>
        <li class="page"><a href="#">3</a></li>
        <li class="page"><a href="#">4</a></li>
        <li class="page"><a href="#">5</a></li>
        <li class="page"><a href="#">6</a></li>
        <li class="page"><a href="#">7</a></li>
        <li class="page"><a href="#">8</a></li>
        <li class="page"><a href="#">9</a></li>
        <li class="next"><a href="#">下一页</a></li>
        <li class="last"><a href="#">最后一页</a></li>
       </ul>
       <div class="clear"></div>
      </div>
      <!--翻页结束-->
     </div>
    </div>
    <!--新闻内容页面结束-->
    <div class="xbox_end"></div>
   </div>
   <!--右部框架区结束-->
   <div class="clear"></div>
  </div>
  <!--内容框架区end-->
 </div>
</div>
<!--页面大区end-->
<!--尾部区开始-->
<div class="FootBar">
  <div class="footGroup">
    <p class="guanyu"><a title="关于我们" href="http://g.marstv.com/object/duty.html" target="_blank">关于我们</a>|<a  rel="external nofollow" title="服务条款" href="http://g.marstv.com/object/privacy.html" target="_blank">服务条款</a>|<a  rel="external nofollow" title="联系我们" href="http://g.marstv.com/object/contact.html" target="_blank">联系我们</a>|<a  rel="external nofollow" title="客服中心" href="http://g.marstv.com/customer.html" target="_blank">客服中心</a>|<a  rel="external nofollow" title="商务合作" href="http://g.marstv.com/object/business.html" target="_blank">商务合作</a>| <a title="大侠传" href="#" target="_self">大侠传</a></p>
    <p class="dizhi">抵制不良游戏，拒绝盗版游戏，注意自我保护，谨防受骗上当，适度游戏益脑，沉迷游戏伤身，合理安排时间，享受健康生活。</p>
    <p class="shidang"><span class="hontu">适合18岁及以上成年人游戏，建议游戏者适当游戏。</span></p>
    <p class=""><a href="http://www.marstv.com" title=""><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/mlogo.jpg" alt="" /></a></p>
    <p class="keyou"> 客服邮箱：<span class="kenum"><a href="mailto:gmkf@marstv.com">gmkf@marstv.com</a></span> 客服QQ：<span class="kenum"><a href="http://wpa.qq.com/msgrd?v=3&uin=192254648&site=qq&menu=yes" title="">192254648</a></span> </p>
    <p class="gsname">上海耀宇文化传媒有限公司版权所有(<a href="http://www.marstv.com" target="_blank">www.marstv.com</a>)<a href="#" target="_blank"> 沪ICP备12001511号-1</a></p>
  </div>
</div>
<!--尾部区end-->
</body>
</html>
