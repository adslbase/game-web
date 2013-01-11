<?php

class funTest extends  CDbTestCase {
    
    
    
    
public function testGlobal() {
    Yii::app()->setGlobalState('aaaa', 'dfsdfsf');
    
    Yii::app()->saveGlobalState();
    
    echo Yii::app()->getGlobalState('aaaa');
    
}
    
    
    
    
    
    
    
    
    
}