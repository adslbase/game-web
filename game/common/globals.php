<?php

/**
 * This is the shortcut to DIRECTORY_SEPARATOR
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

/**
 * This is the shortcut to Yii::app()
 */
function app() {
        return Yii::app();
}

/**
 * This is the shortcut to Yii::app()->clientScript
 */
function cs() {
        // You could also call the client script instance via Yii::app()->clientScript
        // But this is faster
        return Yii::app()->getClientScript();
}

/**
 * This is the shortcut to Yii::app()->user.
 */
function user() {
        return Yii::app()->getUser();
}

/**
 * This is the shortcut to Yii::app()->createUrl()
 */
function url($route, $params = array(), $ampersand = '&') {
        return Yii::app()->createUrl($route, $params, $ampersand);
}

/**
 * This is the shortcut to CHtml::encode
 */
function h($text) {
        return htmlspecialchars($text, ENT_QUOTES, Yii::app()->charset);
}

/**
 * Set the key, value in Session
 * @param object $key
 * @param object $value
 * @return boolean 
 */
function setSession($key, $value) {
        return Yii::app()->getSession()->add($key, $value);
}

/**
 * Get the value from key in Session
 * @param object $key
 *
 * @return object
 */
function getSession($key) {
        return Yii::app()->getSession()->get($key);
}

/**
 * This is the shortcut to CHtml::link()
 */
function l($text, $url = '#', $htmlOptions = array()) {
        return CHtml::link($text, $url, $htmlOptions);
}

/**
 * This is the shortcut to Yii::t() with default category = 'stay'
 */
function t($message, $category = 'cms', $params = array(), $source = null, $language = null) {
        return Yii::t($category, $message, $params, $source, $language);
}

/**
 * This is the shortcut to Yii::app()->request->baseUrl
 * If the parameter is given, it will be returned and prefixed with the app baseUrl.
 */
function bu($url = null) {
        static $baseUrl;
        if ($baseUrl === null)
                $baseUrl = Yii::app()->getRequest()->getBaseUrl();
        return $url === null ? $baseUrl : $baseUrl . '/' . ltrim($url, '/');
}

/**
 * Get the right image of the current layout
 * 
 */
function img($image, $layout = '') {
        return $image;
}

/**
 * Returns the named application parameter.
 * This is the shortcut to Yii::app()->params[$name].
 */
function param($name) {
        return Yii::app()->params[$name];
}

/**
 * Return the settings Component
 * @return type 
 */
function settings() {
        return Yii::app()->settings;
}

/**
 * var_dump($varialbe) and exit
 * 
 */
function dump($a) {
        var_dump($a);
        exit;
}

/**
 * Get extension of a file
 * 
 */
function getExt($filename) {
        return strtolower(substr(strrchr($fileName, '.'), 1));
}

/**
 * Get the current IP of the connection
 * 
 */
function ip() {
        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
                $ip = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
                $ip = getenv('REMOTE_ADDR');
        } elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
                $ip = $_SERVER['REMOTE_ADDR'];
        }
        return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
}

/**
 * Generate Unique File Name for the File Upload
 * 
 */
function gen_uuid($len = 8) {

        $hex = md5(param('salt-file') . uniqid("", true));

        $pack = pack('H*', $hex);
        $tmp = base64_encode($pack);

        $uid = preg_replace("/[^A-Za-z0-9]/", "", $tmp);

        $len = max(4, min(128, $len));

        while (strlen($uid) < $len)
                $uid .= gen_uuid(22);

        $res = substr($uid, 0, $len);
        return $res;
}

function get_subfolders_name($path, $file = false) {

        $list = array();
        $results = scandir($path);
        foreach ($results as $result) {
                if ($result === '.' or $result === '..' or $result === '.svn')
                        continue;
                if (!$file) {
                        if (is_dir($path . '/' . $result)) {
                                $list[] = trim($result);
                        }
                } else {
                        if (is_file($path . '/' . $result)) {
                                $list[] = trim($result);
                        }
                }
        }

        return $list;
}

function InternetCombineUrl($absolute, $relative) {
        if (substr($absolute, strlen($absolute) - 1) != '/') {
                $absolute.='/';
        }
        $p = parse_url($relative);
        if (isset($p["scheme"]))
                return $relative;

        extract(parse_url($absolute));

        //$path = dirname($path); 


        if ($relative{0} == '/') {
                $cparts = array_filter(explode("/", $relative));
        } else {
                $aparts = array_filter(explode("/", $path));
                $rparts = array_filter(explode("/", $relative));
                $cparts = array_merge($aparts, $rparts);
                foreach ($cparts as $i => $part) {
                        if ($part == '.') {
                                $cparts[$i] = null;
                        }
                        if ($part == '..') {
                                $cparts[$i - 1] = null;
                                $cparts[$i] = null;
                        }
                }
                $cparts = array_filter($cparts);
        }

        $path = implode("/", $cparts);
        $url = "";
        if (isset($scheme)) {
                $url = "$scheme://";
        }

        if (isset($host)) {
                $url .= "$host/";
        }
        $url .= $path;
        return $url;
}

function rel2abs($rel, $base) {
        /* return if already absolute URL */
        if (parse_url($rel, PHP_URL_SCHEME) != '')
                return $rel;

        /* queries and anchors */
        if ($rel[0] == '#' || $rel[0] == '?')
                return $base . $rel;

        /* parse base URL and convert to local variables:
          $scheme, $host, $path */
        extract(parse_url($base));

        /* remove non-directory element from path */
        $path = preg_replace('#/[^/]*$#', '', $path);

        /* destroy path if relative url points to root */
        if ($rel[0] == '/')
                $path = '';

        /* dirty absolute URL */
        $abs = "$host$path/$rel";

        /* replace '//' or '/./' or '/foo/../' with '/' */
        $re = array('#(/\.?/)#', '#/(?!\.\.)[^/]+/\.\./#');
        for ($n = 1; $n > 0; $abs = preg_replace($re, '/', $abs, -1, $n)) {
                
        }

        /* absolute URL is ready! */
        return $scheme . '://' . $abs;
}

function stripVietnamese($str) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ứ|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach ($unicode as $nonUnicode => $uni) {
                $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
}

function toSlug($string, $force_lowercase = true, $anal = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            "â€”", "â€“", ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "-", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        return ($force_lowercase) ?
                (function_exists('mb_strtolower')) ?
                        mb_strtolower($clean, 'UTF-8') :
                        strtolower($clean)  :
                $clean;
}

function clean($var) {
        return trim(strip_tags($var));
}

function fn_clean_input($data) {
        if (defined('QUOTES_ENABLED')) {
                $data = fn_strip_slashes_deep($data);
        }

        return $data;
}

function fn_strip_slashes_deep($data) {
        $data = is_array($data) ?
                array_map('fn_strip_slashes_deep', $data) :
                stripslashes($data);

        return $data;
}

function hashPassword($password, $salt) {
        return md5($password . $salt);
}

function get_youtube_id($url, $need_curl = true) {
        $url_modified = strtolower(str_replace('www.', '', $url));
        if (strpos($url_modified, 'http://youtube.com') !== false) {
                parse_str(parse_url($url, PHP_URL_QUERY));

                /** end split the query string into an array* */
                if (!isset($v))
                        return false; //fast fail for links with no v attrib - youtube only

                if ($need_curl) {
                        $checklink = 'http://gdata.youtube.com/feeds/api/videos/' . $v;


                        //** curl the check link ***//
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $checklink);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                        $result = curl_exec($ch);
                        curl_close($ch);

                        $return = $v;
                        if (trim($result) == "Invalid id")
                                $return = false; //you tube response
                        return $return; //the stream is a valid youtube id.
                }

                return $v;
        }

        return false;
}

function recursive_remove_directory($directory, $empty = FALSE) {
        // if the path has a slash at the end we remove it here
        if (substr($directory, -1) == '/') {
                $directory = substr($directory, 0, -1);
        }

        // if the path is not valid or is not a directory ...
        if (!file_exists($directory) || !is_dir($directory)) {
                // ... we return false and exit the function
                return FALSE;

                // ... if the path is not readable
        } elseif (!is_readable($directory)) {
                // ... we return false and exit the function
                return FALSE;

                // ... else if the path is readable
        } else {

                // we open the directory
                $handle = opendir($directory);

                // and scan through the items inside
                while (FALSE !== ($item = readdir($handle))) {
                        // if the filepointer is not the current directory
                        // or the parent directory
                        if ($item != '.' && $item != '..') {
                                // we build the new path to delete
                                $path = $directory . '/' . $item;

                                // if the new path is a directory
                                if (is_dir($path)) {
                                        // we call this function with the new path
                                        recursive_remove_directory($path);

                                        // if the new path is a file
                                } else {
                                        // we remove the file
                                        unlink($path);
                                }
                        }
                }
                // close the directory
                closedir($handle);

                // if the option to empty is not set to true
                if ($empty == FALSE) {
                        // try to delete the now empty directory
                        if (!rmdir($directory)) {
                                // return false if not possible
                                return FALSE;
                        }
                }
                // return success
                return TRUE;
        }
}

function isConsoleApp() {
        return get_class(Yii::app()) == 'CConsoleApplication';
}

function replaceTags($startPoint, $endPoint, $newText, $source) {
        return preg_replace('#(' . preg_quote($startPoint) . ')(.*)(' . preg_quote($endPoint) . ')#si', '${1}' . $newText . '${3}', $source);
}

/**
 * ucenter 通信认证 未使用驼峰 方便以后修改
 * @param type $string
 * @param type $operation
 * @param type $key
 * @param type $expiry
 * @return string 
 */
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {

        $ckey_length = 4;

        $key = md5($key ? $key : UC_KEY);
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
                $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for ($j = $i = 0; $i < 256; $i++) {
                $j = ($j + $box[$i] + $rndkey[$i]) % 256;
                $tmp = $box[$i];
                $box[$i] = $box[$j];
                $box[$j] = $tmp;
        }

        for ($a = $j = $i = 0; $i < $string_length; $i++) {
                $a = ($a + 1) % 256;
                $j = ($j + $box[$a]) % 256;
                $tmp = $box[$a];
                $box[$a] = $box[$j];
                $box[$j] = $tmp;
                $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if ($operation == 'DECODE') {
                if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                        return substr($result, 26);
                } else {
                        return '';
                }
        } else {
                return $keyc . str_replace('=', '', base64_encode($result));
        }
}

/**
 * 生成流水号
 */
function create_sn() {
        mt_srand((double) microtime() * 1000000);
        return date("YmdHis") . str_pad(mt_rand(1, 99999), 5, "0", STR_PAD_LEFT);
}

function unserialize_config($cfg) {
        if (is_string($cfg)) {
                $arr = string2array($cfg);
                $config = array();
                foreach ($arr AS $key => $val) {
                        $config[$key] = $val['value'];
                }
                return $config;
        } else {
                return false;
        }
}



/**
 * 返回订单手续费
 * @param  $amount 订单价格
 * @param  $fee 手续费比率
 * @param  $method 手续费方式
 */
function pay_fee($amount, $fee = 0, $method = 0) {
        $pay_fee = 0;
        if ($method == 0) {
                $val = floatval($fee) / 100;
                $pay_fee = $val > 0 ? $amount * $val : 0;
        } elseif ($method == 1) {
                $pay_fee = $fee;
        }
        return round($pay_fee, 2);
}


function shortDate($date) {
        list($year, $sdate) = explode('-', $date, 2);
        return $sdate;
}

function str_cut($string, $length, $dot = '...') {
        $strlen = strlen($string);
        if ($strlen <= $length)
                return $string;
        $string = str_replace(array(' ', '&nbsp;', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), array('∵', ' ', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), $string);
        $strcut = '';
        $length = intval($length - strlen($dot) - $length / 3);
        $n = $tn = $noc = 0;
        while ($n < strlen($string)) {
                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                        $tn = 1;
                        $n++;
                        $noc++;
                } elseif (194 <= $t && $t <= 223) {
                        $tn = 2;
                        $n += 2;
                        $noc += 2;
                } elseif (224 <= $t && $t <= 239) {
                        $tn = 3;
                        $n += 3;
                        $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                        $tn = 4;
                        $n += 4;
                        $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                        $tn = 5;
                        $n += 5;
                        $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                        $tn = 6;
                        $n += 6;
                        $noc += 2;
                } else {
                        $n++;
                }
                if ($noc >= $length) {
                        break;
                }
        }
        if ($noc > $length) {
                $n -= $tn;
        }
        $strcut = substr($string, 0, $n);
        $strcut = str_replace(array('∵', '&', '"', "'", '“', '”', '—', '<', '>', '·', '…'), array(' ', '&amp;', '&quot;', '&#039;', '&ldquo;', '&rdquo;', '&mdash;', '&lt;', '&gt;', '&middot;', '&hellip;'), $strcut);

        return $strcut . $dot;
}

?>