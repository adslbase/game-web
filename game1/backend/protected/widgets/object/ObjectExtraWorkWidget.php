<?php

/**
 * This is the Widget for suggest a People that User can send content to
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package  backwidgets.object
 *
 */
class ObjectExtraWorkWidget extends CWidget
{
    
        public $visible=true; 
        public $type='suggest_tags';

        public function init()
        {

        }

        public function run()
        {
            if($this->visible)
            {
                $this->renderContent();
            }
        }

        protected function renderContent()
        { 
            switch ($this->type){
                 case 'suggest_tags':                
                    if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
                    {                    
                            echo $this->suggestTags($keyword);
                    }
                    Yii::app()->end(); 
                    break;

            }


        }   

         /**
         * Suggest Tags for Object
         * @param type $keyword 
         */
        public  function suggestTags($keyword){                
            $tags=Tag::model()->suggestTags($keyword);
            if($tags!==array())
                    echo implode("\n",$tags);                       
        }

        
        
        
        
}
