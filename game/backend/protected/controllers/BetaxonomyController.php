<?php
/**
 * Backend Taxonomy Controller.
 * 
 * @author Tuan Nguyen <nganhtuan63@gmail.com>
 * @version 1.0
 * @package backend.controllers
 *
 */
class BetaxonomyController extends BeController{
    
       
        public function __construct($id,$module=null)
	{
		 parent::__construct($id,$module);
                 $this->menu=array(
                        array('label'=>t('管理分类'), 'url'=>array('admin'),'linkOptions'=>array('class'=>'button')),
                        array('label'=>t('添加分类'), 'url'=>array('create'),'linkOptions'=>array('class'=>'button')),
                );
		 
	}
                 
        /**
	 * The function that do Create new Taxonomy
	 * 
	 */
	public function actionCreate()
	{                
		$this->render('taxonomy_create');
	}
        
       
        
        /**
	 * The function that do Manage Taxonomy
	 * 
	 */
	public function actionAdmin()
	{                
		$this->render('taxonomy_admin');
	}
        
        /**
	 * The function that view Taxonomy details
	 * 
	 */
	public function actionView()
	{         
              $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;
              $this->menu=array_merge($this->menu,                       
                        array(
                            array('label'=>t('修改分类'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('查看分类'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('taxonomy_view');
	}
        
        /**
	 * The function that update Taxonomy
	 * 
	 */
	public function actionUpdate()
	{                
                $id=isset($_GET['id']) ? (int) ($_GET['id']) : 0 ;                
                $this->menu=array_merge($this->menu,                       
                        array(
                                   array('label'=>t('修改分类'), 'url'=>array('update','id'=>$id),'linkOptions'=>array('class'=>'button')),
                            array('label'=>t('查看分类'), 'url'=>array('view','id'=>$id),'linkOptions'=>array('class'=>'button'))
                        )
                    );
		$this->render('taxonomy_update',array('id'=>$id));
	}
        
        
        /**
	 * The function is to Delete Taxonomy
	 * 
	 */
	public function actionDelete($id)
	{                            
             GxcHelpers::deleteModel('Taxonomy', $id);          
	}
                    
}