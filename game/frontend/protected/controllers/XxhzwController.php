<?php

        class XxhzwController extends GameController
        {

                public $gameid = 1;
                public $layout = '//xxhzw/main';
                public $menuid = 2;

                public function allowedActions()
                {
                        return 'index,game,left,top,scroller,play,gl,xw,server,view,short,vip,gc,gc2012_01,gc2012_02,gc2012_03,gc2012_04';
                }

                public function actionIndex()
                {
                        $news = FrontCache::getGameNews($this->gameid, 5);
                        $gls = FrontCache::getGameGl($this->gameid, 20);

                        $this->render('index', array('news' => $news, 'gls' => $gls));
                }

                public function actionVip()
                {
                        $this->layout = '//layout/empty';
                        $this->render('vip');
                }

		public function actionGc()
		{
		        $this->layout = '//layout/empty';
                        $this->render('gc');
		}

		public function actionGc2012_01()
		{
		        $this->layout = '//layout/empty';
                        $this->render('gc1');
		}

		public function actionGc2012_02()
		{
		        $this->layout = '//layout/empty';
                        $this->render('gc2');
		}

		public function actionGc2012_03()
		{
		        $this->layout = '//layout/empty';
                        $this->render('gc3');
		}

		public function actionGc2012_04()
		{
		        $this->layout = '//layout/empty';
                        $this->render('gc4');
		}
        }
