<?php

namespace Esubsidi\controllers;

use Esubsidi\core\Controller;

class Auth extends Controller
{
    public function hapusData()
    {
        // var_dump($_POST['penduduk']);
    }

    public function detail($hashId = '')
    {
        $data['judul'] = 'Detail';
        $data['hashId'] = $hashId;
        
        //PR RAPIKAN BAGIAN INI!

        $data['penduduk'] = $this->model('PendudukModel')->getPenduduk($data);
        if (isset($_SESSION['user'])) {
            $this->view('templates/header', $data);
            if ($data['penduduk']) {
                if ($this->valid($_SESSION['user']) == 1) {
                    // if RT officer logged in
                    if (
                        $data['penduduk']['rw'] == base64_decode($_SESSION['user']['rw']) &&
                        $data['penduduk']['rt'] == base64_decode($_SESSION['user']['rt'])
                    ) {
                        $this->view('templates/navPengguna');
                    } else {
                        header('Location: ' . BASEURL);
                    }
                    $this->view('templates/navPengguna');
                } else if ($this->valid($_SESSION['user']) == 2) {
                    // When RW officer logged in
                    if ($data['penduduk']['rw'] == base64_decode($_SESSION['user']['rw'])) {
                        $this->view('templates/navPengguna');
                    } else {
                        header('Location: ' . BASEURL);
                    }
                } else if ($this->valid($_SESSION['user']) == 3) {
                    // When Superadmin logged in
                    $this->view('templates/navAdmin');
                } else {
                    header('Location: ' . BASEURL);
                }
                $this->view('beranda/detail', $data);
                $this->view('templates/footer');
            } else {
                header('Location: ' . BASEURL);
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

    public function getRW()
    {
        if (!empty($_POST)) {
            echo json_encode($this->model('PendudukModel')->getDataRW());
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getRT()
    {
        if (!empty($_POST)) {
            $data = array_merge($_POST, $_SESSION['user']);
            echo json_encode($this->model('PendudukModel')->getDataRT($data));
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getHalaman()
    {
        if (!empty($_POST)) {
            $data = array_merge($_POST, $_SESSION['user']);
            echo json_encode($this->model('PendudukModel')->hitungBarisDikueri($data));
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getDataTabelPenduduk()
    {
        if (!empty($_POST)) {
            $data = array_merge($_POST, $_SESSION['user']);
            $data['halaman'] = (($data['halaman']) - 1) * 25;
            echo json_encode($this->model('PendudukModel')->getDataPenduduk($data));
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
