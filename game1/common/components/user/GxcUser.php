<?php

        /**
         * Class User of GXC CMS, extends from CWebUser
         * 
         * 
         * @author lifeixiang  <250994229@qq.com>
         * @version 1.0
         * @package cms.components.user
         */
        class GxcUser extends RWebUser
        {

                /** This is a function that checks the field 'role'
                 * in the User model to be equal to 1, that means it's admin
                 * 
                 * access it by Yii::app()->user->isAdmin()
                 */
                public function getisAdmin()
                {
                        if (($roles = User::getStringRoles(user()->id)) != '')
                        {
                                $res = strpos('Admin', User::getStringRoles(user()->id));
                                return (($res !== false));
                        }
                        return false;
                }

        }

?>
