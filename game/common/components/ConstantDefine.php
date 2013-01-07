<?php

        /**
         * Class defined all the Constant value of the CMS.
         * 
         * 
         * @author Tuan Nguyen
         * @version 1.0
         * @package common.components
         */
        class ConstantDefine
        {

                const AMAZON_SES_ACCESS_KEY = '';
                const AMAZON_SES_SECRET_KEY = '';
                const AMAZON_SES_EMAIL = '';
                const SUPPORT_EMAIL = '';


                /**
                 * Constant related to Upload File Size
                 */
                const UPLOAD_MAX_SIZE = 10485760; //10mb
                const UPLOAD_MIN_SIZE = 1; //1 byte

                public static function fileTypes()
                {
                        return array(
                                    'image' => array('jpg', 'gif', 'png', 'bmp', 'jpeg'),
                                    'audio' => array('mp3', 'wma', 'wav'),
                                    'video' => array('flv', 'wmv', 'avi', 'mp4', 'mov', '3gp'),
                                    'flash' => array('swf'),
                                    'file' => array('*'),
                        );
                }

                public static function chooseFileTypes()
                {
                        return array(
                                    'auto' => t('自动检测'),
                                    'image' => t('图片'),
                                    'video' => t('视频'),
                                    'audio' => t('音频'),
                                    'file' => t('文件'),
                        );
                }

                /**
                 * Constant related to User
                 */

                const USER_ERROR_NOT_ACTIVE = 3;
                const USER_STATUS_DISABLED = 0;
                const USER_STATUS_ACTIVE = 1;

                public static function getUserStatus()
                {
                        return array(
                                    self::USER_STATUS_DISABLED => t("禁用"),
                                    self::USER_STATUS_ACTIVE => t("启用"));
                }

                const USER_GROUP_ADMIN = 'Admin';

                /**
                 * Constant related to Object
                 * 
                 */
                const OBJECT_STATUS_PUBLISHED = 1;
                const OBJECT_STATUS_PENDING = 2;

                public static function getObjectStatus()
                {
                        return array(
                                    self::OBJECT_STATUS_PUBLISHED => t("发布"),
                                    self::OBJECT_STATUS_PENDING => t("未发布"),
                        );
                }

                const OBJECT_ALLOW_COMMENT = 1;
                const OBJECT_DISABLE_COMMENT = 2;

                public static function getObjectCommentStatus()
                {
                        return array(
                                    self::OBJECT_ALLOW_COMMENT => t("启用"),
                                    self::OBJECT_DISABLE_COMMENT => t("禁用"),
                        );
                }

                /**
                 * Constant related to Menu
                 *         
                 */

                const MENU_TYPE_URL = 1;
                const MENU_TYPE_STRING = 2;

                public static function getMenuType()
                {
                        return array(
                                    self::MENU_TYPE_URL => t("URL链接"),
                                    self::MENU_TYPE_STRING => t("路由"),
                        );
                }

                const LEVEL_NONE = 0;
                const LEVEL_NEW = 1;
                const LEVEL_HOT = 2;
                const LEVEL_RECOMMEND = 3;

                public static function getContentLevel()
                {
                        return array(
                                    self::LEVEL_NONE => t("无"),
                                    self::LEVEL_NEW => t("最新"),
                                    self::LEVEL_HOT => t("最热"),
                                    self::LEVEL_RECOMMEND => t("推荐")
                        );
                }

                const STARS_ONE = 1;
                const STARS_TWO = 2;
                const STARS_THREE = 3;
                const STARS_FOUR = 4;
                const STARS_FIVE = 5;

                public static function getStarts()
                {
                        return array(
                                    self::STARS_ONE => t("一星"),
                                    self::STARS_TWO => t("二星"),
                                    self::STARS_THREE => t("三星"),
                                    self::STARS_FOUR => t("四星"),
                                    self::STARS_FOUR => t("五星")
                        );
                }

                const BAND_DOUBLE = 1;
                const BAND_TELECOM = 2;
                const BAND_NETCOM = 3;

                public static function getServerBand()
                {
                        return array(
                                    self::BAND_DOUBLE => t("双线"),
                                    self::BAND_TELECOM => t("电信"),
                                    self::BAND_NETCOM => t("网通"),
                        );
                }

                const SERVER_STATUS_SOON = 1;
                const SERVER_STATUS_MAINTAIN = 2;
                const SERVER_STATUS_NORMAL = 3;
                const SERVER_STATUS_NEW = 4;
                const SERVER_STATUS_FLUENT = 5;
                const SERVER_STATUS_BUSY = 6;
                const SERVER_STATUS_HOT = 7;
                const SERVER_STATUS_TEST = 8;

                public static function getServerStatus()
                {
                        return array(
                                    self::SERVER_STATUS_NORMAL => t("正常开启"),
                                    self::SERVER_STATUS_SOON => t("即将开启"),
                                    self::SERVER_STATUS_MAINTAIN => t("正在维护"),
                                    self::SERVER_STATUS_NEW => t("新服开启"),
                                    self::SERVER_STATUS_FLUENT => t("流畅开启"),
                                    self::SERVER_STATUS_BUSY => t("繁忙开启"),
                                    self::SERVER_STATUS_HOT => t("火爆开启"),
                                    self::SERVER_STATUS_TEST => t("删档测试"),
                        );
                }

                const GENERAL_YES = 1;
                const GENERAL_NO = 0;

                public static function getGeneralStatus()
                {
                        return array(
                                    self::SERVER_STATUS_NORMAL => t("是"),
                                    self::SERVER_STATUS_SOON => t("否"),
                        );
                }

                const PAY_RATIO = 1;
                const PAY_FIXED = 0;

                public static function getPayMethod()
                {
                        return array(
                                    self::PAY_RATIO => t("按比例收费"),
                                    self::PAY_FIXED => t("固定费用"),
                        );
                }

                const ALIPAY_DANBAO = 2;
                const ALIPAY_BIAOZHUN = 1;
                const ALIPAY_JISHI = 0;

                public static function getAlipayServiceType()
                {
                        return array(
                                    self::ALIPAY_JISHI => t("使用即时到账交易接口"),
                                    self::ALIPAY_DANBAO => t("使用担保交易接口"),
                                    self::ALIPAY_BIAOZHUN => t("使用标准双接口"),
                        );
                }
                
  
                const SERVER_ALLOW_PAY = 1;
                const SERVER_NO_PAY = 0;

                public static function getServerIsPay()
                {
                        return array(
                                    self::SERVER_ALLOW_PAY => t("开启支付"),
                                    self::SERVER_NO_PAY => t("禁止支付"),
                        );
                }
                
                
                
                public static function getOrderStatus($statu='')
                {
                        $status = array(
                                    'succ'=>'支付成功',
                                    'chargefailed'=>'兑换游戏币失败',
                                    'unpay'=>'未支付',
                                    'paid'=>'已经支付',
                                    'payfailed'=>'支付失败',
                                    'failed'=>'订单失败',
                                    'error'=>'错误',
                                    'timeout'=>'超时',
                                    'cancel'=>'取消',
                                    'admincharge'=>'管理员补单'
                        );
                        if($statu == '')
                        {
                                return $status;
                        }
                        else
                        {
                                return $status[$statu];
                        }
                        
                }
        
                
                

        }

?>
