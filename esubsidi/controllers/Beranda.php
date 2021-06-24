<?php

use APP\core\Controller;
use APP\core\Flasher;

class Beranda extends Controller
{
    private $judul = 'Beranda';
    public function index()
    {
        $data['judul'] = $this->judul;
        $this->view('templates/header', $data);
        if (isset($_COOKIE['user'])) {
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
        $data['penduduk'] = $this->model('PendudukModel')->getPendudukByNikAndTanggal($_POST);
        if ($data['penduduk'] != false) {
            Flasher::setFlash("NIK <strong>{$data['penduduk']['nik']}</strong> dengan nama <strong>{$data['penduduk']['nama']}</strong>", 'terdaftar di sistem kami.', 'success');
            header('Location: ' . BASEURL);
        } else {
            Flasher::setFlash('Data tersebut', 'tidak terdaftar di sistem kami.', 'danger');
            header('Location: ' . BASEURL);
        }
    }
}
