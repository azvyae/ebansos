<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class Admin extends Controller
{
    public function index()
    {
        header('Location: ' . BASEURL);
    }
}

class AdminAuth extends Admin
{

    public function index()
    {
        $data['user'] = $_SESSION['user'];
        if ($data['user']['tipeAkun'] == 5) {
            $data['judul'] = 'Administrasi';
            $data['navActive'] = 'administrasi';
            $data['statusRegister'] = $this->model('AdministrasiModel')->getStatusRegister()['registrasi'];
            if ($data['statusRegister'] == 'true') {
                $data['checked'] = 'checked';
            } else {
                $data['checked'] = '';
            }
            $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
            $data['riwayat'] = $this->translateTime($data['riwayat']);
            $this->view('templates/header', $data);
            $this->view('templates/navAdmin', $data);
            $this->view('admin/index', $data);
            $this->view('admin/tabel', $data);
        } else {
            header('Location: ' . BASEURL);
        }
        $this->view('templates/footer', $data);
    }

    public function updateStatusRegistrasi()
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && $data['user']['tipeAkun'] == 5) {
            $data = $_POST;
            $this->model('AdministrasiModel')->updateStatusRegister($data);
            Flasher::setFlash('Anda berhasil', 'mengaktifkan registrasi pengguna!', 'success');
            header('Location: ' . BASEURL . '/admin');
        } else if ($data['user']['tipeAkun'] == 5) {
            $data['statusRegistrasi'] = 'false';
            $this->model('AdministrasiModel')->updateStatusRegister($data);
            Flasher::setFlash('Anda berhasil', 'menonaktifkan registrasi pengguna!', 'success');
            header('Location: ' . BASEURL . '/admin');
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getRW()
    {
        if (!empty($_POST)) {
            echo json_encode($this->model('UserModel')->getPetugasRW());
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getHalaman()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            echo json_encode($this->model('UserModel')->hitungBarisDikueri($data));
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function getDataTabelUser()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            $data['halaman'] = (($data['halaman']) - 1) * 20;
            echo json_encode($this->model('UserModel')->getDataUser($data));
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function printUserAndPassword($hash = '', $arrayData = [])
    {
        if (isset($_SESSION['adminGenerator'])) {
            if ($hash == $_SESSION['adminGenerator'] && !empty($arrayData)) {
                $data['user'] = $_SESSION['user'];
                $data['arrayData'] = $arrayData;
                if ($data['user']['tipeAkun'] == 5) {
                    $data['judul'] = 'Cetak Username Password Petugas';
                    $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
                    $data['riwayat'] = $this->translateTime($data['riwayat']);
                    $this->view('templates/header', $data);
                    $this->view('templates/navAdmin', $data);
                    $this->view('admin/print', $data);
                } else {
                    header('Location: ' . BASEURL);
                }
                $this->view('templates/footer', $data);

                unset($_SESSION['adminGenerator']);
            } else {
                header('Location: ' . BASEURL . '/admin ');
            }
        } else {
            $this->handle404();
        }
    }

    public function generateRW()
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $data['validity'] = $_SESSION['adminGenerator'] = hash('sha256', time());
            $data['jumlahRW'] = (int)$_POST['jumlahRW'];
            for ($i = 1; $i <= $data['jumlahRW']; $i++) {
                $val = $i;
                if ($val < 10) {
                    $val = '0'. $val;
                }
                $data['nama'] = 'Petugas RW ' . $val;
                $data['userId'] = KELURAHAN . $val;
                $data['password'] = $this->generatePassword();
                $data['tipeAkun'] = 2;
                $data['rw'] = $val;
                $data['rt'] = null;
                if ($this->model('UserModel')->cekUserRW($data) == 0) {
                    $arrayData[$i - 1] = $this->tambahkanUser($data['nama'], $data['userId'], $data['password'], $data['tipeAkun'], $data['rw'], $data['rt']);
                } else {
                    $arrayData = [];
                }
            }
            if (!empty($arrayData)) {
                $this->registerRiwayat($data['user'], 'Membuat Petugas RW', count($arrayData) . ' Petugas');
                Flasher::setFlash('Anda berhasil', 'menambahkan ' . count($arrayData) . ' petugas RW', 'success');
            } else {
                Flasher::setFlash('Anda gagal', 'menambahkan petugas RW', 'danger');
            }
            $this->printUserAndPassword($data['validity'], $arrayData);
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function generateRT()
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $data['validity'] = $_SESSION['adminGenerator'] = hash('sha256', time());
            $data['nomorRW'] = (int)$_POST['nomorRW'];
            $data['jumlahRT'] = (int)$_POST['jumlahRT'];
            if ($data['nomorRW'] < 10) {
                $data['nomorRW'] = '0'.$data['nomorRW'];
            }
            for ($i = 1; $i <= $data['jumlahRT']; $i++) {
                $val = $i;
                if ($val < 10) {
                    $val = '0'. $val;
                }
                $data['nama'] = 'Petugas RW ' . $data['nomorRW'] . ' RT ' . $val;
                $data['userId'] = KELURAHAN . $data['nomorRW'] . $val;
                $data['password'] = $this->generatePassword();
                $data['tipeAkun'] = 1;
                $data['rw'] = $data['nomorRW'];
                $data['rt'] = $val;
                if ($this->model('UserModel')->cekUserRT($data) == 0) {
                    $arrayData[$i - 1] = $this->tambahkanUser($data['nama'], $data['userId'], $data['password'], $data['tipeAkun'], $data['rw'], $data['rt']);
                } else {
                    $arrayData = [];
                }
            }
            if (!empty($arrayData)) {
                $this->registerRiwayat($data['user'], 'Membuat Petugas RT untuk RW ' . $data['rw'], count($arrayData) . ' Petugas');
                Flasher::setFlash('Anda berhasil', 'menambahkan ' . count($arrayData) . ' petugas RT untuk RW ' . $data['rw'], 'success');
            } else {
                Flasher::setFlash('Anda gagal', 'menambahkan petugas RT', 'danger');
            }
            $this->printUserAndPassword($data['validity'], $arrayData);
            
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function generateSubsidi()
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $data['validity'] = $_SESSION['adminGenerator'] = hash('sha256', time());
            $data['namaSubsidi'] = $_POST['namaSubsidi'];
            $data['nama'] = $data['namaSubsidi'];
            $data['userId'] = implode(explode(' ',$data['namaSubsidi']));
            $data['password'] = $this->generatePassword();
            $data['tipeAkun'] = 4;
            $data['rw'] = null;
            $data['rt'] = null;
            $data['additionalMessage'] = '';
            if ($this->model('UserModel')->getUserId($data['userId']) == 0) {
                if ($this->model('UserModel')->cekUserSubsidi($data) < 3) {
                    $arrayData[0] = $this->tambahkanUser($data['nama'], $data['userId'], $data['password'], $data['tipeAkun'], $data['rw'], $data['rt']);
                } else {
                    $data['additionalMessage'] = ' karena jumlah petugas/acara subsidi sudah lebih dari 3, silakan hapus terlebih dahulu';
                }
            } else {
                $arrayData = [];
            }
            if (!empty($arrayData)) {
                $this->registerRiwayat($data['user'], 'Membuat Event Subsidi', 'Kegiatan ' . $data['nama']);
                Flasher::setFlash('Anda berhasil', 'menambahkan ' . count($arrayData) . ' acara ' . $data['nama'], 'success');
            } else {
                Flasher::setFlash('Anda gagal', 'menambahkan acara subsidi' . $data['additionalMessage'], 'danger');
            }
            $this->printUserAndPassword($data['validity'], $arrayData);
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function tambahkanUser($nama = '', $userId = '', $password = '', $tipeAkun = 0, $rw = null, $rt = null)
    {
        if (isset($_SESSION['adminGenerator'])) {
            $data['nama'] = $nama;
            $data['userId'] = $userId;
            $data['password'] = $password;
            $data['tipeAkun'] = $tipeAkun;
            $data['rw'] = $rw;
            $data['rt'] = $rt;
            $data['statusKonfirmasi'] = 1;
            $this->model('UserModel')->tambahUser($data);
            return $data;
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function konfirmasiUser()
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $data = $_POST;
            if ($data['toggle'] == 'true') {
                $data['statusKonfirmasi'] = 1;
            } else {
                $data['statusKonfirmasi'] = 0;
            }
            $this->model('UserModel')->terimaUser($data);
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function hapus()
    {
        if (!empty($_POST['user']) && $_SESSION['user']['tipeAkun'] == 5) {
            $data = $_POST;
            $data['barisDipengaruhi'] = 0;
            $data['userId'] = $data['user'][0];
            $data['barisDipengaruhi'] += $this->model('UserModel')->hapusDataUser($data);
            if (count($data['user']) > 1) {
                for ((int)$i = 1; $i < count($data['user']); $i++) {
                    $data['userId'] = $data['user'][$i];
                    $data['barisDipengaruhi'] += $this->model('UserModel')->hapusDataUser($data);
                }
            }

            if ($data['barisDipengaruhi'] > 0) {
                $this->registerRiwayat($_SESSION['user'], 'Menghapus '. $data['barisDipengaruhi']. ' pengguna');
                Flasher::setFlash('Anda berhasil', "menghapus {$data['barisDipengaruhi']} data pengguna.", 'success');
                header('Location: ' . BASEURL . "/admin");
            } else {
                Flasher::setFlash('Anda gagal', "menghapus data.", 'danger');
                header('Location: ' . BASEURL . "/admin");
            }
        } else {
            header('Location: ' . BASEURL . "/admin");
        }
    }
}
