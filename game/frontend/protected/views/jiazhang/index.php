<?php
if (YII_DEBUG)
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, true);
else
        $layout_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.frontend'), false, -1, false);
?>

<?php
$cs = Yii::app()->clientScript;

$cs->registerCssFile($layout_asset . '/css/jiazhang.css');
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>网络游戏未成人家长监护系统—火星游戏平台</title>
        </head>

        <body>

                <div id="main">
                        <div class="top">
                                <div class="dp">
                                </div>
                        </div>

                        <div class="jright">
                                <div class="jj"></div>
                                <ul>
                                        <li><a href="#" onclick="setTab('one',1,4)"><img src="<?php echo $layout_asset . '/images/jz/fwsm.jpg' ?>" width="143" height="43" border="0"/></a></li>
                                        <li><a href="#" onclick="setTab('one',2,4)"><img src="<?php echo $layout_asset . '/images/jz/sqlc.jpg' ?>" width="143" height="43"  border="0"/></a></li>
                                        <li><a href="#" onclick="setTab('one',3,4)"><img src="<?php echo $layout_asset . '/images/jz/sqxz.jpg' ?>" width="143" height="43"  border="0"/></a></li>
                                        <li><a href="#" onclick="setTab('one',4,4)"><img src="<?php echo $layout_asset . '/images/jz/faq.jpg' ?>" width="143" height="43"  border="0"/></a></li>
                                </ul>
                                <div class="content_t"></div>

                                <div id="con_one_1" class=" content content1" style="height:600px;">
                                        <span style="font-size:16px; color:#900; font-weight:bold; text-align:center; width:750px;">服务说明</span><br /><br />
                                        &nbsp;&nbsp;&nbsp;&nbsp;家长监护工程充分考虑家长的实际需求，当家长发现自己的孩子玩游戏过于沉迷的时候，由家长提供合法的监护人资质证明、游戏名称帐号、以及家长对于限制强度的愿望等信息，可对处于孩子游戏沉迷状态的帐号采取几种限制措施，解决未成年人沉迷网游的不良现象，如限制孩子每天玩游戏的时间区间和长度，也可以限制只有周末才可以游戏，或者完全禁止。 <br /><br />

                                        <span style="font-size:16px; color:#900; font-weight:bold; text-align:center; width:750px;">健康游戏提示</span><br />     
                                        <div class="c_tt">
                                                文化部网络游戏内容审查专家委员会<br />
                                                中国教育学会中小学信息技术教育委员会<br />
                                                中国青少年网络协会<br />
                                                《未成年人健康参与网络游戏提示》<br /><br />
                                        </div>

                                        &nbsp;&nbsp;&nbsp;&nbsp;随着网络在青少年中的普及，未成年人接触网络游戏已经成为普遍现象。为保护未成年人健康参与游戏，在政府进一步加强行业管理的前提下，家长也应当加强监护引导。为此，我们为未成年人参与网络游戏提供以下意见：<br />

                                        一、主动控制游戏时间。游戏只是学习、生活的调剂，要积极参与线下的各类活动，并让父母了解自己在网络游戏中的行为和体验。<br />

                                        二、不参与可能耗费较多时间的游戏设置。不玩大型角色扮演类游戏，不玩有PK类设置的游戏。在校学生每周玩游戏不超过2小时，每月在游戏中的花费不超过10元。<br />

                                        三、不要将游戏当作精神寄托。尤其在现实生活中遇到压力和挫折时，应多与家人朋友交流倾诉，不要只依靠游戏来缓解压力。<br />

                                        四、养成积极健康的游戏心态。克服攀比、炫耀、仇恨和报复等心理，避免形成欺凌弱小、抢劫他人等不良网络行为习惯。<br />

                                        五、注意保护个人信息。包括个人家庭、朋友身份信息，家庭、学校、单位地址，电话号码等，防范网络陷阱和网络犯罪。 <br />
                                </div>


                                <div id="con_one_2" class=" content content1" style="display:none; height:750px;">
                                        <span style="font-size:16px; color:#900; font-weight:bold; text-align:center;">申请流程</span><br /><br />
                                        <div class="sqlc_tt"></div> 
                                </div>
                                <div id="con_one_3" class=" content content1" style="display:none;height:500px;">
                                        <span style="font-size:16px; color:#900; font-weight:bold; text-align:center;">申请须知</span><br /><br />
                                        <p>一、申请条件 <br />

                                                1、 申请人需为被监护未成年人的法定监护人； <br />

                                                2、 申请人的被监护人年龄小于18周岁； <br />

                                                3、 申请人需为大陆公民，不含港、澳、台人士。<br />
                                        </p>
                                        <p>
                                                二、申请需要提交材料： <br />

                                                1、监护人信息表（包含监护人的身份证及户口本复印件）； <br />

                                                2、被监护人信息表（包含被监护人所玩游戏相关信息及户口本复印件）； <br />

                                                3、填写网络游戏未成年人家长监护申请书、保证书、授权书并手工签字；<br />

                                                4、派出所/公安机关出示的监护关系证明书（非必要条件）。 <br />
                                        </p>
                                        <p>
                                                三、申请方式 您可以通过以下方式联系我们：<br />

                                                1、服务热线：021-56710610（仅提供监护工程服务）<br />
                                                2、直接到我们公司申请。地址：上海市虹口区欧阳路196号10号楼707室 <br />
                                                3、快件邮寄：邮寄地址：上海市虹口区欧阳路196号10号楼707室&nbsp;&nbsp;邮编：200080&nbsp;&nbsp; 上海耀宇文化传媒有限公司网络家长监护部 收<br />

                                        </p>
                                        <p>
                                                四、申请流程： <br />
                                                我公司在收到提交材料后，将在 3个工作日内进行电话回访（不含法定节假日），并对内容进行核查。资料提交合格且核对正确的情况下，由我公司对该请求予以受理；资料提交不全面的，由我公司进行回访，并提示申请人继续补充材料；资料提交不合格且不正确的，我公司有权对该请求予以拒绝，并附说明理由。 
                                        </p>

                                </div>        

                                <div id="con_one_4" class=" content content1" style="display:none; height:580px;">
                                        <span style="font-size:16px; color:#900; font-weight:bold; text-align:center;">常见问题</span><br /><br />
                                        Q：我要怎么申请家长监督未成年人账号？<br />

                                        A：首先下载页面的申请表，根据提示填写完成，再把相关资料传真至021-56710603，我司收到申请后将在三个工作日内进行电话反馈。 <br /><br />

                                        Q：什么时间可以申请？<br />

                                        A：1、电话反馈受理时间是6*8小时服务每天9：00—18：00；电话号码：021-56710610（6天制）。<br /><br />

                                        Q：申请监控的账号有什么要求？<br />

                                        A：账号所属人必须未满18周岁。 <br /><br />

                                        Q：申请成功后会对被监控人的账号进行哪些处理？<br />

                                        A：我们会在确认您提供的信息无误后，您可以选择以下方案中的方法对被监控人账号进行处理<br />

                                        1、限制帐号上线时间段。<br />

                                        2、限制帐号每周上线的天数。<br />

                                        3、根据家长要求对帐号进行自定义限制。<br />

                                        4、对该账号每周的游戏时间进行统计（本周总共在游戏内玩了多久）。<br /><br />

                                        Q：我提交申请后，多久可以审核完毕开始监控？<br />

                                        A：我们会以最快的速度进行核实处理，如果由于您提供的材料不同，任何步骤出现疑问有疑问，我们都会与您联系。 <br /><br />

                                        Q：我提交申请成功后，如果需要取消监督如何操作？<br />

                                        A：1、您可以通过上门或传真方式提供申请监督时的相关信息，申请解除监督。<br />

                                        2、被监护账号所属人年满18周岁可提供申请监督时的相关信息进行申请结束监督。<br />


                                </div>        
                                <div class="content_b"></div>
                        </div>

                        <div class="jleft">
                                <div class="tt1"></div>
                                <div class="zx">
                                        <font color="#990000">服务热线：</font>021-56710610
                                        <br/>
                                        (6*8小时专线服务)<br />
                                        <font color="#990000">服务传真：</font>021-56710603<br />
                                        (6*8小时传真)<br />
                                        <font color="#990000">在线咨询：</font>
                                        <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=1592743789&site=qq&menu=yes">
                                                <img src="http://wpa.qq.com/pa?p=2:1592743789:42" alt="点击这里给我发消息" border="0" align="top" title="点击这里给我发消息">
                                        </a>
                                        <span style="line-height:30px; padding-left:90px; display:none;">更多联系方式</span><br />
                                        <font color="#990000">电子邮件：</font>
                                        <a href="mailto:jzjh@marstv.com">jzjh@marstv.com</a></div>
                                <div class="tt2"></div>
                                <div class="xz">
                                        <a href="<?php echo $this->createUrl('jiazhang/down', array('id' => 1)) ?>">文档一：家长监护申请书</a><br />
                                        <a href="<?php echo $this->createUrl('jiazhang/down', array('id' => 2)) ?>">文档二：监护人信息表</a><br />
                                        <a href="<?php echo $this->createUrl('jiazhang/down', array('id' => 3)) ?>">文档三：被监护人信息表</a><br />
                                        <a href="<?php echo $this->createUrl('jiazhang/down', array('id' => 4)) ?>">
                                                <img src="<?php echo $layout_asset . '/images/jz/dbxz.jpg' ?>" width="145" height="45" border="0" style="margin-top:5px;" />
                                        </a>
                                </div>
                        </div>
                        <div id="clearh"></div>
                </div>
                <div class="foot" style="clear:both;">
                        耀宇游戏平台&nbsp;&nbsp;&nbsp;上海耀宇文化传媒有限公司
                        <br />
                </div>
                <script>
                        function setTab(name,cursel,n){
                                for(i=1;i<=n;i++){
                                        //var menu=document.getElementById(name+i);
                                        var con=document.getElementById("con_"+name+"_"+i);
                                        //menu.className=i==cursel?"hover":"";
                                        con.style.display=i==cursel?"block":"none";
                                }
                        }        
                </script>





        </body>
</html>
