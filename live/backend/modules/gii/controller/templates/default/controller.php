<?php echo "<?php\n"; ?>
/**
 * <?php echo $this->controllerClass; ?> class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
 
defined ( 'INYCMS' ) or die;

/**
 * <?php echo $this->controllerClass; ?>控制器类
 * 
 * @version $Id: <?php echo $this->controllerClass; ?>.php UTF-8 <?php echo date('Y-m-d H:i:s') ?> li feixiang
 * @package backend-controller
 * @since 1.0
 * 
 */
class <?php echo $this->controllerClass; ?> extends <?php echo $this->baseClass."\n"; ?>
{

        /**
         * 控制器过滤器
         * 
         * @see         CController
         * return       array
         * @since       1.0
         */
        public function filters ()
        {
                return array (
                    'accessControl',
                );
        }

        /**
         * 访问规则
         *
         * @see         CController
         * return       array
         * @since       1.0
         */
        public function accessRules ()
        {
                return array (
                    array ( 'allow',
                        'actions' => array (),
                    ),
                    array ( 'deny',
                        'actions' => array (),
                    ),
                );
        }
        
        /**
         * 默认动作
         *
         * @since       1.0
         */
        public function actionIndex ()
        {
                $this -> render ( 'index',array () );
        }
}