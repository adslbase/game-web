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
         * 获得所有频道
         * @return array 
         */
        public function selectAllChannel()
        {
            
            $sql = 'SELECT * FROM ' . $this->tableName();
            return $this->daoQueryAll($sql);
        }
    

    }

    