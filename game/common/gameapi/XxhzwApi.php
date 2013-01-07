<?php

        class XxhzwApi extends GameApi
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
                        $payUrl = $this->server['server_pay_gateway'];
                        $payUrl .= '?userid=' . $this->getGameUserId();
                        $payUrl .= '&spid=' . $this->getSpid();
                        $payUrl .= '&gameid=' . $this->getGameId();
                        $payUrl .= '&serverid=' . $this->getServerId();
                        $payUrl .= '&orderid=' . $this->order['trade_sn'];
                        $payUrl .= '&money=' . $this->getMoney(); //必须要注意兑换的比例
                        $payUrl .= '&userip=' . $this->order['ip'];
                        $payUrl .= '&ctime=' . $this->order['paytime'];
                        $payUrl .= '&sign=' . $this->getPaySign();
                        
//                        $payUrl = Yii::app()->createAbsoluteUrl('order/test');
                        
                        $result = $this->getfopen($payUrl, 0, 1);

                        if ($result == 1000)
                        {
                                return TRUE;
                        }
                        else
                        { 
                                switch ($result)
                                {
                                        case 1008:
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
                        return $this->serverId;
                }

                public function getLoginSign()
                {
                        $sign = $this->getSpid();
                        $sign .= '|' . $this->getGameId();
                        $sign .= '|' . $this->getServerId();
                        $sign .='|' . $this->userid;
                        $sign .= '|' . $this->time;
                        $sign .= '|' . $this->isminor();
                        $sign .= '|' . $this->key;
                        return md5($sign);
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