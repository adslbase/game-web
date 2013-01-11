<?php

/**
 * YAssetManager class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined('INYCMS') or die;

/**
 * 这个类实干什么用的
 * 
 * @version $Id: YAssetManager.php UTF-8 2011-6-1 18:42:40 li feixiang
 * @package ycms
 * @since 1.0
 * 
 */
class YAssetManager extends CApplicationComponent
{
        /**
         * Default web accessible base path for storing private files
         */
        const DEFAULT_BASEPATH='assets';
        /**
         * @var boolean whether to use symbolic link to publish asset files. Defaults to false, meaning
         * asset files are copied to public folders. Using symbolic links has the benefit that the published
         * assets will always be consistent with the source assets. This is especially useful during development.
         *
         * However, there are special requirements for hosting environments in order to use symbolic links.
         * In particular, symbolic links are supported only on Linux/Unix, and Windows Vista/2008 or greater.
         * The latter requires PHP 5.3 or greater.
         *
         * Moreover, some Web servers need to be properly configured so that the linked assets are accessible
         * to Web users. For example, for Apache Web server, the following configuration directive should be added
         * for the Web folder:
         * <pre>
         * Options FollowSymLinks
         * </pre>
         *
         * @since 1.1.5
         */
        public $linkAssets = false;
        /**
         * @var array list of directories and files which should be excluded from the publishing process.
         * Defaults to exclude '.svn' files only. This option has no effect if {@link linkAssets} is enabled.	 
         * @since 1.1.6
         * */
        public $excludeFiles = array('.svn');
        /**
         * @var string base web accessible path for storing private files
         */
        private $_basePath;
        /**
         * @var string base URL for accessing the publishing directory.
         */
        private $_baseUrl;
        /**
         * @var array published assets
         */
        private $_published = array();
        public $isPublish = true;
        private $_onlyDir;

        /**
         * @return string the root directory storing the published asset files. Defaults to 'WebRoot/assets'.
         */
        public function getBasePath()//绝对路径/host/web//sae/apps/ycms/1/code/assets
        {
                if ($this->_basePath === null)
                {
                        $request = Yii::app()->getRequest();
                        $this->setBasePath(dirname($request->getScriptFile()) . DS . self::DEFAULT_BASEPATH . DS . $this->getOnlyDir());
                }
                return $this->_basePath;
        }

        /**
         * Sets the root directory storing published asset files.
         * @param string $value the root directory storing published asset files
         * @throws CException if the base path is invalid
         */
        public function setBasePath($value)
        {
                if (($basePath = realpath($value)) !== false && is_dir($basePath) && is_writable($basePath))
                        $this->_basePath = $basePath;
                else
                        throw new CException(Yii::t('yii', 'CAssetManager.basePath "{path}" is invalid. Please make sure the directory exists and is writable by the Web server process.', array('{path}' => $value)));
        }

        /**
         * @return string the base url that the published asset files can be accessed.
         * Note, the ending slashes are stripped off. Defaults to '/AppBaseUrl/assets'.
         */
        public function getBaseUrl()//http://local/sae/apps/ycms/1/code/assets
        {
                if ($this->_baseUrl === null)
                {
                        $request = Yii::app()->getRequest();
                        if ($this->isPublish === FALSE)
                        {
                                $this->setBaseUrl($request->getBaseUrl());
                        }
                        else
                        {
                                $this->setBaseUrl($request->getBaseUrl() . '/' . self::DEFAULT_BASEPATH . '/' . $this->getOnlyDir());
                        }
                }
                return $this->_baseUrl;
        }

        /**
         * @param string $value the base url that the published asset files can be accessed
         */
        public function setBaseUrl($value)
        {
                $this->_baseUrl = rtrim($value, '\\/');
        }

        public function getOnlyDir()
        {
                if ($this->_onlyDir !== null)
                {
                        return $this->_onlyDir;
                }
        }

        public function setOnlyDir($value)
        {
                $this->_onlyDir = $value;
        }

        public function publish($path, $hashByName=false, $level=-1, $forceCopy=false)
        {
                if (isset($this->_published[$path]))
                        return $this->_published[$path];
                else if (($src = realpath($path)) !== false)
                {
                        if ($this->isPublish === FALSE)
                        {
                                $path = str_replace(YPATH_ROOT, '', $src);

                                return $this->_published[$path] = $this->getBaseUrl() . DS . ltrim($path, DS);
                        }

                        if (is_file($src))
                        {

                                $dir = $this->hash($hashByName ? basename($src) : dirname($src) );
                                $fileName = basename($src);
                                $dstDir = $this->getBasePath() . DIRECTORY_SEPARATOR . $dir;
                                $dstFile = $dstDir . DIRECTORY_SEPARATOR . $fileName;

                                if ($this->linkAssets)
                                {
                                        if (!is_file($dstFile))
                                        {
                                                if (!is_dir($dstDir))
                                                {
                                                        mkdir($dstDir);
                                                        @chmod($dstDir, 0777);
                                                }
                                                symlink($src, $dstFile);
                                        }
                                }
                                else if (@filemtime($dstFile) < @filemtime($src) || $forceCopy)
                                {
                                        if (!is_dir($dstDir))
                                        {
                                                mkdir($dstDir);
                                                @chmod($dstDir, 0777);
                                        }
                                        copy($src, $dstFile);
                                }

                                return $this->_published[$path] = $this->getBaseUrl() . "/$dir/$fileName";
                        }
                        else if (is_dir($src))
                        {
                                $dir = $this->hash($hashByName ? basename($src) : dirname($src) );
                                $dstDir = $this->getBasePath() . DIRECTORY_SEPARATOR . $dir;

                                if ($this->linkAssets)
                                {
                                        if (!is_dir($dstDir))
                                                symlink($src, $dstDir);
                                }
                                else if (!is_dir($dstDir) || $forceCopy)
                                        CFileHelper::copyDirectory($src, $dstDir, array('exclude' => $this->excludeFiles, 'level' => $level));

                                return $this->_published[$path] = $this->getBaseUrl() . '/' . $dir;
                        }
                }
                throw new CException(Yii::t('yii', 'The asset "{asset}" to be published does not exist.', array('{asset}' => $path)));
        }

        /**
         * Returns the published path of a file path.
         * This method does not perform any publishing. It merely tells you
         * if the file or directory is published, where it will go.
         * @param string $path directory or file path being published
         * @param boolean $hashByName whether the published directory should be named as the hashed basename.
         * If false, the name will be the hashed dirname of the path being published.
         * Defaults to false. Set true if the path being published is shared among
         * different extensions.
         * @return string the published file path. False if the file or directory does not exist
         */
        public function getPublishedPath($path, $hashByName=false)
        {
                if (($path = realpath($path)) !== false)
                {
                        $base = $this->getBasePath() . DIRECTORY_SEPARATOR;
                        if (is_file($path))
                                return $base . $this->hash($hashByName ? basename($path) : dirname($path) ) . DIRECTORY_SEPARATOR . basename($path);
                        else
                                return $base . $this->hash($hashByName ? basename($path) : $path );
                }
                else
                        return false;
        }

        /**
         * Returns the URL of a published file path.
         * This method does not perform any publishing. It merely tells you
         * if the file path is published, what the URL will be to access it.
         * @param string $path directory or file path being published
         * @param boolean $hashByName whether the published directory should be named as the hashed basename.
         * If false, the name will be the hashed dirname of the path being published.
         * Defaults to false. Set true if the path being published is shared among
         * different extensions.
         * @return string the published URL for the file or directory. False if the file or directory does not exist.
         */
        public function getPublishedUrl($path, $hashByName=false)
        {
                if (isset($this->_published[$path]))
                        return $this->_published[$path];
                if (($path = realpath($path)) !== false)
                {
                        if (is_file($path))
                                return $this->getBaseUrl() . '/' . $this->hash($hashByName ? basename($path) : dirname($path) ) . '/' . basename($path);
                        else
                                return $this->getBaseUrl() . '/' . $this->hash($hashByName ? basename($path) : $path );
                }
                else
                        return false;
        }

        /**
         * Generate a CRC32 hash for the directory path. Collisions are higher
         * than MD5 but generates a much smaller hash string.
         * @param string $path string to be hashed.
         * @return string hashed string.
         */
        protected function hash($path)
        {
                return sprintf('%x', crc32($path . Yii::getVersion()));
        }

}