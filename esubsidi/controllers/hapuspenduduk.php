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
        var_dump($_POST);
    }

    public function hapusData()
    {

    }
}
