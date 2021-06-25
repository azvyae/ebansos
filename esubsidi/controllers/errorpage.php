<?php

use Esubsidi\core\Controller;

class ErrorPage extends Controller
{
    public function index()
    {
        $data['judul'] = 'Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('error/404');
        $this->view('templates/footer');
    }
}
