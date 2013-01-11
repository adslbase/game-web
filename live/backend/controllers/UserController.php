<?php

class UserController extends BackController
{

        public static function UserMenu()
        {
                $menu['management']['below']['user'] = array(
                        'title' => Ycms::t('user', '用户'),
                        'description'=>  Ycms::t('user', '管理用户，以及权限操作菜单'),
                );
                
                return $menu;
        }

        public function filters()
        {
                return array(
                    'accessControl',
                );
        }

        public function accessRules()
        {
                return array(
                    array('allow',
                        'actions' => array('create'),
                        'roles' => array('createuser'),
                    ),
                    array('deny',
                        'actions' => array('create'),
                    ),
                );
        }

        public static function rules()
        {
                return array(
                    'task' => array(
                        'name' => 'user',
                        'alias' => '用户管理'
                    ),
                    'operation' => array(
                        array(
                            'name' => 'aaaa',
                            'alias' => 'sdfsdf',
                            'pitem' => 'name'
                        ),
                    )
                );
        }

        public function actionIndex()
        {

                $userModel = $this->loadDaoModel('User');

                $users = $userModel->getUsers('user_id,user_name,status,create_time,login_time');

                $dataProvider = new CArrayDataProvider($users, array('keyField' => 'user_id'));

                $this->render('index', array(
                    'dataProvider' => $dataProvider,
                ));
        }

        public function actionCreate()
        {
                $userModel = $this->loadDaoModel('User');

                if (($userModel->attributes = $this->getPost('User')) !== NULL && $userModel->validate() !== false)
                {

                        $userModel->pass = $userModel->hashPassword($userModel->pass);


                        $userId = $userModel->createUser($userModel->attributes);


                        if ($userModel->roles !== '' && $userId !== false)
                        {

                                $authItemModel = $this->loadDaoModel('AuthItem');

                                $authItemModel->assignItems($userModel->roles, $userId);
                        }

                        YMessage::setFlash(Ycms::t('user', '添加用户成功'));

                        $this->redirect(array('index', '#' => 'user'));
                }

                $authItemModel = $this->loadDaoModel('AuthItem');

                $canAssignRoles = $authItemModel->getCanAssignRoles();

                if ($this->getQuery('mode') === 'dialog')
                {
                        $this->layout = '//layouts/nolayout';
                        $this->render('create', array('model' => $userModel, 'canAssignRoles' => $canAssignRoles), false, TRUE);
                }
                else
                {
                        $this->render('create', array('model' => $userModel, 'canAssignRoles' => $canAssignRoles));
                }
        }

        public function actionUpdate($id)
        {

                $userModel = $this->loadDaoModel('User', 'update');

                $oldUser = $userModel->getUser($id, 'user_id,user_name,email,status');

                if (($userModel->attributes = $this->getPost('User')) !== NULL && $userModel->validate() !== false)
                {
                        $fields = array();
                        if ($userModel->pass !== '')
                                $fields['pass'] = $userModel->hashPassword($userModel->pass);

                        $fields['user_name'] = $userModel->name;
                        $fields['email'] = $userModel->email;
                        $fields['status'] = $userModel->status;


                        $userModel->updateUser($oldUser['user_id'], $fields);

                        $authItemModel = $this->loadDaoModel('AuthItem');
                        $authItemModel->revoke($oldUser['user_id']);
                        if ($userModel->roles !== '')
                        {
                                $authItemModel->assignItems($userModel->roles, $oldUser['user_id']);
                        }

                        YMessage::setFlash(Ycms::t('user', '编辑用户成功'));

                        $this->redirect(array('index', '#' => 'user'));
                }



                $userModel->attributes = $oldUser;

                $authItemModel = $this->loadDaoModel('AuthItem');
                $canAssignRoles = $authItemModel->getCanAssignRoles();
                //比不上foreach。。挺耗资源的。给改过来
                $userModel->roles = array_map('array_shift', $authItemModel->getUserItems($oldUser['user_id'], AuthItem::TYPE_ROLE, array('assign' => array('item_id'))));

                $this->render('create', array(
                    'model' => $userModel, 'canAssignRoles' => $canAssignRoles
                ));
        }

}