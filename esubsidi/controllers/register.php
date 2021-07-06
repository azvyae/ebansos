<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class Register extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('templates/navUmum');
        $this->view('register/index');
        $this->view('templates/footer');
    }

    public function getUser()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            echo json_encode($this->model('UserModel')->getUserId($data['userId']));
        } else {
            header('Location: ' . BASEURL . '/register');
        }
    }

    public function daftar()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            $data['rw'] = $data['rt'] = null;
            $data['tipeAkun'] = 0;
            if ($this->model('UserModel')->getUserId($data['userId']) == 0) {
                $this->model('UserModel')->tambahUser($data);

                $this->registerRiwayat($data, 'Melakukan Pendaftaran');

                Flasher::setFlash('Anda berhasil', 'terdaftar di sistem. Mohon menunggu administrator untuk melakukan konfirmasi.', 'success');
                header('Location: ' . BASEURL . '/register');
            } else {
                Flasher::setFlash('Anda gagal', 'terdaftar di sistem.', 'danger');
                header('Location: ' . BASEURL . '/register');
            }
        } else {
            header('Location: ' . BASEURL . '/register');
        }
    }
}

class RegisterAuth extends Register {
    public function index()
    {
        header('Location:' . BASEURL);
    }
}
