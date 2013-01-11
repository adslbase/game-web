<?php

/**
 * YActiveForm class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined ( 'INYCMS' ) or die;

/**
 * 这个类实干什么用的
 * 
 * @version $Id: YActiveForm.php UTF-8 2011-5-2 19:07:04 li feixiang 
 * @package widget
 * @since 1.0
 * 
 */
class YActiveForm extends CActiveForm
{

        public $uniform = false;
        public $style = 'ycms';

        public function init ()
        {
                if ( ! isset ( $this -> htmlOptions[ 'css' ] ) )
                        $this -> htmlOptions[ 'class' ] = 'uniForm';
                else
                        $this -> htmlOptions[ 'class' ] = $this -> htmlOptions[ 'class' ] . ' uniForm';
                parent::init ();
        }

        /**
         * Runs the widget.
         * This registers the necessary javascript code and renders the form close tag.
         */
        public function run ()
        {
                parent::run ();
                $cs = Yii::app () -> getClientScript ();

                $cs -> registerCssFile ( YHtml::cssUrl ( 'uniform/uni-form.css' ) );
                $cs -> registerCssFile ( YHtml::cssUrl ( 'uniform/' . $this -> style . '.uni-form.css' ) );

                if ( $this -> uniform )
                {
                        $cs -> registerScriptFile ( YHtml::jsUrl ( 'jq.uniform.js' ) );
                        $id = $this -> id;
                        $cs -> registerScript ( __CLASS__ . '#' . $id,"\$('#$id').uniform();" );
                }
        }

        /**
         * Displays a summary of validation errors for one or several models.
         * This method is very similar to {@link CHtml::errorSummary} except that it also works
         * when AJAX validation is performed.
         * @param mixed $models the models whose input errors are to be displayed. This can be either
         * a single model or an array of models.
         * @param string $header a piece of HTML code that appears in front of the errors
         * @param string $footer a piece of HTML code that appears at the end of the errors
         * @param array $htmlOptions additional HTML attributes to be rendered in the container div tag.
         * @return string the error summary. Empty if no errors are found.
         * @see CHtml::errorSummary
         */
        public function errorSummary ( $models,$header=null,$footer=null,$htmlOptions=array ( ) )
        {

                if ( ! isset ( $htmlOptions[ 'id' ] ) )
                        $htmlOptions[ 'id' ] = 'errorMsg';

                if ( ! $this -> enableAjaxValidation && ! $this -> enableClientValidation )
                        return YHtml::errorSummary ( $models,$header,$footer,$htmlOptions );

                $html = YHtml::errorSummary ( $models,$header,$footer,$htmlOptions );
                if ( $html === '' )
                {
                        if ( $header === null )
                                $header = '<p>' . Yii::t ( 'yii','Please fix the following input errors:' ) . '</p>';
                        if ( ! isset ( $htmlOptions[ 'class' ] ) )
                                $htmlOptions[ 'class' ] = CHtml::$errorSummaryCss;
                        $htmlOptions[ 'style' ] = isset ( $htmlOptions[ 'style' ] ) ? rtrim ( $htmlOptions[ 'style' ],';' ) . ';display:none' : 'display:none';
                        $html = CHtml::tag ( 'div',$htmlOptions,$header . "\n<ul><li>dummy</li></ul>" . $footer );
                }

                $this -> summaryID = $htmlOptions[ 'id' ];
                return $html;
        }

        public function hint ( $model,$attribute,$htmlOptions=array ( ),$enableAjaxValidation=true,$enableClientValidation=true )
        {
                if ( ! isset ( $htmlOptions[ 'class' ] ) )
                        $htmlOptions[ 'class' ] = 'formHint';

                if ( ! $this -> enableAjaxValidation )
                        $enableAjaxValidation = false;
                if ( ! $this -> enableClientValidation )
                        $enableClientValidation = false;

                if ( ! $enableAjaxValidation && ! $enableClientValidation )
                        return YHtml::hint ( $model,$attribute,$htmlOptions );

                $id = CHtml::activeId ( $model,$attribute );
                $inputID = isset ( $htmlOptions[ 'inputID' ] ) ? $htmlOptions[ 'inputID' ] : $id;
                unset ( $htmlOptions[ 'inputID' ] );
                if ( ! isset ( $htmlOptions[ 'id' ] ) )
                        $htmlOptions[ 'id' ] = $inputID . '_em_';

                $option = array (
                    'id' => $id,
                    'inputID' => $inputID,
                    'errorID' => $htmlOptions[ 'id' ],
                    'model' => get_class ( $model ),
                    'name' => $attribute,
                    'enableAjaxValidation' => $enableAjaxValidation,
                );

                $optionNames = array (
                    'validationDelay',
                    'validateOnChange',
                    'validateOnType',
                    'hideErrorMessage',
                    'inputContainer',
                    'errorCssClass',
                    'successCssClass',
                    'validatingCssClass',
                    'beforeValidateAttribute',
                    'afterValidateAttribute',
                );
                foreach ( $optionNames as $name )
                {
                        if ( isset ( $htmlOptions[ $name ] ) )
                        {
                                $option[ $name ] = $htmlOptions[ $name ];
                                unset ( $htmlOptions[ $name ] );
                        }
                }
                if ( $model instanceof CActiveRecord && ! $model -> isNewRecord )
                        $option[ 'status' ] = 1;

                if ( $enableClientValidation )
                {
                        $validators = isset ( $htmlOptions[ 'clientValidation' ] ) ? array ( $htmlOptions[ 'clientValidation' ] ) : array ( );
                        foreach ( $model -> getValidators ( $attribute ) as $validator )
                        {
                                if ( $enableClientValidation && $validator -> enableClientValidation )
                                {
                                        if ( ($js = $validator -> clientValidateAttribute ( $model,$attribute )) != '' )
                                                $validators[ ] = $js;
                                }
                        }
                        if ( $validators !== array ( ) )
                                $option[ 'clientValidation' ] = "js:function(value, messages, attribute) {\n" . implode ( "\n",$validators ) . "\n}";
                }

                if ( ! isset ( $htmlOptions[ 'class' ] ) )
                        $htmlOptions[ 'class' ] = $this -> errorMessageCssClass;
                $html = YHtml::hint ( $model,$attribute,$htmlOptions );
                if ( $html === '' )
                {
                        if ( isset ( $htmlOptions[ 'style' ] ) )
                                $htmlOptions[ 'style' ] = rtrim ( $htmlOptions[ 'style' ],';' ) . ';display:none';
                        else
                                $htmlOptions[ 'style' ] = 'display:none';
                        $html = YHtml::tag ( 'p',$htmlOptions,'' );
                }

                $this -> attributes[ $inputID ] = $option;
                return $html;
        }

        public function beginHolder ( $model,$attribute,$htmlOptions=array ( ),$tag='div' )
        {
                if ( ! isset ( $htmlOptions[ 'class' ] ) )
                        $htmlOptions[ 'class' ] = 'ctrlHolder';

                return YHtml::holder ( $model,$attribute,$htmlOptions,$tag );
        }

        public function endHolder ( $tag='div' )
        {
                return YHtml::closeTag ( $tag );
        }

        /**
         * Renders an HTML label for a model attribute.
         * This method is a wrapper of {@link CHtml::activeLabel}.
         * Please check {@link CHtml::activeLabel} for detailed information
         * about the parameters for this method.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $htmlOptions additional HTML attributes.
         * @return string the generated label tag
         */
        public function label ( $model,$attribute,$htmlOptions=array ( ) )
        {
                return YHtml::activeLabel ( $model,$attribute,$htmlOptions );
        }

        /**
         * Renders an HTML label for a model attribute.
         * This method is a wrapper of {@link CHtml::activeLabelEx}.
         * Please check {@link CHtml::activeLabelEx} for detailed information
         * about the parameters for this method.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $htmlOptions additional HTML attributes.
         * @return string the generated label tag
         */
        public function labelEx ( $model,$attribute,$htmlOptions=array ( ) )
        {
                return YHtml::activeLabelEx ( $model,$attribute,$htmlOptions );
        }

        /**
         * Renders a radio button list for a model attribute.
         * This method is a wrapper of {@link CHtml::activeRadioButtonList}.
         * Please check {@link CHtml::activeRadioButtonList} for detailed information
         * about the parameters for this method.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $data value-label pairs used to generate the radio button list.
         * @param array $htmlOptions addtional HTML options.
         * @return string the generated radio button list
         */
        public function radioButtonList ( $model,$attribute,$data,$htmlOptions=array ( ) )
        {
                return YHtml::activeRadioButtonList ( $model,$attribute,$data,$htmlOptions );
        }

        /**
         * Renders a checkbox list for a model attribute.
         * This method is a wrapper of {@link CHtml::activeCheckBoxList}.
         * Please check {@link CHtml::activeCheckBoxList} for detailed information
         * about the parameters for this method.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $data value-label pairs used to generate the check box list.
         * @param array $htmlOptions addtional HTML options.
         * @return string the generated check box list
         */
        public function checkBoxList ( $model,$attribute,$data,$htmlOptions=array ( ) )
        {
                return YHtml::activeCheckBoxList ( $model,$attribute,$data,$htmlOptions );
        }

        /**
         * Renders a text field for a model attribute.
         * This method is a wrapper of {@link CHtml::activeTextField}.
         * Please check {@link CHtml::activeTextField} for detailed information
         * about the parameters for this method.
         * @param CModel $model the data model
         * @param string $attribute the attribute
         * @param array $htmlOptions additional HTML attributes.
         * @return string the generated input field
         */
        public function textField ( $model,$attribute,$htmlOptions=array ( ) )
        {
                if ( ! isset ( $htmlOptions[ 'class' ] ) )
                        $htmlOptions[ 'class' ] = 'textInput';

                if ( isset ( $htmlOptions[ 'attachClass' ] ) )
                        $htmlOptions[ 'class' ] .= ' ' . $htmlOptions[ 'attachClass' ];

                return parent::textField ( $model,$attribute,$htmlOptions );
        }

        public function passwordField ( $model,$attribute,$htmlOptions=array ( ) )
        {
                if ( ! isset ( $htmlOptions[ 'class' ] ) )
                        $htmlOptions[ 'class' ] = 'textInput';

                if ( isset ( $htmlOptions[ 'attachClass' ] ) )
                        $htmlOptions[ 'class' ] .= ' ' . $htmlOptions[ 'attachClass' ];

                return parent::passwordField ( $model,$attribute,$htmlOptions );
        }

        public function pLabel ( $model,$attribute,$htmlOptions=array ( ) )
        {
                if ( ! isset ( $htmlOptions[ 'class' ] ) )
                        $htmlOptions[ 'class' ] = 'label';

                if ( isset ( $htmlOptions[ 'label' ] ) )
                {
                        if ( ($label = $htmlOptions[ 'label' ]) === false )
                                return '';
                        unset ( $htmlOptions[ 'label' ] );
                }
                else
                        $label=$model -> getAttributeLabel ( $attribute );
                if ( $model -> hasErrors ( $attribute ) )
                        Yhtml::addErrorCss ( $htmlOptions );
                return YHtml::tag ( 'p',$htmlOptions,$label );
        }

}