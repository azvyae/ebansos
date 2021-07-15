<?php

use Esubsidi\core\Flasher;

?>
<div class="container">
    <div class="col-lg-12 mx-auto position-relative">
        <form method='post' action='<?= BASEURL ?>/hapuspenduduk'>
            <div class="row">
                <h1 class="display-5 text-center fw-bold mb-3">Data Penerima Subsidi <?= "{$data['distrik']}" ?></h1>
            </div>
            <?php Flasher::flash(); ?>
            <div class="my-3"></div>