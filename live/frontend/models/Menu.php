<?php

    /**
     * menu model class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    Ycms::import('backendApp.models.Tree');

    /**
     * 数据库表"menu"的model类.
     *
     * The followings are the available columns in table 'menu':
     * @property string $menu_id
     * @property string $parent_id
     * @property integer $lft
     * @property integer $rgt
     * @property string $level
     * @property string $name
     * @property string $route
     * @property string $param
     * @property string $description
     * @property string $target
     * @property string $style
     * @property string $alias
     * @property integer $hidden
     * @property integer $external
     * @property integer $customized
     * @property integer $position
     * @property string $type
     *
     * @version $Id: menu.php UTF-8 2011-05-28 15:51:01 li feixiang
     * @package backend-model
     * @since 1.0
     */
    class Menu extends Tree
    {

        //特性
        public $pk = 'menu_id';
        public $type = 'link';

        /**
         * @return string the associated database table name
         */
        public static function tableName()
        {
            return '{{menu}}';
        }

        public function getLiveRolling()
        {
            $result = $this->getTree(array('alias' => 'Rolling'));
            return $result;
        }

        /**
         * 生成链接
         * @param string $route 路由
         * @param mixed $param 序列化的路由参数或者为空
         * @return string 
         */
        public static function getLink($route, $params, $external)
        {
            if ($external == TRUE)
            {
                $link = $route;
            }
            else
            {
                if (empty($params))
                {
                    $link = Ycms::app()->createUrl(trim($route, '/'));
                }
                else
                {
                    $link = Ycms::app()->createUrl(trim($route, '/'), unserialize($params));
                }
            }

            return $link;
        }

        public static function getStyle($style)
        {
            if (!empty($style))
            {
                $temp = unserialize($style);
                $style = '';

                foreach ($temp as $key => $value)
                {
                    if ($key == 'class')
                    {
                        $style = 'class="' . $value;
                        break;
                    }

                    $style .= 'style="' . $key . ':' . $value . '; ';
                }
                $style .= '"';

                return $style;
            }
            else
            {
                return '';
            }
        }

    }