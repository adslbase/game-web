<?php


class GamecenterController extends FeController {

        public $defaultAction = 'index';

        /**
         * List of allowd default Actions for the user
         * @return type 
         */
        public function allowedActions() {
                return 'index,server';
        }
        
        public function actionIndex()
        {
                $this->render('index');
        }
        
        public function actionServer($gameid)
        {
                $games = FrontCache::getGames();
             
                $game = $games[$gameid];
                
            $this->render('server',array('game'=>$game));
        }
  
        
        
        
        

}