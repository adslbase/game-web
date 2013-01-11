<?php

    /**
     * YGridView class file.
     *
     * @author li feixiang  <wastorode@gmail.com>
     * @link http://ycms.sinaapp.com/ 
     * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
     * @license http://www.opensource.org/licenses/bsd-license.php
     */
    defined('INYCMS') or die;


    Ycms::import('zii.widgets.grid.CGridView');

    /**
     * 这个类实干什么用的
     * 
     * @version $Id: YGridView.php UTF-8 2011-5-2 19:07:42 li feixiang 
     * @package widget
     * @since 1.0
     * 
     */
    class YGridView extends CGridView
    {

        public $model;
        public $ajaxUpdate = false;
        
        public $topButtons = array();
        public $bottomButtons = array();
        
        public $topSeparator = '<span>|</span>';
        public $bottomSeparator = '';
        
        public $topButtonsCss = 'topButton';
        public $bottomButtonsCss = 'bottomButton';
        
        public $filterTop;


        public $template = "{topbuttons}\n{items}\n{bottombuttons}\n{pager}";

        public function init()
        {
            if ($this->cssFile === null)
                $this->cssFile = YHtml::cssUrl('gridview.css');

            parent::init();
        }

        public function renderTopButtons()
        {

            echo '<div class="ygrid-top clearfix">';
            
            $this->renderTopFilter();
            $this->renderButtons($this->topButtons, $this->topButtonsCss, $this->topSeparator);
            
            echo '</div>';
        }

        public function renderTopFilter()
        {
            echo '<div class="f-right">';
            
            
            
            echo '</div>';
        }

        public function renderBottomButtons()
        {
            $this->renderButtons($this->bottomButtons, $this->bottomButtonsCss, $this->bottomSeparator, 'button');
        }

        public function renderButtons($buttons, $holderCss, $separator='', $element ='tag')
        {

            if ($buttons !== array())
            {

                echo "<div class=\"$holderCss\">\n";

                $i = 0;

                $total = count($buttons);

                foreach ($buttons as $button)
                {

                    if ($element !== 'tag')
                    {

                        echo call_user_func_array(array('YHtml', $element), $button);
                    }
                    else
                    {

                        $tag = array_shift($button);

                        echo call_user_func_array(array('YHtml', $tag), $button);
                    }

                    $i++;

                    if ($total !== $i)
                        echo $separator;
                }

                echo "</div>";
            }
        }

    }