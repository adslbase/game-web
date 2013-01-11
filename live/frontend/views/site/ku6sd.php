<?php if(empty($stream)):?>
<p>酷六标清暂未开通</p>
<?php else :?>


<embed width="100%" height="100%" align="middle" src="<?php echo $stream ?>" quality="high" allowscriptaccess="always" allowfullscreen="true" type="application/x-shockwave-flash">
 
    <?php endif ;?>
