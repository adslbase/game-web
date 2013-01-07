<?php

class MWidget extends CWidget {

        public $template;

        public function init() {
                if (empty($this->template)) {
                        $this->template = 'default';
                }
        }

        public function createUrl($route, $params = array(), $ampersand = '&') {

                if (strpos($route, '/') === false)
                        $route = $this->getId() . '/' . $route;

                return Yii::app()->createUrl(trim($route, '/'), $params, $ampersand);
        }

        public function createAbsoluteUrl($route, $params = array(), $schema = '', $ampersand = '&') {
                $url = $this->createUrl($route, $params, $ampersand);
                if (strpos($url, 'http') === 0)
                        return $url;
                else
                        return Yii::app()->getRequest()->getHostInfo($schema) . $url;
        }

}