<?php

class MArtdialog extends CWidget {

        public $extraScriptFile = "artDialog.js";
        public function init() {
                parent::init();
                $path = pathinfo(__FILE__); // changed to enable various extension Paths - GOsha
                $basePath = $path['dirname'] . '/assets';
                $baseUrl = Yii::app()->getAssetManager()->publish($basePath);
                $cs = Yii::app()->getClientScript();
                $cs->registerScriptFile($baseUrl . '/' . $this->extraScriptFile.'?skin=twitter');
        }

        public function run() {
                parent::run();
        }

}


