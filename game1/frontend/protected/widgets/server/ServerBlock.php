<?php

class ServerBlock extends MWidget {

        public $status = 1;
        public $level = 0;
        
        public function run() {
                $this->renderContent();
        }

        protected function renderContent() {
                $newServers = FrontCache::getAllServers();
                $rawData = array();
                foreach ($newServers as $key => $value) {
                        if ($this->status !== 0 && $value['object_status'] == $this->status) {
                                $rawData[$key] = $value;
                                continue;
                        }
                        if ($this->level !== 0 && $value['level'] == $this->level) {
                                $rawData[$key] = $value;
                                continue;
                        }
                }

                if (empty($rawData)) {
                        $rawData = $newServers;
                }
                
               $rawData= array_slice($rawData, 0 ,10);
                
                $this->render($this->template, array('servers' => $rawData));
        }

}