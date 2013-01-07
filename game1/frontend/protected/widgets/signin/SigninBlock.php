<?php

        /**
         * Class for render Sign in Box
         * 
         * 
         * @author Tuan Nguyen <nganhtuan63@gmail.com>
         * @version 1.0
         * @package common.front_blocks.signin
         */
        class SigninBlock extends MWidget
        {

                public $errors = array();

                public function setParams($params)
                {
                        return;
                }

                public function run()
                {
                        $this->renderContent();
                }

                protected function renderContent()
                {
                        $user = Yii::app()->getUser();
                        $loginScript = null;
                        if (isset($_GET['required']))
                        {
                                user()->setFlash('error', t('你需要在注册后才能登陆！'));
                        }
                        $model = new UserLoginForm;

                        // collect user input data
                        if (isset($_POST['UserLoginForm']))
                        {
                                $model->attributes = $_POST['UserLoginForm'];
                                // validate user input and redirect to the previous page if valid
                                if ($model->validate())
                                {
                                        $loginScript = $model->login();
                                }
                        }

                        $lastGame = array();
                        $cookies = Yii::app()->request->cookies;
                        if (isset($cookies['lastgame']))
                        {
                                $lastGame = $cookies['lastgame'];
                        }

                        $this->render($this->template, array('model' => $model, 'loginScript' => $loginScript, 'user' => $user, 'lastGame' => $lastGame));
                }

                public function validate()
                {
                        return true;
                }

                public function params()
                {
                        return array();
                }

                public function beforeBlockSave()
                {
                        return true;
                }

                public function afterBlockSave()
                {
                        return true;
                }

        }

?>