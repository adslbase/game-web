<?php

        class GameApi
        {

                public $userid;
                public $time;
                public $server;
                public $order;

                public function __construct($server, $order = '')
                {
                        $this->server = $server;

                        $user = Yii::app()->getUser();
                        if (!empty($order))
                        {
                                $this->order = $order;
                                $connection = Yii::app()->db;
                                $sql = 'SELECT `user_id` FROM  `{{user}}` WHERE  `username`=:username ';
                                $command = $connection->createCommand($sql);
                                $userinfo = $command->queryRow(1,array(':username'=>$order['username']));
                                $this->userid = $userinfo['user_id'];
                        }
                        else if ($user->isGuest == false)
                        {
                                $this->userid = $user->id;
                        }
                        else
                        {
                                Yii::app()->request->redirect('sign/in');
                        }

                        $this->time = SYS_TIME;
                        $this->init();
                }

                public function init()
                {
                        
                }

                //获取游戏登陆用户名要urlencode
                public function getGameUserId()
                {
                        $userid = urlencode($this->userid);
                        return $userid;
                }

                public function isminor()
                {
                        $connection = Yii::app()->db;
                        $user = Yii::app()->getUser();
                        $userid = $user->id;
                        $sql = 'SELECT `sfzh` FROM  `{{user}}` WHERE  `user_id`= ' . $userid;
                        $command = $connection->createCommand($sql);
                        $userinfo = $command->queryRow();

                        $sfzh = $userinfo['sfzh'];

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

                //isminor值为2表通过实名验证未成年isminor值为1表通过实名验证且成年isminor值为0表未通过实名验证
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
                                        if ((SYS_TIME - mktime(0, 0, 0, $tmonth, $tday, $tyear)) > 18 * 365 * 24 * 60 * 60)
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
                                        if ((SYS_TIME - mktime(0, 0, 0, $tmonth, $tday, $tyear)) > 18 * 365 * 24 * 60 * 60)
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

                public function getfopen($url, $limit = 0, $post = '', $cookie = '', $bysocket = FALSE, $ip = '', $timeout = 15, $block = TRUE)
                {
						$return = '';
                        $matches = parse_url($url);
                        !isset($matches['host']) && $matches['host'] = '';
                        !isset($matches['path']) && $matches['path'] = '';
                        !isset($matches['query']) && $matches['query'] = '';
                        !isset($matches['port']) && $matches['port'] = '';
                        $host = $matches['host'];
                        $path = $matches['path'] ? $matches['path'] . ($matches['query'] ? '?' . $matches['query'] : '') : '/';
                        $port = !empty($matches['port']) ? $matches['port'] : 80;
                        if ($post)
                        {
                                $out = "POST $path HTTP/1.0\r\n";
                                $out .= "Accept: */*\r\n";
                                //$out .= "Referer: $boardurl\r\n";
                                $out .= "Accept-Language: zh-cn\r\n";
                                $out .= "Content-Type: application/x-www-form-urlencoded\r\n";
                                $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
                                $out .= "Host: $host\r\n";
                                $out .= 'Content-Length: ' . strlen($post) . "\r\n";
                                $out .= "Connection: Close\r\n";
                                $out .= "Cache-Control: no-cache\r\n";
                                $out .= "Cookie: $cookie\r\n\r\n";
                                $out .= $post;
                        }
                        else
                        {
                                $out = "GET $path HTTP/1.0\r\n";
                                $out .= "Accept: */*\r\n";
                                //$out .= "Referer: $boardurl\r\n";
                                $out .= "Accept-Language: zh-cn\r\n";
                                $out .= "User-Agent: $_SERVER[HTTP_USER_AGENT]\r\n";
                                $out .= "Host: $host\r\n";
                                $out .= "Connection: Close\r\n";
                                $out .= "Cookie: $cookie\r\n\r\n";
                        }

                        if (function_exists('fsockopen'))
                        {
								$fp = @fsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
                        }
                        elseif (function_exists('pfsockopen'))
                        {
								$fp = @pfsockopen(($ip ? $ip : $host), $port, $errno, $errstr, $timeout);
                        }
                        else
                        { 
						       $fp = false;
                        }

                        if (!$fp)
                        {
								return '';
                        }
                        else
                        {
                                stream_set_blocking($fp, $block);
                                stream_set_timeout($fp, $timeout);
                                @fwrite($fp, $out);
                                $status = stream_get_meta_data($fp);
                                if (!$status['timed_out'])
                                {
                                        while (!feof($fp))
                                        {
                                                if (($header = @fgets($fp)) && ($header == "\r\n" || $header == "\n"))
                                                {
                                                        break;
                                                }
                                        }

                                        $stop = false;
                                        while (!feof($fp) && !$stop)
                                        {
                                                $data = fread($fp, ($limit == 0 || $limit > 8192 ? 8192 : $limit));
                                                $return .= $data;
                                                if ($limit)
                                                {
                                                        $limit -= strlen($data);
                                                        $stop = $limit <= 0;
                                                }
                                        }
                                }
                                @fclose($fp);
                                return $return;
                        }
                }

        }