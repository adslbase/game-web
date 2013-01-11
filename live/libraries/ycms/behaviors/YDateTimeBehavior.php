<?php

/**
 * YDateTimeBehavior class file.
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
 * @version $Id: YDateTimeBehavior.php UTF-8 2011-5-22 20:59:17 li feixiang
 * @package ycms
 * @since 1.0
 * 
 */
class YDateTimeBehavior extends CModelBehavior
{

        //储存在行为里
        public function tTime ( $time,$dateWidth='medium',$timeWidth='medium',$emptyInfo='' )
        {
                $timestamp = CDateTimeParser::parse ( $time,'yyyy-MM-dd hh:mm:ss' );//转换为时间戳。储存时date(Y-m-d H:i:s)

                if ( $timestamp === false && $emptyInfo !== '' )
                        return $emptyInfo;
                else
                        $result = Ycms::app () -> dateFormatter -> formatDateTime ( $timestamp,$dateWidth,$timeWidth );

                return $result;
        }

        /**
         * $data 通常为queryall或者queryrow返回的一行或者多行数据
         * @param type $data
         * @param type $field
         * @return type 
         */
        public function formatDateTimeAttribute ( $data,$fields )
        {

                $dimensional = false;

                if ( count ( $data ) === count ( $data,1 ) )
                {
                        $data = array ( $data );
                        $dimensional = true;
                }

                $i = 0;
                
                foreach ( $fields as $key => $field )
                {
                        $i += isset ( $data[ 0 ][ $key ] );
                }
                
                if ( $i > 0 )
                {
                        $items = array ( );
                        foreach ( $data as $row )
                        {
                                foreach ( $fields as  $key => $field )
                                {
                                       $row[ $key ] = $this ->  tTime($row[ $key ],$field[0],$field[1],$field[2]);
                                }
                                $items[ ] = $row;
                        }
                        
                        if ( $dimensional === TRUE )
                        {
                                return reset ( $items );
                        }

                        return $items;
                }

                if ( $dimensional === TRUE )
                {
                        return reset ( $data );
                }

                return $data;
        }

}