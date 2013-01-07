<?php

/**
 * Class for render Sign up Box
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.front_blocks.signup
 */
class SignupBlock extends MWidget {

        //Do not delete these attr block, page and errors
        public $errors = array();

        public function setParams() {
                return;
        }

        public function run() {
                $this->renderContent();
        }

        protected function renderContent() {

                $model = new UserRegisterForm;

                $errorMsg = $loginScript = '';



                // collect user input data
                if (isset($_POST['UserRegisterForm'])) {
                        $model->attributes = $_POST['UserRegisterForm'];
                        $uid = UcenterApi::getInstance()->userRegister($model, $model->username, $model->password, $model->email);
                        $errors = $model->errors;
                        // validate user input password
                        if (empty($errors) && $model->validate() && $uid > 0) {
                                $new_user = new User;
                                $new_user->user_id = $uid;
                                $new_user->username = $model->username;
                                $new_user->email = $model->email;
                                $new_user->realname = $model->realname;
                                $new_user->sfzh = $model->sfzh;
                      
                                if ($new_user->save(FALSE)) {
                                        $loginScript = UcenterApi::getInstance()->userSynlogin($uid);
                                } else {
                                        $errors = $new_user->errors;
                                        if (!empty($errors)) {
                                                foreach ($errors as $error) {
                                                        $errorMsg = $error[0];
                                                }

                                                $cs = Yii::app()->clientScript;
                                                $cs->registerScript('userreg', "
                                               alert(' $errorMsg' ); 
                                               ");
                                        }
                                }
                        } else {
                                foreach ($errors as $error) {
                                        $errorMsg = $error[0];
                                }

                                $cs = Yii::app()->clientScript;
                                $cs->registerScript('userreg', "
                                               alert(' $errorMsg' ); 
                                               ");
                        }
                }
                $this->render($this->template, array('model' => $model, 'loginScript' => $loginScript));
        }

        public function validate() {
                return true;
        }

        public function params() {
                return array();
        }

        public function beforeBlockSave() {
                return true;
        }

        public function afterBlockSave() {
                return true;
        }

}

?>