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
                <li class="nav-item ms-1 me-3 my-auto text-center">
                    <span class="nav-link active p-3">Halo, <?= $_SESSION['user']['nama'] ?> <i class="bi bi-emoji-smile"></i></span>
                </li>
                <li class="nav-item my-auto text-center">
                    <a class="nav-link active" href="<?= BASEURL ?>">Beranda</a>
                </li>
                <li class="nav-item my-auto text-center">
                    <a class="nav-link" href="<?= BASEURL ?>/user">Pengguna</a>
                </li>
                <li class="nav-item dropdown my-auto text-center">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <b class="bi bi-bell"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end mw-75" aria-labelledby="navbarDropdown">
                        <?php foreach ($data['riwayat']  as $r) : ?>
                            <li class="dropdown-item "><?= "{$r['userId']} {$r['aksi']}" ?><br><span style="font-size:0.8em"><?= $r['timestamp'] ?? '' ?></span></li>
                        <?php endforeach ?>
                        <li>

                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= BASEURL ?>/riwayat">Riwayat Aktivitas</a></li>
                    </ul>
                </li>
                <li class="nav-item my-auto text-center">
                    <a class="nav-link" href="<?= BASEURL ?>/keluar">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
