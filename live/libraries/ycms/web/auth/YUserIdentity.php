<?php

/**
 * YUserIdentity class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined ( 'INYCMS' ) or die;
Ycms::import ( Ycms::app () -> name . 'App.models.User' );

/**
 * 这个类实干什么用的
 * 
 * @version $Id: YUserIdentity.php UTF-8 2011-5-22 14:35:07 li feixiang
 * @package ycms
 * @since 1.0
 * 
 */
class YUserIdentity extends CUserIdentity
{
        const ERROR_EMAIL_INVALID=3;
        const ERROR_STATUS_NOTACTIV=4;
        const ERROR_STATUS_BAN=5;

        private $_id;

        /**
         * Authenticates a user.
         * The example implementation makes sure if the username and password
         * are both 'demo'.
         * In practical applications, this should be changed to authenticate
         * against some persistent user identity storage (e.g. database).
         * @return boolean whether authentication succeeds.
         */
        public function authenticate ()
        {

                $model = YController::loadDaoModel ( 'User' );


                $fields = 'user_id,user_name,pass,theme,status,timezone,language';


                if ( strpos ( $this -> username,"@" ) && ($user = $model -> getUserBymail ( $this -> username,$fields )) === false )
                {
                        $this -> errorCode = self::ERROR_EMAIL_INVALID;
                }
                else if ( ($user = $model -> getUserByname ( $this -> username,$fields )) === false )
                {
                        $this -> errorCode = self::ERROR_USERNAME_INVALID;
                }
                else
                {
                        if ( $model -> CheckPassword ( $this -> password,$user[ 'pass' ] ) === FALSE )
                                $this -> errorCode = self::ERROR_PASSWORD_INVALID;
                        else if ( $user[ 'status' ] == 0 )
                                $this -> errorCode = self::ERROR_STATUS_NOTACTIV;
                        else if ( $user[ 'status' ] == -1 )
                                $this -> errorCode = self::ERROR_STATUS_BAN;
                        else
                        {
                                $this -> errorCode = self::ERROR_NONE;
                                $this -> _id = $user[ 'user_id' ];
                                $this -> username = $user[ 'user_name' ];

                                unset ( $user[ 'user_id' ] );
                                unset ( $user[ 'user_name' ] );
                                unset ( $user[ 'pass' ] );
                                unset ( $user[ 'email' ] );

                                $this -> setPersistentStates ( $user );
                        }
                }
                return $this -> errorCode;
        }

        //如果不覆写getID(),Yii::app()->user->login($identity);中会用username作为id保存进session
        //默认情况下.登陆后,会将$identity->getId()和$identity->getName().以及$identity->getPersistentStates();中的数据保存到session
        public function getId ()
        {
                return $this -> _id;
        }

}