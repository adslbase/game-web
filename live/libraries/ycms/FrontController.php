<?php

    /**
     * FrontController class file.
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
     * @version $Id: FrontController.php UTF-8 2011-8-10 10:27:15 li feixiang 
     * @package framework
     * @since 1.0
     * 
     */
    abstract class FrontController extends YController
    {

        public $layout = '//layouts/main';

        public function init()
        {
            parent::init();
        }

    }