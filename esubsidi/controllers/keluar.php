<?php

use Esubsidi\core\Controller;

class Keluar extends Controller
{
    public function index()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        if (isset($_COOKIE['nama']) && isset($_COOKIE['tipeAkun'])) {
            setcookie('nama', null, -1, '/'); 
            setcookie('tipeAkun', null, -1, '/'); 
        }

        header('Location:' . BASEURL . '/login');
    }
}
