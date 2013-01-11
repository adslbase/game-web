<?php

    /**
     * ProgramController class file.
     *
     * @author li feixiang <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/
     * @copyright Copyright (c) 2005-2011 Ycms. 
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * ProgramController控制器类
     * 
     * @version $Id: ProgramController.php UTF-8 2011-07-28 11:00:53 li feixiang
     * @package backend-controller
     * @since 1.0
     * 
     */
    class ProgramController extends BackController
    {

        /**
         * 
         */
        public function actionIndex()
        {
            $model = $this->loadDaoModel('Program');
            if ($this->getPost('gridSubmit') !== null)
            {
                $model->attributes = $this->getPost('Program');
                $rawData = $model->selectAllProgramByParam($model->ch_id, $model->date);
            }
            else
            {
                $rawData = $model->selectAllProgram();
            }
            $dataProvider = new CArrayDataProvider($rawData, array('keyField' => 'ch_id'));
            $this->render('index', array('dataProvider' => $dataProvider, 'model' => $model));
        }

        /**
         *
         * @param type $num 
         */
        public function actionCreate($num = '10')
        {
            $modelProgram = $this->loadDaoModel('Program');
            $modelProgramPost = $this->loadDaoModel('ProgramPost');
            if ($this->getPost('add-submit') !== null)
            {
                $add = intval($this->getPost('add'));
                $num = intval($this->getPost('num')) + $add;
                $modelProgram->attributes = $this->getPost('Program');
            }
            else if (($modelProgram->attributes = $this->getPost('Program')) !== null)
            {
          
                $date = $modelProgram->date;
                if (empty($modelProgram->name[0]) && empty($modelProgram->start_time[0]))
                {
                    if ($modelProgramPost->updatePostId($date, $modelProgram->pid) !== FALSE)
                    {
                        YMessage::setFlash(Ycms::t('program', '添加节目成功'));
                        $this->redirect(array('program/index'));
                    }
                }
                else if ($modelProgram->validate() !== FALSE && $modelProgram->insertProgram() !== FALSE)
                {
                    $modelProgramPost->updatePostId($date, $modelProgram->pid);
                    YMessage::setFlash(Ycms::t('program', '添加节目成功'));
                    $this->redirect(array('program/index'));
                }
                else
                {
                    YMessage::setFlash(Ycms::t('program', '添加节目失败，请重新添加'));
                    $this->redirect(array('program/index'));
                }
            }

            $this->render('view', array('model' => $modelProgram, 'num' => $num));
        }

        /**
         *
         * @param type $date
         * @param type $ch_id 
         */
        public function actionUpdate($date, $ch_id)
        {
            
            $modelProgram = $this->loadDaoModel('Program');
            $modelProgramPost = $this->loadDaoModel('ProgramPost');

            if ($this->getPost('add-submit') !== null)
            {
                $add = intval($this->getPost('add'));
                $num = intval($this->getPost('num')) + $add;
                $modelProgram->attributes = $this->getPost('Program');
            }
            else if (($modelProgram->attributes = $this->getPost('Program')) !== null)
            {
                if ($modelProgram->validate() !== false && $modelProgram->updateProgram($date, $ch_id) != false)
                {

                    $modelProgramPost->updatePostId($date, $modelProgram->pid);

                    YMessage::setFlash(Ycms::t('program', '修改节目成功'));
                    $this->redirect(array('program/index'));
                }
            }
            else
            {
                $modelProgram->attributes = $modelProgram->selectProgram($date, $ch_id);
                $modelProgram->pid = $modelProgramPost->selectPostId($date);
                $num = count($modelProgram->program_id);
            }

            $this->render('view', array('model' => $modelProgram, 'num' => $num,'date'=>$date));
        }

        /**
         * 删除某个节目动作
         * @param type $id 
         */
        public function actionDelete($id = '', $date = '')
        {
            $model = $this->loadDaoModel('Program');

            if (!empty($id) && $model->deleteProgramById($id) == true)
            {
                YMessage::setFlash(Ycms::t('program', '删除节目成功'));
                $this->redirect(array('program/index'));
            }

            if (!empty($date) && $model->deleteProgramByDate($date) == true)
            {
                YMessage::setFlash(Ycms::t('program', '删除'.$date.'号节目成功'));
                $this->redirect(array('program/index'));
            }
        }

    }