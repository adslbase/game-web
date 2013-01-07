<?php

/**
 * This is the model class for table "{{user}}".
 * 
 * @author lifeixiang
 * @version 1.0
 * @package cms.models.user
 *
 * The followings are the available columns in table '{{user}}':
 * @property string $user_id
 * @property string $username
 * @property string $display_name
 * @property string $password
 * @property string $salt
 * @property string $email
 * @property string $fbuid
 * @property integer $status
 * @property integer $created_time
 * @property integer $updated_time
 * @property integer $recent_login
 * @property string $user_activation_key
 */
class User extends CActiveRecord {

        /**
         * Returns the static model of the specified AR class.
         * @return User the static model class
         */
        public static function model($className = __CLASS__) {
                return parent::model($className);
        }

        /**
         * @return string the associated database table name
         */
        public function tableName() {
                return '{{user}}';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules() {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                    array('salt,created_time, updated_time, recent_login,loginip,regip,user_id,phone,qq,amount', 'safe'),
                    array('username, realname, email, password', 'required'),
                    //Email must be Unique if it is on Create Scenairo
                    array('email', 'unique',
                        'attributeName' => 'email',
                        'className' => 'common.models.user.User',
                        'message' => t('这个email已经被注册.'),
                    ),
                    //Email must be Unique if it is on Create Scenairo
                    array('username', 'unique',
                        'attributeName' => 'username',
                        'className' => 'common.models.user.User',
                        'message' => t('用户名已经被注册.'),
                    ),
                    array('status, created_time, updated_time, recent_login', 'numerical', 'integerOnly' => true),
                    array('username, password, salt, email', 'length', 'max' => 128),
                    array('realname', 'length', 'max' => 255),
                    array('user_activation_key', 'length', 'max' => 255),
                    // The following rule is used by search().
                    // Please remove those attributes that should not be searched.
                    array('user_id, username, realname, email, status, created_time, updated_time, recent_login', 'safe', 'on' => 'search'),
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
                    'user_id' => t('ID'),
                    'username' => t('用户名'),
                    'realname' => t('真实姓名'),
                    'password' => t('密码'),
                    'salt' => t('Salt'),
                    'phone' => t('手机'),
                    'qq' => t('QQ/MSN'),
                    'email' => t('邮箱'),
                    'status' => t('状态'),
                    'created_time' => t('创建时间'),
                    'updated_time' => t('修改时间'),
                    'recent_login' => t('最近登录'),
                    'user_activation_key' => t('用户激活KEY'),
                    'confirmed' => t('用户激活状态'),
                );
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
         */
        public function search() {
                // Warning: Please modify the following code to remove attributes that
                // should not be searched.

                $criteria = new CDbCriteria;

                $criteria->compare('user_id', $this->user_id, true);
                $criteria->compare('username', $this->username, true);
                $criteria->compare('realname', $this->realname, true);
                $criteria->compare('password', $this->password, true);
                $criteria->compare('salt', $this->salt, true);
                $criteria->compare('email', $this->email, true);
                $criteria->compare('status', $this->status);
                $criteria->compare('created_time', $this->created_time);
                $criteria->compare('updated_time', $this->updated_time);
                $criteria->compare('recent_login', $this->recent_login);

                $sort = new CSort;
                $sort->attributes = array(
                    'user_id',
                );
                $sort->defaultOrder = 'user_id DESC';

                return new CActiveDataProvider($this, array(
                            'criteria' => $criteria,
                            'sort' => $sort
                        ));
        }

        /**
         * Validate password based on Password and Salt String
         * @param string $password
         * @param string $salt
         * @return string
         */
        public function validatePassword($password, $salt) {

                return $this->hashPassword($password, $salt) === $this->password;
        }

        /**
         * Return Md5 encrypt of the password
         *  
         * @param string $password
         * @param string $salt
         * @return string 
         */
        public function hashPassword($password, $salt) {
                return md5($password . $salt);
        }

        /**
         * 随机生成密码
         * @return type 
         */
        public static function randPassword() {
                return md5(SYS_TIME . rand(100000, 999999));
        }

        /**
         * This is invoked before the record is saved.
         * @return boolean whether the record should be saved.
         */
        protected function beforeSave() {
                if (parent::beforeSave()) {
                        $this->email = strtolower($this->email);
                        $this->username = strtolower($this->username);

                        if ($this->isNewRecord) {
                                $this->created_time = $this->updated_time = $this->recent_login = SYS_TIME;

                                if (empty($this->password)) {
                                        $this->password = $this->randPassword();
                                } else {
                                        $this->password = $this->hashPassword($this->password, USER_SALT);
                                }
                                $this->salt = USER_SALT;
                                $this->regip = ip();
                        } else {
                                $this->updated_time = SYS_TIME;
                        }

                        return true;
                }
                else
                        return false;
        }

        //Do Clear Session after Save
        protected function afterSave() {
                parent::afterSave();
        }

        /**
         * Delete information of the User with Afer Delete
         */
        protected function afterDelete() {
                parent::afterDelete();
                AuthAssignment::model()->deleteAll('userid = :uid', array(':uid' => $this->user_id));
        }

        /**
         * Static Function retrun String Roles of the User
         * @param bigint $uid
         * @return string
         */
        public static function getStringRoles($uid = 0) {
                if ($uid) {
                        $roles = Rights::getAssignedRoles($uid, true);
                        $res = array();
                        foreach ($roles as $r) {
                                $res[] = $r->name;
                        }
                        if (count($res) > 0)
                                return implode(",", $res);
                        else
                                return '';
                }
                return '';
        }

        /**
         * Return the String to the image
         * @param CActiveRecord $data
         * @return string
         */
        public static function convertUserState($data) {
                $image = ($data->status == ConstantDefine::USER_STATUS_ACTIVE) ? 'active' : 'disabled';

                $backend_asset = Yii::app()->assetManager->publish(Yii::getPathOfAlias('common.assets.backend'), false, -1, false);

                return $backend_asset . '/images/' . $image . '.png';
        }

        /**
         * Suggests a list of existing tags matching the specified keyword.
         * @param string the keyword to be matched
         * @param integer maximum number of tags to be returned
         * @return array list of matching tag names
         */
        public static function suggestPeople($keyword, $limit = 20) {
                $users = User::model()->findAll(array(
                    'condition' => 'realname LIKE :keyword',
                    'limit' => $limit,
                    'params' => array(
                        ':keyword' => '%' . strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')) . '%',
                    ),
                        ));
                $names = array();
                foreach ($users as $user) {
                        $names[] = $user->display_name;
                }

                return $names;
        }

        /**
         * Find user with exactly display_name
         * @param type $keyword
         * @param type $limit
         * @return type 
         */
        public static function findPeople($keyword, $limit = 20) {
                return User::model()->find(array(
                            'condition' => 'realname = :keyword',
                            'limit' => $limit,
                            'params' => array(
                                ':keyword' => strtr($keyword, array('%' => '\%', '_' => '\_', '\\' => '\\\\')),
                            ),
                        ));
        }

}