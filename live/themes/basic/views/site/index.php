<!--Play begin-->
<div id="video_play">
        <div id="player">

                <?php foreach ($channels as $k => $channel): ?>
                                <div id="live<?php echo $k ?>_tab" class="live_tab bgc">
                                        <a <?php if ($channel['ch_id'] == $cid) echo 'class="current"'; ?> href="<?php echo $this->createFrontUrl('site/index', array('cid' => $channel['ch_id'])) ?>" title="<?php echo $channel['description'] ?>"><?php echo $channel['name'] ?></a>
                                </div>
                        <?php endforeach; ?>

                <div id="player_cont" class="bgc"></div>
                <div id="play">


                        <?php echo $content ?>
                </div>
                <div id="live_list">
                        <?php foreach ($streamList as $stream): ?>
                                        <a <?php if ($stream['service'] == $service && $stream['type'] == $rate) echo 'class="current"'; ?> href="<?php echo $this->createFrontUrl('site/index', array('service' => $stream['service'], 'rate' => $stream['type'], 'cid' => $cid)) ?>" title="<?php echo $model->loadFormOptions('service', $stream['service']) . $model->loadFormOptions('type', $stream['type']) ?>">
                                                <?php echo $model->loadFormOptions('service', $stream['service']) . $model->loadFormOptions('type', $stream['type']) ?>
                                        </a>
                                <?php endforeach; ?>
                </div>
        </div>
</div>
<!--Play end-->
<!--Tool begin-->
<div id="tool">
        <div id="tool_button">
                <a  href="javascript:void(0);" hidefocus="true"  title="0">节目单</a>
                <a  href="javascript:void(0);" hidefocus="true" title="1">菠菜投注</a>
                <a  href="javascript:void(0);" hidefocus="true"  title="2">更换皮肤</a>
                <!--                  <a  href="javascript:void(0);" onClick="switchTab(3)" hidefocus="true" title="">论坛互动</a>-->
        </div>
        <!--        <div class="tool_cont" id="tabs-panel0" style="display:block;">
                        <div class="bgc tool_cont_bg"><a class="close" href="javascript:;" title="关闭"></a></div>
                        论坛互动 begin
                        <div class="tool_div">
                                
                                <iframe src="http://localhost/dx2/forum.php?mod=showthread&tid=3" width="588" height="508" scrolling="yes" frameborder="0"></iframe>
                              
                           
                        </div>
                </div>
                论坛互动 end-->

        <div class="tool_cont" id="tabs-panel0" style="display:block;">
                <div class="bgc tool_cont_bg"><a class="close" href="javascript:;" title="关闭"></a></div>
                <!--节目单 begin-->
                <div class="tool_div" id="program">
                </div>
        </div>
        <!--节目单 end-->
        <!--菠菜投注 begin-->
        <div class="tool_cont" id="tabs-panel1" style="display:none;">
                <div class="bgc tool_cont_bg"><a class="close" href="javascript:;" title="关闭"></a></div>
                <div class="tool_div tool_bocai" id="bets">
                </div>
        </div>
        <!--菠菜投注 end-->
        <!--切换皮肤 begin-->
        <div class="tool_cont templete " id="tabs-panel2" style="display:none;">
                <div class="bgc tool_cont_bg"><a class="close" href="javascript:;" title="关闭"></a></div>
                <div  id="template" class="templete_list">
                        <a  href="#" title="default">
                                <img src="assets/statics/css/live/skin/default/skin.png" width="100" height="60" alt="">
                                <span>默认</span>
                        </a>
                        <a  href="#"  title="mh">
                                <img src="assets/statics/css/live/skin/mh/skin.png" width="100" height="60" alt="">
                                <span>梦幻</span>
                        </a>
                        <a  href="#" title="xk2">
                                <img src="assets/statics/css/live/skin/xk2/skin.png" width="100" height="60" alt="">
                                <span>星空</span>
                        </a>
                        <a  href="#"  title="yly">
                                <img src="assets/statics/css/live/skin/yly/skin.png" width="100" height="60" alt="">
                                <span>游乐园</span>
                        </a>

                </div>
        </div>
        <!--切换皮肤 end-->
</div>
<!--Tool end-->

                <script>
                        $(document).ready(function(){
                                $.get('<?php echo $this->createFrontUrl('site/play', array(), 0) ?>',  
                                function(data){
                                        if(data!=0)
                                        {
                                                $('#play').html(data);
                                        }		
                                });
                        })
                </script>








