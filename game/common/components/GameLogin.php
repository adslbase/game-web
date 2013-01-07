<?php

        class GameLogin
        {

                public $user;
                public $time;
                public $server;

                public function __construct($server)
                {
                        $this->server = $server;
                        
                        $this->user = User::model()->findByPk(user()->id);
                        $this->time = time();
                        $this->init();
                }

                public function init()
                {
                        
                }

                public function getGameUserId()
                {
                        $userid = urlencode($this->user->username);

                        return $userid;
                }

                public function isminor()
                {
                        $sfzh = $this->user->sfzh;

                        if (empty($sfzh))
                        {
                                return 0;
                        }
                        else
                        {
                                $flag = $this->getIDCardInfo($sfzh);
                                return $flag;
                        }
                }

                public function getIDCardInfo($IDCard)
                {
                        if (strlen($IDCard) == 18)
                        {
                                $tyear = intval(substr($IDCard, 6, 4));
                                $tmonth = intval(substr($IDCard, 10, 2));
                                $tday = intval(substr($IDCard, 12, 2));

                                if ($tyear > date("Y") || $tyear < (date("Y") - 100))
                                {
                                        $flag = 0;
                                }
                                elseif ($tmonth < 0 || $tmonth > 12)
                                {
                                        $flag = 0;
                                }
                                elseif ($tday < 0 || $tday > 31)
                                {
                                        $flag = 0;
                                }
                                else
                                {
                                        $tdate = $tyear . "-" . $tmonth . "-" . $tday . " 00:00:00";
                                        if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) > 18 * 365 * 24 * 60 * 60)
                                        {
                                                $flag = 1;
                                        }
                                        else
                                        {
                                                $flag = 2;
                                        }
                                }
                        }
                        elseif (strlen($IDCard) == 15)
                        {
                                $tyear = intval("19" . substr($IDCard, 6, 2));
                                $tmonth = intval(substr($IDCard, 8, 2));
                                $tday = intval(substr($IDCard, 10, 2));
                                if ($tyear > date("Y") || $tyear < (date("Y") - 100))
                                {
                                        $flag = 0;
                                }
                                elseif ($tmonth < 0 || $tmonth > 12)
                                {
                                        $flag = 0;
                                }
                                elseif ($tday < 0 || $tday > 31)
                                {
                                        $flag = 0;
                                }
                                else
                                {
                                        $tdate = $tyear . "-" . $tmonth . "-" . $tday . " 00:00:00";
                                        if ((time() - mktime(0, 0, 0, $tmonth, $tday, $tyear)) > 18 * 365 * 24 * 60 * 60)
                                        {
                                                $flag = 1;
                                        }
                                        else
                                        {
                                                $flag = 2;
                                        }
                                }
                        }
                        return $flag;
                }

        }