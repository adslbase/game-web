<?php

        /**
         * Backend Resource Controller.
         * 
         * @author Tuan Nguyen <nganhtuan63@gmail.com>
         * @version 1.0
         * @package backend.controllers
         *
         */
        class BeresourceController extends BeController
        {

                public function __construct($id, $module = null)
                {
                        parent::__construct($id, $module);
                        $this->menu = array(
                                    array('label' => t('管理附件'), 'url' => array('admin'), 'linkOptions' => array('class' => 'button')),
                                    array('label' => t('添加附件'), 'url' => array('create'), 'linkOptions' => array('class' => 'button')),
                        );
                }

                /**
                 * The function that do Create new Resource
                 * 
                 */
                public function actionCreate()
                {
                        $this->render('resource_create');
                }

                /**
                 * The function that do Create new Resource
                 * 
                 */
                public function actionCreateFrame()
                {
                        $this->layout = 'clean';
                        $this->render('resource_create');
                }

                /**
                 * The function that do Manage Resource
                 * 
                 */
                public function actionAdmin()
                {
                        $this->render('resource_admin');
                }

                /**
                 * The function that view Resource details
                 * 
                 */
                public function actionView()
                {
                        $id = isset($_GET['id']) ? (int) ($_GET['id']) : 0;
                        $this->menu = array_merge($this->menu, array(
                                    array('label' => t('修改附件'), 'url' => array('update', 'id' => $id), 'linkOptions' => array('class' => 'button')),
                                    array('label' => t('查看附件'), 'url' => array('view', 'id' => $id), 'linkOptions' => array('class' => 'button'))
                                        )
                        );
                        $this->render('resource_view');
                }

                /**
                 * The function that update Resrouce
                 * 
                 */
                public function actionUpdate()
                {
                        $id = isset($_GET['id']) ? (int) ($_GET['id']) : 0;
                        $this->menu = array_merge($this->menu, array(
                                    array('label' => t('修改附件'), 'url' => array('update', 'id' => $id), 'linkOptions' => array('class' => 'button')),
                                    array('label' => t('查看附件'), 'url' => array('view', 'id' => $id), 'linkOptions' => array('class' => 'button'))
                                        )
                        );
                        $this->render('resource_update', array('id' => $id));
                }

                /**
                 * The function is to Delete Menu
                 * 
                 */
                public function actionDelete($id)
                {
                        GxcHelpers::deleteModel('Resource', $id);
                }

        }