<?php

/**
 * YOutputFormat class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined ( 'INYCMS' ) or die;

/**
 * 这个类实干什么用的
 * 
 * @version $Id: YOutputFormat.php UTF-8 2011-5-2 18:56:56 li feixiang 
 * @package string
 * @since 1.0
 * 
 */
class YFormatter extends CFormatter
{

        public $behaviors = array ( );

        /**
         * $type 如果是数组的情况
         * @param type $value
         * @param type $type
         * @return type 
         */
        public function format ( $value,$type )
        {
                $method = 'format' . $type;
                if ( method_exists ( $this,$method ) )
                        return $this -> $method ( $value );
                else
                        throw new CException ( Yii::t ( 'yii','Unknown type "{type}".',array ( '{type}' => $type ) ) );
        }

        public function formatI18nDate ( $value )
        {
                return date ( $this -> dateFormat,$value );
        }

        //这些函数的好处，如果数据库存储的不是序列化字符，则可以不反序列化，避免错误
        public static function maybeSerialize ( $data )
        {
                if ( is_array ( $data ) || is_object ( $data ) )
                        return serialize ( $data );

                if ( self::isSerialized ( $data ) )
                        return serialize ( $data );

                return $data;
        }

        public static function maybeUnserialize ( $original )
        {
                if ( self::isSerialized ( $original ) )
                        return @unserialize ( $original );
                return $original;
        }

        public static function isSerialized ( $data )
        {
                if ( ! is_string ( $data ) )
                        return false;
                $data = trim ( $data );
                if ( 'N;' == $data )
                        return true;
                $length = strlen ( $data );
                if ( $length < 4 )
                        return false;
                if ( ':' !== $data[ 1 ] )
                        return false;
                $lastc = $data[ $length - 1 ];
                if ( ';' !== $lastc && '}' !== $lastc )
                        return false;
                $token = $data[ 0 ];
                switch ( $token )
                {
                        case 's' :
                                if ( '"' !== $data[ $length - 2 ] )
                                        return false;
                        case 'a' :
                        case 'O' :
                                return ( bool )preg_match ( "/^{$token}:[0-9]+:/s",$data );
                        case 'b' :
                        case 'i' :
                        case 'd' :
                                return ( bool )preg_match ( "/^{$token}:[0-9.E-]+;\$/",$data );
                }
                return false;
        }

}
