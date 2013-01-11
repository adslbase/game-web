<?php

    /**
     * YTimePicker class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    Yii::import('zii.widgets.jui.CJuiInputWidget');

    /**
     * 使用jui选取时间
     * 
     * @version $Id: YTimePicker.php UTF-8 2011-7-29 14:30:47 li feixiang 
     * @package framework
     * @since 1.0
     * 
     */
    class YJuiTimePicker extends CJuiInputWidget
    {

        private $_sourceUrl;
        public $language;
        public $i18nScriptFile = 'jquery-ui-i18n.min.js';
        public $extraScriptFile = "jquery-ui-timepicker-addon.js";
        public $extraCssFile = "jquery-ui-timepicker-addon.css";
        public $datetimePicker = false;

        public function run()
        {
            $cs = Yii::app()->getClientScript();
            $cs->registerCssFile($this->getSourceUrl() . '/' . $this->extraCssFile);
            $cs->registerScriptFile($this->getSourceUrl() . '/' . $this->extraScriptFile, CClientScript::POS_END);

            list($name, $id) = $this->resolveNameID();

            if (isset($this->htmlOptions['id']))
                $id = $this->htmlOptions['id'];
            else
                $this->htmlOptions['id'] = $id;
            if (isset($this->htmlOptions['name']))
                $name = $this->htmlOptions['name'];
            else
                $this->htmlOptions['name'] = $name;

            if ($this->hasModel())
                echo YHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
            else
                echo YHtml::textField($name, $this->value, $this->htmlOptions);

            $options = CJavaScript::encode($this->options);

            if ($this->datetimePicker == FALSE)
                $js = "jQuery('#{$id}').timepicker($options);";
            else
                $js = "jQuery('#{$id}').datetimepicker($options);";

            if ($this->language != '' && $this->language != 'en')
            {
                $this->registerScriptFile($this->i18nScriptFile);              
                if ($this->datetimePicker == FALSE)
                    $js = "jQuery('#{$id}').timepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['{$this->language}'], {$options}));";
                else
                    $js = "jQuery('#{$id}').datetimepicker(jQuery.extend({showMonthAfterYear:false}, jQuery.datepicker.regional['{$this->language}'], {$options}));";
            }
            Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $id, $js);
        }

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

    }