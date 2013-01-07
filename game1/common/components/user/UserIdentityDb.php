<?php

        /**
         * Class to Identity User by Database Information.
         * 
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package cms.components.user
         */
        class UserIdentityDb extends CUserIdentity
        {

                const ERROR_NOMEMBER = 3; // ucenter中有用户。应用中无该用户

                /**
                 *
                 * @var int Id of the User
                 */

                public $id;
                public $email;

                /**
                 * This function check the user Authentication 
                 * 
                 * @return int 
                 */
                public function authenticate()
                {

                        list($this->id, $this->username, $this->password, $this->email) = UcenterApi::getInstance()->userLogin($this->username, $this->password);

                        if ($this->id > 0)
                        {
                                $user = User::model()->find('user_id=:id', array(':id' => $this->id));

                                if ($user === null)
                                {
                                        $this->errorCode = self::ERROR_NOMEMBER;
                                }
                                else
                                {
                                        $user->recent_login = SYS_TIME;
                                        $user->loginip = ip();
                                        $user->save(FALSE);
                                        $this->errorCode = self::ERROR_NONE;
                                }
                        }
                        elseif ($this->id == -1)
                        {
                                $this->errorCode = self::ERROR_USERNAME_INVALID;
                        }
                        elseif ($this->id == -2)
                        {
                                $this->errorCode = self::ERROR_PASSWORD_INVALID;
                        }
                        else
                        {
                                $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
                        }

                        unset($user);

                        return $this->errorCode;
                }

                public function getId()
                {
                        return $this->id;
                }

        }

?>
