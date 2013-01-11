<?php

    defined('INYCMS') or die;

    /**
     * 公共函数库
     * 
     * @version $Id: global.func.php UTF-8 2011-5-19 5:28:26 li feixiang
     * @package ycms
     * @since 1.0
     * 
     */

    /**
     * php内置的比较函数，会把二维数组转换为string。如果是数组比较，结果就是Array===Array，起不到作用
     * @param type $a1
     * @param type $a2
     * @return type 
     */
    function arrayDiffAssoc($a1, $a2)
    {
        $r = array();

        foreach ($a1 as $key => $value)
        {
            if (isset($a2[$key]))
            {
                if ($value !== $a2[$key])
                {
                    $r[$key] = $value;
                }
            }
            else
            {
                $r[$key] = $value;
            }
        }
        return $r;
    }



?>