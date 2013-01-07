<?php

/**
 * This is the model class for Change Password Form.
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package cms.models.user
 *
 */
class UserChangePassForm extends CFormModel {

        public $old_password;
        public $new_password_1;
        public $new_password_2;
        public $u;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules() {
                return array(
                    array('old_password, new_password_1, new_password_2', 'required'),
                    array('old_password', 'checkOldPass'),
                    array('new_password_2', 'checkNewPass')
                );
        }

        /**
         * Check the old pass is Ok or not
         * 
         * @param array $attribute
         * @param array $params
         * @return boolean 
         */
        public function checkOldPass($attribute, $params) {

                if (empty($this->u)) {
                        $this->u = User::model()->findbyPk(user()->id);
                }

                if ($this->u != null) {

                        $ucresult = UcenterApi::getInstance()->userEdit($this->u->username, $this->old_password, $this->new_password_1);
                        if ($ucresult == 1 || $ucresult == 0) {
                                return TRUE;
                        } else {
                                if ($ucresult == -1) {
                                        $this->addError($attribute, t('旧密码错误，请重新验证！'));
                                } elseif ($ucresult == -4) {
                                        $this->addError($attribute, t('Email 格式有误'));
                                } elseif ($ucresult == -5) {
                                        $this->addError($attribute, t('Email 不允许注册'));
                                } elseif ($ucresult == -6) {
                                        $this->addError($attribute, t('该 Email 已经被注册'));
                                }
                                return false;
                        }
                } else {
                        $this->addError($attribute, t('用户不存在!'));
                        return false;
                }
        }

        /**
         * Compare the two new password match or not
         * @param array $attribute
         * @param array $params
         * @return boolean
         */
        public function checkNewPass($attribute, $params) {
                if ($this->new_password_1 != $this->new_password_2) {
                        $this->addError($attribute, t('两次新密码输入不一致'));
                        return false;
                }
        }

        /**
         * Declares attribute labels.
         */
        public function attributeLabels() {
                return array(
                    'old_password' => t('旧密码'),
                    'new_password_1' => t('新密码'),
                    'new_password_2' => t('重复新密码')
                );
        }

}