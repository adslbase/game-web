<?php

        abstract class Payment
        {
                protected $config = array();
                protected $productInfo = array();
                protected $customterInfo = array();
                protected $orderInfo = array();
                protected $shippingInfo = array();

                public function setConfig($config)
                {
                        foreach ($config as $key => $value)
                                $this->config[$key] = $value;
                        return $this;
                }

                public function setProductinfo($product_info)
                {
                        $this->productInfo = $product_info;
                        return $this;
                }

                public function setCustomerinfo($customer_info)
                {
                        $this->customerInfo = $customer_info;
                        return $this;
                }

                public function setOrderinfo($order_info)
                {
                        $this->orderInfo = $order_info;
                        return $this;
                }

                public function setShippinginfo($shipping_info)
                {
                        $this->shippingInfo = $shipping_info;
                        return $this;
                }

                public function getCode()
                {
                        $str = '';
                        
                        $prepare_data = $this->getpreparedata();
                        foreach ($prepare_data as $key => $value)
                                $str .= '<input type="hidden" name="' . $key . '" value="' . $value . '" />';
                        return $str;
                }
        
                abstract public function receive();

                abstract public function notify();

                abstract public function response($result);

                abstract public function getPrepareData();
        }
