<?php

namespace Esubsidi\core;

use Faker;
use DateTime;
use ErrorPage;

class Controller
{


    public function view(String $view, array $data = [])
    {
        require_once "../esubsidi/views/{$view}.php";
    }
    public function model($model)
    {
        require_once "../esubsidi/models/{$model}.php";
        return new $model;
    }


    public function registerRiwayat($data, $aksi, $nikDipengaruhi = 'Tidak Ada Keterangan.')
    {
        $data['datetime'] = date('Y-m-d H:i:s');
        $data['aksi'] = $aksi;
        $data['nikDipengaruhi'] = $nikDipengaruhi;
        if ($this->model('RiwayatModel')->hitungRiwayat() >= 10) {
            $this->model('RiwayatModel')->hapusRiwayatTerakhir();
        }
        $this->model('RiwayatModel')->tambahRiwayat($data);
    }

    public function translateDate($tanggal)
    {
        $tanggal = explode('-', $tanggal);
        $bulan = $tanggal[1];

        switch ($bulan) {
            case '1':
                $bulanLahir = 'Januari';
                break;
            case '2':
                $bulanLahir = 'Februari';
                break;
            case '3':
                $bulanLahir = 'Maret';
                break;
            case '4':
                $bulanLahir = 'April';
                break;
            case '5':
                $bulanLahir = 'Mei';
                break;
            case '6':
                $bulanLahir = 'Juni';
                break;
            case '7':
                $bulanLahir = 'Juli';
                break;
            case '8':
                $bulanLahir = 'Agustus';
                break;
            case '9':
                $bulanLahir = 'September';
                break;
            case '10':
                $bulanLahir = 'Oktober';
                break;
            case '11':
                $bulanLahir = 'November';
                break;
            case '12':
                $bulanLahir = 'Desember';
                break;

            default:
                $bulanLahir = 'Bulan';
                break;
        }

        $tanggal = $tanggal[2] . " " . $bulanLahir . " " . $tanggal[0];

        return $tanggal;
    }

    public function translateTime($arrayTimestamp)
    {

        if (!$arrayTimestamp) {
            $arrayTimestamp['0']['userId'] = 'Tidak';
            $arrayTimestamp['0']['aksi'] = 'Ada Notifikasi';
        } else {
            $dtNow = new DateTime();
            $i = 0;
            foreach ($arrayTimestamp as $d) {
                $dtToCompare = new DateTime($d['timestamp']);
                $diff = $dtNow->diff($dtToCompare);
                if ($diff->y > 5) {
                    $s = "Sangat lama sekali";
                } else if ($diff->y > 1) {
                    $s = "{$diff->y} tahun yang lalu";
                } else if ($diff->y == 1) {
                    $s = "Setahun yang lalu";
                } else if ($diff->m > 1) {
                    $s = "{$diff->m} bulan yang lalu";
                } else if ($diff->m == 1) {
                    $s = "Sebulan yang lalu";
                } else if ($diff->d > 7) {
                    $s = intdiv($diff->d, 7) . " minggu yang lalu";
                } else if ($diff->d == 7) {
                    $s = "Seminggu yang lalu";
                } else if ($diff->d > 1) {
                    $s = "{$diff->d} hari yang lalu";
                } else if ($diff->d == 1) {
                    $s = "Kemarin";
                } else if ($diff->h > 1) {
                    $s = "{$diff->h} jam yang lalu";
                } else if ($diff->h == 1) {
                    $s = "Satu jam yang lalu";
                } else if ($diff->i > 1) {
                    $s = "{$diff->i} menit yang lalu";
                } else {
                    $s = "Sekitar semenit yang lalu";
                }
                if ($d['nikDipengaruhi'] == '') {
                    $arrayTimestamp[$i]['nikDipengaruhi'] = 'Tidak ada keterangan';
                }
                $arrayTimestamp[$i]['timestamp'] = $s;
                $i++;
            }
        }
        return $arrayTimestamp;
    }

    public function handlePrivilege()
    {
        require_once "../esubsidi/controllers/errorpage.php";
        $handle = new ErrorPage;
        $handle->error401();
    }

    public function setSession($arg)
    {
        $_SESSION['user']['userId'] = $arg[0];
        $_SESSION['user']['namaAkun'] = $arg[1];
        $_SESSION['user']['tipeAkun'] = $arg[2];
        if ($arg[3] != null) {
            $_SESSION['user']['rw'] = $arg[3];
        }
        if ($arg[4] != null) {
            $_SESSION['user']['rt'] = $arg[4];
        }
        header('Location: ' . BASEURL);
    }

    public function generatePassword()
    {
        $faker = Faker\Factory::create('id_ID');
        do {
            $str = (preg_split('/( |,|-)/', $faker->name()))[0];
            $num = $faker->numberBetween(100, 999);
        } while (strlen($str) < 4);

        return "{$str}@{$num}";
    }
}
