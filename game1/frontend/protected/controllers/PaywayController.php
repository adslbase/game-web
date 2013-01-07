<?php

        class PaywayController extends FeController
        {

                public $defaultAction = 'index';

                /**
                 * List of allowd default Actions for the user
                 * @return type 
                 */
                public function allowedActions()
                {
                        return 'index,view,error,game';
                }

                /**
                 * Index Page of the Site, re route here
                 */
                //public function actionIndex($path)
                public function actionIndex()
                {
                        $this->render('index');
                }

                public function actionGame($gameid, $server = '', $payway = 2)
                {
                        //充值方式
                        $payways = FrontCache::getPayways();
                        $games = FrontCache::getGames();
                        $servers = FrontCache::getServers();

                        if (isset($_POST['account']) && isset($_POST['selectserver']))
                        {
                                $serverid = intval($_POST['selectserver']);
                                $gameid = intval($_POST['gameid']);

                                if ($servers[$gameid][$serverid]['server_is_pay'] == 1)
                                {
                                        $payway = intval($_POST['payway']);

                                        $trade_sn = create_sn();
                                        $account = strtolower($_POST['account']);

                                        $order = new Order();

                                        $order->trade_sn = $trade_sn;
                                        if (!empty(user()->id))
                                        {
                                                $order->userid = user()->id;
                                        }
                                        else
                                        {
                                                $order->userid = 0;
                                        }

                                        if (isset($_POST['email']))
                                        {
                                                $order->email = trim($_POST['email']);
                                        }
                                        $order->username = $account;

                                        $order->discount = floatval($games[$gameid]['ratio']);

                                        if (!empty($_POST['selectmoney']))
                                        {
                                                $order->money = trim(floatval($_POST['selectmoney']));
                                        }
                                        elseif (!empty($_POST['othermoney']))
                                        {
                                                $order->money = trim(floatval($_POST['othermoney']));
                                        }

                                        $order->quantity = $order->money * $order->discount;
                                        $order->addtime = SYS_TIME;
                                        $order->usernote = isset($_POST['usernote']) ? $account . '[' . $trade_sn . ']' . '-' . new_html_special_chars(trim($_POST['usernote'])) : $account . '[' . $trade_sn . ']';
                                        $order->pay_id = $payway;
                                        $order->pay_type = 'recharge';
                                        $order->payname = $payways[$payway]['name'];

                                        $order->gameid = $gameid;
                                        $order->gamename = $_POST['gamename'];
                                        $order->serverid = $serverid;
                                        $order->servername = $_POST['servername'];
                                        $order->gameunit = $games[$gameid]['money_name'];

                                        $order->ip = ip();
                                        $order->status = 'unpay';
                                        if ($order->save())
                                        {
                                                $this->redirect(array('order/index', 'sn' => $order->trade_sn));
                                        }
                                        else
                                        {
                                                $errors = $order->errors;
                                                if (!empty($errors))
                                                {
                                                        foreach ($errors as $error)
                                                        {
                                                                $errorMsg = $error[0];
                                                        }

                                                        $cs = Yii::app()->clientScript;
                                                        $cs->registerScript('userreg', "
                                               alert(' $errorMsg' ); 
                                               ");
                                                }
                                        }
                                }
                                else
                                {
                                        $cs = Yii::app()->clientScript;
                                        $cs->registerScript('userreg', "
                                               alert('游戏充值尚未开启，谢谢！'); 
                                               ");
                                }
                        }
                        $game = $games[$gameid];

                        $this->render('game', array('payways' => $payways,
                                    'gameid' => $gameid,
                                    'server' => $server,
                                    'paywayId' => $payway,
                                    'game' => $game,
                                    'games' => $games,
                                    'servers' => $servers
                        ));
                }

                /**
                 * When viewing a Page
                 */
                public function actionView($id)
                {
                        parent::renderPage($id);
                }

                /**
                 * This is the action to handle external exceptions.
                 */
                public function actionError()
                {

                        parent::error();
                }

        }