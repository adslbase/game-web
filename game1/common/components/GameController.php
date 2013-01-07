<?php

        class GameController extends FeController
        {
                public $gameid = 0;
                public $layout = '//xxhzw/main';
                public $xwid = 13;
                public $glid = 12;
                public $game;
                public $payUrl='';

                public function init()
                {
                        if ($this->gameid == 0)
                        {
                                throw new CException('游戏ID不能为0');
                        }
                        $games = FrontCache::getGames();

                        $this->game = $games[$this->gameid];
                        
                        $this->payUrl = $this->createUrl('payway/game',array('gameid'=>  $this->game['object_id']));
                }

                public function allowedActions()
                {
                        return 'index,game,left,top,scroller,play,gl,xw,server,view,short';
                }

                public function actionGame($server)
                {
                        $this->layout = '//layout/empty';
                        $this->render('//game/frameset', array('server' => $server));
                }

                public function actionLeft()
                {
                        $this->layout = "//layouts/empty";
                        $this->render('leftnav');
                }

                public function actionScroller()
                {
                        $this->layout = "//layouts/empty";
                        $this->render('//game/scroller');
                }

                public function actionTop($server)
                {
                        $this->layout = '//layout/empty';
                        $servers = FrontCache::getAllServers();
                        $server = $servers[$server];
                        $this->render('//game/topnav', array('server' => $server));
                }

                public function actionPlay($server)
                {
                        $user = Yii::app()->getUser();
                        $servers = FrontCache::getAllServers();

                        $server = $servers[$server];
                        $isGuest = $user->isGuest;

                        if ($isGuest == TRUE)
                        {
                                $message['title'] = "登录后才可以畅玩";
                        }
                        if ($server['server_status'] == 1)
                        {
                                $message['title'] = "敬请期待！";
                                $message['content'] = "尚未开启，敬请期待！";
                        }
                        elseif ($server['server_status'] == 2)
                        {
                                $message['title'] = "正在维护！";
                                $message['content'] = "服务器正在维护！";
                        }
                        elseif ($isGuest == FALSE)
                        {
                                $serverid = $server['object_id'];

                                //加入cookie
                                //首先新建cookie
                                $cookie = new CHttpCookie('lastgame', array('serverid' => $serverid,
                                                            'gamesn' => $server['game_sn'], 'gamename' => $server['gamename'], 'servername' => $server['object_name']));
                                //定义cookie的有效期
                                $cookie->expire = time() + 60 * 60 * 24 * 30;  //有限期30天
                                //把cookie写入cookies使其生效
                                Yii::app()->request->cookies['lastgame'] = $cookie;

                                //判断是否是第一次登陆---当游戏服务器出现问题，充值可能会出错。根据用户习惯几率很小
                                $connection = Yii::app()->db;
                                $userid = intval($user->id);
                                $gameid = $server['gameid'];

                                $logintime = SYS_TIME;
                                $loginip = ip();

                                $sql = "SELECT `id` FROM `{{serveruser}}` WHERE `user_id` = :userid AND `gameid` = :gameid  AND `serverid` = :serverid";
                                $command = $connection->createCommand($sql);
                                $temp = $command->queryRow(1, array(':userid' => $userid, ':gameid' => $gameid, ':serverid' => $serverid));
                                if (!empty($temp))
                                {
                                        $id = $temp['id'];
                                        $sql = "UPDATE `{{serveruser}}` SET `logintime` = :logintime, `loginip` = :loginip WHERE `id` = :id";
                                        $params = array(':logintime' => $logintime, ':loginip' => $loginip, ':id' => $id);
                                }
                                else
                                {
                                        $username = $user->name;
                                        $sql = "INSERT INTO `{{serveruser}}` 
                                        (`id`, `user_id`, `username`, `gameid`, `serverid`, `logintime`, `loginip`) VALUES 
                                        (NULL, :userid, :username, :gameid, :serverid, :logintime, :loginip)";
                                        $params = array(':userid' => $userid, ':username' => $username,
                                                    ':gameid' => $gameid, ':serverid' => $serverid, ':logintime' => $logintime, ':loginip' => $loginip);
                                }

                                $command = $connection->createCommand($sql);
                                $command->execute($params);

                                //执行登陆api
                                $class = ucwords($server['game_sn']) . 'Api';
                                Yii::import('common.gameapi.' . $class);
                                $gameApi = new $class($server);
                                $this->redirect($gameApi->login());
                        }
                        $this->layout = '//layout/empty';

                        $this->render('//game/error', array('server' => $server, 'isGuest' => $isGuest, 'message' => $message));
                }

                public function actionGl()
                {

                        $rawData = $this->getList($this->glid);
                        $dataProvider = new CArrayDataProvider($rawData, array(
                                                    'pagination' => array('pageSize' => 15),
                                                    'keyField' => 'object_id',
                                        ));

                        $this->render('list', array('dataProvider' => $dataProvider));
                }

                public function actionXw()
                {

                        $rawData = $this->getList($this->xwid);

                        $dataProvider = new CArrayDataProvider($rawData, array(
                                                    'pagination' => array('pageSize' => 15),
                                                    'keyField' => 'object_id',
                                        ));

                        $this->render('list', array('dataProvider' => $dataProvider));
                }

                public function getList($teamid)
                {
                        $connection = Yii::app()->db;
                        $sql = 'SELECT o.`object_id`,`object_name`,`object_date`  FROM  `{{object}}` AS o,`{{object_term}}` AS t  
                        WHERE t.`object_id` = o.`object_id` AND `object_parent`=' . $this->gameid . ' 
                                AND `object_type`="garticle"  
                                AND `object_status`=1 
                                AND `term_id` = ' . $teamid;

                        $command = $connection->createCommand($sql);

                        $rawData = $command->queryAll();

                        return $rawData;
                }

                public function actionServer()
                {
                        $this->render('server');
                }

                public function actionView($id)
                {
                        $object = FrontCache::getObject($id);

                        $this->pageTitle = CHtml::encode($object['object_name']);
                        $this->description = CHtml::encode($object['object_description']);
                        $this->keywords = CHtml::encode($object['object_keywords']);

                        $this->render('detail', array('object' => $object));
                }

                public function actionShort()
                {
                        $filename = 'MarsTV'.$this->game['object_name'];
                        $url = $this->createAbsoluteUrl($this->game['game_sn'] . '/index');
                        $content = "
[InternetShortcut]
URL=$url
IDList=
IconFile=http://g.marstv.com/favicon.ico
IconIndex=1
[{000214A0-0000-0000-C000-000000000046}]
Prop3=19,2
 ";                 
                         if(strpos($_SERVER['HTTP_USER_AGENT'],"MSIE"))
                         {
                                 $filename = urlencode($filename).'.url';
                         }
                         else
                         {
                                 $filename = $filename.'.url';
                         }

                         Yii::app()->getRequest()->sendFile($filename, $content,'application/octet-stream');
                }

        }

        
