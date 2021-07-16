<?php

use Ebansos\core\Flasher; ?>

<main class="mx-auto form-register px-3">
  <form action="<?= BASEURL ?>/register/daftar" class='container-flex position-relative' method="POST">
    <div class="row">
      <img class="mb-4 mx-auto d-block" src="<?= BASEURL ?>/img/brand.svg" alt="Logo" style='width:128px'>
      <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
      <p class='text-center'>Silakan isi kolom pada form pendaftaran berikut untuk melakukan pendaftaran petugas umum.</p>
    </div>
    <div class="row my-3">
      <div class="col-6">
        <label for="nama" class="form-label fw-bold ms-2">Nama</label>
        <input required maxlength="32" type="text" autocomplete="off" class="form-control" id="nama" name="nama" placeholder="Nama">
      </div>
      <div class="col-6">
        <label for="userIdDaftar" class="form-label fw-bold ms-2">User ID</label>
        <input maxlength="32" required type="text" autocomplete="off" class="form-control" id="userIdDaftar" name="userId" placeholder="User ID">
      </div>
    </div>
    <div class="row">
      <span id="messageUsername"></span>
    </div>
    <div class="row my-3">
      <div class="col-6">
        <label for="password" class="form-label fw-bold ms-2">Password</label>
        <input minlength="8" required type="password" class="form-control" id="password" name="password" placeholder="Password">
      </div>
      <div class="col-6">
        <label for="passwordVerify" class="form-label fw-bold ms-2">Verifikasi</label>
        <input required type="password" class="form-control" id="passwordVerify" minlength="8" autocomplete="off" placeholder="Password">
      </div>
    </div>
    <div class="row">
      <span id="message"></span>
    </div>
    <div class="mx-auto row w-50">

      <button class="w-100 btn my-3 btn-primary" type="submit">Daftar</button>
    </div>
  </form>
  <?php Flasher::flash(); ?>
</main>