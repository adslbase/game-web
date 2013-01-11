<?php

    /**
     * BackController class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 这个类实干什么用的
     * 
     * @version $Id: BackController.php UTF-8 2011-8-10 10:26:32 li feixiang 
     * @package framework
     * @since 1.0
     * 
     */
    abstract class BackController extends YController
    {

        public $layout = '//layouts/rightmain';

        public function init()
        {
            parent::init();

            if (Ycms::app()->getUser()->getIsGuest() === TRUE)
            {
                $this->redirect('login/login');
            }
                
        }

        //覆盖redirect。由于采取admin.php。。若不重新createurl则。会跳转到index.php
        public function redirect($url, $terminate=true, $statusCode=302)
        {
            if (is_array($url))
            {
                $route = isset($url[0]) ? $url[0] : '';
                $url = $this->createUrl($route, array_splice($url, 1));
            }
            else
            {
                $url = $this->createUrl($url);
            }
            Ycms::app()->getRequest()->redirect($url, $terminate, $statusCode);
        }

        public function refresh($terminate=true, $anchor='')
        {
            $url = Ycms::app()->getRequest()->getUrl() . $anchor;

            Ycms::app()->getRequest()->redirect($url, $terminate);
        }

        public function getBreadcrumb()
        {
            return array();
        }

    }