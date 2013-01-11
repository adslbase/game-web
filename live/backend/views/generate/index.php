<style>
    .listbox{ margin: 200px auto; width: 40%; font-size: 14px;}
    .listbox li{ float: left; display: inline; margin: 5px;}
</style>

<ul class="clearfix listbox">
          <li><a href="<?php echo Ycms::app()->createUrl("generate/Default"); ?>" >生成首页</a></li>
    <li><a href="<?php echo Ycms::app()->createUrl("generate/Channel"); ?>" >生成频道页面</a></li>
    <li><a href="<?php echo Ycms::app()->createUrl("generate/stream"); ?>" >生成直播页面</a></li>
</ul>
