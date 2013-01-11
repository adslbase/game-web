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

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
            return array(
                    array('alias', 'required'), //待添加别名唯一。。link验证
                    array('name', 'required', 'on' => 'createMenu, link'),
                    array('route,style', 'safe'),
                    array('hidden, external, position', 'numerical'),
                    array('alias,description, name,route,param,parent_id', 'length', 'max' => 255),
                    array('target', 'length', 'max' => 25),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
            return array(
                    'parent_id' => Ycms::t('menu', '上级菜单'),
                    'name' => Ycms::t('menu', '菜单标题'),
                    'description' => Ycms::t('menu', '菜单说明'),
                    'target' => Ycms::t('menu', '超链接目标'),
                    'alias' => Ycms::t('menu', '菜单别名'),
                    'hidden' => Ycms::t('menu', '隐藏'),
                    'external' => Ycms::t('menu', '外部链接'),
                    'order' => Ycms::t('menu', '排序'),
                    'style' => Ycms::t('menu', '样式'),
                    'route' => Ycms::t('menu', '路由/链接'),
                    'param' => Ycms::t('menu', '路由参数'),
            );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeHints()
        {
            return array(
                    'pid' => Ycms::t('menu', '这个菜单的爸爸'),
                    'name' => Ycms::t('menu', '该文本将用于此菜单中的链接文字。'),
                    'description' => Ycms::t('menu', '菜单说明'),
                    'target' => Ycms::t('menu', '为您的链接选择目标框架。'),
                    'alias' => Ycms::t('menu', '菜单别名,用于程序内容选择菜单'),
                    'hidden' => Ycms::t('menu', '未启用的菜单链接将不会在任何菜单列出。'),
                    'external' => Ycms::t('menu', '该菜单连接是否是外部连接。'),
                    'order' => Ycms::t('menu', '排序'),
                    'style' => Ycms::t('menu', '链接的样式，点击自定义后可以直接填写链接的样式名'),
                    'route' => Ycms::t('menu', '链接的路由，如果为空，将不会生成a连接，但会显现菜单别名'),
                    'param' => Ycms::t('menu', '该链接的参数'),
            );
        }

        /**
         * 创建根节点，即是创建菜单
         * @param array $attributes 菜单特性
         * @return Boolean
         */
        public function createRootNode($attributes)
        {

            $sql = 'SELECT rgt FROM ' . $this->tableName() . ' ORDER BY rgt DESC LIMIT 1';

            $result = $this->daoQueryRow($sql);

            if ($result === FALSE)
            {
                $lft = 0;
                $rgt = 1;
            }
            else
            {
                $lft = $result['rgt'] + 1;
                $rgt = $lft + 1;
            }

            $sql = 'INSERT INTO ' . $this->tableName() . ' (name,' . $this->index . ',description, parent_id, lft, rgt, level, position,type) VALUES ( :name, :alias, :description, 0 , :lft,:rgt, 0,0,:type)';

            $paArray = array(
                    'name' => $attributes['name'],
                    'alias' => $attributes['alias'],
                    'description' => $attributes['description'],
                    'lft' => array($lft, PDO::PARAM_INT),
                    'rgt' => array($rgt, PDO::PARAM_INT),
                    'type' => 'menu'
            );
            return $this->daoExecute($sql, $paArray, 'bindValue');
        }

        /**
         * 获得节点特性
         * @param int $mid  链接id
         * @param mixed $fields 要获取的字段
         * @return array  
         */
        public function loadAttributes($mid, $fields = '*')
        {
            return $this->getNode($mid, $fields);
        }

        public function updateAttributes($mid, $fields = '*')
        {

            $basefields = array(
                    'menu_id' => '',
                    'lft' => '',
                    'rgt' => '',
                    'level' => '',
                    'parent_id' => '', //暂时不能更改父
            );

            $fields = array_diff_key($fields, $basefields);

            $columns = array_keys($fields);

            $oldNode = $this->getNode($mid, $columns);

            if ($oldNode == $fields)
            {
                return TRUE;
            }

            $columns = self::joinAttributesUpdate($fields);

            $sql = 'UPDATE ' . $this->tableName() . ' SET ' . $columns . ' WHERE `menu_id` = :menu_id ';

            $fields['menu_id'] = array($mid, PDO::PARAM_INT);

            return $this->daoExecute($sql, $fields, 'bindValue') === 1;
        }

        public function getCompleteTree($mid)
        {

            $menus = array();

            $topMenu = $this->getParent(array('menu_id' => $mid, 'level' => 0, 'content' => 'all'), array('menu_id'));

            $tree = $this->getTree(array('menu_id' => $topMenu['menu_id'], 'content' => 'all'), array('menu_id', 'name', 'level'));

            foreach ($tree as $leaf)
            {
                if ($leaf['level'] == 0)
                    $menus[$leaf['menu_id']] = '<' . $leaf['name'] . '>';
                else
                    $menus[$leaf['menu_id']] = str_repeat('—', $leaf['level']) . $leaf['name'];
            }

            return $menus;
        }

        public function beforeloadParent(&$conditions, &$condition, &$paArray)
        {

            $baseConditions = array(
                    'link' => '',
                    'route' => '',
                    'hidden' => 'all',
            );

            $conditions = array_merge($baseConditions, $conditions);

            if ($conditions['link'] !== '')
            {
                $condition .= 'node.link = :link ';
                $paArray[':link'] = array($conditions['link'], PDO::PARAM_STR);
            }

            if ($conditions['route'] !== '')
            {
                $condition .= 'node.link LIKE :link ';
                $paArray[':link'] = array('%' . $conditions['route'] . '%', PDO::PARAM_STR);
            }

            if ($conditions['hidden'] === TRUE)
                $condition .= 'AND parent.hidden = 1 ';
            else if ($conditions['hidden'] === FALSE)
                $condition .= 'AND parent.hidden = 0 ';

            if ($condition !== '')
                $condition .= ' AND ';

            return true;
        }

        public function getSizeNode($conditions = array())
        {
            $sizeNode = array();

            $result = parent::getSizeNode($conditions, 'menu_id');

            foreach ($result as $value)
            {
                $sizeNode[] = '"node_' . $value['menu_id'] . '"';
            }

            return $sizeNode;
        }

        /**
         * 将从表单中获得的字符窜参数转换为数组，再序列化后保存到数据库   用parse_str()解决缺点输入麻烦 
         * @param string $param
         * @return mixed 
         */
        public function getParams($param)
        {
            if (empty($param))
                return '';

            $result = explode('&', $param);

            foreach ($result as $value)
            {
                $data = explode('=', $value);
                $params[$data[0]] = $data[1];
            }

            return serialize($params);
        }

        public function setStyle($style)
        {

            if ($style['color'] == '')
            {
                unset($style['color']);
            }

            if ($style['class'] == '')
            {
                unset($style['class']);
            }

            if (empty($style))
            {
                return '';
            }
            else
            {
                return serialize($style);
            }
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

    }