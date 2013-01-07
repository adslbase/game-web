<?php

        class ResourceUploadForm extends CFormModel
        {

                public $name;
                public $body;
                public $link;
                public $upload;
                public $type;
                public $where;

                public function rules()
                {
                        return array(
                                    array('link, name, body, type,where', 'safe'),
                                    array('upload', 'file', 'allowEmpty' => true),
                        );
                }

                public function attributeLabels()
                {
                        return array(
                                    'upload' => t('上传'),
                                    'link' => t('链接'),
                                    'name' => t('附件名称'),
                                    'body' => t('附件说明'),
                                    'where' => t('存储方式'),
                                    'type' => t('附件类型')
                        );
                }

        }