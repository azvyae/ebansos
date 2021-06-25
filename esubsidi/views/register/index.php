<?php use Esubsidi\core\Flasher; ?>

<main class="p-5 mx-auto my-auto bg-light form-register rounded-3 border border-3  mt-5">
  <form action="<?= BASEURL ?>/register/daftar" method="POST">
    <img class="mb-4 mx-auto d-block" src="<?= BASEURL ?>/img/brand.svg" alt="Logo" width="96">
    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
    <p>Silakan isi kolom berikut untuk melakukan pendaftaran petugas.</p>
    <div class="form-floating mb-1">
      <input required maxlength="32" type="text" autocomplete="off" class="form-control" id="nama" name="nama" placeholder="Nama">
      <label for="nama">Nama</label>
    </div>
    <div class="form-floating mb-3">
      <input maxlength="32" required type="text" autocomplete="off" class="form-control" id="userIdDaftar" name="userId"  placeholder="User ID">
      <label for="userIdDaftar">User ID</label>
    </div>
    <div class="mb-3">
    <span id="messageUsername" class="mb-3"></span>
    </div>
    <div class="form-floating mb-1">
      <input required type="password" class="form-control" id="password" name="password" placeholder="Password">
      <label minlength="8" for="password">Password</label>
    </div>
    <div class="form-floating mb-3">
      <input required type="password" class="form-control" id="passwordVerify" minlength="8" autocomplete="off" placeholder="Verifikasi Password">
      <label for="passwordVerify">Verifkiasi Password</label>
    </div>
    
    <span id="message"></span>
    <button class="w-100 btn my-3 btn-lg btn-primary" type="submit">Daftar</button>
  </form>
  <?php Flasher::flash(); ?>
</main>