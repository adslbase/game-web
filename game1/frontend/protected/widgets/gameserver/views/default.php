
<?php foreach ($servers as $server) :?>

<div class="server_list"> 
        <a href="<?php echo $this->createUrl($game['game_sn'].'/game',array('server'=>$server['object_id'])); ?>" target="_blank" class="name"><?php echo $server['object_name']?>&nbsp;
                <?php if($server['level']==1):?>
                <img src="http://static.sdg-china.com/vgp/pic/web2/new.gif" width="28" height="14">
                <?php endif;?>               
        </a> 
        <span class="state_<?php echo $server['server_status']?>"><?php echo $this->getServerStatus($server['server_status']);?></span>
</div>

<?php endforeach;?>


