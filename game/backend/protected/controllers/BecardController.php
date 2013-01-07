<?php

        /**
         * Backend Caching Controller.
         * 
         * @author Tuan Nguyen <nganhtuan63@gmail.com>
         * @version 1.0
         * @package backend.controllers
         *
         */
        class BecardController extends BeController
        {

                public function __construct($id, $module = null)
                {
                        parent::__construct($id, $module);
                        $this->menu = array(
                        );
                }

                /**
                 * The function that do clear Cache 
                 * 
                 */
                public function actionImport($id)
                {
                        $connection = Yii::app()->db;
						$code = $_POST['Code'];
						if($code['key']=="")
						{
							Yii::import('common.content_type.card.CardObject');
								
								$model = new CardObject();
								$card = $model->findByPk($id);
								
								//通过游戏id获取。该游戏所有服务器
								$gameid = $card->object_parent;
								$sql = 'SELECT `object_name`,`object_id` FROM {{object}} WHERE `object_type`=:type AND `object_parent`=:parent';
								
								$command = $connection->createCommand($sql);
								$temp = $command->queryAll(TRUE, array(':type' => 'server', ':parent' => $gameid));
								
								$servers = array();
								foreach ($temp as $v)
								{
										$servers[$v['object_id']] = $v['object_name'];
								}
								$model = new Code();
								$this->render('import', array('model' => $model, 'servers' => $servers, 'card' => $card)); 
								exit;													
						}
                        elseif($_POST['yt0']=="保存")
                        {								
								$keys = explode(' ', preg_replace("/\r\n/s", " ", $code['key']));		
								$i=0;
								//echo ini_get('post_max_size');
								ini_get('post_max_size')+10;//exit;
								foreach ($keys as $k => $v)
								{
										
										$sql = 'INSERT INTO {{code}} VALUES (NULL,:gameid,:serverid,:cardid,0,:key,"")';
										$command = $connection->createCommand($sql);
										$command->execute(array(':gameid' => $code['gameid'], ':serverid' => $code['serverid'], ':cardid' => $code['cardid'], ':key' => $v));
										$i++;
										
								}
								$ee='成功增加'.$i.'个激活码!';
								user()->setFlash('success', t($ee));								
								$this->redirect(array('becard/import/'.$code['cardid']));	
								exit;	    
								
                        }
                        
                }
				

        }