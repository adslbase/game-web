<?php

        class CardObject extends Object
        {
                public $card_logo;
                public $card_explain;
                public $card_reward;
                

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
                                                    array('card_explain,card_reward', 'required'),
                                                    array('card_logo', 'safe'),
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
                                                    'card_logo' => t('新手卡LOGO'),
                                                    'card_explain' => t('激活说明'),
                                                    'card_reward' => t('礼包详情'),
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
                                        $this->object_type = 'card';
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
                                Object::saveMetaValue('card_logo', $this->card_logo, $this, true);
                                Object::saveMetaValue('card_explain', $this->card_explain, $this, true);
                                Object::saveMetaValue('card_reward', $this->card_reward, $this, true);
                        }
                        else
                        {
                                Object::saveMetaValue('card_logo', $this->card_logo, $this, FALSE);
                                Object::saveMetaValue('card_explain', $this->card_explain, $this, FALSE);
                                Object::saveMetaValue('card_reward', $this->card_reward, $this, FALSE);
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