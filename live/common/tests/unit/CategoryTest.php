<?php

class CategoryTest extends CDbTestCase {

    public $fixtures =array(
        'categorys' =>'category'
    );

//    public function testDeleteTree(){
//        $modelCategory = new Category();
//
//        $modelCategory->deleteLeaf(2);
//    }




//    public function testOrder(){
//        $modelCategory = new Category;
//        $modelCategory->orderTree(1);
//    }


    public function testData() {
        $model = Category::model();
        $connection = $model->getDbConnection();
        $sql = 'SELECT * FROM '. $model->tableName();
        $command = $connection->createCommand($sql);
        $result = $command->queryAll();
        var_export($result);
    }

}
