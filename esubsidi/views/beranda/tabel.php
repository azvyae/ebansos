<div class="<?= $data['lebar-cari'] ?> mb-2">
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
        <button type="submit" id='tombolHapus' class="btn btn-danger" disabled>Hapus</button>
    </span>

</div>
<div class="col-lg-2">
    <span class="  d-grid gap-2">
        <a href="<?= BASEURL ?>/tambahpenduduk" class="btn btn-primary">Tambah</a>
    </span>

</div>
</div>
<div class="row overflow-scroll">
    <div id='tabel-container'>

    </div>
    <span id='message'></span>

    </form>
</div>
<div class="text-center" id="loading">
    <div class="spinner-border mt-3 text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

</div>
</div>
<script src="<?= BASEURL ?>/js/filter.js" defer="true"></script>