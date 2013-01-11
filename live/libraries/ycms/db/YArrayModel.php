<?php

/**
 * YArrayModel class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined ( 'INYCMS' ) or die;

/**
 * 采用工厂模式。。。如果是sae则去实例化sae
 * 
 * @version $Id: YArrayModel.php UTF-8 2011-5-2 18:41:07 li feixiang 
 * @package db
 * @since 1.0
 * 
 */
abstract class YArrayModel extends YModel
{

        private $_md;
        public $fileName;

        public function __construct ( $scenario='update' )
        {
                $this -> setScenario ( $scenario );

                $this -> init ();

                $this -> setDefaultAttributes ();

                $this -> attachBehaviors ( $this -> behaviors () );
                $this -> afterConstruct ();
        }

        abstract public function filePath ();

        abstract public function defaultAttributes ();

        public function getMetaData ()
        {
                if ( $this -> _md !== null )
                        return $this -> _md;
                else
                        return $this -> _md = new YArrayMetaData ( $this );
        }

        public function save ( $runValidation=true,$attributes=null )
        {
                if ( ! $runValidation || $this -> validate ( $attributes ) )
                {
                        if ( $this -> saveToFile ( $this -> getAttributes ( $attributes ) ) )
                        {
                                return TRUE;
                        }
                }
                else
                        return false;
        }

        public function saveToFile ( $data )
        {
                $data = $this -> saveAsString ( $data );

                return file_put_contents ( $this -> filePath (),"<?php \nreturn " . $data . ";\n?>" );
        }

        public function saveAsString ( $data )
        {
                return str_replace ( "\r",'',var_export ( $data,true ) );
        }

}

abstract class YExArrayModel extends YArrayModel
{

        public $fileList = array ( );

        public function __construct ( $fileName,$scenario='update' )
        {
                $this -> fileName = basename ( $fileName,".php" ) . '.php';
                parent::__construct ( $scenario );
        }

}

class YArrayMetaData
{

        /**
         * @var array table columns
         */
        public $columns;
        /**
         * @var array attribute default values
         */
        public $attributeDefaults = array ( );
        private $_model;

        /**
         * Constructor.
         * @param CActiveRecord $model the model instance
         */
        public function __construct ( $model )
        {
                $this -> _model = $model;

                $this -> columns = $this -> _model -> defaultAttributes ();

                $data = require ($this -> _model -> filePath ());

                foreach ( $this -> columns as $name => $column )
                {
                        if ( isset ( $data[ $name ] ) )
                                $this -> attributeDefaults[ $name ] = $data[ $name ];
                }
        }

}
