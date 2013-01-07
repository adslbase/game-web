<?php

/**
 * Class for render Top Menu
 * 
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package common.front_blocks.search
 */
class MenuBlock extends MWidget {

        public $errors = array();
        public $menu_id;



        public function run() {
                $this->renderContent();
        }

        protected function renderContent() {
       
                $menu_r0_items = Yii::app()->cache->get('menu_r0_' . $this->menu_id);

                if ($menu_r0_items === false) {
                        $menu_r0_items = self::getMenuItems(0, $this->menu_id);
                        Yii::app()->cache->set('menu_r0_' . $this->menu_id, $menu_r0_items, 7200);
                }

                $this->render($this->template, array('menus' => $menu_r0_items,
                ));
        }

        public function validate() {
                if ($this->menu_id == "") {
                        $this->errors['menu_id'] = t('Please select a Menu');
                        return false;
                }
                else
                        return true;
        }

        public function params() {
                return array(
                    'menu_id' => t('Menu'),
                );
        }

        public function beforeBlockSave() {
                return true;
        }

        public function afterBlockSave() {
                return true;
        }

        public static function getMenuItems($parent_id, $menu_id) {
                $menu_items = MenuItem::model()->findAll(
                        array(
                            'condition' => 'parent=:pid AND menu_id=:mid',
                            'params' => array(':pid' => $parent_id, ':mid' => $menu_id),
                            'order' => ' t.order ASC ')
                );

                $result = array();
                foreach ($menu_items as $menu_item) {
                        $result[] = array('name' => $menu_item->name, 'link' => self::buildLink($menu_item), 'id' => $menu_item->menu_item_id);
                }
                return $result;
        }

        public static function findMenu() {
                $result = array();
                $menus = Menu::model()->findAll();
                if ($menus) {
                        foreach ($menus as $menu) {
                                $result[$menu->menu_id] = $menu->menu_name;
                        }
                }

                return $result;
        }

        public static function buildLink($item) {
                switch ($item->type) {
                        case ConstantDefine::MENU_TYPE_URL:
                                return $item->value;
                                break;
                        case ConstantDefine::MENU_TYPE_STRING:
                                
                               return Yii::app()->createUrl($item->value);
                                break;
                        default :
                                return $item->value;
                                break;
                }
        }

}

?>