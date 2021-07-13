<?php

use Esubsidi\core\Controller;
use Esubsidi\core\Flasher;

class HapusPenduduk extends Controller
{
    public function index()
    {
        $this->handlePrivilege();
    }
}

class HapusPendudukAuth extends HapusPenduduk
{
    public function index()
    {
        if (!empty($_POST)) {
            $data = array_merge($_POST, $_SESSION['user']);
            $data['barisDipengaruhi'] = 0;
            $data['barisGagal'] = 0;
            $data['hashId'] = $data['penduduk'][0];
            $data['additionalMessage'] = '';
            if ($this->model('PendudukModel')->cekPenerimaanSubsidi($data) == 0 && ($data['tipeAkun'] != 3 || $data['user']['tipeAkun'] != 5)) {
                $data['nikDipengaruhi'] = $this->model('PendudukModel')->getNikArray($data)['nik'];
                $data['barisDipengaruhi'] += $this->model('PendudukModel')->hapusDataPenduduk($data);
            } else if ($data['tipeAkun'] == 3 || $data['user']['tipeAkun'] == 5) {
                $data['nikDipengaruhi'] = $this->model('PendudukModel')->getNikArray($data)['nik'];
                $data['barisDipengaruhi'] += $this->model('PendudukModel')->hapusDataPenduduk($data);
            } else {
                $data['barisGagal']++;
            }
            if (count($data['penduduk']) > 1) {
                for ((int)$i = 1; $i < count($data['penduduk']); $i++) {
                    $data['hashId'] = $data['penduduk'][$i];
                    if ($this->model('PendudukModel')->cekPenerimaanSubsidi($data) == 0 && ($data['tipeAkun'] != 3 || $data['user']['tipeAkun'] != 5)) {
                        $data['nikDipengaruhi'] = $this->model('PendudukModel')->getNikArray($data)['nik'] . ', ' . $data['nikDipengaruhi'];
                        $data['barisDipengaruhi'] += $this->model('PendudukModel')->hapusDataPenduduk($data);
                    } else if ($data['tipeAkun'] == 3 || $data['user']['tipeAkun'] == 5) {
                        $data['nikDipengaruhi'] = $this->model('PendudukModel')->getNikArray($data)['nik'] . ', ' . $data['nikDipengaruhi'];
                        $data['barisDipengaruhi'] += $this->model('PendudukModel')->hapusDataPenduduk($data);
                    } else {
                        $data['barisGagal']++;
                    }
                }
            }

            if ($data['barisGagal'] > 0) {
                $data['additionalMessage'] .= " Ada {$data['barisGagal']} baris yang tidak dapat dihapus karena sudah pernah menerima subsidi.";
            }

            if ($data['barisDipengaruhi'] > 0) {
                $this->registerRiwayat($data, 'Menghapus Data', $data['nikDipengaruhi']);

                Flasher::setFlash('Anda berhasil', "menghapus {$data['barisDipengaruhi']} data penduduk.{$data['additionalMessage']}", 'success');
                header('Location: ' . BASEURL);
            } else {
                Flasher::setFlash('Anda gagal', "menghapus data.{$data['additionalMessage']}", 'danger');
                header('Location: ' . BASEURL);
            }
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
