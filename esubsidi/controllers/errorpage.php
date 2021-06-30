<?php

use Esubsidi\core\Controller;

class ErrorPage extends Controller
{

    public function index()
    {
        $data['judul'] = 'Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('error/404');
        // $this->view('templates/footer');
    }
    public function error404()
    {
        $data['judul'] = 'Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('error/404');
        // $this->view('templates/footer');
    }
    public function error401()
    {
        $data['judul'] = 'Tidak Diizinkan';
        $this->view('templates/header', $data);
        $this->view('error/401');
        // $this->view('templates/footer');
    }
}
