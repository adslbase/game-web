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
        class Stream extends YDaoModel
        {

                public $service = 'pptv';
                public $type = 'SD';

                /**
                 * 该模型关联的数据库表名
                 *      
                 * @return      string          该模型关联的数据库表名
                 * @since	1.0
                 */
                public static function tableName()
                {
                        return '{{stream}}';
                }

                /**
                 * 字段验证规则
                 *
                 * boolean-captcha-compare-email-default-exist-file-filter-in-length-match-numerical-required-type-unique-url
                 * return       array
                 * @since	1.0
                 */
                public function rules()
                {
                        return array(
                                    array('ch_id, stream, type, service', 'required'),
                                    array('ch_id', 'numerical', 'integerOnly' => true),
                                    array('type, service', 'length', 'max' => 64),
                                    array('ch_id, stream, type, service', 'safe'),
                        );
                }

                /**
                 * 字段label
                 *
                 * @return      array           customized attribute labels (name=>label)
                 * @since	1.0
                 */
                public function attributeLabels()
                {
                        return array(
                                    'ch_id' => Ycms::t('stream', '频道'),
                                    'stream' => Ycms::t('stream', '播放地址'),
                                    'type' => Ycms::t('stream', '清晰度'),
                                    'service' => Ycms::t('stream', '服务商'),
                        );
                }

                /**
                 * 字段说明
                 *
                 * @return      array           customized attribute hints (name=>hint)
                 * @since	1.0
                 */
                public function attributeHints()
                {
                        return array(
                                    'ch_id' => Ycms::t('stream', '选择该播放地址属于哪个频道'),
                                    'stream' => Ycms::t('stream', '这个是播放地址。不同的服务商提供的播放地址不一样。'),
                                    'type' => Ycms::t('stream', '在这里选择清晰度'),
                                    'service' => Ycms::t('stream', '提供给我们播放地址的服务商'),
                        );
                }

                /**
                 * 加载表单选项
                 * @param type $type
                 * @param type $code
                 * @return type 
                 */
                public function loadFormOptions($type, $code = null)
                {
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

                        if ($type == 'channel')
                        {
                                $modelChannel = YController::loadDaoModel('Channel');

                                $options['channel'] = $modelChannel->getChannel();
                        }

                        return $code ? $options[$type][$code] : $options[$type];
                }

                /**
                 * 获得所有的直播列表
                 * @return array 
                 */
                public function selectAllStream()
                {
                        $sql = 'SELECT * FROM ' . $this->tableName();

                        return $this->daoQueryAll($sql);
                }

                /**
                 * 插入一个直播地址
                 * @return boolean 
                 */
                public function insertStream()
                {
                        $attributes = $this->getAttributes();
                        $connection = $this->joinAttributesInsert($attributes);
                        $sql = 'INSERT INTO ' . $this->tableName() . $connection;
                        $attributes['ch_id'] = array($attributes['ch_id'], PDO::PARAM_INT);
                        return $this->daoExecute($sql, $attributes, 'bindValue') === 1;
                }

                /**
                 * 选择一个直播地址
                 * @param string $type
                 * @param string $service
                 * @param mixed $fields 选择的字段
                 * @return array 
                 */
                public function selectStream($stream_id, $fields = '')
                {
                        $connection = $this->joinAttributesSelect($fields);

                        $sql = 'SELECT ' . $connection . ' FROM ' . $this->tableName() . ' WHERE `stream_id` = :stream_id ';

                        return $this->daoQueryRow($sql, array(':stream_id' => $stream_id), 'bindValue');
                }
                
                                /**
                 * 获得流地址
                 * @return array 
                 */
                public function selectStreamUrl($service, $rate,$cid)
                {

                        $sql = 'SELECT `stream` FROM ' . $this->tableName() . ' WHERE service = :service AND type =:type AND ch_id=:ch_id';
                        $result = $this->daoQueryRow($sql, array('service' => $service, 'type' => $rate,'ch_id'=>$cid), 'bindValue');
                        return $result['stream'];
                }
                /**
                 * 获得所有的直播列表
                 * @return array 
                 */
                public function selectByCid($cid)
                {
                        $sql = 'SELECT * FROM ' . $this->tableName().' WHERE `ch_id`=:ch_id';

                        return $this->daoQueryAll($sql,array('ch_id' => $cid));
                }
                /**
                 * 修改一个直播地址
                 * @param string $type
                 * @param string $service
                 * @return boolean 
                 */
                public function updateStream($stream_id)
                {
                        $attributes = $this->getAttributes();

                        $connection = $this->joinAttributesUpdate($attributes);

                        $sql = 'UPDATE ' . $this->tableName() . ' SET ' . $connection . ' WHERE `stream_id` = :stream_id ';
                        $attributes['stream_id'] = $stream_id;
                        return $this->daoExecute($sql, $attributes, 'bindValue') === 1;
                }

                /**
                 * 根据播放地址类型和提供商删除一个播放地址
                 * @param string $type
                 * @param string $service
                 * @return boolean 
                 */
                public function deleteStream($stream_id)
                {
                        $sql = 'DELETE FROM ' . $this->tableName() . ' WHERE `stream_id` = :stream_id ';
                        return $this->daoExecute($sql, array(':stream_id' => $stream_id), 'bindValue');
                }

                public function search()
                {
                        $criteria = new CDbCriteria;

                        $criteria->compare('title', $this->title, true);

                        $criteria->compare('status', $this->status);

                        return new CActiveDataProvider('Post', array(
                                                    'criteria' => $criteria,
                                                    'sort' => array(
                                                                'defaultOrder' => 'status, update_time DESC',
                                                    ),
                                        ));
                }

        }

        