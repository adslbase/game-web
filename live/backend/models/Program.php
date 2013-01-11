<?php

    /**
     * program model class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 数据库表"program"的model类.
     *
     * The followings are the available columns in table 'program':
     * @property integer $ch_id
     * @property string $date
     * @property string $start_time
     * @property string $end_time
     * @property string $name
     *
     * @version $Id: program.php UTF-8 2011-07-28 11:01:20 li feixiang
     * @package backend-model
     * @since 1.0
     */
    class Program extends YDaoModel
    {

        public $pid = '';

        /**
         * 该模型关联的数据库表名
         *      
         * @return      string          该模型关联的数据库表名
         * @since	1.0
         */
        public static function tableName()
        {
            return '{{program}}';
        }

        /**
         * 字段验证规则
         *
         * boolean-captcha-compare-email-default-exist-file-filter-in-length-match-numerical-required-type-unique-url
         * return       array
         * @since	1.0
         */
        public function rules()
        {
            return array(
                    array('ch_id, date , pid', 'required'),
                    array('ch_id', 'numerical', 'integerOnly' => true),
                    array('ch_id, date, start_time, end_time, name, type,program_id,post_id', 'safe'),
                    array('ch_id, date', 'safe', 'on' => 'search'),
            );
        }

        /**
         * 字段label
         *
         * @return      array           customized attribute labels (name=>label)
         * @since	1.0
         */
        public function attributeLabels()
        {
            return array(
                    'ch_id' => Ycms::t('program', '频道'),
                    'date' => Ycms::t('program', '日期'),
                    'start_time' => Ycms::t('program', '开始'),
                    'end_time' => Ycms::t('program', '结束'),
                    'name' => Ycms::t('program', '节目'),
                    'type' => Ycms::t('program', '直播/重播'),
                    'post_id'=>  Ycms::t('program', '讨论帖子'),
                     'pid'=>  Ycms::t('program', '默认讨论帖id')
            );
        }

        /**
         * 字段说明
         *
         * @return      array           customized attribute hints (name=>hint)
         * @since	1.0
         */
        public function attributeHints()
        {
            return array(
                    'ch_id' => Ycms::t('program', '选择节目的频道'),
                    'date' => Ycms::t('program', '选择日期'),
                    'start_time' => Ycms::t('program', '开始时间'),
                    'end_time' => Ycms::t('program', '结束时间'),
                    'name' => Ycms::t('program', '节目名'),
                    'type' => Ycms::t('program', '直播/重播'),
                    'pid'=>  Ycms::t('program', '如果没有为节目指定讨论帖id，将使用该默认帖子id')
            );
        }

        /**
         * 加载表单的选项
         * @param string $type
         * @param string $code
         * @return mixed 
         */
        public function loadFormOptions($type, $code=null)
        {
            $options = array(
                    'type' => array(
                            'replay' => Ycms::t('program', '重播'),
                            'live' => Ycms::t('program', '直播'),
                    ),
            );

            if ($type == 'channel')
            {
                $modelChannel = YController::loadDaoModel('Channel');

                $options['channel'] = $modelChannel->getChannel();
            }
            return $code ? $options[$type][$code] : $options[$type];
        }

        /**
         * 获取所有的节目
         * @return array 
         */
        public function selectAllProgram()
        {
            $sql = 'SELECT * FROM ' . $this->tableName();

            return $this->daoQueryAll($sql);
        }

        /**
         *
         * @param type $ch_id
         * @param type $date
         * @return type 
         */
        public function selectAllProgramByParam($ch_id, $date)
        {
            $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE ';

            if (!empty($ch_id))
            {
                $sql .= ' ch_id = :ch_id ';
                $paArray[':ch_id'] = array($ch_id,  PDO::PARAM_INT);
            }

            if (!empty($date))
            {
                if(!empty ($ch_id))
                {
                    $sql .= ' AND ';
                }
                
                $sql .= ' date = :date';
                
                $paArray[':date'] = $date;
            }

            return $this->daoQueryAll($sql,$paArray, 'bindValue');
        }

        /**
         * 为某个频道某天插入一个节目单
         * @return boolean 
         */
        public function insertProgram()
        {
            $attributes = $this->getAttributes();

            $sql = 'INSERT INTO ' . $this->tableName() . ' (`date`,`ch_id`,`start_time`,`end_time`,`name`,`type`,`post_id`) VALUES ';

            $val = '("' . $attributes['date'] . '",' . $attributes['ch_id'] . ',';

            foreach ($attributes['name'] as $key => $name)
            {
                if (!empty($name) && !empty($attributes['start_time'][$key]))
                {
                    $sql .= $val . '"' . $attributes['start_time'][$key] . '","' . $attributes['end_time'][$key] . '","' . $name . '","' . $attributes['type'][$key]  . '","' .$attributes['post_id'][$key]. '"),';
                }
            }

            $sql = rtrim($sql, ',');

            return $this->daoExecute($sql) >= 1;
        }

        /**
         * 选择一个节目单
         * @param type $date
         * @param type $ch_id
         * @return array 
         */
        public function selectProgram($date, $ch_id)
        {
            $result = array();
            
            $sql = 'SELECT `start_time`,`end_time`,`name`,`type`,`program_id`,`post_id` FROM ' . $this->tableName() . ' WHERE `date` = :date AND `ch_id`=:ch_id';

            $temp = $this->daoQueryAll($sql, array(':date' => $date, ':ch_id' => $ch_id), 'bindValue');

            $result['date'] = $date;

            $result['ch_id'] = $ch_id;

            foreach ($temp as $value)
            {
                $result['start_time'][] = $value['start_time'];
                $result['end_time'][] = $value['end_time'];
                $result['name'][] = $value['name'];
                $result['type'][] = $value['type'];
                $result['program_id'][] = $value['program_id'];
                $result['post_id'][] = $value['post_id'];
            }

            return $result;
        }

        /**
         * 更新节目单---注意这里不会更新$date $ch_id
         * @param type $date
         * @param type $ch_id
         * @return boolean 
         */
        public function updateProgram($date, $ch_id)
        {
            $sql = 'SELECT `program_id`,`start_time`,`end_time`,`name`,`type`,`post_id` FROM ' . $this->tableName() . ' WHERE `date` = :date AND `ch_id`=:ch_id';
            $oldProgram = $this->daoQueryAll($sql, array(':date' => $date, ':ch_id' => $ch_id), 'bindValue');

            $attributes = $this->getAttributes();
            foreach ($attributes['program_id'] as $key => $value)
            {
                if (!empty($attributes['name'][$key]) && !empty($attributes['start_time'][$key]) && !empty($attributes['end_time'][$key]))
                {
                    $newProgram[] = array(
                            'program_id' => $value,
                            'start_time' => $attributes['start_time'][$key],
                            'end_time' => $attributes['end_time'][$key],
                            'name' => $attributes['name'][$key],
                            'type' => $attributes['type'][$key],
                            'post_id'=>$attributes['post_id'][$key]
                    );
                }
            }

            if ($oldProgram == $newProgram)
            {
                return TRUE;
            }
            $updateProgram = arrayDiffAssoc($newProgram, $oldProgram);

            $transaction = $this->getDbConnection()->beginTransaction();
            try
            {
                $addsql = 'INSERT INTO ' . $this->tableName() . ' (`date`,`ch_id`,`start_time`,`end_time`,`name`,`type`,`post_id`) VALUES ';
                $val = '("' . $date . '",' . $ch_id . ',';

                foreach ($updateProgram as $value)
                {
                    if (empty($value['program_id']))
                    {
                        $addsql .= $val . '"' . $value['start_time'] . '","' . $value['end_time'] . '","' . $value['name'] . '","' . $value['type'] . '","' .$attributes['post_id'][$key]. '"),';
                    }
                    else
                    {
                        $sql = 'UPDATE ' . $this->tableName() . ' SET `start_time`=:start_time ,`end_time`=:end_time ,`type`=:type ,`name`=:name,`post_id`=:post_id  WHERE program_id = :program_id';
                        $value['program_id'] = array($value['program_id'], PDO::PARAM_STR);
                        $this->daoExecute($sql, $value, 'bindValue');
                    }
                }
                $sql = rtrim($addsql, ',');

                if ($sql !== $addsql)
                {
                    $this->daoExecute($sql);
                }

                $transaction->commit();
                return true;
            }
            catch (Exception $e)
            {
                $transaction->rollBack();
                throw new CException($e->getMessage());
            }
        }

        /**
         * 删除一个节目
         * @param type $id
         * @return type 
         */
        public function deleteProgramById($id)
        {
            $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE `program_id` = :program_id';
            return $this->daoExecute($sql, array(':program_id' => $id), 'bindValue') === 1;
        }
        
         /**
         * 删除某天的节目
         * @param type $id
         * @return type 
         */
        public function deleteProgramByDate($date)
        {
            $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE `date` = :date';
            $sql2 = 'DELETE FROM  `program_post` WHERE `date` = :date';
            if($this->daoExecute($sql, array(':date' => $date), 'bindValue') === 1)
            {
               return $this->daoExecute($sql2, array(':date' => $date), 'bindValue') === 1;
            }
        }

    }

    