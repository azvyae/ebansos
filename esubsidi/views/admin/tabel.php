<div class="container-fluid">
    <div class="row">
        <div class="border border-3 p-5 mb-5 col-lg-8 col mx-auto mt-5 bg-light rounded-32 ">
            <form action="<?= BASEURL ?>/admin/hapus" method="post">
                <div class="row justify-content-between">
                    <div class="col-lg-3 mb-2">
                        <select class="form-select filter mb-2" id="tipeAkun" name='tipeAkun'>
                            <option selected value=''>Semua Akun</option>;
                            <option value="0">Pendaftar</option>
                            <option value="1">Petugas RT</option>
                            <option value="2">Petugas RW</option>
                            <option value="3">Super Admin</option>
                            <option value="4">Petugas Subsidi</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mb-2">
                        <span class="d-flex input-group">
                            <input class="input-group form-control filter" id='cari' name='cari' type="search" placeholder="Cari" aria-label="Search">
                            <label class="input-group-text" for="cari"><i class="bi bi-search"></i></label>
                        </span>
                    </div>
                    <div class="col-lg-1 mb-2">
                        <select class="form-select filter mb-2" id="halaman" name='halaman'>
                            <option value="1" selected>1</option>
                        </select>
                    </div>
                    <div class="col-lg-2 mb-2">
                        <span class="  d-grid gap-2">
                            <button type="submit" id='tombolHapus' onclick="return confirm('Anda yakin ingin menghapusnya?');" class="btn btn-danger" disabled>Hapus</button>
                        </span>
                    </div>
                </div>
                <div class="row overflow-scroll">
                    <div id='tabel-container'>

                    </div>
                    <span id='message'></span>

                </div>
                <div class="text-center" id="loading">
                    <div class="spinner-border mt-3 text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>