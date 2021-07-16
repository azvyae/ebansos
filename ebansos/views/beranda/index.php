<?php

use Ebansos\core\Flasher;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 mb-5">
            <div class="row d-block justify-content-center">
                <div class="col-sm-12 mx-auto" style="max-width: 768px !important;">
                    <h1 hidden class='hidden'>Baso Metal (Bantuan Sosial melalui Media Digital)</h1>
                    <h2 class="display-5 position-relative text-center fw-bold">Data Penerima Bansos</h2>
                    <p class='fs-5 position-relative text-center my-3'>Masukkan NIK dan tanggal lahir anda, lalu tekan tombol konfirmasi untuk mengetahui apakah warga tersebut sudah terdaftar.</p>
                </div>
                <div class="col-sm-12 my-3  mx-auto position-relative" style="max-width: 768px !important;"><?php Flasher::flash(); ?></div>
            </div>
            <div class="row">
                <form action="<?= BASEURL ?>/beranda/cekdata" style="max-width: 512px !important;" method="POST" class="col-md-12 mx-auto">
                    <div class="my-3 row">
                        <div class="col-sm-12 mb-3">
                            <label for="nik" class="form-label ms-2 fw-bold position-relative">Nomor Induk Kependudukan</label>
                            <input type="text" autocomplete="off" class="form-control position-relative" pattern="[0-9]+" title="Masukkan hanya angka" id="nik" name='nik' placeholder="3273000011110000" minlength="16" value="<?= $data['nikVal'] ?>" maxlength="16" required>
                        </div>
                    </div>
                    <div class="my-3 row">
                        <div class="col-sm-12">
                            <label class="form-label fw-bold ms-2 position-relative" for='hari'>Tanggal Lahir</label>
                        </div>
                        <div class="col-3 mb-3">
                            <input required class="position-relative form-control input-groupinput-group-addon" id="hari" name="hari" autocomplete="off" value="<?= $data['hhVal'] ?>" placeholder="HH" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="2" max="31" min="1" />
                        </div>
                        <div class="col-4 mb-3">
                            <input required class="position-relative form-control input-groupinput-group-addon" id="bulan" name="bulan" autocomplete="off" value="<?= $data['bbVal'] ?>" placeholder="BB" maxlength="2" max="12" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" />
                        </div>
                        <div class="col-5 mb-3">
                            <input required class="position-relative form-control input-groupinput-group-addon" id="tahun" name="tahun" autocomplete="off" value="<?= $data['ttttVal'] ?>" placeholder="TTTT" oninput="this.value=this.value.slice(0,this.maxLength)" min="1900" max="<?= date("Y"); ?>" maxlength="4" type="number" />
                        </div>
                    </div>

                    <div class="mx-auto">
                        <button type="submit" class="position-relative checkButton btn mx-auto my-3 w-100 btn-primary btn-lg btn-ripple">Periksa Data</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="col-sm-12 mx-auto text-center" style="max-width: 768px">
                <h2 class="display-5 position-relative fw-bold mb-5">Apa itu Baso Metal?</h2>
                <img src="<?= BASEURL ?>/img/people.svg" class='my-3 position-relative w-75' alt="ilustrasi">
                <p class="fs-5 position-relative"><strong>Baso Metal</strong> (Bantuan Sosial melalui Media Digital) merupakan aplikasi pendataan dan pencatatan bantuan sosial secara elektronik, efisien, transparan dan tepat sasaran.</p>
            </div>
        </div>
    </div>
</div>