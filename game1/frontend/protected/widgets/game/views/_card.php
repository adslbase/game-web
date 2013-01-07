     <dd><a <?php
        if ($this->gameid == $data['object_id'] )
        {
                echo "class='nk_hv'";
        }
?> href="<?php echo $this->createUrl('card/index', array('gameid' => $data['object_id'])); ?>"><?php echo $data['object_name'] ?></a></dd>