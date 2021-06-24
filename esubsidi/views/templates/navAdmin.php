<nav class="border-bottom border-3 navbar navbar-expand-md navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand my-2 fw-bold" href="<?= BASEURL ?>">
            <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Lambang_Kota_Bandung.svg" alt="" height="32">
            E-Subsidi Sarijadi</a>
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
        <li class="nav-item">
            <a class="nav-link active" href="<?= BASEURL ?>">Beranda</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASEURL ?>/user">Pengguna</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zM8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6z" />
                </svg>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <!-- Nanti bikin foreach -->
                <li class="dropdown-item">Nanti notif di sini</li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?= BASEURL ?>/riwayat">Riwayat Aktivitas</a></li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= BASEURL ?>/keluar">Log Out</a>
        </li>
    </ul>
</div>
</div>
</nav>