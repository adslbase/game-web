<?php

        class Order extends CActiveRecord
        {

                /**
                 * Returns the static model of the specified AR class.
                 * @return AuthAssignment the static model class
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
                        return '{{pay_order}}';
                }

                /**
                 * @return array validation rules for model attributes.
                 */
                public function rules()
                {
                        // NOTE: you should only define rules for those attributes that
                        // will receive user inputs.
                        return array(
                                    array('trade_sn,username', 'required'),
                                    array('trade_sn', 'unique',
                                                'attributeName' => 'trade_sn',
                                                'className' => 'common.models.pay.Order',
                                                'message' => t('订单错误，请重新购买.'),
                                    ),
                                    array('email', 'email'),
                                    array('userid,gameid,serverid,pay_id,money,quantity,discount', 'numerical'),
                                    array('servername, gamename,payname,ip,status,pay_type,gameunit', 'length', 'max' => 64),
                                    array('usernote,adminnote', 'safe'),
                                    array('addtime,paytime', 'safe'),
                                    array('trade_sn, userid, username,money,payname,status', 'safe', 'on' => 'search'),
                        );
                }

                /**
                 * @return array customized attribute labels (name=>label)
                 */
                public function attributeLabels()
                {
                        return array(
                                    'trade_sn' => '交易流水号',
                                    'userid' => '用户id',
                                    'username' => '用户名',
                                    'email' => 'email',
                                    'discount' => '兑换比率',
                                    'money' => '花费的金钱',
                                    'quantity' => '兑换获得的量',
                                    'addtime' => '添加时间',
                                    'paytime' => '支付时间',
                                    'usernote' => '用户备注',
                                    'pay_id' => '支付模块ID',
                                    'pay_type' => '支付类型',
                                    'payname' => '支付方式名称',
                                    'gameid' => '游戏ID',
                                    'gamename' => '游戏名称',
                                    'serverid' => '服务器ID',
                                    'servername' => '服务器名称',
                                    'gameunit' => '游戏货币名称',
                                    'ip' => 'IP',
                                    'status' => '订单状态',
                                    'adminnote' => '管理备注',
                        );
                }

                public function search($object)
                {
                        // Warning: Please modify the following code to remove attributes that
                        // should not be searched.
                        $criteria = new CDbCriteria;
                        $criteria->compare('trade_sn', $object->trade_sn);
                        $criteria->compare('userid', $object->userid);
                        $criteria->compare('username', $object->username, true);
                        $criteria->compare('status', $object->status);
                        $criteria->compare('money', $object->money);
                        $sort = new CSort;
                        $sort->attributes = array(
                                    'id',
                                    'money'
                        );
                        $sort->defaultOrder = 'id DESC';

                        return new CActiveDataProvider($object, array(
                                                    'criteria' => $criteria,
                                                    'sort' => $sort,
                                                    'pagination' => array(
                                                                'pageSize' => 25
                                                    ),
                                        ));
                }

        }