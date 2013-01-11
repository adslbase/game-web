<?php

    /**
     * user model class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 数据库表"user"的model类.
     *
     * The followings are the available columns in table 'user':
     * @property string $user_id
     * @property string $user_name
     * @property string $pass
     * @property string $email
     * @property string $theme
     * @property string $create_time
     * @property string $login_time
     * @property integer $status
     * @property string $timezone
     * @property string $language
     * @property string $param
     * @property string $init
     *
     * @version $Id: user.php UTF-8 2011-05-28 15:52:17 li feixiang
     * @package backend-model
     * @since 1.0
     */
    class User extends YDaoModel
    {

        public $confirmPass;
        public $isSendEmail = 1;
        public $roles = array();
        private $_passwordHash;
        private static $_items = array();
        public $createTime = 'NOW()';

        /**
         * @return string the associated database table name
         */
        public static function tableName()
        {
            return '{{user}}';
        }

        public function behaviors()
        {
            return array(
                    'YSerializeBehavior' => array(
                            'class' => 'ycms.behaviors.YDateTimeBehavior',
                    ),
            );
        }

        /**
         * return array(
         *  array('username, password', 'required'),
         *  array('rememberMe', 'boolean'),
         * )
         * boolean-captcha-compare-email-default-exist-file-filter-in-length-match-numerical-required-type-unique-url
         */
        public function rules()
        {
            return array(
                    array('user_name,email', 'required', 'on' => 'create,update'),
                    array('pass,confirmPass', 'required', 'on' => 'create'),
                    array('status', 'numerical', 'integerOnly' => true),
                    array('user_name', 'length', 'max' => 60),
                    array('pass', 'length', 'max' => 128),
                    array('pass', 'compare', 'compareAttribute' => 'confirmPass'),
                    array('email, init', 'length', 'max' => 254),
                    array('theme', 'length', 'max' => 255),
                    array('timezone', 'length', 'max' => 32),
                    array('language', 'length', 'max' => 12),
                    array('user_name, roles,pass, email, theme,status, timezone, language, init', 'safe'),
                    array('param', 'ycms.validators.YExpressionValidator', 'expression' => 'serialize($attribute)'),
                    array('create_time', 'default', 'value' => new CDbExpression('NOW()'), 'setOnEmpty' => false, 'on' => 'insert'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                    'user_name' => Ycms::t('user', '用户名'),
                    'email' => Ycms::t('user', '电子邮件地址'),
                    'pass' => Ycms::t('user', '密码'),
                    'confirmPass' => Ycms::t('user', '确认密码'),
                    'theme' => Ycms::t('user', '主题'),
                    'signature' => Ycms::t('user', '个性签名'),
                    'createTime' => Ycms::t('user', 'Create Time'),
                    'lastvisitTime' => Ycms::t('user', 'Lastvisit Time'),
                    'status' => Ycms::t('user', '状态'),
                    'timezone' => Ycms::t('user', '时区'),
                    'language' => Ycms::t('user', 'Language'),
                    'picture' => Ycms::t('user', 'Picture'),
                    'init' => Ycms::t('user', 'Init'),
                    'roles' => Ycms::t('user', '角色'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeHints()
        {
            return array(
                    'user_name' => Ycms::t('user', '允许空格；除英文句号（.）、横线（-）、单引号（\'）和下划线（_）外的标点符号不允许'),
                    'email' => Ycms::t('user', '需要一个合法的邮件地址。所有的系统邮件都会发送到此地址。此地址不对外公开，当需要获取新密码或获取特定消息及通知时会使用此邮件地址。'),
                    'pass' => Ycms::t('user', '输入新帐号的密码（共输入两次）'),
                    'confirmPass' => Ycms::t('user', '输入新帐号的密码（共输入两次）'),
                    'theme' => Ycms::t('user', '选择你的主题'),
                    'signature' => Ycms::t('user', '个性签名'),
                    'createTime' => Ycms::t('user', 'Create Time'),
                    'lastvisitTime' => Ycms::t('user', 'Lastvisit Time'),
                    'status' => Ycms::t('user', 'Status'),
                    'timezone' => Ycms::t('user', 'Timezone'),
                    'language' => Ycms::t('user', 'Language'),
                    'picture' => Ycms::t('user', 'Picture'),
                    'init' => Ycms::t('user', 'Init'),
                    'roles' => Ycms::t('user', '为该用户分配角色'),
            );
        }

        public static function loadItems($type, $code=null)
        {
            self::$_items = array(
                    'status' => array(
                            '1' => Yii::t('dh', '开启'),
                            '2' => Yii::t('dh', '关闭'),
                    ),
                    'type' => array(
                            '1' => Yii::t('dh', '产品'),
                            '2' => Yii::t('dh', '文章'),
                    ),
            );
            return $code ? self::$_items[$type][$code] : self::$_items[$type];
        }

        function user_is_blocked($user_name)
        {
            return db_select('users')
                        ->fields('users', array('user_name'))
                        ->condition('user_name', db_like($user_name), 'LIKE')
                        ->condition('status', 0)
                        ->execute()->fetchObject();
        }

        function user_validate_name($name)
        {
            if (!$name)
            {
                return t('You must enter a username.');
            }
            if (substr($name, 0, 1) == ' ')
            {
                return t('The username cannot begin with a space.');
            }
            if (substr($name, -1) == ' ')
            {
                return t('The username cannot end with a space.');
            }
            if (strpos($name, '  ') !== FALSE)
            {
                return t('The username cannot contain multiple spaces in a row.');
            }
            if (preg_match('/[^\x{80}-\x{F7} a-z0-9@_.\'-]/i', $name))
            {
                return t('The username contains an illegal character.');
            }
            if (preg_match('/[\x{80}-\x{A0}' . // Non-printable ISO-8859-1 + NBSP
                                    '\x{AD}' . // Soft-hyphen
                                    '\x{2000}-\x{200F}' . // Various space characters
                                    '\x{2028}-\x{202F}' . // Bidirectional text overrides
                                    '\x{205F}-\x{206F}' . // Various text hinting characters
                                    '\x{FEFF}' . // Byte order mark
                                    '\x{FF01}-\x{FF60}' . // Full-width latin
                                    '\x{FFF9}-\x{FFFD}' . // Replacement characters
                                    '\x{0}-\x{1F}]/u', // NULL byte and control characters
                           $name                                          ))
            {
                return t('The username contains an illegal character.');
            }
            if (drupal_strlen($name) > USERNAME_MAX_LENGTH)
            {
                return t('The username %name is too long: it must be %max characters or less.', array('%name' => $name, '%max' => USERNAME_MAX_LENGTH));
            }
        }

        /**
         * 检验密码
         * @param type $password
         * @param type $stored_hash
         * @return type 
         */
        public function CheckPassword($password, $stored_hash)
        {
            $hasher = $this->getPasswordHash();
            return $hasher->CheckPassword($password, $stored_hash);
        }

        /**
         * 生成密码
         * @param type $password
         * @return type 
         */
        public function hashPassword($password)
        {
            $hasher = $this->getPasswordHash();

            $hashPassword = $hasher->HashPassword($password);

            return $hashPassword;
        }

        /**
         * 实例化密码hash对象
         * @param type $hashCostLog2
         * @param type $hashProtable
         * @return type 
         */
        public function getPasswordHash($hashCostLog2 = 8, $hashProtable = false)
        {
            if ($this->_passwordHash !== null)
                return $this->_passwordHash;

            $this->_passwordHash = new YPasswordHash($hashCostLog2, $hashProtable);

            return $this->_passwordHash;
        }

        public function getUser($ids, $fields= '*')
        {
            $users = $this->loadUserMultiple(array($ids), array(), $fields);

            return reset($users);
        }

        public function getUserByName($name, $fields= '*')
        {
            $users = $this->loadUserMultiple(NULL, array('user_name' => $name), $fields);

            return reset($users);
        }

        public function getUserBymail($mail, $fields= '*')
        {
            $users = $this->loadUserMultiple(null, array(), $fields);

            return reset($users);
        }

        public function getUsers($fields='*')
        {
            $users = $this->loadUserMultiple(null, array(), $fields);
            return $users;
        }

        public function createUser($fields= '*')
        {

            $condition = $this->joinAttributesInsert($fields);

            $sql = 'INSERT INTO ' . $this->tableName() . $condition;

            if ($this->daoExecute($sql, $fields, 'bindValue') === 1)
                return $this->getDbConnection()->getLastInsertID();
            else
                return false;
        }

        public function updateUser($userId, $fields)
        {
            $columns = $this->joinAttributesUpdate($fields);

            $sql = 'UPDATE ' . $this->tableName() . ' SET ' . $columns . ' WHERE user_id= :user_id';

            $fields['user_id'] = $userId;

            $this->daoExecute($sql, $fields, 'bindValue');
        }

        /**
         * 加载用户信息
         * @param type $ids
         * @param type $conditions
         * @param type $fields 
         */
        public function loadUserMultiple($ids = null, $conditions = array(), $fields = '*')
        {
            $paArray = array();
            $condition = '';
            $sql = '';

            if (is_array($ids))
            {
                $condition .= ' WHERE user_id IN (' . implode(array_unique(array_map('intval', $ids)), ',') . ')'; //比不上foreach。。挺耗资源的。给改过来
            }
            elseif ($ids !== null)
            {
                $condition = ' WHERE user_id = :user_id';
                $paArray['user_id'] = array($ids, PDO::PARAM_INT);
            }
            else if ($conditions !== array())
            {
                $condition .= ' WHERE ';

                if (isset($conditions['email']))
                {
                    $condition .= 'email = :email';
                    $paArray['email'] = array($conditions['email'], PDO::PARAM_STR);
                }
                else if (isset($conditions['user_name']))
                {
                    $condition .= 'user_name = :user_name';
                    $paArray['user_name'] = array($conditions['user_name'], PDO::PARAM_STR);
                }
            }

            $sql = 'SELECT ' . $fields . ' FROM ' . $this->tableName() . $condition;

            return $this->daoQueryAll($sql, $paArray);
        }

    }