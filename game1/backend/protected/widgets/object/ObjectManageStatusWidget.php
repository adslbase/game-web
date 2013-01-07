<?php

        /**
         * This is the Widget for manage a Object based on its status.
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package  backwidgets.object
         *
         */
        class ObjectManageStatusWidget extends CWidget
        {

                public $visible = true;
                public $type = 0;

                public function init()
                {
                        
                }

                public function run()
                {
                        if ($this->visible)
                        {
                                $this->renderContent();
                        }
                }

                protected function renderContent()
                {
                        $this->doAdminSearch($this->type);
                }

                public function doAdminSearch($type)
                {

                        $result = null;

                        $model = new Object('search');
                        
                        $model->unsetAttributes();

                        if (isset($_GET['Object']))
                        {
                                $model->attributes = $_GET['Object'];
                                $type = $model->object_type;
                        }

                        $result = $model->doSearch($type);

                        $this->render('backwidgets.views.object.object_manage_widget', array(
                                    'model' => $model,
                                    'result' => $result,
                                    'type'=>$type,
                        ));
                }

        }

        