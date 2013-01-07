<?php

        class CardController extends FeController
        {

                public $defaultAction = 'index';

                /**
                 * List of allowd default Actions for the user
                 * @return type 
                 */
                public function allowedActions()
                {
                        return 'index,view';
                }

                public function actionIndex($gameid = '')
                {
                        if ($gameid == '' || $gameid == 0)
                        {
                                $cards = FrontCache::getCards();
                        }
                        else
                        {
                                $cards = FrontCache::getCardsByGameid();
                                $cards = $cards[$gameid];
                        }

                        $this->render('index', array('cards' => $cards));
                }

                public function actionView($id)
                {
                        $message = $key = $serverid =  '';
                        $cards = FrontCache::getCards();

                        $card = $cards[$id];

                        $temp = FrontCache::getServers();
                        $temp = $temp[$card['object_parent']];
                        $servers = array();
                        $servers[0] = '请选择服务器';
                        foreach ($temp as $k => $value)
                        {
                                if ($value['object_status'] == 1)
                                {
                                        $servers[$value['object_id']] = $value['object_name'];
                                }
                        }


                        if (isset($_POST['submit1']))
                        {
                                $user = Yii::app()->user;
                                if ($user->isGuest != FALSE)
                                {
                                        $cs = Yii::app()->clientScript;
                                        $cs->registerScript('userreg', "
                                               alert('请登录后进行操作！' ); 
                                               ");
                                }
                                else
                                {
                                        $connection = Yii::app()->db;

                                        $gameid = $_POST['gameid'];
                                        $serverid = $_POST['serverid'];
                                        $cardid = $_POST['cardid'];
                                        $userid = $user->id;
                                        $sql = 'SELECT `key` FROM {{code}} WHERE `gameid`=:gameid AND `serverid`=:serverid AND `cardid`=:cardid AND `userid`=:userid ';

                                        $command = $connection->createCommand($sql);
                                        $temp = $command->queryRow(true, array(':gameid' => $gameid, ':serverid' => $serverid, ':cardid' => $cardid, ':userid' => $userid));

                                        $message = '';
                                        if ($temp)
                                        {
                                                $key = $temp['key'];
                                                $message = '你已领取过该卡，请复制后使用!';
                                        }
                                        else
                                        {
                                                $sql = 'SELECT `key`,`id` FROM {{code}} WHERE `gameid`=:gameid AND `serverid`=:serverid AND `cardid`=:cardid AND `userid`=:userid ';
                                                $command = $connection->createCommand($sql);
                                                $temp = $command->queryRow(true, array(':gameid' => $gameid, ':serverid' => $serverid, ':cardid' => $cardid, ':userid' => 0));

                                                if ($temp)
                                                {
                                                        $addtime = time();
                                                        $sql = "UPDATE {{code}} SET `userid` = :userid, `addtime` =:addtime  WHERE `id` = :id;";
                                                        $command = $connection->createCommand($sql);
                                                        $command->execute(array(':userid' => $userid, ':addtime' => $addtime, ':id' => $temp['id']));
                                                        $key = $temp['key'];
                                                        $message = '领取成功!';
                                                }
                                                else
                                                {
                                                        $key = '';
                                                        $message = '激活码已经发送完毕!';
                                                }
                                        }
                                }
                        }
                        $this->render('view', array('card' => $card, 'servers' => $servers, 'key' => $key,'message'=>$message,'serverid'=>$serverid));
                }

        }