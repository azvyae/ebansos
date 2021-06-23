<?php

use APP\core\Controller as Controller;

class Beranda extends Controller
{
    private $judul = 'Beranda';
    public function index()
    {
        $data['judul'] = $this->judul;
        $this->view('templates/header', $data);
        $this->view('templates/navUmum');
        $this->view('beranda/index', $data);
        $this->view('templates/footer');
    }

    public function berandaPengguna()
    {
        $data['judul'] = $this->judul;
        $this->view('templates/header', $data);
        $this->view('templates/navPengguna');
        $this->view('beranda/index', $data);
        $this->view('templates/footer');
    }

    public function berandaAdmin()
    {
        $data['judul'] = $this->judul;
        $this->view('templates/header', $data);
        $this->view('templates/navAdmin');
        $this->view('beranda/index', $data);
        $this->view('templates/footer');
    }
}
