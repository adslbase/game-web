<?php

        /**
         * This is the model class for Create User.
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package cms.models.user
         *
         */
        class UserCreateForm extends CFormModel
        {

                public $username;
                public $realname;
                public $password;
                public $email;
                public $sfzh;

                /**
                 * Declares the validation rules.
                 * The rules state that username and password are required,
                 * and password needs to be authenticated.
                 */
                public function rules()
                {
                        return array(
                                    array('username, realname,sfzh, email, password', 'required'),
                                    array('realname', 'length', 'max' => 255),
                                    array('password', 'length', 'min' => 3),
                                    array('email, username', 'length', 'max' => 128),
                                    array('email', 'email', 'message' => t('邮箱不合法')),
                                    array('email', 'unique',
                                                'attributeName' => 'email',
                                                'className' => 'common.models.user.User',
                                                'message' => t('邮箱已经被注册.')),
                                    array('username', 'unique',
                                                'attributeName' => 'username',
                                                'className' => 'common.models.user.User',
                                                'message' => t('用户名已经被注册.')),
                                    array('sfzh','safe')
                        );
                }

                /**
                 * Declares attribute labels.
                 */
                public function attributeLabels()
                {
                        return array(
                                    'username' => t('用户名'),
                                    'sfzh' => t('身份证号码'),
                                    'password' => t('密码'),
                                    'email' => t('邮箱'),
                                    'realname' => t('真实姓名')
                        );
                }

        }