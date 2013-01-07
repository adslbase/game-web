<?php

        class SignController extends FeController
        {

                public $defaultAction = 'index';

                /**
                 * List of allowd default Actions for the user
                 * @return type 
                 */
                public function allowedActions()
                {
                        return 'up,in,out,error,ajax,caching';
                }

                /**
                 * Index Page of the Site, re route here
                 */
                //public function actionIndex($path)
                public function actionUp()
                {
                        $this->render('up');
                }

                /**
                 * When viewing a Page
                 */
                public function actionIn()
                {
                        $this->render('in');
                }

                /**
                 * When viewing a Page
                 */
                public function actionOut()
                {
                    $this->layout='//layouts/empty';
                    
                        $script = UcenterApi::getInstance()->userSynlogout();
                        $this->render('out',array('script'=>$script));
                      
                }

                /**
                 * This is the action to handle external exceptions.
                 */
                public function actionError()
                {
                        parent::error();
                }

                /**
                 * This is the action to Clear Cache
                 */
                public function actionCaching()
                {

                        if (isset($_POST['key']))
                        {
                                if ($_POST['key'] == FRONTEND_CLEAR_CACHE_KEY)
                                {
                                        Yii::app()->cache->flush();
                                        echo '1';
                                }
                        }
                        else
                        {
                                echo '0';
                        }
                }

        }