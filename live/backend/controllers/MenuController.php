<?php

    /**
     * MenuController class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * MenuController控制器类
     * 
     * @version $Id: MenuController.php UTF-8 2011-07-28 11:27:18 li feixiang
     * @package backend-controller
     * @since 1.0
     * 
     */
    class MenuController extends BackController
    {

        /**
         * 菜单列表
         */
        public function actionIndex()
        {
            $model = $this->loadDaoModel('Menu', 'create', false);
            $tree = $model->getRootTree(array('menu_id', 'name', 'description'));
            $dataProvider = new CArrayDataProvider($tree, array('pagination' => false, 'keyField' => 'menu_id'));

            $this->render('index', array('dataProvider' => $dataProvider));
        }

        /**
         * 创建菜单
         */
        public function actionCreate()
        {

            $model = $this->loadDaoModel('Menu', 'createMenu');
            if (($model->attributes = $this->getPost('Menu')) !== null)
            {

                if ($model->validate() !== FALSE && $model->createRootNode($model->attributes))
                {
                    YMessage::setFlash(Ycms::t('menu', '添加菜单成功'));
                    $this->redirect(array('menu/index'));
                }
            }

            $this->render('view', array('model' => $model));
        }

        /**
         * 修改一个菜单
         * @param int $mid  菜单id 
         */
        public function actionUpdate($mid)
        {

            $model = $this->loadDaoModel('Menu');

            $oldMenu = $model->loadAttributes($mid, array('menu_id', 'alias', 'name', 'description'));

            if (($model->attributes = $this->getPost('Menu')) !== null)
            {
                if ($model->validate() && $model->updateAttributes($oldMenu['menu_id'], array('alias' => $model->alias, 'description' => $model->description)))
                {
                    YMessage::setFlash(Ycms::t('menu', '更新菜单成功'));
                    $this->redirect(array('menu/index', '#' => 'organization'));
                }
            }

            $model->attributes = $oldMenu;

            $this->render('view', array('model' => $model));
        }

        /**
         * 删除一个菜单
         * @param type $mid  菜单ID
         */
        public function actionDelete($mid)
        {
            $model = $this->loadDaoModel('Menu');

            $result = $model->deleteNode($mid);

            YMessage::setFlash(Ycms::t('menu', '删除菜单成功'));
            $this->redirect(array('menu/index'));
        }

        /**
         * 后台左侧菜单--ajax请求
         * @param string $alias 一级链接的别名 
         * @param string $currentUrl 当前页面url 
         */
        public function actionLeftMenu($alias)
        {
            $model = $this->loadDaoModel('Menu');
            $tree = $model->getTree(array('alias' => $alias), array('alias', 'route', 'param', 'name', 'level', 'external'));
            echo $this->renderPartial('leftmenu', array('tree' => $tree));
        }

        /**
         * 将二维数组的菜单转换成层级树-用于多级菜单
         * @param array $links
         * @param type $currentUrl
         * @return type 
         */
        public function getMenuTree(array $links, $currentUrl='')
        {
            $links = array_reverse($links);
            return $this->_getMenuTree($links, $currentUrl);
        }

        /**
         *
         * @param type $links
         * @param type $currentUrl
         * @return type 
         */
        public function _getMenuTree(&$links, $currentUrl)
        {
            $tree = array();

            while ($item = array_pop($links))
            {
                $item['link'] = Menu::getLink($item['route'], $item['param'], $item['external']);

                if ($item['link'] === $currentUrl)
                    $item['in_active_trail'] = TRUE;

                $tree[$item['alias']] = array(
                        'link' => $item,
                        'below' => array(),
                );

                $next = end($links);

                if ($next && $next['level'] > $item['level'])
                {
                    $tree[$item['alias']]['below'] = $this->_getMenuTree($links, $currentUrl);
                    $next = end($links);
                }

                if (!$next || $next['level'] < $item['level'])
                {
                    break;
                }
            }
            return $tree;
        }

    }