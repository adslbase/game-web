<?php

        class ServerObject extends Object
        {

                public $server_band;
                public $server_online;
                public $server_date;
                public $server_time;
                public $server_sn;
                public $server_key;
                public $server_ico;
                public $server_framelogo;
                public $server_status;
                public $server_login_gateway;
                public $server_pay_gateway;
                public $server_is_pay;

                /**
                 * Returns the static model of the specified AR class.
                 * @return Object the static model class
                 */
                public static function model($className = __CLASS__)
                {
                        return parent::model($className);
                }

                /**
                 * @return string the associated database table name
                 */
                public function tableName()
                {
                        return '{{object}}';
                }

                /**
                 * @return array validation rules for model attributes.
                 */
                public function rules()
                {
                        return CMap::mergeArray(array(
                                                    array('server_band,server_sn,object_parent,server_key', 'required'),
                                                    array('server_online,server_status,server_is_pay', 'numerical', 'integerOnly' => true),
//                                                    array('server_date', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'),
//                                                    array('server_time', 'type', 'type' => 'time', 'timeFormat' => 'hh:mm'),
                                                    array('server_pay_gateway,server_login_gateway', 'url'),
                                                    array('server_ico,server_framelogo,server_date,server_time', 'safe'),
                                                        ), Object::extraRules());
                }

                /**
                 * @return array relational rules.
                 */
                public function relations()
                {
                        return CMap::mergeArray(array(), Object::extraRelationships());
                }

                /**
                 * @return array customized attribute labels (name=>label)
                 */
                public function attributeLabels()
                {
                        return CMap::mergeArray(array(
                                                    'server_band' => t('服务器线路'),
                                                    'server_online' => t('空闲上线人数'),
                                                    'server_date' => t('开服日期'),
                                                    'server_time' => t('开服时间'),
                                                    'server_sn' => t('服务器编号'),
                                                    'server_key' => t('服务器密钥'),
                                                    'server_status' => t('服务器状态'),
                                                    'server_ico' => t('服务器图标'),
                                                    'server_framelogo' => t('入场logo'),
                                                    'server_login_gateway' => t('登陆网关'),
                                                    'server_pay_gateway' => t('支付网关'),
                                                    'server_is_pay' => t('是否开启支付'),
                                                        ), Object::extraLabel());
                }

                /**
                 * Retrieves a list of models based on the current search/filter conditions.
                 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
                 */
                public function search()
                {
                        return Object::extraSearch($this);
                }

                protected function beforeSave()
                {
                        if (parent::beforeSave())
                        {
                                if ($this->isNewRecord)
                                {
                                        $this->object_type = 'server';
                                        Object::extraBeforeSave($this, 'create');
                                }
                                else
                                {
                                        Object::extraBeforeSave($this, 'update');
                                }
                                return true;
                        }
                        else
                                return false;
                }

                protected function afterSave()
                {
                        parent::afterSave();
                        if ($this->isNewRecord)
                        {
                                Object::saveMetaValue('server_band', $this->server_band, $this, true);
                                Object::saveMetaValue('server_online', $this->server_online, $this, true);
                                Object::saveMetaValue('server_date', $this->server_date, $this, true);
                                Object::saveMetaValue('server_time', $this->server_time, $this, true);
                                Object::saveMetaValue('server_sn', $this->server_sn, $this, true);
                                Object::saveMetaValue('server_key', $this->server_key, $this, true);
                                Object::saveMetaValue('server_ico', $this->server_ico, $this, true);
                                Object::saveMetaValue('server_framelogo', $this->server_framelogo, $this, true);
                                Object::saveMetaValue('server_status', $this->server_status, $this, true);
                                Object::saveMetaValue('server_login_gateway', $this->server_login_gateway, $this, true);
                                Object::saveMetaValue('server_pay_gateway', $this->server_pay_gateway, $this, true);
                                Object::saveMetaValue('server_is_pay', $this->server_is_pay, $this, true);
                        }
                        else
                        {
                                Object::saveMetaValue('server_band', $this->server_band, $this, false);
                                Object::saveMetaValue('server_online', $this->server_online, $this, false);
                                Object::saveMetaValue('server_date', $this->server_date, $this, false);
                                Object::saveMetaValue('server_time', $this->server_time, $this, false);
                                Object::saveMetaValue('server_sn', $this->server_sn, $this, false);
                                Object::saveMetaValue('server_key', $this->server_key, $this, false);
                                Object::saveMetaValue('server_ico', $this->server_ico, $this, false);
                                Object::saveMetaValue('server_framelogo', $this->server_framelogo, $this, false);
                                Object::saveMetaValue('server_status', $this->server_status, $this, FALSE);
                                Object::saveMetaValue('server_login_gateway', $this->server_login_gateway, $this, false);
                                Object::saveMetaValue('server_pay_gateway', $this->server_pay_gateway, $this, false);
                                Object::saveMetaValue('server_is_pay', $this->server_is_pay, $this, false);
                        }
                }

                public static function Resources()
                {
                        return Object::Resources();
                }

                public static function Permissions()
                {
                        return Object::Permissions();
                }

        }