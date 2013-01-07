                        
<?php foreach ($payways as $payway): ?>
                <?php
                $params = array('gameid' => $gameid, 'payway' => $payway['pay_id']);

                if ($server !== '')
                {
                        $params['server'] = $server;
                }
                $class = '';
                if ($paywayId == $payway['pay_id'])
                {
                        $class = " class=\"current\"";
                }
                ?>
                <li <?php echo $class; ?>>
                        <a href="<?php echo $this->createUrl('payway/game', $params); ?>" class="way_<?php echo $payway['pay_id'] ?>">
                                <span><?php echo $payway['name'] ?></span></a>
                </li>
        <?php endforeach; ?>