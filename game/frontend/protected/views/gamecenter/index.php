<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/gamecenter.css');
?>
<div id="warp" class="wp">
	<div id="sider">
    	<!--User Login begin-->
           <!--User Login begin-->
                <div id="userLogin">
                        <div id="ul_title"><h2>MarsTV网页游戏平台</h2></div>
                        <div id="ul_cont">
                                <?php $this->widget('frontwidgets.signin.SigninBlock'); ?>
                        </div>
                </div>
                     <?php //$this->widget('frontwidgets.game.GameBlock',array('template'=>'gamecenter','status'=>1));?>
        </div>
    <div id="cont">
    	<div id="reg_warp">
    	<div id="reg_cont">
        	<div id="reg_title"><h2>游戏中心&gt;平台热推</h2></div>
        </div>
    </div>
    	<div id="gameList_cont">
                     <?php $this->widget('frontwidgets.game.GameBlock',array('level'=>3));?>
        </div>
        <div class="cl"></div>
        <div id="gamecont_list">
                 <?php //$this->widget('frontwidgets.game.GameBlock',array('template'=>'list','status'=>1));?>
			  <!--OP-->
			  <div class="gcl_col">
					<div class="gcl_pic">
						<a title="" href="/gamecenter/server.html?gameid=1"><img width="207" height="92" alt="" src="http://gr.marstv.com/common/resources/2012/08/rp6uYwhe.jpg"><span>小小海贼王</span></a>
					</div>
					<div class="gcl_info">
						<dl>
							<dt>类型：</dt>
							<dd>角色扮演</dd>
							<dt>状态：</dt>
							<dd><a title="" href="http://g.marstv.com/xxhzw/game.html?server=2">火热游戏中</a></dd>
						</dl>
						<ul>
							<li><a title="" href="/sign/up.html">注册</a>|</li>
							<li><a title="" href="http://op.marstv.com/">官网</a>|</li>
							<li><a title="" href="/payway/game.html?gameid=1">充值</a></li>
							<li><a class="gcl_in" title="" href="http://g.marstv.com/xxhzw/game.html?server=2">进入游戏</a></li>
						</ul>
					</div>
				</div>
				<!--OP-->
				<!--乐游三国-->
				<div class="gcl_col">
            	  <div class="gcl_pic">
                	<a title="" href="/gamecenter/server.html?gameid=142"><img width="207" height="92" alt="" src="http://gr.marstv.com/common/resources/2012/12/IEm9fB0D.jpg"><span>乐游三国</span></a>
                  </div>
                    <div class="gcl_info">
                	  <dl>
                    	<dt>类型：</dt>
                        <dd>角色扮演</dd>
                        <dt>状态：</dt>
                        <dd><a title="" href="http://g.marstv.com/lysg/game.html?server=143">开放</a></dd>
                      </dl>
                       <ul>
                    	<li><a title="" href="/sign/up.html">注册</a>|</li>
                        <li><a title="" href="http://lysg.marstv.com/">官网</a>|</li>
                        <li><a title="" href="/payway/game.html?gameid=142">充值</a></li>
                        <li><a class="gcl_in" title="" href="http://g.marstv.com/lysg/game.html?server=143">进入游戏</a></li>
                       </ul>
                    </div>
                 </div>
				<!--乐游三国-->
            <div class="cl"></div>
        </div>
        <div class="cl"></div>
    </div>
</div>

