<div class="row justify-content-between">
    <div class="col-md-2 mb-2">
        <select hidden class="form-select filter mb-2" id="rw" name='rw'>
        </select>
    </div>
    <div id="filterRT" class="col-md-2 mb-2">
        <select hidden class="form-select filter mb-2" id="rt" name='rt'>
        </select>
    </div>
    <div class="col-md-3 mb-2">
        <span class="d-flex input-group">
            <input class="input-group form-control filter" id='cari' name='cari' type="search" placeholder="Cari" aria-label="Search">
            <label class="input-group-text" for="cari"><i class="bi bi-search"></i></label>
        </span>
    </div>
    <div class="col-md-1 mb-2">
        <select class="form-select filter mb-2" id="halaman" name='halaman'>
        </select>
    </div>

    <div class="col-md-2 mb-2">
        <form method='post' action='<?= BASEURL ?>/beranda/hapusData' class="d-grid gap-2">
            <button type="submit" id='tombolHapus' class="btn btn-danger" disabled>Hapus</button>


    </div>
    <div class="col-md-2">
        <span class="  d-grid gap-2">
            <a href="<?= BASEURL ?>/beranda/tambahdata" class="btn btn-primary">Tambah</a>
        </span>

    </div>
</div>