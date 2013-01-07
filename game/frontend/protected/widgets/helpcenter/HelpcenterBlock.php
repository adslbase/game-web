<?php

        /**
         * Class for render Sign in Box
         * 
         * 
         * @author Tuan Nguyen <nganhtuan63@gmail.com>
         * @version 1.0
         * @package common.front_blocks.signin
         */
        class HelpcenterBlock extends MWidget
        {
        
                public function run()
                {
                        $this->renderContent();
                }

                protected function renderContent()
                {
                          $news=FrontCache::objectPayHelp();
                        $this->render($this->template, array('news' => $news));
                }

                public function validate()
                {
                        return true;
                }

                public function params()
                {
                        return array();
                }

                public function beforeBlockSave()
                {
                        return true;
                }

                public function afterBlockSave()
                {
                        return true;
                }

        }

?>