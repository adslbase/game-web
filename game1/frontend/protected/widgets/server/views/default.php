<?php foreach ($servers as $server) : ?>
        <tr class="tbline">
                <td height="26" align="center" valign="middle"><?php echo shortDate($server['server_date'])?></td>
                <td height="26" align="center" valign="middle"><?php echo $server['server_time']?></td>
                <td height="26" align="center" valign="middle">
                        <a href="<?php echo $this->createUrl($server['game_sn'].'/index')?>" title=""><?php echo $server['gamename']?></a>
                </td>
                <td height="26" align="center" valign="middle">
                        <a href="<?php echo $this->createUrl($server['game_sn'].'/game',array('server'=>$server['object_id']))?>" title="" style="color: black;">
                        <?php echo $server['object_name']?>
                        </a>
                </td>
        </tr>
<?php endforeach; ?>
