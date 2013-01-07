<?php

        /**
         * This is the Widget for Updating User Information.
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package backwidgets.user
         *
         */
        class UserUpdateWidget extends CWidget
        {

                public $visible = true;

                public function init()
                {
                        
                }

                public function run()
                {
                        if ($this->visible)
                        {
                                $this->renderContent();
                        }
                }

                protected function renderContent()
                {
                        $user_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
                        if ($user_id !== 0)
                        {
                                $model = User::model()->findbyPk($user_id);
                                $old_pass = (string) $model->password;
                                // if it is ajax validation request
                                if (isset($_POST['ajax']) && $_POST['ajax'] === 'userupdate-form')
                                {
                                        echo CActiveForm::validate($model);
                                        Yii::app()->end();
                                }
                                // collect user input data
                                if (isset($_POST['User']))
                                {
                                        $model->attributes = $_POST['User'];
                                        if ($model->password != $old_pass)
                                        {
                                                $model->password = $model->hashPassword($model->password, USER_SALT);
                                        }
                                        $model->scenario = 'update';
                                        if ($model->save())
                                        {
                                                user()->setFlash('success', t('修改用户成功!'));
                                        }
                                }

                                $this->render('backwidgets.views.user.user_update_widget', array('model' => $model));
                        }
                        else
                        {
                                throw new CHttpException(404, t('请求页面不存在.'));
                        }
                }

        }

        