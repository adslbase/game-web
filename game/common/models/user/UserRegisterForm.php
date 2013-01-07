<?php

/**
 * This is the model class for Register Form.
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class UserRegisterForm extends CFormModel {

        public $username;
        public $email;
        public $password;
        public $password2;
        public $realname;
        public $sfzh;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules() {
                return array(
                    // username, email and password are required
                    array('username, email, password', 'required'),
                    // email need to be email style
                    array('email', 'email', 'message' => t('你输入的邮箱格式不正确')),
                    array('password2', 'compare', 'compareAttribute' => 'password'),
                    array('email', 'unique',
                        'attributeName' => 'email',
                        'className' => 'common.models.user.User',
                        'message' => t('邮箱已经被注册!')),
                    array('sfzh', 'common.extensions.validators.IdCardValidator'),
                    array('realname', 'safe'),
                );
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels() {
                return array(
                    'username' => t('用户名'),
                    'email' => t('邮箱'),
                    'password' => t('密码'),
                    'password2' => t('重复密码'),
                    'realname' => t('真实姓名'),
                    'sfzh' => t('身份证号码'),
                );
        }

        /**
         * Function to Register user information
         * @return type 
         */
        public function doSignUp() {
                if (!$this->hasErrors()) {
                        $newUser = new User;

                        $newUser->password = $this->password;

                        if (!$newUser->save()) {
                                $this->addError('email', t('Something is wrong with the Registration Process. Please try again later!'));
                                return false;
                        } else {
                                //We can start to add Profile record here                            				
                                //We can start to add User Activity here
                                //We can check to send Email or not   
                                //Create new UserLoginForm
                                $login_form = new UserLoginForm();
                                $login_form->username = $newUser->username;
                                $login_form->password = $this->password;
                                return $login_form->login();
                        }
                }
        }

}

