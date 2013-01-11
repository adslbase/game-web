<?php

class CategoryTest extends CDbTestCase {


    public function testUpdateProgram() {
        $model =  new Program();
 
        
        $result = $model->updateProgram('2011-08-03', 1);
        
        print_r($result);
        
    }

}
