<?php

        /**
         * This is the model class for Login Form.
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package cms.models.user
         *
         */
        class UserLoginForm extends CFormModel
        {

                public $username;
                public $password;
                public $rememberMe;
                private $_identity;

                /**
                 * Declares the validation rules.
                 * The rules state that username and password are required,
                 * and password needs to be authenticated.
                 */
                public function rules()
                {
                        return array(
                                    // username and password are required
                                    array('username', 'required', 'message' => '用户名不能为空！'),
                                    array('password', 'required', 'message' => '密码不能为空！'),
                                    // rememberMe needs to be a boolean
                                    array('rememberMe', 'boolean'),
                                    // password needs to be authenticated
                                    array('password', 'authenticate'),
                        );
                }

                /**
                 * Declares attribute labels.
                 */
                public function attributeLabels()
                {
                        return array(
                                    'username' => t('用户名'),
                                    'rememberMe' => t('记住我'),
                        );
                }

                /**
                 * Authenticates the password.
                 * This is the 'authenticate' validator as declared in rules().
                 */
                public function authenticate($attribute, $params)
                {
                        if (!$this->hasErrors())
                        {

                                $this->username = fn_clean_input($this->username);
                                $this->_identity = new UserIdentityDb($this->username, $this->password);

                                if ($this->_identity->authenticate() > 0)
                                {
                                        switch ($this->_identity->errorCode)
                                        {
                                                case UserIdentityDb::ERROR_NOMEMBER :
                                                        $new_user = new User;
                                                        $new_user->user_id = $this->_identity->id;
                                                        $new_user->scenario = 'create';
                                                        $new_user->username = $this->_identity->username;
                                                        $new_user->email = $this->_identity->email;
                                                        if ($new_user->save(FALSE) == FALSE)
                                                        {
                                                                $this->addError('username', t('用户ID已存在，请联系管理员！'));
                                                        }
                                                        else
                                                        {
                                                                $this->_identity->errorCode = UserIdentityDb::ERROR_NONE;
                                                        }
                                                        break;
                                                case UserIdentityDb::ERROR_USERNAME_INVALID:
                                                        $this->addError('username', '用户名无效。');
                                                        break;
                                                case UserIdentityDb::ERROR_PASSWORD_INVALID:
                                                        $this->addError('password', '密码错误。');
                                                        break;
                                                case UserIdentityDb::ERROR_UNKNOWN_IDENTITY:
                                                        $this->addError('username', '未知错误');
                                                        break;

                                                default :
                                                        $this->addError('password', t('用户名或者密码错误.'));
                                                        break;
                                        }
                                }
                        }
                }

                /**
                 * Logs in the user using the given username and password in the model.
                 * @return boolean whether login is successful
                 */
                public function login()
                {
                        if ($this->_identity === null)
                        {
                                $this->_identity = new UserIdentityDb($this->username, $this->password);
                                $this->_identity->authenticate();
                        }

                        if ($this->_identity->errorCode == UserIdentityDb::ERROR_NONE)
                        {

                                if ($this->rememberMe)
                                {
                                        $duration = 3600 * 24 * 30; // 30 days
                                        //在session里面写入账号保存时间。因为需同步登陆,不能直接操作该值，先保存在session里在登陆后取出使用
                                        Yii::app()->getUser()->setState('duration', $duration);
                                }
                                return UcenterApi::getInstance()->userSynlogin($this->_identity->id);
                        }
                        return FALSE;
                }

        }

        