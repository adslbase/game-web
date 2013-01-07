<?php

        class ServicesController extends FeController
        {

                public $defaultAction = 'index';

                /**
                 * List of allowd default Actions for the user
                 * @return type 
                 */
                public function allowedActions()
                {
                        return 'server,checkregname,gamemoney,checkpayname';
                }

                public function actionServer($gameid)
                {
                        $servers = FrontCache::getServers();

                        echo CJSON::encode($servers[$gameid]);
                }

                public function actionGamemoney($gameid)
                {

                        $games = FrontCache::getGames();

                        $game = $games[$gameid];

                        echo CJSON::encode(array('unit' => $game['money_name'], 'rate' => $game['ratio']));
                }

                public function actionCheckregname()
                {

                        $data = array('state' => 0);
                        $form = $_GET['UserRegisterForm'];
                        $account = $form['username'];
                        $temp = $this->checkUsername($account);
                        if (!empty($temp))
                        {
                                $data['state'] = 9;
                                $data['message'] = '该用户名已存在！';
                        }

                        echo CJSON::encode($data);
                        Yii::app()->end();
                }

                public function checkUsername($account)
                {
                        $sql = 'SELECT `email` FROM {{user}} WHERE `username`= :username';
                        $connection = Yii::app()->db;

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryRow(true,array(':username'=>$account));

                        return $temp;
                }

                public function actionCheckpayname($gameid, $server, $account)
                {
                       $account =  urldecode($account);
                        $data = array('state' => 0);
                        $temp = $this->checkUsername($account);

                        if (empty($temp))
                        {
                                $data['state'] = 9;
                                $data['message'] = '用户不存在，如果你已是论坛用户，请先登录游戏中心！';
                                echo CJSON::encode($data);
                                Yii::app()->end();
                        }

                        $data = array('state' => 0, 'data' => $temp['email']);
                        $connection = Yii::app()->db;
                        $sql = 'SELECT `id` FROM {{serveruser}} WHERE `gameid`=:gameid AND `serverid`=:serverid AND `username`=:username';

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryRow(1,array(':gameid'=>$gameid,':serverid'=>$server,':username'=>$account));
                        if (empty($temp))
                        {
                                $data['state'] = 9;
                                $data['message'] = '未创建角色';

                                echo CJSON::encode($data);
                                Yii::app()->end();
                        }

                        echo CJSON::encode($data);
                }

        }