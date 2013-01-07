<?php

        /**
         *      [Discuz!] (C)2001-2099 Comsenz Inc.
         *      This is NOT a freeware, use is subject to license terms
         *
         *      $Id: uc.php 25684 2011-11-17 08:45:40Z monkey $
         */
        error_reporting(0);

        define('UC_CLIENT_VERSION', '1.6.0');
        define('UC_CLIENT_RELEASE', '20110501');

        define('API_DELETEUSER', 1);
        define('API_RENAMEUSER', 1);
        define('API_GETTAG', 1);
        define('API_SYNLOGIN', 1);
        define('API_SYNLOGOUT', 1);
        define('API_UPDATEPW', 1);
        define('API_UPDATEBADWORDS', 1);
        define('API_UPDATEHOSTS', 1);
        define('API_UPDATEAPPS', 1);
        define('API_UPDATECLIENT', 1);
        define('API_UPDATECREDIT', 1);
        define('API_GETCREDIT', 1);
        define('API_GETCREDITSETTINGS', 1);
        define('API_UPDATECREDITSETTINGS', 1);
        define('API_ADDFEED', 1);
        define('API_RETURN_SUCCEED', '1');
        define('API_RETURN_FAILED', '-1');
        define('API_RETURN_FORBIDDEN', '1');

        @define('IN_API', true);
        @define('CURSCRIPT', 'api');


        if (!defined('IN_UC'))
        {

                define('COMMON_FOLDER', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'common');
                define('FRONT_STORE', dirname(dirname(dirname(__FILE__))) . DIRECTORY_SEPARATOR . 'frontend');

                define('YII_DEBUG', 1);

                // change the following paths if necessary
                $yii = COMMON_FOLDER . '/yii/framework/yii.php';
                $globals = COMMON_FOLDER . '/globals.php';
                $define = COMMON_FOLDER . '/define.php';
                $config = FRONT_STORE . '/protected/config/main.php';

                require_once($yii);
                require_once($globals);
                require_once($define);

                require COMMON_FOLDER . '/ucenter.config.php';

                Yii::createWebApplication($config);

                $get = $post = array();

                $code = @$_GET['code'];
                parse_str(authcode($code, 'DECODE', UC_KEY), $get);

                if (time() - $get['time'] > 3600)
                {
                        exit('Authracation has expiried');
                }
                if (empty($get))
                {
                        exit('Invalid Request');
                }
                include_once COMMON_FOLDER . '/uc_client/lib/xml.class.php';
                $post = xml_unserialize(file_get_contents('php://input'));

                if (in_array($get['action'], array('test', 'deleteuser', 'renameuser', 'gettag', 'synlogin', 'synlogout', 'updatepw', 'updatebadwords', 'updatehosts', 'updateapps', 'updateclient', 'updatecredit', 'getcredit', 'getcreditsettings', 'updatecreditsettings', 'addfeed')))
                {
                        $uc_note = new uc_note();
                        echo $uc_note->$get['action']($get, $post);
                        exit();
                }
                else
                {
                        exit(API_RETURN_FAILED);
                }
        }
        else
        {
                exit;
        }

        class uc_note
        {

                var $dbconfig = '';
                var $db = '';
                var $tablepre = '';
                var $appdir = '';

                function _serialize($arr, $htmlon = 0)
                {
                        if (!function_exists('xml_serialize'))
                        {
                                include_once COMMON_FOLDER . '/uc_client/lib/xml.class.php';
                        }
                        return xml_serialize($arr, $htmlon);
                }

                function uc_note()
                {
                        
                }

                //可用
                function test($get, $post)
                {
                        return API_RETURN_SUCCEED;
                }

                //不可用
                function deleteuser($get, $post)
                {

                        if (!API_DELETEUSER)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $uids = str_replace("'", '', stripslashes($get['ids']));
                        $ids = array();

                        $db = Yii::app()->getDb();
                        $sql = "SELECT `uid` FROM {{member}} WHERE uid IN ($uids)";
                        $command = $db->createCommand($sql);
                        $result = $command->queryAll();

                        foreach ($result as $row)
                        {
                                $ids[] = $row['uid'];
                        }

                        $modelUser = new User();
                        $ids && $modelUser->deleteByIds($ids);
                        return API_RETURN_SUCCEED;
                }

                //不可用
                function renameuser($get, $post)
                {
                        if (!API_RENAMEUSER)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $tables = array(
                                    'member' => array('uid' => 'uid', 'name' => 'username'),
                                    'creditlog' => array('uid' => 'uid', 'name' => 'username'),
                                    'order' => array('uid' => 'uid', 'name' => 'username'),
                        );

                        $db = Yii::app()->getDb();

                        foreach ($tables as $table => $conf)
                        {
                                $sql = "UPDATE {{" . $table . "}} SET `$conf[name]`='$get[newusername]' WHERE `$conf[uid]`='$get[uid]' AND `$conf[name]`='$get[oldusername]'";
                                $command = $db->createCommand($sql);
                                $command->execute();
                        }
                        return API_RETURN_SUCCEED;
                }

                function gettag($get, $post)
                {

                        if (!API_GETTAG)
                        {
                                return API_RETURN_FORBIDDEN;
                        }
                        return $this->_serialize(array($get['id'], array()), 1);
                }

                //可用
                function synlogin($get, $post)
                {
                        if (!API_SYNLOGIN)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');

                        $uid = intval($get['uid']);
                        list($uid, $username, $email) = UcenterApi::getInstance()->getUser($uid, 1);

                        $user = User::model()->find('user_id=:id', array(':id' => $uid));
                        if ($user->user_id > 0)
                        {
                                $identity = new UserIdentityDb();
                                $identity->id = $user->user_id;
                                $identity->username = $username;
                                $identity->setPersistentStates(array(
                                            'recent_login' => $user->recent_login,
                                            'loginip' => $user->loginip,
                                            'username' => $user->username,
                                                )
                                );

                                //ucenter默认没有email修改api。可以在这里进行对比。然后将用户email修改
                                if ($user->email !== $email)
                                {
                                        Yii::app()->db->createCommand()->update('{{user}}', array(
                                                    'email' => $email,
                                                        ), 'user_id=:id', array(':id' => $uid)); //确定表中其他地方没有email字段，否则要更新其他字段
                                }

                                Yii::app()->user->login($identity, Yii::app()->getUser()->getState('duration'));
                        }
                }

                //可用
                function synlogout($get, $post)
                {
                        if (!API_SYNLOGOUT)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        header('P3P: CP="CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR"');

                        Yii::app()->user->logout();
                }

                //可用
                function updatepw($get, $post)
                {
                        if (!API_UPDATEPW)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $username = $get['username'];
                        $newpw = md5(time() . rand(100000, 999999));
                        $db = Yii::app()->getDb();
                        $sql = "UPDATE {{user}} SET password='$newpw' WHERE username='$username'";
                        $command = $db->createCommand($sql);
                        $command->execute();

                        return API_RETURN_SUCCEED;
                }

                //可用
                function updatebadwords($get, $post)
                {

                        if (!API_UPDATEBADWORDS)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $data = array();
                        if (is_array($post))
                        {
                                foreach ($post as $k => $v)
                                {
                                        $data['findpattern'][$k] = $v['findpattern'];
                                        $data['replace'][$k] = $v['replacement'];
                                }
                        }
                        $cachefile = COMMON_FOLDER . '/uc_client/data/cache/badwords.php';
                        $fp = fopen($cachefile, 'w');
                        $s = "<?php\r\n";
                        $s .= '$_CACHE[\'badwords\'] = ' . var_export($data, TRUE) . ";\r\n";
                        fwrite($fp, $s);
                        fclose($fp);

                        return API_RETURN_SUCCEED;
                }

                //可用
                function updatehosts($get, $post)
                {
                        if (!API_UPDATEHOSTS)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $cachefile = COMMON_FOLDER . '/uc_client/data/cache/hosts.php';
                        $fp = fopen($cachefile, 'w');
                        $s = "<?php\r\n";
                        $s .= '$_CACHE[\'hosts\'] = ' . var_export($post, TRUE) . ";\r\n";
                        fwrite($fp, $s);
                        fclose($fp);

                        return API_RETURN_SUCCEED;
                }

                //可用
                function updateapps($get, $post)
                {
                        if (!API_UPDATEAPPS)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $UC_API = '';
                        if ($post['UC_API'])
                        {
                                $UC_API = $post['UC_API'];
                                unset($post['UC_API']);
                        }

                        $cachefile = COMMON_FOLDER . '/uc_client/data/cache/apps.php';
                        $fp = fopen($cachefile, 'w');
                        $s = "<?php\r\n";
                        $s .= '$_CACHE[\'apps\'] = ' . var_export($post, TRUE) . ";\r\n";
                        fwrite($fp, $s);
                        fclose($fp);

                        if ($UC_API && is_writeable(COMMON_FOLDER . '/protected/config/ucenter.config.php'))
                        {
                                if (preg_match('/^https?:\/\//is', $UC_API))
                                {
                                        $configfile = trim(file_get_contents(COMMON_FOLDER . '/protected/config/ucenter.config.php'));
                                        $configfile = substr($configfile, -2) == '?>' ? substr($configfile, 0, -2) : $configfile;
                                        $configfile = preg_replace("/define\('UC_API',\s*'.*?'\);/i", "define('UC_API', '" . addslashes($UC_API) . "');", $configfile);
                                        if (($fp = @fopen(COMMON_FOLDER . '/protected/config/ucenter.config.php', 'w')))
                                        {
                                                @fwrite($fp, trim($configfile));
                                                @fclose($fp);
                                        }
                                }
                        }
                        return API_RETURN_SUCCEED;
                }

                //可用
                function updateclient($get, $post)
                {
                        if (!API_UPDATECLIENT)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $cachefile = COMMON_FOLDER . '/uc_client/data/cache/settings.php';
                        $fp = fopen($cachefile, 'w');
                        $s = "<?php\r\n";
                        $s .= '$_CACHE[\'settings\'] = ' . var_export($post, TRUE) . ";\r\n";
                        fwrite($fp, $s);
                        fclose($fp);

                        return API_RETURN_SUCCEED;
                }

                //可用
                function updatecredit($get, $post)
                {
                        if (!API_UPDATECREDIT)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        return API_RETURN_SUCCEED;
                }

                //可用
                function getcredit($get, $post)
                {
                        if (!API_GETCREDIT)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $modelCredit = UserCredit::model();

                        $modelCredit->uid = intval($get['uid']);
                        $modelCredit->credit_id = intval($get['credit']);
                        $row = $modelCredit->findByAttributes();
                        return $row['value'];
                }

                //可用
                function getcreditsettings($get, $post)
                {
                        if (!API_GETCREDITSETTINGS)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $modelCredit = new Credit();

                        $credits = $modelCredit->getCreditSettings();

                        return $this->_serialize($credits);
                }

                //可用
                function updatecreditsettings($get, $post)
                {
                        if (!API_UPDATECREDITSETTINGS)
                        {
                                return API_RETURN_FORBIDDEN;
                        }

                        $outextcredits = array();
                        foreach ($get['credit'] as $appid => $credititems)
                        {
                                if ($appid == UC_APPID)
                                {
                                        foreach ($credititems as $value)
                                        {
                                                $outextcredits[$value['creditsrc']][$value['appiddesc'] . '|' . $value['creditdesc']] = array(
                                                            'appiddesc' => $value['appiddesc'],
                                                            'creditdesc' => $value['creditdesc'],
                                                            'creditsrc' => $value['creditsrc'],
                                                            'title' => $value['title'],
                                                            'unit' => $value['unit'],
                                                            'ratiosrc' => $value['ratiosrc'],
                                                            'ratiodesc' => $value['ratiodesc'],
                                                            'ratio' => $value['ratio']
                                                );
                                        }
                                }
                        }

                        $cachefile = COMMON_FOLDER . '/uc_client/data/cache/creditsettings.php';
                        $fp = fopen($cachefile, 'w');
                        $s = "<?php\r\n";
                        $s .= '$_CACHE[\'creditsettings\'] = ' . var_export($outextcredits, TRUE) . ";\r\n";
                        fwrite($fp, $s);
                        fclose($fp);

                        return API_RETURN_SUCCEED;
                }

                function addfeed($get, $post)
                {


                        if (!API_ADDFEED)
                        {
                                return API_RETURN_FORBIDDEN;
                        }
                        return API_RETURN_SUCCEED;
                }

        }