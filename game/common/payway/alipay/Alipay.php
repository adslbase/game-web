<?php

        class Alipay extends Payment
        {

                const GATEWAY_URL = 'https://mapi.alipay.com/gateway.do?_input_charset=utf-8';
                const GATEWAY_METHOD = 'POST';

                public $https_verify_url = 'https://mapi.alipay.com/gateway.do?service=notify_verify&';
                public $http_verify_url = 'http://notify.alipay.com/trade/notify_query.do?';

                public function __construct($config = array())
                {
                        if (!empty($config))
                                $this->setConfig($config);

                        if ($this->config['service_type'] == 1)
                                $this->config['service'] = 'trade_create_by_buyer';
                        elseif ($this->config['service_type'] == 2)
                                $this->config['service'] = 'create_partner_trade_by_buyer';
                        else
                                $this->config['service'] = 'create_direct_pay_by_user';


                        $this->config['notify_url'] = Yii::app()->createAbsoluteUrl('order/notify', array('code' => 'alipay'));
                        $this->config['return_url'] = Yii::app()->createAbsoluteUrl('order/return', array('code' => 'alipay'));

                        $this->config['sign_type'] = 'MD5';
                        $this->config['input_charset'] = 'utf-8';
                        $this->config['transport'] = 'http';

                        require 'lib/alipay_core.function.php';
                }

                public function getGatewayUrl()
                {
                        return self::GATEWAY_URL;
                }

                public function getpreparedata()
                {
                        $prepareData = array();

                        $prepareData['service'] = $this->config['service'];
                        $prepareData['payment_type'] = '1';

                        $prepareData['partner'] = trim($this->config['alipay_partner']);
                        $prepareData['_input_charset'] = trim($this->config['input_charset']);
                        $prepareData['seller_email'] = trim($this->config['pay_account']);
                        $prepareData['return_url'] = trim($this->config['return_url']);
                        $prepareData['notify_url'] = $this->config['notify_url'];

                        $prepareData['out_trade_no'] = $this->orderInfo['id'];
                        $prepareData['subject'] = $this->productInfo['name'];
                        $prepareData['body'] = $this->productInfo['body'];
                        $prepareData['total_fee'] = $this->productInfo['price'];

//                        $prepareData['paymethod'] = '';
//                        $prepareData['defaultbank'] = '';
//                        $prepareData['anti_phishing_key'] = '';
//                        $prepareData['exter_invoke_ip'] = '';
//                        $prepareData['show_url'] = '';
//                        $prepareData['extra_common_param'] = '';           
//                        $prepareData["royalty_type"] = '';
//                        $prepareData["royalty_parameters"] = '';
                        //买家信息
                        $prepareData['buyer_email'] = $this->customerInfo['email'];

                        //签名结果与签名方式加入请求提交参数组中
                        $prepareData['sign'] = $this->getMysign($prepareData);
                        $prepareData['sign_type'] = strtoupper(trim($this->config['sign_type']));

                        return $prepareData;
                }

                /**
                 * GET接收数据
                 * 状态码说明  （0 交易完成 1 交易失败 2 交易超时 3 交易处理中 4 交易未支付）
                 */
                public function receive()
                {
                        if (empty($_GET))
                        {
                                return false;
                        }
                        else
                        {
                                //生成签名结果
                                $mysign = $this->getMysign($_GET);
                                //获取支付宝远程服务器ATN结果（验证是否是支付宝发来的消息）
                                $responseTxt = 'true';
                                if (!empty($_GET["notify_id"]))
                                {
                                        $responseTxt = $this->getResponse($_GET["notify_id"]);
                                }

                                //写日志记录
//                                $log_text = "responseTxt=" . $responseTxt . "\n notify_url_log:sign=" . $_GET["sign"] . "&mysign=" . $mysign . ",";
//                                $log_text = $log_text . createLinkString($_GET);
//                                logResult($log_text);
                                //验证
                                //$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
                                //mysign与sign不等，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
                                if (preg_match("/true$/i", $responseTxt) && $mysign == $_GET["sign"])
                                {
                                        $return_data['trade_sn'] = $_GET['out_trade_no'];
                                        $return_data['money'] = $_GET['total_fee'];

                                        if ($_GET['trade_status'] == 'TRADE_SUCCESS' || $_GET['trade_status'] == 'TRADE_FINISHED')
                                        {
                                                $return_data['order_status'] = 1;
                                        }
                                        else
                                        {
                                                $return_data['order_status'] = 3;
                                        }
                                     
                                        return $return_data;
                                }
                                else
                                {
                                        return false;
                                }
                        }
                }

                /**
                 * POST接收数据
                 * 状态码说明  （0 交易完成 1 交易失败 2 交易超时 3 交易处理中 4 交易未支付 5交易取消6交易发生错误）
                 */
                public function notify()
                {
                        if (empty($_POST))
                        {//判断POST来的数组是否为空
                                return false;
                        }
                        else
                        {
                                //生成签名结果
                                $mysign = $this->getMysign($_POST);
                                //获取支付宝远程服务器ATN结果（验证是否是支付宝发来的消息）
                                $responseTxt = 'true';
                                if (!empty($_POST["notify_id"]))
                                {
                                        $responseTxt = $this->getResponse($_POST["notify_id"]);
                                }

                                //写日志记录
                                $log_text = "responseTxt=" . $responseTxt . "\n notify_url_log:sign=" . $_POST["sign"] . "&mysign=" . $mysign . ",";
                                $log_text = $log_text . createLinkString($_POST);
                                logResult($log_text);
                                //验证
                                //$responsetTxt的结果不是true，与服务器设置问题、合作身份者ID、notify_id一分钟失效有关
                                //mysign与sign不等，与安全校验码、请求时的参数格式（如：带自定义参数等）、编码格式有关
                                if (preg_match("/true$/i", $responseTxt) && $mysign == $_POST["sign"])
                                {
                                        $return_data['trade_sn'] = $_POST['out_trade_no'];
                                        $return_data['money'] = $_POST['total_fee'];

                                        if ($_POST['trade_status'] == 'TRADE_SUCCESS' || $_POST['trade_status'] == 'TRADE_FINISHED')
                                        {
                                                $return_data['order_status'] = 1;
                                        }
                                        else
                                        {
                                                $return_data['order_status'] = 3;
                                        }

                                        return $return_data;
                                }
                                else
                                {
                                        return false;
                                }
                        }
                }

                /**
                 * 相应服务器应答状态
                 * @param $result
                 */
                public function response($result)
                {
                        if (FALSE == $result)
                                echo 'fail';
                        else
                                echo 'success';
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

                /**
                 * 根据反馈回来的信息，生成签名结果
                 * @param $para_temp 通知返回来的参数数组
                 * @return 生成的签名结果
                 */
                function getMysign($para_temp)
                {
                        //除去待签名参数数组中的空值和签名参数
                        $para_filter = $this->filterParameter($para_temp);

                        //对待签名参数数组排序
                        $para_sort = argSort($para_filter);

                        //生成签名结果
                        $mysign = buildMysign($para_sort, trim($this->config['alipay_key']), strtoupper(trim($this->config['sign_type'])));

                        return $mysign;
                }

                /**
                 * 获取远程服务器ATN结果,验证返回URL
                 * @param $notify_id 通知校验ID
                 * @return 服务器ATN结果
                 * 验证结果集：
                 * invalid命令参数不对 出现这个错误，请检测返回处理中partner和key是否为空 
                 * true 返回正确信息
                 * false 请检查防火墙或者是服务器阻止端口问题以及验证时间是否超过一分钟
                 */
                private function getResponse($notify_id)
                {
                        $transport = strtolower(trim($this->config['transport']));
                        $partner = trim($this->config['alipay_partner']);
                        $veryfy_url = '';
                        if ($transport == 'https')
                        {
                                $veryfy_url = $this->https_verify_url;
                        }
                        else
                        {
                                $veryfy_url = $this->http_verify_url;
                        }
                        $veryfy_url = $veryfy_url . "partner=" . $partner . "&notify_id=" . $notify_id;
                        $responseTxt = getHttpResponse($veryfy_url);

                        return $responseTxt;
                }

        }

?>