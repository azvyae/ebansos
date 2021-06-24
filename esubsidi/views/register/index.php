<main class="p-5 mx-auto my-auto bg-light form-register rounded-3 border border-3  mt-5">
  <form>
    <img class="mb-4 mx-auto d-block" src="<?= BASEURL ?>/img/brand.svg" alt="Logo" width="96">
    <h1 class="h3 mb-3 fw-normal text-center">Register</h1>
    <p>Silakan isi kolom berikut untuk melakukan pendaftaran petugas.</p>
    <div class="form-floating mb-1">
      <input required type="text" autocomplete="off" class="form-control" id="nama" placeholder="Nama">
      <label for="nama">Nama</label>
    </div>
    <div class="form-floating mb-3">
      <input required type="text" autocomplete="off" class="form-control" id="userId" placeholder="User ID">
      <label for="userId">User ID</label>
    </div>
    <div class="form-floating mb-1">
      <input required type="password" class="form-control" id="password" placeholder="Password">
      <label for="password">Password</label>
    </div>
    <div class="form-floating">
      <input required type="password" class="form-control" id="passwordVerify" autocomplete="off" placeholder="Verifikasi Password">
      <label for="passwordVerify">Verifkiasi Password</label>
    </div>
    <button class="w-100 btn my-3 btn-lg btn-primary" type="submit">Daftar</button>
  </form>
</main>