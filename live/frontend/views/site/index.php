<div id="content" class="mt20">
    <div class="hot-screen clearfix">
        <div class="box open-video fl"  id="video" >
            <div class="box-hd">
                <h3>MarsTV直播</h3>                
            </div>
            <div class="box-bd"  id="play" >		
			
            </div>
			<div class="box-ft tc ">
                        <a href="<?php echo $this->createUrl('site/index',array('rate'=>'SD','service'=>'ku6')); ?>"  <?php if($rate=='SD'&&$service=='ku6') {echo 'class="reddish"';}?> >酷六标清</a>
			<a href="<?php echo $this->createUrl('site/index',array('rate'=>'SD','service'=>'qq')); ?>"  <?php if($rate=='SD'&&$service=='qq') {echo 'class="reddish"';}?>>QQLIVE标清</a> 
                        <a href="<?php echo $this->createUrl('site/index',array('rate'=>'HD','service'=>'qq')); ?>"  <?php if($rate=='HD'&&$service=='qq') {echo 'class="reddish"';}?>>QQLIVE高清</a>
                         <a href="<?php echo $this->createUrl('site/index',array('rate'=>'SD','service'=>'pps')); ?>"  <?php if($rate=='SD'&&$service=='pps') {echo 'class="reddish"';}?> >PPStream标清</a>
			<a href="<?php echo $this->createUrl('site/index',array('rate'=>'HD','service'=>'pps')); ?>"  <?php if($rate=='HD'&&$service=='pps') {echo 'class="reddish"';}?> >PPStream高清</a>
			
			</div>
        </div>
        <div class="fr">
          <!--  <div class="prog tabs" >
                <ul class="tabs-hd" id="usual-prog">
                    <li>
                        <h3><a href="#tab1">今日节目单</a></h3>
                    </li>
                    <li>
                        <h3><a href="#tab2">直播预告</a></h3>
                    </li>
                </ul>
                <div class="tabs-bd pb10">
                    <div class="tabs-panel" id="tab1">
                        <ul>
							<?php if($programList):?>
                            <?php foreach ($programList as $program): ?>

                                    <li>
                                        <span class="prog-type"><?php echo $program['type'] ?></span> <span class="prog-starttime"><?php echo $program['time'] ?></span><span class="prog-content"><?php echo $program['name'] ?></span>
                                    </li>

                                <?php endforeach; ?>
							<?php else:?>
									暂无节目单	
							<?php endif;?>
                        </ul>
                    </div>
                    <div class="tabs-panel" style="display:none;" id="tab2">
                        <ul>
						<?php if($liveList):?>
                            <?php foreach ($liveList as $program): ?>

                                    <li>
                                        <span class="prog-type"><?php echo $program['type'] ?></span> <span class="prog-starttime"><?php echo $program['time'] ?></span><span class="prog-content"><?php echo $program['name'] ?></span>
                                    </li>

                                <?php endforeach; ?>
							<?php else:?>
									暂无节目单	
							<?php endif;?>
								
                        </ul>
                    </div>
                </div>
            </div>
			<div class="prog-recommend mt10">
			<p>
                &nbsp; &nbsp; &nbsp; &nbsp;GSL联赛全称为“全球星际争霸2联赛”（Global StarCraft2 League 英文缩写 GSL）。
                GSL联赛每月都计划举行正规比赛和世界冠军赛；
                年末还会进行活动赛，另外会通过GomTV转播。 <br />
                &nbsp; &nbsp; &nbsp; &nbsp;在中国GSL联赛由MarsTV向全中国转播，让全中国玩家可以观看比赛。
				</p>
				<p style="color:red" class="mt5">小提醒：如果观看高清直播不能播放，请按播放按钮重新加载！</p>
				
				
            </div>
-->  <a target="_blank"  href="http://www.battlenet.com.cn/sc2/zh/blog/5360330"><img src="http://static.marstv.com/bbs/data/attachment/forum/201202/23/1607431baboxjn4x4jb90a.jpg" width="360" height="518"></a> 

        </div>
    </div>

    <div class="info-screen">
        <div class="info-screen-inner clearfix">
            <div class="fl">
                <div id="chatroom"></div>
                
                        <div class="box bbs-post mt10">
                            <div class="box-hd">
                                <h3>论坛互动</h3>
                            </div>
                            <div class="box-bd">

                                <iframe src="http://bbs.marstv.com/forum.php?mod=viewpost&tid=<?php echo $postId ?>" width="588" height="508" scrolling="no" frameborder="0"></iframe>
                                <div class="bbs-talk tc clearfix">
                                    <a href="http://bbs.marstv.com/forum.php?mod=viewthread&tid=<?php echo $postId ?>" target="_blank">去聊聊节目</a>
                                    <a href="#logo">顶部直播</a>
                                </div>

                            </div>
                        </div>
                   
            </div>
            <div class="fr">
                <div class="info-video box2">
                    <div class="hd clearfix">
                        <span class="fr" style="line-height:30px;margin-right:20px;"><a href="http://bbs.marstv.com/portal.php?mod=list&catid=1">更多视频</a></span> <h3>精彩视频</h3> 
                    </div>
                    <div class="bd">
                        <script type="text/javascript" src="http://bbs.marstv.com/api.php?mod=js&bid=7"></script>
                    </div>
                </div>
                <div class="info-news box2" style="border-top:none">
                    <div class="hd">
                        <h3>最新动态</h3>   
                    </div>
                    <div class="bd">
                        <script type="text/javascript" src="http://bbs.marstv.com/api.php?mod=js&bid=6"></script>

                        <script type="text/javascript" src="http://bbs.marstv.com/api.php?mod=js&bid=3"></script>

                        <script type="text/javascript" src="http://bbs.marstv.com/api.php?mod=js&bid=4"></script>

                        <script type="text/javascript" src="http://bbs.marstv.com/api.php?mod=js&bid=5"></script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script> 
 <script src="http://sjs.sinajs.cn/uc/chatroom/common/base_min.js"></script>
        <script src="<?php echo $this->chatroomUrl('chatroom.min.js','http://static.marstv.com/live') ?>" charset="UTF-8"></script>
        <script src="<?php echo YHtml::jsUrl('frontend/jquery.idTabs.min.js','http://static.marstv.com/live') ?>" charset="UTF-8"></script>
        <script>
            var wuc_chatroom = new WUCChatroom({id: 507603, name: 'MarsTV直播', siteApi : ''});
            $("#usual-prog").idTabs(); 
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-27445803-3']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
            })();
			
			$(document).ready(function(){
			
			$.get('<?php echo $this->createUrl('site/play')?>',{service:'<?php echo $service ?>',rate:'<?php echo $rate;?>',stream:'<?php echo $stream?>'},  
					function(data){
						$('#play').html(data);
				
					});
			})	;
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fbbe9b76bbc15a1b8832d50a58b25b485' type='text/javascript'%3E%3C/script%3E"));
        </script>
