<?php

use Esubsidi\core\Flasher;

?>

<script type="text/javascript" src="<?= BASEURL ?>/js/admin.js" defer>
</script>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="container">
                <?php Flasher::flash(); ?>
                <div class="container px-4 py-5" id="hanging-icons">
                    <h1 class="display-5 text-center fw-bold mb-3 position-relative">Administrasi Petugas</h1>
                    <hr>
                    <div class="row ms-2 form-check form-switch position-relative">
                        <form action="<?= BASEURL ?>/admin/updateStatusRegistrasi" class='position-relative' id='updateStatusRegistrasi' method="post">
                            <input class="form-check-input" name='statusRegistrasi' <?= $data['checked'] ?> value='true' type="checkbox" id="aktifkanRegistrasi">
                            <label class="form-check-label" for="aktifkanRegistrasi">Registrasi Petugas Umum</label>
                        </form>

                    </div>
                    <div class="row g-4 py-5 row-cols-1 row-cols-lg-3 position-relative">
                        <div class="col d-flex align-items-start">
                            <div class="icon-square bg-light text-dark flex-shrink-0 rounded mx-3">
                                <i class="bi bi-file-earmark-person fs-2 mx-1 text-info"></i>
                            </div>
                            <div>
                                <h2 class='fs-5'>Petugas RW</h2>
                                <p>Pilih tombol berikut ini untuk menampilkan opsi menambahkan petugas RW</p>
                                <button type="button" class="btn btn-info generateRW" data-bs-toggle="modal" data-bs-target="#showModal">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <div class="icon-square bg-light text-dark flex-shrink-0 rounded mx-3">
                                <i class="bi bi-file-earmark-person-fill fs-2 mx-1 text-success"></i>
                            </div>
                            <div>
                                <h2 class='fs-5'>Petugas RT</h2>
                                <p>Pilih tombol berikut ini untuk menampilkan opsi menambahkan petugas RT</p>
                                <button type="button" class="btn btn-success generateRT" data-bs-toggle="modal" data-bs-target="#showModal">
                                    Tambah
                                </button>
                            </div>
                        </div>
                        <div class="col d-flex align-items-start">
                            <div class="icon-square bg-light text-dark flex-shrink-0 rounded text-primary mx-3">
                                <i class="bi bi-briefcase-fill fs-2 mx-1 text-warning"></i>
                            </div>
                            <div>
                                <h2 class='fs-5'>Acara Subsidi</h2>
                                <p>Pilih tombol berikut ini untuk menampilkan opsi menambahkan subsidi</p>
                                <button type="button" class="btn btn-warning generateSubsidi" data-bs-toggle="modal" data-bs-target="#showModal">
                                    Tambah
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="modalPetugas" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="admin/generateRW" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="judulModal">Tambahkan Petugas RW</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container" id='isianInput'>
                        <div class="mb-3">
                            <label for="jumlahRW" class="form-label">Jumlah Petugas RW</label>
                            <input required class="form-control input-groupinput-group-addon" id="jumlahRW" name="jumlahRW" autocomplete="off" placeholder="Jumlah RW" maxlength="3" min="1" type="number" oninput="this.value=this.value.slice(0,this.maxLength)" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>