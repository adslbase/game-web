<?php

        class Heepay extends Payment
        {

                const GATEWAY_URL = 'http://www.heepay.com/Payment/Index.aspx';
                const GATEWAY_METHOD = 'POST';

                public function __construct($config = array())
                {
                        if (!empty($config))
                                $this->setConfig($config);

                        $this->config['return_url'] = Yii::app()->createAbsoluteUrl('order/return', array('code' => 'heepay'));
						$this->config['notify_url'] = Yii::app()->createAbsoluteUrl('order/notify', array('code' => 'heepay'));
                }

                public function getGatewayUrl()
                {
                        return self::GATEWAY_URL;
                }

                public function getpreparedata()
                {
                        $prepareData = array();
                        //$prepareData['v_mid'] = $this->config['pay_account'];
                        $prepareData['version'] = '1';
						$prepareData['agent_id'] = '1572192';
						$prepareData['agent_bill_id'] = $this->orderInfo['id'];
						$date_time=date("Ymdhis",time());
						$prepareData['agent_bill_time'] = $date_time;
						$prepareData['pay_type'] = '0';
						$prepareData['pay_amt'] = $this->productInfo['price'];
						$prepareData['notify_url'] = $this->config['notify_url'];
                        $prepareData['return_url'] = $this->config['return_url'];						
						$prepareData['user_ip'] = $_SERVER["REMOTE_ADDR"];						
						$prepareData['goods_name'] = "111";
						$prepareData['remark'] = $this->orderInfo['id'];

						$key="FDC6E0D69D3143448B340F4E";					
                        // 数字签名
                        /*echo $data = "version=".$prepareData['version'] . "&" . 
						"agent_id=".$prepareData['agent_id'] . "&" . 
						"agent_bill_id=".$prepareData['agent_bill_id'] . "&" . 
						"agent_bill_time=".$prepareData['agent_bill_time'] . "&" . 
						"pay_type=".$prepareData['pay_type'] . "&" . 						
						"pay_amt=".$prepareData['pay_amt'] . "&" . 
						"notify_url=".$prepareData['notify_url'] . "&" . 
						"return_url=".$prepareData['return_url'] . "&" . 						
						"user_ip=".$prepareData['user_ip'] . "&" . 
						"goods_name=111&" . 
						"remark=".$prepareData['remark'] . "&" . 
						"is_test=".$prepareData['is_test'] . "&" .
						"key=".$key;
						//$prepareData['q']=$data;
                        $prepareData['sign'] = strtolower(md5($data));
						$prepareData['sign1'] = md5($data);
//"version=1&pay_type=0&agent_id=1572192&agent_bill_id=2012101710341475140&pay_amt=0.1&return_url=http://game.marstv.cn/order/return.html?code=heepay&notify_url=http://game.marstv.cn/order/notify.html?code=heepay&user_ip=192.168.0.75&agent_bill_time=20121017111206&goods_name=小小海贼王-MarsTV 双线一服&remark=2012101710341475140&is_test=1&key=FDC6E0D69D3143448B340F4E"
                        //其他*/
                         
						$sign='';
						$signStr='';
						$signStr  = $signStr . 'version=' . $prepareData['version'];
						$signStr  = $signStr . '&agent_id=' . $prepareData['agent_id'];
						$signStr  = $signStr . '&agent_bill_id=' . $prepareData['agent_bill_id'];
						$signStr  = $signStr . '&agent_bill_time=' . $prepareData['agent_bill_time'];
						$signStr  = $signStr . '&pay_type=' . $prepareData['pay_type'];
						$signStr  = $signStr . '&pay_amt=' . $prepareData['pay_amt'];
						$signStr  = $signStr . '&notify_url=' . $prepareData['notify_url'];
						$signStr  = $signStr . '&return_url=' . $prepareData['return_url'];
						$signStr  = $signStr . '&user_ip=' . $prepareData['user_ip'];
						
						$signStr = $signStr . '&key=' . $key;
						
						$prepareData['sign']=strtolower(md5($signStr));
						 
						 
                        return $prepareData;
                }

                /**
                 * GET接收数据
                 * 状态码说明  （0 交易完成 1 交易失败 2 交易超时 3 交易处理中 4 交易未支付）
                 */
                public function receive()
                {
                        $receive_data = $this->filterParameter($_POST);
                        if ($receive_data)
                        {
                                $v_oid = trim($receive_data['v_oid']);
                                $v_pmode = trim($receive_data['v_pmode']);
                                $v_pstatus = trim($receive_data['v_pstatus']);
                                $v_pstring = trim($receive_data['v_pstring']);
                                $v_amount = trim($receive_data['v_amount']);
                                $v_moneytype = trim($receive_data['v_moneytype']);
                                $remark1 = trim($receive_data['remark1']);
                                $remark2 = trim($receive_data['remark2']);
                                $v_md5str = trim($receive_data['v_md5str']);

                                $md5string = strtoupper(md5($v_oid . $v_pstatus . $v_amount . $v_moneytype . $this->config['chinabank_key']));
                                if ($v_md5str == $md5string)
                                {
                                        $return_data['trade_sn'] = $v_oid;
                                        $return_data['money'] = $v_amount;

                                        if ($v_pstatus == "20")
                                        {
                                                $return_data['order_status'] = 1;
                                        }
                                        else
                                        {
                                                $return_data['order_status'] = 3;
                                        }
                                        return $return_data;
                                }
                        }

                        return false;
                }

                /**
                 * POST接收数据
                 * 状态码说明  （ 1 已交易 2 交易超时 3 交易失败 ）
                 */
                public function notify()
                {
                        $receive_data = $this->filterParameter($_POST);
                        if ($receive_data)
                        {
                                $v_oid = trim($receive_data['v_oid']);
                                $v_pmode = trim($receive_data['v_pmode']);
                                $v_pstatus = trim($receive_data['v_pstatus']);
                                $v_pstring = trim($receive_data['v_pstring']);
                                $v_amount = trim($receive_data['v_amount']);
                                $v_moneytype = trim($receive_data['v_moneytype']);
                                $remark1 = trim($receive_data['remark1']);
                                $remark2 = trim($receive_data['remark2']);
                                $v_md5str = trim($receive_data['v_md5str']);

                                $md5string = strtoupper(md5($v_oid . $v_pstatus . $v_amount . $v_moneytype . $this->config['chinabank_key']));
                                if ($v_md5str == $md5string)
                                {
                                        $return_data['trade_sn'] = $v_oid;
                                        $return_data['money'] = $v_amount;

                                        if ($v_pstatus == "20")
                                        {
                                                $return_data['order_status'] = 1;
                                        }
                                        else
                                        {
                                                $return_data['order_status'] = 3;
                                        }
                                        return $return_data;
                                }
                        }
                        return false;
                }

                /**
                 * 相应服务器应答状态
                 * @param $result
                 */
                public function response($result)
                {
                        if (FALSE == $result)
                                echo 'error';
                        else
                                echo 'ok';
                }

                /**
                 * 返回字符过滤
                 * @param $parameter
                 */
                private function filterParameter($parameter)
                {
                        $para = array();
                        foreach ($parameter as $key => $value)
                        {
                                if ('sign' == $key || 'sign_type' == $key || '' == $value || 'code' == $key)
                                        continue;
                                else
                                        $para[$key] = $value;
                        }
                        return $para;
                }

        }

?>