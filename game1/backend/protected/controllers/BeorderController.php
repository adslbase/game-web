<?php

        class BeorderController extends BeController
        {

                public function actionIndex()
                {

                        $model = new Order('search');

                        $model->unsetAttributes();

                        if (isset($_GET['Order']))
                        {
                                $model->attributes = $_GET['Order'];
                        }
                        $dataProvider = $model->search($model);

                        $this->render('index', array('dataProvider' => $dataProvider, 'model' => $model));
                }

                public function actionStatis()
                {
                        $this->render('statis');
                }

                public function actionUpdate($id)
                {
                        $model = Order::model();
                        if (isset($_POST['oldstatus']))
                        {
                                if ($_POST['oldstatus'] != $_POST['status'])
                                {
                                        $adminnote = user()->name . '|' . user()->id . '|' . time() . '|' . ip() . '|' . 'update';
                                        $model->updateByPk($id, array('status' => $_POST['status'], 'adminnote' => $adminnote));
                                }
                                user()->setFlash('success', t('更新订单成功!'));
                                $this->redirect(array('beorder/index'));
                        }
                        else
                        {
                                $order = $model->findByPk($id);
                        }
                        $this->render('view', array('order' => $order));
                }

                public function actionCharge($id)
                {
                        $connection = Yii::app()->db;
                        $sql = 'SELECT * FROM  `{{pay_order}}` WHERE  `id`=:id';
                        $command = $connection->createCommand($sql);
                        $order = $command->queryRow(TRUE, array(':id' => $id));

                        if ($order['status'] == 'admincharge')//如果订单状态为兑换失败，或者已经支付
                        {
                                $serverid = $order['serverid'];
                                $servers = FrontCache::getAllServers();
                                $server = $servers[$serverid];

                                $class = ucwords($server['game_sn']) . 'Api';
                                Yii::import('common.gameapi.' . $class);
                                $gameApi = new $class($server, $order);

                                $result = $gameApi->charge();
                                                                
                                if ($result === true)
                                {
                                        $connection = Yii::app()->db;
                                        $paytime = SYS_TIME;
                                        $adminnote = $order['adminnote'] . '|' . user()->name . '|' . user()->id . '|' . time() . '|' . ip() . '|' . 'charge';
                                        $sql = "UPDATE `{{pay_order}}` SET `status` = :status,`paytime` = :paytime,`adminnote`=:adminnote WHERE `id` = :id";
                                        $command = $connection->createCommand($sql);
                                        $command->execute(array(':status' => 'succ', ':paytime' => $paytime, ':adminnote' => $adminnote, ':id' => $id));
                                        
                                        $json['message'] = '补单成功，已记录补单人员的信息！';
                                        $json['r'] = 1;
                                }
                                else
                                {
                                        $json['message'] = '补单失败，请确定游戏服务器是否正常！';
                                        $json['r'] = 0;
                                }
                        }
                        else
                        {
                                $json['message'] = '如果补单，请把订单状态修改为“管理员补单”';
                                $json['r'] = 0;
                        }
                        echo CJSON::encode($json);
                        exit;
                }

        }