<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

        $cs = Yii::app()->clientScript;

        $cs->registerCssFile($layout_asset . '/css/xxhzw/index.css');
?>


<div id="web_cont" class="wp">
	        <div id="sider">
                <div id="star_game"><a href="<?php echo $this->createUrl('xxhzw/server') ?>" title="进入游戏" class="text_td">进入游戏</a></div>
		<div id="user_login">
                        <div id="user_title"></div>
                        <div id="user_cont">
                             <?php $this->widget('frontwidgets.signin.SigninBlock',array('template'=>'xxhzw')); ?>
                        </div>
                </div>

                <div id="ka">
                        <ul>
                                <li><span></span><a href="http://g.marstv.com/card/index.html" title=""><img src="<?php echo $layout_asset . '/css/xxhzw/images/xsk.jpg' ?>" alt="领取新手卡" /></a></li>
                                <li><span></span><a href="<?php echo $this->createUrl('payway/game', array('gameid' => $this->gameid)); ?>" title="">
                                                <img src="<?php echo $layout_asset . '/css/xxhzw/images/yxcz.jpg' ?>" alt="游戏充值" />
                                        </a>
                                </li>
                        </ul>
                </div>
                <div id="game_server" class="scol">
                        <div id="gs_title" class="scol_title"><h2 class="text_td">游戏服务器</h2></div>
                        <div id="gs_cont" class="scol_cont">
                                <?php $this->widget('frontwidgets.gameserver.GameServerBlock', array('template' => 'xxhzw', 'gameid' => $this->gameid)); ?>

                        </div>
                        <div class="scol_bottom"></div>
                </div>
                <div id="game_info" class="game_info">
                        <div id="gi_title" class="scol_title"><h2 class="text_td">游戏介绍</h2></div>
                        <div id="gi_cont" class="scol_cont">
                                <dl>
                                        <dt><a href="#" title="" class="yellow">小小海贼王</a></dt>
                                        <dd>小小海贼王 游戏以<span class="yellow">《海贼王》</span>剧情为蓝本，故事发生在大海贼时代，人人都有一个航海之梦，都渴望获得海贼王的荣誉和数之不尽的海贼大宝藏。在金钱与利益的驱使下...</dd>
                                </dl>
                        </div>
                        <div class="scol_bottom"></div>
                </div>
                <div id="game_info2" class="game_info">
                        <div id="gu_title" class="scol_title"><h2 class="text_td">客服中心</h2></div>
                        <div id="gi_cont" class="scol_cont">
                                <dl>
                                        <dt><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a></dt>
                                        <dd><br/>QQ号：192254648<br />工作时间：周一至五，9点至18点</dd>
                                </dl>
                        </div>
                        <div class="scol_bottom"></div>
                </div>

        </div>
        <div id="cont">
                <div id="news">
                        <div id="news_pic">
                                <div id="focus">
                                        <ul>
                                                <li><a href="http://op.marstv.com"><img src="http://gr.marstv.com/common/resources/2012/09/j50PJWFb.jpg" alt="1" /></a></li>
                                                <li><a href="http://op.marstv.com"><img src="http://gr.marstv.com/common/resources/2012/09/xhB1bSyF.jpg" alt="2" /></a></li>
                                                <li><a href="http://op.marstv.com"><img src="http://gr.marstv.com/common/resources/2012/09/ngKp92Ke.jpg" alt="3" /></a></li>
                                                <li><a href="http://g.marstv.com/card/index.html" target="_blank"><img src="http://gr.marstv.com/common/resources/2012/09/cKrbLMkA.jpg" alt="4" /></a></li>
                                                <li><a href="http://g.marstv.com/card/index.html" target="_blank"><img src="http://gr.marstv.com/common/resources/2012/09/q5AZMuml.jpg" alt="5" /></a></li>
                                        </ul>
                                </div>
                        </div>
                        <div id="news_list">
                                <div id="nl_top"></div>
                                <div id="nl_title"><h2 class="text_td">新闻资讯</h2></div>
                                <div id="nl_cont">
                                        <ul>
                                                <?php foreach ($news as $new): ?>
                                                                <li><a href="<?php echo $this->createUrl('xxhzw/view', array('id' => $new['object_id'])); ?>" title="">
                                                                                <?php echo str_cut($new['object_name'], 53); ?></a>
                                                                </li>
                                                        <?php endforeach; ?>
                                        </ul>
                                </div>
                                <div id="nl_bottom"></div>
                        </div>
                </div>
                <!--                <div id="act">
                                        <ul>
                                                <li><a href="javascript:;" title=""><img src="images/ad_921.jpg" width="170" height="76" alt="" /></a></li>
                                                <li><a href="javascript:;" title=""><img src="images/ad_921.jpg" width="170" height="76" alt="" /></a></li>
                                                <li><a href="javascript:;" title=""><img src="images/ad_921.jpg" width="170" height="76" alt="" /></a></li>
                                                <li class="nr"><a href="javascript:;" title=""><img src="images/ad_921.jpg" width="170" height="76" alt="" /></a></li>
                                        </ul>
                                        <div class="cl"></div>
                                </div>-->
                <div id="game_data" class="ccol">
                        <div id="gd_title" class="ccol_title">
                                <div class="ccol_left"></div>
                                <div class="ccol_t_cont">
                                        <h2 class="text_td">游戏资料</h2>
                                </div>
                                <div class="ccol_right"></div>
                        </div>
                        <div id="gd_cont" class="ccol_cont">
			    <div id="gd_cont_l">
                                <dl>
                                        <dt>基本资料</dt>
                                        <dd><a href="http://g.marstv.com/sign/up.html" title="">帐号注册</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/91.html" title="">角色创建</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/92.html" title="">游戏特色</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/90.html" title="">游戏画面</a></dd>
                                </dl>
                                <dl>
                                        <dt>新手指南</dt>
                                        <dd><a href="http://g.marstv.com/xxhzw/79.html" title="">VIP简介</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/80.html" title="">战斗系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/81.html" title="">职业简介</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/33.html" title="">交互系统</a></dd>
                                </dl>
                                <dl>
                                        <dt>高手进阶</dt>
                                        <dd><a href="http://g.marstv.com/xxhzw/83.html" title="">酒馆系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/72.html" title="">装备系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/89.html" title="">争霸赛系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/66.html" title="">港口系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/88.html" title="">战船系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/82.html" title="">宝箱系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/86.html" title="">天赋系统</a></dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/87.html" title="">海贼团系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/73.html" title="">贝壳系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/84.html" title="">世界BOSS</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/85.html" title="">贸易船系统</a>|</dd>
                                        <dd><a href="http://g.marstv.com/xxhzw/68.html" title="">宝藏系统</a></dd>
                                </dl>
			   </div>
			   <div id="gd_cont_r"><a href="http://g.marstv.com/card/index.html"><img src="<?php echo $layout_asset . '/css/xxhzw/images/box.jpg' ?>"></a></div>
                                <div class="cl"></div>
                        </div>
                        <div class="cl"></div>
                </div>
                <div id="game_raiders" class="ccol">
                        <div id="gr_title" class="ccol_title"><h2 class="text_td">游戏攻略</h2></div>
                        <div id="gr_cont" class="ccol_cont">
                                <ul>
                                        <?php $i = 0 ?>
                                        <?php foreach ($gls as $new): ?>
                                                        <li><a href="<?php echo $this->createUrl('xxhzw/view', array('id' => $new['object_id'])); ?>" title="">
                                                                        <?php echo str_cut($new['object_name'], 48); ?></a><span><?php echo date('m-d', $new['object_date']) ?></span>
                                                        </li>
                                                        <?php $i++ ?>
                                                        <?php if ($i == 10): ?>
                                                        </ul>
                                                        <ul style="margin-left:50px;">
                                                        <?php endif; ?>

                                                <?php endforeach; ?>
                                </ul>
                                <div class="cl"></div>
                        </div>
                </div>
                <!--                <div id="game_pics" class="ccol">
                                        <div id="gp_title" class="ccol_title"><h2 class="text_td">游戏截图</h2></div>
                                        <div id="gp_cont" class="ccol_cont">
                                                <ul>
                                                        <li><a href="javascript:;" title=""><img src="images/pic_5.jpg" alt="" /></a></li>
                                                        <li><a href="javascript:;" title=""><img src="images/pic_5.jpg" alt="" /></a></li>
                                                        <li><a href="javascript:;" title=""><img src="images/pic_5.jpg" alt="" /></a></li>
                                                        <li><a href="javascript:;" title=""><img src="images/pic_5.jpg" alt="" /></a></li>
                                                        <li class="nr"><a href="javascript:;" title=""><img src="images/pic_5.jpg" alt="" /></a></li>
                                                </ul>
                                                <div class="cl"></div>
                                        </div>
                                 
                                </div>-->
                       <div id="gp_bottom"></div>
        </div>
</div>



















<script type="text/javascript"> 
        $(function() {
                var sWidth = $("#focus").width(); //获取焦点图的宽度（显示面积）
                var len = $("#focus ul li").length; //获取焦点图个数
                var index = 0;
                var picTimer;
	
                //以下代码添加数字按钮和按钮后的半透明条，还有上一页、下一页两个按钮
                var btn = "<div class='btnBg'></div><div class='btn'>";
                for(var i=0; i < len; i++) {
                        btn += "<span></span>";
                }
                btn += "</div><div class='preNext pre'></div><div class='preNext next'></div>";
                $("#focus").append(btn);
                $("#focus .btnBg").css("opacity",0.5);
 
                //为小按钮添加鼠标滑入事件，以显示相应的内容
                $("#focus .btn span").css("opacity",0.4).mouseenter(function() {
                        index = $("#focus .btn span").index(this);
                        showPics(index);
                }).eq(0).trigger("mouseenter");
 
                //上一页、下一页按钮透明度处理
                $("#focus .preNext").css("opacity",0.2).hover(function() {
                        $(this).stop(true,false).animate({"opacity":"0.5"},300);
                },function() {
                        $(this).stop(true,false).animate({"opacity":"0.2"},300);
                });
 
                //上一页按钮
                $("#focus .pre").click(function() {
                        index -= 1;
                        if(index == -1) {index = len - 1;}
                        showPics(index);
                });
 
                //下一页按钮
                $("#focus .next").click(function() {
                        index += 1;
                        if(index == len) {index = 0;}
                        showPics(index);
                });
 
                //本例为左右滚动，即所有li元素都是在同一排向左浮动，所以这里需要计算出外围ul元素的宽度
                $("#focus ul").css("width",sWidth * (len));
	
                //鼠标滑上焦点图时停止自动播放，滑出时开始自动播放
                $("#focus").hover(function() {
                        clearInterval(picTimer);
                },function() {
                        picTimer = setInterval(function() {
                                showPics(index);
                                index++;
                                if(index == len) {index = 0;}
                        },4000); //此4000代表自动播放的间隔，单位：毫秒
                }).trigger("mouseleave");
	
                //显示图片函数，根据接收的index值显示相应的内容
                function showPics(index) { //普通切换
                        var nowLeft = -index*sWidth; //根据index值计算ul元素的left值
                        $("#focus ul").stop(true,false).animate({"left":nowLeft},300); //通过animate()调整ul元素滚动到计算出的position
                        //$("#focus .btn span").removeClass("on").eq(index).addClass("on"); //为当前的按钮切换到选中的效果
                        $("#focus .btn span").stop(true,false).animate({"opacity":"0.4"},300).eq(index).stop(true,false).animate({"opacity":"1"},300); //为当前的按钮切换到选中的效果
                }
        });
 
</script>
