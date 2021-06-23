<?php 

require_once "../esubsidi/config/config.php";

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    require_once '../' . APP .'/core/' . $class . '.php';
});

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    require_once '../' . APP .'/controllers/' . $class . '.php';
});
