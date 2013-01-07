<div class="l_menu" id="gamemenu"><div class="l_menu_top">
                <div class="l_menu_inner game_server">
                        <h2>游戏服务器列表</h2>
                        <div id="game_serverlist">
                                <div class="game_name"> 
                                        <a class="g_all <?php if($this->gameid==''){echo 'current';}?>" href="<?php echo $this->createUrl('gamecenter/index')?>"><em>全部游戏</em>点击游戏查看服务器</a>
                                </div>
                                <?php
                                $this->widget('zii.widgets.CListView', array(
                                    'dataProvider' => $dataProvider,
                                    'itemView' => '_' . $template,
                                    'itemsTagName' => 'div',
                                    'template' => '{items} {pager}'
                                ));
                                ?>          
                        </div>
                        <div class="clear"></div>
                </div>
        </div></div>
