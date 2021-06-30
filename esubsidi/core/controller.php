<?php

namespace Esubsidi\core;

use DateTime;

class Controller
{
    private $condition = 0;

    public function view(String $view, array $data = [])
    {
        require_once "../esubsidi/views/{$view}.php";
    }
    public function model($model)
    {
        require_once "../esubsidi/models/{$model}.php";
        return new $model;
    }
    // Check if user and tipe user cookie exist
    public function valid($data)
    {
        if (isset($data['tipeAkun'])) {
            if ($data['tipeAkun'] == hash('sha256', 1)) {
                $this->condition = 1;
            } else if ($data['tipeAkun'] == hash('sha256', 2)) {
                $this->condition = 2;
            } else if ($data['tipeAkun'] == hash('sha256', 3)) {
                $this->condition = 3;
            } else if ($data['tipeAkun'] == hash('sha256', 4)) {
                $this->condition = 4;
            } else {
                $this->condition = 0;
            }
        }

        return $this->condition;
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
                    $s = "Sehari yang lalu";
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

    public function __call($name, $arg)
    {
        if ($name == 'setSession') {
            switch (count($arg)) {
                case 5:
                    if (end($arg)) {
                        if ($arg[2] != null) {
                            setcookie('rw', $arg[2], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        }
                        if ($arg[3] != null) {
                            setcookie('rt', $arg[3], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        }
                        setcookie('nama', $arg[0], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                        setcookie('tipeAkun', $arg[1], time() + 60 * 60 * 24 * 30, secure: true, path: '/');
                    } else {

                        if ($arg[2] != null) {
                            $_SESSION['user']['rw'] = $arg[2];
                        }
                        if ($arg[3] != null) {
                            $_SESSION['user']['rt'] = $arg[3];
                        }
                        $_SESSION['user']['nama'] = $arg[0];
                        $_SESSION['user']['tipeAkun'] = $arg[1];
                    }
                    break;
                default:
                    header('Location: ' . BASEURL);
                    break;
            }
        }

        header('Location: ' . BASEURL);
    }
}
