<?php if(empty($stream)):?>
<p>酷六高清暂未开通</p>
<?php else :?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave

/cabs/flash/swflash.cab#version=7,0,0,0" width="<?php echo $width; ?>" height="<?php echo $height ;?>" id="Untitled-1" align="center">


<param name="allowScriptAccess" value="sameDomain" />


<param name="movie" value="<?php echo $stream ?>" />


<param name="quality" value="high" />


<param name="bgcolor" value="#000000" />


<embed src="<?php echo $stream ?>" quality="high" bgcolor="#000000" width="<?php echo $width; ?>" height="<?php echo $height ;?>" name="mymovie" align="center" 


allowScriptAccess="sameDomain" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />


</object>


 
    <?php endif ;?>
