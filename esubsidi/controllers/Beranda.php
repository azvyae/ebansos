<?php

use APP\core\Controller as Controller;

class Beranda extends Controller
{
    private $judul = 'Beranda';
    public function index()
    {
        setcookie('userId', 'bWFudGFwQQ==', secure: true);
        setcookie('tipeAkun', 0, secure: true);
        $data['judul'] = $this->judul;
        $this->view('templates/header', $data);
        if (isset($_COOKIE['userId'])) {
            if ($this->valid($_COOKIE) == 1) {
                $this->view('templates/navPengguna');
                $this->view('berandaPengguna/index', $data);
            } else if ($this->valid($_COOKIE) == 2) {
                $this->view('templates/navAdmin');
                $this->view('berandaPengguna/index', $data);
            } else {
                $this->view('templates/navUmum');
                $this->view('beranda/index', $data);
            }
        } else {
            $this->view('templates/navUmum');
            $this->view('beranda/index', $data);
        }
        $this->view('templates/footer');
    }

    public function cekData()
    {
        echo $this->model('PendudukModel')->getPendudukByNikAndTanggal($_POST);
    }
}
