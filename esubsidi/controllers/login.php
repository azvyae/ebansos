<?php 
use APP\core\Controller;

class Login extends Controller
{
    public function index()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('templates/navUmum');
        $this->view('login/index');
        $this->view('templates/footer');
    }
}

?>