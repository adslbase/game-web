<?php

class JiazhangController extends FeController {

        public $defaultAction = 'index';

        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions() {
                return 'index,down';
        }

        /**
         * Index Page of the Site, re route here
         */
        //public function actionIndex($path)
        public function actionIndex() {
                
                $this->layout = 'empty';
                $this->render('index');
        }

        public function actionDown($id) {
                switch ($id) {
                        case 1:
                                $file = RESOURCES_FOLDER . '/jiazhang/jiazhang.rar';
                        case 2:
                                $file = RESOURCES_FOLDER . '/jiazhang/jiazhang.rar';
                        case 3:
                                $file = RESOURCES_FOLDER . '/jiazhang/jiazhang.rar';
                        case 4:
                                $file = RESOURCES_FOLDER . '/jiazhang/jiazhang.rar';
                }

                yii::app()->request->sendFile('jiazhang.rar', file_get_contents($file));
        }

}