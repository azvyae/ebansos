<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class Beranda extends Controller
{
    private $judul = 'Beranda';
    public function index()
    {
        $data['judul'] = $this->judul;
        $data['distrik'] = '';
        $data['lebar-cari'] = 'col-lg-3';

        $this->view('templates/header', $data);
        if (isset($_SESSION['user'])) {

            if ($this->valid($_SESSION['user']) == 1) {
                // When RT officer login
                $this->view('templates/navPengguna');
                $data['rw'] = $_SESSION['user']['rw'];
                $data['rt'] = $_SESSION['user']['rt'];
                $data['lebar-cari'] = 'col-lg-7';
                $data['distrik'] = 'RW 0' . base64_decode($data['rw']) . ' RT 0' . base64_decode($data['rt']);
                $this->view('beranda/indexofficer', $data);
                $this->view('beranda/filters/filterRT', $data);
                $this->view('beranda/tabel', $data);
            } else if ($this->valid($_SESSION['user']) == 2) {
                // When RW officer login
                $data['rw'] = $_SESSION['user']['rw'];
                $data['lebar-cari'] = 'col-lg-5';
                $data['distrik'] = 'RW 0' . base64_decode($data['rw']);
                $this->view('templates/navPengguna');
                $this->view('beranda/indexofficer', $data);
                $this->view('beranda/filters/filterRW', $data);
                $this->view('beranda/tabel', $data);
            } else if ($this->valid($_SESSION['user']) == 3) {
                // When Superadmin login
                $this->view('templates/navAdmin');
                $this->view('beranda/indexofficer', $data);
                $this->view('beranda/filters/filter');
                $this->view('beranda/tabel', $data);
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
    // Methods that could be accessed without login
    public function cekData()
    {
        if (!empty($_POST)) {
            $data = $_POST;
            $data['penduduk'] = $this->model('PendudukModel')->getPenduduk($data);
            if ($data['penduduk'] != false) {
                Flasher::setFlash("<span class='fs-5'>Data berikut sudah terdaftar di sistem.</span><hr><div class='text-start'>NIK: <strong>{$data['penduduk']['nik']}</strong><br>Nama: <strong>{$data['penduduk']['nama']}</strong><br>Alamat: <strong>{$data['penduduk']['alamatRumah']}</strong></div>", '', 'success');
                header('Location: ' . BASEURL);
            } else {
                Flasher::setFlash('<span class="fs-5">Data tersebut', 'tidak terdaftar di sistem kami.</span>', 'danger');
                header('Location: ' . BASEURL);
            }
        } else {
            header('Location: ' . BASEURL);
        }
    }

    // Methods that could be accessed with login

    public function __call($method, $args)
    {
        $status = false;
        $status = $this->runMethod($this->auth, $method, $args);
        return $status;
    }

    
}
