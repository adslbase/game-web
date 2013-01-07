                        <dl>
                                <dt>  
                                <a href="<?php echo $this->createUrl('payway/game', array('gameid' => $data['object_id'])) ?>" target="_self">
                                        <img src="<?php echo $data['small_logo'] ?>" width="135" height="94">
                                </a>
                                </dt>
                                <dd>  
                                        <a href="<?php echo $this->createUrl('payway/game', array('gameid' => $data['object_id'])) ?>" target="_self">
                                                <?php echo $data['object_name'] ?>
                                        </a>
                                </dd>
                        </dl>