<?php

class GameServerBlock extends MWidget {

        public $gameid = '';

        public function run() {
                $this->renderContent();
        }

        public function setParams() {
                if (isset($_GET['gameid'])) {
                        $this->gameid = $_GET['gameid'];
                }
        }

        protected function renderContent() {
                $this->setParams();

                $gameServers = FrontCache::getServers();
                
                $servers = $gameServers[$this->gameid];
                $games = FrontCache::getGames();
                
                $game = $games[$this->gameid];
                
                $this->render($this->template, array('servers' => $servers,'game'=>$game));
        }
        
        
        public function getServerStatus($id)
        {
                  $status = ConstantDefine::getServerStatus();
                  
                  return $status[$id];
        }

}