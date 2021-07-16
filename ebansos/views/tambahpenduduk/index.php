<?php

use Ebansos\core\Flasher;

?>
<div class="container">
    <div class="row">
        <div class="col-lg-8 mx-auto position-relative">
            <div class="container">
                <h1 class="display-5 text-center fw-bold mb-3 ">Tambah Data Penerima Bansos</h1>
                <hr>
                <p class="text-center">Isi identitas calon penerima bansos berdasarkan <b><u>data tempat tinggal saat ini.</u></b> Tidak boleh ada kolom yang dikosongkan</p>
                <form action="<?= BASEURL ?>/tambahpenduduk/tambahdata" method="POST" class="row g-3 mx-auto">
                    <div class="col-lg-12 d-block">
                        <?php
                        Flasher::flash();
                        ?>
                    </div>
                    <h6 class='text-muted fw-bold mt-3 mb-1'><i>Identitas</i></h6>
                    <div class="col-lg-6 mt-1">
                        <label for="nik" class="form-label fw-bold">Nomor Induk Kependudukan</label>
                        <input type="text" pattern="[0-9]+" title="Masukkan hanya angka" autocomplete="off" class="form-control" id="nik" name='nik' placeholder="3273000011110000" minlength="16" maxlength="16" required>
                    </div>
                    <div class="col-lg-6 mt-1">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" autocomplete="off" class="form-control" id="nama" name='nama' required>
                    </div>
                    <h6 class='text-muted fw-bold mt-5 mb-1'><i>Tempat/Tanggal Lahir</i></h6>
                    <div class="mt-1 col-lg-12">
                        <label for="tempatLahir" class="form-label fw-bold">Tempat</label>
                        <input type="text" autocomplete="off" class="form-control" id="tempatLahir" name='tempatLahir' required>
                    </div>
                    <div class="col-4">
                        <label for="hari" class="form-label fw-bold">Tanggal</label>
                        <input required class="form-control input-groupinput-group-addon" id="hari" name="hari" autocomplete="off" placeholder="HH" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="2" max="31" min="1" />
                    </div>
                    <div class="col-4">
                        <label for="bulan" class="form-label fw-bold">Bulan</label>
                        <input required class="form-control input-groupinput-group-addon" id="bulan" name="bulan" autocomplete="off" placeholder="BB" maxlength="2" max="12" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" />
                    </div>
                    <div class="col-4">
                        <label for="tahun" class="form-label fw-bold">Tahun</label>
                        <input required class="form-control input-groupinput-group-addon" id="tahun" name="tahun" autocomplete="off" placeholder="TTTT" oninput="this.value=this.value.slice(0,this.maxLength)" min="1900" max="<?= date("Y"); ?>" maxlength="4" type="number" />
                    </div>
                    <h6 class='text-muted fw-bold mt-5'><i>Data Pribadi</i></h6>
                    <div class="col-lg-6 mt-1">
                        <label for="alamatRumah" class="form-label fw-bold me-3">Alamat Tinggal</label>
                        <textarea rows="3" style="resize: none;" required class="form-control input-groupinput-group-addon" id="alamatRumah" name="alamatRumah" autocomplete="off" placeholder="Isi sesuai alamat tinggal saat ini"></textarea>
                    </div>
                    <div class="col-lg-6 mb-1">
                        <label for="jenisKelamin1" class="form-label fw-bold me-3">Jenis Kelamin</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" required id='jenisKelamin1' value="Pria">
                            <label class="form-check-label" for="jenisKelamin1">
                                Pria
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="jenisKelamin" id='jenisKelamin2' value="Wanita">
                            <label class="form-check-label" for="jenisKelamin2">
                                Wanita
                            </label>
                        </div>
                    </div>

                    <div class="col-6">
                        <label for="rt" class="form-label fw-bold">RT</label>
                        <input required class="form-control input-groupinput-group-addon" id="rt" name="rt" <?= $data['disabledRT'] ?> autocomplete="off" placeholder="RT" value='<?= $data['rtVal'] ?>' type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="3" min="1" />
                    </div>
                    <div class="col-6">
                        <label for="rw" class="form-label fw-bold">RW</label>
                        <input required class="form-control input-groupinput-group-addon" value='<?= $data['rwVal'] ?>' id="rw" name="rw" <?= $data['disabledRW'] ?> autocomplete="off" placeholder="RW" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" maxlength="3" min="1" />
                    </div>
                    <div class="col-lg-6 ">
                        <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                        <input required class="form-control input-groupinput-group-addon" id="pekerjaan" name="pekerjaan" autocomplete="off" placeholder="Pekerjaan" type="text" />
                    </div>
                    <div class="col-lg-6">
                        <label for="statusPerkawinan1" class="form-label fw-bold me-3">Status Perkawinan</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusPerkawinan" id='statusPerkawinan1' value="Belum Kawin" required>
                            <label class="form-check-label" for="statusPerkawinan1">
                                Belum Kawin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusPerkawinan" id='statusPerkawinan2' value="Kawin">
                            <label class="form-check-label" for="statusPerkawinan2">
                                Kawin
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusPerkawinan" id='statusPerkawinan3' value="Cerai Hidup">
                            <label class="form-check-label" for="statusPerkawinan3">
                                Cerai Hidup
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="statusPerkawinan" id='statusPerkawinan4' value="Cerai Mati">
                            <label class="form-check-label" for="statusPerkawinan4">
                                Cerai Mati
                            </label>
                        </div>

                    </div>

                    <div class="col-lg-12 d-flex justify-content-end">
                        <input class="btn btn-outline-danger w-50" type="reset" value="Reset">
                        <input class="ms-4  btn btn-primary w-50" type="submit" value="Tambah">
                    </div>

                </form>


            </div>
        </div>
    </div>

</div>
</div>