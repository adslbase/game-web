<?php

    /**
     * LinkController class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 链接控制器
     * 
     * @version $Id: LinkController.php UTF-8 2011-5-14 18:31:59 li feixiang
     * @package ycms
     * @since 1.0
     * 
     */
    class LinkController extends BackController
    {

        public $layout = '//layouts/rightmain_nobreadcrumb';

        /**
         * 菜单控制页面。包括树。和右侧的框架（菜单列表和更新表单）
         * @param int $mid 菜单id
         */
        public function actionIndex($mid)
        {

            $this->layout = '//layouts/rightcolumn2';

            $model = $this->loadDaoModel('Menu');

            if ($mid !== '')
            {
                $tree = $model->getTree(array('menu_id' => $mid, 'content' => 'all'), 'menu_id,type,name,rgt,lft,level,parent_id,position');
            }

            $sizeNode = $model->getSizeNode();

            $this->render('tree', array('sizeNode' => $sizeNode, 'tree' => $tree));
        }

        /**
         * 根据菜单id获取子菜单列表
         * @param int $mid
         * @param boolean $reload 是否刷新父框架 
         */
        public function actionList($mid, $reload=FALSE)
        {
            if ($reload == true)
            {
                $cs = Ycms::app()->getClientScript();
                $cs->registerScript('reload', '
                        $("#rightMain", window.top.document).attr("src","' . $this->createUrl('link/index', array('mid' => $mid)) . '")
                ');
            }

            $model = $this->loadDaoModel('Menu');

            $tree = $model->getTree(array('menu_id' => $mid), array('menu_id', 'name', 'description', 'level', 'position'));

            $dataProvider = new CArrayDataProvider($tree, array('pagination' => false, 'keyField' => 'menu_id'));

            $this->render('index', array('dataProvider' => $dataProvider));
        }

        /**
         * 使用ajax移动节点
         */
        public function actionJsTreeMove()
        {
            $model = $this->loadDaoModel('Menu');
            $id = $model->moveNode($_POST['id'], $_POST['ref'], $_POST['position']);

            if (!$id)
                echo "{ \"status\" : 0 }";


            echo CJSON::encode(array('status' => 1, 'id' => $id));
        }

        /**
         * 创建一个链接
         * @param int $mid  父链接id
         */
        public function actionCreate($mid)
        {
            $model = $this->loadDaoModel('Menu', 'link');

            if (($model->attributes = $this->getPost('Menu')) !== null)
            {
                $model->param = $model->getParams($model->param);

                $model->style = $model->setStyle($model->style);

                if ($model->validate() !== false && $model->insertChildNode($model->attributes))
                {
                    YMessage::setFlash(Ycms::t('menu', '添加菜单成功'));
                    $topMenu = $model->getParent(array('menu_id' => $model->parent_id, 'level' => 0, 'content' => 'all'), array('menu_id'));
                    $this->redirect(array('link/list', 'mid' => $topMenu['menu_id'], 'reload' => true));
                }
            }

            $model->parent_id = $mid;
            $menus = $model->getCompleteTree($mid);
            $this->render('view', array('menus' => $menus, 'model' => $model));
        }

        /**
         * 更新一个链接
         * @param int $mid 更新链接的id
         * 
         * 暂时不能更新父id，用jstree解决
         */
        public function actionUpdate($mid)
        {
            $model = $this->loadDaoModel('Menu', 'link');

            $oldAttributes = $model->loadAttributes($mid);

            if (($model->attributes = $this->getPost('Menu')) !== null)
            {
                $model->param = $model->getParams($model->param);

                $name = $model->name;

                $model->style = $model->setStyle($model->style);

                if ($model->validate() && $model->updateAttributes($mid, $model->attributes))
                {
                    YMessage::setFlash(Ycms::t('menu', '更新菜单成功'));
                    $topMenu = $model->getParent(array('menu_id' => $mid, 'level' => 0, 'content' => 'all'), array('menu_id'));

                    if ($oldAttributes['name'] == $name)
                    {
                        $url = array('link/list', 'mid' => $topMenu['menu_id']);
                    }
                    else
                    {
                        $url = array('link/list', 'mid' => $topMenu['menu_id'], 'reload' => true);
                    }

                    $this->redirect($url);
                }
            }

            $model->attributes = $oldAttributes;

            if ($model->param != '')
            {
                $model->param = http_build_query(unserialize($model->param));
            }

            if ($model->style != '')
            {
                $model->style = unserialize($model->style);
            }

            $menus = $model->getCompleteTree($mid);
            $this->render('view', array('menus' => $menus, 'model' => $model,'mid'=>$mid));
        }

        /**
         * 删除一个链接
         * @param int $mid 删除链接id 
         */
        public function actionDelete($mid)
        {
            $model = $this->loadDaoModel('Menu');
            $topMenu = $model->getParent(array('menu_id' => $mid, 'level' => 0, 'content' => 'all'), array('menu_id'));

            if ($model->deleteNode($mid) === TRUE)
            {
                YMessage::setFlash(Ycms::t('menu', '删除菜单成功'));
                $this->redirect(array('link/list', 'mid' => $topMenu['menu_id'], 'reload' => true));
            }
        }

    }