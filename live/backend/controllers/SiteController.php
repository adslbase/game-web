<?php
/**
 * SiteController class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
 
defined ( 'INYCMS' ) or die;

/**
 * SiteController控制器类
 * 
 * @version $Id: SiteController.php UTF-8 2011-07-28 11:48:20 li feixiang
 * @package backend-controller
 * @since 1.0
 * 
 */
class SiteController extends BackController
{

        /**
         * Declares class-based actions.
         */
        public function actions ()
        {
                return array (
                    // captcha action renders the CAPTCHA image displayed on the contact page
                    'captcha' => array (
                        'class' => 'CCaptchaAction',
                        'backColor' => 0xFFFFFF,
                    ),
                    // page action renders "static" pages stored under 'protected/views/site/pages'
                    // They can be accessed via: index.php?r=site/page&view=FileName
                    'page' => array (
                        'class' => 'CViewAction',
                    ),
                );
        }

        /**
         * This is the default 'index' action that is invoked
         * when an action is not explicitly requested by users.
         */
        public function actionIndex ( $layout='main' )
        {
                // renders the view file 'protected/views/site/index.php'
                // using the default layout 'protected/views/layouts/main.php'
                if ( $layout === 'main' )
                        $this -> layout = '//layouts/main';
                $this -> render ( 'index' );
        }

        public function getTopMenus ()
        {
                $model = $this -> loadDaoModel ( 'Menu' );
                return $model -> getTree ( array ( 'alias' => 'management','depth' => '1' ),array ( 'name','alias' ) );
        }

        /**
         * 当发生错误和异常时，自定义呈现函数与模板。。这样的话。将只使用一个模板呈现错误。不使用404等其他模板
         */
        public function actionError ()
        {
                $error = Yii::app () -> errorHandler -> error;
                if ( ! empty ( $error ) )
                {
                        $error[ 'time' ] = time ();
                        $error[ 'admin' ] = Yii::app () -> errorHandler -> adminInfo;
                        if ( Yii::app () -> request -> isAjaxRequest )
                                echo $error[ 'message' ];
                        else
                                $this -> renderPartial ( '//system/error',array ( 'data' => $error ) );
                }
        }

        /**
         *  维护模式
         */
        public function actionMaintenance ()
        {

        }

}