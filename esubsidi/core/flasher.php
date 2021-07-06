<?php

namespace Esubsidi\core;

class Flasher
{

    public static function setFlash($pesan, $aksi, $tipe)
    {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi' => $aksi,
            'tipe' => $tipe
        ];
    }

    public static function flash()
    {
        $icon = "";
        if (isset($_SESSION['flash'])) {
            switch ($_SESSION['flash']['tipe']) {
                case 'success':
                    $icon = "bi-check-circle";
                    break;
                case 'danger':
                    $icon = "bi-x-circle";
                    break;
                default:
                    $icon = "bi-exclamation-circle";
                    break;
            }
            echo "
            <div class='my-2 alert alert-dismissable fade show alert-{$_SESSION['flash']['tipe']} d-flex bd-highlight' role='alert'>
            <div class='p-2  my-auto'>
            <i class='bi {$icon} fs-4' width='32' height='32'></i>
            </div>
            <div class='p-2 text-center my-auto flex-fill bd-highlight'>
                {$_SESSION['flash']['pesan']} {$_SESSION['flash']['aksi']}
            </div>
            <button type='button' class='btn-close my-auto p-2' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
            ";

            unset($_SESSION['flash']);
        }
    }
}
