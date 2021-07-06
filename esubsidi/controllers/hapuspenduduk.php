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
            $data['hashId'] = $data['penduduk'][0];
            $data['nikDipengaruhi'] = $this->model('PendudukModel')->getNikArray($data)['nik'];
            $data['barisDipengaruhi'] += $this->model('PendudukModel')->hapusDataPenduduk($data);
            if (count($data['penduduk']) > 1) {
                for ((int)$i = 1; $i < count($data['penduduk']); $i++) {
                    $data['hashId'] = $data['penduduk'][$i];
                    $data['nikDipengaruhi'] = "{$this->model('PendudukModel')->getNikArray($data)['nik']}, {$data['nikDipengaruhi']}";
                    $data['barisDipengaruhi'] += $this->model('PendudukModel')->hapusDataPenduduk($data);
                }
            }

            if ($data['barisDipengaruhi'] > 0) {
                $this->registerRiwayat($data, 'Menghapus Data', $data['nikDipengaruhi']);

                Flasher::setFlash('Anda berhasil', "menghapus {$data['barisDipengaruhi']} data penduduk.", 'success');
                header('Location: ' . BASEURL);
            } else {
                Flasher::setFlash('Anda gagal', 'menghapus data.', 'danger');
                header('Location: ' . BASEURL);
            }
        } else {
            header('Location: ' . BASEURL);
        }
    }
}
