<?php 
require 'vendor/autoload.php';
session_start();
if(file_exists('route/backend.php')){
    require ('route/backend.php');
}else{
    echo 'Trang web đang bảo trì';
}
