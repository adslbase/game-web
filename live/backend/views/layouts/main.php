<?php
$cs = Ycms::app () -> getClientScript ();

$cs -> registerScriptFile ( YHtml::jsUrl ( 'jquery.js' ) );
$cs -> registerScriptFile ( YHtml::jsUrl ( 'jquery.cookie.js' ) );
$cs -> registerScriptFile ( YHtml::jsUrl ( 'jquery.ba-bbq.js' ) );
$cs -> registerScriptFile ( YHtml::jsUrl ( 'backend/common.js' ) );
$cs->registerCssFile(YHtml::cssUrl('reset.css'));
$cs -> registerCssFile ( YHtml::cssUrl ( 'backend/frame.css' ) );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <title>YCMS 后台</title>
                <meta http-equiv="content-type" content="text/html; charset=utf-8" />
                <link rel="stylesheet" media="screen" type="text/css" href="<?php echo YHtml::cssUrl ( 'backend/2col.css' );?>" id="colstyle" />
                <script type="text/javascript">
                        function getMenu($alias)
                        {
                                $('#leftMain').load("<?php echo $this -> createUrl ( 'menu/leftMenu' );?>"+'&alias='+$alias);
                                $('#top-menu a[href=#'+$alias+']').parent().addClass("menu-active").siblings().removeClass("menu-active");
                        }
            
                        $(document).ready(function(){
                                if(top!=self)     
                                {
                                        location.href='<?php echo $this -> createUrl ( 'site/index',array ( 'layout' => 'rend' ) );?>';
                                }          
                        });
                </script>
        </head>

        <body>
                <div id="main">

                        <div id="tray" class="clearfix">
                                <p class="f-left clearfix">
                                        <span class="f-left" id="switcher">
                                                <a href="#" rel="<?php echo YHtml::cssUrl ( 'backend/1col.css' );?>" class="styleswitch ico-col1" title="Display one column"><img src="<?php echo YHtml::imageUrl ( '/backend/frame/switcher-1col.gif' )?>" alt="1 Column" /></a>
                                                <a href="#" rel="<?php echo YHtml::cssUrl ( 'backend/2col.css' );?>" class="styleswitch ico-col2" title="Display two columns"><img src="<?php echo YHtml::imageUrl ( '/backend/frame/switcher-2col.gif' )?>" alt="2 Columns" /></a>
                                        </span>
                                        <span>
                                        欢迎使用YCMS,用户: <strong><?php echo Ycms::app()->getUser()->getName()  ?></strong>&nbsp;&nbsp; <strong><a href="<?php echo $this -> createAbsoluteUrl ( 'login/Logout' )?>" id="logout">退出</a></strong>
                                        </span>
                                </p>
                                <p class="f-right">
                                        <a href="http://ycms.sinaapp.com/" target="_blank">官方网站</a><span>|</span><a href="http://ycms.sinaapp.com/" target="_blank">授权</a><span>|</span><a href="http://ycms.sinaapp.com/" target="_blank">支持论坛</a><span>|</span><a href="http://ycms.sinaapp.com/" target="_blank">帮助？</a>
                                </p>

                        </div> 


                        <div id="menu" class="clearfix">
                                <div id="logo">
                                        <a href="<?php echo $this -> createUrl ( 'site/index' )?>"><img src="<?php echo YHtml::imageUrl ( '/backend/frame/logo.gif' )?>" alt="ycms" /></a>
                                </div>
                                <ul class="clearfix f-left" id="top-menu">
                                        <?php foreach ( $this -> getTopMenus () as $topMenu ) :?>
                                                <li><a href="#<?php echo $topMenu[ 'alias' ]?>"><span><?php echo $topMenu[ 'name' ]?></span></a></li>
                                        <?php endforeach;?>
                                </ul>
                        </div> 


                        <div id="cols" class="clearfix">

                                <div id="aside">
                                        <div id="leftMain">
                                        </div>
                                </div>
                                <div id="content">
                                        <!--                    <div class="content" id="rightMain">-->
                                        <iframe name="right" id="rightMain" src="<?php echo $this -> createUrl ( 'site/index',array ( 'layout' => 'rightmain' ) );?>" width="100%" allowtransparency="true"></iframe>
                                        <!--                    </div>-->
                                </div> 

                        </div>


                        <div id="footer" class="clearfix">

                                <p class="f-left">&copy; 2009 <a href="#">Your Ycms</a>, All Rights Reserved &reg;</p>

                                <p class="f-right"><a href="http://sae.sina.com.cn" target="_blank"><img src="http://static.sae.sina.com.cn/image/poweredby/117X12px.gif" title="Powered by Sina App Engine" /></a></a></p>

                        </div> 

                </div> 

        </body>
</html>