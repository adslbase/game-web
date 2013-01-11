<?php

    /**
     * Ycms class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    require_once YPATH_YII . '/yii.php';

    /**
     * 这个类实干什么用的
     *
     * @version $Id: Ycms.php UTF-8 2011-5-2 19:09:06 li feixiang
     * @package framework
     * @since 1.0
     *
     */
    class Ycms extends Yii
    {

        private static $_sitePath;
        private static $_imports = array();
        private static $_includePaths;

        public static function getVersion()
        {
            return YcmsVersion::VERSION;
        }

        /**
         * $config 外面的全局变量待unset
         * @staticvar array $applications
         * @param type $name
         * @param type $config
         * @param type $loadCommonConfig
         * @param type $loadSiteConfig
         * @return type 
         */
        public static function getApplication($name, &$info = null, $loadCommonConfig= true, $loadSiteConfig = true)
        {

            static $applications = array();

            self::registerAutoloader(array('Ycms', 'autoload'));

            if (!isset($applications[$name]))
            {

                $config = array();
                $appInfo = self::getAppInfo($name);

                if (is_array($info))
                {
                    $appInfo = array_merge($appInfo, $info);
                }
                else if (is_string($info))
                {
                    $appInfo['configPath'] = $info;
                }

                unset($info);

                if (isset($appInfo['configPath']) && is_file($appInfo['configPath']))
                {
                    $config = require $appInfo['configPath'];
                }
                else
                {
                    echo Ycms::t('ycms', '配置路径不存在');
                }

                if ($loadCommonConfig === TRUE)
                {
                    $config = CMap::mergeArray(require YPATH_COMMON . DS . 'config' . DS . 'setting.php', $config);
                }

                if ($loadSiteConfig === TRUE && !defined('PHP_UNIT') && ($siteConfigPath = self::getSiteConfigPath($name)) !== null)
                {
                    $config = CMap::mergeArray($config, require $siteConfigPath);

                    if (!isset($config['sitePath']))
                    {
                        $config['sitePath'] = self::$_sitePath;
                    }
                }

                $config['name'] = $name;

                if (!isset($config['basePath']))
                {
                    $config['basePath'] = $appInfo['basePath'];
                }

                $applications[$name] = self::createYcmsApplication($config);
            }

            return $applications[$name];
        }

        /**
         * 创建Ycms应用
         * @param type $config
         * @return type 
         */
        public static function createYcmsApplication($config = null)
        {
            self::setEnvironment($config);

            return self::createApplication('YcmsApplication', $config);
        }

        /**
         * 返回应用基本类型
         * @param type $name
         * @param type $key
         * @return array
         */
        public static function getAppInfo($name = null, $key = '')
        {
            $clients = array(
                    'backend' => array(
                            'basePath' => YPATH_BACKEND,
                            'configPath' => YPATH_BACKEND . DS . 'config' . DS . 'setting.php',
                    ),
                    'frontend' => array(
                            'basePath' => YPATH_FRONTEND,
                            'configPath' => YPATH_FRONTEND . DS . 'config' . DS . 'setting.php',
                    )
            );


            if ($name === null)
            {
                return $clients;
            }

            if (!isset($clients[$name]))
                return array();

            if ($key !== '')
            {
                return $clients[$name][$key];
            }

            return $clients[$name];
        }

        /**
         * 设置程序运行环境
         * @param type $config
         */
        public static function setEnvironment(&$config)
        {

            if (isset($config['error_reporting']))
            {

                if ($config['error_reporting'] === 0)
                {
                    error_reporting(0);
                }
                else if ($config['error_reporting'] > 0)
                {
                    error_reporting($config['error_reporting']);
                    ini_set('display_errors', 1);
                }
                
                unset($config['error_reporting']);
            }

            ini_set('magic_quotes_runtime', '0');
            ini_set('session.cache_limiter', 'none');
            ini_set('session.cookie_httponly', '1');
            ini_set('session.cookie_lifetime', 2000000);

            setlocale(LC_ALL, 'C');
        }

        /**
         * 自动加载ycms中的类文件
         * @param type $className
         * @return type
         */
        public static function autoload($className)
        {

            if (isset(self::$_coreClasses[$className]))
            {
                include(YPATH_YCMS . self::$_coreClasses[$className]);
            }
            else if (isset(self::$classMap[$className]))
            {
                include(self::$classMap[$className]);
            }
            else if (file_exists(YPATH_YCMS . DS . $className . '.php'))
            {
                include(YPATH_YCMS . DS . $className . '.php');
            }
            return true;
        }

        /**
         * ycms各种应用类文件用于自动加载
         * @var array
         */
        private static $_coreClasses = array(
                'YUserIdentity' => '/web/auth/YUserIdentity.php',
                'YPasswordHash' => '/web/auth/YPasswordHash.php',
                'YModel' => '/db/YModel.php',
                'YDaoModel' => '/db/YDaoModel.php',
                'YArrayModel' => '/db/YArrayModel.php',
                'YHtml' => '/web/helpers/YHtml.php',
                'YMessage' => '/util/YMessage.php',
        );

        /**
         * 获取站点配置路径
         * @param string $name    应用名
         * @return type 
         */
        public static function getSiteConfigPath($name='')
        {
            $configPath = array();

            $sitePath = self::getSitePath();

            if ($name !== '')
            {
                $configPath[] = $sitePath . DS . 'config' . DS . $name . '.php';
            }

            $configPath[] = $sitePath . DS . 'config' . DS . 'setting.php';

            foreach ($configPath as $path)
            {
                if (is_file($path))
                    return $path;
            }

            return null;
        }

        /**
         * 获取站点路径
         * @param type $require_settings
         * @param type $reset
         * @return type
         */
        public static function getSitePath($require_settings = TRUE, $reset = FALSE)
        {

            if (self::$_sitePath !== null && $reset !== TRUE)
            {
                return self::$_sitePath;
            }

            $sites = array();
            if (file_exists(YPATH_SITES . DS . 'sites.php'))
            {
                // This will overwrite $sites with the desired mappings.
                include(YPATH_SITES . DS . 'sites.php');
            }

            $uri = explode(DS, $_SERVER['SCRIPT_NAME'] ? $_SERVER['SCRIPT_NAME'] : $_SERVER['SCRIPT_FILENAME'] );

            $server = explode('.', implode('.', array_reverse(explode(':', rtrim($_SERVER['HTTP_HOST'], '.')))));
            for ($i = count($uri) - 1; $i > 0; $i--)
            {
                for ($j = count($server); $j > 0; $j--)
                {
                    $dir = implode('.', array_slice($server, -$j)) . implode('.', array_slice($uri, 0, $i));
                    if (isset($sites[$dir]) && file_exists(YPATH_SITES . DS . $sites[$dir]))
                    {
                        $dir = $sites[$dir];
                    }
                    if (file_exists(YPATH_SITES . DS . $dir . DS . 'config' . DS . 'setting.php') || (!$require_settings && file_exists(YPATH_SITES . DS . $dir)))
                    {
                        self::$_sitePath = YPATH_SITES . DS . $dir;
                        return self::$_sitePath;
                    }
                }
            }

            return self::$_sitePath = YPATH_SITES . DS . "default";
        }

        /**
         * 导入文件,如果找不到文件，会尝试在common公共文件夹下查找。
         * @param type $alias
         * @param type $forceInclude
         * @return type
         */
        public static function import($alias, $forceInclude=false)
        {
            if (isset(self::$_imports[$alias]))  // previously imported
                return self::$_imports[$alias];

            if (class_exists($alias, false) || interface_exists($alias, false))
                return self::$_imports[$alias] = $alias;

            if (($pos = strrpos($alias, '\\')) !== false) // a class name in PHP 5.3 namespace format
            {
                $namespace = str_replace('\\', '.', ltrim(substr($alias, 0, $pos), '\\'));
                if (($path = self::getPathOfAlias($namespace)) !== false)
                {
                    $classFile = $path . DIRECTORY_SEPARATOR . substr($alias, $pos + 1) . '.php';
                    if ($forceInclude)
                    {
                        if (is_file($classFile))
                            require($classFile);
                        else
                            throw new CException(Yii::t('yii', 'Alias "{alias}" is invalid. Make sure it points to an existing PHP file.', array('{alias}' => $alias)));
                        self::$_imports[$alias] = $alias;
                    }
                    else
                        self::$classMap[$alias] = $classFile;
                    return $alias;
                }
                else
                    throw new CException(Yii::t('yii', 'Alias "{alias}" is invalid. Make sure it points to an existing directory.', array('{alias}' => $namespace)));
            }

            if (($pos = strrpos($alias, '.')) === false)  // 是一个简单类，不是别名路径
            {
                if ($forceInclude && self::autoload($alias))
                    self::$_imports[$alias] = $alias;
                return $alias;
            }

            $className = (string) substr($alias, $pos + 1);
            $isClass = $className !== '*';

            if ($isClass && (class_exists($className, false) || interface_exists($className, false)))
                return self::$_imports[$alias] = $className;

            if (($path = self::getPathOfAlias($alias)) !== false)
            {
                if ($isClass)
                {
                    if (is_file($path . '.php'))
                    {
                        if ($forceInclude)
                        {
                            require($path . '.php');
                            self::$_imports[$alias] = $className;
                        }
                        else
                        {
                            self::$classMap[$className] = $path . '.php';//保存到数组中。实例化直接从中取。所以类名和文件名要相同
                        }
                    }
                    //如果是common目录里的就不用再查找了,否则查找common目录
                    else if (($pos = strpos($alias, '.')) !== false && substr($alias, 0, $pos) !== 'common')
                    {
                        $alias = substr_replace($alias, 'common', 0, $pos);

                        $className = self::import($alias);
                    }
                    else
                    {
                        throw new CException(Yii::t('yii', 'Alias "{alias}" is invalid. Make sure it points to an existing PHP file.', array('{alias}' => $alias)));
                    }

                    return $className;
                }
                else  // a directory
                {
                    if (self::$_includePaths === null)
                    {
                        self::$_includePaths = array_unique(explode(PATH_SEPARATOR, get_include_path()));
                        if (($pos = array_search('.', self::$_includePaths, true)) !== false)
                            unset(self::$_includePaths[$pos]);
                    }

                    array_unshift(self::$_includePaths, $path);

                    if (set_include_path('.' . PATH_SEPARATOR . implode(PATH_SEPARATOR, self::$_includePaths)) === false)
                        throw new CException(Yii::t('yii', 'Unable to import "{alias}". Please check your server configuration to make sure you are allowed to change PHP include_path.', array('{alias}' => $alias)));

                    return self::$_imports[$alias] = $path;
                }
            }
            else
                throw new CException(Yii::t('yii', 'Alias "{alias}" is invalid. Make sure it points to an existing directory or file.', array('{alias}' => $alias)));
        }

    }

    