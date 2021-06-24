<?php

use APP\core\Flasher;

?>

<div class="container">
    <div class="row">
        <div class="border border-3 p-5 mb-5 col-lg-8 col mx-auto mt-5 bg-light rounded-32 ">
            <div class="container py-2">
                <h1 class="display-5 text-center fw-bold my-3">Data Penerima Subsidi</h1>
                <p class="fs-5 text-center">Masukkan NIK dan tanggal lahir anda, lalu tekan tombol konfirmasi untuk mengetahui apakah warga tersebut sudah terdaftar.</p>
                <div class="row">

                    <form action="<?= BASEURL ?>/beranda/cekdata" method="POST" class="col col-md-6 mx-auto">
                        <div class="my-3">
                            <label for="nik" class="form-label fw-bold">Nomor Induk Kependudukan</label>
                            <input type="text" autocomplete="off" class="form-control" id="nik" name='nik' placeholder="3273000011110000" minlength="16" maxlength="16" required>
                        </div>
                        <div class="my-3 datepicker">
                            <label for="tanggalLahir" class="form-label fw-bold">Tanggal Lahir</label>
                            <input required min="1900-01-01" max="<?= date("Y-m-d"); ?>" class="form-control input-groupinput-group-addon" id="tanggalLahir" name="tanggalLahir" placeholder="" type="date" />
                        </div>
                        <div class="mx-auto">
                            <button type="submit" class="checkButton btn mx-auto w-100 btn-primary btn-lg btn-ripple">Periksa Data</button>
                        </div>
                    </form>
                    <?php Flasher::flash(); ?>
                </div>
            </div>
        </div>

    </div>
</div>