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
        if ($this->valid($_SESSION['user']) == 3) {
            $data['judul'] = 'Riwayat Aktivitas';
            $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
            $data['riwayatFull'] = $this->model('RiwayatModel')->getRiwayat(100);
            $data['riwayat'] = $this->translateTime($data['riwayat']);
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
        // CHANGE THIS FEATURE
        if (isset($_POST) && $this->valid($_SESSION['user']) == 3) {
            $GLOBALS['notif'] = $_POST['zero'];
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
