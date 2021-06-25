<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

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
                    if (isset($_POST['tetapMasuk'])) {

                        if ($data['user']['tipeAkun'] == 1) {
                            $str = explode('_', $data['user']['userId']);
                            $rw = base64_encode((int)$str[count($str) - 2]);
                            $rt = base64_encode((int)end($str));
                            setcookie('rw', $rw, time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                            setcookie('rt', $rt, time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        } else if ($data['user']['tipeAkun'] == 3) {
                            $str = explode('_', $data['user']['userId']);
                            $rw = base64_encode((int)end($str));
                            setcookie('rw', $rw, time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        }
                        setcookie('nama', $data['user']['nama'], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        setcookie('tipeAkun', hash('sha256', $data['user']['tipeAkun']), time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        header('Location: ' . BASEURL);
                    } else {
                        if ($data['user']['tipeAkun'] == 1) {

                            $str = explode('_', $data['user']['userId']);
                            $rw = base64_encode((int)$str[count($str) - 2]);
                            $rt = base64_encode((int)end($str));
                            $_SESSION['user']['rw'] = $rw;
                            $_SESSION['user']['rt'] = $rt;
                        } else if ($data['user']['tipeAkun'] == 3) {
                            $str = explode('_', $data['user']['userId']);
                            $rw = base64_encode((int)end($str));
                            $_SESSION['user']['rw'] = $rw;
                        }
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
