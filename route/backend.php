<?php 
$c = $_GET['c'] ?? 'login';
$m = $_GET['m'] ?? 'index';

$controller = ucfirst($c) . 'Controller';
$admin = 'app\\controller\\backend\\' . $controller;
$obj = new $admin;
$obj->$m();