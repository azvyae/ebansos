<?php

use Ebansos\core\Controller;
use Ebansos\core\Flasher;

class TambahPenduduk extends Controller
{
    public function index()
    {
        $this->handlePrivilege();
    }
}

class TambahPendudukAuth extends TambahPenduduk
{
    public function index($hashId = '')
    {
        $data['judul'] = 'Tambah Data Penerima';
        $data['disabledRT'] = $data['disabledRW'] = $data['rwVal'] = $data['rtVal'] = '';
        $data['user'] = $_SESSION['user'];
        $this->view('templates/header', $data);

        if ($data['user']['tipeAkun'] == 1) {

            // if RT officer logged in
            $data['disabledRT'] = $data['disabledRW'] = 'disabled';
            $data['rwVal'] = $data['user']['rw'];
            $data['rtVal'] = $data['user']['rt'];
            $this->view('templates/navPengguna');
        } else if ($data['user']['tipeAkun'] == 2) {

            // When RW officer logged in
            $data['disabledRW'] = 'disabled';
            $data['rwVal'] = $data['user']['rw'];
            $this->view('templates/navPengguna');
        } else if ($data['user']['tipeAkun'] == 3 || $data['user']['tipeAkun'] == 5) {

            // When Superadmin logged in
            $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
            $data['riwayat'] = $this->translateTime($data['riwayat']);
            $this->view('templates/navAdmin', $data);
        } else {

            header('Location: ' . BASEURL);
        }

        $this->view('tambahpenduduk/index', $data);
        $this->view('templates/footer');

        // USED FOR GENERATING DATA
        // $faker = Faker\Factory::create('id_ID');
        // for ($i = 0; $i < 50; $i++) {
        //     $nik = $faker->nik();
        //     $jenisKelamin = ['Pria', 'Wanita'];
        //     $statusPerkawinan = ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'];
        //     $data['penduduk'] = [
        //         'hashId' => hash('md5', $nik),
        //         'nik' => $nik,
        //         'nama' => $faker->name(),
        //         'tempatLahir' => $faker->city(),
        //         'tanggalLahir' => $faker->date(),
        //         'jenisKelamin' => $jenisKelamin[array_rand($jenisKelamin)],
        //         'alamatRumah' => $faker->address(),
        //         'rt' => rand(1, 12),
        //         'rw' => rand(1, 12),
        //         'kelurahan' => 'Sarijadi',
        //         'kecamatan' => 'Sukasari',
        //         'statusPerkawinan' => $statusPerkawinan[array_rand($statusPerkawinan)],
        //         'pekerjaan' => $faker->jobTitle()
        //     ];
        //     $this->model('PendudukModel')->tambahDataPenduduk($data['penduduk']);
            // var_dump($data['penduduk']);
        // }
    }

    public function tambahData()
    {

        if (!empty($_POST)) {
            $data = array_merge($_POST, $_SESSION['user']);
            if ($this->model('PendudukModel')->cekNikSudahAda($data) == 0) {
                $data['hashId'] = hash('md5', $data['nik']);
                $data['nama'] = $data['nama'];
                $data['tanggalLahir'] = "{$data['tahun']}-{$data['bulan']}-{$data['hari']}";
                $data['kelurahan'] = KELURAHAN;
                $data['kecamatan'] = KECAMATAN;
                if ($this->model('PendudukModel')->tambahDataPenduduk($data) > 0) {
                    $this->registerRiwayat($data, 'Menambahkan Data', $data['nik']);
                    Flasher::setFlash('Anda berhasil', "menambahkan {$data['nama']} dengan NIK {$data['nik']} ke sistem", 'success');
                    header('Location: ' . BASEURL . '/tambahpenduduk');
                } else {
                    Flasher::setFlash('Anda gagal', 'menambahkan data.', 'danger');
                    header('Location: ' . BASEURL . '/tambahpenduduk');
                }
            } else {
                Flasher::setFlash('NIK', 'sudah terdaftar!', 'danger');
                header('Location: ' . BASEURL . '/tambahpenduduk');
            }
        } else {
            header('Location: ' . BASEURL . '/tambahpenduduk');
        }
    }
}
