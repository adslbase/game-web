<?php

        /**
         * This is the Widget for Creating new Taxonomy
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package  backwidgets.object
         *
         */
        class TaxonomyCreateWidget extends CWidget
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
                        $model = new Taxonomy;

                        //The type of the content we want to create
                        $type = isset($_GET['type']) ? strtolower(trim($_GET['type'])) : '';

                        //Get the list of Content Type
                        $types = GxcHelpers::getAvailableContentType();


                        if ($type != '' && !array_key_exists($type, $types))
                        {
                                throw new CHttpException(404, t('页面不存在！'));
                        }
                        else
                        {
                                // if it is ajax validation request
                                if (isset($_POST['ajax']) && $_POST['ajax'] === 'taxonomy-form')
                                {
                                        echo CActiveForm::validate($model);
                                        Yii::app()->end();
                                }

                                // collect user input data
                                if (isset($_POST['Taxonomy']))
                                {
                                        $model->attributes = $_POST['Taxonomy'];
                                        if ($model->save())
                                        {
                                                user()->setFlash('success', t('创建分类成功!'));
                                                $model = new Taxonomy;

                                                Yii::app()->controller->redirect(array('create'));
                                        }
                                }

                                $this->render('backwidgets.views.taxonomy.taxonomy_form_widget', array('model' => $model,'type' => $type));
                        }
                }

        }

        