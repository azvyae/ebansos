<?php

use APP\core\Controller;
use APP\core\Flasher;

class Register extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $data['judul'] = 'Login';
            $this->view('templates/header', $data);
            $this->view('templates/navUmum');
            $this->view('register/index');
            $this->view('templates/footer');
        } else {
            header('Location:'. BASEURL);
        }
    }

    public function getUser()
    {
        if (!empty($_POST)) {
            echo json_encode($this->model('UserModel')->getUserId($_POST['userId']));
        } else {
            header('Location: ' . BASEURL . '/register');
        }
    }

    public function daftar()
    {
        if (!empty($_POST)) {
            if ($this->model('UserModel')->tambahUser($_POST) > 0) {
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
