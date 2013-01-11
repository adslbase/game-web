<?php

/**
 * YActiveRecord class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined('INYCMS') or die;

/**
 * ar类
 * 
 * @version $Id: YActiveRecord.php UTF-8 2011-5-2 18:40:12 li feixiang 
 * @package db
 * @since 1.0
 * 
 */
class YActiveRecord extends CActiveRecord {
    
    private static $_models = array('isArModels' => 1);

    /**
     * Initializes this model.
     * This method is invoked when an AR instance is newly created and has
     * its {@link scenario} set.
     * You may override this method to provide code that is needed to initialize the model (e.g. setting
     * initial property values.)
     * @since 1.0.8
     */
    public function init() {
        
    }

    public static function &getModels() {
        return self::$_models;
    }

    public function getAttributeHint($attribute) {
        $hints = $this->attributeHints();
        if (isset($hints[$attribute]))
            return $hints[$attribute];
        else
            return $this->generateAttributeHint($attribute);
    }

    public function generateAttributeHint($name) {
        return ucwords(trim(strtolower(str_replace(array('-', '_', '.'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $name)))));
    }

}