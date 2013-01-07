<?php

        class GameBlock extends MWidget
        {

                public $status = 0;
                public $level = 0;
                public $page = 5;
                public $gameid = '';
                public $moreItem='';

                public function run()
                {
                        $this->renderContent();
                }

                public function setParams()
                {
                        if (isset($_GET['gameid']))
                        {
                                $this->gameid = $_GET['gameid']; //通过get获取当前游戏id
                        }
                        
                }

                protected function renderContent()
                {
                        $this->setParams();

                        $games = FrontCache::getGames();

                        $rawData = array();
                        foreach ($games as $key => $value)
                        {
                                if ($this->status !== 0 && $value['object_status'] == $this->status)
                                {
                                        $rawData[$key] = $value;
                                        continue;
                                }
                                if ($this->level !== 0 && $value['level'] == $this->level)
                                {
                                        $rawData[$key] = $value;
                                        continue;
                                }
                        }

                        if (empty($rawData))
                        {
                                $rawData = $games;
                        }
                        
                        if($this->moreItem !== '')
                        {
                                array_unshift($rawData, $this->moreItem);  
                        }
                         
                        $dataProvider = new CArrayDataProvider($rawData, array(
                                                    'pagination' => array('pageSize' => $this->page),
                                                    'keyField' => 'object_id',
                                        ));

                        $this->render($this->template, array('dataProvider' => $dataProvider, 'template' => $this->template));
                }

        }