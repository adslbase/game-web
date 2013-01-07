<?php

        /**
         * This is the Widget for Creating new Menu
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package  backwidgets.page
         *
         */
        class MenuCreateWidget extends CWidget
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
                        $model = new Menu;

                        // if it is ajax validation request
                        if (isset($_POST['ajax']) && $_POST['ajax'] === 'menu-form')
                        {
                                echo CActiveForm::validate($model);
                                Yii::app()->end();
                        }

                        // collect user input data
                        if (isset($_POST['Menu']))
                        {
                                $model->attributes = $_POST['Menu'];
                                if ($model->save())
                                {
                                        user()->setFlash('success', t('创建菜单成功!'));
                                        $model = new Menu;
                                        Yii::app()->controller->redirect(array('create'));
                                }
                        }

                        $this->render('backwidgets.views.menu.menu_form_widget', array('model' => $model));
                }

        }

        