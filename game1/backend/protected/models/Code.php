<?php

        class Code extends CActiveRecord
        {

                public static function model($className = __CLASS__)
                {
                        return parent::model($className);
                }

                /**
                 * @return string the associated database table name
                 */
                public function tableName()
                {
                        return '{{code}}';
                }

                /**
                 * Declares the validation rules.
                 * The rules state that username and password are required,
                 * and password needs to be authenticated.
                 */
                public function rules()
                {
                        return array(
                                    array('gameid,serverid,cardid,userid','numerical', 'integerOnly' => true),
                                    array('addtime,key', 'safe'),
                        );
                }
                

                /**
                 * Declares attribute labels.
                 */
                public function attributeLabels()
                {
                        return array(
                                    'gameid' => t('游戏'),
                                    'serverid' => t('服务器'),
                                    'cardid' => t('新手卡ID'),
                                    'userid' => t('用户'),
                                    'key' => t('激活码')
                        );
                }

        }