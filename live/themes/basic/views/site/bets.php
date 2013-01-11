<?php foreach ($bets as $bet): ?>
                <dl>
                        <dt><h2><a href="http://gaming.marstv.com/index.php?r=join/index&gid=<?php echo $bet['id'] ?>" title="" target="_blank">
                                        <?php
                                        if (strlen($bet['title']) > 22)
                                        {
                                                echo substr($bet['title'], 0, 22) . '...';
                                        }
                                        else
                                        {
                                                echo $bet['title'];
                                        }
                                        ?>


                                </a></h2><a href="http://gaming.marstv.com/index.php?r=join/index&gid=<?php echo $bet['id'] ?>" title="" target="_blank" class="bc_join">
                                <?php if ($bet['userCount'] == 1): ?>
                                        我要下注
                                <?php else: ?>
                                        查看详情                                                        
                                <?php endif; ?>
                        </a></dt>
                        <dd>
                                <span class="bocai_time">参与：<?php echo $bet['userCount'] ?>人</span>
                                <span class="bocai_nu">总投注：<?php echo $bet['amount'] ?>矿</span>
                                <div class="cl"></div>
                        </dd>
                </dl>
        <?php endforeach; ?>