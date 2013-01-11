<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>GSL2012官方直播,OGN中国区官方直播,IPL5中国区官方直播--Marstv全球顶尖赛事转播商</title>
				<meta name="keywords" content="GSL,GSL官方,GSL2012,GSL星际2,GSL星际争霸2,GSL星际争霸2直播,OGN,OGN2012,OGN英雄联盟,OGN直播,OGN英雄联盟直播,IPL5官方,IPL5直播,IPL5星际2,IPL5星际争霸2,IPL5星际争霸2直播,IPL5LOL,IPL5英雄联盟,IPL5英雄联盟直播" />
<meta name="description" content="MARSTV直播为你带来全球顶尖赛事,GSL中国区官方直播,OGN中国区官方直播,IPL5中国区官方直播"/>
                <meta name="description" content=“为你带来不一样的精彩” />
                <link rel="stylesheet" href="<?php echo YHtml::cssUrl('live/main.css') ?>" />
                <link rel="stylesheet" href="<?php echo YHtml::cssUrl('live/default.css') ?>" id="skin" />
                <script src="http://static.marstv.com/js/jquery-1.7.js"></script>
        </head>
        <body>
                <div class="wrap">
                        <div id="top">
                                <h1 id="logo"><a href="http://live.marstv.com" title="" target="_blank">MarsTV节目直播</a></h1>
                                <ul id="top_nav">
                                        <li><a href="http://www.marstv.com" title="" target="_blank">Marstv首页</a>|</li>
                                        <li><a href="http://www.marstv.com/index.php?m=content&c=index&a=news" title="" target="_blank">游戏新闻</a>|</li>
                                        <li><a href="http://www.marstv.com/index.php?m=content&c=index&a=videos" title="" target="_blank">视频点播</a>|</li>
                                        <li><a href="http://bbs.marstv.com/" title="" target="_blank">社区论坛</a>|</li>
                                        <li><a href="http://gaming.marstv.com" title="" target="_blank">菠菜</a></li>
                                </ul>
                        </div>
                        <?php echo $content; ?>
                </div>


        
                <script src="http://static.marstv.com/js/cookie.jquery.js"></script>
                <script>
                
                        function switchProgram(n){   
                                var tli=document.getElementById("live_button").getElementsByTagName("a");   
              
                                for(i=0;i<tli.length;i++){   
                                        tli[i].className=i==n?"current":"";   
                                        var mli=document.getElementById("program-panel"+i);  
                                        mli.style.display=i==n?"block":"none";   
                                }   
                        }   
                        
                        $('.close').click(function(){
                                $('.tool_cont').hide('slow','linear');
                        })
                        
                        $(document).ready(function() {
						        
                                if($.cookie('skin')==null)
                                {
                                        var skin='default'
                                }
                                else
                                {
                                        var skin = $.cookie('skin');
                                }

                                $('#skin').attr('href','assets/statics/css/live/'+skin+".css");
                                $("#template a[title="+$.cookie('skin')+"]").addClass('current');

                                $('#tool_button a').click(function(){
                                        var panel = $('#tabs-panel'+ $(this).attr('title'));
                                        if(panel.is(":hidden"))
                                        {
                                                $(this).siblings('a').removeClass("current");
                                                $(this).addClass('current');
                                                $('.tool_cont').hide('slow','linear');
                                                panel.show('slow','linear');
                                        }
                                        else
                                        {
                                                $('.tool_cont').hide('slow','linear');  
                                        }
                                });
                                
                                $('#template a').click(function()
                                {
                                        skin = $(this).attr('title');
                                        $('#skin').attr('href','assets/statics/css/live/'+skin+".css");
                                        $(this).siblings('a').removeClass("current");
                                        $(this).addClass('current');
                                        $.cookie('skin', skin,{expires: 7});   
                                })
                                
                                                                
                                $.get('<?php echo $this->createFrontUrl('site/bets', array(), 0) ?>',  
                                function(data){
                                        $('#bets').html(data);
                                });
                                $.get('<?php echo $this->createFrontUrl('site/program', array(), 0) ?>',  
                                function(data){
                                        $('#program').html(data);
                                });
                        });
                        
                        var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
                        document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fbbe9b76bbc15a1b8832d50a58b25b485' type='text/javascript'%3E%3C/script%3E"));
                </script>

                <!-- JiaThis Button BEGIN -->
                <script type="text/javascript" src="http://v2.jiathis.com/code/jiathis_r.js?type=left&amp;move=0&amp;btn=l3.gif" charset="utf-8"></script>
                <!-- JiaThis Button END -->
        </body>
</html>
