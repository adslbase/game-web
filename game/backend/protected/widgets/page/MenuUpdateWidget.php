<?php

/**
 * This is the Widget for Updating Menu
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package  backwidgets.object
 *
 */
class MenuUpdateWidget extends CWidget
{
    
    public $visible=true; 
    
    public $form_create_term_url='';
    public $form_update_term_url='';
    public $form_change_order_term_url='';
    public $form_delete_term_url='';
 
    public function init()
    {
        
    }
 
    public function run()
    {
        if($this->visible)
        {
            $this->renderContent();
        }
    }
 
    protected function renderContent()
    {       
        $id=isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $model=  GxcHelpers::loadDetailModel('Menu', $id);
     
        $list_items=array();
        
        //Look for the Term Items belong to this Taxonomy
        $list_menu_items=MenuItem::model()->findAll(
                 array(
                     'select'=>'*',
                     'condition'=>'menu_id=:id',
                     'order'=>'t.parent ASC, t.order ASC',
                     'params'=>array(':id'=>$id)
                 ));
        if($list_menu_items){
            foreach($list_menu_items as $menu_item) {                
                $temp_item['id']=$menu_item->menu_item_id;
                $temp_item['name']=CHtml::encode($menu_item->name);
                $temp_item['parent']=$menu_item->parent;                
                //Add Item here to make sure Chrome not change the order of Json Object
                $list_items['item_'.$menu_item->menu_item_id]=$temp_item;
            }
        }

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='menu-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['Menu']))
        {
                $model->attributes=$_POST['Menu'];                        
                if($model->save()){                            
                    user()->setFlash('success',t('修改菜单成功!'));                                                           
                }
        }

        $this->render('backwidgets.views.menu.menu_form_widget',array('model'=>$model,
                        'list_items'=>$list_items
            ));            
        
        
          
    }   
}
