<?php if(empty($stream)):?>
<p>PP高清暂未开通</p>
<?php else :?>
<OBJECT CLASSID="clsid:5EC7C511-CD0F-42E6-830C-1BD9882F3458" CODEBASE=http://download.ppstream.com/bin/powerplayer.cab 
standby="加载播放器中..." WIDTH=<?php echo $width?> HEIGHT=<?php echo $height?> ID="powerplayer"> 
    <!--大小可依网页需要调整-->
    <param name="ShowControl" value="1">
    <!--显示播放控制按钮，1为显示， 0为不显示-->
    <param name="src" value="<?php echo $stream ?>">
    <!--频道地址可自由指定-->
    <param name="autostart" value="1">
    <!--是否打开网页立即自动播放, 1为自动播放，0为不自动播放-->
  </OBJECT>
   
    <p>  如果您无法正常看到相应频道，请 <a href="http://download.ppstream.com/powerplayersetup.exe" target="_blank" ><font color=red><b>安装PPS网络电视插件</b></font></a></p>
    
    <?php endif ;?>