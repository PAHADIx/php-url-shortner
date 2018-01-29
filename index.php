<?php


require_once __DIR__ . '/init.php';

/*
    The "routes/config.php" will tell where the app goes to..
 */


use Framework\RouteConfig;

$url = $_SERVER['REQUEST_SCHEME'] . "://" .$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$uri = $_SERVER['REQUEST_URI'];

$path = parse_url($url, PHP_URL_PATH);
$query = parse_url($url, PHP_URL_QUERY);

$url = rtrim($url,"/");
$uri = rtrim($uri,"/");
$path = rtrim($path,"/");


$url_breakdown = explode(BASE_URL,$url);
$url_requested = (count($url_breakdown) === 2) ? $url_breakdown[1] : "";


require_once BASE_DIR."/config/routes.php";
RouteConfig::$routes = $routes;
RouteConfig::route($url_requested);
