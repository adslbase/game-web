<?php

/**
 * GenerateController class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined('INYCMS') or die;

/**
 * GenerateController控制器类
 * 
 * @version $Id: GenerateController.php UTF-8 2011-08-14 14:18:39 li feixiang
 * @package backend-controller
 * @since 1.0
 * 
 */
class GenerateController extends BackController {

    public function init() {
        if (Ycms::app()->getUser()->getIsGuest() === TRUE)
            $this->redirect('login/login');

        define('ISHTML', 1);
    }

    /**
     * 默认动作
     *
     * @since       1.0
     */
    public function actionIndex() {
        $this->render('index');
    }

    public function actionDefault() {
        ob_start();

        Ycms::getApplication('frontend')->runController('site/index');
        $content = ob_get_contents();

        ob_end_clean();

        $path = YPATH_ROOT . DS . 'index' . '.html';
        file_put_contents($path, $content);


        $this->showMessage(array('content' => '生成首页成功', 'title' => '生成首页'), FALSE, 18000);
    }

    public function actionChannel() {

        $model = $this->loadDaoModel('Channel');
        $rawData = $model->selectAllChannel();

        foreach ($rawData as $value) {
            $_GET['cid'] = $value['ch_id'];
            ob_start();

            if ($_GET['cid'] == 4 ) {
                $_GET['service'] = 'fy';
                $_GET['rate'] = 'HD';
            }

            Ycms::getApplication('frontend')->runController('site/index');

            $content = ob_get_contents();

            ob_end_clean();

            $path = YPATH_ROOT . DS . 'live' . $value['ch_id'] . '.html';

            file_put_contents($path, $content);
        }

        $this->showMessage(array('content' => '生成频道页面', 'title' => '生成频道'), FALSE, 18000);
    }

    public function actionStream() {

        $model = $this->loadDaoModel('Stream');
        $rawData = $model->selectAllStream();

        foreach ($rawData as $value) {
            $_GET['service'] = $value['service'];
            $_GET['rate'] = $value['type'];
            $_GET['cid'] = $value['ch_id'];
            ob_start();

            Ycms::getApplication('frontend')->runController('site/index');
            $content = ob_get_contents();

            ob_end_clean();

            $path = YPATH_ROOT . DS . $value['service'] . $value['type'] . $value['ch_id'] . '.html';
            file_put_contents($path, $content);
        }

        $this->showMessage(array('content' => '生成直播', 'title' => '生成直播'), FALSE, 18000);
    }

}

