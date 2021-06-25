<?php 

require_once "../esubsidi/config/config.php";
require_once "../vendor/autoload.php";

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    $class = strtolower($class);
    require_once '../' . APP .'/core/' . $class . '.php';
});

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    $class = strtolower($class);
    require_once '../' . APP .'/controllers/' . $class . '.php';
});
