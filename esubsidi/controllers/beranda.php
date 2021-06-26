<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class Beranda extends Controller
{
    private $judul = 'Beranda';
    public function index()
    {
        $data['judul'] = $this->judul;
        $data['distrik'] = '';
        $this->view('templates/header', $data);
        if (isset($_SESSION['user'])) {
            if ($this->valid($_SESSION['user']) == 1) {
                // When RT officer login

                $this->view('templates/navPengguna');
                $data['distrik'] = 'RW 0' . base64_decode($_SESSION['user']['rw']) . ' RT 0' . base64_decode($_SESSION['user']['rt']);;
                $this->view('berandaPengguna/index', $data);
                $this->view('berandaPengguna/opsiDefault');
                $this->view('berandaPengguna/tabel');
            } else if ($this->valid($_SESSION['user']) == 2) {
                // When RW officer login
                $data['distrik'] = 'RW 0' . base64_decode($_SESSION['user']['rw']);
                $this->view('templates/navPengguna');
                $this->view('berandaPengguna/index', $data);
                $this->view('berandaPengguna/opsiDefault');
                $this->view('berandaPengguna/tabel');
               
            } else if ($this->valid($_SESSION['user']) == 3) {
                 // When Superadmin login
                 $this->view('templates/navAdmin');
                 $this->view('berandaPengguna/index', $data);
                 $this->view('berandaPengguna/opsiDefault');
                 $this->view('berandaPengguna/tabel');
            } else {

                $this->view('templates/navUmum');
                $this->view('beranda/index', $data);
            }
        } else {

            $this->view('templates/navUmum');
            $this->view('beranda/index', $data);
        }

        $this->view('templates/footer');
    }

    public function cekData()
    {
        if (!empty($_POST)) {
            $data['penduduk'] = $this->model('PendudukModel')->getPendudukByNikAndTanggal($_POST);
            if ($data['penduduk'] != false) {
                Flasher::setFlash("<span class='fs-5'>Data berikut sudah terdaftar di sistem.</span><hr><div class='text-start'>NIK: <strong>{$data['penduduk']['nik']}</strong><br>Nama: <strong>{$data['penduduk']['nama']}</strong><br>Alamat: <strong>{$data['penduduk']['alamatRumah']}</strong></div>", '', 'success');
                header('Location: ' . BASEURL);
            } else {
                Flasher::setFlash('<span class="fs-5">Data tersebut', 'tidak terdaftar di sistem kami.</span>', 'danger');
                header('Location: ' . BASEURL);
            }
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getDataTabel()
    {
        if (!empty($_POST)) {
            if (isset($_SESSION['user']['rt'])) {
                echo json_encode(
                    $data['penduduk'] = $this->model('PendudukModel')->getDataPenduduk(
                        $_POST['q'],
                        intval(base64_decode($_SESSION['user']['rw'])),
                        intval(base64_decode($_SESSION['user']['rt']))
                    )
                );
            } else if (isset($_SESSION['user']['rw'])) {
                echo json_encode(
                    $data['penduduk'] = $this->model('PendudukModel')->getDataPenduduk(
                        $_POST['q'],
                        intval(base64_decode($_SESSION['user']['rw'])),
                        $_POST['rt']
                    )
                );
            } else {
                echo json_encode($data['penduduk'] = $this->model('PendudukModel')->getDataPenduduk(
                    $_POST['q'],
                    $_POST['rw'],
                    $_POST['rt']
                )
            );
            }
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function tambahData()
    {
        //         $data['penduduk'] = [
        //             'hashId' => hash('md5', $nik),i
        //             'nik' => $nik,
        //             'nama' => $faker->name(),
        //             'tempatLahir' => $faker->city(),
        //             'tanggalLahir' => $faker->date(),
        //             'jenisKelamin' => end($jenisKelamin),
        //             'alamatRumah' => $faker->address(),
        //             'rt' => rand(1, 12),
        //             'rw' => rand(1, 12),
        //             'kelurahan' => 'Sarijadi',
        //             'kecamatan' => 'Sukasari',
        //             'statusPerkawinan' => end($statusPerkawinan),
        //             'pekerjaan' => $faker->jobTitle()
        //         ];
    }
}
