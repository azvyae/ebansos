<div class="row justify-content-center">
    <div class="col-md-2">
        <select class="form-select col-md-6 mb-2" id="rw" name='rw'>
            <option selected value="1">RW 01</option>
            <option value="2">RW 02</option>
            <option value="3">RW 03</option>
        </select>

    </div>
    <div class="col-md-2 mb-2">
        <select class="form-select col-md-6" id="rt" name='rt'>
            <option selected value="1">RT 01</option>
            <option value="2">RT 02</option>
            <option value="3">RT 03</option>
        </select>

    </div>
    <div class="col-md-4 mb-2">
        <span class="d-flex input-group">
            <input class="input-group form-control" id='cari' name='cari' type="search" placeholder="Cari" aria-label="Search">
            <label class="input-group-text" for="cari"><i class="bi bi-search"></i></label>
        </span>
    </div>
    <div class="col-md-2 mb-2">
        <form class="d-grid gap-2">
            <button type="submit" class="btn btn-danger disabled">Hapus Data</button>
        </form>

    </div>
    <div class="col-md-2">
        <span class="  d-grid gap-2">
            <a href="<?= BASEURL ?>/beranda/tambahdata" class="btn btn-primary">Tambah Data</a>
        </span>

    </div>
</div>