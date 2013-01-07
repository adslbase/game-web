<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
               <title><?php echo $this->pageTitle . '-' . settings()->get('general', 'site_name'); ?></title>
                <meta name="description" content="耀宇网页游戏，又叫做火星网页游戏，是耀宇网页游戏联运平台。包括：小小海贼王等网络游戏。并且提供免费游戏、游戏激活码等服务。同时与网页游戏公司联运，提供龙将攻略、神曲攻略、热血海贼王攻略等。" />
                <meta name="keywords" content="网页游戏,网页游戏联运,小小海贼王,传世无双,彩虹岛,龙将,星辰变,传奇,网页游戏大全,网页游戏平台,微端,微客户端" />

        </head>

        <frameset id="mainfrm" name="f2" rows="27,*"  frameborder="no" border="0" framespacing="0">
                <frame src="<?php echo $this->createUrl('top', array('server' => $server)) ?>" name="topFrame" scrolling="no" noresize="noresize" />

                <frameset id="frame-body" name="f3" rows="*" cols="110,10,*" frameborder="no" border="0" framespacing="0">
                        <frame src="<?php echo $this->createUrl('left') ?>" name="leftFrame" scrolling="no" noresize="noresize">
                                <frame src="<?php echo $this->createUrl('scroller') ?>" name="leftFrame" scrolling="no" noresize="noresize">
                                        <frame src="<?php echo $this->createUrl('play', array('server' => $server)) ?>" name="mainFrame" scrolling="auto" noresize="noresize" />
                                        </frameset>
                                        </frameset><noframes></noframes>
                                        </html>

















