<?php

    /**
     * LoginForm class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 登陆模型
     * 
     * @version $Id: LoginForm.php UTF-8 2011-5-28 15:47:13 li feixiang 
     * @package backend-model
     * @since 1.0
     * 
     */
    class LoginForm extends CFormModel
    {

        public $username;
        public $password;
        public $rememberMe = false;
        private $_identity;

        function rules()
        {
            return array(
                    array('username, password', 'required'),
                    array('rememberMe', 'boolean'),
                    array('password', 'authenticate'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                    'password' => Ycms::t('login', '密码'),
                    'username' => Ycms::t('login', '用户名'),
            );
        }

        public function authenticate($attribute, $params)
        {
            if (!$this->hasErrors())
            {

                $this->_identity = new YUserIdentity($this->username, $this->password);
                $auth_errorcode = $this->_identity->authenticate();
                if ($auth_errorcode === YUserIdentity::ERROR_USERNAME_INVALID)
                {
                    $this->addError('username', '用户名无效。');
                    return FALSE;
                }
                elseif ($auth_errorcode === YUserIdentity::ERROR_PASSWORD_INVALID)
                {
                    $this->addError('password', '密码错误。');
                    return FALSE;
                }
                else
                {
                    return true;
                }
            }
        }

        public function login()
        {
            if ($this->_identity == NULL)
            {
                $this->_identity = new YUserIdentity($this->username, $this->password);
            }
            if ($this->_identity->authenticate() === YUserIdentity::ERROR_NONE)
            {
                $duration = 0;
                if ($this->rememberMe)
                {
                    $duration = 2 * 24 * 3600;
                }
                Yii::app()->user->login($this->_identity, $duration);
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }

    }