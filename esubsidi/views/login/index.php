<?php

use APP\core\Flasher;

?>

<main class="p-5 mx-auto my-auto bg-light form-signin rounded-3 border border-3  mt-5">
  <form action="<?= BASEURL ?>/login/redirect" method="post">
    <img class="mb-4 mx-auto d-block" src="<?= BASEURL ?>/img/brand.svg" alt="Logo" width="96">
    <h1 class="h3 mb-3 fw-normal text-center">Log In</h1>

    <div class="form-floating mb-1">
      <input required autocomplete="off" type="text" name="userId" class="form-control" id="userId" placeholder="User ID">
      <label for="userId">User ID</label>
    </div>
    <div class="form-floating">
      <input required type="password" name="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>

    <div class="checkbox my-3">

      <input class="form-check-input me-1" type="checkbox" name="tetapMasuk" value="true"> Tetap Masuk
    </div>
    <button class="w-100 btn mb-3 btn-lg btn-primary" type="submit">Log In</button>

  </form>
  <div class="text-center">
    <a class="text-decoration-none" href="/register">Belum memiliki akun?</a>
  </div>
  <?php Flasher::flash(); ?>
</main>