<?php
/**
 * SettingController class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
 
defined ( 'INYCMS' ) or die;

/**
 * SettingController控制器类
 * 
 * @version $Id: SettingController.php UTF-8 2011-07-28 11:47:12 li feixiang
 * @package backend-controller
 * @since 1.0
 * 
 */
class SettingController extends BackController
{

        /**
         *
         * @param type $className
         * @param type $scenario
         * @param type $defaultAttributes
         * @param type $properties
         * @return className 
         */
        public static function createSettingModel ( $className,$scenario = 'create',$defaultAttributes = true,$properties = array ( ) )
        {

                $className = Ycms::import ( 'backendApp.models.setting.' . $className );

                $model = new $className ( $scenario,$defaultAttributes );

                foreach ( $properties as $name => $value )
                {
                        $model -> $name = $value;
                }

                return $model;
        }

        /**
         * 
         */
        public function actionSite ()
        {

                $model = $this -> createSettingModel ( 'SiteSetting' );

                if ( ($settings = $this -> getPost ( 'SiteSetting' )) !== null )
                {
                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'site-setting',array ( 'model' => $model ) );
        }

        public function actionDevelopment ()
        {
                $model = $this -> createSettingModel ( 'DevelopmentSetting' );

                if ( ($settings = $this -> getPost ( 'DevelopmentSetting' )) !== null )
                {
                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'development-setting',array ( 'model' => $model ) );
        }

        public function actionWidget ()
        {
                $model = $this -> createSettingModel ( 'WidgetSetting' );

                if ( ($settings = $this -> getPost ( 'WidgetSetting' )) !== null )
                {
                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'widget-setting',array ( 'model' => $model ) );
        }

        public function actionSystem ()
        {
                $model = $this -> createSettingModel ( 'SystemSetting' );

                if ( ($settings = $this -> getPost ( 'SystemSetting' )) !== null )
                {
                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'system-setting',array ( 'model' => $model ) );
        }

        public function actionServer ()
        {

                $model = $this -> createSettingModel ( 'ServerSetting' );

                if ( ($settings = $this -> getPost ( 'ServerSetting' )) !== null )
                {
                        if ( $settings[ 'runtimePath' ] == FALSE )
                        {
                                $settings[ 'runtimePath' ] = Ycms::app () -> getRuntimePath ();
                        }

                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'server-setting',array ( 'model' => $model ) );
        }

        public function actionUser ()
        {

                $model = $this -> createSettingModel ( 'UserSetting' );

                if ( ($settings = $this -> getPost ( 'UserSetting' )) !== null )
                {
                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'user-setting',array ( 'model' => $model ) );
        }

        public function updateSettings ( $model,$settings )
        {
                $oldAttributes = $model -> attributes;

                $model -> attributes = $settings;

                if ( $model -> validate () !== FALSE )
                {
                        $updateFields = arrayDiffAssoc ( $model -> attributes,$oldAttributes );

                        if ( $model -> duplicateSettings ( $updateFields ) !== FALSE )
                        {
                                YMessage::setFlash ( Ycms::t ( 'setting','修改配置成功' ) );
                        }
                        else
                        {
                                YMessage::setFlash ( Ycms::t ( 'setting','修改配置失败' ) );
                                return false;
                        }
                }

                return TRUE;
        }

        public function actionMailTemplate ()
        {
                Ycms::import ( 'backendApp.models.MailTemplate' );

                $rawData = MailTemplate::templateList ();

                $dataProvider = new CArrayDataProvider ( $rawData,array ( 'keyField' => 'alias' ) );

                $this -> render ( 'mail-template',array ( 'dataProvider' => $dataProvider ) );
        }

        public function actionUpdateMailTemplate ( $type = '' )
        {
                $model = $this -> createExArrayModel ( 'MailTemplate',$type );

                if ( ($model -> attributes = $this -> getPost ( 'MailTemplate' )) !== null && $model -> validate () !== FALSE )
                {
                        if ( $model -> save () === true )
                        {
                                YMessage::setFlash ( Ycms::t ( 'setting','修改邮件模版成功' ) );
                        }
                }

                $this -> render ( 'mail-template-view',array ( 'model' => $model ) );
        }

        public function actionBlockedIp ( $id = null )
        {

                $model = $this -> loadDaoModel ( 'BlockedIp' );

                if ( ($model -> attributes = $this -> getPost ( 'BlockedIp' )) !== null && $model -> validate () !== FALSE )
                {
                        if ( $model -> createIp ( array ( 'ip' => $model -> ip ) ) === true )
                        {
                                YMessage::setFlash ( Ycms::t ( 'blockedip','增加ip成功' ) );
                        }

                        $model -> unsetAttributes ();
                }

                if ( $id !== null )
                {
                        if ( $model -> deleteIp ( $id ) === true )
                        {
                                YMessage::setFlash ( Ycms::t ( 'blockedip','删除ip成功' ) );
                        }
                }


                $dataProvider = new CArrayDataProvider ( $model -> getIps (),array ( 'keyField' => 'id' ) );

                $this -> render ( 'blockedip',array ( 'model' => $model,'dataProvider' => $dataProvider ) );
        }

        public function actionFileSystem ()
        {
                $model = $this -> createSettingModel ( 'FileSystemSetting' );

                if ( ($settings = $this -> getPost ( 'FileSystemSetting' )) !== null )
                {
                        $this -> updateSettings ( $model,$settings );
                }

                $this -> render ( 'filesystem-setting',array ( 'model' => $model ) );
        }

}
