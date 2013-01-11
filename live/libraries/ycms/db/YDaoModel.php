<?php

    /**
     * YDaoModel class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 使用dao操作数据库
     *
     * @version $Id: YDaoModel.php UTF-8 2011-5-2 18:42:10 li feixiang
     * @package db
     * @since 1.0
     *
     */
    abstract class YDaoModel extends YModel
    {

        private static $_db;
        private $_md;

        /**
         * Constructor.
         * @param string $scenario scenario name. See {@link CModel::scenario} for more details about this parameter.
         */
        public function __construct($scenario='insert', $defaultAttributes = true)
        {
            $this->setScenario($scenario);

            if ($defaultAttributes === TRUE)
                $this->setDefaultAttributes();

            $this->init();
            $this->attachBehaviors($this->behaviors());
            $this->afterConstruct();
        }

        /**
         * 获得表的元数据
         * @return object 
         */
        public function getMetaData()
        {
            if ($this->_md !== null)
                return $this->_md;
            else
                return $this->_md = new YDaoMetaData($this);
        }

        /**
         * Returns the database connection used by active record.
         * By default, the "db" application component is used as the database connection.
         * You may override this method if you want to use a different database connection.
         * @return CDbConnection the database connection used by active record.
         */
        public static function getDbConnection()
        {
            if (self::$_db !== null)
                return self::$_db;
            else
            {
                self::$_db = Yii::app()->getDb();
                if (self::$_db instanceof CDbConnection)
                    return self::$_db;
                else
                    throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }

        /**
         * 组合基础字段，和外来的字段
         * @param string $base 基础查找字段 
         * @param mixed $field 其他字段
         * return mixed 组合后的字段
         */
        public static function makeUpField($base, $field)
        {

            if (is_array($field))
            {
                $field = array_merge((array) $base, $field);
            }
            else
            {
                $field = rtrim($base, ', ') . ', ' . $field;
            }

            return $field;
        }

        /**
         * 连接两个表
         * @param type $table
         * @param type $join
         * @return string 
         */
        public static function joinTable($table, $join)
        {

            $table = '`' . $table[0] . '` ' . $table[1] . ' ';

            foreach ($join as $value)
            {
                if (!isset($value[3]))
                {
                    $value[3] = 'LEFT JOIN ';
                }
                if (!isset($value[2]))
                {
                    $value[2] = '';
                }


                $table .= $value[3] . '`' . $value[0] . '` ' . $value[2] . ' ON ' . $value[1] . ' ';
            }

            return $table;
        }

        /**
         * 获取多个表到选择字段
         * @param $columns array('表别名'=>array(),)
         * return string 
         */
        public static function joinAttributesSelectMore($moreColumns = array())
        {
            if ($moreColumns === '' || $moreColumns === '*')
                return '*';

            $condition = '';

            foreach ($moreColumns as $alias => $columns)
            {
                $condition .= self::joinAttributesSelect($columns, $alias) . ',';
            }

            $condition = rtrim($condition, ',');
            return $condition;
        }

        /**
         * 将数组或者字符窜拼接成sql中查找的字段
         * @param mixed $fields  可以为array('field1','field2','field3')||('field1','field2','field3')
         * @param string $tableAlias 表别名
         * @return string 
         */
        public static function joinAttributesSelect($fields, $tableAlias='')
        {
            $condition = '';

            if ($tableAlias !== '' && !strpos($tableAlias, '.'))
                $tableAlias = $tableAlias . '.';

            if (is_array($fields) && $fields !== array())
            {

                $fields = array_unique($fields);

                foreach ($fields as $field)
                {
                    $condition .= $tableAlias . '`' . trim($field) . '`, ';
                }
                $condition = rtrim($condition, ', ');
            }
            elseif (is_string($fields) && $fields !== '' && $fields !== '*')
            {

                if ($tableAlias === '')
                    return $fields;

                $fields = explode(',', $fields);

                $condition = self::joinAttributesSelect($fields, $tableAlias);
            }
            else
            {
                $condition = $tableAlias . '*';
            }

            return $condition;
        }

        /**
         * 将特性数组转换成sql中更新的字段连接
         * @param array $attributes array('title'=>$model->title,'name'=>$model->name)
         * @param string $tableAlias
         * @return string 
         */
        public static function joinAttributesUpdate(&$attributes, $tableAlias='')
        {
            $condition = '';

            if (!empty($tableAlias) && !strpos($tableAlias, '.'))
                $tableAlias = $tableAlias . '.';

            foreach ($attributes as $name => $value)
            {

                $name = trim($name);
                if ($value instanceof CDbExpression)
                {
                    unset($attributes[$name]);

                    $condition .= $tableAlias . '`' . $name . '` = ' . $value->expression . ', ';

                    foreach ($value->params as $n => $v)
                        $attributes[$n] = $v;
                }
                else
                {
                    $condition .= $tableAlias . '`' . $name . '` = :' . $name . ', ';
                }
            }

            $condition = rtrim($condition, ', ');

            return $condition;
        }

        /**
         * 转换数组为sql中插入语句
         * @param array $attributes
         * @return string 
         */
        public static function joinAttributesInsert(&$attributes)
        {

            $names = $params = '';

            foreach ($attributes as $name => $value)
            {
                $names .= '`' . $name . '`,';

                if ($value instanceof CDbExpression)
                {
                    unset($attributes[$name]);
                    $params .= $value->expression . ',';
                    foreach ($value->params as $n => $v)
                        $attributes[$n] = $v;
                }
                else
                {
                    $params .= ':' . $name . ',';
                }
            }

            return ' (' . rtrim($names, ',') . ') VALUES (' . rtrim($params, ',') . ')';
        }

        /**
         * 发送一条语句，用于select 
         * @param string $sql
         * @param array $paArray
         * @param string $bindType
         * @return CDbDataReader 对象
         */
        public function daoQuery($sql, $paArray=array(), $bindType = 'bindParam')
        {

            $command = self:: getDbConnection()->createCommand($sql);

            self:: bindArray($command, $paArray, $bindType);

            return $command->query();
        }

        /**
         * 查询一行
         * @param string $sql
         * @param array $paArray
         * @param string $bindType
         * @return array 如果没有返回false
         */
        public function daoQueryRow($sql, $paArray=array(), $bindType = 'bindParam')
        {

            $command = self:: getDbConnection()->createCommand($sql);

            self:: bindArray($command, $paArray, $bindType);

            return $command->queryRow();
        }

        /**
         * 
         * @param string $sql
         * @param array $paArray
         * @param string $bindType
         * @return array 返回一个空数组
         */
        public static function daoQueryAll($sql, $paArray=array(), $bindType = 'bindParam')
        {

            $command = self:: getDbConnection()->createCommand($sql);

            self:: bindArray($command, $paArray, $bindType);

            return $command->queryAll();
        }

        /**
         * 执行一条那个sql语句，多维delete,update
         * @param string $sql
         * @param array $paArray
         * @param string $bindType
         * @return int 返回影响数据库的行数
         */
        public function daoExecute($sql, $paArray=array(), $bindType = 'bindParam')
        {

            $command = self:: getDbConnection()->createCommand($sql);

            self:: bindArray($command, $paArray, $bindType);

            return $command->execute();
        }

        /**
         * 绑定sql中的值，多用于防止注入
         * @param object $command
         * @param array $paArray  array('field'=>array($field,PDO::PARAM_INT))||array('field'=>$field)
         * @param string $bindType 
         */
        public static function bindArray(&$command, $paArray=array(), $bindType = 'bindParam')
        {

            if ($paArray !== array())
            {
                foreach ($paArray as $field => $value)
                {
                    if ($field[0] !== ':')
                        $field = ':' . $field;

                    if (is_array($value))
                    {
                        $command->$bindType($field, $value[0], $value[1]);
                    }
                    else
                    {
                        $command->$bindType($field, $value, null);
                    }
                }
            }
        }

        /**
         * 将访问数据库的值转换成字符窜
         * @param mixed $str
         * @return string 
         */
        public static function quoteValue($str)
        {
            return self:: getDbConnection()->quoteValue($str);
        }

    }

    class YDaoMetaData
    {

        /**
         * @var CDbTableSchema the table schema information
         */
        public $tableSchema;
        /**
         * @var array table columns
         */
        public $columns;
        /**
         * @var array attribute default values
         */
        public $attributeDefaults = array();
        private $_model;

        /**
         * Constructor.
         * @param CActiveRecord $model the model instance
         */
        public function __construct($model)
        {
            $this->_model = $model;

            $tableName = $model->tableName();
            if (($table = $model->getDbConnection()->getSchema()->getTable($tableName)) === null)
                throw new CDbException(Yii::t('yii', 'The table "{table}" for active record class "{class}" cannot be found in the database.', array('{class}' => get_class($model), '{table}' => $tableName)));
            $this->tableSchema = $table;
            $this->columns = $table->columns;

            foreach ($table->columns as $name => $column)
            {
                if (!$column->isPrimaryKey && $column->defaultValue !== null)
                    $this->attributeDefaults[$name] = $column->defaultValue;
            }
        }

    }

    