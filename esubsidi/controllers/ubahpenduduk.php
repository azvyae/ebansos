<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class UbahPenduduk extends Controller
{
    public function index()
    {
        $this->handlePrivilege();
    }
}

class UbahPendudukAuth extends UbahPenduduk
{
    public function index($hashId = '')
    {
        $data['judul'] = 'Detail';
        $data['hashId'] = $hashId;
        $data['disabled'] = '';
        $data['penduduk'] = $this->model('PendudukModel')->getPenduduk($data);

        $this->view('templates/header', $data);
        if ($data['penduduk']) {
            $data['penduduk'] = array_merge($data['penduduk'], $_SESSION['user']);
            $data['user'] = $_SESSION['user'];
            $data['penduduk']['tanggalLahir'] = explode('-', $data['penduduk']['tanggalLahir']);
            $data['penduduk']['hari'] = $data['penduduk']['tanggalLahir'][2];
            $data['penduduk']['bulan'] = $data['penduduk']['tanggalLahir'][1];
            $data['penduduk']['tahun'] = $data['penduduk']['tanggalLahir'][0];

            if ($data['user']['tipeAkun'] == 1) {
                // if RT officer logged in
                if ($data['penduduk']['rw'] == $data['user']['rw'] && $data['penduduk']['rt'] == $data['user']['rt']) {
                    $data['disabled'] = 'disabled';
                    $this->view('templates/navPengguna');
                } else {
                    header('Location: ' . BASEURL);
                }
            } else if ($data['user']['tipeAkun'] == 2) {
                // When RW officer logged in
                if ($data['penduduk']['rw'] == $data['user']['rw']) {
                    $data['disabled'] = 'disabled';
                    $this->view('templates/navPengguna');
                } else {
                    header('Location: ' . BASEURL);
                }
            } else if ($data['user']['tipeAkun'] == 3) {

                // When Superadmin logged in
                $data['riwayat'] = $this->model('RiwayatModel')->getRiwayat(5);
                $data['riwayat'] = $this->translateTime($data['riwayat']);
                $this->view('templates/navAdmin', $data);
            } else {

                header('Location: ' . BASEURL);
            }

            $this->view('ubahpenduduk/index', $data);
            $this->view('templates/footer');
        } else {

            header('Location: ' . BASEURL);
        }
    }

    public function ubahData($hashId = '')
    {
        // UBAH HANDLER HEADERNYA
        if (!empty($_POST) && !empty($hashId)) {
            $data = array_merge($_POST, $_SESSION['user']);
            $data['hashId'] = hash('md5', $data['nik']);
            $data['hashIdBefore'] = $hashId;
            $search['hashId'] = $hashId;
            $data['before'] = $this->model('PendudukModel')->getPenduduk($search);
            $data['tanggalLahir'] = "{$data['tahun']}-{$data['bulan']}-{$data['hari']}";
            $data['kelurahan'] = KELURAHAN;
            $data['kecamatan'] = KECAMATAN;
            if ($data['hashId'] == $hashId) {
                if ($this->model('PendudukModel')->ubahDataPenduduk($data) > 0) {
                    $this->registerRiwayat($data, 'Mengubah Data', $data['nik']);
                    if ($data['before']['nama'] == $data['nama']) {
                        Flasher::setFlash('Anda berhasil mengubah', "{$data['nama']} dengan NIK {$data['nik']} di sistem", 'success');
                    } else {
                        Flasher::setFlash('Anda berhasil mengubah', "{$data['before']['nama']} dengan NIK {$data['nik']} menjadi {$data['nama']} di sistem", 'success');
                    }
                    header('Location: ' . BASEURL . '/ubahpenduduk/index/' .  $data['hashId']);
                } else {
                    Flasher::setFlash('Anda gagal', 'mengubah data.', 'danger');
                    header('Location: ' . BASEURL . '/ubahpenduduk/index/' .  $data['hashIdBefore']);
                }
            } else {
                if ($this->model('PendudukModel')->cekNikSudahAda($data) == 0) {
                    if ($this->model('PendudukModel')->ubahDataPenduduk($data) > 0) {
                        $this->registerRiwayat($data, 'Mengubah Data', $data['before']['nik'] . '->' .$data['nik']);
                        if ($data['before']['nama'] == $data['nama']) {
                            Flasher::setFlash('Anda berhasil mengubah', "{$data['nama']} dengan NIK {$data['before']['nik']} menjadi {$data['nik']} di sistem", 'success');
                        } else {
                            Flasher::setFlash('Anda berhasil mengubah', "{$data['before']['nama']} dengan NIK {$data['before']['nik']} menjadi {$data['nama']} dengan NIK {$data['nik']} di sistem", 'success');
                        }
                        header('Location: ' . BASEURL . '/ubahpenduduk/index/' .  $data['hashId']);
                    } else {
                        Flasher::setFlash('Anda gagal', 'mengubah data.', 'danger');
                        header('Location: ' . BASEURL . '/ubahpenduduk/index/' .  $data['hashIdBefore']);
                    }
                } else {
                    Flasher::setFlash('NIK', 'sudah terdaftar!', 'danger');
                    header('Location: ' . BASEURL . '/ubahpenduduk/index/' .  $data['hashIdBefore']);
                }
            }
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
