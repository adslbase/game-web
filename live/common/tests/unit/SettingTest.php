<?php

class SettingTest extends CDbTestCase {

    public $fixtures = array(
        'settings' => 'setting'
    );

    public function testSettings() {
        $model = new Setting;
        
        $settings = $model->loadSettings();
        
        print_r($settings);
        
    }
    

//    public function testData() {
//        $model = Setting::model();
//        $connection = $model->getDbConnection();
//        $sql = 'SELECT * FROM '. $model->tableName();
//        $command = $connection->createCommand($sql);
//        $result = $command->queryAll();
//        var_export($result);
//    }
}