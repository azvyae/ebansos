<div class="row justify-content-center">
    <div class="col-md-8 mb-2">
        <span class="d-flex input-group">
            <input class="input-group form-control" id='cari' name='cari' type="search" placeholder="Cari" aria-label="Search">
            <label class="input-group-text" for="cari"><i class="bi bi-search"></i></label>
        </span>
    </div>
    <div class="col-md-2 mb-2">
        <form method='post' action='<?= BASEURL?>/beranda/hapusData' class="d-grid gap-2">
            <button type="submit" id='tombolHapus' class="btn btn-danger disabled">Hapus Data</button>
        

    </div>
    <div class="col-md-2">
        <span class="  d-grid gap-2">
            <a href="<?= BASEURL ?>/beranda/tambahdata" class="btn btn-primary">Tambah Data</a>
        </span>

    </div>
</div>