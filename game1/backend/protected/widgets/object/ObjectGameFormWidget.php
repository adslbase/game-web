<?php

        /**
         * This is the Widget for Creating new Term
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package  backwidgets.object
         *
         *
         */
        class ObjectGameFormWidget extends CWidget
        {

                public $model;
                public $attribute;
                public $form;

                public function init()
                {
                        
                }

                public function run()
                {
                     
                                $this->renderContent();
      
                }

                protected function renderContent()
                {
                        $connection=Yii::app()->db;  
                        $sql = "SELECT `object_id`,`object_name` FROM  `{{object}}` WHERE  `object_type` =  'game'";
                        $command=$connection->createCommand($sql);
                        $rows=$command->queryAll(); 
                        $result =array();
                        foreach( $rows as $v)
                        {
                                $result[$v['object_id']]=$v['object_name'];
                        }

                        $this->render('backwidgets.views.object.object_game_form', array('games' => $result,'model'=>  $this->model,'attribute'=>  $this->attribute,'form'=>  $this->form));
                }

        }

        