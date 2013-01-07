<?php

        class Chinabank extends Payment
        {

                const GATEWAY_URL = 'https://pay3.chinabank.com.cn/PayGate';
                const GATEWAY_METHOD = 'POST';

                public function __construct($config = array())
                {
                        if (!empty($config))
                                $this->setConfig($config);

                        $this->config['return_url'] = Yii::app()->createAbsoluteUrl('order/return', array('code' => 'chinabank'));
                }

                public function getGatewayUrl()
                {
                        return self::GATEWAY_URL;
                }

                public function getpreparedata()
                {
                        $prepareData = array();
                        $prepareData['v_mid'] = $this->config['pay_account'];
                        $prepareData['v_oid'] = $this->orderInfo['id'];
                        $prepareData['v_amount'] = $this->productInfo['price'];
                        $prepareData['v_moneytype'] = 'CNY';
                        $prepareData['v_url'] = $this->config['return_url'];
                        // 数字签名
                        $data = $prepareData['v_amount'] . $prepareData['v_moneytype'] . $prepareData['v_oid'] . $prepareData['v_mid'] . $prepareData['v_url'] . $this->config['chinabank_key'];
                        $prepareData['v_md5info'] = strtoupper(md5($data));

                        //其他
                        $prepareData['return_url'] = $this->config['return_url'];
                        $prepareData['v_rcvname'] = $this->customerInfo['name'];
                        $prepareData['remark1'] = $this->productInfo['body'];
                        $prepareData['remark2'] = $this->productInfo['name'];
                        $prepareData['v_rcvemail'] = $this->customerInfo['email'];

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