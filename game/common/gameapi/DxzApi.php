<?php

        class DxzApi extends GameApi
        {

                public $key;
                public $serverId;

                public function init()
                {
                        $this->serverId = $this->server['server_sn']; //非object_id，是联运服务器id
                        $this->key = $this->server['server_key'];
                }

                public function login()
                {
                        $loginUrl = $this->server['server_login_gateway'];
                        $loginUrl .= '?auth=' . $this->getLoginAuth();
                        $loginUrl .= '&verify=' . $this->getLoginVerify();
                        return $loginUrl;
                }
				 

                public function charge()
                {
                        $payUrl = $this->server['server_pay_gateway'];
                        $payUrl .= '?auth=' . $this->getPayAuth();
                        $payUrl .= '&verify=' . $this->getPayVerify();
                        
//                        $payUrl = Yii::app()->createAbsoluteUrl('order/test');
                        
                        $result = $this->getfopen($payUrl, 0, 1);
						$date = json_decode($result,true);
                        if ($date['status'] == "0")
                        {
                                return TRUE;
                        }
                        else
                        { 
                                switch ($date['status'])
                                {
                                        case 11:
                                                $message = 'IP限制';
                                                break;
                                        default:
                                                $message = '兑换错误号--'.$result;
                                                break;
                                }
                                return $message;
                        }
                }
                
                public function getMoney()
                {
                        $money =  $this->order['money']*100;
                        
                        return $money;
                }

                public function getop_id()
                {
                        return 357;
                }

                public function getGameId()
                {
                        return 8;
                }

                public function getServerId()
                {
						return $this->serverId;
                }
				
				public function getLoginAuth()
				{
						$auth = 'op_id='.$this->getop_id();
                        $auth .= '&sid=' . $this->getServerId();
                        $auth .= '&game_id=' . $this->getGameId();
                        $auth .='&account=' . $this->getGameUserId();
                        $auth .='&time=' . time();
                        return base64_encode($auth);      
				}
				
				public function getLoginVerify()
				{
				        $verify = $this->getLoginAuth().$this->key;
						return md5($verify);
				}
                
				public function getPayAuth()
				{
						$auth = 'op_id='.$this->getop_id();
                        $auth .= '&sid=' . $this->getServerId();
                        $auth .= '&game_id=' . $this->getGameId();
                        $auth .='&account=' . $this->getGameUserId();
						$auth .='&order_id=' . $this->order['trade_sn'];
						$auth .='&game_money=' . $this->getMoney();
						$auth .='&u_money=' . $this->getMoney()/10;
						//$auth .='&game_money=50000';
						//$auth .='&u_money=5000';
                        $auth .='&time=' . time();
                        return base64_encode($auth);      
				}
				
				public function getPayVerify()
				{
				        $verify = $this->getPayAuth().$this->key;
						return md5($verify);
				}
				
                public function getPaySign()
                {
                        $sign = $this->getSpid();
                        $sign .= '|' . $this->getGameId();
                        $sign .= '|' . $this->getServerId();
                        $sign .='|' . $this->userid;
                        $sign .='|' . $this->order['trade_sn'];
                        $sign .='|' . $this->getMoney();
                        $sign .='|' . $this->order['ip'];
                        $sign .= '|' . $this->order['paytime'];
                        $sign .= '|' . $this->key;
                        return md5($sign);
                }

        }