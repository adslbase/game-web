<?php

class CategoryTest extends CDbTestCase {


    public function testLevelItems() {
       $AuthItemModel = new AuthItem;
       
       $result = $AuthItemModel->getLevelItems(2);
       
       print_r($result);

    }

}
