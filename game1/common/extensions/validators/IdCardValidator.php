<?php

        /**
         * CCompareValidator class file.
         *
         * @author Qiang Xue <qiang.xue@gmail.com>
         * @link http://www.yiiframework.com/
         * @copyright Copyright &copy; 2008-2011 Yii Software LLC
         * @license http://www.yiiframework.com/license/
         */

        /**
         * CCompareValidator compares the specified attribute value with another value and validates if they are equal.
         *
         * The value being compared with can be another attribute value
         * (specified via {@link compareAttribute}) or a constant (specified via
         * {@link compareValue}. When both are specified, the latter takes
         * precedence. If neither is specified, the attribute will be compared
         * with another attribute whose name is by appending "_repeat" to the source
         * attribute name.
         *
         * The comparison can be either {@link strict} or not.
         *
         * CCompareValidator supports different comparison operators.
         * Previously, it only compares to see if two values are equal or not.
         *
         * When using the {@link message} property to define a custom error message, the message
         * may contain additional placeholders that will be replaced with the actual content. In addition
         * to the "{attribute}" placeholder, recognized by all validators (see {@link CValidator}),
         * CCompareValidator allows for the following placeholders to be specified:
         * <ul>
         * <li>{compareValue}: replaced with the constant value being compared with {@link compareValue}.</li>
         * </ul>
         *
         * @author Qiang Xue <qiang.xue@gmail.com>
         * @version $Id$
         * @package system.validators
         * @since 1.0
         */
        class IdCardValidator extends CValidator
        {

                /**
                 * Validates the attribute of the object.
                 * If there is any error, the error message is added to the object.
                 * @param CModel $object the object being validated
                 * @param string $attribute the attribute being validated
                 */
                protected function validateAttribute($object, $attribute)
                {
                     
                        $value = $object->$attribute;
                        if ($this->check_id($value) == FALSE)
                        {
                                $message = '身份证不合法！';
                               $this->addError($object, $attribute, $message);
                        }
                        
                         
                }

                /* /
                  # 函数功能：计算身份证号码中的检校码
                  # 函数名称：$this->idcard_verify_number
                  # 参数表 ：string $$this->idcard_base 身份证号码的前十七位
                  # 返回值 ：string 检校码
                  # 更新时间：Fri Mar 28 09:50:19 CST 2008
                  / */

                public function idcard_verify_number($idcard_base)
                {
                        if (strlen($idcard_base) != 17)
                        {
                                return false;
                        }
                        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2); //debug 加权因子
                        $verify_number_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'); //debug 校验码对应值
                        $checksum = 0;
                        for ($i = 0; $i < strlen($idcard_base); $i++)
                        {
                                $checksum += substr($idcard_base, $i, 1) * $factor[$i];
                        }
                        $mod = $checksum % 11;
                        $verify_number = $verify_number_list[$mod];
                        return $verify_number;
                }

                /* /
                  # 函数功能：将15位身份证升级到18位
                  # 函数名称：$this->idcard_15to18
                  # 参数表 ：string $idcard 十五位身份证号码
                  # 返回值 ：string
                  # 更新时间：Fri Mar 28 09:49:13 CST 2008
                  / */

                public function idcard_15to18($idcard)
                {
                        if (strlen($idcard) != 15)
                        {
                                return false;
                        }
                        else
                        {// 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
                                if (array_search(substr($idcard, 12, 3), array('996', '997', '998', '999')) !== false)
                                {
                                        $idcard = substr($idcard, 0, 6) . '18' . substr($idcard, 6, 9);
                                }
                                else
                                {
                                        $idcard = substr($idcard, 0, 6) . '19' . substr($idcard, 6, 9);
                                }
                        }
                        $idcard = $idcard . $this->idcard_verify_number($idcard);
                        return $idcard;
                }

                /* /
                  # 函数功能：18位身份证校验码有效性检查
                  # 函数名称：$this->idcard_checksum18
                  # 参数表 ：string $idcard 十八位身份证号码
                  # 返回值 ：bool
                  # 更新时间：Fri Mar 28 09:48:36 CST 2008
                  / */

                public function idcard_checksum18($idcard)
                {
                        if (strlen($idcard) != 18)
                        {
                                return false;
                        }
                        $idcard_base = substr($idcard, 0, 17);
                        if ($this->idcard_verify_number($idcard_base) != strtoupper(substr($idcard, 17, 1)))
                        {
                                return false;
                        }
                        else
                        {
                                return true;
                        }
                }

                /* /
                  # 函数功能：身份证号码检查接口函数
                  # 函数名称：check_id
                  # 参数表 ：string $idcard 身份证号码
                  # 返回值 ：bool 是否正确
                  # 更新时间：Fri Mar 28 09:47:43 CST 2008
                  / */

                public function check_id($idcard)
                {
                        if (strlen($idcard) == 15 || strlen($idcard) == 18)
                        {
                                if (strlen($idcard) == 15)
                                {
                                        $idcard = $this->idcard_15to18($idcard);
                                }
                                if ($this->idcard_checksum18($idcard))
                                {
                                        return true;
                                }
                                else
                                {
                                        return false;
                                }
                        }
                        else
                        {
                                return false;
                        }
                }

        }

        