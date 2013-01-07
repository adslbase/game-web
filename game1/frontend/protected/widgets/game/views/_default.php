<?php if($data['object_status']==1): ?>

<div class="game_col <?php
if (($index + 1) % 2 == 0) {
echo 'g_col';
}
?>   ">
        <div class="gc_cont">
                <div class="game_pic">
                        <a href="<?php echo $this->createUrl($data['game_sn'] . '/index') ?>" title="">
                                <img src="<?php echo $data['big_logo']; ?>" alt="" />
                        </a>
                </div>
                <div class="game_inf">
                        <div class="gi_text">
                                <dl>
                                        <dt>
                                        <span>
                                                <?php
                                                $index = $index + 1;
                                                if ($index < 9) {
                                                $index = '0' . $index;
                                                }
                                                echo $index;
                                                ?>
                                        </span>
                                        <a href="<?php echo $this->createUrl($data['game_sn'] . '/index') ?>" title="">
                                                <?php echo $data['object_name'] ?>
                                        </a>
                                        </dt>
                                        <dd class="bl">推荐度：<span class="red">★★★★★</span></dd>
                                        <dd><strong>状态：<a href="<?php echo $data['service_url'] ?>"><?php echo $data['new_service'] ?></a></strong></dd>
                                        <dd>类型：<?php echo $data['termname'] ?></dd>
                                        <dd><?php echo str_cut($data['object_excerpt'], 80) ?></dd>
                                </dl>
                                <ul>
                                        <li><a href="<?php echo $data['site_url'] ?>" title="">官网</a></li>
                                        <li><a href="<?php echo $data['help_url'] ?>" title="">攻略</a></li>
<!--                                    <li><a href="<?php echo $data['card_url'] ?>" title="">新手卡</a></li>-->
                                        <li><a href="<?php echo $this->createUrl('payway/game', array('gameid' => $data['object_id'])); ?>" title="">充值</a></li>
                                </ul>
                        </div>
                        <div class="gi_button">
                                <a href="<?php echo $this->createUrl('sign/up') ?>" title="" class="gib01">注册帐号</a>
                                <a href="<?php echo $data['service_url'] ?>" title="" class="gib02">进入游戏</a>
                        </div>
                </div>
        </div>
</div>

<?php else:?>
<div class="game_col <?php if (($index + 1) % 2 == 0) {echo 'g_col';}?>">
        <div class="gc_cont">
                <div class="game_pic">
                                <img src="<?php echo $data['big_logo']; ?>" alt="" />
                </div>
                <div class="game_inf">
                        <div class="gi_text">
                                <dl>
                                        <dt>
                                        <span>
                                                <?php
                                                $index = $index + 1;
                                                if ($index < 9) {
                                                $index = '0' . $index;
                                                }
                                                echo $index;
                                                ?>
                                        </span>
                                        <span class="gtitle"><?php echo $data['object_name'] ?></span> 
                                        </dt>
                                        <dd class="bl">推荐度：<span class="red">★★★★★</span></dd>
                                        <dd><strong>状态：<?php echo $data['new_service'] ?></strong></dd>
                                        <dd>类型：<?php echo $data['termname'] ?></dd>
                                        <dd><?php echo str_cut($data['object_excerpt'], 80) ?></dd>
                                </dl>
                                <ul>
                                        <li>官网</li>
                                        <li>攻略</li>
<!--                                    <li>新手卡|</li>-->
                                        <li>充值</li>
                                </ul>
                        </div>
                        <div class="gi_button">
                                <a href="javascript:void(0);" title="" class="link_1">注册帐号</a>
                                <a href="javascript:void(0);" title="" class="link_2">进入游戏</a>
                        </div>
                </div>
        </div>
</div>

<?php endif; ?>
