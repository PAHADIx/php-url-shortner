<?php

// set default time zone if not set at php.ini
date_default_timezone_set('America/Chicago'); // insert here default timezone


//Defining the Base Directory of the APP

if(!isset($_SESSION)){
    session_start();
}



define("BASE_DIR", __DIR__);
define("BASE_URL_RELATIVE", explode($_SERVER['DOCUMENT_ROOT'],__DIR__)[1].'/');
define("BASE_URL", $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].''.BASE_URL_RELATIVE);
define('DOMAIN', $_SERVER['HTTP_HOST'].''.BASE_URL_RELATIVE);

//Grabbing constants
require_once BASE_DIR.'/config/constants.php';

function autoloader($class) {

    $file = BASE_DIR . DIRECTORY_SEPARATOR.  "class" . DIRECTORY_SEPARATOR . $class . ".php";

    $file = str_replace("/" , DIRECTORY_SEPARATOR, $file);
    $file = str_replace("\\" , DIRECTORY_SEPARATOR, $file);

    if(file_exists($file)){
        require_once $file;
    } else {
        echo "Class " . $class . " not found as " . $file;
        echo "<pre>";
        print_r(debug_backtrace());
        echo "</pre>";
        exit();
    }

}

spl_autoload_register('autoloader');

