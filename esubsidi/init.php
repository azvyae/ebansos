<?php 

require_once "../ebansos/config/config.php";

spl_autoload_register(function ($class) {
    $class = explode('\\', $class);
    $class = end($class);
    require_once '../' . APP .'/core/' . $class . '.php';
});
