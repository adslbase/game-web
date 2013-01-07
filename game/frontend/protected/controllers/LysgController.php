<?php

        class LysgController extends GameController
        {

                public $gameid = 142;
                public $layout = '//lysg/main';
                public $menuid = 2;
				public $db;

                public function allowedActions()
                {
                        return 'index,game,left,top,scroller,play,gl,xw,server,view,short,vip';
                }

                public function actionIndex()
                {
						$news = FrontCache::getGameNews($this->gameid, 5);
						
                        $gls = FrontCache::getGameGl($this->gameid, 10);
						
                        $this->render('index', array('news' => $news, 'gls' => $gls));
                }

                public function actionVip()
                {
                        $this->layout = '//layout/empty';

                        $this->render('vip');
                }
				
				public function actionServer()
				{
				       $news = FrontCache::getGameNews($this->gameid, 5);
					   
                       $gls = FrontCache::getGameGl($this->gameid, 10);
                       $this->render('server', array('news' => $news, 'gls' => $gls));
				}
				
				public function actionGame()
				{
					$object_id = $_GET['server'];
					$user = Yii::app()->getUser();
					$connection = Yii::app()->db;
					$Servers = FrontCache::getServers();
					$id=$Servers[$this->gameid][$object_id]['server_status'];                    
				    $status = ConstantDefine::getServerStatus($id);
					$server_type = $status[$id];
					if($server_type == "即将开启")
					{
						$str = "该服即将开启！敬请期待！";
						$strs=iconv('UTF-8', 'GB2312', $str);
						echo '<SCRIPT language=JavaScript>alert("'.$strs.'");</script>';
						echo "<SCRIPT language=JavaScript>window.location='http://g.marstv.com/lysg';</script>";
					}
					elseif($server_type == "正在维护")
					{
						$str = "维护中！请稍后再试！";
						$strs=iconv('UTF-8', 'GB2312', $str);
						echo '<SCRIPT language=JavaScript>alert("'.$strs.'");</script>';
						echo "<SCRIPT language=JavaScript>window.location='http://g.marstv.com/lysg';</script>";
					}
					else
					{
						if ($user->isGuest == 1)
						{
							 echo '<SCRIPT language=JavaScript>alert("对不起你还没有登陆！");return false;</script>';
							 echo "<SCRIPT language=JavaScript>window.location='http://g.marstv.com/index.php/sign/in';</script>";
						}
						else
						{
							$uid=$user->id;
							$uname=urlencode($user->username);
							$sid="1";
							$serverid="143";
							$domain="s1sgs.marstv.96wan.com";
							$time=time();
							$uip = $_SERVER['REMOTE_ADDR'];
							$unid="12";
							$tid="null";
							$key="96f6cc67a3904175c951961bc9d5ccb8";
							$fcm="1";
							$game_id=$this->gameid;
							$sign=md5("uid=".$user->id."&uname=".$user->username."&sid=".$sid."&domain=s1sgs.marstv.96wan.com&time=".time()."&uip=".$_SERVER['REMOTE_ADDR']."&unid=12&tid=null&key=96f6cc67a3904175c951961bc9d5ccb8");
							$sql = "SELECT `id` FROM `{{serveruser}}` WHERE `user_id` = :userid AND `gameid` = :gameid  AND `serverid` = :serverid";
									$command = $connection->createCommand($sql);
									$temp = $command->queryRow(1, array(':userid' => $uid, ':gameid' => $game_id, ':serverid' => $serverid));
									if (!empty($temp))
									{
											$id = $temp['id'];
											$sql = "UPDATE `{{serveruser}}` SET `logintime` = :logintime, `loginip` = :loginip WHERE `id` = :id";
											$params = array(':logintime' => $time, ':loginip' => $uip, ':id' => $id);
									}
									else
									{
											$username = $user->username;
											$sql = "INSERT INTO `{{serveruser}}` 
											(`id`, `user_id`, `username`, `gameid`, `serverid`, `logintime`, `loginip`) VALUES 
											(NULL, :userid, :username, :gameid, :serverid, :logintime, :loginip)";
											$params = array(':userid' => $uid, ':username' => $username,
														':gameid' => $game_id, ':serverid' => $serverid, ':logintime' => $time, ':loginip' => $uip);
									}
	
									$command = $connection->createCommand($sql);
									$command->execute($params);
									echo "<SCRIPT language=JavaScript>window.location='http://s1.lysg.marstv.com/game.php?uid=".$uid."&uname=".$uname."&sid=".$sid."&domain=".$domain."&time=".$time."&uip=".$uip."&unid=".$unid."&tid=".$tid."&key=".$key."&fcm=".$fcm."&sign=".$sign."';</script>";
						}
					}
				}

        }

        