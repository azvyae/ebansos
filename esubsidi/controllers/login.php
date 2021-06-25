<?php

use APP\core\Controller;
use APP\core\Flasher;

class Login extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            $data['judul'] = 'Login';
            $this->view('templates/header', $data);
            $this->view('templates/navUmum');
            $this->view('login/index');
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function redirect()
    {
        if (!empty($_POST)) {
            $data['user'] = $this->model('UserModel')->getUser($_POST);

            if ($_POST['userId'] == $data['user']['userId'] && password_verify($_POST['password'], $data['user']['password'])) {
                if ($data['user']['tipeAkun'] > 0) {
                    // cek apakah remember me
                    if ($_POST['tetapMasuk'] == 'true') {
                        setcookie('nama', $data['user']['nama'], time()+60*60*24*30, secure:true, path:'/');
                        setcookie('tipeAkun', hash('sha256', $data['user']['tipeAkun']), time()+60*60*24*30, secure:true, path:'/');
                        header('Location: ' . BASEURL);
                    } else {
                        $_SESSION['user']['nama'] = $data['user']['nama'];
                        $_SESSION['user']['tipeAkun'] = hash('sha256', $data['user']['tipeAkun']);
                        header('Location: ' . BASEURL);
                    }
                } else {
                    Flasher::setFlash('Anda sudah', 'terdaftar di sistem. Tunggu konfirmasi dari administrator. <i class="bi bi-emoji-smile"></i>', 'warning');
                    header('Location: ' . BASEURL . '/login');
                }
            } else {
                Flasher::setFlash('Username atau password', 'salah!', 'danger');
                header('Location: ' . BASEURL . '/login');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
}
