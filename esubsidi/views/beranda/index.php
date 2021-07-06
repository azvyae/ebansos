<?php

use Esubsidi\core\Flasher;
?>

<div class="container-fluid">
    <div class="row">
        <div class="border border-3 p-5 mb-5 col-lg-8 col mx-auto mt-5 bg-light rounded-32 ">
            <div class="container py-2">
                <h1 class="display-5 text-center fw-bold my-3">Data Penerima Subsidi</h1>
                <p class="fs-5 text-center">Masukkan NIK dan tanggal lahir anda, lalu tekan tombol konfirmasi untuk mengetahui apakah warga tersebut sudah terdaftar.</p>
                <div class="row">

                    <form action="<?= BASEURL ?>/beranda/cekdata" method="POST" class="col col-md-6 mx-auto">
                        <div class="my-3 row">
                            <div class="col-sm-12 mb-3">
                                <label for="nik" class="form-label fw-bold">Nomor Induk Kependudukan</label>
                                <input type="text" autocomplete="off" class="form-control" pattern="[0-9]+" title="Masukkan hanya angka" id="nik" name='nik' placeholder="3273000011110000" minlength="16" value="<?= $data['nikVal'] ?>" maxlength="16" required>
                            </div>
                        </div>
                        <div class="my-3 row">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <div class="col-sm-3 mb-3">
                                <input required class="form-control input-groupinput-group-addon" id="hari" name="hari" autocomplete="off" value="<?= $data['hhVal'] ?>" placeholder="HH" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="2" max="31" min="1"/>
                            </div>
                            <div class="col-sm-4 mb-3">
                                <input required class="form-control input-groupinput-group-addon" id="bulan" name="bulan" autocomplete="off" value="<?= $data['bbVal'] ?>" placeholder="BB" maxlength="2" max="12" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)"/>
                            </div>
                            <div class="col-sm-5 mb-3">
                                <input required class="form-control input-groupinput-group-addon" id="tahun" name="tahun" autocomplete="off" value="<?= $data['ttttVal'] ?>" placeholder="TTTT" oninput="this.value=this.value.slice(0,this.maxLength)" min="1900" max="<?= date("Y"); ?>" maxlength="4" type="number" />
                            </div>
                        </div>
                        <div class="mx-auto">
                            <button type="submit" class="checkButton btn mx-auto my-3 w-100 btn-primary btn-lg btn-ripple">Periksa Data</button>
                        </div>
                    </form>
                    <?php Flasher::flash(); ?>
                </div>
            </div>
        </div>

    </div>
</div>