<?php

/**
 * This is the Widget for create new User.
 * 
 * @author lifeixiang <250994229@qq.com>
 * @version 1.0
 * @package backwidgets.user
 *
 */
class UserCreateWidget extends CWidget
{
    
    public $visible=true; 
 
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
                                      
        $model=new UserCreateForm;

        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='usercreate-form')
        {
                echo CActiveForm::validate($model);
                Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['UserCreateForm']))
        {
                $model->attributes=$_POST['UserCreateForm'];

                // validate user input password
                if($model->validate()){
                    
                        $new_user = new User;
                        $new_user->scenario='create';
                        $new_user->username=$model->username;
                        $new_user->email=$model->email;
                        $new_user->realname=$model->realname;
                        $new_user->sfzh=$model->sfzh;      
                        $new_user->password=$model->password;    
                        if($new_user->save()){
                            user()->setFlash('success',t('创建用户成功!'));                                        
                        }
                        
                        $model= new UserCreateForm;
                        Yii::app()->controller->redirect(array('create'));

                }
        }

        $this->render('backwidgets.views.user.user_create_widget',array('model'=>$model));
    }   
}
