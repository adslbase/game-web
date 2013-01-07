<?php

class CustomerController extends FeController {

        public $defaultAction = 'index';

        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions() {
                return 'index,faq,view';
        }

        public function actionIndex() {
                $this->render('index');
        }

        public function actionView() {
                $this->render('index');
        }

        public function actionFaq($id) {
                $this->layout = 'empty';

                $this->render('faq/' . $id);
        }

}