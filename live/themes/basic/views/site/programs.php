<?php $now = array(); ?>
<?php foreach ($channels as $k => $channel): ?>

    <?php if($channel['ch_id'] != 4):?>
                <div id="live_button">
                        <a href="javascript:void(0);"   class="current"><?php echo $channel['name']; ?></a>
                </div>

                <div class="live_list_cont" id="program-panel<?php echo $k ?>"  >
                        <?php $channel['has'] = 0; ?>
                        <?php foreach ($programList as $program): ?>
                                <?php if ($channel['ch_id'] == $program['ch_id']): ?>
                                        <?php
                                        if (strtotime($program['start_time']) < time() && time() < strtotime($program['end_time']))
                                        {
                                                $now[$channel['ch_id']] = array('name' => $channel['name'], 'program' => $program['name']);
                                        }
                                        ?>

                                        <?php $channel['has'] = 1; ?>
                                        <dl>
                                                <dt><?php echo substr($program['start_time'], 0, 5) ?>-<?php echo substr($program['end_time'], 0, 5) ?></dt>
                                                <dd><?php echo $program['name'] ?></dd>
                                        </dl>   
                                <?php endif; ?>
                        <?php endforeach; ?>

                        <?php if ($channel['has'] == 0): ?>
                                <div style="text-align: center;">暂无节目单</div>

                        <?php endif; ?>
                </div>

   <?php endif; ?>
        <?php endforeach; ?>
<!--<div id="live_now">
        <h1>正在播放：</h1>
        <dl>
                <?php if (!empty($now)): ?>
                                <?php foreach ($now as $k => $v): ?>
                                        <dt><a href="http://live.marstv.com/live<?php echo $k; ?>.html"><?php echo $v['name'] ?></a></dt><dd>:&nbsp;<?php echo $v['program']; ?></dd>
                                <?php endforeach; ?>
                        <?php else: ?>
                                没有节目
                <?php endif; ?>
        </dl>
</div>-->