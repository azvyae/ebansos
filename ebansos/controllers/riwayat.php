<?php

use Ebansos\core\Controller;

class Riwayat extends Controller
{
    public function index()
    {
        $this->handlePrivilege();
    }
}

class RiwayatAuth extends Riwayat
{

    public function index()
    {
        $data['user'] = $_SESSION['user'];
        $data['navActive'] = 'riwayat';
        if ($data['user']['tipeAkun'] == 3 || $data['user']['tipeAkun'] == 5) {
            $data['judul'] = 'Riwayat Aktivitas';

            $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
            $data['riwayat'] = $this->translateTime($data['riwayat']);

            $data['riwayatFull'] = $this->model('RiwayatModel')->getRiwayat(500);
            $data['riwayatFull'] = $this->translateTime($data['riwayatFull']);
            $this->view('templates/header', $data);
            $this->view('templates/navAdmin', $data);
            $this->view('riwayat/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
