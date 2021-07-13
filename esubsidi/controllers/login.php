<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class Login extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $data['uname'] = '';
        $data['statusRegistrasi'] = $this->model('AdministrasiModel')->getStatusRegister()['registrasi'];
        if (isset($_SESSION['input']['userId'])) {
            $data['uname'] = $_SESSION['input']['userId'];
            unset($_SESSION['input']);
        }
        $this->view('templates/header', $data);
        $this->view('templates/navUmum', $data);
        $this->view('login/index', $data);
        $this->view('templates/footer');
    }
    public function redirect()
    {
        if (!empty($_POST)) {
            $data['input'] = $_POST;
            $data['user'] = $this->model('UserModel')->getUser($data['input']);
            if ($data['input']['userId'] == $data['user']['userId'] && password_verify($data['input']['password'], $data['user']['password'])) {
                if ($data['user']['statusKonfirmasi'] > 0) {
                    $this->setSession([$data['user']['userId'], $data['user']['nama'], $data['user']['tipeAkun'], $data['user']['rw'], $data['user']['rt']]);
                } else {
                    Flasher::setFlash('Anda sudah', 'terdaftar di sistem. Tunggu konfirmasi dari administrator. <i class="bi bi-emoji-smile"></i>', 'warning');
                    header('Location: ' . BASEURL . '/login');
                }
            } else {
                Flasher::setFlash('Username atau password', 'salah!', 'danger');
                header('Location: ' . BASEURL . '/login');
            }
            $_SESSION['input']['userId'] = $data['input']['userId'];
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
}


class LoginAuth extends Login
{
    public function index()
    {
        header('Location: ' . BASEURL);
    }
}
