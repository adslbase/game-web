<?php

    /**
     * YcmsApplication class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    define('REQUEST_TIME', $_SERVER['REQUEST_TIME']);

    define('HTTP_REFERER', isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '' );

    /**
     * 这个类实干什么用的
     * 
     * @version $Id: YcmsApplication.php UTF-8 2011-5-2 19:09:55 li feixiang 
     * @package framework
     * @since 1.0
     * 
     */
    class YcmsApplication extends CWebApplication
    {

        private $_sitePath;
        private $_siteControllerPath;
        private $_siteviewPath;

        /**
         * 构造函数--主要用于处理配置文件
         * @param type $config 
         */
        public function __construct($config=null)
        {

            require_once YPATH_YCMS . DS . 'global.func.php';

            if (isset($config['sitePath']))
            {
                $this->setSitePath($config['sitePath']);
                unset($config['sitePath']);

                $sitePath = $this->getSitePath();
                if (is_file($sitePath . DS . 'extensions' . DS . 'extention.func.php'))
                {
                    require_once $sitePath . DS . 'extensions' . DS . 'extention.func.php';
                }

                defined('YPATH_SITE') or define('YPATH_SITE', $sitePath);
                Ycms::setPathOfAlias('site', YPATH_SITE);
            }

            Ycms::setPathOfAlias('backendApp', YPATH_BACKEND);
            Ycms::setPathOfAlias('common', YPATH_COMMON);
            Ycms::setPathOfAlias('frontendApp', YPATH_FRONTEND);
            Ycms::setPathOfAlias('ycms', YPATH_YCMS);

            //如果已经储存过app()则不再储存
            if (Ycms::app() === null)
            {
                Yii::setApplication($this);
            }

            if (isset($config['basePath']))
            {
                $this->setBasePath($config['basePath']);
                Ycms::app()->setBasePath($config['basePath']);
                unset($config['basePath']);
            }
            else
                $this->setBasePath('protected');

            //如果已经设置过application别名，将不再设置,由于别名是储存在静态属性中，会被覆盖
            if (Ycms::getPathOfAlias('application') === false)
            {
                Ycms::setPathOfAlias('application', $this->getBasePath());
            }

            $this->preinit();

            $this->initSystemHandlers();
            $this->registerCoreComponents();

            $this->configure($config);
            Ycms::app()->configure($config);
             
            $this->attachBehaviors($this->behaviors);
            $this->preloadComponents();

            $this->init();
        }

        public function setSitePath($path)
        {
            if (($this->_sitePath = realpath($path)) === false || !is_dir($this->_sitePath))
                throw new CException(Ycms::t('ycms', '站点路径 "{path}" 不存在.', array('{path}' => $path)));
        }

        public function getSitePath()
        {
            return $this->_sitePath;
        }

        public function createController($route, $owner=null)
        {
            if (($ca = parent::createController($route, $owner)) !== null)
                return $ca;

            if (($route = trim($route, '/')) === '')
                $route = $this->defaultController;
            $caseSensitive = $this->getUrlManager()->caseSensitive;

            $route.='/';
            while (($pos = strpos($route, '/')) !== false)
            {
                $id = substr($route, 0, $pos);
                if (!preg_match('/^\w+$/', $id))
                    return null;
                if (!$caseSensitive)
                    $id = strtolower($id);
                $route = (string) substr($route, $pos + 1);
                if (!isset($basePath))  // first segment
                {
                    $basePath = $this->getSiteControllerPath();
                    $controllerID = '';
                }
                else
                    $controllerID.='/';
                $className = ucfirst($id) . 'Controller';
                $classFile = $basePath . DIRECTORY_SEPARATOR . $className . '.php';
                if (is_file($classFile))
                {
                    if (!class_exists($className, false))
                        require($classFile);
                    if (class_exists($className, false) && is_subclass_of($className, 'CController'))
                    {
                        $id[0] = strtolower($id[0]);
                        return array(
                                new $className($controllerID . $id),
                                $this->parseActionParams($route),
                        );
                    }
                    return null;
                }
                $controllerID.=$id;
                $basePath.=DIRECTORY_SEPARATOR . $id;
            }
        }

        /**
         * @return string the directory that contains the controller classes. Defaults to 'protected/controllers'.
         */
        public function getSiteControllerPath()
        {
            if ($this->_siteControllerPath !== null)
                return $this->_siteControllerPath;
            else
                return $this->_siteControllerPath = $this->getSitePath() . DS . 'controllers';
        }

        /**
         * @param string $value the directory that contains the controller classes.
         * @throws CException if the directory is invalid
         */
        public function setSiteControllerPath($value)
        {
            if (($this->_siteControllerPath = realpath($value)) === false || !is_dir($this->_siteControllerPath))
                throw new CException(Yii::t('yii', 'The controller path "{path}" is not a valid directory.', array('{path}' => $value)));
        }

        /**
         * @return string the root directory of view files. Defaults to 'protected/views'.
         */
        public function getSiteViewPath()
        {
            if ($this->_siteviewPath !== null)
                return $this->_siteviewPath;
            else
                return $this->_siteviewPath = $this->getSitePath() . DIRECTORY_SEPARATOR . 'views';
        }

        /**
         * @param string $path the root directory of view files.
         * @throws CException if the directory does not exist.
         */
        public function setSiteViewPath($path)
        {
            if (($this->_siteviewPath = realpath($path)) === false || !is_dir($this->_siteviewPath))
                throw new CException(Yii::t('yii', 'The view path "{path}" is not a valid directory.', array('{path}' => $path)));
        }

        /**
         * 获取配置项目
         * @param type $setting
         * @param type $default
         * @return mixed  
         */
        public static function getSetting($setting=null, $default = false)
        {
            Ycms::import('backendApp.models.setting.Setting');

            if ($setting === null)
                return Setting::loadSettings();

            return Setting::getSetting($setting, $default);
        }


    }