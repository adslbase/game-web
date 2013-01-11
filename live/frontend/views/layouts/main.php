<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>MarsTV节目直播--为你带来不一样的精彩</title>
        <link rel="stylesheet" href="<?php echo YHtml::cssUrl('frontend/global.css', 'http://static.marstv.com/live') ?>" />
        <link href="<?php echo $this->chatroomUrl('chatroom.min.css', 'http://static.marstv.com/live') ?>" rel="stylesheet" />
    </head>
    <body>
        <div id="page">
            <div id="header" class="clearfix">
                <div class="logo" id="logo"><a href="http://www.marstv.com">MarsTV</a></div>
<!--                <div class="banner fr"><a href="http://bbs.marstv.com"><img src="<?php echo YHtml::imageUrl('frontend/banner.jpg') ?>" height="60" width="650" /></a></div>-->
            </div>
            <div class="site-nav"> 
                <ul>
                    <li><a href="http://www.marstv.com" class="site-nav-on" target="_blank">首页</a></li>
                    <li><a href="http://bbs.marstv.com" target="_blank">互动论坛</a></li>
                    <li class="on"><a href="http://live.marstv.com">直播中心</a></li>
                    <li><a href="http://bbs.marstv.com/portal.php?mod=list&catid=1" target="_blank">视频点播</a></li>
                </ul>
            </div>
            <?php echo $content ?>
            <div id="footer">
                <div class="footer-inner">
                    <div class="footer-nav ">
                        <a href="http://www.marstv.com/about.html">关于MarsTV</a>
                        <a href="http://www.marstv.com/jobs.html">诚征英才</a>
                        <a href="http://live.marstv.com">节目直播</a>
                        <a href="http://www.marstv.com/">MarsTV首页</a>
                    </div>
                    <input id="key" type="hidden" value="">
                    <div style="text-align:center;margin-left:0px; " class="copyright">
                        <p>Copyright&nbsp;&copy;2011-2013&nbsp;marstv.com&nbsp;版权所有&nbsp;&nbsp;&nbsp;&nbsp;增值电信业务经营许可证：沪ICP备11041807号 </p>
                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
