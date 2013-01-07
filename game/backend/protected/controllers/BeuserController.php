<?php
/**
 * Backend User Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.controllers
 *
 */
class BeuserController extends BeController{
    
       
        public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        array('label'=>t('管理用户'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
                        array('label'=>t('创建用户'), 'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
                );
		 
	}
         /**
	 * The function that do Change Password
	 * 
	 */
	public function actionChangePass()
	{                
                $this->menu=array();                        
                $this->render('user_change_pass');
	}
        
        /**
	 * The function that do Update Settings 
	 * 
	 */
	public function actionUpdateSettings()
	{        
                $this->menu=array();                        
		$this->render('user_update_settings');
	}
        
        /**
	 * The function that do Create new User
	 * 
	 */
	public function actionCreate()
	{                
		$this->render('user_create');
	}
        
        /**
	 * The function that do Manage User
	 * 
	 */
	public function actionAdmin()
	{                
		$this->render('user_admin');
	}
        
        /**
	 * The function that do View User
	 * 
	 */
	public function actionView()
	{         
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
              $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('修改用户'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('查看用户'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('user_view');
	}
        
        /**
	 * The function that do Update User
	 * 
	 */
	public function actionUpdate()
	{                
                $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
                
                $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('修改用户'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('查看用户'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('user_update');
	}
        
        /**
	 * The function is to Delete a User
	 * 
	 */
	public function actionDelete($id)
	{                            
            GxcHelpers::deleteModel('User', $id);
	}
                    
}