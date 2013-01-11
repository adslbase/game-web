<?php

    /**
     * StreamController class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * StreamController控制器类
     * 
     * @version $Id: StreamController.php UTF-8 2011-07-28 11:00:37 li feixiang
     * @package backend-controller
     * @since 1.0
     * 
     */
    class StreamController extends BackController
    {

        /**
         * 直播列表
         *
         * @since       1.0
         */
        public function actionIndex()
        {
            $model = $this->loadDaoModel('Stream');

            $rawData = $model->selectAllStream();

            $dataProvider = new CArrayDataProvider($rawData,array('keyField'=>'ch_id'));

            $this->render('index', array('dataProvider' => $dataProvider,'model'=>$model));
        }
        /**
         *创建一个直播地址
         */
        public function actionCreate()
        {
            $model = $this->loadDaoModel('Stream');
    
            if (($model->attributes = $this->getPost('Stream')) !== null)
            {
                if ($model->validate() !== FALSE && $model->insertStream() !== FALSE)
                {
                    YMessage::setFlash(Ycms::t('stream', '添加播放地址成功'));
                    $this->redirect(array('stream/index'));
                }
            }

            $this->render('view', array('model' => $model));
        }

        /**
         * 更新一个直播地址
         * @param string $type
         * @param service $service 
         */
        public function actionUpdate($stream_id)
        {
            $model = $this->loadDaoModel('Stream');

            if (($model->attributes = $this->getPost('Stream')) !== null)
            {
                if ($model->validate() !== false && $model->updateStream($stream_id) != false)
                {
                    YMessage::setFlash(Ycms::t('stream', '修改播放地址成功'));
                    $this->redirect(array('stream/index'));
                }
            }
            $model->attributes = $model->selectStream($stream_id);
            $this->render('view', array('model' => $model));
        }

        /**
         * 删除一个直播地址
         */
        public function actionDelete($stream_id)
        {
            $model = $this->loadDaoModel('Stream');

            if ($model->deleteStream($stream_id) == true)
            {
                YMessage::setFlash(Ycms::t('stream', '删除频道成功'));
                $this->redirect(array('stream/index'));
            }
        }

    }