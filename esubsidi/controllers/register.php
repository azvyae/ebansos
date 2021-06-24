<?php 
use APP\core\Controller;

class Register extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('templates/navUmum');
        $this->view('register/index');
        $this->view('templates/footer');
    }
}

?>