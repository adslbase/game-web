<?php

    /**
     * YColorPicker class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     *  颜色选择器
     * 
     * @version $Id: YColorPicker.php UTF-8 2011-7-26 10:22:22 li feixiang 
     * @package framework
     * @since 1.0
     * 
     */
    class YColorPicker extends CInputWidget
    {

        private $_sourceUrl;
        private $_defaultColor;
        private $_imageUrl;

        public function setSourceUrl($url=null)
        {
            if ($url !== null)
            {
                $this->_sourceUrl = $url;
            }
            else
            {
                $dir = dirname(__FILE__) . DS . 'source';
                $this->_sourceUrl = Ycms::app()->getAssetManager()->publish($dir);
            }
        }

        public function getSourceUrl()
        {
            if ($this->_sourceUrl == null)
            {
                $this->setSourceUrl();
            }

            return $this->_sourceUrl;
        }

        public function setDefaultColor($color = null)
        {
            if ($this->model !== null && $this->attribute !== null)
            {
                $this->_defaultColor = YHtml::resolveValue($this->model, $this->attribute);
            }
            else if ($color !== null)
            {
                $this->_defaultColor = $color;
            }
        }

        public function getDefaultColor()
        {
            if ($this->_defaultColor == null)
            {
                $this->setDefaultColor();
            }

            return $this->_defaultColor;
        }

        public function setImageUrl($url = null)
        {
            if ($url !== null)
            {
                $this->_imageUrl = $url;
            }
            else
            {
                $this->_imageUrl = $this->sourceUrl.'/color.png';
            }
        }

        public function getImageUrl()
        {
            if ($this->_imageUrl == null)
            {
                $this->setImageUrl();
            }

            return $this->_imageUrl;
        }

        public function init()
        {
            list($name, $id) = $this->resolveNameID();
            if (isset($this->htmlOptions['id']))
                $id = $this->htmlOptions['id'];
            else
                $this->htmlOptions['id'] = $id;
            if (isset($this->htmlOptions['name']))
                $name = $this->htmlOptions['name'];

            if (isset($this->htmlOptions['class']))
            {
                $this->htmlOptions['class'] .=' iColorPicker';
            }
            else
            {
                $this->htmlOptions['class'] = 'iColorPicker';
            }

            $cs = Ycms::app()->getClientScript();
            $cs->registerScriptFile($this->sourceUrl . '/iColorPicker.js');
            $cs->registerScript($id, '
 iColorPicker("' . $this->imageUrl . '")                
');
            echo YHtml::textField($name, $this->defaultColor, $this->htmlOptions);
        }

    }