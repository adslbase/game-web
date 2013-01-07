<?php

/**
 * This is the Widget for Clear Caching
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package  backwidgets.object
 *
 *
 */
class CachingClearWidget extends CWidget {

        public $visible = true;

        public function init() {
                
        }

        public function run() {
                if ($this->visible) {
                        $this->renderContent();
                }
        }

        protected function renderContent() {

                $cache_id = isset($_GET['cache_id']) ? strtolower($_GET['cache_id']) : '';
                if ($cache_id) {
                        switch ($cache_id) {
                                case 'frontend_assets':
                                        $this->clearCacheAssets('frontend');
                                        user()->setFlash('success', t('前台资源清除成功!'));
                                        break;
                                case 'frontend_cache':
                                        if ($this->clearCache('frontend'))
                                                user()->setFlash('success', t('清除前台缓存成功!'));
                                        else
                                                user()->setFlash('error', t('清除缓存失败!'));
                                        break;
                                case 'backend_assets':
                                        $this->clearCacheAssets('backend');
                                        user()->setFlash('success', t('后台资源清除成功!'));
                                        break;
                                case 'backend_cache':
                                        if ($this->clearCache('backend'))
                                                user()->setFlash('success', t('后台缓存清除成功!'));
                                        else
                                                user()->setFlash('error', t('清除后台缓存失败'));
                                        break;
                                default:
                                        break;
                        }
                        Yii::app()->controller->redirect(array('becaching/clear'));
                }
                $this->render('backwidgets.views.caching.caching_widget', array());
        }

        public function clearCache($where) {
                switch ($where) {
                        case 'frontend':

                                //发送post请求到前台处理请求
                                $timeout = 30;
                                $curl = curl_init();
                                $pvars = array('key' => FRONTEND_CLEAR_CACHE_KEY);
                                curl_setopt($curl, CURLOPT_URL, FRONT_SITE_URL . '/site/caching');
                                curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
                                curl_setopt($curl, CURLOPT_POST, 1);
                                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                                curl_setopt($curl, CURLOPT_POSTFIELDS, $pvars);
                                $result = curl_exec($curl);
                                curl_close($curl);

                                return $result == '0' ? false : true;
                                break;
                        case 'backend':
                                Yii::app()->cache->flush();
                                return true;
                                break;
                }
        }

        public function clearCacheAssets($where) {
                $get_sub_folders = array();
                switch ($where) {
                        case 'frontend':
                                //Clear the assets folder
                                $get_sub_folders = get_subfolders_name(FRONT_STORE . DIRECTORY_SEPARATOR . 'assets');
                                foreach ($get_sub_folders as $folder) {
                                        recursive_remove_directory(FRONT_STORE . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $folder);
                                }
                                break;
                        case 'backend':
                                $get_sub_folders = get_subfolders_name(BACK_STORE . DIRECTORY_SEPARATOR . 'assets');
                                foreach ($get_sub_folders as $folder) {
                                        recursive_remove_directory(BACK_STORE . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . $folder);
                                }

                                break;
                        default:
                                break;
                }

                return;
        }

}
