<?php

        class GameObject extends Object
        {

                public $new_service;
                public $service_url;
                public $site_url;
                public $help_url;
                public $card_url;
                public $bbs_url;
                public $ico_logo;
                public $small_logo;
                public $medium_logo;
                public $big_logo;
                public $game_banner;
                public $game_sn;
                public $ratio;
                public $money_name;
                public $stars;

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
                                                    array('ratio,money_name,game_sn', 'required'),
                                                    array('ratio,stars', 'numerical', 'integerOnly' => true),
                                                    array('service_url,site_url, help_url, card_url,bbs_url', 'safe'),
                                                    array('ico_logo,  small_logo, medium_logo,big_logo,game_banner', 'safe'),
                                                    array('new_service', 'safe'),
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
                                                    'new_service' => t('新服状态'),
                                                    'service_url' => t('新服地址'),
                                                    'site_url' => t('网站地址'),
                                                    'help_url' => t('帮助地址'),
                                                    'card_url' => t('充值卡地址'),
                                                    'bbs_url' => t('论坛地址'),
                                                    'ico_logo' => t('游戏小图标'),
                                                    'small_logo' => t('充值页面图标'),
                                                    'medium_logo' => t('列表页图标'),
                                                    'big_logo' => t('首页图标'),
                                                    'game_sn' => t('游戏编号'),
                                                    'ratio' => t('游戏币兑换比例'),
                                                    'money_name' => t('游戏币名称'),
                                                    'stars' => t('推荐级别'),
                                                    'game_banner'=>t('游戏广告'),
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
                                        $this->object_type = 'game';
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
                                Object::saveMetaValue('new_service', $this->new_service, $this, true);
                                Object::saveMetaValue('service_url', $this->service_url, $this, true);
                                Object::saveMetaValue('site_url', $this->site_url, $this, true);
                                Object::saveMetaValue('help_url', $this->help_url, $this, true);
                                Object::saveMetaValue('card_url', $this->card_url, $this, true);
                                Object::saveMetaValue('bbs_url', $this->bbs_url, $this, true);
                                Object::saveMetaValue('ico_logo', $this->ico_logo, $this, true);
                                Object::saveMetaValue('small_logo', $this->small_logo, $this, true);
                                Object::saveMetaValue('medium_logo', $this->medium_logo, $this, true);
                                Object::saveMetaValue('big_logo', $this->big_logo, $this, true);
                                Object::saveMetaValue('game_sn', $this->game_sn, $this, true);
                                Object::saveMetaValue('ratio', $this->ratio, $this, true);
                                Object::saveMetaValue('money_name', $this->money_name, $this, true);
                                Object::saveMetaValue('stars', $this->stars, $this, true);
                                Object::saveMetaValue('game_banner', $this->game_banner, $this, true);
                        }
                        else
                        {
                                Object::saveMetaValue('new_service', $this->new_service, $this, false);
                                Object::saveMetaValue('service_url', $this->service_url, $this, false);
                                Object::saveMetaValue('site_url', $this->site_url, $this, false);
                                Object::saveMetaValue('help_url', $this->help_url, $this, false);
                                Object::saveMetaValue('card_url', $this->card_url, $this, false);
                                Object::saveMetaValue('bbs_url', $this->bbs_url, $this, false);
                                Object::saveMetaValue('ico_logo', $this->ico_logo, $this, false);
                                Object::saveMetaValue('small_logo', $this->small_logo, $this, false);
                                Object::saveMetaValue('medium_logo', $this->medium_logo, $this, false);
                                Object::saveMetaValue('big_logo', $this->big_logo, $this, false);
                                Object::saveMetaValue('game_sn', $this->game_sn, $this, false);
                                Object::saveMetaValue('ratio', $this->ratio, $this, FALSE);
                                Object::saveMetaValue('money_name', $this->money_name, $this, FALSE);
                                Object::saveMetaValue('stars', $this->stars, $this, FALSE);
                                Object::saveMetaValue('game_banner', $this->game_banner, $this, false);
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