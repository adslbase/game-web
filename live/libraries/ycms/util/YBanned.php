<?php

    class YBanned
    {

        /**
         * 例如： array('127.0.0.1', '::1')
         */
        public $ipFilters = array();
        public $ipAllow = array();
        public $countryAllow = array();
        public $countryFilters = array();
        private static $_geoIp;

        public function __construct($data)
        {
            $keys = array('ipFilters', 'ipAllow', 'countryAllow', 'countryFilters');

            foreach ($data as $key => $value)
            {
                if (in_array($key, $keys))
                {
                    $this->$key = $value;
                }
            }
        }

        public function allowClient($ip = '')
        {
            if (empty($ip))
                $ip = $this->ipAddress();
            
            if ($this->allowIp($ip) === TRUE)
                return TRUE;

            if ($this->allowCountry($ip) === TRUE)
                return TRUE;

            return FALSE;
        }

        /**
         * 获取请求ip  如果有多个HttpRequest相关方法，可以整合进入类中使用
         *
         * @return ip地址
         */
        public function ipAddress()
        {
            if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
            {
                $ip = getenv('HTTP_CLIENT_IP');
            }
            elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
            {
                $ip = getenv('HTTP_X_FORWARDED_FOR');
            }
            elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
            {
                $ip = getenv('REMOTE_ADDR');
            }
            elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
            {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '';
        }

        /**
         * Checks to see if the user IP is allowed by {@link ipFilters}.
         * @param string $ip the user IP
         * @return boolean whether the user IP is allowed by {@link ipFilters}.
         */
        protected function allowIp($ip)
        {
            if (!empty($this->ipFilters))
            {
                foreach ($this->ipFilters as $filter)
                {
                    if ($filter === '*' || $filter === $ip || (($pos = strpos($filter, '*')) !== false && !strncmp($ip, $filter, $pos)))
                        return FALSE;
                }
            }

            if (!empty($this->ipAllow))
            {
                foreach ($this->ipAllow as $allow)
                {
                    if ($allow === '*' || $allow === $ip || (($pos = strpos($allow, '*')) !== false && !strncmp($ip, $allow, $pos)))
                        return TRUE;
                }
            }

            return false;
        }

        public function getGeoIP()
        {
            if (!empty($this->_geoIp))
                return $this->_geoIp;

            Ycms::import('ycms.vendors.geoip.Net.Net_GeoIP');
            $this->_geoIp = Net_GeoIP::getInstance(YPATH_YCMS . DS . 'vendors' . DS . 'geoip' . DS . 'data' . DS . 'GeoIP.dat');

            return $this->_geoIp;
        }

        protected function allowCountry($ip)
        {
            $geoip = $this->getGeoIP();

            if(empty($ip))
            {
                return TRUE;
            }
            
            $country_code = $geoip->lookupCountryCode($ip);
            if (!empty($this->countryFilters) && in_array($country_code, $this->countryFilters))
                return FALSE;

            if (!empty($this->countryAllow) && in_array($country_code, $this->countryAllow))
            {
                return TRUE;
            }
            return FALSE;
        }

    }

    