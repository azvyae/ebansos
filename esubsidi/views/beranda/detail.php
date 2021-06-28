<?php


    function bulanLahir($bulan)
    {
    switch ($bulan) {
        case '1': $bulanLahir = 'Januari'; break;
        case '2': $bulanLahir = 'Februari'; break;
        case '3': $bulanLahir = 'Maret'; break;
        case '4': $bulanLahir = 'April'; break;
        case '5': $bulanLahir = 'Mei'; break;
        case '6': $bulanLahir = 'Juni'; break;
        case '7': $bulanLahir = 'Juli'; break;
        case '8': $bulanLahir = 'Agustus'; break;
        case '9': $bulanLahir = 'September'; break;
        case '10': $bulanLahir = 'Oktober'; break;
        case '11': $bulanLahir = 'November'; break;
        case '12': $bulanLahir = 'Desember'; break;
        
        default:
            $bulanLahir = 'Bulan';
            break;
    }

    return $bulanLahir;
    }

    $penduduk = $data['penduduk'];
    $penduduk['tanggalLahir'] = explode('-', $penduduk['tanggalLahir']);
    $penduduk['tanggalLahir'] = $penduduk['tanggalLahir'][2] ." ". bulanLahir($penduduk['tanggalLahir'][1]) ." ". $penduduk['tanggalLahir'][0];



?>

<div class="container">
    <div class="row">
        <div class="border border-3 p-5 mb-5 col-lg-8 col mx-auto mt-5 bg-light rounded-32 ">
            <div class="container py-2">
                <h1 class="display-5 text-center fw-bold my-3">Data Penerima Subsidi</h1>
                <table class="table table-hover overflow-auto">
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
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>