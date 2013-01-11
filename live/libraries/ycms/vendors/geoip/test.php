<?php

require_once 'Net/Net_GeoIP.php';



$geoip = Net_GeoIP::getInstance('data/GeoIP.dat');

print_r($geoip);exit;

$country_code = $geoip->lookupCountryCode('8.8.8.8');


echo $country_code;