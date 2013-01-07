<?php

        class OrderController extends FeController
        {

                public $order;
                public $defaultAction = 'index';

                /**
                 * List of allowd default Actions for the user
                 * @return type
                 */
                public function allowedActions()
                {
                        return 'index,return,test,charge,notify';
                }

                public function actionIndex($sn)
                {
						$order = $this->getOrderBySn($sn);
                        if (empty($order))
                        {
                                $message = '订单号码不存在！';
                                $this->renderError($message);
                        }
                        switch ($order['status'])
                        {
								case 'succ':
                                        $message = '该订单已经支付并兑换游戏币成功';
                                        $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                        $this->render('succ', array('message' => $message, 'order' => $order));
                                        break;
                                case 'chargefailed':
                                        $message = '该订单已经支付成功，但是兑换游戏币失败!点击按钮进行兑换。';
                                        $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                        $this->render('charge', array('order' => $order, 'message' => $message));
                                        break;
                                case 'unpay':
                                        $message = '该订单尚未支付';
                                        $payways = FrontCache::getPayways();
                                        $payway = $payways[$order['pay_id']];

                                        if ($payway['is_online'] === '1')
                                        {
                                                //产品信息
                                                $productInfo['name'] = $order['gamename'] . '-' . $order['servername'];
                                                //生产
                                                $productInfo['price'] = $order['money'];
                                                //测试
                                                //$productInfo['price'] = 0.10;
                                                $productInfo['body'] = $order['usernote'];
                                                //订单信息
                                                $orderInfo['id'] = $order['trade_sn'];
                                                //买家信息
                                                $customerInfo['email'] = $order['email'];
                                                $customerInfo['name'] = $order['username'];

                                                $paymentHandler = new PayFactory($payway['class'], $payway['config']);
												
                                                $paymentHandler->setProductinfo($productInfo);
                                                $paymentHandler->setOrderinfo($orderInfo);
                                                $paymentHandler->setCustomerinfo($customerInfo);

                                                $code = $paymentHandler->getCode();
                                                $action = $paymentHandler->getGatewayUrl();
                                        }
                                        $this->render('unpay', array(
                                                    'order' => $order,
                                                    'action' => $action,
                                                    'code' => $code
                                        ));
                                        break;
                                case 'paid':
                                        $message = '该订单已经支付成功，但是尚未兑换成游戏币！点击按钮进行兑换！';
                                        $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                        $this->render('charge', array('order' => $order, 'message' => $message));
                                        break;
                                case 'payfailed':
                                        $message = '该订单支付失败！';
                                        $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                        $this->renderError($message);
                                        break;
                                default:
                                        $message = '订单错误！';
                                        $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                        $this->renderError($message);
                                        break;
                        }
                }

                public function actionCharge($sn)
                {
						$order = $this->getOrderBySn($sn);
                        if (empty($order))
                        {
                                $message = '订单号码不存在！';
                                $this->renderError($message);
                        }
                        $this->goCharge($order);
                }

                //服务器返回页面
                public function actionReturn($code)
                {
						if($code=="heepay")
						{
						    $result=$_GET['result'];
							$order_sn=$_GET['agent_bill_id'];
							$pay_amt=$_GET['pay_amt'];
							if ($result=="1")
							{
									$order = $this->getOrderBySn($order_sn);
									if (!empty($order))
									{
											if ($order['money'] == $pay_amt)
											{
	
													if ($order['status'] == 'unpay')
													{
															//修改订单状态 已支付
															if ($this->changeOrderStatus(1, $order['id']))//支付成功,因为下一步要判断订单状态
															{
																	$order['status'] = $this->returnStatus(1);
																	$this->goCharge($order); //去兑换
															}
													}
													else
													{
															$this->redirect(array('order/index', 'sn' => $order['trade_sn']));
													}
											}
											else
											{
													$message = '支付失败--充值的金额与订单金额不一致！';
													$message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
													$this->changeOrderStatus(3, $order['id']); //支付失败
													$this->renderError($message);
											}
									}
									else if (!empty($order) && $returnData['order_status'] == 3)
									{
											$message = '充值失败--请重新充值！';
											$message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
											$this->changeOrderStatus(3, $order['id']); //支付失败
											$this->renderError($message);
									}
							}
							else
							{       //没有获得返回数据
									$message = '充值失败--请重新充值！';
									$this->renderError($message);
							}
						}
						else
						{
							$payways = FrontCache::getPayways(TRUE);
							$payway = $payways[$code];
							$paymentHandler = new PayFactory($payway['class'], $payway['config']);
							$returnData = $paymentHandler->receive();
							if ($returnData)
							{
									$order = $this->getOrderBySn($returnData['trade_sn']);
									if (!empty($order) && $returnData['order_status'] == 1)
									{
											if ($order['money'] == $returnData['money'])
											{
	
													if ($order['status'] == 'unpay')
													{
															//修改订单状态 已支付
															if ($this->changeOrderStatus(1, $order['id']))//支付成功,因为下一步要判断订单状态
															{
																	$order['status'] = $this->returnStatus(1);
																	$this->goCharge($order); //去兑换
															}
													}
													else
													{
															$this->redirect(array('order/index', 'sn' => $order['trade_sn']));
													}
											}
											else
											{
													$message = '支付失败--充值的金额与订单金额不一致！';
													$message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
													$this->changeOrderStatus(3, $order['id']); //支付失败
													$this->renderError($message);
											}
									}
									else if (!empty($order) && $returnData['order_status'] == 3)
									{
											$message = '充值失败--请重新充值！';
											$message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
											$this->changeOrderStatus(3, $order['id']); //支付失败
											$this->renderError($message);
									}
							}
							else
							{       //没有获得返回数据
									$message = '充值失败--请重新充值！';
									$this->renderError($message);
							}
						}
                }
                
                //服务器异步通知页面--和上面结构差不多。可优化合并处理
                public function actionNotify()
                {
                        if (isset($_GET['code']))
                        {
                                $code = $_GET['code'];
                        }
                        else if (isset($_POST['code']))
                        {
                                $code = $_POST['code'];
                        }
                        $payways = FrontCache::getPayways(TRUE);
                        $payway = $payways[$code];

                        $paymentHandler = new PayFactory($payway['class'], $payway['config']);

                        $returnData = $paymentHandler->notify();
                        if ($returnData)
                        {
                                $order = $this->getOrderBySn($returnData['trade_sn']);

                                if (!empty($order) && $returnData['order_status'] == 1)
                                {
                                        if ($order['money'] == $returnData['money'])
                                        {
                                                if ($order['status'] == 'succ')//避免重复处理
                                                {
                                                        $paymentHandler->response(true);
                                                        exit;
                                                }
                                                if ($order['status'] == 'unpay')
                                                {
                                                        $this->changeOrderStatus(1, $order['id']);
                                                }
                                                $serverid = $order['serverid'];
                                                $servers = FrontCache::getAllServers();
                                                $server = $servers[$serverid];

                                                $class = ucwords($server['game_sn']) . 'Api';
                                                Yii::import('common.gameapi.' . $class);
                                                $gameApi = new $class($server, $order);

                                                $result = $gameApi->charge();
                                                if ($result === true)
                                                {
                                                        //修改订单状态为成功
                                                        $this->changeOrderStatus(0, $order['id']); //兑换成功
                                                        $paymentHandler->response(true);
                                                        exit;
                                                }
                                                else
                                                {
                                                        $this->changeOrderStatus(2, $order['id']); //兑换失败
                                                }
                                        }
                                }
                        }

                        $paymentHandler->response(FALSE);
                        exit;
                }

                //返回true  为兑换游戏币成功。 否则为兑换错误消息
                private function goCharge($order)
                {
                        if (($order['status'] == 'chargefailed' || $order['status'] == 'paid') && $order['id'])//如果订单状态为兑换失败，或者已经支付
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
										$message = '充值并兑换游戏币成功';
                                        //修改订单状态为成功
                                        $this->changeOrderStatus(0, $order['id']); //兑换成功
                                        $this->render('succ', array('message' => $message, 'order' => $order));
                                }
                                else
                                {
										$message = '兑换失败--' . $result . '!';
                                        $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                        $this->changeOrderStatus(2, $order['id']); //兑换失败
                                        $this->renderError($message);
                                }
                        }
                        else
                        {
                                $message = '兑换失败--你的订单状态已经兑换成功或者其他原因造成兑换失败！';
                                $message .='<br>订单号是：' . $order['trade_sn'] . '！如有疑问，请联系管理员！';
                                $this->renderError($message);
                        }
                }

                private function changeOrderStatus($status, $id)
                {
                        $connection = Yii::app()->db;
                        $status = $this->returnStatus($status);
                        $paytime = SYS_TIME;
                        $sql = "UPDATE `{{pay_order}}` SET `status` = :status,`paytime` = :paytime WHERE `id` = :id";
                        $command = $connection->createCommand($sql);
                        return $command->execute(array(':status' => $status, ':paytime' => $paytime, ':id' => $id));
                }

                /**
                 * 通过订单sn抓取用户信息
                 * @param unknown_type $trade_sn
                 */
                private function getOrderBySn($trade_sn)
                {
                        $trade_sn = trim($trade_sn);
                        $connection = Yii::app()->db;
                        $sql = 'SELECT * FROM  `{{pay_order}}` WHERE  `trade_sn`=' . $trade_sn;
                        $command = $connection->createCommand($sql);
                        $order = $command->queryRow();
                        return $order;
                        $status_arr = array('succ', 'paid', 'failed', 'error', 'timeout', 'cancel');
                        return ($order && !in_array($order['status'], $status_arr)) ? $order : false;
                }

                /**
                 * 返回订单状态
                 */
                public function returnStatus($status)
                {
                        $trade_status = array('0' => 'succ', '1' => 'paid', '2' => 'chargefailed', '3' => 'payfailed', '4' => 'failed', '5' => 'unpay', '6' => 'cancel', '7' => 'error', '8' => 'timeout');
                        return $trade_status[$status];
                }

                public function actionTest()
                {
                        echo 1000;
                        exit;
                }

                public function renderError($message)
                {
                        $this->render('error', array('message' => $message));
                        Yii::app()->end();
                }

        }