<?php

use APP\core\Controller as Controller;

class Beranda extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home';
        $this->view('templates/header', $data);
        $this->view('templates/navUmum');
        $this->view('beranda/index', $data);
        $this->view('templates/footer');
    }
}
