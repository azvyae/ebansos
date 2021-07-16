<?php

use Ebansos\core\Controller;

class DetailPenduduk extends Controller
{
    public function index()
    {
        $this->handlePrivilege();
    }
}

class DetailPendudukAuth extends DetailPenduduk
{
    public function index($hashId = '')
    {
        $data['judul'] = 'Detail';
        $data['hashId'] = $hashId;
        $data['penduduk'] = $this->model('PendudukModel')->getPenduduk($data);
        $data['user'] = $_SESSION['user'];

        $this->view('templates/header', $data);
        if ($data['penduduk']) {
            $data['penduduk']['tanggalLahir'] = $this->translateDate($data['penduduk']['tanggalLahir']);

            if ($data['penduduk']['tanggalMenerima'] == null && $data['penduduk']['jenisBansos'] == null) {
                $data['penduduk']['tanggalMenerima'] = $data['penduduk']['jenisBansos'] = 'Belum pernah menerima bansos';
                $data['status'] = 'warning';
            } else {
                $data['penduduk']['tanggalMenerima'] = $this->translateDate($data['penduduk']['tanggalMenerima']);
            }

            if ($data['user']['tipeAkun'] == 1) {

                // if RT officer logged in
                if ($data['penduduk']['rw'] == $data['user']['rw'] && $data['penduduk']['rt'] == $data['user']['rt']) {
                    $this->view('templates/navPengguna');
                } else {
                    header('Location: ' . BASEURL);
                }
            } else if ($data['user']['tipeAkun'] == 2) {

                // When RW officer logged in
                if ($data['penduduk']['rw'] == $data['user']['rw']) {
                    $this->view('templates/navPengguna');
                } else {
                    header('Location: ' . BASEURL);
                }
            } else if ($data['user']['tipeAkun'] == 3 || $data['user']['tipeAkun'] == 5) {

                // When Superadmin logged in
                $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
                $data['riwayat'] = $this->translateTime($data['riwayat']);
                $this->view('templates/navAdmin', $data);
            } else {

                header('Location: ' . BASEURL);
            }

            $this->view('detailpenduduk/index', $data);
            $this->view('templates/footer');
        } else {

            header('Location: ' . BASEURL);
        }
    }
}
