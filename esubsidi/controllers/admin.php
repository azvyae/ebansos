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
            $data['halaman'] = (($data['halaman']) - 1) * 10;
            echo json_encode($this->model('UserModel')->getDataUser($data));
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function generateRW($data)
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $GLOBALS['notif'] = $_POST['zero'];
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function generateRT($data)
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $GLOBALS['notif'] = $_POST['zero'];
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function generatePetugasSubsidi($data)
    {
        $data['user'] = $_SESSION['user'];
        if (!empty($_POST) && ($data['user']['tipeAkun'] == 5)) {
            $GLOBALS['notif'] = $_POST['zero'];
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
