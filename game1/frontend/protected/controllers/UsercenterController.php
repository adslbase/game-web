<?php

class UsercenterController extends FeController {

        public $defaultAction = 'ModifyUserInfo';

        public function allowedActions() {
                $user = Yii::app()->getUser();
                if ($user->isGuest == true)
				{
				    $user->loginRequired();
				}
                else
                {
                        return 'modifyuserinfo,changepassword,antiaddiction';
                }
        }

        public function actionModifyUserInfo() {

                $model = new UserProfileForm;
                $u = User::model()->findByPk(user()->id);

                if ($u !== null) {
                        $model->email = $u->email;
                        $model->phone = $u->phone;
                        $model->qq = $u->qq;
                } else {
                        throw new CHttpException('503', 'User is not valid');
                }

                // collect user input data
                if (isset($_POST['UserProfileForm'])) {

                        $model->attributes = $_POST['UserProfileForm'];
                        $model->u = $u;

                        $cs = Yii::app()->clientScript;

                        if ($model->validate()) {
                                $u->scenario = 'update';
                                $u->email = $model->email;
                                $u->phone = $model->phone;
                                $u->qq = $model->qq;
                                if ($u->save()) {
                                        $cs->registerScript('userprofile', "
                                               alert('修改资料成功！' ); 
                                               ");
                                }
                        } else {
                                $errors = $model->errors;
                                if (!empty($errors)) {
                                        foreach ($errors as $error) {
                                                $errorMsg = $error[0];
                                        }
                                        $cs->registerScript('userprofile', "
                                               alert(' $errorMsg' ); 
                                               ");
                                }
                        }
                }
                $this->render('userinfo', array('model' => $model, 'user' => $u));
        }

        public function actionChangePassword() {
                $model = new UserChangePassForm;
                $u = User::model()->findbyPk(user()->id);
                if ($u !== null) {
                        // collect user input data
                        if (isset($_POST['UserChangePassForm'])) {
                                $model->attributes = $_POST['UserChangePassForm'];
                                $model->u = $u;
                                $cs = Yii::app()->clientScript;

                                if ($model->validate()) {
                                        $model = new UserChangePassForm;
                                        $cs->registerScript('changepass', "
                                               alert('修改密码成功！' ); 
                                               ");
                                } else {
                                        $errors = $model->errors;
                                        if (!empty($errors)) {
                                                foreach ($errors as $error) {
                                                        $errorMsg = $error[0];
                                                }

                                                $cs->registerScript('changepass', "
                                               alert(' $errorMsg' ); 
                                               ");
                                        }
                                }
                        }
                } else {
                        throw new CHttpException('403', '用户错误！');
                }
                $this->render('password', array('model' => $model));
        }

        public function actionAntiAddiction() {

                $model = new UserAutonymForm;
                $u = User::model()->findbyPk(user()->id);

                $model->sfzh = $u->sfzh;
                $model->realname = $u->realname;
                if ($u !== null) {

                        // collect user input data
                        if (isset($_POST['UserAutonymForm'])) {
                                $model->attributes = $_POST['UserAutonymForm'];

                                $cs = Yii::app()->clientScript;

                                if ($model->validate()) {
                                        $u->sfzh = $model->sfzh;
                                        $u->realname = $model->realname;
                                        if ($u->save()) {
                                                $cs->registerScript('changepass', "
                                               alert('更新实名认证成功！' ); 
                                               ");
                                        }
                                } else {
                                        $errors = $model->errors;
                                        if (!empty($errors)) {
                                                foreach ($errors as $error) {
                                                        $errorMsg = $error[0];
                                                }
                                                $cs->registerScript('changepass', "
                                               alert(' $errorMsg' ); 
                                               ");
                                        }
                                }
                        }
                } else {
                        throw new CHttpException('403', '用户错误！');
                }


                $this->render('antiaddiction', array('model' => $model));
        }

}
