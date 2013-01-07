<?php

        class DxztestController extends GameController
        {

                public $gameid = 146;
                public $layout = '//dxz/main';
                public $menuid = 2;

                public function allowedActions()
                {
                        
						return 'index,game,left,top,scroller,play,gl,xw,server,view,short,vip';
                }

                public function actionIndex()
                {
                        
						$news = FrontCache::getGameNews($this->gameid, 5);
                        $gls = FrontCache::getGameGl($this->gameid, 5);
                        $this->render('index', array('news' => $news, 'gls' => $gls));
                }

                public function actionVip()
                {
                        $this->layout = '//layout/empty';

                        $this->render('vip');
                }

        }

        