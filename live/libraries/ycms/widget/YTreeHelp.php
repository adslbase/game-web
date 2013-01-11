<?php

    /**
     * YTreeHelp class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;

    /**
     * 返回树形数据
     * 
     * @version $Id: YTreeHelp.php UTF-8 2011-5-2 18:34:55 li feixiang 
     * @package component
     * @since 1.0
     * 
     */
    class YTreeHelp extends CWidget
    {

        /**
         * 生成树型结构所需要的2维数组
         * @var array
         */
        public $data = array();
        /**
         * 生成树型结构所需修饰符号，可以换成图片
         * @var array
         */
        public $icon = array('│', '├', '└');
        public $nbsp = "&nbsp;";
        /**
         * @access private
         */
        public $ret = '';
        public $htmlOptions;

        /**
         * 构造函数，初始化类
         * @param array 2维数组，例如：
         * array(
         *      1 => array('id'=>'1','parentid'=>0,'name'=>'一级栏目一'),
         *      2 => array('id'=>'2','parentid'=>0,'name'=>'一级栏目二'),
         *      3 => array('id'=>'3','parentid'=>1,'name'=>'二级栏目一'),
         *      4 => array('id'=>'4','parentid'=>1,'name'=>'二级栏目二'),
         *      5 => array('id'=>'5','parentid'=>2,'name'=>'二级栏目三'),
         *      6 => array('id'=>'6','parentid'=>3,'name'=>'三级栏目一'),
         *      7 => array('id'=>'7','parentid'=>3,'name'=>'三级栏目二')
         *      )
         */
        public function init()
        {
            if (isset($this->htmlOptions['id']))
                $id = $this->htmlOptions['id'];
            else
                $id=$this->htmlOptions['id'] = $this->getId();


            echo CHtml::tag('ul', $this->htmlOptions, false, false) . "\n";
            echo self::saveDataAsHtml($this->data);
        }

        public function run()
        {
            echo "</ul>";
        }

        public function saveDataAsHtml($data)
        {
            $html = '';
            if (is_array($data))
            {

                $level = $data[0]['level'];
                foreach ($data as $i =>$node)
                {
                    if ($level < $node['level'])
                    {
                        $html .='<ul>';
                        $html .=CHtml::tag('li', array('id' => 'node_' . $node['menu_id'],'rel'=>$node['type']));
                        $html .= CHtml::link($node['name'],  Ycms::app()->createUrl('link/update', array('mid'=>$node['menu_id'])));
                    }
                    else if ($level == $node['level'])
                    {
                        $html .= '</li>';
                        $html .=CHtml::tag('li', array('id' => 'node_' . $node['menu_id'],'rel'=>$node['type']));
                        
                        if($i==0)
                        {
                            $html .= CHtml::link($node['name'],  Ycms::app()->createUrl('link/list', array('mid'=>$node['menu_id'])));
                        }
                        else
                        {
                            $html .= CHtml::link($node['name'],  Ycms::app()->createUrl('link/update', array('mid'=>$node['menu_id'])));
                        }
                    }
                    else if ($level > $node['level'])
                    {
                        $html .= str_repeat('</li></ul>', $level-$node['level']);
                        $html .=CHtml::tag('li', array('id' => 'node_' . $node['menu_id'],'rel'=>$node['type']));
                        $html .= CHtml::link($node['name'],  Ycms::app()->createUrl('link/update', array('mid'=>$node['menu_id'])));
                    }

                    $level = $node['level'];
                }
            }
            return $html;
        }

    }