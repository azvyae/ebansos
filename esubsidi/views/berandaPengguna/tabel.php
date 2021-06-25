<div class="row overflow-scroll">
    <table class="table table-striped overflow-auto">
        <thead>
            <tr>
                <th scope="col"><input class="form-check-input pilih-semua" type="checkbox"></th>
                <th scope="col">NIK</th>
                <th scope="col">Nama</th>
                <th scope="col">Alamat</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data as $p) : ?>
                <tr class='align-middle'>
                    <th scope="row"><input class="form-check-input tabel-check" type="checkbox" value="<?= $p['hashId'] ?>" name='<?= $i++ ?>'></th>
                    <td><?= $p['nik'] ?></td>
                    <td><?= $p['nama'] ?></td>
                    <td><?= $p['alamatRumah'] ?></td>
                    <td class='text-center'>
                        <a class=' link-dark text-decoration-none fw-bold' href="<?= BASEURL ?>/beranda/ubah/penduduk?=<?= $p['hashId'] ?>">Ubah</a>
                        <a class=' link-primary text-decoration-none fw-bold' href="<?= BASEURL ?>/beranda/detail/penduduk?=<?= $p['hashId'] ?>">Detail</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    </form>
</div>
</div>
</div>