<?php

        /**
         * YController class file.
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
         * @version $Id: YController.php UTF-8 2011-8-10 10:28:01 li feixiang 
         * @package framework
         * @since 1.0
         * 
         */
        abstract class YController extends CController
        {

                /**
                 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
                 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
                 */
                public $layout = '//layouts/column1';

                /**
                 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
                 */
                public $menu = array();

                /**
                 * @var array the breadcrumbs of the current page. The value of this property will
                 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
                 * for more details on how to specify this property.
                 */
                public $breadcrumbs = array();
                private static $_models = array('isArModels' => 0);

                public static function getQuery($name, $defaultValue = null)
                {
                        return Ycms::app()->getRequest()->getQuery($name, $defaultValue);
                }

                public static function getPost($name, $defaultValue = null)
                {
                        return Ycms::app()->getRequest()->getPost($name, $defaultValue);
                }

                public static function dump($var, $highlight = false, $depth = 10)
                {
                        return CVarDumper::dump($var, $depth, $highlight);
                }

                public static function getUrl()
                {
                        return Ycms::app()->getRequest()->getRequestUri();
                }

                public static function getMemoryUsage()
                {
                        return CLogger::getMemoryUsage();
                }

                /**
                 * 提示信息页面跳转，跳转地址如果传入数组，页面会提示多个地址供用户选择，默认跳转地址为数组的第一个值，时间为5秒。
                 * showmessage(array('url'=>,'content'=>,'title'=>));
                 * @param string $msg 提示信息
                 * @param mixed(string/array) $url_forward 跳转地址
                 * @param int $ms 跳转等待时间
                 */
                public function showMessage($msg, $dialog = false, $time = 3600, $view = '//system/message', $viewDialog = '//system/dialogMessage')
                {

                        if (!isset($msg['url']) && $dialog == false)
                                $msg['url'] = HTTP_REFERER;
                        elseif ($dialog == true)
                                $msg['url'] = false;
                        else
                                $msg['url'] = $this->createUrl($msg['url']);

                        if (!isset($msg['title']))
                                $msg['title'] = Ycms::t('ycms', '提示信息');

                        if ($dialog === true)
                        {
                                $this->render($viewDialog, array('msg' => $msg));
                                Ycms::app()->end();
                        }

                        $this->render($view, array('msg' => $msg, 'time' => $time));
                        Ycms::app()->end();
                }

                //通过判断其中是否有某个属性区分ar和dao，以及array，object模型，//避免重复建立model
                public function model($className, $scenario = 'insert', $properties = array())
                {
                        if (self::$_models['isArModels'] == 0)
                                self::$_models = &YActiveRecord::getModels();

                        if (isset(self::$_models[$className]))
                                $model = self::$_models[$className];
                        else
                        {
                                $className = Ycms::import(Ycms::app()->name . 'App.models.' . $className);
                                if (property_exists($className, '_models'))
                                {
                                        $model = self::$_models[$className] = new $className(null);
                                        $model->_md = new CActiveRecordMetaData($model);
                                        $model->attachBehaviors($model->behaviors());
                                }
                                else
                                {
                                        $model = self::$_models[$className] = new $className($scenario);
                                }
                        }

                        foreach ($properties as $name => $value)
                        {
                                $model->$name = $value;
                        }

                        return $model;
                }

                /**
                 * 创建模型，用import导入当前应用中的models文件夹下内容，并实例化，赋值
                 * @param type $className
                 * @param type $scenario
                 * @param type $defaultAttributes
                 * @param type $properties
                 * @return className
                 */
                public static function loadDaoModel($className, $scenario = 'create', $defaultAttributes = true, $properties = array())
                {
                        if ((strrpos($className, '.')) === false)  // 是一个简单类，不是别名路径
                        {
                                $className = Ycms::import(Ycms::app()->name . 'App.models.' . $className);
                        }
                        else
                        {
                                $className = Ycms::import($className);
                        }

                        $model = new $className($scenario, $defaultAttributes);

                        foreach ($properties as $name => $value)
                        {
                                $model->$name = $value;
                        }

                        return $model;
                }

                /**
                 * This method is invoked when the request parameters do not satisfy the requirement of the specified action.
                 * The default implementation will throw a 400 HTTP exception.
                 * @pararm CAction $action the action being executed
                 * @since 1.1.7
                 */
                public function invalidActionParams($action)
                {
                        throw new CHttpException(400, Yii::t('ycms', '你的动作中的参数没有从url中传进来.'));
                }

                /**
                 * 在后台创建前台的url
                 * @param type $route
                 * @param array $params
                 * @param string $ampersand
                 * @return type 
                 */
                public function createFrontUrl($route, $params = array(), $isHTML=1,$ampersand = '&')
                {

                        !defined('ISHTML') && define('ISHTML', 0);
                        if (ISHTML == 0 ||$isHTML==0)
                        {
                                $url = parent::createUrl($route, $params, $ampersand);
                                $url = str_replace('admin', 'index', $url);
                        }
                        else
                        {
                                $baseUrl = Yii::app()->urlManager->getBaseUrl();
                                $url = rtrim($baseUrl, 'admin.php');
                                if (!isset($params['service']) && isset($params['cid']))
                                {
                                        $url .= 'live' . $params['cid'];
                                }
                                else
                                {
                                        foreach ($params as $value)
                                        {
                                                $url .= $value;
                                        }
                                }

                                $url .='.html';
                        }
                        return $url;
                }

        }