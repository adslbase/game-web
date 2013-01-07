<?php

        class PaywaysBlock extends MWidget
        {

                public $order;

                public function run()
                {
                        $this->renderContent();
                }

                protected function renderContent()
                {
                        $payways = FrontCache::getPayways();
                        $payway = $payways[$this->order['pay_id']];
                        $gameid = $this->order['gameid'];
                        $server = $this->order['serverid'];
                        $paywayId = $this->order['pay_id'];

                        $this->render($this->template, array(
                                    'payways' => $payways,
                                    'payway' => $payway,
                                    'gameid' => $gameid,
                                    'server' => $server,
                                    'paywayId' => $paywayId
                        ));
                }

        }