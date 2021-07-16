<?php

use Ebansos\core\Controller;

class ErrorPage extends Controller
{

    public function index()
    {
        $data['judul'] = 'Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('error/404');
    }
    public function error404()
    {
        $data['judul'] = 'Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('error/404');
    }
    public function error401($validity = '')
    {
        if(isset($_SESSION['adminGenerator'])) {
            if ($validity == $_SESSION['adminGenerator']) {
                $data['judul'] = 'Tidak Diizinkan';
                $this->view('templates/header', $data);
                $this->view('error/401');
                unset($_SESSION['adminGenerator']);
            } else {
                $this->handle404();
            }
        } else {
            $this->handle404();
        }
    }
}
