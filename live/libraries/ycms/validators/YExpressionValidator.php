<?php

    /**
     * YExpressionValidator class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://code.google.com/p/ycejcms/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 表达式验证
     * 
     * @version $Id: YExpressionValidator.php UTF-8 2011-7-20 11:11:50 li feixiang 
     * @package framework
     * @since 1.0
     * 
     */
    class YExpressionValidator extends CValidator
    {

        public $expression;
        /**
         * @var boolean whether the attribute value can be null or empty. Defaults to true,
         * meaning that if the attribute is empty, it is considered valid.
         */
        public $params;

        /**
         * Validates the attribute of the object.
         * If there is any error, the error message is added to the object.
         * @param CModel $object the object being validated
         * @param string $attribute the attribute being validated
         */
        protected function validateAttribute($object, $attribute)
        {
            $value = $object->$attribute;

            if ($this->expression !== null)
                $object->$attribute = $this->evaluateExpression($this->expression, array('attribute' => $value, 'params' => $this->params));
        }

    }