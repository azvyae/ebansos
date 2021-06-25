<?php

if ( !session_id() ) {
    session_start();
}

use Esubsidi\core\App;
require_once "../esubsidi/config/config.php";
require_once '../vendor/autoload.php';
require_once '../esubsidi/autoload.php';


// $faker = Faker\Factory::create();
$app = new App;
?>