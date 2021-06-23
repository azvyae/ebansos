<?php

use APP\core\Controller as Controller;

class Error extends Controller {
    public function index()
    {
        $data['judul'] = 'Tidak Ditemukan';
        $this->view('templates/header', $data);
        $this->view('error/404');
        $this->view('templates/footer');
    }
}