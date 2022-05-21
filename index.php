<?php
require 'vendor/autoload.php';

use app\model\frontend\ipAdressModel;


if (file_exists('route/frontend.php')) {
    $ipaddress = new ipAdressModel;
    session_start();
    function getIPAddress()
    {
        //whether ip is from the share internet  
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        //whether ip is from the remote address  
        else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    $ip = getIPAddress();
    if($ipaddress->checkIp($ip)){
        $time = date("Y-m-d");
        $ipaddress->addIpAdress($ip, $time);
    }
   
    require('route/frontend.php');
} else {
    echo 'Trang web đang bảo trì';
}
