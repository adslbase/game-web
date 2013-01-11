<?php

    /**
     * YHtml class file.
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
     * @version $Id: YHtml.php UTF-8 2011-5-1 0:28:32 li feixiang
     * @package string
     * @since 1.0
     * 
     */
    class YHtml extends CHtml
    {

        /**
         * 返回站点基本url,这里使用了/。未使用DS。因为用于url
         * @staticvar string $baseUrl
         * @param string        $url            需要连接的url
         * @param boolean        $absolute       false--/sae/apps/ycms/1/code    true----http://local/sae/apps/ycms/1/code
         * @return string 
         */
        public static function getBaseUrl($url = null, $baseUrl = '')
        {
            if ($baseUrl !== '')
                $baseUrl = rtrim($baseUrl, '\\/');
            else
                $baseUrl = Ycms::app()->getBaseUrl();

            return $url === null ? $baseUrl : $baseUrl . '/' . ltrim($url, '\\/');
        }

        public static function imageUrl($url, $baseUrl = '')
        {
            return self::getBaseUrl('assets/statics/images/' . ltrim($url, '\\/'), $baseUrl);
        }

        public static function cssUrl($url, $baseUrl = '')
        {
            return self::getBaseUrl('assets/statics/css/' . ltrim($url, '\\/'), $baseUrl);
        }

        public static function jsUrl($url, $baseUrl = '')
        {
            return self::getBaseUrl('assets/statics/js/' . ltrim($url, '\\/'), $baseUrl);
        }

        /**
         * Displays a summary of validation errors for one or several models.
         * @param mixed $model the models whose input errors are to be displayed. This can be either
         * a single model or an array of models.
         * @param string $header a piece of HTML code that appears in front of the errors
         * @param string $footer a piece of HTML code that appears at the end of the errors
         * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
         * This parameter has been available since version 1.0.7.
         * A special option named 'firstError' is recognized, which when set true, will
         * make the error summary to show only the first error message of each attribute.
         * If this is not set or is false, all error messages will be displayed.
         * This option has been available since version 1.1.3.
         * @return string the error summary. Empty if no errors are found.
         * @see CModel::getErrors
         * @see errorSummaryCss
         */
        public static function errorSummary($model, $header = null, $footer = null, $htmlOptions = array())
        {
            $content = '';
            if (!is_array($model))
                $model = array($model);
            if (isset($htmlOptions['firstError']))
            {
                $firstError = $htmlOptions['firstError'];
                unset($htmlOptions['firstError']);
            }
            else
                $firstError = false;
            foreach ($model as $m)
            {
                foreach ($m->getErrors() as $errors)
                {
                    foreach ($errors as $error)
                    {
                        if ($error != '')
                            $content.="<li>$error</li>\n";
                        if ($firstError)
                            break;
                    }
                }
            }
            if ($content !== '')
            {
                if ($header === null)
                    $header = '<h3>' . Yii::t('yii', 'Please fix the following input errors:') . '</h3>';
                if (!isset($htmlOptions['class']))
                    $htmlOptions['class'] = self::$errorSummaryCss;
                return self::tag('div', $htmlOptions, $header . "\n<ol>\n$content</ol>" . $footer);
            }
            else
                return '';
        }

        public function holder($model, $attribute, $htmlOptions = array(), $tag = 'div')
        {

            if ($model->hasErrors($attribute))
            {
                self::addErrorCss($htmlOptions);
            }

            return self::openTag('div', $htmlOptions);
        }

        public static function hint($model, $attribute, $htmlOptions = array())
        {
            $error = $model->getError($attribute);
            if ($error != '')
            {
                if (!isset($htmlOptions['class']))
                    $htmlOptions['class'] = self::$errorMessageCss;
                return self::tag('p', $htmlOptions, $error);
            }
            else
            {
                return self::tag('p', $htmlOptions, $model->getAttributeHint($attribute));
            }
        }

        /**
         * Generates a label tag for a model attribute.
         * The label text is the attribute label and the label is associated with
         * the input for the attribute (see {@link CModel::getAttributeLabel}.
         * If the attribute has input error, the label's CSS class will be appended with {@link errorCss}.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $htmlOptions additional HTML attributes. The following special options are recognized:
         * <ul>
         * <li>required: if this is set and is true, the label will be styled
         * with CSS class 'required' (customizable with CHtml::$requiredCss),
         * and be decorated with {@link CHtml::beforeRequiredLabel} and
         * {@link CHtml::afterRequiredLabel}. This option has been available since version 1.0.2.</li>
         * <li>label: this specifies the label to be displayed. If this is not set,
         * {@link CModel::getAttributeLabel} will be called to get the label for display.
         * If the label is specified as false, no label will be rendered.
         * This option has been available since version 1.0.4.</li>
         * </ul>
         * @return string the generated label tag
         */
        public static function activeLabel($model, $attribute, $htmlOptions = array())
        {
            if (isset($htmlOptions['for']))
            {
                $for = $htmlOptions['for'];
                unset($htmlOptions['for']);
            }
            else
                $for = self::getIdByName(self::resolveName($model, $attribute));
            if (isset($htmlOptions['label']))
            {
                if (($label = $htmlOptions['label']) === false)
                    return '';
                unset($htmlOptions['label']);
            }
            else
                $label = $model->getAttributeLabel($attribute);
            if ($model->hasErrors($attribute))
                self::addErrorCss($htmlOptions);
            return self::label($label, $for, $htmlOptions);
        }

        /**
         * Generates a label tag for a model attribute.
         * This is an enhanced version of {@link activeLabel}. It will render additional
         * CSS class and mark when the attribute is required.
         * In particular, it calls {@link CModel::isAttributeRequired} to determine
         * if the attribute is required.
         * If so, it will add a CSS class {@link CHtml::requiredCss} to the label,
         * and decorate the label with {@link CHtml::beforeRequiredLabel} and
         * {@link CHtml::afterRequiredLabel}.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $htmlOptions additional HTML attributes.
         * @return string the generated label tag
         * @since 1.0.2
         */
        public static function activeLabelEx($model, $attribute, $htmlOptions = array())
        {
            $realAttribute = $attribute;
            self::resolveName($model, $attribute); // strip off square brackets if any
            $htmlOptions['required'] = $model->isAttributeRequired($attribute);
            return self::activeLabel($model, $realAttribute, $htmlOptions);
        }

        public static function label($label, $for, $htmlOptions = array())
        {
            if ($for === false)
                unset($htmlOptions['for']);
            else
                $htmlOptions['for'] = $for;
            if (isset($htmlOptions['required']))
            {
                if ($htmlOptions['required'])
                {
                    if (isset($htmlOptions['class']))
                        $htmlOptions['class'].=' ' . self::$requiredCss;
                    else
                        $htmlOptions['class'] = self::$requiredCss;
                    $label = self::$beforeRequiredLabel . $label . self::$afterRequiredLabel;
                }
                unset($htmlOptions['required']);
            }

            if (isset($htmlOptions['element']))
            {
                if ($htmlOptions['element'] === 'open')
                    return self::openTag('label', $htmlOptions) . $label;
                if ($htmlOptions['element'] === 'close')
                    return $label . self::closeTag('label');
                if ($htmlOptions['element'] === 'openfor')
                    return self::openTag('label', $htmlOptions);
            }

            return self::tag('label', $htmlOptions, $label);
        }

        public static function dialog($text, $url = '#', $htmlOptions = array())
        {

            if (!isset($htmlOptions['width']))
                $htmlOptions['width'] = '800';

            if (!isset($htmlOptions['id']))
                $htmlOptions['id'] = self::ID_PREFIX . self::$count++;

            if (!isset($htmlOptions['title']))
                $htmlOptions['title'] = Ycms::t('ycms', '进行您的操作');

            if (!isset($htmlOptions['css']))
                $htmlOptions['css'] = 'Aristo';

            $htmlOptions['onclick'] = 'dialog()';

            $cs = Ycms::app()->getClientScript();

            $dialogFun = <<<EOT
    function  dialog(){
        var settings = { 
            id: '{$htmlOptions['id']}-dialog', 
            url: '$url',
            title: '{$htmlOptions['title']}',
            width:'{$htmlOptions['width']}'
        }
        
        $("body").append('<div id="' + settings.id + '" title="Dialog Title"><p class="loading"></p></div>');
        $("#" + settings.id).html('<iframe src="' + settings.url + '" frameborder="0" id="dialogFrame" scrolling="no"></iframe>');
        
        $('#dialogFrame').load(function() { 
  
            $(this).height($(this).contents().find("body").height()).width(settings.width); 
            $('#' + settings.id).css('overflow-x','hidden');
            $('#' + settings.id).dialog({ 
                title: settings.title, 
                width: settings.width,
                height:$(this).contents().find("body").height()+55,
                close: function () {
                    $("#" + settings.id).remove();
                }
            }); 
        })
    }
EOT;
            $cs->registerCssFile(YHtml::cssUrl('jui/' . $htmlOptions['css'] . '/jquery-ui.css'));

            $cs->registerCoreScript('jquery.ui');
            $cs->registerScript('dialog', $dialogFun, 2);

            unset($htmlOptions['title']);
            unset($htmlOptions['width']);
            unset($htmlOptions['css']);

            return self::link($text, '#', $htmlOptions);
        }

        /**
         * Generates a radio button list for a model attribute.
         * The model attribute value is used as the selection.
         * If the attribute has input error, the input field's CSS class will
         * be appended with {@link errorCss}.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $data value-label pairs used to generate the radio button list.
         * Note, the values will be automatically HTML-encoded, while the labels will not.
         * @param array $htmlOptions addtional HTML options. The options will be applied to
         * each radio button input. The following special options are recognized:
         * <ul>
         * <li>template: string, specifies how each radio button is rendered. Defaults
         * to "{input} {label}", where "{input}" will be replaced by the generated
         * radio button input tag while "{label}" will be replaced by the corresponding radio button label.</li>
         * <li>separator: string, specifies the string that separates the generated radio buttons.</li>
         * <li>encode: boolean, specifies whether to encode HTML-encode tag attributes and values. Defaults to true.
         * This option has been available since version 1.0.5.</li>
         * </ul>
         * Since version 1.1.7, a special option named 'uncheckValue' is available that can be used to specify the value
         * returned when the radio button is not checked. By default, this value is ''. Internally, a hidden field is
         * rendered so that when the radio button is not checked, we can still obtain the posted uncheck value.
         * If 'uncheckValue' is set as NULL, the hidden field will not be rendered.
         * @return string the generated radio button list
         * @see radioButtonList
         */
        public static function activeRadioButtonList($model, $attribute, $data, $htmlOptions = array())
        {
            self::resolveNameID($model, $attribute, $htmlOptions);
            $selection = self::resolveValue($model, $attribute);
            if ($model->hasErrors($attribute))
                self::addErrorCss($htmlOptions);
            $name = $htmlOptions['name'];
            unset($htmlOptions['name']);

            if (array_key_exists('uncheckValue', $htmlOptions))
            {
                $uncheck = $htmlOptions['uncheckValue'];
                unset($htmlOptions['uncheckValue']);
            }
            else
                $uncheck = '';

            $hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
            $hidden = $uncheck !== null ? self::hiddenField($name, $uncheck, $hiddenOptions) : '';

            return $hidden . self::radioButtonList($name, $selection, $data, $htmlOptions);
        }

        /**
         * Generates a radio button list.
         * A radio button list is like a {@link checkBoxList check box list}, except that
         * it only allows single selection.
         * @param string $name name of the radio button list. You can use this name to retrieve
         * the selected value(s) once the form is submitted.
         * @param mixed $select selection of the radio buttons. This can be either a string
         * for single selection or an array for multiple selections.
         * @param array $data value-label pairs used to generate the radio button list.
         * Note, the values will be automatically HTML-encoded, while the labels will not.
         * @param array $htmlOptions addtional HTML options. The options will be applied to
         * each radio button input. The following special options are recognized:
         * <ul>
         * <li>template: string, specifies how each radio button is rendered. Defaults
         * to "{input} {label}", where "{input}" will be replaced by the generated
         * radio button input tag while "{label}" will be replaced by the corresponding radio button label.</li>
         * <li>separator: string, specifies the string that separates the generated radio buttons.</li>
         * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
         * for every label tag in the list. This option has been available since version 1.0.10.</li>
         * </ul>
         * @return string the generated radio button list
         */
        public static function radioButtonList($name, $select, $data, $htmlOptions = array())
        {
            $template = isset($htmlOptions['template']) ? $htmlOptions['template'] : '{input} {label}';
            $separator = isset($htmlOptions['separator']) ? $htmlOptions['separator'] : "<br/>\n";
            unset($htmlOptions['template'], $htmlOptions['separator']);

            $labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
            unset($htmlOptions['labelOptions']);

            $items = array();
            $baseID = self::getIdByName($name);
            $id = 0;
            foreach ($data as $value => $label)
            {
                $checked = !strcmp($value, $select);
                $htmlOptions['value'] = $value;
                $htmlOptions['id'] = $baseID . '_' . $id++;
                $option = self::radioButton($name, $checked, $htmlOptions);

                if ($template !== '{input} {label}')
                {
                    $labelOptions['element'] = 'openfor';
                    $labelOpenFor = self::label($label, $htmlOptions['id'], $labelOptions);
                    $labelOptions['element'] = 'close';
                    $labelClose = self::label($label, $htmlOptions['id'], $labelOptions);
                    $items[] = strtr($template, array('{input}' => $option, '{labelopen}' => $labelOpenFor, '{labelclose}' => $labelClose));
                }
                else
                {
                    $label = self::label($label, $htmlOptions['id'], $labelOptions);
                    $items[] = strtr($template, array('{input}' => $option, '{label}' => $label));
                }
            }
            return implode($separator, $items);
        }

        /**
         * Generates a check box list for a model attribute.
         * The model attribute value is used as the selection.
         * If the attribute has input error, the input field's CSS class will
         * be appended with {@link errorCss}.
         * Note that a check box list allows multiple selection, like {@link listBox}.
         * As a result, the corresponding POST value is an array. In case no selection
         * is made, the corresponding POST value is an empty string.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $data value-label pairs used to generate the check box list.
         * Note, the values will be automatically HTML-encoded, while the labels will not.
         * @param array $htmlOptions addtional HTML options. The options will be applied to
         * each checkbox input. The following special options are recognized:
         * <ul>
         * <li>template: string, specifies how each checkbox is rendered. Defaults
         * to "{input} {label}", where "{input}" will be replaced by the generated
         * check box input tag while "{label}" will be replaced by the corresponding check box label.</li>
         * <li>separator: string, specifies the string that separates the generated check boxes.</li>
         * <li>checkAll: string, specifies the label for the "check all" checkbox.
         * If this option is specified, a 'check all' checkbox will be displayed. Clicking on
         * this checkbox will cause all checkboxes checked or unchecked. This option has been
         * available since version 1.0.4.</li>
         * <li>checkAllLast: boolean, specifies whether the 'check all' checkbox should be
         * displayed at the end of the checkbox list. If this option is not set (default)
         * or is false, the 'check all' checkbox will be displayed at the beginning of
         * the checkbox list. This option has been available since version 1.0.4.</li>
         * <li>encode: boolean, specifies whether to encode HTML-encode tag attributes and values. Defaults to true.
         * This option has been available since version 1.0.5.</li>
         * </ul>
         * Since 1.1.7, a special option named 'uncheckValue' is available. It can be used to set the value
         * that will be returned when the checkbox is not checked. By default, this value is ''.
         * Internally, a hidden field is rendered so when the checkbox is not checked, we can still
         * obtain the value. If 'uncheckValue' is set to NULL, there will be no hidden field rendered.
         * @return string the generated check box list
         * @see checkBoxList
         */
        public static function activeCheckBoxList($model, $attribute, $data, $htmlOptions = array())
        {
            self::resolveNameID($model, $attribute, $htmlOptions);
            $selection = self::resolveValue($model, $attribute);
            if ($model->hasErrors($attribute))
                self::addErrorCss($htmlOptions);
            $name = $htmlOptions['name'];
            unset($htmlOptions['name']);

            if (array_key_exists('uncheckValue', $htmlOptions))
            {
                $uncheck = $htmlOptions['uncheckValue'];
                unset($htmlOptions['uncheckValue']);
            }
            else
                $uncheck = '';

            $hiddenOptions = isset($htmlOptions['id']) ? array('id' => self::ID_PREFIX . $htmlOptions['id']) : array('id' => false);
            $hidden = $uncheck !== null ? self::hiddenField($name, $uncheck, $hiddenOptions) : '';

            return $hidden . self::checkBoxList($name, $selection, $data, $htmlOptions);
        }

        /**
         * Generates a check box list.
         * A check box list allows multiple selection, like {@link listBox}.
         * As a result, the corresponding POST value is an array.
         * @param string $name name of the check box list. You can use this name to retrieve
         * the selected value(s) once the form is submitted.
         * @param mixed $select selection of the check boxes. This can be either a string
         * for single selection or an array for multiple selections.
         * @param array $data value-label pairs used to generate the check box list.
         * Note, the values will be automatically HTML-encoded, while the labels will not.
         * @param array $htmlOptions addtional HTML options. The options will be applied to
         * each checkbox input. The following special options are recognized:
         * <ul>
         * <li>template: string, specifies how each checkbox is rendered. Defaults
         * to "{input} {label}", where "{input}" will be replaced by the generated
         * check box input tag while "{label}" be replaced by the corresponding check box label.</li>
         * <li>separator: string, specifies the string that separates the generated check boxes.</li>
         * <li>checkAll: string, specifies the label for the "check all" checkbox.
         * If this option is specified, a 'check all' checkbox will be displayed. Clicking on
         * this checkbox will cause all checkboxes checked or unchecked. This option has been
         * available since version 1.0.4.</li>
         * <li>checkAllLast: boolean, specifies whether the 'check all' checkbox should be
         * displayed at the end of the checkbox list. If this option is not set (default)
         * or is false, the 'check all' checkbox will be displayed at the beginning of
         * the checkbox list. This option has been available since version 1.0.4.</li>
         * <li>labelOptions: array, specifies the additional HTML attributes to be rendered
         * for every label tag in the list. This option has been available since version 1.0.10.</li>
         * </ul>
         * @return string the generated check box list
         */
        public static function checkBoxList($name, $select, $data, $htmlOptions = array())
        {
            $template = isset($htmlOptions['template']) ? $htmlOptions['template'] : '{input} {label}';
            $separator = isset($htmlOptions['separator']) ? $htmlOptions['separator'] : "<br/>\n";
            unset($htmlOptions['template'], $htmlOptions['separator']);

            if (substr($name, -2) !== '[]')
                $name.='[]';

            if (isset($htmlOptions['checkAll']))
            {
                $checkAllLabel = $htmlOptions['checkAll'];
                $checkAllLast = isset($htmlOptions['checkAllLast']) && $htmlOptions['checkAllLast'];
            }
            unset($htmlOptions['checkAll'], $htmlOptions['checkAllLast']);

            $labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
            unset($htmlOptions['labelOptions']);

            $items = array();
            $baseID = self::getIdByName($name);
            $id = 0;
            $checkAll = true;

            foreach ($data as $value => $label)
            {
                $checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
                $checkAll = $checkAll && $checked;
                $htmlOptions['value'] = $value;
                $htmlOptions['id'] = $baseID . '_' . $id++;
                $option = self::checkBox($name, $checked, $htmlOptions);

                if ($template !== '{input} {label}')
                {
                    $labelOptions['element'] = 'openfor';
                    $labelOpenFor = self::label($label, $htmlOptions['id'], $labelOptions);
                    $labelOptions['element'] = 'close';
                    $labelClose = self::label($label, $htmlOptions['id'], $labelOptions);
                    $items[] = strtr($template, array('{input}' => $option, '{labelopen}' => $labelOpenFor, '{labelclose}' => $labelClose));
                }
                else
                {
                    $label = self::label($label, $htmlOptions['id'], $labelOptions);
                    $items[] = strtr($template, array('{input}' => $option, '{label}' => $label));
                }
            }

            if (isset($checkAllLabel))
            {
                $htmlOptions['value'] = 1;
                $htmlOptions['id'] = $id = $baseID . '_all';
                $option = self::checkBox($id, $checkAll, $htmlOptions);
                $label = self::label($checkAllLabel, $id, $labelOptions);
                $item = strtr($template, array('{input}' => $option, '{label}' => $label));
                if ($checkAllLast)
                    $items[] = $item;
                else
                    array_unshift($items, $item);
                $name = strtr($name, array('[' => '\\[', ']' => '\\]'));
                $js = <<<EOD
jQuery('#$id').click(function() {
	jQuery("input[name='$name']").attr('checked', this.checked);
});
jQuery("input[name='$name']").click(function() {
	jQuery('#$id').attr('checked', !jQuery("input[name='$name']:not(:checked)").length);
});
jQuery('#$id').attr('checked', !jQuery("input[name='$name']:not(:checked)").length);
EOD;
                $cs = Yii::app()->getClientScript();
                $cs->registerCoreScript('jquery');
                $cs->registerScript($id, $js);
            }

            return implode($separator, $items);
        }

    }