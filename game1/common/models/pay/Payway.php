<?php

/**
 * This is the model class for table "{{auth_assignment}}".
 *
 * The followings are the available columns in table '{{auth_assignment}}':
 * @property string $itemname
 * @property string $userid
 * @property string $bizrule
 * @property string $data
 */
class Payway extends CActiveRecord {

        /**
         * Returns the static model of the specified AR class.
         * @return AuthAssignment the static model class
         */
        public static function model($className = __CLASS__) {
                return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName() {
                return '{{payway}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                    array('name,class,pay_account', 'required'),
                    array('is_online, pay_method,pay_fee,order,enabled', 'length', 'max' => 64),
                    array('desc,config,pay_id', 'safe'),
                );
        }

        /**
         * @return array relational rules.
         */
        public function relations() {
                // NOTE: you may need to adjust the relation name and the related
                // class name for the relations automatically generated below.
                return array(
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels() {
                return array(
                    'name' => '支付方式名称',
                    'desc' => '支付方式描述',
                    'order' => '排序',
                    'pay_account'=>'收款账号',
                    'pay_method' => '支付手续费方式',
                    'pay_fee' => '费率',
                    'is_online' => '支持在线支付'
                );
        }

        /**
         * 获取支付插件信息
         * @param unknown_type $class
         */
        public function getPayways($class = '') {

                $payways = GxcHelpers::getPayways();
                $command = $this->getDbConnection()->createCommand();

                if (empty($class)) {

                        $temp = $command->select('*')->from($this->tableName())->queryAll();
                        $install=array();
                        if (!empty($temp)) {
                                foreach ($temp as $value) {
                                        $install[$value['class']] = $value;
                                }
                        }
                        return CMap::mergeArray($payways, $install);
                } else {
                        return $payways[$class];
                }
        }

        public static function getOperation($data) {

                if ($data['enabled']) {
                        $url = CHtml::link('配置', Yii::app()->createUrl('bepay/edit/id/' . $data['class'])) . '&nbsp;&nbsp;';

                        $url .= CHtml::link('禁用', Yii::app()->createUrl('bepay/disable/id/' . $data['class']));
                } else {
                        if ($data['pay_account']) {
                                $url = CHtml::link('配置', Yii::app()->createUrl('bepay/edit/id/' . $data['class'])) . '&nbsp;&nbsp;';
                                $url .= CHtml::link('启用', Yii::app()->createUrl('bepay/enable/id/' . $data['class']));
                        }  else {
                                $url = CHtml::link('安装', Yii::app()->createUrl('bepay/add/id/' . $data['class']));
                        }

                        
                }

                return $url;
        }

}