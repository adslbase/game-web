<?php

/**
 * This is the model class for Changing User Profile.
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class UserProfileForm extends CFormModel {

        public $email;
        public $qq;
        public $phone;
        public $u;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules() {
                return array(
                    array('email', 'required'),
                    array('email', 'length', 'max' => 128),
                    array('email', 'email', 'message' => t('Email验证失败')),
                    array('email', 'checkEmailValid'),
                    array('qq,phone', 'safe'),
                );
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels() {
                return array(
                    'email' => t('邮箱'),
                    'phone' => t('手机'),
                    'qq' => t('QQ/MSN'),
                );
        }

        /**
         * Check if the user updated his email ok or not
         * This is the 'checkEmailValid' validator as declared in rules().
         */
        public function checkEmailValid($attribute, $params) {

                if (!$this->hasErrors()) {
                        if (empty($this->u)) {
                                $this->u = User::model()->findbyPk(user()->id);
                        }
                        if ($this->u != null) {
                                
                                if ($this->u->email == $this->email) {
                                        return true;
                                }
                           
                                $ucresult = UcenterApi::getInstance()->userEdit($this->u->username, '', '', $this->email,1);
                     
                                if ($ucresult == 1 || $ucresult == 0) {
                                        return TRUE;
                                } else {
                                        if ($ucresult == -1) {
                                                $this->addError($attribute, t('密码错误，请确认你输入的密码正确！'));
                                        } elseif ($ucresult == -4) {
                                                $this->addError($attribute, t('Email 格式有误'));
                                        } elseif ($ucresult == -5) {
                                                $this->addError($attribute, t('Email 不允许注册'));
                                        } elseif ($ucresult == -6) {
                                                $this->addError($attribute, t('该 Email 已经被注册'));
                                        }
                                        elseif($ucresult==-8)
                                        {
                                                $this->addError($attribute, t('该用户受保护，无权更改该用户'));
                                        }
                                        return false;
                                }
                        } else {
                                $this->addError($attribute, t('用户不存在!'));
                                return false;
                        }
                }
        }

}