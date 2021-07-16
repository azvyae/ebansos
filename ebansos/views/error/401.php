<div class="d-flex h-100 flex-column text-center text-light bg-danger min-vh-100">
    <div class="d-flex w-100 h-100 p-3 mx-auto flex-column my-auto">
        <main class="container">
            <h1 class="position-relative">Error 401 | Hey! Tidak Boleh!</h1>
            <p class="lead position-relative">Area terbatas, anda tidak diizinkan untuk memasuki area ini, silakan login sebagai petugas atau kembali ke menu utama. Tekan tombol di bawah ini untuk kembali ke halaman utama.</p>
            <p class="lead position-relative">

                <a href="<?= BASEURL ?>" class="position-relative btn btn-lg btn-warning fw-bold border-warning ">Halaman Utama</a>
            </p>
        </main>

        <footer class="mt-auto text-white-50 position-relative">
            <p>Copyright <?= date("Y") ?> | Made With <i class="bi bi-heart-fill"></i> by
                <a target="_blank" href="https://twitter.com/erstevn" class="text-white">Erstevn</a>
            </p>
        </footer>
    </div>
</div>
<script src="<?= BASEURL ?>/js/particles.min.js" defer='defer'></script>
<script src="<?= BASEURL ?>/js/error.js" defer='defer'></script>