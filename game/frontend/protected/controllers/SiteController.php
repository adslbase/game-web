<?php

class SiteController extends FeController {

        public $defaultAction = 'index';

        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions() {
                return 'index,view,error,ajax,caching';
        }

        /**
         * Index Page of the Site, re route here
         */
        //public function actionIndex($path)
        public function actionIndex() {
                $news = FrontCache::getNews();

                $rawData = FrontCache::getGames();
                $dataProvider = new CArrayDataProvider($rawData, array(
                            'pagination' => array('pageSize' => 2),
                            'keyField' => 'object_id',
                        ));

                $this->render('index', array('news' => $news, 'dataProvider' => $dataProvider));
        }

        /**
         * When viewing a Page
         */
        public function actionView($id) {
                parent::renderPage($id);
        }

        /**
         * This is the action to handle external exceptions.
         */
        public function actionError() {

                parent::error();
        }

        /**
         * 后台会请求这个地址
         */
        public function actionCaching() {

                if (isset($_POST['key'])) {
                        if ($_POST['key'] == FRONTEND_CLEAR_CACHE_KEY) {
                                Yii::app()->cache->flush();
                                echo '1';
                        }
                } else {
                        echo '0';
                }
        }

}