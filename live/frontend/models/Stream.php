<?php

/**
 * stream model class file.
 *
 * @author li feixiang <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/
 * @copyright Copyright (c) 2005-2011 Ycms. 
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined('INYCMS') or die;

/**
 * 数据库表"stream"的model类.
 *
 * The followings are the available columns in table 'stream':
 * @property integer $ch_id
 * @property string $stream
 * @property string $type
 * @property string $service
 *
 * @version $Id: stream.php UTF-8 2011-07-28 11:01:55 li feixiang
 * @package backend-model
 * @since 1.0
 */
class Stream extends YDaoModel {

    public $service = 'pp';
    public $type = 'SD';

    /**
     * 该模型关联的数据库表名
     *      
     * @return      string          该模型关联的数据库表名
     * @since	1.0
     */
    public static function tableName() {
        return '{{stream}}';
    }

    /**
     * 获得所有的直播列表
     * @return array 
     */
    public function selectByCid($cid) {
        $sql = 'SELECT * FROM ' . $this->tableName() . ' WHERE `ch_id`=:ch_id';

        return $this->daoQueryAll($sql, array('ch_id' => $cid));
    }

    /**
     * 获得流地址
     * @return array 
     */
    public function selectStreamUrl($service, $rate, $cid) {

        $sql = 'SELECT `stream` FROM ' . $this->tableName() . ' WHERE service = :service AND type =:type AND ch_id=:ch_id';
        $result = $this->daoQueryRow($sql, array('service' => $service, 'type' => $rate, 'ch_id' => $cid), 'bindValue');
        return $result['stream'];
    }

    /**
     * 加载表单选项
     * @param type $type
     * @param type $code
     * @return type 
     */
    public function loadFormOptions($type, $code = null) {
        $options = array(
            'service' => array(
                'pps' => Ycms::t('stream', 'PPS'),
                'qq' => Ycms::t('stream', 'QQLIVE'),
                'pptv' => Ycms::t('stream', 'PPTV'),
                'fy' => Ycms::t('stream', '风云'),
                'ku6' => Ycms::t('stream', '酷六')
            ),
            'type' => array(
                'SD' => Ycms::t('stream', '标清'),
                'HD' => Ycms::t('stream', '高清'),
            ),
        );

        return $code ? $options[$type][$code] : $options[$type];
    }

}

