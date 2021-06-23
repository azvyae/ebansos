<?php 
use APP\core\App as App;

require_once '../esubsidi/init.php';

setcookie('userId', 'bWFudGFwQQ==', secure:true);
setcookie('tipeAkun', 0, secure:true);

$app = new App;
?>