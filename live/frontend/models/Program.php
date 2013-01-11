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
         * 选择一个节目单
         * @param type $date
         * @param type $ch_id
         * @return array 
         */
        public function selectProgram($date, $ch_id='')
        {
               
            $sql = 'SELECT `start_time`,`end_time`,`name`,`type`,`program_id`,`post_id`,`ch_id` FROM ' . $this->tableName() . ' WHERE `date` = :date';
                $pArray = array(':date' => $date);
            if($ch_id!=='')
            {
                    $sql .=" AND `ch_id`=:ch_id'";
                    $pArray[':ch_id'] =  $ch_id;
            }
            
            $result = $this->daoQueryAll($sql,$pArray, 'bindValue');

            return $result;
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

            return $code ? $options[$type][$code] : $options[$type];
        }

    }

    