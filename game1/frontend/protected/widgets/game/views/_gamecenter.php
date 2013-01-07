<div class="game_name "> 
        <a  class="g_title <?php if($this->gameid == $data['object_id']){ echo 'current';} ?>" href="<?php echo $this->createUrl('gamecenter/server',array('gameid'=>$data['object_id'])) ?>" target="_self">
                <span class="fL"><img alt="<?php echo $data['object_name'] ?>" src="<?php echo $data['ico_logo'] ?>"><?php echo $data['object_name'] ?></span>
                <em class="fR"><?php echo $data['termname'] ?></em>
        </a> 
</div>
