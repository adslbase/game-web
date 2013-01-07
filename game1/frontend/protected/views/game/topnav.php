<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>
<!doctype html>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />        
                <title><?php echo $this->pageTitle . '-' . settings()->get('general', 'site_name'); ?></title>
                <?php
                        $cs = Yii::app()->clientScript;
                        $cs->registerCssFile($layout_asset . '/css/topnav.css');
                        $cs->registerScriptFile($layout_asset . '/js/Tools.js');
                ?>
        </head>
        <body>
                <script type="text/javascript">
                        function add_fav() {
                                var url = window.location.toString();
                                var sitename = parent.window.document.title;
                                url = "<?php echo $this->createUrl($server['game_sn'] . '/game', array('server' => $server['object_id'])) ?>";
                                try {
                                        window.external.addFavorite("" + url + "", "" + sitename + "");

                                } catch (e) {
                                        try {
                                                if (window.sidebar) {
                                                        window.sidebar.addPanel("" + sitename + "", "" + url + "", "");
                                                } else {
                                                        alert("加入收藏失败，该浏览器不支持自动加入收藏功能，请使用Ctrl+D进行添加。");
                                                }
                                        }
                                        catch (e) {
                                                alert("加入收藏失败，该浏览器不支持自动加入收藏功能，请使用Ctrl+D进行添加。");
                                        }
                                }
                        }
                        
                        function Hidetop() {
                                parent.document.getElementById('mainfrm').rows = "0,*";	
                        }
                        function Fullsc() {
                                alert("请按F11全屏游戏！")
                        }
                </script>
                <div class="topbar_wrap">
                        <div class="right_top right_top2">
                                <span class="lz_pay" title="游戏充值"><a id="pay" href="<?php echo $this->createUrl('payway/game', array('gameid' => $server['gameid'], 'server' => $server['object_id'])) ?>" target="_blank">充值</a></span>
                                <span class="lz_fav" title="游戏收藏" onclick="add_fav()">收藏</span>
                                <span onclick="Fullsc();" title="请按F11全屏" class="lz_fullsc">全屏</span>
                                <span onclick="Hidetop();" title="隐藏导航条" class="lz_hid" id="hid_btn">隐藏</span>
                                <div class="clear"></div>
                        </div>

                        <p class="lz_right">
                                <a target="_blank" href="<?php echo $this->createUrl($server['game_sn'] . '/index') ?>">官网</a>
                        </p>

                        <div class="logo">
                                <a target="_blank" href="<?php echo FRONT_SITE_URL ?>">火星网页游戏平台</a>
                        </div>
                        <span class="mid_info">火星游戏，一点即玩<strong>【当前服务器：<em>火星游戏《<?php echo $server['gamename'] ?>》[<span id="servername"><?php echo $server['object_name'] ?></span>]</em>】</strong> </span>
                </div>
        </body>
</html>













