<?php

    /**
     * program_post model class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 数据库表"program_post"的model类.
     *
     * The followings are the available columns in table 'program_post':
     * @property string $date
     * @property integer $pid
     *
     * @version $Id: program_post.php UTF-8 2012-01-07 17:41:55 li feixiang
     * @package backend-model
     * @since 1.0
     */
    class ProgramPost extends YDaoModel
    {

        /**
         * 该模型关联的数据库表名
         *      
         * @return      string          该模型关联的数据库表名
         * @since	1.0
         */
        public static function tableName()
        {
            return '{{program_post}}';
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
                    array('date, pid', 'required'),
                    array('pid', 'numerical', 'integerOnly' => true),
                    array('date, pid', 'safe'),
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
                    'date' => Ycms::t('programpost', 'Date'),
                    'pid' => Ycms::t('programpost', 'Post'),
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
                    'date' => Ycms::t('programpost', 'Date'),
                    'pid' => Ycms::t('programpost', 'Post'),
            );
        }

        public function selectPostId($date)
        {
            $sql = 'SELECT `pid` FROM ' . $this->tableName() . ' WHERE date=:date ';
            
            $result =  $this->daoQueryRow($sql, array('date' => $date), 'bindValue');
            
            return $result['pid'];
        }

        public function updatePostId($date, $pid)
        {
            if (!$this->selectPostId($date))
            {
                $sql = 'INSERT INTO ' . $this->tableName() . ' (`date`,`pid`) VALUES ( :date , :pid)';
            }
            else
            {
                $sql = 'UPDATE ' . $this->tableName() . ' SET  `pid` = :pid WHERE `date` =:date  ';
            }
             return $this->daoExecute($sql, array('date' => $date, 'pid' => $pid),'bindValue') >= 1;
        }

    }

    