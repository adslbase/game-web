<?php

    /**
     * ChannelController class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * ChannelController控制器类
     * 
     * @version $Id: ChannelController.php UTF-8 2011-07-28 11:00:21 li feixiang
     * @package backend-controller
     * @since 1.0
     * 
     */
    class ChannelController extends BackController
    {

        /**
         * 频道列表
         *
         * @since       1.0
         */
        public function actionIndex()
        {
            $model = $this->loadDaoModel('Channel');

            $rawData = $model->selectAllChannel();

            $dataProvider = new CArrayDataProvider($rawData, array('keyField' => 'ch_id'));

            $this->render('index', array('dataProvider' => $dataProvider));
        }

        /**
         * 创建一个频道
         */
        public function actionCreate()
        {

            $model = $this->loadDaoModel('Channel');

            if (($model->attributes = $this->getPost('Channel')) !== null)
            {
                if ($model->validate() !== false && $model->insertChannel() != false)
                {
                    YMessage::setFlash(Ycms::t('channel', '添加频道成功'));
                    $this->redirect(array('channel/index'));
                }
            }

            $this->render('view', array('model' => $model));
        }

        /**
         * 更新一个频道的数据
         * @param int $id 
         */
        public function actionUpdate($id)
        {
            $model = $this->loadDaoModel('Channel');

            if (($model->attributes = $this->getPost('Channel')) !== null)
            {
                if ($model->validate() !== false && $model->updateChannel($id) != false)
                {
                    YMessage::setFlash(Ycms::t('channel', '修改频道成功'));
                    $this->redirect(array('channel/index'));
                }
            }
            $model->attributes = $model->selectChannel($id);
            $this->render('view', array('model' => $model));
        }

        /**
         * 删除一个频道
         * @param int $id
         */
        public function actionDelete($id)
        {
            $model = $this->loadDaoModel('Channel');

            if ($model->deleteChannel($id) == true)
            {
                YMessage::setFlash(Ycms::t('channel', '删除频道成功'));
                $this->redirect(array('channel/index'));
            }
        }

    }