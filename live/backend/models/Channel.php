<?php

    /**
     * channel model class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 数据库表"channel"的model类.
     *
     * The followings are the available columns in table 'channel':
     * @property string $ch_id
     * @property string $name
     * @property string $description
     * @property string $keywords
     *
     * @version $Id: channel.php UTF-8 2011-07-28 11:01:41 li feixiang
     * @package backend-model
     * @since 1.0
     */
    class Channel extends YDaoModel
    {

        /**
         * 该模型关联的数据库表名
         *      
         * @return      string          该模型关联的数据库表名
         * @since	1.0
         */
        public static function tableName()
        {
            return '{{channel}}';
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
                    array('name', 'required'),
                    array('name', 'length', 'max' => 128),
                    array('description, keywords', 'length', 'max' => 255),
                    array('ch_id, name, description, keywords', 'safe'),
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
                    'name' => Ycms::t('channel', '频道名称'),
                    'description' => Ycms::t('channel', '频道说明'),
                    'keywords' => Ycms::t('channel', '频道关键词'),
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
                    'name' => Ycms::t('channel', 'neotv的频道'),
                    'description' => Ycms::t('channel', '这个是说明，暂时没有用处，可以不填'),
                    'keywords' => Ycms::t('channel', '请用空格分割填写的关键词'),
            );
        }

        /**
         * 获得所有频道
         * @return array 
         */
        public function selectAllChannel()
        {
            $sql = 'SELECT * FROM ' . $this->tableName();
            return $this->daoQueryAll($sql);
        }

        public function getChannel()
        {
            $result = array();
            
            $tmp = $this->selectAllChannel();
            foreach ($tmp as $channel)
            {
                $result[$channel['ch_id']] = $channel['name'];
            }
            
            return $result;
        }            
        
        /**
         * 插入一个频道
         * @param array $attributes
         * @return boolean 
         */
        public function insertChannel()
        {

            $attributes = $this->getAttributes();

            $connection = $this->joinAttributesInsert($attributes);

            $sql = 'INSERT INTO ' . $this->tableName() . $connection;

            return $this->daoExecute($sql, $attributes, 'bindValue') === 1;
        }

        /**
         * 根据频道id获得该频道数据
         * @param int $id 
         * @return array
         */
        public function selectChannel($id, $fields='')
        {
            $connection = $this->joinAttributesSelect($fields);

            $sql = 'SELECT ' . $connection . ' FROM ' . $this->tableName() . ' WHERE `ch_id` = :id';

            return $this->daoQueryRow($sql, array(':id' => array($id, PDO::PARAM_INT)));
        }

        /**
         * 修改一个频道
         * @param int $id
         * @return boolean 
         */
        public function updateChannel($id)
        {
            $attributes = $this->getAttributes();

            unset($attributes['ch_id']);

            $connection = $this->joinAttributesUpdate($attributes);

            $sql = 'UPDATE ' . $this->tableName() . ' SET '.$connection . ' WHERE `ch_id` = :id';

            $attributes[':id'] = array($id,PDO::PARAM_INT);

            return $this->daoExecute($sql, $attributes, 'bindValue') === 1;
        }

        /**
         * 根据id删除一个频道
         * @param int $id
         * @return boolean 
         */
        public function deleteChannel($id)
        {
            $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE `ch_id` = :id';
            return $this->daoExecute($sql, array(':id' => array($id, PDO::PARAM_INT))) === 1;
        }

    }

    