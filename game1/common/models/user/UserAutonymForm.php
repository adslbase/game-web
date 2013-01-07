<?php

class UserAutonymForm extends CFormModel {

        public $realname;
        public $sfzh;

        /**
         * Declares the validation rules.
         * The rules state that username and password are required,
         * and password needs to be authenticated.
         */
        public function rules() {
                return array(
                    array('realname,sfzh', 'required'),
                    array('sfzh', 'common.extensions.validators.IdCardValidator'),
                );
        }

   
        /**
         * Declares attribute labels.
         */
        public function attributeLabels() {
                return array(
                    'realname' => t('真实姓名'),
                    'sfzh' => t('身份证号码'),
                );
        }

}