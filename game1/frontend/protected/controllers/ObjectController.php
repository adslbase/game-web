<?php

class ObjectController extends FeController {

        public $defaultAction = 'index';

        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions() {
                return 'view,error,list,business,dispute,privacy,duty,contact';
        }

        public function actionList() {
                $connection = Yii::app()->db;
                $sql = 'SELECT `object_id`,`object_name`,`object_type`,`object_date`
                        FROM  `{{object}}` WHERE  `object_type`="article" AND `object_status`=1 ORDER BY `order` ASC';

                $command = $connection->createCommand($sql);

                $rawData = $command->queryAll();


                $dataProvider = new CArrayDataProvider($rawData, array(
                            'pagination' => array('pageSize' => 15),
                            'keyField' => 'object_id',
                        ));

                $this->render('list', array('dataProvider' => $dataProvider));
        }

        /**
         * When viewing a Page
         */
        public function actionView($id) {

                $object = FrontCache::getObject($id);

                $this->pageTitle = CHtml::encode($object['object_name']);
                $this->description = CHtml::encode($object['object_description']);
                $this->keywords = CHtml::encode($object['object_keywords']);

                $this->render('view', array('object' => $object));
        }

        public function actionBusiness() {
                $id = 16;
                $object = FrontCache::getObject($id);
                $this->pageTitle = CHtml::encode($object['object_name']);
                $this->description = CHtml::encode($object['object_description']);
                $this->keywords = CHtml::encode($object['object_keywords']);

                $this->render('page', array('object' => $object));
        }

        public function actionDispute() {
                $id = 23;
                $object = FrontCache::getObject($id);
                $this->pageTitle = CHtml::encode($object['object_name']);
                $this->description = CHtml::encode($object['object_description']);
                $this->keywords = CHtml::encode($object['object_keywords']);

                $this->render('page', array('object' => $object));
        }

        public function actionPrivacy() {

                $id = 14;
                $object = FrontCache::getObject($id);
                $this->pageTitle = CHtml::encode($object['object_name']);
                $this->description = CHtml::encode($object['object_description']);
                $this->keywords = CHtml::encode($object['object_keywords']);

                $this->render('page', array('object' => $object));
        }

        public function actionDuty() {

                $id = 24;
                $object = FrontCache::getObject($id);
                $this->pageTitle = CHtml::encode($object['object_name']);
                $this->description = CHtml::encode($object['object_description']);
                $this->keywords = CHtml::encode($object['object_keywords']);

                $this->render('page', array('object' => $object));
        }

           public function actionContact() {

                $id = 25;
                $object = FrontCache::getObject($id);
                $this->pageTitle = CHtml::encode($object['object_name']);
                $this->description = CHtml::encode($object['object_description']);
                $this->keywords = CHtml::encode($object['object_keywords']);

                $this->render('page', array('object' => $object));
        }     
        
        

        /**
         * This is the action to handle external exceptions.
         */
        public function actionError() {

                parent::error();
        }

}