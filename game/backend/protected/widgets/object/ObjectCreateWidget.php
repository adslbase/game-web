<?php

        /**
         * This is the Widget for create new Content.
         * 
         * @author lifeixiang <250994229@qq.com>
         * @version 1.0
         * @package  backwidgets.object
         *
         */
        class ObjectCreateWidget extends CWidget
        {

                public $visible = true;

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


                        //Get some pre value from URL
                        //The type of the content we want to create
                        $type = isset($_GET['type']) ? strtolower(trim($_GET['type'])) : '';

                        //Get the list of Content Type
                        $types = GxcHelpers::getAvailableContentType();

                        //Available Terms for this Object Type
                        $terms = array();

                        //Selected Terms
                        $selected_terms = array();

                        //If $type is empty then redirect to choose content type page
                        if ($type != '')
                        {

                                //Check if the type appear in content type Definition
                                if (array_key_exists($type, $types))
                                {
                                        //Import the Content Type Class
                                        Yii::import('common.content_type.' . $type . '.' . $types[$type]['class']);

                                        //Init the class
                                        $typeClassObj = new $types[$type]['class'];

                                        $content_resources = $typeClassObj->Resources();

                                        //We start to implement the checking Permission HERE
                                        $param_content_check = array();
                                        $data_content_check = array();
                                        $param_content_check['type'] = $type;


                                        if (GxcContentPermission::checkCreatePermission($param_content_check, $data_content_check, $typeClassObj->Permissions()))
                                        {


                                                $param_content_check['new_content'] = true;

                                                $content_status = GxcContentPermission::getContentStatus($param_content_check, $data_content_check, $typeClassObj->Permissions());

                                                $model = new $types[$type]['class'];
                                                // Uncomment the following line if AJAX validation is needed
                                                // $this->performAjaxValidation($model);
                                                $model->object_date = date('Y-m-d H:i:s');

                                                //Get available Taxonomy and Terms for this Object
                                                $available_taxonomy = Taxonomy::model()->findAll(' type = :type ', array(':type' => $type));
                                                if ($available_taxonomy)
                                                {
                                                        foreach ($available_taxonomy as $t)
                                                        {
                                                                $temp = array();
                                                                $temp['id'] = $t->taxonomy_id;
                                                                $temp['name'] = $t->name;
                                                                $temp['terms'] = array();


                                                                //Look for the Term Items belong to this Taxonomy
                                                                $list_terms = Term::model()->findAll(
                                                                                array(
                                                                                            'select' => '*',
                                                                                            'condition' => 'taxonomy_id=:id',
                                                                                            'order' => 't.parent ASC, t.order ASC',
                                                                                            'params' => array(':id' => $t->taxonomy_id)
                                                                                ));
                                                                if ($list_terms)
                                                                {
                                                                        foreach ($list_terms as $term)
                                                                        {
                                                                                $temp_item['id'] = $term->term_id;
                                                                                $temp_item['name'] = CHtml::encode($term->name);
                                                                                $temp_item['parent'] = $term->parent;

                                                                                $temp['terms']['item_' . $term->term_id] = $temp_item;
                                                                        }
                                                                }

                                                                $terms[$t->taxonomy_id] = $temp;
                                                        }
                                                }

                                                if (isset($_POST[$types[$type]['class']]))
                                                {

                                                        $model->attributes = $_POST[$types[$type]['class']];

                                                        //Convert the date time publish to timestamp
                                                        $model->object_date = strtotime($model->object_date);

                                                        // Get the Terms that the User Choose
                                                        //
                                $post_terms = isset($_POST['terms']) ? $_POST['terms'] : array();
                                                        $selected_terms = array();
                                                        if (!empty($post_terms))
                                                        {
                                                                foreach ($post_terms as $t)
                                                                {
                                                                        $t = explode('_', $t);
                                                                        if (!isset($selected_terms[$t[1]]))
                                                                        {
                                                                                $selected_temp = array();
                                                                                $selected_temp['id'] = $terms[$t[1]]['id'];
                                                                                $selected_temp['name'] = $terms[$t[1]]['name'];

                                                                                $selected_temp['terms']['item_' . $t[0]]['id'] = $t[0];
                                                                                $selected_temp['terms']['item_' . $t[0]]['name'] = $terms[$t[1]]['terms']['item_' . $t[0]]['name'];
                                                                                $selected_temp['terms']['item_' . $t[0]]['parent'] = $terms[$t[1]]['terms']['item_' . $t[0]]['parent'];

                                                                                $selected_terms[$t[1]] = $selected_temp;
                                                                        }
                                                                        else
                                                                        {
                                                                                if (!isset($selected_terms['terms']['item_' . $t[0]]))
                                                                                {
                                                                                        $selected_terms[$t[1]]['terms']['item_' . $t[0]]['id'] = $t[0];
                                                                                        $selected_terms[$t[1]]['terms']['item_' . $t[0]]['name'] = $terms[$t[1]]['terms']['item_' . $t[0]]['name'];
                                                                                        $selected_terms[$t[1]]['terms']['item_' . $t[0]]['parent'] = $terms[$t[1]]['terms']['item_' . $t[0]]['parent'];
                                                                                }
                                                                        }
                                                                }
                                                        }


                                                        // After having the selected Terms, we need to make sure  all parents
                                                        // of the selected Terms must be added also                                                               
                                                        foreach ($selected_terms as $tx_key => $t)
                                                        {

                                                                $array_parent_selected_terms = array();

                                                                foreach ($t['terms'] as $key => $st_terms)
                                                                {
                                                                        $current_term = $st_terms;
                                                                        while ($current_term['parent'] != 0)
                                                                        {

                                                                                if ((!isset($array_parent_selected_terms['item_' . $current_term['parent']])) && (
                                                                                                !isset($t['terms']['item_' . $current_term['parent']])
                                                                                                ))
                                                                                {
                                                                                        $array_parent_selected_terms['item_' . $current_term['parent']] = $terms[$tx_key]['terms']['item_' . $current_term['parent']];
                                                                                }

                                                                                $current_term = $terms[$tx_key]['terms']['item_' . $current_term['parent']];
                                                                        }
                                                                }

                                                                $selected_terms[$tx_key]['terms'] = CMap::mergeArray($t['terms'], $array_parent_selected_terms);
                                                        }



                                           

                                                        if ($model->save())
                                                        {
                                                                user()->setFlash('success', t('发布内容成功！'));


                                                                // We have all the selected Terms for now
                                                                // We will add them to Object Terms
                                                                foreach ($selected_terms as $tx_key => $t)
                                                                {
                                                                        foreach ($t['terms'] as $key => $st_terms)
                                                                        {

                                                                                $obj_term = new ObjectTerm();
                                                                                $obj_term->object_id = $model->object_id;
                                                                                $obj_term->term_id = $st_terms['id'];
                                                                                $obj_term->save();
                                                                                unset($obj_term);
                                                                        }
                                                                }


                                                                //Re-init new Model
                                                                $model = new $types[$type]['class'];
                                                                $model->object_date = date('Y-m-d H:i:s');

                                                                Yii::app()->controller->refresh();
                                                        }
                                                        else
                                                        {
                                                                $model->object_date = date('Y-m-d H:i:s', $model->object_date);
                                                        }
                                                }

                                                $render_template = 'backwidgets.views.object.object_form_widget';

                                                if (file_exists(Yii::getPathOfAlias('common.content_type.' . strtolower($type) . '.object_form_widget') . '.php'))
                                                {
                                                        $render_template = 'common.content_type.' . strtolower($type) . '.object_form_widget';
                                                }

                                                $this->render($render_template, array('model' => $model,
                                                            'content_status' => $content_status,
                                                            'terms' => $terms,
                                                            'selected_terms' => $selected_terms,
                                                            'type' => $type,
                                                            'content_resources' => $content_resources
                                                ));
                                        }
                                }
                                else
                                {

                                        //The type is not in Content Type Definition
                                        $this->render('backwidgets.views.object.object_start_widget', array('types' => $types));
                                }
                        }
                        else
                        {

                                //There is no Type in $_GET
                                $this->render('backwidgets.views.object.object_start_widget', array('types' => $types));
                        }
                }

        }

        