<?php

        /**
         * This is the model class for General Settings Form
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package cms.models.settings
         *
         */
        class SettingGeneralForm extends CFormModel
        {

                public $site_name;
                public $slogan;
                public $site_title;
                public $site_description;
                public $homepage;

                /**
                 * Declares the validation rules.
                 * 
                 */
                public function rules()
                {
                        return array(
                                    // username and password are required
                                    array('site_name, homepage', 'required'),
                                    array('site_title, site_description, slogan', 'safe'),
                        );
                }

                /**
                 * Declares attribute labels.
                 */
                public function attributeLabels()
                {
                        return array(
                                    'site_name' => t('网站名称'),
                                    'slogan' => t('网站口号'),
                                    'site_title' => t('网站标题'),
                                    'site_description' => t('网站说明'),
                                    'homepage' => t('首页名称'),
                        );
                }

        }

        