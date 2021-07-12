<?php
$penduduk = $data['penduduk'];
?>

<div class="container">
    <div class="row">
        <div class="border border-3 p-5 mb-5 col-lg-8 col mx-auto mt-5 bg-light rounded-32 ">
            <div class="container py-2 overflow-auto">
                <h1 class="display-5 text-center fw-bold my-3 ">Data Penerima Subsidi</h1>
                <table class="table table-hover ">
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
                            <th scope="row">Tempat Lahir / Tanggal Lahir</th>
                            <td><?= $penduduk['tempatLahir'] ?> / <?= $penduduk['tanggalLahir'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Kelamin</th>
                            <td><?= $penduduk['jenisKelamin'] ?></td>
                        </tr>
                        <tr>
                            <th scope="row">Alamat Rumah</th>
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
                            <td><span class="badge bg-secondary"><?= $penduduk['tanggalMenerima'] ?></span></td>
                        </tr>
                        <tr>
                            <th scope="row">Jenis Subsidi</th>
                            <td><span class="badge bg-secondary"><?= $penduduk['jenisSubsidi'] ?></span></td>
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