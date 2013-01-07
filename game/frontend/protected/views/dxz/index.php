
<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/dxz/main.css');
		$cs->registerCssFile($layout_asset . '/css/index.css');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>大侠传_Marstv游戏中心_Marstv火星一服_火星游戏中心_火星联盟</title>

<meta name="description" content="火星联盟大侠传是正统武侠RPG网页游戏,玩家可以从大侠传官网了解大侠传游戏特色、大侠传加点、大侠传攻略、大侠传异兽、大侠传侠侣最新新闻，领取最新大侠传礼包等等信息。游戏打造动态写实画风新维度，让玩家既可体验刀光剑影狠江湖，又能感受侠隐的闲适恬淡。冲级领取虫群之心CDKEY" />

<meta name="keywords" content="大侠传,Marstv游戏中心,Marstv火星一服,火星游戏中心,火星联盟,虫群之心,CDKEY,礼包,新手卡" />
<script>
var indexEye = {
    autoTime: 0,
    init: function () {
        var eyeObj = $("#dyj_pics a:eq(0) img:eq(0)");
        eyeObj.attr("src", eyeObj.attr("data-imgSrc"));
        eyeObj.load(function () {
            indexEye.autoTime = setTimeout(function () {
                indexEye.autoPlay();
            }, 10000);
        });

        $("#dyj_numqu a").live("mouseover", function () {
            if ($(this).attr("class") == "on") return;
            indexEye.autoPlay(this);
        });
    },

    autoPlay: function (me) {
        clearTimeout(this.autoTime);
        this.turnNumber(me);
        var now = $("#dyj_numqu a.on").index();
        var imgObj = $("#dyj_pics a").eq(now).children("img");
        //if(imgObj.attr("src") == "") {
        imgObj.attr("src", imgObj.attr("data-imgSrc"));
        //}
        setTimeout(function () {
            $("#dyj_pics a:visible").fadeOut(0, function () {
                $("#dyj_pics a").eq(now).fadeIn(0);
            });
        }, 200);
        this.autoTime = setTimeout("indexEye.autoPlay()", 6000);
    },

    turnNumber: function (me) {
        if (typeof (me) == 'undefined') {
            var i = $("#dyj_numqu a.on").index();
            i = i >= $("#dyj_numqu a").length - 1 ? 0 : i + 1;
            me = $("#dyj_numqu a").eq(i);
        }
        $("#dyj_numqu a.on").each(function () {
            $(this).removeClass();
        });
        $(me).addClass('on');
    }
}

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
</head>
<body>
<script type="text/javascript" src="http://g.marstv.com/assets/2b300be6/jquery.js"></script>
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
<!--<div class="TopCiteBar"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/test_top.gif" width="960" height="41" /></div>-->
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
            <p class="nbts"><a href="http://g.marstv.com/dxz/gl.html" target="_blank" title="游戏资料" >游戏资料</a></p>
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
      <div class="LogoPost"><a title="大侠传" href="http://g.marstv.com/dxz">大侠传</a></div>
      <div class="XiarenPost"><a title="侠人轶事" href="#">侠人轶事</a></div>
      <!--   <div class="JiangPost"><img src="images/dxgw/jiangtu.jpg" width="215" height="50" /></div>-->
      <div class="AgePost">适合年龄：18岁以上玩家</div>
      <div class="adbannerPost"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/banner.jpg" alt="封测盛大开启" width="500" height="147" border="0" /></a></div>
      <!-- Baidu Button BEGIN -->
      <div class="baiduSharePost">
        <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"><!--<span class="bds_fx">分享到：</span> <a class="bds_tsina"></a> <a class="bds_tqq"></a> <a class="bds_renren"></a> <a class="bds_qzone"></a> <a class="bds_tqf"></a> <a class="bds_kaixin001"></a> <a class="bds_douban"></a>--> </div>
        <script type="text/javascript" id="bdshare_js" data="type=tools&amp;mini=1" ></script>
        <script type="text/javascript" id="bdshell_js"></script>
        <script type="text/javascript">
			var bds_config = {'wbUid':2152406592,'snsKey':{'tsina':'4248928840','tqq':'801187140'}};
			document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + new Date().getHours();
		</script>
      </div>
      <!-- Baidu Button END -->
    </div>
    <!--头部区end-->
    <!--内容框架区开始-->
    <div class="NrkuangBar">
      <div class="side_LtBar">
        <!--开始游戏区开始-->
        <div class="KsGroup">
          <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,19,0" width="215" height="110">
            <param name="movie" value="http://g.marstv.com/assets/751ad8b7/css/dxz/images/flash/gamestart.swf">
            <param name="quality" value="high">
            <embed src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/flash/gamestart.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="215" height="110"></embed>
          </object>
        </div>
        <!--开始游戏区end-->
        <!--登录区开始-->
        <div class="Login_bar">
          <div class="Login_bgqu">
		<?php  $this->widget('frontwidgets.signin.SigninBlock',array('template'=>'dxz')); ?>
		</div>
		</div>
        <div class="guguqu">
          <p><a href="http://g.marstv.com/card/index.html" target="_blank"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/newcardtu.jpg" alt="新手卡领取" width="215" height="70"   border="0"   /></a></p>
        </div>
        <!--推荐服务器区开始-->
        <div class="TuijGroup">
          <div class="xbox_bts_lt">
            <h3 class="bt_01">推荐服务器</h3>
          </div>
          <div class="xbox_nei_1">
            <div class="tj_lis">
              <ul>
			    <?php //$this->widget('frontwidgets.gameserver.GameServerBlock', array('template' => 'dxz2', 'gameid' => $this->gameid)); ?>
            </ul>
            </div>
            <div class="tj_gd"><a href="http://g.marstv.com/dxz/server.html" target="_blank">更多服务器列表</a></div>
            <div class="tj_wh"><span class=""></span></div>
          </div>
          <div class="xbox_end"></div>
        </div>
        <!--推荐服务器区end-->
        <!--游戏特色区 开始-->
        <div class="TeseBox">
          <div class="xbox_bts_lt">
            <h3 class="bt_02">游戏特色</h3>
          </div>
          <div class="xbox_nei_1">
            <div class="Tesenr">
              <p class="tes_1"><a href="http://g.marstv.com/dxz/260.html" target="_blank">动态写实</a><span class="js">&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://g.marstv.com/dxz/260.html" target="_blank">移步换景</a></p>
              <p class="tes_2"><a href="http://g.marstv.com/dxz/260.html" target="_blank">千阵万兽</a><span class="js">&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://g.marstv.com/dxz/260.html" target="_blank">侠侣助战</a></p>
              <p class="tes_3"><a href="http://g.marstv.com/dxz/260.html" target="_blank">神兵自造</a><span class="js">&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://g.marstv.com/dxz/260.html" target="_blank">装备保值</a></p>
              <p class="tes_4"><a href="http://g.marstv.com/dxz/260.html" target="_blank">宅院经营</a><span class="js">&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://g.marstv.com/dxz/260.html" target="_blank">美女如云</a></p>
              <p class="tes_5"><a href="http://g.marstv.com/dxz/260.html" target="_blank">攀越天榜</a><span class="js">&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://g.marstv.com/dxz/260.html" target="_blank">成就侠义</a></p>
            </div>
          </div>
          <div class="xbox_end"></div>
        </div>
        <!--游戏特色区 结束-->
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
        <!--友情链接开始
        <div class="YoulianGroup">
          <div class="xbox_bts_lt">
            <ul class="lian_btQu">
              <li><a href="#" class="ls_yq_off">友情链接</a></li>
              <li><a href="#" class="ls_mt_on">媒体链接</a></li>
            </ul>
          </div>
          <div class="xbox_nei_1">
            <ul class="lian_nrQu">
              <li><a href="#">17173游戏专区</a></li>
              <li><a href="#">多玩游戏区</a></li>
              <li><a href="#">17173游戏专区</a></li>
              <li><a href="#">多玩游戏区</a></li>
              <li><a href="#">17173游戏专区</a></li>
            </ul>
            <div class="clear"></div>
          </div>
          <div class="xbox_end"></div>
        </div>
        <!--友情链接end-->
      </div>
      <!--左部框架区结束-->
      <div class="side_RtBar">
        <!--首页右部内容1组start-->
        <div class="hmnrGroup_1">
          <div class="htside_rt1">
            <!--大眼睛广告区-->
            <div class="dyjGroup">
				<div class="dyj_pics" id="dyj_pics">
					<a href="http://g.marstv.com/dxz/252.html" title="我可以更强  龙渊神兵玩法 重装上线"target="_blank" style="display: block">
					    <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb1.jpg" data-imgsrc="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb1.jpg"width="378" height="226" border="0" alt="我可以更强  龙渊神兵玩法 重装上线" />
					</a>
					<a href="http://g.marstv.com/dxz/253.html" title="享受尊贵  VIP系统详解" target="_blank" style="display: none">
					    <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb2.jpg"data-imgsrc="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb2.jpg" width="378"height="226" border="0" alt="享受尊贵  VIP系统详解" />
					</a>
					<a href="http://g.marstv.com/dxz/256.html"title="1月9日16：00 MarsTV主持人和你一起当大侠" target="_blank" style="display: none">
					    <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb3.jpg"data-imgsrc="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb3.jpg" width="378"height="226" border="0" alt="1月9日16：00 MarsTV主持人和你一起当大侠" />
					</a>
					<a href="http://g.marstv.com/dxz/254.html"title="首次充值 送988元超值大礼包" target="_blank" style="display: none">
					    <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb4.jpg"data-imgsrc="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/dxzb4.jpg" width="378"height="226" border="0" alt="首次充值 送988元超值大礼包" />
					</a>
				</div>
				<div class="dyj_numqu" id="dyj_numqu">
					<a href="javascript:;" class="on" alt="我可以更强  龙渊神兵玩法 重装上线" title="我可以更强  龙渊神兵玩法 重装上线">1</a>
					<a href="javascript:;" alt="享受尊贵  VIP系统详解" title="享受尊贵  VIP系统详解">2</a>
					<a href="javascript:;" alt="1月9日16：00 MarsTV主持人和你一起当大侠" title="1月9日16：00 MarsTV主持人和你一起当大侠">3</a>
					<a href="javascript:;" alt="首次充值 送988元超值大礼包" title="首次充值 送988元超值大礼包">4</a>
				</div>
			</div>
<script type="text/javascript">
$(function () {
indexEye.init();
})
</script>
            <!--大眼睛广告区结束-->
          </div>
          <!--顶部右1END-->
          <div class="htside_rt2">
            <div class="hmNewsBar">
              <div class="nxMenuGroup">
                <ul class="nxMenuZu">
                  <li class="current"><a title="新闻" href="#" class="mu_xw">新闻</a> </li>
                </ul>
              </div>
              <div class="nxNrshowGroup">
                <div class="nxListGroup">
				  <?php foreach ($news as $new): ?>
                  <p><span class="date"><?php echo date('m-d', $new['object_date']) ?></span><span class="leis"><a href="http://dxz.marstv.com/xw.html">[新闻]</a></span><a href="<?php echo $this->createUrl('dxz/view', array('id' => $new['object_id'])); ?>" title=""  class="zw" ><?php echo str_cut($new['object_name'], 60); ?></a></p>
				  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>
          <!--顶部右2END-->
          <div class="clear"></div>
        </div>
        <!--首页右部内容1组END-->
        <!--四组广告START-->
        <div class="hotushow">
		    <a title="新服活动" target="_blank" href="http://g.marstv.com/dxz/254.html">
			   <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/hd1.gif" alt="公测礼包" width="177" height="88"   border="0" />
			</a>
			<a title="VIP特权" target="_blank" href="http://g.marstv.com/dxz/253.html">
			   <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/hd2.gif" alt="公测礼包" width="177" height="88"   border="0" />
			</a>
			<a title="互动论坛" target="_blank" href="http://bbs.marstv.com/forum-104-1.html">
			   <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/hd3.gif" alt="公测礼包" width="177" height="88"   border="0" />
			</a>
			<a title="新手礼包" target="_blank" href="http://g.marstv.com/card/index.html">
			   <img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/hd4.gif" alt="公测礼包" width="177" height="88"   border="0" />
			</a>
	    </div>
        <!--四组广告END-->
        <!--首页右侧两框 开始-->
        <div class="hmRtnrBar">
          <div class="hmRtnrside_a">
            <!--游戏资料区Start-->
            <div class="ZiliaoGroup">
              <div class="xbox_bts_lt">
                <h3 class="bt_05">游戏资料</h3>
                <a href="http://g.marstv.com/dxz/xw.html" class="mores">更多</a> </div>
              <div class="ziliao_qu_1">
                <table  border="0" cellspacing="0" cellpadding="0" class="ziliao_nrbiao">
                  <tr>
                    <td rowspan="2"  class="lie1"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/tesetu_1.jpg" width="81" height="69" border="0" /></a></td>
                    <td  class="lie2"><a href="#">操作指南</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/168.html">创建角色</a>| 
					     <a href="http://g.marstv.com/dxz/170.html">界面操作</a>| 
						 <a href="http://g.marstv.com/dxz/173.html">聊天系统</a>| 
						 <a href="http://g.marstv.com/dxz/176.html">NPC功能</a>| 
						 <a href="http://g.marstv.com/dxz/177.html">备战设置</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">新手必读</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/181.html">新手FAQ</a>| 
						 <a href="http://g.marstv.com/dxz/182.html">装备展示</a>| 
						 <a href="http://g.marstv.com/dxz/183.html">好友祝贺</a>| 
						 <a href="http://g.marstv.com/dxz/184.html">VIP系统</a></td>
                  </tr>
                </table>
              </div>
              <div class="ziliao_qu_2">
                <table  border="0" cellspacing="0" cellpadding="0" class="ziliao_nrbiao">
                  <tr>
                    <td rowspan="6"  class="lie1"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/tesetu_2.jpg" width="81" height="69" border="0" /></a></td>
                    <td  class="lie2"><a href="#">侠侣为伴</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/185.html">侠侣招募</a>| 
						 <a href="http://g.marstv.com/dxz/187.html">侠侣名典</a>| 
						 <a href="http://g.marstv.com/dxz/188.html">提升资质</a>| 
						 <a href="http://g.marstv.com/dxz/189.html">培养段位</a>| 
						 <a href="http://g.marstv.com/dxz/190.html">侠侣传功</a> </td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">异兽助阵</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/191.html">异兽召唤</a>| 
					     <a href="http://g.marstv.com/dxz/192.html">异兽名典</a>| 
						 <a href="http://g.marstv.com/dxz/193.html">异兽天赋</a>| 
						 <a href="http://g.marstv.com/dxz/194.html">异兽培养</a>| 
						 <a href="http://g.marstv.com/dxz/195.html">异兽阵法</a> </td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">武学参悟</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/196.html">武功招式</a>| 
						 <a href="http://g.marstv.com/dxz/197.html">角色招式</a>| 
						 <a href="http://g.marstv.com/dxz/198.html">角色内功</a>| 
						 <a href="http://g.marstv.com/dxz/199.html">侠侣技能</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">修身炼体</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/200.html">提升境界</a>| 
						 <a href="http://g.marstv.com/dxz/201.html">属性加点</a>| 
						 <a href="http://g.marstv.com/dxz/202.html">武魂强化</a>| 
						 <a href="http://g.marstv.com/dxz/203.html">武魂符阵</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">装备锻造</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/204.html">装备介绍</a>| 
						 <a href="http://g.marstv.com/dxz/205.html">装备洗炼</a>| 
						 <a href="http://g.marstv.com/dxz/206.html">装备精炼</a>| 
						 <a href="http://g.marstv.com/dxz/207.html">装备重铸</a>| 
						 <a href="http://g.marstv.com/dxz/208.html">分解淬炼</a>| 
						 <a href="http://g.marstv.com/dxz/209.html">宝石镶嵌</a>| 
						 <a href="http://g.marstv.com/dxz/210.html">套装系统</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">开帮立会</a></td>
                    <td  class="lie3">
					     <a href="http://g.marstv.com/dxz/211.html">帮会系统</a>| 
						 <a href="http://g.marstv.com/dxz/212.html">帮会功能</a>| 
						 <a href="http://g.marstv.com/dxz/213.html">帮会任务</a>| 
						 <a href="http://g.marstv.com/dxz/214.html">帮会BOSS</a>| 
						 <a href="http://g.marstv.com/dxz/215.html">攻城战</a> </td>
                  </tr>
                </table>
              </div>
              <div class="ziliao_qu_1">
                <table  border="0" cellspacing="0" cellpadding="0" class="ziliao_nrbiao">
                  <tr>
                    <td rowspan="3"  class="lie1"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/tesetu_3.jpg" width="81" height="69" border="0" /></a></td>
                    <td  class="lie2"><a href="#">任务剧情</a></td>
                    <td  class="lie3">
					    <a href="http://g.marstv.com/dxz/216.html">主线任务</a>| 
						<a href="http://g.marstv.com/dxz/217.html">日常任务</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">历练挑战</a></td>
                    <td  class="lie3">
					    <a href="http://g.marstv.com/dxz/218.html">副本挑战</a>| 
						<a href="http://g.marstv.com/dxz/219.html">攀越天榜</a>| 
						<a href="http://g.marstv.com/dxz/220.html">斩兽炼魂</a>| 
						<a href="http://g.marstv.com/dxz/221.html">运镖劫镖</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">收集侠名</a></td>
                    <td  class="lie3">
					    <a href="http://g.marstv.com/dxz/222.html">侠名获取</a>| 
						<a href="http://g.marstv.com/dxz/223.html">侠名分类</a></td>
                  </tr>
                </table>
              </div>
              <div class="ziliao_qu_2">
                <table  border="0" cellspacing="0" cellpadding="0" class="ziliao_nrbiao">
                  <tr>
                    <td rowspan="2"  class="lie1"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/tesetu_4.jpg" width="81" height="65" border="0" /></a></td>
                    <td  class="lie2"><a href="#">宅院系统</a></td>
                    <td  class="lie3">
					    <a href="http://g.marstv.com/dxz/224.html">宅院升级</a>| 
						<a href="http://g.marstv.com/dxz/225.html">击杀盗贼</a>| 
						<a href="http://g.marstv.com/dxz/226.html">金元宝树</a>| 
						<a href="http://g.marstv.com/dxz/227.html">太公钓鱼</a></td>
                  </tr>
                  <tr>
                    <td  class="lie2"><a href="#">女仆养成</a></td>
                    <td  class="lie3">
					    <a href="http://g.marstv.com/dxz/228.html">女仆分类</a>| 
						<a href="http://g.marstv.com/dxz/229.html">献花得礼</a>| 
						<a href="http://g.marstv.com/dxz/230.html">按摩捶背</a>| 
						<a href="http://g.marstv.com/dxz/231.html">精通演艺</a>| 
						<a href="http://g.marstv.com/dxz/232.html">劫仆功能</a></td>
                  </tr>
                </table>
              </div>
              <div class="xbox_end"></div>
            </div>
            <!--游戏资料区End-->
            <!--游戏攻略开始-->
            <div class="gameglGroup">
              <div class="xbox_bts_lt">
                <h3 class="bt_06">游戏攻略</h3>
                <a href="http://g.marstv.com/dxz/gl.html" class="mores">更多</a> </div>
              <div class="gameglsmGroup">
                
                <div class="gamegl_nrzu">
                  <div class="gamegl_nrzi">
                    <ul class="lnuNrzu">
					  <?php $i = 0 ?>
                        <?php foreach ($gls as $new): ?>
						     <li><span class="leis">[<a href="" title="攻略" >攻略</a>]</span><a href="<?php echo $this->createUrl('dxz/view', array('id' => $new['object_id'])); ?>" title="微博和官方QQ群也会不定期举行发" ><?php echo str_cut($new['object_name'],70); ?></a></li>
                		<?php $i++ ?>
                                         <?php if ($i == 10): ?>
										   </ul>
										   <ul style="margin-left:50px;">
										 <?php endif; ?>
 
                      <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                  </div>
                </div>
              </div>
              <div class="xbox_end"></div>
            </div>
            <!--游戏攻略结束-->
            <!--游戏图库开始
            <div class="tukuGroup">
              <div class="xbox_bts_lt">
                <h3 class="bt_07">游戏图库</h3>
                <a href="#" class="mores">更多</a> </div>
              <div class="jietuulbox">
                <ul>
                  <li>
                    <p class="jietu_tu"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/tus_43.jpg" alt="武当山" width="148" height="96" border="0" /></a></p>
                  </li>
                  <li>
                    <p class="jietu_tu"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/tus_43.jpg" alt="武当山" width="148" height="96" border="0" /></a></p>
                  </li>
                  <li>
                    <p class="jietu_tu"><a href="#"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pic/tus_43.jpg" alt="武当山" width="148" height="96" border="0" /></a></p>
                  </li>
                </ul>
                <div class="clear"></div>
                <div class="zhishi_leftqu"> <span><a href="#">上一个</a></span></div>
                <div class="zhishi_rightqu"><span><a href="#">下一个</a></span></div>
              </div>
            </div>
            <!--游戏图库结束-->
            
          </div>
          <!--首页中间组结束-->
          <div class="hmRtnrside_b">
          	<div class="guguqu">
              <p><embed src="http://player.youku.com/player.php/sid/XNDk3NjcwMTg0/v.swf" quality="high" width="190"  align="middle" allowScriptAccess="sameDomain" allowFullscreen="true" type="application/x-shockwave-flash"></embed></p> 
            </div>
		  <div class="guguqu">
              <p><a href="http://bbs.marstv.com/thread-156434-1-1.html" target="_blank" title="《虫群之心》国服测试CDKEY 玩大侠传免费"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/cq_ad.gif" alt="《虫群之心》国服测试CDKEY 玩大侠传免费" width="190" height="304"   border="0"   /></a></p>
            </div>
			<div class="guguqu">
              <p><a href="http://g.marstv.com/customer/4.html" target="_blank"><img src="http://g.marstv.com/assets/751ad8b7/css/dxz/images/dxgw/pictus_jk.jpg" alt="家长监控系统" width="190" height="75"   border="0"   /></a></p>
            </div>
            <!--健康游戏公告区开始-->
            <div class="HealthGroup"></div>
            <!--健康游戏公告区end-->
          </div>
          <!--首页最右间组结束-->
          <div class="clear"></div>
        </div>
        <!--首页右侧两框结束-->
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
