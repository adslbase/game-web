<?php
        class LysgApi extends GameApi
        {

                public $key;
                public $serverId;

                public function init()
                {
						$this->serverId = $this->server['object_id']; //非object_id，是联运服务器id
                        $this->key = $this->server['server_key'];
                }

                public function login()
                {
                        $loginUrl = $this->server['server_login_gateway'];
                        $loginUrl .= '?userid=' . $this->getGameUserId();
                        $loginUrl .= '&spid=' . $this->getSpid();
                        $loginUrl .= '&gameid=' . $this->getGameId();
                        $loginUrl .= '&serverid=' . $this->getServerId();
                        $loginUrl .= '&ltime=' . $this->time;
                        $loginUrl .= '&isminor=' . $this->isminor();
                        $loginUrl .= '&sign=' . $this->getLoginSign();
                        return $loginUrl;
                }

                public function charge()
                {
						$user = Yii::app()->getUser();
						$username=urlencode($this->userid);
						$payUrl = $this->server['server_pay_gateway'];
						$payUrl .= '?paysn=' . $this->order['trade_sn'];
                        $payUrl .= '&uid=' . $this->userid;
						$payUrl .= '&uname=' . $username;
						$payUrl .= '&sid=' . $this->getServerId();
                        $payUrl .= '&domain=' . $this->getDomain();
						$payUrl .= '&money=' . $this->getMoney();//必须要注意兑换的比例
                        $payUrl .= '&unid=' . $this->getUnId();
                        $payUrl .= '&sign=' . $this->getPaySign();
						//$payUrl;
//                        $payUrl = Yii::app()->createAbsoluteUrl('order/test');                       
                        $result = $this->getfopen($payUrl, 0, 1);
                        if ($result == 01)
                        {
                                return TRUE;
                        }
                        else
                        { 
								switch ($result)
                                {
									    
										case 08:
                                                $message = '未授权IP';
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
                        $money =  $this->order['money'];
                        
                        return $money;
                }

                public function getSpid()
                {
                        return 'marstv';
                }

                public function getGameId()
                {
                        return 2;
                }

                public function getServerId()
                {
						//return $this->serverId;
						return 1;
                }
				
				public function getDomain()
                {
                        return 's1sgs.marstv.96wan.com';
                }
                
				public function getUnId()
				{
				        return 12;
				}
				
				public function getKey()
				{
				        return '96f6cc67a3904175c951961bc9d5ccb8';
				}
				
                public function getLoginSign()
                {
                        $sign = $this->getSpid();
                        $sign .= '|' . $this->getGameId();
                        $sign .= '|' . $this->getServerId();
                        $sign .='|' . $this->userid;
                        $sign .= '|' . $this->time;
                        $sign .= '|' . $this->isminor();
                        $sign .= '|' . $this->key();
                        return md5($sign);
                }

                public function getPaySign()
                {
                        $user = Yii::app()->getUser();
						$sign = 'paysn='.$this->order['trade_sn'];
                        $sign .= '&uid=' . $this->userid;
                        $sign .= '&uname=' . $this->userid;
                        $sign .='&sid=' . $this->getServerId();
                        $sign .='&domain=' . $this->getDomain();
                        $sign .='&money=' . $this->getMoney();
                        $sign .='&unid=' . $this->getUnId();
                        $sign .= '&key=' . $this->getKey();
                        return md5($sign);
                }

        }