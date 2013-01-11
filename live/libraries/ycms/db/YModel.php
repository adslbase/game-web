<?php

/**
 * YModel class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms.
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined ( 'INYCMS' ) or die;

/**
 * 这个类实干什么用的
 *
 * @version $Id: YModel.php UTF-8 2011-5-28 17:07:29 li feixiang
 * @package ycms
 * @since 1.0
 *
 */
abstract class YModel extends CModel
{

        private $_attributes = array ( );

        abstract public function getMetaData ();

        /**
         * PHP getter magic method.
         * This method is overridden so that AR attributes can be accessed like properties.
         * @param string $name property name
         * @return mixed property value
         * @see getAttribute
         */
        public function __get ( $name )
        {
                if ( isset ( $this -> _attributes[ $name ] ) )
                        return $this -> _attributes[ $name ];
                else if ( isset ( $this -> getMetaData () -> columns[ $name ] ) )
                        return null;
                else
                        return parent::__get ( $name );
        }

        /**
         * PHP setter magic method.
         * This method is overridden so that AR attributes can be accessed like properties.
         * @param string $name property name
         * @param mixed $value property value
         */
        public function __set ( $name,$value )
        {
                if ( $this -> setAttribute ( $name,$value ) === false )
                {
                        parent::__set ( $name,$value );
                }
        }

        public function init ()
        {
                
        }

        public static function tableName ()
        {
                return __CLASS__;
        }

        //1.如果$names没有设置,则返回数据库中列名为键的数组
        //2.$names是一个值为特性的名的数组。返回指定特性名的数组
        public function getAttributes ( $names=true )
        {
                $attributes = $this -> _attributes; //获取所有特性的默认值
                foreach ( $this -> getMetaData () -> columns as $name => $column )
                {//获取数据库中的所有列名
                        if ( property_exists ( $this,$name ) )
                                $attributes[ $name ] = $this -> $name; //返回数据库中列名为键的数组
                        else if ( $names === true && ! isset ( $attributes[ $name ] ) )//如果该其中的列名不是这个对象的属性。且$names未设置。则设置为null
                                $attributes[ $name ] = null;
                }
                if ( is_array ( $names ) )
                {//如果$names存在
                        $attrs = array ( );
                        foreach ( $names as $name )
                        {
                                if ( property_exists ( $this,$name ) )
                                        $attrs[ $name ] = $this -> $name;
                                else
                                        $attrs[ $name ] = isset ( $attributes[ $name ] ) ? $attributes[ $name ] : null;
                        }
                        return $attrs;
                }
                else
                        return $attributes;
        }

        /**
         * Checks whether this AR has the named attribute
         * @param string $name attribute name
         * @return boolean whether this AR has the named attribute (table column).
         */
        public function hasAttribute ( $name )
        {
                return isset ( $this -> getMetaData () -> columns[ $name ] );
        }

        /**
         * Returns the named attribute value.
         * If this is a new record and the attribute is not set before,
         * the default column value will be returned.
         * If this record is the result of a query and the attribute is not loaded,
         * null will be returned.
         * You may also use $this->AttributeName to obtain the attribute value.
         * @param string $name the attribute name
         * @return mixed the attribute value. Null if the attribute is not set or does not exist.
         * @see hasAttribute
         */
        public function getAttribute ( $name )
        {
                if ( property_exists ( $this,$name ) )
                        return $this -> $name;
                else if ( isset ( $this -> _attributes[ $name ] ) )
                        return $this -> _attributes[ $name ];
        }

        /**
         * Sets the named attribute value.
         * You may also use $this->AttributeName to set the attribute value.
         * @param string $name the attribute name
         * @param mixed $value the attribute value.
         * @return boolean whether the attribute exists and the assignment is conducted successfully
         * @see hasAttribute
         */
        public function setAttribute ( $name,$value )
        {
                if ( property_exists ( $this,$name ) )
                        $this -> $name = $value;
                else if ( isset ( $this -> getMetaData () -> columns[ $name ] ) )
                        $this -> _attributes[ $name ] = $value;
                else
                        return false;
                return true;
        }

        public function getAttributeHint ( $attribute )
        {
                $hints = $this -> attributeHints ();
                if ( isset ( $hints[ $attribute ] ) )
                        return $hints[ $attribute ];
                else
                        return $this -> generateAttributeHint ( $attribute );
        }

        public function generateAttributeHint ( $name )
        {
                return ucwords ( trim ( strtolower ( str_replace ( array ( '-','_','.' ),' ',preg_replace ( '/(?<![A-Z])[A-Z]/',' \0',$name ) ) ) ) );
        }

        public function attributeNames ()
        {
                return array_keys ( $this -> getMetaData () -> columns );
        }

        public function attributeHints ()
        {
                return  array();
        }

        public function setDefaultAttributes ()
        {
                return $this -> _attributes = $this -> getMetaData () -> attributeDefaults;
        }

}