<nav class="border-bottom border-3 navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand my-2 fw-bold" href="<?= BASEURL ?>">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Lambang_Kota_Bandung.svg" alt="" height="32">
            E-Subsidi Sarijadi</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <i class="bi bi-emoji-smile fs-5 my-auto text-secondary"></i>
                <li class="nav-item ms-1 me-3">
                    <span class="nav-link active">Halo, <?= $_SESSION['user']['nama'] ?> </span>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="<?= BASEURL ?>">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= BASEURL ?>/keluar">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>