<?php
session_start();
//define('URL', str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") ."://$_SERVER[PHP_HOST]$_SERVER[PHP_SELF]"));

require_once(__DIR__ . '/config/config.php');

require_once(__DIR__ . '/config/Autoloader.php');
Autoloader::charger();


require_once(__DIR__ . '/controllers/Routeur.php');

$routeur = new Router();
try {
    $routeur->routeReq();
} catch (Exception $e) {
}