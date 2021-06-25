<?php 
if ( !session_id() ) {
    session_start();
}
require_once '../main/init.php';
// use APP\core\App;


// $faker = Faker\Factory::create();
$app = new Esubsidi\core\App;
?>