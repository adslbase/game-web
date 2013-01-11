<?php

/**
 * YWebUser class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined ( 'INYCMS' ) or die;

/**
 * 用户类
 * 
 * @version $Id: YWebUser.php UTF-8 2011-5-2 18:33:31 li feixiang 
 * @package auth
 * @since 1.0
 * 
 */
class YWebUser extends CWebUser
{

        private $_access = array ( );

        protected function afterLogin ( $fromCookie )
        {
                date_default_timezone_set ( $this -> getUserTimezone () );

                //获取用户语言
        }

        public function getUserTimezone ()
        {
                if ( $this -> getIsGuest () === FALSE && $this -> getState ( 'timezone' ) !== null )
                {
                        return $this -> getState ( 'timezone' );
                }
                else
                {
                        return Ycms::app () -> getTimeZone ();
                }
        }

        /**
         * Return admin status.
         * @return boolean
         */
        public function isAdmin ()
        {
                if ( $user -> getIsGuest () === FALSE )
                        return false;
                else
                {
                        return Yii::app () -> user -> data () -> superuser;

                        $user = $this -> loadUser ( Yii::app () -> user -> id );
                        return intval ( $user -> role ) == 1;
                }
        }

        public function checkAccess ( $operation,$params=array ( ),$allowCaching=true )
        {
                if ( $allowCaching && $params === array ( ) && isset ( $this -> _access[ $operation ] ) )
                {
                        return $this -> _access[ $operation ];
                }
                else
                {
                        $itemModel = YController::loadDaoModel ( 'backendApp.models.AuthItem','insert',false );

                        $assignments = $itemModel -> getAuthAssignments ( $this -> getId () );

                        return $this -> _access[ $operation ] = $itemModel -> checkAccessRecursive ( $operation,$this -> getId (),$params,$assignments );
                }
        }

        /**
         * Redirects the user browser to the login page.
         * Before the redirection, the current URL (if it's not an AJAX url) will be
         * kept in {@link returnUrl} so that the user browser may be redirected back
         * to the current page after successful login. Make sure you set {@link loginUrl}
         * so that the user browser can be redirected to the specified login URL after
         * calling this method.
         * After calling this method, the current request processing will be terminated.
         */
        public function loginRequired ()
        {
                $app = Yii::app ();
                $request = $app -> getRequest ();

                if ( ! $request -> getIsAjaxRequest () )
                        $this -> setReturnUrl ( $request -> getUrl () );

                if ( ($url = $this -> getLoginUrl ()) !== null )
                {
                        if ( is_array ( $url ) )
                        {
                                $route = isset ( $url[ 0 ] ) ? $url[ 0 ] : $app -> defaultController;
                                $url = $app -> createUrl ( $route,array_splice ( $url,1 ) );
                        }
                        $request -> redirect ( $url );
                }
                else
                        throw new CHttpException ( 403,Yii::t ( 'yii','Login Required' ) );
        }

        /**
         * 登陆地址，验证失败时，会跳转到这个地址
         * @return type 
         */
        public function getLoginUrl ()
        {

                if ( Ycms::app () -> name === 'backend' )
                {
                        return array ( '/login/login' );
                }
                else if ( Ycms::app () -> name === 'frontend' )
                {
                        return $this -> loginUrl;
                }
        }

        /**
         * Checks if this (non-admin) User can administrate some users
         */
        public static function hasUsers ( $uid = 0 )
        {
                if ( $uid == 0 )
                        $uid = Yii::app () -> user -> id;

                $user = YumUser::model () -> findByPk ( $uid );

                return isset ( $user -> users ) && $user -> users !== array ( );
        }

        public static function hasRoles ( $uid = 0 )
        {
                if ( $uid == 0 )
                        $uid = Yii::app () -> user -> id;

                $user = YumUser::model () -> findByPk ( $uid );

                $flag = false;
                if ( isset ( $user -> roles ) )
                        foreach ( $user -> roles as $role )
                                if ( isset ( $role -> roles ) && $role -> roles !== array ( ) )
                                        $flag = true;

                return $flag;
        }

        /**
         * Checks if this (non-admin) User can administrate the given user
         */
        public static function hasUser ( $username,$uid = 0 )
        {
                if ( $uid == 0 )
                        $uid = Yii::app () -> user -> getId ();

                // Every user can modify himself
                if ( $username == $uid )
                        return true;

                $user = YumUser::model () -> findByPk ( $uid );

                if ( ! is_array ( $username ) )
                        $username = array ( $username );

                if ( isset ( $user -> users ) )
                        foreach ( $user -> users as $userobj )
                        {
                                if ( in_array ( $userobj -> username,$username ) ||
                                        in_array ( $userobj -> id,$username ) )
                                        return true;
                        }
                return false;
        }

        /**
         * Checks if the user has the given Role
         * @mixed Role string or array of strings that should be checked
         * @int (optional) id of the user that should be checked 
         * @return bool Return value tells if the User has access or hasn't access.
         */
        public static function hasRole ( $role,$uid = 0 )
        {
                if ( $uid == 0 )
                        $uid = Yii::app () -> user -> id;

                if ( ! is_array ( $role ) )
                        $role = array ( $role );

                if ( $user = YumUser::model () -> findByPk ( $uid ) )
                {
                        // Check if a user has a active membership and, if so, add this
                        // to the roles
                        $roles = array_merge ( $user -> roles,$user -> getActiveMemberships () );

                        if ( isset ( $roles ) )
                                foreach ( $roles as $roleobj )
                                {
                                        if ( in_array ( $roleobj -> title,$role ) ||
                                                in_array ( $roleobj -> id,$role ) )
                                                return true;
                                }
                }

                return false;
        }

}