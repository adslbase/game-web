<?php

        class BepayController extends BeController
        {

                public function actionIndex()
                {
                        $payway = Payway::model();

                        $temp = $payway->getPayways();

                        foreach ($temp as $value)
                        {
                                $rawData[] = $value;
                        }

                        $dataProvider = new CArrayDataProvider($rawData, array(
                                                    'keyField' => 'pay_id',
                                                    'pagination' => array(
                                                                'pageSize' => 50,
                                                    ),
                                        ));

                        $this->render('index', array('dataProvider' => $dataProvider));
                }

                /*
                 * 增加支付模块
                 */

                public function actionAdd($id)
                {
                        $payway = Payway::model();

                        if (isset($_POST['Payway']) === true)
                        {
                                $payway->attributes = $_POST['Payway'];
                                $payway->config = var_export($_POST['Payway']['config'], TRUE);
                                $payway->isNewRecord = TRUE;
                                if ($payway->save())
                                {
                                        $this->redirect($this->createUrl('bepay/index'));
                                }
                        }
                        $payway->attributes = $payway->getPayways($id);

                        $render_template = 'common.payway.' . strtolower($payway->class) . '.pay_form_widget';

                        $this->render($render_template, array('model' => $payway));
                }

                /*
                 * 编辑支付模块
                 */

                public function actionEdit($id)
                {

                        $payway = Payway::model();
                        if (isset($_POST['Payway']) === true)
                        {

                                $payway->attributes = $_POST['Payway'];

                                $payway->config = var_export($_POST['Payway']['config'], TRUE);

                                if ($payway->save())
                                {
                                        user()->setFlash('success', t('修改支付方式成功!'));
                                        $this->redirect($this->createUrl('bepay/index'));
                                }
                        }

                        $payway = $payway->find('class = :id', array(':id' => $id));

                        if (!empty($payway->config))
                        {
                                eval('$config = ' . $payway->config . ';');
                                $payway->config = $config;
                        }

                        $render_template = 'common.payway.' . strtolower($payway->class) . '.pay_form_widget';

                        $this->render($render_template, array('model' => $payway));
                }

                /**
                 * 卸载支付模块
                 */
                public function actionDisable($id)
                {
                        $result = Yii::app()->getDb()->createCommand()->update('{{payway}}', array('enabled' => 0), 'class=:id', array(':id' => $id));
                        if ($result)
                        {
                                user()->setFlash('success', t('禁用支付方式成功!'));
                                $this->redirect($this->createUrl('bepay/index'));
                        }
                }

                /**
                 * 卸载支付模块
                 */
                public function actionEnable($id)
                {
                        $result = Yii::app()->getDb()->createCommand()->update('{{payway}}', array('enabled' => 1), 'class=:id', array(':id' => $id));
                        if ($result)
                        {
                                user()->setFlash('success', t('启用支付方式成功!'));
                                $this->redirect($this->createUrl('bepay/index'));
                        }
                }

           

        }

?>