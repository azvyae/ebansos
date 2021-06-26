<?php

namespace Esubsidi\core;

class App
{
    protected $controller = 'beranda';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->initializeSession($_COOKIE);

        $url = $this->parseURL();

        // Check if controller class exist
        if (isset($url[0])) {
            $url[0] = strtolower($url[0]);
            if (file_exists("../esubsidi/controllers/{$url[0]}.php")) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                $this->controller = 'errorpage';
                $this->method = 'index';
            }
        }

        require_once "../esubsidi/controllers/{$this->controller}.php";
        $this->controller = new $this->controller;

        // Check if method in that controller exist
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Check if parameter is exist
        if (!empty($url)) {
            $this->params = array_values($url);
        }

        // jalankan controller & method, serta kirimkan params
        call_user_func_array([$this->controller, $this->method], $this->params);
    }


    public function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }

    public function initializeSession($data)
    {
        if ( !session_id() ) {
            session_start();
        }
        
        if (isset($data['nama']) && isset($data['tipeAkun'])) {
            if ($data['tipeAkun'] == hash('sha256', 1)) {
                $_SESSION['user']['rw'] = $data['rw'];
                $_SESSION['user']['rt'] = $data['rt'];
            } else if ($data['tipeAkun'] == hash('sha256', 2)) {
                $_SESSION['user']['rw'] = $data['rw'];
            }
            $_SESSION['user']['nama'] = $data['nama'];
            $_SESSION['user']['tipeAkun'] = $data['tipeAkun'];
        }
    }
}
