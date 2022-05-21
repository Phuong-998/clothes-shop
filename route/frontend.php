<?php 
$c = $_GET['c'] ?? 'home';
$m = $_GET['m'] ?? 'index';

$controller = ucfirst($c) . 'Controller';
$user = 'app\\controller\\frontend\\' . $controller;
$obj = new $user;
$obj->$m();