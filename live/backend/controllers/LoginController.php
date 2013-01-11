<?php

    /**
     * LoginController class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * LoginController控制器类
     * 
     * @version $Id: LoginController.php UTF-8 2011-07-28 11:26:07 li feixiang
     * @package backend-controller
     * @since 1.0
     * 
     */
    class LoginController extends BackController
    {

        public $defaultAction = 'Login';

        /**
         * 注销父类的登陆跳转
         */
        public function init()
        {
            
        }

        /**
         * 登陆动作
         */
        public function actionLogin()
        {
            $user = Ycms::app()->user;
            if (!$user->IsGuest)
                $this->redirect('site/Index');

            $model = $this->loadDaoModel('LoginForm');

            // collect user input data
            if (isset($_POST['LoginForm']))
            {
                $model->Attributes = $_POST['LoginForm'];
                if ($model->validate() && $model->login())
                {
                    $this->redirect('site/index');
                }
                else
                {
                    
                    $errors= $model->Errors;
                    if(!empty ($errors))
                    {
                        $error = array_shift($errors);
                        $this->showMessage(array('title'=>'登陆提示','content'=>$error[0]));
                    }
                    
                   
                    Ycms::app()->end();
                }
            }

            // display the login form
            $this->renderPartial('index', array('model' => $model));
        }

        /**
         * 登出动作
         */
        public function actionLogout()
        {
            Ycms::app()->user->logout();
            $this->redirect('/login/Login');
        }

    }