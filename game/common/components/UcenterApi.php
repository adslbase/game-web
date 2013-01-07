<?php

/**
 * UcenterApi class file.
 *
 * @author li feixiang  <lifeixian@marstv.com>
 * @link http://cracker.marstv.com/ 
 * @copyright Copyright &copy; 2011-2015 Marstv Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */

/**
 * 这个类实干什么用的
 * 
 * @version $Id: UcenterApi.php UTF-8 2012-2-27 11:09:45 li feixiang 
 * @package framework
 * @since 1.0
 * 
 */
class UcenterApi {

        public function __construct() {
                require COMMON_FOLDER . '/ucenter.config.php';
                require COMMON_FOLDER . '/uc_client/client.php';
        }

        public static function getInstance() {
                static $object;
                if (empty($object)) {
                        $object = new UcenterApi();
                }
                return $object;
        }

        /**
         * 用户注册
         * @param type $model  调用该方法的模型，可以将错误传给他。
         * @param type $username
         * @param type $password
         * @param type $email
         * @param type $questionid
         * @param type $answer
         * @param type $regip
         * @return boolean 
         */
        public function userRegister($model, $username, $password, $email, $questionid = '', $answer = '', $regip = '') {

                $regip = ip();

                $uid = uc_user_register($username, $password, $email, $questionid, $answer, $regip);
    
                if ($uid <= 0) {
                        switch ($uid) {
                                case -1:
                                        $model->addError('username', '用户名不合法');
                                        break;
                                case -2:
                                        $model->addError('username', '用户名包含不允许注册的词语');
                                        break;
                                case -3:
                                        $model->addError('username', '用户名已存在');
                                        break;
                                case -4:
                                        $model->addError('email', 'Email 格式有误');
                                        break;
                                case -5:
                                        $model->addError('email', 'Email 不允许注册');
                                        break;
                                case -6:
                                        $model->addError('email', 'Email 已经被注册');
                                        break;
                                default:
                                        $model->addError('email', '未知错误');
                                        break;
                        }
                }

                return $uid;
        }

        /**
         * 用户登陆
         * @param type $username
         * @param type $password
         * @param type $isuid
         * @param type $checkques
         * @param type $questionid
         * @param type $answer 
         */
        public function userLogin($username, $password, $isuid = 0, $checkques = 0, $questionid = '', $answer = '') {
                return uc_user_login($username, $password, $isuid, $checkques, $questionid, $answer);
        }

        public function userDelete($uid) {
                return uc_user_delete($uid);
        }

        /**
         * 获取用户基本资料
         * @param type $username
         * @param type $isuid 
         */
        public function getUser($username, $isuid = 0) {
                return uc_get_user($username, $isuid);
        }

        /**
         * 更新用户信息
         * @param type $username
         * @param type $oldpw
         * @param type $newpw
         * @param type $email
         * @param type $ignoreoldpw
         * @param type $questionid
         * @param type $answer 
         */
        public function userEdit($username, $oldpw, $newpw, $email, $ignoreoldpw = 0, $questionid = '', $answer = '') {
                return uc_user_edit($username, $oldpw, $newpw, $email, $ignoreoldpw, $questionid, $answer);
        }

        /**
         * 同步登陆
         * @param type $uid 
         */
        public function userSynlogin($uid) {
                return uc_user_synlogin($uid);
        }

        /**
         * 同步退出
         * @return type 
         */
        public function userSynlogout() {
                return uc_user_synlogout();
        }

        /**
         * 获取应用积分
         * @param type $appid
         * @param type $uid
         * @param type $credit 
         */
        public function userGetcredit($appid = '', $uid = '', $credit = '') {

                if ($credit == '') {
                        $credit = Setting::model()->findByname('toCreditid');
                }

                if ($appid == '') {
                        $appid = Setting::model()->findByname('toappid');
                }

                if ($uid == '') {
                        $uid = Yii::app()->user->id;
                }

                return uc_user_getcredit($appid, $uid, $credit);
        }

        public function creditExchangeRequest($uid, $amount, $from = '', $to = '', $toappid = '') {
                if ($from == '') {
                        $from = Setting::model()->findByname('fromCreditid');
                }

                if ($to == '') {
                        $to = Setting::model()->findByname('toCreditid');
                }

                if ($toappid == '') {
                        $toappid = Setting::model()->findByname('toappid');
                }
                return uc_credit_exchange_request($uid, $from, $to, $toappid, $amount);
        }

        /**
         * 返回的数组array（源积分=>array（array('toappid'=>'目标应用id','to'=>'目标积分','title'=>''目标标题)））
         * @return type 
         */
        public static function getCreditSetting() {
                $_CACHE = array();

                require COMMON_FOLDER . '/uc_client/data/cache/creditsettings.php';
                return $_CACHE['creditsettings'];
        }

}