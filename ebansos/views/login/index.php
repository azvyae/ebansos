<?php

use Ebansos\core\Flasher;

?>

<main class="mx-auto form-signin px-3">
  <form action="<?= BASEURL ?>/login/redirect" class='container-flex position-relative' method="post">
    <div class="row">
      <img class="mb-4 mx-auto d-block" src="<?= BASEURL ?>/img/brand.svg" alt="Logo" style='width:128px'>
      <h1 class="h3 mb-3 fw-normal text-center">Log In</h1>
      <p class='text-center'>Silakan masuk untuk melanjutkan sebagai petugas.</p>
    </div>
    <div class="row my-3">
      <div class="col-8 mx-auto">
        <label for="userId" class="form-label fw-bold ms-2">User ID</label>
        <input value="<?= $data['uname'] ?>" required autocomplete="off" type="text" name="userId" class="form-control" id="userId" placeholder="User ID">
      </div>
    </div>
    <div class="row my-3">
      <div class="col-8 mx-auto">
        <label for="password" class="form-label fw-bold ms-2">Password</label>
        <input required type="password" name="password" class="form-control" id="password" placeholder="Password">
      </div>
    </div>
    <div class="mx-auto my-4 row w-75">
      <div class="col-6 mx-auto">
        <button class="w-100 btn btn-primary" type="submit">Log In</button>
      </div>
    </div>
    <div class="row text-center w-75 mx-auto">
      <a class="text-decoration-none" href="/register">Belum memiliki akun?</a>
    </div>
  </form>
  <?php Flasher::flash(); ?>
</main>