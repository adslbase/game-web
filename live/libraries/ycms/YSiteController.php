<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
abstract class YSiteController extends CExtController
{

        /**
         * @var string the default layout for the controller view. Defaults to '//layouts/column1',
         * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
         */
        public $layout = '//layouts/rightmain';

        public function init ()
        {
                
        }

        public function getViewPath ()
        {  
                return Ycms::app () -> getSiteViewPath () . '/' . $this -> getId ();
        }

}