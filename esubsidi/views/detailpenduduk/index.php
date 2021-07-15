<?php
$penduduk = $data['penduduk'];
?>

<div class="container">
    <div class="row">
        <div class="col-lg-8 col mx-auto position-relative">
            <div class="container overflow-auto">
                <h1 class="display-5 text-center fw-bold mb-3 ">Data Penerima Subsidi</h1>
                <table class="table table-hover table-bordered overflow-auto">
                    <thead>
                        <tr>
                            <th colspan="2" scope="col">Berikut merupakan data penerima subsidi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">NIK</th>
                            <td><?= $penduduk['nik'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Nama</th>
                            <td><?= $penduduk['nama'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">TTL</th>
                            <td><?= $penduduk['tempatLahir'] ?> / <?= $penduduk['tanggalLahir'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $penduduk['jenisKelamin'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Tinggal</th>
                            <td><?= $penduduk['alamatRumah'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">RT</th>
                            <td><?= $penduduk['rt'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">RW</th>
                            <td><?= $penduduk['rw'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kelurahan</th>
                            <td><?= $penduduk['kelurahan'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Kecamatan</th>
                            <td><?= $penduduk['kecamatan'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Status Perkawinan</th>
                            <td><?= $penduduk['statusPerkawinan'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Pekerjaan</th>
                            <td><?= $penduduk['pekerjaan'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Terakhir Menerima Subsidi</th>
                            <td><?= $penduduk['tanggalMenerima'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Subsidi</th>
                            <td><?= $penduduk['jenisSubsidi'] ?></td>
                        </tr>
                    </tbody>
                </table>
                <div class="justify-content-center d-flex">
                    <a class="btn btn-warning w-50 my-3" href="javascript:history.back()" role="button">Kembali</a>
                </div>

            </div>
        </div>

    </div>
</div>