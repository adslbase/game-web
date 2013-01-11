<?php

    class UserTest extends CDbTestCase
    {

        public function test()
        {
            $model = new User;
            $model->hashPassword('jiubugaosuni852');
        }
        
        
        
        

//        public function testGetParent()
//        {
//            $model = new Menu;
//
//            $parent = $model->getParent(array('menu_id' => 7, 'level' => 0), array('menu_id', 'name'));
//
//            print_r($parent);
//        }
//
//        public function testGetTree()
//        {
//            $model = new Menu;
//
//            $tree = $model->getTree(array('alias' => 'user'), array('alias','route','param','name', 'level', 'hidden'));
//
//            print_r($tree);
//        }
//    public function testData() {
//        $model = Menu::model();
//        $connection = $model->getDbConnection();
//        $sql = 'SELECT * FROM '. $model->tableName();
//        $command = $connection->createCommand($sql);
//        $result = $command->queryAll();
//        var_export($result);
//    }
    }