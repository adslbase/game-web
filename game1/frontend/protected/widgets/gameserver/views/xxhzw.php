<ul>
        <?php foreach ($servers as $server) : ?>
                        <li><a href="<?php echo $this->createUrl($game['game_sn'] . '/game', array('server' => $server['object_id'])); ?>" title="">
                                        <span><?php echo $server['object_name'] ?></span>

                                        <span class="yellow"><?php echo $this->getServerStatus($server['server_status']); ?></span>

                                </a></li>
                <?php endforeach; ?>
</ul>