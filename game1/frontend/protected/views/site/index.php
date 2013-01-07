<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);

$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/index.css');
?>


<div id="warp" class="wp">
        <div id="sider">
                <!--User Login begin-->
                <div id="userLogin">
                        <div id="ul_title"><h2>MarsTV网页游戏平台</h2></div>
                        <div id="ul_cont">
                                <?php $this->widget('frontwidgets.signin.SigninBlock'); ?>
                        </div>
                </div>
                <!--User Login end-->
                <!--New Game begin-->
                <div id="newGame">
                        <div id="ng_title"><div class="ngt_left"></div><h2>新开服务列表</h2><div class="ngt_right"></div></div>
                        <div id="ng_cont">
                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                        <tr style="color:#fff;">
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">日期</td>
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">时间</td>
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">游戏名称</td>
                                                <td height="26" align="center" valign="middle" bgcolor="#9e6c7b">服数</td>
                                        </tr>
                                        <?php $this->widget('frontwidgets.server.ServerBlock',array('status'=>1)); ?>
                                </table>
                        </div>
                </div>
                <!--New Game end-->
                <!--Server begin-->
                <div id="server">
                        <dl>
                                <dt>客服信息</dt>
                                <dd>邮箱：<a href="mailto:gmkf@marstv.com">gmkf@marstv.com</a></dt>
                                <dd>客服QQ：1592743789</dd>
                        </dl>
                </div>
                <!--Server end-->
                <!--User Pact begin-->
                <div id="userPact">
                        <div id="up_title"><h2>用户协议</h2></div>
                        <div id="up_cont">
                                <ul>
                                        <li><a href="<?php echo $this->createUrl('object/privacy') ?>" title="耀宇游戏平台用户服务协议">耀宇游戏平台用户服务协议</a></li>
                                        <li><a href="<?php echo $this->createUrl('object/view', array('id' => 15)) ?>" title="耀宇游戏平台用户守则">耀宇游戏平台用户守则</a></li>                    
                                </ul>
                        </div>
                </div>
                <!--User Pact end-->
                <!--Game Tips begin-->
                <div id="gameTips">
                        <div id="gt_title"><h2>健康游戏忠告</h2></div>
                        <div id="gt_cont">
                                <dl>
                                        <dd>抵制不良游戏</dd>
                                        <dd>拒绝盗版游戏</dd>
                                        <dd>注意自我保护</dd>
                                        <dd>谨防受骗上当</dd>
                                        <dd>适度游戏益脑</dd>
                                        <dd>沉迷游戏伤身</dd>
                                        <dd>合理安排时间</dd>
                                        <dd>享受健康生活</dd>
                                </dl>
                                <div class="cl"></div>
                                <ul>
                                        <li><a href="<?php echo $this->createUrl('object/view', array('id' => 13)); ?>" title="">防沉迷系统指南</a></li>
                                        <li><a href="<?php echo $this->createUrl('customer/4'); ?>" title="">防沉迷系统问题</a></li>
                                </ul>
                                <a href="<?php echo $this->createUrl('jiazhang/index'); ?>" title="" target="_blank">
                                        <img src="<?php echo $layout_asset . '/images/jiazhang.png' ?>" alt="家长监护工程" />
                                </a>
                        </div>
                </div>        
                <!--Game Tips end-->
        </div>
        <div id="cont">
                <!--News begin-->
                <div id="news">
                        <div id="news_banner">
                                <div id="focus">
                                        <ul>
                                                <li><a href="javascript:;" target="_blank"><img src="<?php echo $layout_asset . '/images/9jpK92CoyWM01GPsE1.JPG' ?>" alt="1" /></a></li>
                                                <li><a href="javascript:;" target="_blank"><img src="<?php echo $layout_asset . '/images/ipneU4VlsET2QdWUm2.JPG' ?>" alt="2" /></a></li>
                                                <li><a href="javascript:;" target="_blank"><img src="<?php echo $layout_asset . '/images/gVEK92eiehi3vVP7e3.JPG' ?>" alt="3" /></a></li>
                                                <li><a href="javascript:;" target="_blank"><img src="<?php echo $layout_asset . '/images/IRheU4FvtCa1lBsIx2.JPG' ?>" alt="4" /></a></li>
                                                <li><a href="javascript:;" target="_blank"><img src="<?php echo $layout_asset . '/images/9jpK92CoyWM01GPsE1.JPG' ?>" alt="5" /></a></li>
                                        </ul>
                                </div>
                        </div>
                        <!--新闻资讯 begin-->
                        <div id="news_list">
                                <div id="news_cont">
                                        <div id="nl_title"><h2><a href="javascript:;" title="">新闻资讯</a></h2></div>
                                        <div id="nl_cont">
                                                <ul>
                                                        <?php foreach ($news as $new): ?>
                                                                <li><a href="<?php echo $this->createUrl('object/view', array('id' => $new['object_id'])); ?>" title="">
                                                                                <?php echo str_cut($new['object_name'], 48); ?></a><span><?php echo date('m-d', $new['object_date']) ?></span>
                                                                </li>
                                                        <?php endforeach; ?>
                                                </ul>
                                        </div>
                                </div>
                        </div>
                        <!--新闻资讯 end-->
                </div>
                <!--News end-->
                <div id="gameList_cont">
                        <?php $this->widget('frontwidgets.game.GameBlock');?>
                </div>
        </div>
</div>
<div id="flink">
        <dl>
                <dt>友情链接：</dt>
                <dd><a href="http://www.marstv.com" title="" target="_blank">marstv视频</a>|</dd>
                <dd><a href="http://bbs.marstv.com" title="" target="_blank">marstv论坛</a>|</dd>
                <dd><a href="http://live.marstv.com" title="" target="_blank">直播页面</a>|</dd>

        </dl>
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