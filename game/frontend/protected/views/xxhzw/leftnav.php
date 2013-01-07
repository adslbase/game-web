<?php
        if (YII_DEBUG)
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
        else
                $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        </head>
        <style>
                body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,form,fieldset,input,p,blockquote,th,td{margin:0;padding:0;}
                fieldset,img{border:0;}
                address,caption,cite,code,dfn,em,strong,th,var{font-style:normal;font-weight:normal;}
                ol,ul{list-style:none;}
                caption,th{text-align:left;}
                h1,h2,h3,h4,h5,h6{font-size:100%;}
                q:before,q:after{content:'';}
                .f_l,.f_r{ display:inline;}
                .f_l{ float:left;}
                .f_r{ float:right;}
                .clear {clear:both}

                /* clearfix*/
                .clearfix:after { content: "."; display: block; height: 0; clear: both; visibility: hidden }
                .clearfix { *zoom: 1; }

                html{height: 100%;}
                body{background:#053158;font-size:12px; font-family: arial,宋体;text-align:center; height:100%}
                #wrap,#maincnt,#container{ margin:0 auto;}
                #wrap{height:100%;text-align:left;}
                #maincnt {width:100%; margin-left:-126px; }
                #content{ margin-left:126px; position:relative; z-index:100; background:#053158;}
                #maintop{height:41px; overflow:hidden;}
                #leftbar,#leftbar a{color:#FDA706;}
                #leftbar{width:111px;height:100%; position:absolute;left:0;top:0;min-height:700px;_height:expression((documentElement.clientHeight > 700) ? "100%" : "auto" );}
                #leftbar a{ color:#333; text-decoration:none;blr:expression(this.onFocus=this.blur());outline:none;}
                #game_list{ float:left; height:100%;}
                #game_list{width:110px; margin:0px auto; overflow:hidden;padding:0 0 0 2px;}
                #game_list .game_list_bg{height:100%;min-height:600px;}
                #game_list .logo{height:47px;background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/logo.jpg) no-repeat; display:block; overflow:hidden; text-indent:-9999em;}
                #game_list .server{color:#f5cb48;text-align:center;margin:11px 0 13px;line-height:20px;}
                #game_list .server span{color:#609dc1;}
                #game_list .xl_btn{ overflow:hidden;}
                #game_list .xl_btn a{width:110px;height:31px;float:left;display:inline-block;overflow:hidden; margin-top:3px;}
                #game_list .xl_btn a.gw{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/ljgw.jpg) no-repeat;}
                #game_list .xl_btn a.czzx{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/pay.jpg) no-repeat;}
                #game_list .xl_btn a.shortcut{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/shortcut.jpg) no-repeat;}
                #game_list .xl_btn a.vip{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/vip.jpg) no-repeat;}
                #game_list .xl_btn a.receive{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/gift.jpg) no-repeat;}
                #game_list .xl_btn a.toolbook{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/guide.jpg) no-repeat;}
                #game_list .xl_btn a.gaoshou{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/gaoshou.jpg) no-repeat;}
                #game_list .xl_btn a.haizei{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/haizeitujian.jpg) no-repeat;}
                #game_list .xl_btn a.haizeiwang{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/haizeiwang.jpg) no-repeat;}
                #game_list .xl_btn_other a{width:110px;height:31px;}

                #game_list .xl_btn_other a.index{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/index.jpg) no-repeat;}
                #game_list .xl_btn_other a.bbs{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/bbs.jpg) no-repeat;}
                #game_list .xl_btn_other p{line-height:20px;overflow:hidden;}
                #game_list #type_5,#game_list #type_6{height:31px;line-height:31px;}
                #game_list #type_5{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/activity.jpg) no-repeat;}
                #game_list #type_6{background:url(<?php echo $layout_asset; ?>/css/xxhzw/left/service.jpg) no-repeat;}
                #game_list #groupid_4{}
                /*Game NavList*/
                #game_list dl{margin:5px 0 2px 2px; overflow:hidden;*zoom:1;clear:both;}
                #game_list dt{height:22px;line-height:23px;text-align:center;cursor:pointer;}
                #game_list dt a{color:#FFFC00;}
                #game_list dd{}
                #game_list dd ul{display:none;}
                #game_list li{margin-top:1px;overflow:hidden;height:18px;line-height:18px;white-space:nowrap;text-align:center;}
                #game_list li a{color:#BCBCC0;line-height:20px;}
                #game_list li a:hover{color:#FFFC00;}

                #game_list .tswf li{}
                #game_list .kfzx{color:#FFFFFF;}


        </style>
        <?php
                $cs = Yii::app()->clientScript;
                $cs->registerCoreScript('jquery');
        ?>
        <body>
                <script>
                        $(document).ready(function(){
                                $('#type_5').click(function() {
                                        $('#all_silde dt').removeClass('curr');
                                        $("#groupid_5 ul").slideToggle("slow");
                                        $('#all_service dt').removeClass('curr');
                                        $("#groupid_6 ul").slideToggle("slow");
                                });

                        });
                </script>
                <div id="leftbar" class="f_l">
                        <div id="game_list">
                                <div class="game_list_bg">
                                        <a href="<?php echo $this->createUrl('index');?>" target="_blank" class="logo" title="小小海贼王官方网站"></a>

                                        <div class="xl_btn clearfix">
                                                <a class="shortcut" target="_blank" href="<?php echo $this->createUrl('short');?>" title="小小海贼王快速登录器下载"></a>
                                                <a class="czzx" target="_blank" href="<?php echo $this->createUrl('payway/game',array('gameid'=>$this->game['object_id']));?>" title="游戏充值"></a>
                                                <a class="vip" href="<?php echo $this->createUrL('vip')?>" target="_blank" title="VIP特权"></a>
                                                <a class="receive" href="http://g.marstv.com/card/index.html" target="_blank" title="新手礼包"></a>
                                                <a class="gaoshou" href="<?php echo $this->createUrL('gl')?>" target="_blank" title="高手进阶"></a>
                                        </div>
                                        <dl id="all_silde">
                                                <dt class="curr" id="type_5">
                                                        <a href="javascript:void(0)"></a>
                                                </dt>
                                                <dd id="groupid_5" class="tswf">
                                                        <ul style="display:block;">
                                                                <li><a target="_blank" href="http://bbs.marstv.com/thread-93048-1-1.html"><font color="fff9bb">充值送大礼</font></a></li>
                                                                <li><a target="_blank" href="http://g.marstv.com/xxhzw/vip.html"><font color="fff9bb">VIP尊贵礼包</font></a></li>
                                                                <li><a target="_blank" href="http://g.marstv.com/xxhzw/94.html#1"><font color="#75c9ff">连续在线有奖</font></a></li>
                                                                <li><a target="_blank" href="http://g.marstv.com/xxhzw/94.html#2"><font color="#75c9ff">首充大礼包</font></a></li>
                                                                <li><a target="_blank" href="http://g.marstv.com/xxhzw/94.html#3"><font color="75c9ff75c9ff">升级送好礼</font></a></li>
                                                                <li><a target="_blank" href="http://g.marstv.com/xxhzw/94.html#4"><font color="75c9ff75c9ff">招船员拿金币</font></a></li>
                                                                <li><a target="_blank" href="http://g.marstv.com/xxhzw/94.html#5"><font color="#75c9ff">登陆拿金币</font></a></li>
                                                                <li><a target="_blank" href="http://bbs.marstv.com/thread-93453-1-1.html"><font color="#75c9ff">升军团得大礼</font></a></li>
                                                        </ul>
                                                </dd>
                                        </dl>

                                         <dl id="all_service">
                                                <dt class="curr" id="type_6">
                                                        <a href="javascript:void(0)"></a>
                                                </dt>
                                                <dd id="groupid_6" class="tswf">
                                                        <p>
                                                                <font color="#75c9ff">QQ号：192254648<br />工作时间：周一至五，9点至18点</font><a target="_blank" href="http://wpa.qq.com/msgrd?v=3&amp;uin=192254648&amp;site=qq&amp;menu=yes"><img border="0" src="http://wpa.qq.com/pa?p=2:1439990843:41" alt="点击这里给我发消息" title="点击这里给我发消息"></a>
                                                        </p>
                                                </dd>
                                        </dl>

                                       <div class="xl_btn xl_btn_other clearfix">
                                                <a class="bbs" href="<?php echo $this->game['bbs_url']?>" target="_blank" title="游戏论坛"></a>
                                        </div>
                                </div>	    
                        </div>


                </div>

        </body>
</html>
