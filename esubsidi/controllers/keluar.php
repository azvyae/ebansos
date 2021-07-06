<?php

use Esubsidi\core\Controller;

class Keluar extends Controller
{
    public function index()
    {
        header('Location:' . BASEURL);
    }
}


class KeluarAuth extends Keluar
{
    public function index()
    {
        if (isset($_COOKIE['nama']) && isset($_COOKIE['tipeAkun'])) {
            setcookie('nama', null, -1, '/');
            setcookie('tipeAkun', null, -1, '/');
            if (isset($_COOKIE['rw'])) {
                setcookie('rw', null, -1, '/');
            }
            if (isset($_COOKIE['rt'])) {
                setcookie('rt', null, -1, '/');
            }
        }
        unset($_SESSION['user']);
        header('Location:' . BASEURL . '/login');
    }
}
