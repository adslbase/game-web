<?php

        /**
         * Backend Object Controller.
         * 
         * @author Tuan Nguyen <nganhtuan63@gmail.com>
         * @version 1.0
         * @package backend.controllers
         *
         */
        class BeobjectController extends BeController
        {

                public function __construct($id, $module = null)
                {
                        parent::__construct($id, $module);
                        $this->menu = array(
                                    array('label' => t('管理内容'), 'url' => array('admin'), 'linkOptions' => array('class' => 'button')),
                                    array('label' => t('添加内容'), 'url' => array('create'), 'linkOptions' => array('class' => 'button')),
                        );
                }

                /**
                 * The function that do Create new Object
                 * 
                 */
                public function actionCreate()
                {
                        $this->render('object_create');
                }

                /**
                 * The function that do Update Object
                 * 
                 */
                public function actionUpdate()
                {
                        $id = isset($_GET['id']) ? (int) ($_GET['id']) : 0;
                        $this->menu = array_merge($this->menu, array(
                                    array('label' => t('修改内容'), 'url' => array('update', 'id' => $id), 'linkOptions' => array('class' => 'button')),
                                    array('label' => t('查看内容'), 'url' => array('view', 'id' => $id), 'linkOptions' => array('class' => 'button'))
                                        )
                        );

                        $this->render('object_update');
                }

                /**
                 * The function that do View User
                 * 
                 */
                public function actionView()
                {
                        $id = isset($_GET['id']) ? (int) ($_GET['id']) : 0;
                        $this->menu = array_merge($this->menu, array(
                                    array('label' => t('修改内容'), 'url' => array('update', 'id' => $id), 'linkOptions' => array('class' => 'button')),
                                    array('label' => t('查看内容'), 'url' => array('view', 'id' => $id), 'linkOptions' => array('class' => 'button'))
                                        )
                        );
                        $this->render('object_view');
                }

                /**
                 * The function that do Manage Object
                 * 
                 */
                public function actionAdmin()
                {
                        $type = '';

                        $this->render('object_admin', array('type' => $type));
                }

                public function actionGame()
                {
                        $type = 'game';

                        $this->render('object_admin', array('type' => $type));
                }

                public function actionArticle()
                {
                        $type = 'article';

                        $this->render('object_admin', array('type' => $type));
                }

                public function actionServer()
                {
                        $type = 'server';

                        $this->render('object_admin', array('type' => $type));
                }
                public function actionCard()
                {
                        
						$type = 'card';

                        $this->render('object_admin', array('type' => $type));
						exit;
                }

                /**
                 * This function sugget Tags for Object
                 * 
                 */
                public function actionSuggestTags()
                {

                        $this->widget('backwidgets.object.ObjectExtraWorkWidget', array('type' => 'suggest_tags'));
                }

                /**
                 * The function is to Delete a Content
                 * 
                 */
                public function actionDelete($id)
                {
                        GxcHelpers::deleteModel('Object', $id);
                }

        }