<nav class="w-100 px-3 mb-4 fixed-top border-bottom navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand my-2 fw-bold" href="<?= BASEURL ?>">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e8/Lambang_Kota_Bandung.svg" alt="" height="32">
        Baso Metal <?= KELURAHAN ?>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
            <li class="nav-item my-auto text-center">
                <a class="nav-link <?php if (($data['navActive'] ?? '') == 'beranda') {
                                        echo 'active';
                                    } ?>" href="<?= BASEURL ?>">Beranda</a>
            </li>
            <?php
            if ($data['statusRegistrasi'] == 'true') {
                echo "<li class='nav-item my-auto text-center'>
                                <a class='nav-link";
                if (($data['navActive'] ?? '') == 'register') {
                    echo " active";
                }
                echo "' href='" . BASEURL . "/register'>Register</a>
                            </li>";
            }
            ?>
            <li class="nav-item my-auto text-center">
                <a class="nav-link <?php if (($data['navActive'] ?? '') == 'login') {
                                        echo 'active';
                                    } ?>" href="<?= BASEURL ?>/login">Log In</a>
            </li>
        </ul>
    </div>
</nav>
<main style='margin-top:128px; padding-bottom:64px' class='mb-5'>