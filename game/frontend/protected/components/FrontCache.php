<?php

        class FrontCache
        {

                public static function getGames()
                {

                        $connection = Yii::app()->db;
                        $sql = 'SELECT o.*,t.`term_id` FROM  `{{object}}` as o,`{{object_term}}` as t 
                        WHERE o.`object_id`=t.`object_id` AND `object_type`="game" ORDER BY `order` ASC ';

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        $result = array();
                        foreach ($temp as $object)
                        {
                                // Get Extra Info - Object Meta of the Object Type
                                $object_metas = ObjectMeta::model()->findAll('meta_object_id = :obj ', array(':obj' => $object['object_id']));

                                foreach ($object_metas as $object_meta)
                                {
                                        $key = (string) $object_meta->meta_key;
                                        $object[$key] = $object_meta->meta_value;
                                }

                                $terms = self::getTeams();
                                $object['termname'] = $terms[$object['term_id']]['name'];
                                $result[$object['object_id']] = $object;
                        }

                        return $result;
                }
				
				public static function getGamesById($gameid)
                {
                        $connection = Yii::app()->db;
                        $sql = 'SELECT o.*,t.`term_id` FROM  `{{object}}` as o,`{{object_term}}` as t 
                        WHERE o.`object_id`=t.`object_id` AND `object_type`="game" AND o.`object_id` = "'.$gameid.'" ORDER BY `order` ASC ';

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        $result = array();
                        foreach ($temp as $object)
                        {
                                // Get Extra Info - Object Meta of the Object Type
                                $object_metas = ObjectMeta::model()->findAll('meta_object_id = :obj ', array(':obj' => $object['object_id']));

                                foreach ($object_metas as $object_meta)
                                {
                                        $key = (string) $object_meta->meta_key;
                                        $object[$key] = $object_meta->meta_value;
                                }

                                $terms = self::getTeams();
                                $object['termname'] = $terms[$object['term_id']]['name'];
                                $result[$object['object_id']] = $object;
                        }

                        return $result;
                }

                public static function objectPayHelp()
                {

                        $term_id = 9;

                        $select = 'o.`object_id`,`object_name`,`object_type`';

                        return self::getContentList($select, $term_id);
                }

                public static function getContentList($select, $term_id, $max = null)
                {
                        $select = 'SELECT ' . $select . ' FROM `{{object}}` AS o,`{{object_term}}` AS t ';

                        $condition = 'WHERE o.`object_id`= t.`object_id` AND o.object_status = ' . ConstantDefine::OBJECT_STATUS_PUBLISHED;

                        $condition .= ' AND  t.`term_id`=' . $term_id;

                        $order = ' ORDER BY o.`order` ASC ';

                        $limit = '';
                        if ($max != null)
                        {
                                $limit = ' LIMIT 0 , ' . $max;
                        }

                        $connection = Yii::app()->db;
                        $sql = $select . $condition . $order . $limit;
                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();
                        return $temp;
                }

                public static function getPayways($code = FALSE)
                {
                        $sql = 'SELECT * FROM  `{{payway}}` WHERE `enabled`=1 ORDER BY  `order` ASC ';

                        $connection = Yii::app()->db;

                        $command = $connection->createCommand($sql);

                        $dataReader = $command->query();

                        foreach ($dataReader as $row)
                        {
                                if (!empty($row['config']))
                                {
                                        eval('$config = ' . $row['config'] . ';');
                                        $row['config'] = $config;
                                        $row['config']['pay_account'] = $row['pay_account'];
                                }

                                if ($code == FALSE)
                                {
                                        $temp[$row['pay_id']] = $row;
                                }
                                else
                                {
                                        $code = strtolower($row['class']);
                                        $temp[$code] = $row;
                                }
                        }

                        return $temp;
                }

                public static function getServers()
                {

                        $temp = self::getAllServers();
                        $result = array();
                        foreach ($temp as $object)
                        {
                                $result[$object['object_parent']][$object['object_id']] = $object;
                        }

                        return $result;
                }
                
				public static function getServerById($object_id)
				{
				       $connection = Yii::app()->db;

                        //$sql = 'SELECT * FROM  `{{object}}` WHERE  `object_type`="server" ORDER BY `order` ASC';
                        $sql = 'SELECT * FROM  `{{object}}` WHERE  `object_type`="server" AND `object_id` = "$object_id" ORDER BY `object_id` desc';
                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        $result = array();
                        foreach ($temp as $object)
                        {
                                // Get Extra Info - Object Meta of the Object Type
                                $object_metas = ObjectMeta::model()->findAll('meta_object_id = :obj ', array(':obj' => $object['object_id']));

                                foreach ($object_metas as $object_meta)
                                {
                                        $key = (string) $object_meta->meta_key;
                                        $object[$key] = $object_meta->meta_value;
                                }

                                $games = self::getGames();

                                $object['gamename'] = $games[$object['object_parent']]['object_name'];
                                $object['game_sn'] = $games[$object['object_parent']]['game_sn'];
                                $object['gameid'] = $games[$object['object_parent']]['object_id'];

                                $result[$object['object_id']] = $object;
                        }

                        return $result;
				}
				
                public static function getAllServers()
                {

                        $connection = Yii::app()->db;

                        //$sql = 'SELECT * FROM  `{{object}}` WHERE  `object_type`="server" ORDER BY `order` ASC';
                        $sql = 'SELECT * FROM  `{{object}}` WHERE  `object_type`="server" ORDER BY `object_id` desc';
                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        $result = array();
                        foreach ($temp as $object)
                        {
                                // Get Extra Info - Object Meta of the Object Type
                                $object_metas = ObjectMeta::model()->findAll('meta_object_id = :obj ', array(':obj' => $object['object_id']));

                                foreach ($object_metas as $object_meta)
                                {
                                        $key = (string) $object_meta->meta_key;
                                        $object[$key] = $object_meta->meta_value;
                                }

                                $games = self::getGames();

                                $object['gamename'] = $games[$object['object_parent']]['object_name'];
                                $object['game_sn'] = $games[$object['object_parent']]['game_sn'];
                                $object['gameid'] = $games[$object['object_parent']]['object_id'];

                                $result[$object['object_id']] = $object;
                        }

                        return $result;
                }

                public static function getNews()
                {
                        $connection = Yii::app()->db;
                        $sql = 'SELECT `object_id`,`object_name`,`object_type`,`object_date`
                        FROM  `{{object}}` WHERE  `object_type`="article" AND `level`=1 AND `object_status`=1 ORDER BY `object_id` DESC LIMIT 0 , 8 ';

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        return $temp;
                }

                public static function getTeams()
                {
                        $connection = Yii::app()->db;
                        $sql = 'SELECT term.*,tax.`type`,tax.`name` as taxname FROM {{term}} as term, {{taxonomy}} as tax WHERE term.`taxonomy_id`=tax.`taxonomy_id`';

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        foreach ($temp as $term)
                        {
                                $result[$term['term_id']] = $term;
                        }
                        return $result;
                }

                public static function getGameNews($gameid, $limit = 5)
                {

                        $teamid = 13;

                        $result = self::getGameArticle($teamid, $gameid, $limit);

                        return $result;
                }

                public static function getGameGl($gameid, $limit = 5)
                {

                        $teamid = 12;

                        $result = self::getGameArticle($teamid, $gameid, $limit);

                        return $result;
                }

                public static function getGameArticle($teamid, $gameid, $limit)
                {
                        $gameid = intval($gameid);
                        $teamid = intval($teamid);
                        $connection = Yii::app()->db;
			
                        $sql = 'SELECT o.`object_id`,`object_name`,`object_date`
                        FROM  `{{object}}` AS o,`{{object_term}}` AS t  
                        WHERE t.`object_id` = o.`object_id` AND `object_parent`=' . $gameid . ' 
                                AND `object_type`="garticle"  
                                AND `object_status`=1 
                                AND `term_id` = ' . $teamid . ' 
                                        ORDER BY o.`object_id` DESC LIMIT 0 , ' . $limit;

                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        return $temp;
                }

                public static function getObject($id)
                {
                        $id = intval($id);
                        $sql = 'SELECT `object_date`,`object_type`,`object_name`,`object_title`,`object_keywords`,`object_description`,`meta_value` 
                                 FROM `{{object}}` AS o,`{{object_meta}}` AS m 
                                 WHERE `object_id`=' . $id . ' AND o.`object_id`=m.`meta_object_id`';

                        $connection = Yii::app()->db;
                        $command = $connection->createCommand($sql);
                        $object = $command->queryRow();

                        return $object;
                }

                public static function getCards()
                {
                        $connection = Yii::app()->db;

                        //$sql = 'SELECT * FROM  `{{object}}` WHERE  `object_type`="card" AND `object_status`=1 ORDER BY `order` DESC';
                        $sql = 'SELECT * FROM  `{{object}}` WHERE  `object_type`="card" AND `object_status`=1 ORDER BY `object_id` DESC';
						
                        $command = $connection->createCommand($sql);

                        $temp = $command->queryAll();

                        $result = array();
                        foreach ($temp as $object)
                        {
                                // Get Extra Info - Object Meta of the Object Type
                                $object_metas = ObjectMeta::model()->findAll('meta_object_id = :obj ', array(':obj' => $object['object_id']));

                                foreach ($object_metas as $object_meta)
                                {
                                        $key = (string) $object_meta->meta_key;
                                        $object[$key] = $object_meta->meta_value;
                                }

                                $games = self::getGames();

                                $object['gamename'] = $games[$object['object_parent']]['object_name'];
                                $object['termname'] = $games[$object['object_parent']]['termname'];
                                $object['game_sn'] = $games[$object['object_parent']]['game_sn'];
                                $object['gameid'] = $games[$object['object_parent']]['object_id'];
                                $object['site_url'] = $games[$object['object_parent']]['site_url'];
                                $object['help_url'] = $games[$object['object_parent']]['help_url'];
                                $object['excerpt'] = $games[$object['object_parent']]['object_excerpt'];

                                $result[$object['object_id']] = $object;
                        }

                        return $result;
                }

                public static function getCardsByGameid()
                {
                        $temp = self::getCards();
                        $result = array();
                        foreach ($temp as $object)
                        {
                                $result[$object['object_parent']][$object['object_id']] = $object;
                        }

                        return $result;
                }

        }
