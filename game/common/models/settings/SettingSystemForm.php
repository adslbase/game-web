<?php

        /**
         * This is the model class for System Settings Form
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package cms.models.settings
         *
         */
        class SettingSystemForm extends CFormModel
        {

                public $support_email;
                public $page_size;
                public $language_number;
                public $keep_file_name_upload;

                /**
                 * Declares the validation rules.
                 * 
                 */
                public function rules()
                {
                        return array(
                                    // username and password are required
                                    array('support_email, page_size, language_number, keep_file_name_upload', 'required'),
                                    array('support_email', 'email'),
                                    array('language_number, page_size', 'numerical', 'integerOnly' => true, 'min' => 1),
                                    array('language_number', 'checkAvailableLanguage')
                        );
                }

                /**
                 * Declares attribute labels.
                 */
                public function attributeLabels()
                {
                        return array(
                                    'support_email' => t('管理员邮箱'),
                                    'page_size' => t('分页数'),
                                    'language_number' => t('可用语言数'),
                                    'keep_file_name_upload' => t('上传时，不修改文件名'),
                        );
                }

                /**
                 * Check available Languages of the Current System
                 * 
                 */
                public function checkAvailableLanguage($attribute, $params)
                {
                        if (!$this->hasErrors())
                        {
                                //First we need to check all the Active Languages of the CMS
                                $languages = Language::loadItems();
                                if ($this->language_number > count($languages))
                                {
                                        $this->addError('language_number', t('网站现在只支持 ') . count($languages) . ' ' . t('种语言'));
                                        return false;
                                }
                        }
                }

                public static function filenameUpload()
                {
                        return array(
                                    '0' => t('否'),
                                    '1' => t('是'),
                        );
                }

        }

        