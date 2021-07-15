<?php

use Esubsidi\core\Flasher;
?>

<div class="container-fluid" style="max-width:1400px">
    <div class="row d-block justify-content-center">
        <div class="col-sm-6 mx-auto position-relative">
            <h1 class="display-5 text-center fw-bold my-3">Input Penerimaan Subsidi</h1>
            <p class="fs-5 text-center">Masukkan NIK dan tanggal lahir anda, lalu tekan tombol konfirmasi untuk mengetahui apakah warga tersebut sudah terdaftar. Lalu tekan tombol tambahkan subsidi untuk memvalidasi penerimaan subsidi.</p>
        </div>
        <div class="col-sm-6 mx-auto position-relative"><?php Flasher::flash(); ?></div>
    </div>
    <div class="row px-5">
        <div class="col col-md-6 mx-auto">
            <form action="<?= BASEURL ?>/beranda/cekdata" method="POST">
                <div class="my-3 row">
                    <div class="col-sm-12 mb-3">
                        <label for="nik" class="position-relative form-label fw-bold">Nomor Induk Kependudukan</label>
                        <input type="text" autocomplete="off" class="position-relative form-control" pattern="[0-9]+" title="Masukkan hanya angka" id="nik" name='nik' placeholder="3273000011110000" minlength="16" value="<?= $data['nikVal'] ?>" maxlength="16" required>
                    </div>
                </div>
                <div class="my-3 row">
                    <label class="form-label fw-bold position-relative">Tanggal Lahir</label>
                    <div class="col-sm-3 mb-3 position-relative">
                        <input required class="form-control input-groupinput-group-addon" id="hari" name="hari" autocomplete="off" value="<?= $data['hhVal'] ?>" placeholder="HH" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="2" max="31" min="1" />
                    </div>
                    <div class="col-sm-4 mb-3 position-relative">
                        <input required class="form-control input-groupinput-group-addon" id="bulan" name="bulan" autocomplete="off" value="<?= $data['bbVal'] ?>" placeholder="BB" maxlength="2" max="12" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" />
                    </div>
                    <div class="col-sm-5 mb-3 position-relative">
                        <input required class="form-control input-groupinput-group-addon" id="tahun" name="tahun" autocomplete="off" value="<?= $data['ttttVal'] ?>" placeholder="TTTT" oninput="this.value=this.value.slice(0,this.maxLength)" min="1900" max="<?= date("Y"); ?>" maxlength="4" type="number" />
                    </div>
                </div>
                <div class="mx-auto">
                    <button type="submit" id='periksaData' class="position-relative checkButton btn mx-auto my-3 w-100 btn-primary btn-lg btn-ripple">Periksa Data</button>
                </div>
                <div class="mx-auto">
                    <button type="submit" id='tambahSubsidi' class="position-relative checkButton btn mx-auto my-3 w-100 btn-warning btn-lg btn-ripple">Tambahkan Subsidi</button>
                </div>
            </form>

        </div>
        <?php Flasher::flash(); ?>
    </div>
</div>

</div>
</div>
<script src="<?= BASEURL ?>/js/specialofficer.js" type="text/javascript" defer></script>