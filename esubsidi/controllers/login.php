<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class Login extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['user'])) {
            
            
            $data['judul'] = 'Login';
            $data['uname'] = '';
            if (isset($_SESSION['input']['userId'])) {
                $data['uname'] = $_SESSION['input']['userId'];
                unset($_SESSION['input']);
            }
            $this->view('templates/header', $data);
            $this->view('templates/navUmum');
            $this->view('login/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location:' . BASEURL);
        }
    }

    public function redirect()
    {
        if (!empty($_POST)) {
            $data['user'] = $this->model('UserModel')->getUser($_POST);
            $rw = null;
            $rt = null;
            if ($_POST['userId'] == $data['user']['userId'] && password_verify($_POST['password'], $data['user']['password'])) {

                if ($data['user']['tipeAkun'] > 0) {
                    if ($data['user']['tipeAkun'] == 1) {
                        $str = explode('_', $data['user']['userId']);
                        $rw = base64_encode((int)$str[count($str) - 2]);
                        $rt = base64_encode((int)end($str));
                    }
                    if ($data['user']['tipeAkun'] == 2) {
                        $str = explode('_', $data['user']['userId']);
                        $rw = base64_encode((int)end($str));
                    }
                    $this->setSession($data['user']['nama'], hash('sha256', $data['user']['tipeAkun']), $rw, $rt, isset($_POST['tetapMasuk']));
                } else {
                    Flasher::setFlash('Anda sudah', 'terdaftar di sistem. Tunggu konfirmasi dari administrator. <i class="bi bi-emoji-smile"></i>', 'warning');
                    header('Location: ' . BASEURL . '/login');
                }
            } else {
                Flasher::setFlash('Username atau password', 'salah!', 'danger');
                header('Location: ' . BASEURL . '/login');
            }
            $_SESSION['input']['userId'] = $_POST['userId'];
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
}
