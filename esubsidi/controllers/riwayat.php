<?php

use Esubsidi\core\Controller;

class Riwayat extends Controller
{
    public function index()
    {
        header('Location: ' . BASEURL);
    }
}

class RiwayatAuth extends Riwayat
{

    public function index()
    {
        $data['user'] = $_SESSION['user'];
        if ($data['user']['tipeAkun'] == 3) {
            $data['judul'] = 'Riwayat Aktivitas';

            $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
            $data['riwayat'] = $this->translateTime($data['riwayat']);

            $data['riwayatFull'] = $this->model('RiwayatModel')->getRiwayat(100);
            $data['riwayatFull'] = $this->translateTime($data['riwayatFull']);
            $this->view('templates/header', $data);
            $this->view('templates/navAdmin', $data);
            $this->view('riwayat/index', $data);
            $this->view('templates/footer');
        } else {
            header('Location: ' . BASEURL);
        }
    }

    public function reset()
    {
        $data['user'] = $_SESSION['user'];
        // CHANGE THIS FEATURE
        if (isset($_POST) && $data['user']['tipeAkun'] == 3) {
            $GLOBALS['notif'] = $_POST['zero'];
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
