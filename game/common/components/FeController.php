<?php

        /**
         * Class of parent Controller for Front end of GXC CMS, extends from RController
         * 
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package cms.components
         */
        class FeController extends RController
        {

                public $description;
                public $keywords;
                public $change_title = false;

                public function __construct($id, $module = null)
                {
                        parent::__construct($id, $module);
                        if (isset($_POST))
                        {
                                $_POST = GxcHelpers::xss_clean($_POST);
                        }
                        if (isset($_GET))
                        {
                                $_GET = GxcHelpers::xss_clean($_GET);
                        }
                }

                /**
                 * Filter by using Modules Rights
                 * 
                 * @return type 
                 */
                public function filters()
                {
                        return array(
                                    'rights',
                        );
                }

                /**
                 * List of allowd default Actions for the user
                 * @return type 
                 */
                public function allowedActions()
                {
                        return '';
                }



                public function afterRender($view, &$output)
                {

                        Yii::app()->clientScript->registerMetaTag($this->description, 'description');
                        Yii::app()->clientScript->registerMetaTag($this->keywords, 'keywords');

                        //Check if change Title, we will replace content in <title> with new Title
                        if ($this->change_title)
                        {
                                $output = replaceTags('<title>', '</title>', $this->pageTitle . ' | ' . SITE_NAME, $output);
                        }
                }

                public function error()
                {
                        if ($error = Yii::app()->errorHandler->error)
                        {
                                if (Yii::app()->request->isAjaxRequest)
                                        echo $error['message'];
                                else
                                        $this->render('//layouts/error',array('error'=>$error));
                        }
                }

        }