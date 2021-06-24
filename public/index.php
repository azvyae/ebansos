<?php 
use APP\core\App as App;
if ( !session_id() ) {
    session_start();
}
require_once '../esubsidi/init.php';

$app = new App;
?>