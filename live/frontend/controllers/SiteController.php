<?php

/**
 * SiteController class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined('INYCMS') or die;

/**
 * 这个类实干什么用的
 * 
 * @version $Id: SiteController.php UTF-8 2011-8-10 10:29:55 li feixiang 
 * @package framework
 * @since 1.0
 * 
 */
class SiteController extends FrontController {

    public function actionIndex($service = 'ku6', $rate = "SD", $cid = '') {

        $modelStream = $this->loadDaoModel('Stream'); //流地址
//        $modelProgramPost = $this->loadDaoModel('ProgramPost'); //节目单帖子
//        $modelProgram = $this->loadDaoModel('Program'); //节目单

        $modelChannel = $this->loadDaoModel('Channel'); //流地址

        $channels = $modelChannel->selectAllChannel();
        if ($cid == '') {
            $cid = $channels[0]['ch_id'];
        }

        if ($cid == 4 && $service == 'ku6') {
           $service = 'fy';
            $rate = 'HD';
        }

        $stream = $modelStream->selectStreamUrl($service, $rate, $cid); //获取流地址

        $streamList = $modelStream->selectByCid($cid);

        $this->layout = '//layouts/content';

        $content = $this->render($service, array('stream' => $stream, 'width' => 684, 'height' => 447), TRUE);

        $this->layout = '//layouts/main';

        $this->render('index', array(
            'content' => $content,
            'cid' => $cid,
            'channels' => $channels, 'streamList' => $streamList,
            'model' => $modelStream, 'service' => $service, 'rate' => $rate, 'stream' => $stream,
        ));
    }

    public function isAllowClient() {
        Ycms::import('ycms.util.YBanned');
        $banned = new YBanned(array('countryAllow' => array('CN', 'TW', 'HK', 'MAC'), 'ipAllow' => array('127.0.0.1')));

        return $banned->allowClient();
    }

    public function actionPlay() {
        $this->layout = '//layouts/content';

        $isAllowClient = $this->isAllowClient();

        if ($isAllowClient === true) {
            echo 0;
        } else {
            $this->render('banplay');
        }
    }

    public function actionBets() {
        $this->layout = '//layouts/content';
        $client = new SoapClient('http://gaming.marstv.com/index.php?r=api/quote');
        $bets = $client->getGaming();
        $this->render('bets', array('bets' => $bets));
    }

    public function actionProgram() {
        $modelProgram = $this->loadDaoModel('Program'); //节目单
        $modelChannel = $this->loadDaoModel('Channel'); //流地址
        $channels = $modelChannel->selectAllChannel();

        $date = date('Y-m-d');
        $programList = $modelProgram->selectProgram($date); //获取节目单
        $this->layout = '//layouts/content';
        $this->render('programs', array('programList' => $programList, 'channels' => $channels));
    }

}

