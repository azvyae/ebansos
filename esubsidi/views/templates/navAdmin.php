<nav class="w-100 px-3 mb-4 fixed-top border-bottom navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand my-2 fw-bold" href="<?= BASEURL ?>">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Lambang_Kota_Bandung.svg" alt="" height="32">
        Esubsidi <?= KELURAHAN ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
            <li class="nav-item ms-1 me-3 my-auto text-center">
                <span class="nav-link active p-3">Halo, <?= $_SESSION['user']['namaAkun'] ?> <i class="bi bi-emoji-smile"></i></span>
            </li>
            <li class="nav-item my-auto text-center">
                <a class="nav-link <?php if (($data['navActive'] ?? '') == 'beranda') {
                                        echo 'active';
                                    } ?>" href="<?= BASEURL ?>">Beranda</a>
            </li>

            <?php
            if ($_SESSION['user']['tipeAkun'] == 5) {
                echo "<li class='nav-item my-auto text-center'>
                            <a class='nav-link";
                if (($data['navActive'] ?? '') == 'administrasi') {
                    echo ' active';
                }
                echo " 'href='" .  BASEURL . "/admin'>Administrasi</a>
                        </li>";
            }

            ?>
            <li class="nav-item dropdown my-auto text-center">
                <a class="nav-link dropdown-toggle <?php if (($data['navActive'] ?? '') == 'riwayat') {
                                                        echo 'active';
                                                    } ?>" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <b class="bi bi-clock-history fw-bold fs-5"></b>
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
</nav>
<main style='margin-top:128px; padding-bottom:64px' class='mb-5'>
